<?php

namespace Controllers\User;

use Bones\Request;
use LDAP\Result;
use Models\Category;
use Models\User;
use Models\Item;
use Models\ItemImage;
use Models\Tag;

class ItemController
{
	public function index(Request $request)
	{
		$items = Item::where('user_id', auth()->id)->where('status', 'Active')->orderBy('id')->get();
        $totalItems = count($items);
		return render('backend/user/items/index', [
			'items' => $items,
            'totalItems' => $totalItems
		]);
	}

    public function create(Request $request)
	{
        $categories = userCategories();
		return render('backend/user/items/create', [
			'categories' => $categories
		]);
	}

    public function store(Request $request)
	{
        $data = json_decode($request->data);
        $item = new Item();
        foreach ($data as $key => $value) {
            if($value->name == 'tag_number') {
                $tag = Tag::where('tag_number', $value->value)->where('is_locked', 1)->first();
                if(empty($tag)) {
                    echo json_encode(['status' => 301, 'message' => 'Tag ID is incorrect!']);
                    exit;
                }
                
                $tag = Item::where('tag_number', $value->value)->first();
                if(!empty($tag)) {
                    echo json_encode(['status' => 301, 'message' => 'Tag ID used!']);
                    exit;
                }
            }
            $column = $value->name;
            $input = $value->value;

            if($column == 'category_id' && $input == ''){
                return redirect()->withFlashError('category id field is required!')->with('old', $request->all())->back();
            }

            // if($column == 'name' && $input == ''){
            //     return redirect()->withFlashError('name field is required!')->with('old', $request->all())->back();
            // }
            $item->{$column} = $input ?? '';
        }
        $item->user_id = auth()->id;
        $item = $item->save();
        
        if ($request->hasFile('files')) {
            $files = $request->files('files');
            foreach($files as $file) {
                $uploadTo = 'assets/uploads/item/';
				$uploadAs = 'item-' . uniqid() . '.' . $file->extension;
				if ($file->save(pathWith($uploadTo), $uploadAs)) {
					$itemImage = new ItemImage();
                    $itemImage->path = $uploadTo . $uploadAs;
                    $itemImage->item_id = $item->id;
                    $itemImage->save();
				}
            }
            
		}

        echo json_encode(['status' => 200, 'item' => $item]);
        exit();
	}

    public function edit(Request $request, Item $item)
	{
        $categories = userCategories();
		return render('backend/user/items/edit', [
			'item' => $item,
            'categories' => $categories
		]);
	}

    public function update(Request $request, Item $item)
	{
		// $validator = $request->validate([
		// 	'name' => 'required|min:2|max:60',
        //     'category_id' => 'required',
		// ]);

		// if ($validator->hasError()) {
		// 	return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		// }

        $data = json_decode($request->data);
       
        foreach ($data as $key => $value) {
            $column = $value->name;
            $input = $value->value;
            $item->{$column} = $input ?? '';
        }
        $item->user_id = auth()->id;
        $item = $item->save();
        
        if ($request->hasFile('files')) {
            $item->images()->remove();
            $files = $request->files('files');
            foreach($files as $file) {
                $uploadTo = 'assets/uploads/item/';
				$uploadAs = 'item-' . uniqid() . '.' . $file->extension;
				if ($file->save(pathWith($uploadTo), $uploadAs)) {
					$itemImage = new ItemImage();
                    $itemImage->path = $uploadTo . $uploadAs;
                    $itemImage->item_id = $item->id;
                    $itemImage->save();
				}
            }
            
		}

        echo json_encode(['status' => 200, 'item' => $item]);
        exit();

    }

    public function delete(Request $request, Item $item) {
        $item->images()->remove();
        $item->delete();
        return redirect()->withFlashError('Item deleted successfully!')->with('old', $request->all())->back();
    }

    public function view(Request $request, Item $item)
	{
		return render('backend/user/items/view', [
			'item' => $item
		]);
	}

    public function checkTag(Request $request) {
        $tag = Tag::where('tag_number', $request->tag_number)->where('is_locked', 1)->first();
        if(empty($tag)) {
            echo json_encode(['status' => 301, 'message' => 'Tag ID is incorrect!']);
            exit;
        }
        
        $item = Item::where('tag_number', $request->tag_number)->first();
        if(!empty($item)) {
            echo json_encode(['status' => 301, 'message' => 'Tag ID used!']);
            exit;
        }

        echo json_encode(['status' => 200, 'tag' => $tag->with('category')]);
        exit;
    }
}
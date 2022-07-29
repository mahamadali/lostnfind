<?php

namespace Controllers\User;

use Bones\Request;
use LDAP\Result;
use Models\Category;
use Models\User;
use Models\Item;
use Models\ItemImage;

class ItemController
{
	public function index(Request $request)
	{
		$items = Item::where('status', 'Active')->orderBy('id')->get();
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
            $column = $value->name;
            $input = $value->value;

            // if($column == 'category_id' && $input == ''){
            //     return redirect()->withFlashError('category id field is required!')->with('old', $request->all())->back();
            // }

            // if($column == 'name' && $input == ''){
            //     return redirect()->withFlashError('name field is required!')->with('old', $request->all())->back();
            // }
            $item->{$column} = $input ?? '';
        }

        $item->tag_number = $item->category()->first()->prefix."-".keyNumber(5);
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

        $item->tag_number = $item->category()->first()->prefix."-".keyNumber(5);
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
}
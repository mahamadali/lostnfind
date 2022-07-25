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
		$categories = Category::where('status', 'Active')->orderBy('id')->get();
		return render('backend/user/items/create', [
			'categories' => $categories
		]);
	}

    public function store(Request $request)
	{
        $validator = $request->validate([
			'name' => 'required|min:2|max:60',
            'category_id' => 'required',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $item = new Item();
        $item->category_id = $request->category_id;
        $item->name = $request->name;
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
        $categories = Category::where('status', 'Active')->orderBy('id')->get();
		return render('backend/user/items/edit', [
			'item' => $item,
            'categories' => $categories
		]);
	}

    public function update(Request $request, Item $item)
	{
		$validator = $request->validate([
			'name' => 'required|min:2|max:60',
            'category_id' => 'required',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $item->category_id = $request->category_id;
        $item->name = $request->name;
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
        Item::where('id', $item->id)->delete();
        return redirect()->withFlashError('Item deleted successfully!')->with('old', $request->all())->back();
    }
}
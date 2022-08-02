<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Category;
use Models\Tag;

class TagsController
{
    public $categories;
    
    public function __construct()
    {
        $this->categories = Category::where('status', 'active')->get();
    }
	public function index(Request $request)
	{
		$tags = Tag::orderBy('id')->get();

		return render('backend/admin/tags/list', [
			'tags' => $tags
		]);
	}

	public function create()
	{
		return render('backend/admin/tags/create', ['categories' => $this->categories]);
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'category_id' => 'required',
			'tag_number' => 'required|unique:tags,tag_number',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $request->is_locked = 0;
		$tagData = $request->getOnly(['category_id', 'tag_number', 'is_locked']);

		$tag = Tag::create($tagData);

		if (!empty($tag)) {
			$tag->save();
			return redirect(route('admin.tags.list'))->withFlashSuccess('Tag created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, Tag $tag)
	{
		return render('backend/admin/tags/edit', [
			'tag' => $tag,
            'categories' => $this->categories
		]);
	}

	public function update(Request $request, Tag $tag)
	{
		$validator = $request->validate([
			'category_id' => 'required',
			'tag_number' => 'required|unique:tags,tag_number,'.$tag->id,
		]);
        
		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$tag->category_id = $request->category_id;
		$tag->tag_number = $request->tag_number;
        $tag->save();

		return redirect()->withFlashSuccess('Tag updated successfully!')->with('old', $request->all())->back();
	}

	public function delete(Request $request, Tag $tag)
	{
		if (!empty($tag)) {
			$tag->delete();
			return redirect()->withFlashError('Tag deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this tag!')->back();
		}
	}

    public function import(Request $request) {
        $csv = array();
        $row = 0;
        $existing = 0;

        // check there are no errors
        if($_FILES['csv']['error'] == 0){
            $name = $_FILES['csv']['name'];
            $fileExploded = explode('.', $_FILES['csv']['name']);
            $ext = strtolower(end($fileExploded));
            $type = $_FILES['csv']['type'];
            $tmpName = $_FILES['csv']['tmp_name'];

            // check the file is a csv
            if($ext === 'csv'){
                if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                    // necessary if a large csv file
                    set_time_limit(0);

                    while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        // number of fields in the csv
                        $col_count = count($data);

                        // get the values from the csv
                        $csv[$row]['col1'] = $data[0];
                        $csv[$row]['col2'] = $data[1];

                        $category = Category::where('prefix', $data[0])->first();
                        if(!empty($category)) {
                            $tag = Tag::where('tag_number', $data[1])->first();
                            if(empty($tag)) {
                                $tag = new Tag();
                                $tag->category_id = $category->id;
                                $tag->tag_number = $data[1];
                                $tag->is_locked = 0;
                                $tag->save();
                                // inc the row
                                $row++;
                            } else {
                                $existing++;
                            }
                        }
                        
                    }
                    fclose($handle);
                }
            }
        }

        return redirect()->withFlashSuccess($row.' tags imported. '.$existing. ' tags already in system')->back();
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function add_category(Request $req)
    {
    	$cat = new Category;
    	$cat->category_name = $req->category;
    	$cat->save();

    	return redirect('/add_category')->with('msg','Category Record Inserted Successfully');
    }

    public function view_category_records()
    {
    	$CategoryRecord = category::paginate(2);
    	return view('admin.view_category',['catRecord'=>$CategoryRecord]);
    }

    public function Delete_Category($cat_id)
    {
    	Category::where('category_id',$cat_id)->delete();
    	return redirect('/view_category')->with('msg','Category Delete Successfully');
    }

    public function Edit_record($cat_id)
    {
    	$data = Category::where('category_id',$cat_id)->first();
    	return view('admin.update_category', ['catRe'=>$data]);
    }

    public function update_category(Request $req)
    {
    	// dd($req->toArray());
    	$id = $req->get('category_edit_id');
    	$data = array('category_name'=>$req->get('category'));
    	Category::where('category_id',$id)->update($data);
    	return redirect('/view_category')->with('msg','Category Updated Successfully');
    }

    public function SearchingCategory(Request $req)
    {
        // dd($req->toArray());
        $search = $req->get('search');
        if($search != '')
        {
            $catRecords = Category::where('category_name','LIKE','%'.$search.'%')->paginate(2)->setpath('');
            $catRecords->appends(array('search'=>$req->get('search')));

            return view('admin.view_category',['catRecord'=>$catRecords]);
        }        

        $catRecords = Category::paginate(2);
        return view('admin.view_category',['catRecord'=>$catRecords]);
    }

    public function active_category($id)
    {
    	$data = array('category_status'=>1);
    	Category::where('category_id',$id)->update($data);
    	echo "1";

    }

    public function deactive_category($id)
    {
    	$data = array('category_status'=>0);
    	Category::where('category_id',$id)->update($data);
    	echo "1";

    }

    public function MultiDeleteRecord(Request $req)
    {
        // dd($req->toArray());

        $mdelete = $req->get('adminMdelete');
        // print_r($mdelete);
        for($i=0;$i<sizeof($mdelete); $i++)
        {
            $catR = Category::find($id);
            Category::where('category_id',$catR)->delete();
        }

        return redirect('/view_category')->with('msg','Delete Multiple Record Success');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Extracategory;

class ExtracategoryController extends Controller
{
    public function add_extracategory_page()
    {
    	$catRecord = Category::where('category_status',1)->get();
    	return view('admin.add_extracategory',['cat'=>$catRecord]);
    }

    public function get_subcategory_record(Request $req)
    {
    	$cat_name = $req->get('cat_id');
    	$subcat_record = Subcategory::where('subcat_name',$cat_name)->get();

    	$sub_dd = "<option vlaue=''>-- Select Subcategory --</option>";
    	foreach($subcat_record as $sr)
    	{
    		$sub_dd .= "<option value=".$sr->subcategory_name.">".$sr->subcategory_name."</option>";
    	}

    	echo $sub_dd;

    }

    public function add_extracategory_record(Request $req)
    {
    	$extra = new Extracategory;
    	$extra->extra_cat_id = $req->get('extra_cat_id');
    	$extra->extra_sub_id = $req->get('extra_sub_id');
    	$extra->extracategory_name = $req->get('extracategory_name');
    	$extra->save();
    	return redirect('/add_extracategory')->with('msg','ExtraCategory Inserted Successfully');
    }

    public function view_extracategory_record()
    {
    	$data = ExtraCategory::paginate(3);
    	return view('admin.view_extracategory',['extracat'=>$data]);
    }

    public function delete_extracategory_record($id)
    {
    	Extracategory::where('extracategory_id',$id)->delete();
    	return redirect('/view_extracategory')->with('msg','Extracategory Delete Successfully');
    }

    public function update_extracategory_record($id)
    {
    	$data = ExtraCategory::where('extracategory_id',$id)->first();
    	$catRecord = Category::where('category_status',1)->get();
    	$subRecord = Subcategory::all();
    	return view('admin.update_extracategory',['extraCat'=>$data, 'catR'=>$catRecord, 'subR'=>$subRecord]);
    }

    public function update_extracategory_records(Request $req)
    {
    	$id = $req->get('edit_extracategory_id');
    	$cat_name = $req->get('extra_cat_id');
    	$sub_name = $req->get('extra_sub_id');
    	$extra_name = $req->get('extracategory_name');
    	$data = array('extra_cat_id'=>$cat_name, 'extra_sub_id'=>$sub_name, 'extracategory_name'=>$extra_name);

    	ExtraCategory::where('extracategory_id',$id)->update($data);
    	return redirect('/view_extracategory')->with('msg','Extracategory Updated Successfully');
    }

    public function active_extracategory($id)
    {
    	$data = array('extracategory_status'=>1);
    	Extracategory::where('extracategory_id',$id)->update($data);
    	echo "1";
    }

    public function deactive_extracategory($id)
    {
    	$data = array('extracategory_status'=>0);
    	Extracategory::where('extracategory_id',$id)->update($data);
    	echo "1";
    }

    public function SearchingExtracategory(Request $req)
    {
        // dd($req->toArray());
        $search = $req->get('search');
        if($search != '')
        {
            $ExtraRecords = Extracategory::where('extracategory_name','LIKE','%'.$search.'%')->paginate(3)->setpath('');
            $ExtraRecords->appends(array('search'=>$req->get('search')));

            return view('admin.view_extracategory',['extracat'=>$ExtraRecords]);
        }        

        $ExtraRecords = Extracategory::paginate(3);
        return view('admin.view_extracategory',['extracat'=>$ExtraRecords]);
    }

    public function MultiDeleteRecord(Request $req)
    {
        // dd($req->toArray());

        $mdelete = $req->get('adminMdelete');
        // print_r($mdelete);
        for($i=0;$i<sizeof($mdelete); $i++)
        {
            $id = $mdelete[$i];
            $subR = Extracategory::where('extracategory_id',$id)->first();
    
            Extracategory::where('extracategory_id',$id)->delete();
        }

        return redirect('/view_extracategory')->with('msg','Delete Multiple Record Success');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Extracategory;
use App\Models\Type;

class TypeController extends Controller
{
    public function add_type_record()
    {
    	$catR = Category::all();
    	return view('admin.add_type',['cat'=>$catR]);
    }

    public function get_extracategory_record(Request $req)
    {
    	$cat_id = $req->get('cat_id');
    	$sub_id = $req->get('sub_id');
    	$data = Extracategory::where('extra_cat_id',$cat_id)->where('extra_sub_id',$sub_id)->get();
    	
    	$sub_dd = "<option vlaue=''>-- Select Extracategory --</option>";
    	foreach($data as $sr)
    	{
    		$sub_dd .= "<option value=".$sr->extracategory_name.">".$sr->extracategory_name."</option>";
    	}

    	echo $sub_dd;	
    }

    public function add_type_records(Request $req)
    {
    	$ty = new Type;
    	$ty->type_cat_id = $req->get('extra_cat_id');
    	$ty->type_sub_id = $req->get('extra_sub_id');
    	$ty->type_extra_id = $req->get('type_extra_id');
    	$ty->type_name = $req->get('type_name');
    	
    	$ty->save();

    	return redirect('/add_type')->with('msg','Type Record Add Successfully');
    }

    public function view_type_records()
    {
    	$data = Type::paginate(3);
    	return view('admin.view_type',['typedata'=>$data]);
    }

    public function active_type_record($id)
    {
    	$data = array('type_status'=>1);
    	Type::where('type_id',$id)->update($data);
    	echo "1";
    }

    public function deactive_type_record($id)
    {
    	$data = array('type_status'=>0);
    	Type::where('type_id',$id)->update($data);
    	echo "1";
    }

    public function delete_type_record($id)
    {
    	Type::where('type_id',$id)->delete();
    	return redirect('/view_type')->with('msg','Type Record Delete Successfully');
    }

    public function update_type_record($id)
    {
        $data = Type::where('type_id',$id)->first();
        $catRecord = Category::where('category_status',1)->get();
        $subRecord = Subcategory::where('subcategory_status',1)->get();
        $extraRecord = Extracategory::all();
        return view('admin.update_type',['TypeR'=>$data, 'catR'=>$catRecord, 'subR'=>$subRecord, 'extraR'=>$extraRecord]);
    }

    public function update_type_Records(Request $req)
    {
        $id = $req->get('edit_type_id');
        $cat_name = $req->get('type_cat_id');
        $sub_name = $req->get('type_sub_id');
        $extra_name = $req->get('type_extra_id');
        $type_name = $req->get('type_name');
        $data = array('type_cat_id'=>$cat_name, 'type_sub_id'=>$sub_name, 'type_extra_id'=>$extra_name, 'type_name'=>$type_name);

        Type::where('type_id',$id)->update($data);
        return redirect('/view_type')->with('msg','Update Record Successfully');
    }

    public function MultiDeleteRecord(Request $req)
    {
        // dd($req->toArray());

        $mdelete = $req->get('adminMdelete');
        // print_r($mdelete);
        for($i=0;$i<sizeof($mdelete); $i++)
        {
            $id = $mdelete[$i];
            $subR = Type::where('type_id',$id)->first();
    
            Type::where('type_id',$id)->delete();
        }

        return redirect('/view_type')->with('msg','Delete Multiple Record Success');
    }

    public function SearchingType(Request $req)
    {
        // dd($req->toArray());
        $search = $req->get('search');
        if($search != '')
        {
            $TypeRecords = Type::where('type_name','LIKE','%'.$search.'%')->paginate(3)->setpath('');
            $TypeRecords->appends(array('search'=>$req->get('search')));

            return view('admin.view_type',['typedata'=>$TypeRecords]);
        }        

        $TypeRecords = Type::paginate(3);
        return view('admin.view_type',['typedata'=>$TypeRecords]);
    }
}

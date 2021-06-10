<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function add_subcategory_page()
    {
    	$categoryR = Category::where('category_status',1)->get();
    	return view('admin.add_subcategory',['cat'=>$categoryR]);
    }

    public function add_subcategory(Request $req)
    {
    	// dd($req->toArray());

    	$subCat = new Subcategory;
    	$subCat->subcat_name = $req->get('subcat_name');
    	$subCat->subcategory_name = $req->get('subcategory_name');
    	$subCat->save();

    	return redirect('/add_subcategory')->with('msg','Subcategory Record Inserted');
    }

    public function view_subcategory_record()
    {
    	$subData = subcategory::paginate(3);
    	return view('admin.view_subcategory',['subcateData'=>$subData]);
    }

    public function delete_subcategory($subcat_id)
    {
    	Subcategory::where('subcategory_id',$subcat_id)->delete();
    	return redirect('/view_subcategory')->with('msg','Subcategory Delete Successfully');
    }

    public function edit_subcategory($subcat_id)
    {
    	$categoryR = Category::where('category_status',1)->get();
    	$data = Subcategory::where('subcategory_id',$subcat_id)->first();
    	return view('admin.update_subcategory', ['subcatRe'=>$data,'cat'=>$categoryR]);
    }

    public function update_subcategory_record(Request $req)
    {
    	$id = $req->get('subcategory_id_data');
    	$data = array('subcat_name'=>$req->get('subcat_name'), 'subcategory_name'=>$req->get('subcategory_name'));
    	Subcategory::where('subcategory_id',$id)->update($data);
    	return redirect('/view_subcategory')->with('msg','Subcategory Updated Successfully');
    }

    public function SearchingSubcategory(Request $req)
    {
        // dd($req->toArray());
        $search = $req->get('search');
        if($search != '')
        {
            $subRecords = Subcategory::where('subcategory_name','LIKE','%'.$search.'%')->paginate(3)->setpath('');
            $subRecords->appends(array('search'=>$req->get('search')));

            return view('admin.view_subcategory',['subcateData'=>$subRecords]);
        }        

        $subRecords = Subcategory::paginate(3);
        return view('admin.view_subcategory',['subcateData'=>$subRecords]);
    }

    public function active_subcategory($id)
    {
    	$data = array('subcategory_status'=>1);
    	Subcategory::where('subcategory_id',$id)->update($data);
    	echo "1";

    }

    public function deactive_subcategory($id)
    {
    	$data = array('subcategory_status'=>0);
    	Subcategory::where('subcategory_id',$id)->update($data);
    	echo "1";

    }

    public function MultiDeleteRecord(Request $req)
    {
        // dd($req->toArray());

        $mdelete = $req->get('adminMdelete');
        // print_r($mdelete);
        for($i=0;$i<sizeof($mdelete); $i++)
        {
            $id = $mdelete[$i];
            $subR = Subcategory::where('subcategory_id',$id)->first();
    
            Subcategory::where('subcategory_id',$id)->delete();
        }

        return redirect('/view_subcategory')->with('msg','Delete Multiple Record Success');
    }
}

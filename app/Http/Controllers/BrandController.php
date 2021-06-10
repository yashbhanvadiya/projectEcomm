<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Extracategory;
use App\Models\Brand;

class BrandController extends Controller
{
    public function add_brand_record()
    {
    	$cat = Category::all();
    	return view('admin.add_brand',['cat'=>$cat]);
    }

    public function add_brand_Records(Request $req)
    {
    	$brand = new Brand;

    	$brand->brand_cat_id = $req->get('extra_cat_id');
    	$brand->brand_sub_id = $req->get('extra_sub_id');
    	$brand->brand_extra_id = $req->get('type_extra_id');
    	$brand->brand_name = $req->get('brand_name');

    	$brand->save();
    	return redirect('/add_brand')->with('msg','Brand Record Inserted Successfully');
    }

    public function view_brand_records()
    {
    	$data = Brand::Paginate(3);
    	return view('admin.view_brand', ['brandData'=>$data]);
    }

    public function active_Brand($id)
    {
    	$data = array('brand_status'=>1);
    	Brand::where('brand_id',$id)->update($data);
    	echo "1";
    }

    public function deactibe_brand($id)
    {
    	$data = array('brand_status'=>0);
    	Brand::where('brand_id',$id)->update($data);
    	echo "1";
    }

    public function delete_brand_record($id)
    {
    	Brand::where('brand_id',$id)->delete();
    	return redirect('/view_brand')->with('msg','Brand Record Delete Successfully');
    }

    public function update_type_record($id)
    {
    	$cat = Category::all();
    	$subcat = Subcategory::all();
    	$extracat = Extracategory::all();
	    $data =	Brand::where('brand_id',$id)->first();
	    return view('admin.update_brand', ['singleBrand'=>$data, 'cat'=>$cat, 'subcat'=>$subcat, 'extra'=>$extracat]);
    }

    public function edit_brand_Records(Request $req)
    {
    	$cat_id = $req->get('extra_cat_id');
    	$sub_id = $req->get('extra_sub_id');
    	$extra_id = $req->get('type_extra_id');
    	$brand_name = $req->get('brand_name');
    	$data = array('brand_cat_id'=>$cat_id, 'brand_sub_id'=>$sub_id, 'brand_extra_id'=>$extra_id, 'brand_name'=>$brand_name);
    	$id = $req->get('brand_update_id');
    	Brand::where('brand_id',$id)->update($data);
    	return redirect('/view_brand')->with('msg','Brand Record Update Successfully');
    }

    public function SearchingBrand(Request $req)
    {
        // dd($req->toArray());
        $search = $req->get('search');
        if($search != '')
        {
            $BrandRecords = Brand::where('brand_name','LIKE','%'.$search.'%')->paginate(3)->setpath('');
            $BrandRecords->appends(array('search'=>$req->get('search')));

            return view('admin.view_brand',['brandData'=>$BrandRecords]);
        }        

        $BrandRecords = Brand::paginate(3);
        return view('admin.view_brand',['brandData'=>$BrandRecords]);
    }

    public function MultiDeleteRecord(Request $req)
    {
        // dd($req->toArray());

        $mdelete = $req->get('adminMdelete');
        // print_r($mdelete);
        for($i=0;$i<sizeof($mdelete); $i++)
        {
            $id = $mdelete[$i];
            $subR = Brand::where('Brand_id',$id)->first();
    
            Brand::where('brand_id',$id)->delete();
        }

        return redirect('/view_brand')->with('msg','Delete Multiple Record Success');
    }
}

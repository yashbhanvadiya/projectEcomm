<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{
    public function add_product_page()
    {
    	$cate = Category::all();
    	return view('admin.add_product', ['cat'=>$cate]);
    }

    public function get_type_brand_records(Request $req)
    {
    	$cat = $req->get('cat_id');
    	$sub = $req->get('sub_id');
    	$extra = $req->get('extra_id');
    	$TypeRecord = Type::where('type_cat_id',$cat)->where('type_sub_id',$sub)->where('type_extra_id',$extra)->get();

    	$type_dd = "<option vlaue=''>--Select Type--</option>";
    	foreach($TypeRecord as $val)
    	{
    		$type_dd .= "<option value=".$val->type_name.">".$val->type_name."</option>";

    		echo $type_dd;
    	}

    }

    public function get_brand_type_records(Request $req)
    {
    	$cat = $req->get('cat_id');
    	$sub = $req->get('sub_id');
    	$extra = $req->get('extra_id');

    	$BrandRecord = Brand::where('brand_cat_id',$cat)->where('brand_sub_id',$sub)->where('brand_extra_id',$extra)->get();

    	$brand_dd = "<option value=''>--Select Brand--</option>";
    	foreach($BrandRecord as $val)
    	{
    		$brand_dd .= "<option value=".$val->brand_name.">".$val->brand_name."</option>";

    		echo $brand_dd;
    	}
    }

    public function add_product_Records(Request $req)
    {

		if($req->file('image'))
		{
			$file = $req->file('image');
			$image_name = rand(11111,99999).".".$file->getClientOriginalExtension();
			$file->move(public_path('/admin/images/'),$image_name);
		}

		if($req->file('mimage'))
		{
			foreach($req->file('mimage') as $mfile)
			{
				$m_name = rand(11111,99999).".".$mfile->getClientOriginalExtension();
				$mfile->move(public_path('/admin/mimage/'),$m_name);
				$m_im[] = $m_name;
			}
			$m_image = implode(',',$m_im);
		}

    	$p = new Product;
    	$p->product_category = $req->get('extra_cat_id');
    	$p->product_subcategory = $req->get('extra_sub_id');
    	$p->product_extracategory = $req->get('type_extra_id');
    	$p->product_type = $req->get('product_type');
    	$p->product_brand = $req->get('product_brand');
    	$p->product_name = $req->get('product_name');
    	$p->product_price = $req->get('product_price');
    	$p->product_description = $req->get('product_description');
    	$p->product_color = implode(',',$req->get('product_color'));
    	$p->product_size = implode(',',$req->get('product_size'));
    	$p->product_image = $image_name;
    	$p->product_mimage = $m_image;
    	$p->save();

    	return redirect('/add_product')->with('msg','Product Record Inserted Successfully');
    }

    public function view_product_records()
    {
    	$data = Product::paginate(5);
    	return view('admin.view_product',['productAll'=>$data]);
    }
}

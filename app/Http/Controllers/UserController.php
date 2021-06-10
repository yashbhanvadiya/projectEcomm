<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Extracategory;

class UserController extends Controller
{
    public function userpage(){
    	$Category =	Category::all();
    	$Subcategory = Subcategory::all();
    	$Extracategory = Extracategory::all();
    	return view('user.index',['category'=>$Category, 'subcategory'=>$Subcategory, 'extracategory'=>$Extracategory]);
    }
}

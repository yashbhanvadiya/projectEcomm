<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Mail;

class AdminController extends Controller
{
    public function addAdminRecords(Request $req)
    {	
    	if($req->file('image'))
    	{
    		$file = $req->file('image');
    		$image_name = rand(10000,99999).".".$file->getClientOriginalExtension();
    		$file->move(public_path('admin/images/'),$image_name);
    	}

    	$admin = new Admin;

    	$fname = $req->fname;
    	$lname = $req->lname;	
    	$admin->name = $fname." ".$lname;
    	$admin->email = $req->email;
    	$admin->password = Hash::make($req->password);
    	$admin->gender = $req->gender;
    	$admin->education = implode('-',$req->education);
    	$admin->city = $req->city;
    	$admin->image = $image_name;
    	$admin->save();

    	return redirect('/add_admin')->with('msg','Data Inserted Successfully');

    	//dd($req->toArray());
    }

    public function viewAdminRecords()
    {
    	$records = Admin::paginate(2);
    	return view('admin.View_admin',['adminRecord'=>$records]);
    }

    public function DeleteAdminRecord($id)
    {
    	$adminR = Admin::find($id);
    	$path = public_path("admin/images/$adminR->image");
    	if(file_exists($path))
    	{
    		unlink($path);	
    	}
		Admin::find($id)->delete();
		return redirect('/view_admin')->with('msg','Admin Record Delete Successfully');   	
    }

    public function editAdminRecord($id)
    {
    	$data = Admin::find($id);
    	return view('/admin/edit_admin', ['adminRec'=>$data]);
    }

    public function UpdateAdminRecord(Request $req)
    {
    	if($req->file('image'))
    	{
    		$file = $req->file('image');
    		$image_name = rand(10000,99999).".".$file->getClientOriginalExtension();
    		$file->move(public_path('admin/images/'),$image_name);

    		$id = $req->admin_id;
    		$adminR = Admin::find($id);
    		$path = public_path("admin/images/$adminR->image");
	    	if(file_exists($path))
	    	{
	    		unlink($path);	
	    	}
    	}
    	else
    	{
    		$id = $req->admin_id;
    		$adminR = Admin::find($id);
    		$image_name = $adminR->image;
    	}

    	$name = $req->fname." ".$req->lname;
    	$educ = implode('-',$req->education);
    	$adminUpdateRec = array('name'=>$name,'email'=>$req->email,'gender'=>$req->gender,'city'=>$req->city,'education'=>$educ,'image'=>$image_name);
    	$id = $req->admin_id;
    	Admin::where('id',$id)->update($adminUpdateRec);
    	return redirect('/view_admin')->with('msg','Admin Record Update Successfully');
    }

    public function checkAdminLogin(Request $req)
    {
        $email = $req->get('email');
        $password = $req->get('password');
        $data = Admin::where('email',$email)->count();
        if($data == 1)
        {
            $data = Admin::where('email',$email)->first();
            if(Hash::check($password, $data->password))
            {
                $req->session()->put('adminLogindata',$data);
                return redirect('/dashboard');
            }
            else
            {
                return redirect('/login')->with('msg','Password is Wrong');
            }
        }
        else
        {
            return redirect('/login')->with('msg','Data Not Found');
        }
    }

    public function otpChecker(Request $req)
    {
        // dd($req->toArray());
        $email = $req->get('otp_email');
        $data = Admin::where('email',$email)->count();
        if($data == 1)
        {
            $adminData = Admin::where('email',$email)->first();
            $to_name = 'Yash Bhanvadiya';
            $to_email = $adminData->email;
            $otp =  rand(10000,99999);
            $req->session()->put('store_otp_session',$otp);
            $req->session()->put('store_email_session',$adminData->email);

            $data = array('name'=>$adminData->name, "body" => $otp);
                
            Mail::send('admin.mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('For verifying your OTP');
                $message->from('FROM_EMAIL_ADDRESS','Verify OTP');
            });

            return redirect('/OtpCheckerPage')->with('su_msg','Enter Your OTP Here');
        }
        else
        {
            return redirect('/')->with('msg','Email Not Found !!');
        }
    }

    public function checkAdminOTPdata(Request $req)
    {
        $ses_otp = session()->get('store_otp_session');
        $otp = $req->get('admin_otp');
        if($otp == $ses_otp)
        {
            return redirect('/new_recover_password');
        }
        else
        {
            return redirect('/OtpCheckerPage')->with('msg','OTP Not Match !!');
        }
    }

    public function changeNewPassword(Request $req)
    {
        // dd($req->toArray());
        $npass = $req->get('npass');
        $cpass = $req->get('cpass');
        if($npass == $cpass)
        {
            $email = session()->get('store_email_session');
            $pass_c = Hash::make($npass);
            $data = array('password'=>$pass_c);
            Admin::where('email',$email)->update($data);

            return redirect('/gotoLoginPage')->with('msg','Password Change Successfully');
        }
        else
        {
            return redirect('/new_recover_password')->with('msg','New & Confirm Password is not match !!');
        }
    }

    public function SearchingRecord(Request $req)
    {
        // dd($req->toArray());
        $search = $req->get('search');
        if($search != '')
        {
            $allData = Admin::where('name','LIKE','%'.$search.'%')->orwhere('email','LIKE','%'.$search.'%')->paginate(2)->setpath('');
            $allData->appends(array('search'=>$req->get('search')));

            return view('admin.View_admin',['adminRecord'=>$allData]);
        }        

        $allData = Admin::paginate(2);
        return view('admin.View_admin',['adminRecord'=>$allData]);
    }

    public function MultiDeleteRecord(Request $req)
    {
        // dd($req->toArray());

        $mdelete = $req->get('adminMdelete');
        // print_r($mdelete);
        for($i=0;$i<sizeof($mdelete); $i++)
        {
            $id = $mdelete[$i];
            $adminR = Admin::find($id);
            $path = public_path("admin/images/$adminR->image");
            if(file_exists($path))
            {
                unlink($path);  
            }
            Admin::where('id',$id)->delete();
        }

        return redirect('/view_admin')->with('msg','Delete Multiple Record Success');
    }
}
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/matrix-login.css') }}" />
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

        <style>
            
            #loginbox .form-actions{
                text-align: center;
            }
            #loginbox .form-actions span{
                float: none;
            }

        </style>

    </head>
    <body>
        <div id="loginbox">    
        @if(Session('su_msg'))
            <div class="alert alert-primary">
                {{ Session('su_msg') }}
            </div>
        @endif   

        @if(Session('msg'))
            <div class="alert alert-danger">
                {{ Session('msg') }}
            </div>
        @endif       
            <form id="loginform" class="form-vertical" method="post" action="{{ url('checkAdminOTPdata')}}">
                {{ csrf_field() }}
				<div class="control-group normal_text"> <h3>Verify Your OTP Here !!</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Enter Your OTP" name="admin_otp" />
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <span class="pull-right">
                    <input type="submit" name="submit" value="Verify" class="btn btn-success" /></span>
                </div>
            </form>

        </div>
        
        <script src="{{ asset('js/jquery.min.js') }}"></script>  
        <script src="{{ asset('js/matrix.login.js') }}"></script> 
    </body>

</html>

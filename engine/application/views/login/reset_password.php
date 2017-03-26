<div class="login-alert-box">
    <div id="alert-login" class="login-alert-content">
        
    </div>
    
</div>
<div class="container">
    
    <form method="post" id="resetForm" class="login-form" action="<?php echo site_url('service/user/resetpassword'); ?>"> 
        <p style="width: 350px; margin: auto; color: black;">Please insert your new password for log in to <a href="<?php echo site_url(); ?>">IndonesiaSatu.co</a> system admin page</p>
        
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="text" class="form-control" name="new_password" placeholder="New Password" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="text" class="form-control" name="confirm_password" placeholder="Confirm New Password" autofocus>
            </div>
            <button id="btn-login" class="btn btn-primary btn-lg btn-block" data-loading-text="Wait..." type="submit">Change Password</button>
        </div>
    </form>
</div>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script type="text/javascript">
    var ResetPassword = {
        init: function(){
            $('#resetForm').ajaxForm({
                type: 'post',
                dataType: 'json',
                beforeSubmit: function(data,form,options){
                    if (!form[0].new_password.value || !form[0].confirm_password.value){
                        alert('Password can not be empty');
                        return false;
                    }
                    $('#btn-login').button('loading');
                },
                success: function (result){
                    $('#btn-login').button('reset');
                    if (result.status){
                        $('#alert-login').html('Password change successfully. Please use your new password to log in. <a href="<?php echo site_url('auth'); ?>">Go to login page</a>');
                        $('#resetForm').hide();
                    }else{
                        $('#alert-login').html(result.message);
                    }
                }
            });
        }
    };
    
    $(document).ready(function(){
        ResetPassword.init();
    });
</script>
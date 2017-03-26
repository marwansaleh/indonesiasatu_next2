<div class="login-alert-box">
    <div id="alert-login" class="login-alert-content">
        
    </div>
</div>
<div class="container">
    <form method="post" id="resetForm" class="login-form" action="<?php echo site_url('service/user/resetpasswordrequest'); ?>"> 
        <p style="width: 350px; margin: auto; color: black;">Please insert your email address that you used in account registration for <a href="<?php echo site_url(); ?>">IndonesiaSatu.co</a> website</p>
        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" class="form-control" name="email" placeholder="Insert your registered email" autofocus>
            </div>
            <button id="btn-request" class="btn btn-primary btn-lg btn-block" data-loading-text="Wait..." type="submit">Request Reset Password</button>
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
                    if (!form[0].email.value){
                        alert('Email address can not be empty');
                        return false;
                    }
                    $('#btn-request').button('loading');
                },
                success: function (result){
                    $('#btn-request').button('reset');
                    if (result.status){
                        $('#alert-login').html(result.message);
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
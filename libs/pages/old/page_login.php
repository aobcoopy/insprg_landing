<div class="container top50">
	<div class="row">
    	<div class="col-md-5">
            <div class="row">
                <div class="col-md-3">
                    <img src="../../uploads/cover.png" width="100%">
                </div>
                <div class="col-md-9">
                    <h1>Login</h1>
                    <form action="" id="login">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" class="form-control" id="tx_email" name="tx_email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" id="tx_password" name="tx_password" aria-describedby="emailHelp" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <button type="button" class="but" onClick="login();">Login</button>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:none;">
                              <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span class="alttext"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    	<div class="col-md-7">
        	Welcome to the submission site for International Journal of Management, Business, and Economics
			<br><br>
            To begin, log in with your user ID and password.
            <br><br>
            If you are unsure about whether or not you have an account, or have forgotten your password, go to the Reset Password screen.
            <br><br>
            
            Resources
            <br><br>
            •	User Tutorials<br>
            •	Instructions & Forms <br>
            •	Journal Home<br>
            •	Help / Site Support

        	
        </div>
    </div>
</div>
<script>
$(document).ready(function(e) {
    $("#tx_email,#tx_password").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$('.but').focus().click();
			}
    });
});
function login()
{
	if($("#tx_email").val()=='')
	{
		alert_text('tx_email');
	}
	else if($("#tx_password").val()=='')
	{
		alert_text('tx_password');
	}
	else
	{
		$.ajax({
			url:"libs/actions/login.php",
			type:"POST",
			dataType:"json",
			data:$("#login").serialize(),
			success: function(res){
				if(res.status == true)
				{
					window.location = '/home';
				}
				else
				{
					$(".alert-danger").fadeIn(300);
					$(".alttext").html(res.msg);
				}
			}
		});
	}
}
function alert_text(input)
{
	alert('Please fill your data');
	$("#"+input).focus();
	return false;
}
</script>
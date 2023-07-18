<div class="container top50">
	<div class="row">
    	<div class="col-md-3">
        </div>
    	<div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h1>Sign up</h1><br>
                    Yuor Palgrave account allows you to log in on many other SpringerNature sites including SpingerLink, Apress.com, Springer Materials, Adis Insight and Springer.com.
                    <br><br>
                    <form action="" id="Register">
                    	<div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Firstname </label>
                                <input type="text" class="form-control" id="tx_Firstname" name="tx_Firstname" aria-describedby="emailHelp" placeholder="Firstname">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Lastname </label>
                                <input type="text" class="form-control" id="tx_Lastname" name="tx_Lastname" aria-describedby="emailHelp" placeholder="Lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" class="form-control" id="tx_Email" name="tx_Email" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Password </label>
                                <input type="password" class="form-control" id="tx_password" name="tx_password" aria-describedby="emailHelp" placeholder="Password">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Password Confirm</label>
                                <input type="password" class="form-control" id="tx_repassword" name="tx_repassword" aria-describedby="emailHelp" placeholder="Password Confirm">
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Firstname">
                        </div>-->
                        <div class="form-group">
                            <button type="button" onClick="regis();" class="but">Register</button>
                        </div>
                        <div class="alert alert-success" role="alert" style="display:none;">
                        	<i class="fa fa-check" aria-hidden="true"></i>  <span class="alttext"></span>
                        </div>
                        <div class="alert alert-danger" role="alert" style="display:none;">
                              <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span class="alttext"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    	
        <div class="col-md-3">
        </div>
    </div>
</div>
<script>
function regis()
{
	var pass = $("#tx_password").val();
	var str_pass = pass.length;
	if($("#tx_Firstname").val()=='')
	{
		alert_text('tx_Firstname');
	}
	else if($("#tx_Lastname").val()=='')
	{
		alert_text('tx_Lastname');
	}
	else if($("#tx_Email").val()=='')
	{
		alert_text('tx_Email');
	}
	else if($("#tx_password").val()=='')
	{
		alert_text('tx_password');
	}
	else if($("#tx_repassword").val()=='')
	{
		alert_text('tx_repassword');
	}
	else
	{
		if($("#tx_password").val()!=$("#tx_repassword").val())
		{
			alert('password is mismatch');
			$("#tx_repassword").focus();
			return false;
		}
		else
		{
			if(str_pass<6)
			{
				$(".alert-danger").fadeIn(300);
				$(".alttext").html('Please fill your password 6-8 character');
			}
			else
			{
				$(".alert").hide();
				$.ajax({
					url:"libs/actions/sign_up.php",
					type:"POST",
					dataType:"json",
					data:$("#Register").serialize(),
					success: function(res){
						if(res.status == true)
						{
							$(".alert-success").fadeIn(300);
							$(".alttext").html(res.msg);
							setTimeout(function(){
								$(".alert-success").fadeOut(300);
								window.location.reload();
							},3000);
						}
						else
						{
							$(".alert-danger").fadeIn(300);
							$(".alttext").html(res.msg);
							/*setTimeout(function(){
								$(".alert-danger").fadeOut(300);
							},3000);*/
						}
					}
				});
			}
			
		}
	}
}

function alert_text(input)
{
	alert('Please fill your data');
	$("#"+input).focus();
	return false;
}
</script>
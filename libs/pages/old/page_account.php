<?php 
if(!isset($_SESSION['user']['id']))
{
	?><script>
    	$(document).ready(function(e) {
            window.location = '/';
        });
    </script>	<?php
}
?>
<div class="container">
	<div class="row">
    	<div class="col-12">
        	<br><br>
        	<h1>Welcome <?php echo $_SESSION['user']['name'];?></h1><br>

            <strong>Name :</strong> <?php echo $_SESSION['user']['name'];?><br>
            <strong>Email :</strong> <?php echo $_SESSION['user']['email'];?><br><br>
            
            <h2>Change Password</h2>
            <div class="col-md-6 nopad">
                <form action="" id="reset_pass">
                	<input type="hidden" name="txtID" value="<?php echo $_SESSION['user']['id'];?>">
                    <input type="hidden" name="txtemail" value="<?php echo $_SESSION['user']['email'];?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Old Password</label>
                        <input type="password" class="form-control" id="tx_Old_password" name="tx_Old_password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="password" class="form-control" id="tx_New_password" name="tx_New_password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Password</label>
                        <input type="password" class="form-control" id="tx_re_password" name="tx_re_password" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <button type="button" class="but" onClick="reset_password();">Change Password</button>
                    </div>
                    <div class="alert alert-danger" role="alert" style="display:none;">
                          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span class="alttext"></span>
                    </div>
                    <div class="alert alert-success" role="alert" style="display:none;">
                        <i class="fa fa-check" aria-hidden="true"></i>  <span class="alttext"></span>
                    </div>
                </form>
            </div>
                
        </div>
    </div>
</div>
<script>
function reset_password()
{
	var pass = $("#tx_New_password").val();
	var str_pass = pass.length;
	
	if($("#tx_Old_password").val()=='')
	{
		alert_text('tx_Old_password');
	}
	else if($("#tx_New_password").val()=='')
	{
		alert_text('tx_New_password');
	}
	else if($("#tx_re_password").val()=='')
	{
		alert_text('tx_re_password');
	}
	else
	{
		if($("#tx_New_password").val()!=$("#tx_re_password").val())
		{
			alert('password is mismatch');
			$("#tx_re_password").focus();
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
					url:"libs/actions/reset_password.php",
					type:"POST",
					dataType:"json",
					data:$("#reset_pass").serialize(),
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
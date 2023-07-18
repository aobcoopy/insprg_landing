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
                                <input type="email" class="form-control" id="tx_Firstname" name="tx_Firstname" aria-describedby="emailHelp" placeholder="Firstname">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Lastname </label>
                                <input type="email" class="form-control" id="tx_Lastname" name="tx_Lastname" aria-describedby="emailHelp" placeholder="Lastname">
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
			alert_text('tx_repassword');
		}
		else
		{
			$.ajax({
				url:"",
				type:"POST",
				dataType:"json",
				data:{},
				success: function(res){
				}
			});
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
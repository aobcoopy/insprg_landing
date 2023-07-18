<div class="container top50">
	<div class="row justify-content-md-center">
                <div class="col-md-9">
                    <h1>Login</h1>
                    <form id="login">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username </label>
                            <input type="email" class="form-control" id="tx_Username" name="tx_Username" aria-describedby="emailHelp" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" id="tx_Password" name="tx_Password" aria-describedby="emailHelp" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="button" class="but" onClick="fn.login();">Login</button>
                        </div>
                    </form>
                    
                    <div class="alert alert-danger" role="alert" style="display:none;">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please check your Username and Password!
                    </div>
                </div>
    	
    </div>
</div>


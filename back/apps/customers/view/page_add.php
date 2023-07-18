<br>

<!-- Modal -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_user">
                	<div class="form-user">
                        <label for="Name">Username</label>
                        <input type="text" class="form-control" id="tx_Username" name="tx_Username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-user">
                        <label for="Name">Password</label>
                        <input type="text" class="form-control" id="tx_Password" name="tx_Password" aria-describedby="emailHelp" placeholder="Password">
                    </div>
                    <div class="form-user">
                        <label for="Name">Firstname</label>
                        <input type="text" class="form-control" id="tx_Firstname" name="tx_Firstname" aria-describedby="emailHelp" placeholder="Firstname">
                    </div>
                    <div class="form-user">
                        <label for="Name">Lastname</label>
                        <input type="text" class="form-control" id="tx_Lastname" name="tx_Lastname" aria-describedby="emailHelp" placeholder="Lastname">
                    </div>
                    <div class="form-user">
                        <label for="Name">Title</label>
                        <select id="cbbTitle" name="cbbTitle" class="form-control">
							<option>Mr.</option>
							<option>Mrs.</option>
							<option>Miss.</option>
							<option>Ms.</option>
							<option>Mx.</option>
						</select>
                    </div>
                    <div class="form-user">
                        <label for="Name">Gender</label>
                        <select id="cbbGender" name="cbbGender" class="form-control">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
                    </div>
                    <div class="form-user">
                        <label for="Name">Group</label>
                        <select id="cbbGroup" name="cbbGroup" class="form-control">
						<?php
							$sql= "SELECT * FROM groups";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo "<option value='$line[id]'>$line[name]</option>";
							}
						?>
						</select>
                    </div>
                    <div class="form-user">
                        <label for="Name">Phone</label>
                        <input type="text" class="form-control" id="tx_Phone" name="tx_Phone" aria-describedby="emailHelp" placeholder="Phone">
                    </div>
                    <div class="form-user">
                        <label for="Name">Mobile</label>
                        <input type="tel" class="form-control" id="tx_Mobile" name="tx_Mobile" aria-describedby="emailHelp" placeholder="Mobile">
                    </div>
                    <div class="form-user">
                        <label for="Name">E-Mail</label>
                        <input type="email" class="form-control" id="tx_Email" name="tx_Email" aria-describedby="emailHelp" placeholder="E-Mail">
                    </div>
				
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.user.add();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(e) {
    $(".but_area").append('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus" aria-hidden="true"></i></button>');
});
</script>
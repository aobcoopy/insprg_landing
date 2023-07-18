<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$user = $dbc->GetRecord("users","*","id = '".$_REQUEST['id']."'");
	$contact = $dbc->GetRecord("contacts","*","id = '".$user['contact']."'");
?><br>
<!-- Modal -->
<div class="modal fade" id="dialog_edit_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_edit_user">
                	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
                    <input type="hidden" name="txtconID" value="<?php echo $contact['id'];?>">
                    <div class="form-user">
                        <label for="Name">Username</label>
                        <input type="text" class="form-control" id="tx_E_Username" name="tx_E_Username" aria-describedby="emailHelp" placeholder="<?php echo $user['name'];?>" >
                        <small id="emailHelp" class="form-text text-muted">Leave blank is No Change.</small>
                    </div>
                    <div class="form-user">
                        <label for="Name">Password</label>
                        <input type="text" class="form-control" id="tx_E_Password" name="tx_E_Password" aria-describedby="emailHelp" placeholder="Leave blank is No Change">
                        <small id="emailHelp" class="form-text text-muted">Leave blank is No Change.</small>
                    </div>
                    <div class="form-user">
                        <label for="Name">Firstname</label>
                        <input type="text" class="form-control" id="tx_E_Firstname" name="tx_E_Firstname" aria-describedby="emailHelp" placeholder="Firstname" value="<?php echo $contact['name'];?>">
                    </div>
                    <div class="form-user">
                        <label for="Name">Lastname</label>
                        <input type="text" class="form-control" id="tx_E_Lastname" name="tx_E_Lastname" aria-describedby="emailHelp" placeholder="Lastname" value="<?php echo $contact['surname'];?>">
                    </div>
                    <div class="form-user">
                        <label for="Name">Title</label>
                        <select id="cbb_E_Title" name="cbb_E_Title" class="form-control">
							<option value="Mr." <?php echo ($contact['title']=='Mr.')?'selected':'';?>>Mr.</option>
							<option value="Mrs." <?php echo ($contact['title']=='Mrs.')?'selected':'';?>>Mrs.</option>
							<option value="Miss." <?php echo ($contact['title']=='Miss.')?'selected':'';?>>Miss.</option>
							<option value="Ms." <?php echo ($contact['title']=='Ms.')?'selected':'';?>>Ms.</option>
							<option value="Mx." <?php echo ($contact['title']=='Mx.')?'selected':'';?>>Mx.</option>
						</select>
                    </div>
                    <div class="form-user">
                        <label for="Name">Gender</label>
                        <select id="cbb_E_Gender" name="cbb_E_Gender" class="form-control">
							<option value="male" <?php echo ($contact['gender']=='')?'selected':'';?>>Male</option>
							<option value="female" <?php echo ($contact['gender']=='')?'selected':'';?>>Female</option>
						</select>
                    </div>
                    <div class="form-user">
                        <label for="Name">Group</label>
                        <select id="cbb_E_Group" name="cbb_E_Group" class="form-control">
						<?php
							$sql= "SELECT * FROM groups";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								$sel = ($line['id']==$user['gid'])?'selected':'';
								echo "<option value='$line[id]' ".$sel.">$line[name]</option>";
							}
						?>
						</select>
                    </div>
                    <div class="form-user">
                        <label for="Name">Phone</label>
                        <input type="text" class="form-control" id="tx_E_Phone" name="tx_E_Phone" aria-describedby="emailHelp" placeholder="Phone" value="<?php echo $contact['phone'];?>">
                    </div>
                    <div class="form-user">
                        <label for="Name">Mobile</label>
                        <input type="tel" class="form-control" id="tx_E_Mobile" name="tx_E_Mobile" aria-describedby="emailHelp" placeholder="Mobile" value="<?php echo $contact['mobile'];?>">
                    </div>
                    <div class="form-user">
                        <label for="Name">E-Mail</label>
                        <input type="email" class="form-control" id="tx_E_Email" name="tx_E_Email" aria-describedby="emailHelp" placeholder="E-Mail" value="<?php echo $contact['email'];?>">
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.user.save_change();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
	$("#dialog_edit_user").modal('show');
	$("#tx_Name").focus();
	
	$("#dialog_edit_user").on("hidden.bs.modal",function(){
		$(this).remove();
	});
});
</script>
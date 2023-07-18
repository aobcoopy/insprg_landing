<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$customers = $dbc->GetRecord("customers","*","id = '".$_REQUEST['id']."'");
	$contact = $dbc->GetRecord("contacts","*","id = '".$customers['contact']."'");
?><br>
<!-- Modal -->
<div class="modal fade" id="dialog_edit_customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit customers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_edit_customers">
                	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
                    <input type="hidden" name="txtconID" value="<?php echo $contact['id'];?>">
                    <div class="form-customers">
                        <label for="Name">Username</label>
                        <input type="text" class="form-control" id="tx_E_Username" name="tx_E_Username" aria-describedby="emailHelp" placeholder="<?php echo $customers['email'];?>" >
                        <small id="emailHelp" class="form-text text-muted">Leave blank is No Change.</small>
                    </div>
                    <div class="form-customers">
                        <label for="Name">Password</label>
                        <input type="text" class="form-control" id="tx_E_Password" name="tx_E_Password" aria-describedby="emailHelp" placeholder="Leave blank is No Change">
                        <small id="emailHelp" class="form-text text-muted">Leave blank is No Change.</small>
                    </div>
                    <div class="form-customers">
                        <label for="Name">Firstname</label>
                        <input type="text" class="form-control" id="tx_E_Firstname" name="tx_E_Firstname" aria-describedby="emailHelp" placeholder="Firstname" value="<?php echo $contact['name'];?>">
                    </div>
                    <div class="form-customers">
                        <label for="Name">Lastname</label>
                        <input type="text" class="form-control" id="tx_E_Lastname" name="tx_E_Lastname" aria-describedby="emailHelp" placeholder="Lastname" value="<?php echo $contact['surname'];?>">
                    </div>
                    <div class="form-customers">
                        <label for="Name">Title</label>
                        <select id="cbb_E_Title" name="cbb_E_Title" class="form-control">
							<option value="Mr." <?php echo ($contact['title']=='Mr.')?'selected':'';?>>Mr.</option>
							<option value="Mrs." <?php echo ($contact['title']=='Mrs.')?'selected':'';?>>Mrs.</option>
							<option value="Miss." <?php echo ($contact['title']=='Miss.')?'selected':'';?>>Miss.</option>
							<option value="Ms." <?php echo ($contact['title']=='Ms.')?'selected':'';?>>Ms.</option>
							<option value="Mx." <?php echo ($contact['title']=='Mx.')?'selected':'';?>>Mx.</option>
						</select>
                    </div>
                    <div class="form-customers">
                        <label for="Name">Gender</label>
                        <select id="cbb_E_Gender" name="cbb_E_Gender" class="form-control">
							<option value="male" <?php echo ($contact['gender']=='')?'selected':'';?>>Male</option>
							<option value="female" <?php echo ($contact['gender']=='')?'selected':'';?>>Female</option>
						</select>
                    </div>
                    
                    <div class="form-customers">
                        <label for="Name">Phone</label>
                        <input type="text" class="form-control" id="tx_E_Phone" name="tx_E_Phone" aria-describedby="emailHelp" placeholder="Phone" value="<?php echo $contact['phone'];?>">
                    </div>
                    <div class="form-customers">
                        <label for="Name">Mobile</label>
                        <input type="tel" class="form-control" id="tx_E_Mobile" name="tx_E_Mobile" aria-describedby="emailHelp" placeholder="Mobile" value="<?php echo $contact['mobile'];?>">
                    </div>
                    <div class="form-customers">
                        <label for="Name">E-Mail</label>
                        <input type="email" class="form-control" id="tx_E_Email" name="tx_E_Email" aria-describedby="emailHelp" placeholder="E-Mail" value="<?php echo $contact['email'];?>">
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.customers.save_change();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
	$("#dialog_edit_customers").modal('show');
	$("#tx_Name").focus();
	
	$("#dialog_edit_customers").on("hidden.bs.modal",function(){
		$(this).remove();
	});
});
</script>
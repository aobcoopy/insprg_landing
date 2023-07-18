<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$data = $dbc->GetRecord("groups","*","id = '".$_REQUEST['id']."'");
?><br>
<!-- Modal -->
<div class="modal fade" id="dialog_edit_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_edit_group">
                	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="email" class="form-control" id="tx_Name_e" name="tx_Name_e"  placeholder="Name" value="<?php echo $data['name'];?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.group.save_change();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
	$("#dialog_edit_group").modal('show');
	$("#tx_Name").focus();
	
	$("#dialog_edit_group").on("hidden.bs.modal",function(){
		$(this).remove();
	});
});
</script>
<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$article_volumes = $dbc->GetRecord("article_volumes","*","id = '".$_REQUEST['id']."'");
?><br>
<!-- Modal -->
<div class="modal fade" id="dialog_edit_volumes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit volumes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_edit_volumes">
                	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
                    <div class="form-volumes">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="tx_E_Name" name="tx_E_Name" aria-describedby="emailHelp" placeholder="Name" value="<?php echo $article_volumes['name'];?>">
                    </div>
                    <div class="form-volumes">
                        <br>
                        <button type="button" class="btn btn-primary" onClick="fn.upload_photo()">Upload Photo</button>
                        <br>
                        <input type="hidden" class="paths" id="path_photo_E" name="path_photo_E">
                        <input type="hidden" name="tx_E_photo" id="tx_E_photo"><br>
                        <img src="<?php echo json_decode($article_volumes['photo'],true);?>"  width="100%" class="E_phos">
                        <button type="button" class="btn btn-danger bc_EP" style="width:100%; display:none" onclick="fn.remove_E_photo(this);">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                     <div class="form-volumes">
                        <br>
                        <button type="button" class="btn btn-primary" onClick="fn.upload_E_pdf()">Upload PDF</button>
                        <br>
                        <input type="hidden" name="txt_E_pdf" id="txt_E_pdf"><br>
                        <span  width="100%" class="pdf_E_old"><?php echo json_decode($article_volumes['files'],true);?></span>
                        <span  width="100%" class="pdf_E"></span>
                        <button type="button" class="btn btn-danger bc_E" style="width:100%; display:none" onclick="fn.remove_E_pdf(this);">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="$('.bc_EP,.bc_E').click();">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.volumes.save_change();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
	$("#dialog_edit_volumes").modal('show');
	$("#tx_Name").focus();
	
	$("#dialog_edit_volumes").on("hidden.bs.modal",function(){
		$(this).remove();
	});
});
</script>

<form id="form_E_photo" class="hidden" style="display:none;">
    <input id="f_E_Photo" name="file" type="file">
    <button type="button" id="btn_E_upp" onClick="fn.upload_E_photo_file()">UP</button>
</form>
       
<form id="form_E_pdf" class="hidden" style="display:none;">
    <input id="f_E_pdf" name="file_pdf" type="file">
    <button type="button" id="btn_upp_E_pdf" onClick="fn.upload_E_pdf_files()">UP</button>
</form>       
        
<script>
$(function(){
	var file_E_upload = "#f_E_Photo";

	fn.upload_photo = function(){
		$(file_E_upload).click();
		$(file_E_upload).unbind();
		
		$(file_E_upload).on("change",function(e){
			var files = this.files
			$("#btn_E_upp").click();    
		});
	};	
	
	fn.upload_E_photo_file = function(){
		var data = new FormData($("#form_E_photo")[0]);
		var s = '';
		jQuery.ajax({
			url: 'apps/volumes/xhr/up_photo.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				if(response.success){
					$("#path_photo_E").val(response.path);
					$("#tx_E_photo").val(response.path);
					$(".E_phos").attr('src',response.path);
					$(".bc_EP").show();
					$("#f_E_Photo").val('');
					/*$("#tblbrand").DataTable().draw();
					$("#dialog_edit_icon").modal('hide');*/
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	};
	
	fn.remove_E_photo = function(me){
		var file_path = $(me).parent().find('.paths').val();
		//alert(file_path);
		$.ajax({
			url:"apps/volumes/xhr/remove_photo.php",
			type:"POST",
			dataType:"json",
			data:{path:file_path},
			success: function(resp){
				if(resp.status==true)
				{
					$("#path_photo_E").val('');
					$("#tx_E_photo").val('');
					$(".E_phos").attr('src','');
					$(".bc_EP").hide();
					$("#f_E_Photo").val('');
					fn.engine.alert("Alert",response.msg);
				}
				else
				{
					fn.engine.alert("Alert",response.msg);
				}
				
			}
		});
	};
	
	
	var file_E_upload_pdf = "#f_E_pdf";

	fn.upload_E_pdf = function(){
		$(file_E_upload_pdf).click();
		$(file_E_upload_pdf).unbind();
		
		$(file_E_upload_pdf).on("change",function(e){
			var files = this.files
			$("#btn_upp_E_pdf").click();    
		});
	};	
	
	fn.upload_E_pdf_files = function(){
		var data = new FormData($("#form_E_pdf")[0]);
		var s = '';
		jQuery.ajax({
			url: 'apps/volumes/xhr/up_pdf.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				if(response.success){
					$("#txt_E_pdf").val(response.path);
					$(".pdf_E").html(response.path);
					$(".bc_E").show();
					$(".pdf_E_old").hide();
					$("#f_E_pdf").val('');
				}else{
					fn.check_tx_empty(".upload_E_pdf",response.msg);
				}	
			}
		});
	};
	
	fn.remove_E_pdf = function(me){
		var file_path = $(me).parent().find('#txt_E_pdf').val();
		//alert(file_path);
		$.ajax({
			url:"apps/volumes/xhr/remove_pdf.php",
			type:"POST",
			dataType:"json",
			data:{path:file_path},
			success: function(resp){
				if(resp.status==true)
				{
					$("#txt_E_pdf").val('');
					$(".pdf_E").html('');
					$(".bc_E").hide();
					$(".pdf_E_old").show();
					$("#f_pdf").val('');
				}
				else
				{
					fn.engine.alert("Alert",response.msg);
				}
				
			}
		});
	};

});
</script>
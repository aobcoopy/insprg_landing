<br>

<!-- Modal -->
<div class="modal fade" id="add_volumes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Volumes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_volumes">
                	<div class="form-volumes">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="tx_Name" name="tx_Name" aria-describedby="emailHelp" placeholder="Name">
                    </div>
                    <div class="form-volumes">
                        <br>
                        <button type="button" class="btn btn-primary" onClick="fn.upload_photo()">Upload Photo</button>
                        <br>
                        <input type="hidden" class="paths" id="path_photo" name="path_photo">
                        <input type="hidden" name="txt_photo" id="txt_photo" ><br>
                        <img src=""  width="100%" class=" phos">
                        <button type="button" class="btn btn-danger bc" style="width:100%; display:none" onclick="fn.remove_photo(this);">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="form-volumes">
                        <br>
                        <button type="button" class="btn btn-primary but_pdf" onClick="fn.upload_pdf()">Upload PDF</button>
                        <br>
                        <input type="hidden" name="txt_pdf" id="txt_pdf" ><br>
                        <span  width="100%" class=" pdf"></span>
                        <button type="button" class="btn btn-danger bc_pdf" style="width:100%; display:none" onclick="fn.remove_pdf(this);">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="$('.bc,.bc_pdf').click();">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.volumes.add();">Save changes</button>
            </div>
        </div>
    </div>
</div>


<form id="form_add_photo" class="hidden" style="display:none;">
    <input id="f_Photo" name="file" type="file">
    <button type="button" id="btn_upp" onClick="fn.upload_photo_file()">UP</button>
</form>

<form id="form_add_pdf" class="hidden" style="display:none;">
    <input id="f_pdf" name="file_pdf" type="file">
    <button type="button" id="btn_upp_pdf" onClick="fn.upload_pdf_files()">UP</button>
</form>
        
        
<script>
$(document).ready(function(e) {
    $(".but_area").append('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_volumes"><i class="fa fa-plus" aria-hidden="true"></i></button>');
});
$(function(){
	var file_upload = "#f_Photo";

	fn.upload_photo = function(){
		$(file_upload).click();
		$(file_upload).unbind();
		
		$(file_upload).on("change",function(e){
			var files = this.files
			$("#btn_upp").click();    
		});
	};	
	
	fn.upload_photo_file = function(){
		var data = new FormData($("#form_add_photo")[0]);
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
					$("#path_photo").val(response.path);
					$("#txt_photo").val(response.path);
					$(".phos").attr('src',response.path);
					$(".bc").show();
					$("#f_Photo").val('');
					/*$("#tblbrand").DataTable().draw();
					$("#dialog_edit_icon").modal('hide');*/
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	};
	
	fn.remove_photo = function(me){
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
					$("#path_photo").val('');
					$("#txt_photo").val('');
					$(".phos").attr('src','');
					$(".bc").hide();
					$("#f_Photo").val('');
					fn.engine.alert("Alert",response.msg);
				}
				else
				{
					fn.engine.alert("Alert",response.msg);
				}
				
			}
		});
	};
	
	
	var file_upload_pdf = "#f_pdf";

	fn.upload_pdf = function(){
		$(file_upload_pdf).click();
		$(file_upload_pdf).unbind();
		
		$(file_upload_pdf).on("change",function(e){
			var files = this.files
			$("#btn_upp_pdf").click();    
		});
	};	
	
	fn.upload_pdf_files = function(){
		var data = new FormData($("#form_add_pdf")[0]);
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
					$("#txt_pdf").val(response.path);
					$(".pdf").html(response.path);
					$(".bc_pdf").show();
					$("#f_pdf").val('');
					/*$("#tblbrand").DataTable().draw();
					$("#dialog_edit_icon").modal('hide');*/
				}else{
					fn.check_tx_empty(".but_pdf",response.msg);
				}	
			}
		});
	};
	
	fn.remove_pdf = function(me){
		var file_path = $(me).parent().find('#txt_pdf').val();
		//alert(file_path);
		$.ajax({
			url:"apps/volumes/xhr/remove_pdf.php",
			type:"POST",
			dataType:"json",
			data:{path:file_path},
			success: function(resp){
				if(resp.status==true)
				{
					$("#txt_pdf").val('');
					$(".pdf").html('');
					$(".bc_pdf").hide();
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
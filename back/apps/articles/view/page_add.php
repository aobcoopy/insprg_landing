<br>

<!-- Modal -->
<div class="modal fade" id="add_articles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add articles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_articles">
                	<div class="form-articles">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="tx_Name" name="tx_Name" aria-describedby="emailHelp" placeholder="Name">
                    </div>
                    <div class="form-articles">
                        <label for="Name">Detail</label>
                        <textarea type="text" class="form-control editors" id="tx_Detail" name="tx_Detail" ></textarea>
                    </div>
                    <div class="form-articles">
                        <label for="Name">Volume</label>
                        <select id="cbbVolume" name="cbbVolume" class="form-control">
						<?php
							$sql= "SELECT * FROM article_volumes where status > 0 order by id desc";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo "<option value='$line[id]'>$line[name]</option>";
							}
						?>
						</select>
                    </div>
                    <div class="form-articles">
                        <br>
                        <button type="button" class="btn btn-primary but_pdf" onClick="fn.upload_photo()">Upload PDF</button>
                        <br>
                        <input type="hidden" class="paths" id="path_photo" name="path_photo">
                        <input type="hidden" name="txt_photo" id="txt_photo" ><br>
                        <span  width="100%" class=" phos"></span>
                        <button type="button" class="btn btn-danger bc" style="width:100%; display:none" onclick="fn.remove_photo(this);">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.articles.add();">Save changes</button>
            </div>
        </div>
    </div>
</div>


<form id="form_add_photo" class="hidden" style="display:none;">
    <input id="f_Photo" name="file" type="file">
    <button type="button" id="btn_upp" onClick="fn.upload_photo_file()">UP</button>
</form>


<script>
	$(document).ready(function(e) {
       $( 'textarea.editor' ).ckeditor();
    });
</script>        
<script>
$(document).ready(function(e) {
    $(".but_area").append('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_articles"><i class="fa fa-plus" aria-hidden="true"></i></button>');
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
			url: 'apps/articles/xhr/up_photo.php',
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
					$(".phos").html(response.path);
					$(".bc").show();
					/*$("#tblbrand").DataTable().draw();
					$("#dialog_edit_icon").modal('hide');*/
				}else{
					fn.check_tx_empty(".but_pdf",response.msg);
				}	
			}
		});
	};
	
	fn.remove_photo = function(me){
		var file_path = $(me).parent().find('.paths').val();
		//alert(file_path);
		$.ajax({
			url:"apps/articles/xhr/remove_photo.php",
			type:"POST",
			dataType:"json",
			data:{path:file_path},
			success: function(resp){
				if(resp.status==true)
				{
					$("#path_photo").val('');
					$("#txt_photo").val('');
					$(".phos").html('');
					$(".bc").hide();
					fn.engine.alert("Alert",response.msg);
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
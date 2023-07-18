<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$article_articles = $dbc->GetRecord("articles","*","id = '".$_REQUEST['id']."'");
?><br>
<!-- Modal -->
<div class="modal fade" id="dialog_edit_articles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit articles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_edit_articles">
                	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
                    <div class="form-articles">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="tx_E_Name" name="tx_E_Name" aria-describedby="emailHelp" placeholder="Name" value="<?php echo $article_articles['name'];?>">
                    </div>
                    <div class="form-articles">
                        <label for="Name">Detail</label>
                        <textarea type="text" class="form-control editors" id="tx_E_Detail" name="tx_E_Detail" cols="10" rows="5"><?php echo $article_articles['detail'];?></textarea>
                    </div>
                    <div class="form-articles">
                        <label for="Name">Volume</label>
                        <select id="cbb_E_Volume" name="cbb_E_Volume" class="form-control">
						<?php
							$sql= "SELECT * FROM article_volumes order by id desc";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								$act = ($line['id']==$article_articles['volumes'])?'selected':'';
								echo "<option value='$line[id]' ".$act.">$line[name]</option>";
							}
						?>
						</select>
                    </div>
                    <div class="form-articles">
                        <br>
                        <button type="button" class="btn btn-primary" onClick="fn.upload_photo()">Upload PDF</button>
                        <br>
                        <input type="hidden" class="paths" id="path_photo_E" name="path_photo_E">
                        <input type="hidden" name="tx_E_photo" id="tx_E_photo" ><br>
                        <span  width="100%" class=" E_phos_old" style="display:none;"><?php echo json_decode($article_articles['files'],true);?></span>
                        <span  width="100%" class=" E_phos"><?php echo json_decode($article_articles['files'],true);?></span>
                        <!--<img src="<?php echo json_decode($article_articles['photo'],true);?>"  width="100%" class="E_phos">-->
                        <button type="button" class="btn btn-danger bc" style="width:100%; display:none" onclick="fn.remove_E_photo(this);">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="$('.bc').click();">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.articles.save_change();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
	$("#dialog_edit_articles").modal('show');
	$("#tx_Name").focus();
	
	$("#dialog_edit_articles").on("hidden.bs.modal",function(){
		$(this).remove();
	});
});
</script>

<form id="form_E_photo" class="hidden" style="display:none;">
    <input id="f_E_Photo" name="file" type="file">
    <button type="button" id="btn_E_upp" onClick="fn.upload_E_photo_file()">UP</button>
</form>
        
 <script>
	$(document).ready(function(e) {
       $( 'textarea.editor' ).ckeditor();
    });
</script>        
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
			url: 'apps/articles/xhr/up_photo.php',
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
					$(".E_phos").html(response.path);
					$(".E_phos_old").hide();
					$(".bc").show();
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
			url:"apps/articles/xhr/remove_photo.php",
			type:"POST",
			dataType:"json",
			data:{path:file_path},
			success: function(resp){
				if(resp.status==true)
				{
					$("#path_photo").val('');
					$("#txt_photo").val('');
					$(".E_phos").html('');
					$(".E_phos_old").show();
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
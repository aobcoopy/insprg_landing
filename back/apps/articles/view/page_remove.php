<br>

<!-- Modal -->
<div class="modal fade" id="modal_remove_articles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Are you sure to remove the following ID!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<p class="lblOutput"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btnConfirm" >Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(e) {
    $(".but_area").append('<button type="button" class="btn btn-danger but_remove" onclick="fn.articles.remove();" ><i class="fa fa-remove" aria-hidden="true"></i></button>');
});
</script>

<script style="text/javascript">
	fn.articles.remove = function(){
		$('#modal_remove_articles').modal('show');
		var item_selected = $("#tb_data").data("selected");
		
		if(item_selected.length > 0){
			$("#modal_remove_articles .btnConfirm").show();
			$("#modal_remove_articles .lblOutput").html(item_selected.join());
		}else{
			$("#modal_remove_articles .lblOutput").html("No Data Selected");
			$("#modal_remove_articles .btnConfirm").hide();
		}
	},
	
	
	$("#modal_remove_articles .btnConfirm").click(function(){
		var item_selected = $("#tb_data").data("selected");
		$.post('apps/articles/xhr/remove_articles.php',{items:item_selected},function(response){
			if(response.success==true)
			{
				$("#tb_data").data("selected",[]);
				$("#tb_data").DataTable().draw();
				$('#modal_remove_articles').modal('hide');
			}
			else
			{
				alert(response.msg); $('#modal_remove_articles').modal('hide'); return false;
				
			}
		},"json");
	});
</script>
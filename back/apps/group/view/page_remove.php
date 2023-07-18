<br>

<!-- Modal -->
<div class="modal fade" id="modal_remove_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    $(".but_area").append('<button type="button" class="btn btn-danger but_remove" onclick="fn.group.remove();" ><i class="fa fa-remove" aria-hidden="true"></i></button>');
});
</script>

<script style="text/javascript">
	fn.group.remove = function(){
		$('#modal_remove_group').modal('show');
		var item_selected = $("#tb_data").data("selected");
		
		if(item_selected.length > 0){
			$("#modal_remove_group .btnConfirm").show();
			$("#modal_remove_group .lblOutput").html(item_selected.join());
		}else{
			$("#modal_remove_group .lblOutput").html("No Data Selected");
			$("#modal_remove_group .btnConfirm").hide();
		}
	},
	
	
	$("#modal_remove_group .btnConfirm").click(function(){
		var item_selected = $("#tb_data").data("selected");
		$.post('apps/group/xhr/remove_group.php',{items:item_selected},function(response){
			$("#tb_data").data("selected",[]);
			$("#tb_data").DataTable().draw();
			$('#modal_remove_group').modal('hide');
		});
	});
</script>
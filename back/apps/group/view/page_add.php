<br>

<!-- Modal -->
<div class="modal fade" id="add_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form id="form_group">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="email" class="form-control" id="tx_Name" name="tx_Name" aria-describedby="emailHelp" placeholder="Name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="fn.group.add();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(e) {
    $(".but_area").append('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_group"><i class="fa fa-plus" aria-hidden="true"></i></button>');
});
</script>
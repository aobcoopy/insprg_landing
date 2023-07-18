<script src="apps/user/js/app.js"></script>
<br>
<div class="container-fluid">
	<div class="row">
        <div class="col-md-9"><h2>User</h2></div>
        <div class="col-md-3 text-right">
            <div class="but_area"></div>
        </div>
    </div>
    <?php
		include_once "apps/user/view/page_add.php";
		//include_once "apps/user/view/page_edit.php";
		include_once "apps/user/view/page_remove.php";
		include_once "apps/user/view/page_table.php";
		
	?>
</div>
<table id="tb_data" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Mobile</th>
      <th scope="col">Email</th>
      <th scope="col">Last Login</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<script>
 /* $(function() {
	$("#panel-heading-customers").append('<button id="btnSavesort" type="button" onclick="fn.app.blog.blog.sort()" class="btn btn-info pull-right">Save Sort</button>');
	$( "#tb_data" ).children().sortable();
	$( "#tb_data " ).disableSelection();
  });*/


/*fn.app.blog.blog.sort = function(id) {
	var data = {
		tables : []			
	};
	var io=1;
	$("#tb_data tbody tr").each(function(index, element) {
		data.tables.push({
				id : $(this).find("input[name=tid]").val(),
				sort : io
			});
			io++;
	});
	
	
	$.ajax({
		url:"apps/blog/xhr/action-save-sort.php",
		type:"POST",
		dataType:"json"	,
		data:data,
		success: function(response){
			$("#tb_data").DataTable().draw();
			window.location.reload();
		}
	});   
};
*/




$(function(){
	var ii = 1;
	$("#tb_data").data( "selected", [] );
	$("#tb_data").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/customers/db/data_customers.php",
		"aoColumns": [
			{ "bSortable": false},
			{"bSort" : false, class:"rows"},
			{"bSortable": false},
			{"bSortable": false},
			{"bSortable": false},
			{"bSortable": false},
			{"bSortable": false},
			{"bSortable": false},
			{"bSortable": false , class:"text-center" }
			
		],
		//"order": [[ 0, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var selected = false;
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tb_data").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
				$(this).children('tr').addClass('table-primary');
				selected = true;
            }
			var s = '';
			s += fn.engine.datatable.checkbox('chk_customers',data[0],selected);
			$('td', row).eq(0).html(s).addClass("text-center");
			s = '';
			s += fn.engine.datatable.button('btn-primary','fa-pencil','fn.customers.change('+data[0]+')');
			/*s += ' ';
			s += fn.engine.datatable.button('btn-info','fa-check-square-o','fn.app.blog.blog.check('+data[0]+')');
			s += ' ';
			s += fn.engine.datatable.button('btn-warning','fa-calendar','fn.app.blog.blog.popup_pricing('+data[0]+')');*/
			$('td', row).eq(8).html(s);
			
			
			
			
			
			
			//var p='';
//			p+= '<img src="'+data[1][0]+'" width="100%">';
//			p+= '<input type="hidden" name="tid" value="'+data[0]+'">';
//			p+= '<input type="hidden" name="sor" value="'+ii+'">';
//			$('td', row).eq(1).html(p);
//			ii ++;
//			
//			var a = '';
//			if(data[6]==1){
//				a +='<div class="switch">';
//				a +='<input id="cmn-toggle-'+data[0]+'" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.app.edit.change_status('+data[0]+',this)">';
//				a += '<label for="cmn-toggle-'+data[0]+'"></label>';
//				a += '</div>'; 
//			}else {
//				a +='<div class="switch">';
//				a +='<input id="cmn-toggle-'+data[0]+'" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.app.edit.change_status('+data[0]+',this)">';
//				a += ' <label for="cmn-toggle-'+data[0]+'"></label>';
//				a += '</div>';
//			}
//			$('td', row).eq(6).html(a);
//			
//			a = '';
//			if(data[7]==1){
//				a +='<div class="switch">';
//				a +='<input id="cmn-toggle-a-'+data[0]+'" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.app.edit.change_heightlight('+data[0]+',this,'+data[7]+')">';
//				a += '<label for="cmn-toggle-a-'+data[0]+'"></label>';
//				a += '</div>'; 
//			}else {
//				a +='<div class="switch">';
//				a +='<input id="cmn-toggle-a-'+data[0]+'" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.app.edit.change_heightlight('+data[0]+',this,'+data[7]+')">';
//				a += ' <label for="cmn-toggle-a-'+data[0]+'"></label>';
//				a += '</div>';
//			}
//			$('td', row).eq(7).html(a);
		}
	});
	fn.engine.datatable.add_selectable('tb_data','chk_customers');
	
});
</script>
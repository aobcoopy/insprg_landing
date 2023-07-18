<table id="tb_data" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Volume</th>
      <th scope="col">Name</th>
      <th scope="col">Detail</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
      <th scope="col">User</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<script>
//  $(function() {
////	$("#panel-heading-articles").append('<button id="btnSavesort" type="button" onclick="fn.app.blog.blog.sort()" class="btn btn-info pull-right">Save Sort</button>');
//	$(".but_area").append('<button type="button" class="btn btn-info" title="Save Sort" onclick="fn.savesort()"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i></button>');
//	$( "#tb_data" ).children().sortable();
//	$( "#tb_data " ).disableSelection();
//  });
//
//
//fn.savesort = function(id) {
//	var data = {
//		tables : []			
//	};
//	var io=1;
//	$("#tb_data tbody tr").each(function(index, element) {
//		data.tables.push({
//				id : $(this).find("input[name=tid]").val(),
//				sort : io
//			});
//			io++;
//	});
//	
//	
//	$.ajax({
//		url:"apps/articles/xhr/save_sort.php",
//		type:"POST",
//		dataType:"json"	,
//		data:data,
//		success: function(response){
//			$("#tb_data").DataTable().draw();
//			window.location.reload();
//		}
//	});   
//};





$(function(){
	var ii = 1;
	$("#tb_data").data( "selected", [] );
	$("#tb_data").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/articles/db/data_articles.php",
		"aoColumns": [
			{ "bSortable": false},
			{"bSort" : false, class:"rows"},
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
			s += fn.engine.datatable.checkbox('chk_articles',data[0],selected);
			$('td', row).eq(0).html(s).addClass("text-center");
			s = '';
			s += fn.engine.datatable.button('btn-primary','fa-pencil','fn.articles.change('+data[0]+')');
			s += ' ';
			s += '<a href="'+data[8]+'"><button class="btn btn-success btn-rounded btn-condensed btn-sm" title="Download"><i class="fa fa-download"></i></button></a>';
			//fn.engine.datatable.button('btn-success','fa-download','fn.articles.change('+data[8]+')','Download');
			/*s += ' ';
			s += fn.engine.datatable.button('btn-info','fa-check-square-o','fn.app.blog.blog.check('+data[0]+')');
			s += ' ';
			s += fn.engine.datatable.button('btn-warning','fa-calendar','fn.app.blog.blog.popup_pricing('+data[0]+')');*/
			$('td', row).eq(7).html(s);
			
			
			
			
			
			
			//var p='';
//			p+= '<img src="'+data[1]+'" width="150">';
//			p+= '<input type="hidden" name="tid" value="'+data[0]+'">';
//			p+= '<input type="hidden" name="sor" value="'+ii+'">';
//			$('td', row).eq(1).html(p);
//			ii ++;
			
			var a = '';
			if(data[4]==1){
				a +='<div class="switch">';
				a +='<input id="cmn-toggle-'+data[0]+'" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.articles.change_status('+data[0]+',this)">';
				a += '<label for="cmn-toggle-'+data[0]+'"></label>';
				a += '</div>'; 
			}else {
				a +='<div class="switch">';
				a +='<input id="cmn-toggle-'+data[0]+'" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.articles.change_status('+data[0]+',this)">';
				a += ' <label for="cmn-toggle-'+data[0]+'"></label>';
				a += '</div>';
			}
			$('td', row).eq(4).html(a);
			
			//a = '';
//			if(data[5]==1){
//				a +='<div class="switch">';
//				a +='<input id="cmn-toggle-a-'+data[0]+'" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.articles.change_latest('+data[0]+',this)">';
//				a += '<label for="cmn-toggle-a-'+data[0]+'"></label>';
//				a += '</div>'; 
//			}else {
//				a +='<div class="switch">';
//				a +='<input id="cmn-toggle-a-'+data[0]+'" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.articles.change_latest('+data[0]+',this)">';
//				a += ' <label for="cmn-toggle-a-'+data[0]+'"></label>';
//				a += '</div>';
//			}
//			$('td', row).eq(5).html(a);
		}
	});
	fn.engine.datatable.add_selectable('tb_data','chk_articles');
	
});
</script>
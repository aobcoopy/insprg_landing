// JavaScript Document
var group = {
	add:function()
	{
		if($("#tx_Name").val()=='')
		{
			fn.check_tx_empty("#tx_Name","Please fill your data");
		}
		else
		{
			$.ajax({
				url:"apps/group/xhr/add_group.php",
				type:"POST",
				dataType:"json",
				data:$("#form_group").serialize(),
				success: function(res){
					if(res)
					{
						$("#add_group").modal('hide');
						$(".table").DataTable().draw();
						$("#tx_Name").val('');
					}
					else
					{
					}
				}
			});
		}
	},
	change:function(id)
	{
		$.ajax({
			url: "apps/group/view/page_edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	},
	save_change:function()
	{
		if($("#tx_Name_e").val()=='')
		{
			fn.check_tx_empty("#tx_Name_e","Please fill your data");
		}
		else
		{
			$.ajax({
				url: "apps/group/xhr/edit_group.php",
				data: $("#form_edit_group").serialize(),
				type: "POST",
				dataType: "json",
				success: function(html){
					$("#dialog_edit_group").modal('hide');
					$(".table").DataTable().draw();
				}	
			});
		}
	}
};


$.extend(fn,{group:group});



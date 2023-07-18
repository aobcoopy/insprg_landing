// JavaScript Document
var volumes = {
	change_status:function(id){
		$.ajax({
				url: "apps/volumes/xhr/change_status.php",
				type: "POST",
				dataType:"json",
				data: {id:id},
				success : function(response)
				{
					if(response.success){
						$(".table").DataTable().draw();
					}else{
						//fn.engine.alert("Alert",response.msg);
					}
				}
		});
	},
	change_latest:function(id){
		$.ajax({
				url: "apps/volumes/xhr/change_latest.php",
				type: "POST",
				dataType:"json",
				data: {id:id},
				success : function(response)
				{
					if(response==true){
						$(".table").DataTable().draw();
					}else{
						//fn.engine.alert("Alert",response.msg);
					}
				}
		});
	},
	add:function()
	{
		if($("#tx_Name").val()=='')
		{
			fn.check_tx_empty("#tx_Name","Please fill your data");
		}
		else
		{
			$.ajax({
				url:"apps/volumes/xhr/add_volumes.php",
				type:"POST",
				dataType:"json",
				data:$("#form_volumes").serialize(),
				success: function(res){
					if(res.success==true)
					{
						$("#add_volumes").modal('hide');
						$(".table").DataTable().draw();
						$(".form-control").val('');
						$(".phos").attr('src','');
						$(".bc").hide();
						$("#f_Photo").val('');
						$("#path_photo").val('');
						$("#txt_photo").val('');
						$("#txt_pdf").val('');
						$(".pdf").html('');
						$(".bc_pdf").hide();
						$("#f_pdf").val('');
					}
					else
					{
						alert(res.msg);
						return false;
					}
				}
			});
		}
	},
	change:function(id)
	{
		$.ajax({
			url: "apps/volumes/view/page_edit.php",
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
		if($("#tx_E_Firstname").val()=='')
		{
			fn.check_tx_empty("#tx_E_Firstname","Please fill your data");
		}
		else if($("#tx_E_Lastname").val()=='')
		{
			fn.check_tx_empty("#tx_E_Lastname","Please fill your data");
		}
		else if($("#tx_E_Mobile").val()=='')
		{
			fn.check_tx_empty("#tx_E_Mobile","Please fill your data");
		}
		else if($("#tx_E_Email").val()=='')
		{
			fn.check_tx_empty("#tx_E_Email","Please fill your data");
		}
		else
		{
			$.ajax({
				url: "apps/volumes/xhr/edit_volumes.php",
				data: $("#form_edit_volumes").serialize(),
				type: "POST",
				dataType: "json",
				success: function(html){
					if(html.success==true)
					{
						$("#dialog_edit_volumes").modal('hide');
						$(".table").DataTable().draw();
						window.location.reload();
					}
					else
					{
						fn.check_tx_empty("#tx_E_volumesname",html.msg);
						return false;
					}
				}	
			});
		}
	}
};


$.extend(fn,{volumes:volumes});



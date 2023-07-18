// JavaScript Document
var articles = {
	change_status:function(id){
		$.ajax({
				url: "apps/articles/xhr/change_status.php",
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
				url: "apps/articles/xhr/change_latest.php",
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
				url:"apps/articles/xhr/add_articles.php",
				type:"POST",
				dataType:"json",
				data:$("#form_articles").serialize(),
				success: function(res){
					if(res.success==true)
					{
						$("#add_articles").modal('hide');
						$(".table").DataTable().draw();
						$(".form-control").val('');
						$("#form_articles")[0].reset();
						$(".bc").hide();
						$(".phos").html('');
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
			url: "apps/articles/view/page_edit.php",
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
				url: "apps/articles/xhr/edit_articles.php",
				data: $("#form_edit_articles").serialize(),
				type: "POST",
				dataType: "json",
				success: function(html){
					if(html.success==true)
					{
						$("#dialog_edit_articles").modal('hide');
						$(".table").DataTable().draw();
					}
					else
					{
						fn.check_tx_empty("#tx_E_articlesname",html.msg);
						return false;
					}
				}	
			});
		}
	}
};


$.extend(fn,{articles:articles});



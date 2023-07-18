
<div class="container">
	<div class="row">
    	<div class="col-12">
        	<br><br>
        	<h1>Search : <?php echo $_GET['val'];?></h1><br>
			
            
            <div class="row">
				<div class="col-sm-12 col-sm-12 col-md-10">
				<?php 
				$search = $_GET['val'];
				$sql = $dbc->Query("SELECT detail,name,files,status FROM articles WHERE detail LIKE '%".$search."%' OR name LIKE '%".$search."%'  ");
				//$sql = $dbc->Query("SELECT name,files,FROM_BASE64(detail) AS detail FROM articles WHERE name LIKE '%".$search."%' OR detail LIKE '%".$search."%'  ");
				$a=0;
				while($row = $dbc->Fetch($sql))
				{
					if($row['status'] >0)
					{
					$detail = $row['detail'];//= base64_decode($row['detail'],true);
					echo '<div class="col-sm-12 col-sm-12 col-md-12 a_box nopad">';
						echo '<div class="col-sm-12 col-sm-12 col-md-12 a_title nopad">';
							echo '<span class="inside_art">Article</span>';
						echo '</div>';
						echo '<div class="col-sm-12 col-sm-12 col-md-12 a_name nopad">';
							echo '<a href="'.json_decode($row['files'],true).'" class="a_link">'.$detail.'</a>';
						echo '</div>';
						echo '<div class="col-sm-12 col-sm-12 col-md-12 nopad">';
							echo '<i class="fa fa-bookmark ifa" aria-hidden="true"></i> ';
							echo $row['name'];
						echo '</div>';
					echo '</div>';
					//echo $row['status'];
					$a++;
					}
				}
				if($a==0)
				{
					?>
					<div class="alert alert-primary" role="alert">
                      <i class="fa fa-info-circle" aria-hidden="true"></i> Not found
                    </div>
                    <?php
				}
				?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-2"><img src="<?php echo json_decode($data['photo'],true);?>" width="100%"></div>
			</div>
            
            
          
        </div>
    </div>
</div>
<script>
function reset_password()
{
	var pass = $("#tx_New_password").val();
	var str_pass = pass.length;
	
	if($("#tx_Old_password").val()=='')
	{
		alert_text('tx_Old_password');
	}
	else if($("#tx_New_password").val()=='')
	{
		alert_text('tx_New_password');
	}
	else if($("#tx_re_password").val()=='')
	{
		alert_text('tx_re_password');
	}
	else
	{
		if($("#tx_New_password").val()!=$("#tx_re_password").val())
		{
			alert('password is mismatch');
			$("#tx_re_password").focus();
			return false;
		}
		else
		{
			if(str_pass<6)
			{
				$(".alert-danger").fadeIn(300);
				$(".alttext").html('Please fill your password 6-8 character');
			}
			else
			{
				$(".alert").hide();
				$.ajax({
					url:"libs/actions/reset_password.php",
					type:"POST",
					dataType:"json",
					data:$("#reset_pass").serialize(),
					success: function(res){
						if(res.status == true)
						{
							$(".alert-success").fadeIn(300);
							$(".alttext").html(res.msg);
							setTimeout(function(){
								$(".alert-success").fadeOut(300);
								window.location.reload();
							},3000);
						}
						else
						{
							$(".alert-danger").fadeIn(300);
							$(".alttext").html(res.msg);
							/*setTimeout(function(){
								$(".alert-danger").fadeOut(300);
							},3000);*/
						}
					}
				});
			}
		}
	}
}
function alert_text(input)
{
	alert('Please fill your data');
	$("#"+input).focus();
	return false;
}

</script>
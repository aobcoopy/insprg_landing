<?php
	/**/session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
    include_once "../../inc/functions.inc.php";
    	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);
	
	if(count($_SESSION['recent'])>0)
	{
		?>
	<div class="mg-best-rooms catego h_recen" >
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2" >
						<center>
						<h2 class="mtop255" style="    text-transform: uppercase;" > Interested in one of your recently viewed villas?<?php /*?>Luxury Private Villas for Rent in Phuket & Koh Samui, Thailand<?php */?>  </h2>
						<?php /*?><h2 class="f16" style="    font-family: pt !important;">Discover Private Pool Villas For Rent</h2><?php */?>
						</center>
					<br>
					<div class="row">
					<?php
					echo '<div class="col-md-12 nopad">';
					$zx=1;
					if(isset($_SESSION['recent']))
					{
						foreach($_SESSION['recent'] as $idv)
						{
							$rec = $dbc->GetRecord("properties","*","id='".$idv."' ");
							$v_name = explode("|",$rec['name']);
							$v_photo = json_decode($rec['photo'],true);
							
								echo '<div class="col-md-4 col-sm-6 col-xs-12 top10 nopad">';
									echo '<div class="col-md-12">';
										echo '<a href="/'.$rec['ht_link'].'.html">';
											echo '<img class="lazy" data-src="'.imagePath($v_photo[0]['img']).'" alt="'.$v_name[0].'" width="100%">';
										echo '</a>';
									echo '</div>';
									echo '<div class="col-md-12 text_bottom top10 f12">';
										echo '<h4 class="media-heading f18">'.$v_name[0].'</h4>';
										echo base64_decode($rec['brief'],true);
									echo '</div>';
								echo '</div>';
								
						if(($zx%3)==0)
						{
							echo '</div>';
							echo '<div class="col-md-12 nopad">';
						}
						$zx++;
						}
					}
					echo '</div>';
					?>
					
					
				</div>
			</div>
		</div>
	</div>
	<br>
	<?php
	}
	?>

<script>
$(document).ready(function(e) {
    $(".lazy").lazyload();
});
</script>
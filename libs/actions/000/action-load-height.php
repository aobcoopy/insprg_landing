<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);

	$l=0;
	$sql = $dbc->Query("select * from properties where id='13' OR id='178' OR id='8' OR id='149' and status > 0 order by nob asc");
	while($line_long = $dbc->Fetch($sql))
	{
		//$line_long = $dbc->GetRecord("properties","*","id='".$da['id']."'");
		$img_long = json_decode($line_long['photo'],true);
		$vname = explode("|",$line_long['name']);
		$ac = ($l==0)?'active':'';
		echo '<div class="col-md-3 col-sm-6 col-xs-12 bottom15 top15">';
			echo '<a href="/'.$line_long['ht_link'].'.html"><img class="lazy" data-src="'.$img_long[0]['img'].'" alt="'.$vname[0].'" width="100%" alt="...">';
			echo '</a>';
			echo '<div class="text-center col-md-12 top15 fnb">';
				echo $vname[0];//.''.$line_long['id'];
			echo '</div>';
			echo '<div class="text-center col-md-12 top15 bbdet">';
				echo string_len(base64_decode($line_long['detail'],true),90);
			echo '</div>';
			echo '<div class="text-center col-md-12 top15 ">';
				//echo $line_long['actualbed'].' Bedrooms';
				switch($line_long['id'])
				{
					case '13':
						echo  "Chan Grajang 4-6 Bedrooms";
					break;
					case '178':
						echo  "Villa Thousand Hills 2-9 Bedrooms";
					break;
					case '8':
						echo  "Villa Yang 3 Bedrooms";
					break;
					case '149':
						echo  "Makata Villa 3-6 Bedrooms";
					break;
				}
			echo '</div>';
			echo '<div class="text-center col-md-12 top15 ">';
				echo '$'.$line_long['pmin'].' - $'.$line_long['pmax'];
			echo '</div>';
			echo '<div class="text-center col-md-12 top15 ">';
				echo '<a class="tb btnnl" href="/'.$line_long['ht_link'].'.html">View More </a>';
			echo '</div>';
		echo '</div>';
		$l++;
	}
$dbc->Close();

function string_len($text,$amount)
{
	if(strlen($text)>$amount)
	{
		return substr($text,0,$amount).'...';
	}
	else
	{
		return $text;
	}
}
?>
<script>
$(document).ready(function(e) {
    $(".lazy").lazyload();
});
</script>
<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
    include_once "../../inc/functions.inc.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);

	$sql_blog = $dbc->Query("select * from blogs where status > 0 order by sort asc limit 3");
	while($r_blog = $dbc->Fetch($sql_blog))
	{
		$pho = json_decode($r_blog['photo'],true);
		$rid = $r_blog['id'];
		if($r_blog['id']==7)
		{
			$urll = "/blog/the-10-best-phuket-luxury-villas.html";
			$link = "http://www.inspiringvillas.com//lifestyle/top-10-phuket-luxury-villas.html";
		}
		else
		{
			$urll = "/Lifestyle-".$rid.".html";
			$link = "http://www.inspiringvillas.com/Lifestyle-'".$r_blog['id'].".html'";
		}
		
		echo '<div class="col-xs-12 col-sm-6 col-md-4">';
			echo '<div class="col-md-12 boxpho nopad">';
				echo '<a href="'.$urll.'" class="btnnl pull-right" ><img class="lazy" data-src="'.imagePath($pho[0]).'" alt="'.$r_blog['name'].'" width="100%"></a>';
			echo '</div>';
			echo '<div class="col-md-12 boxbot_b nopad">';
				echo '<div class="col-md-12 borbo nopad">';
					echo '<h2 class="btitle" style="font-family:pr !important;" >'.$r_blog['name'].'</h2>'; 
				echo '</div>';
				echo '<div class="col-md-12 ddet  nopad" style="font-size: 14px; font-family:pt !important;">';
					echo string_len(base64_decode($r_blog['snippet'],true),100);
				echo '</div>';
				echo '<div class="col-md-12  nopad" style="margin-top: 10px;margin-bottom: 13px;">';
				echo '<a href="'.$urll.'" class="btnnl pull-right" style="color:#000; font-size:13px;font-family:pr !important;line-height: 1.1;">READ MORE</a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
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
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

	$sql_cate = $dbc->Query("select * from categories where status > 0 order by sort asc limit 2,4");
				$zz=0;
				while($r_cate = $dbc->Fetch($sql_cate))
				{
					$nam = explode("-",$r_cate['name']);
					$pho = json_decode($r_cate['photo'],true);
					if($zz<=1){$cal="top-40px";}else{$cal="";}
					$zz++;
					echo '<div class="col-sm-6 col-md-6 '.$cal.'">';
						echo '<a href="/'.$r_cate['ht_link'].'.html"><div class="col-md-12 col-sm-12 col-xs-12 boxpho nopad">';
							echo '<img class="lazy" data-src="'.$pho.'" width="100%" alt="'.switchcase_sort($r_cate['id']).'">';
							echo '<div class="ca_box_name">'.switchcase_sort($r_cate['id']).'</div>';
						echo '</div></a>';
						echo '<div class="col-md-12 col-sm-12 col-xs-12  nopad">';
							echo '<div class="col-xs-6 col-sm-6 col-md-6  bpl">';
								echo '<a href="/search-rent/thailand-phuket/all-beach/all-price/all-bedrooms/'.collection_home($r_cate['id']).'/all-sort.html">';//echo '<a href="/'.$r_cate['ht_link'].'.html">';
								echo '<div class="col-md-12 col-sm-12 col-xs-12 boxbot nopad ">';
									echo '<center>Phuket </center>';
								echo '</div>';
								echo '</a>';
							echo '</div>';
							echo '<div class="col-xs-6 col-sm-6 col-md-6  bpr">';
								echo '<a href="/search-rent/thailand-koh-samui/all-beach/all-price/all-bedrooms/'.collection_home($r_cate['id']).'/all-sort.html">';//echo '<a href="/'.$r_cate['ht_link'].'.html">';
								echo '<div class="col-md-12 col-sm-12 col-xs-12 boxbot nopad ">';
									echo '<center>Koh Samui</center>';
								echo '</div>';
								echo '</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					
				}
				function collection_home($option)
				{
					switch($option)
					{
						case "2" :
							return "party-villas";
						break;
						case "3" :
							return "family-villas";
						break;
						case "4" :
							return "seaview-villas";
						break;
						case "5" :
							return "larger-group-villas";
						break;
						case "6" :
							return "beachfront-villas";
						break;
						case "8" :
							return "wedding-villas";
						break;
						default:
							return "all-collections";
					}
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

function switchcase_sort($val)
{
	switch($val)
	{
		case "2":
			return "Party Villa";
		break;
		case "3":
			return "Family Villas";
		break;
		case "4":
			return "Seaview Villas";
		break;
		case "5":
			return "Large Group Villas";
		break;
		case "6":
			return "Beachfront Villas";
		break;
		case "8":
			return "Wedding Villas";
		break;
		default:
	}
}
?>
<script>
$(document).ready(function(e) {
    $(".lazy").lazyload();
});
</script>
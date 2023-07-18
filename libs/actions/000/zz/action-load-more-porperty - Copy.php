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
	
	/*$Destination = $_REQUEST['des'];
	$beach = $_REQUEST['sub'];
	$price = $_REQUEST['pri'];*/
	
	$starts = $_REQUEST['starts'];
	//$arr_room = print_r($_REQUEST['room']);
	//print_r($_REQUEST['room']);
	
	
	$Destination='';
	if(isset($_REQUEST['des']))
	if($_REQUEST['des']!='null')
	{
		if($_REQUEST['des']=='all')//all price
		{
			$Destination="";
		}
		else// > 1000
		{
			$Destination="AND destination = '".$_REQUEST['des']."'";
		}
	}
	else
	{
		$Destination="";
	}
	
	$beach='';
	if(isset($_REQUEST['sub']))
	if($_REQUEST['sub']!='null')
	{
		if($_REQUEST['sub']=='all')//all price
		{
			$beach="";
		}
		else// > 1000
		{
			$beach="AND subdestination = '".$_REQUEST['sub']."'";
		}
	}
	else
	{
		$beach="";
	}
	
	$price='';
	if(isset($_REQUEST['pri']))
	if($_REQUEST['pri']!='null')
	{
		if($_REQUEST['pri']=='all')//all price
		{
			$price="";
		}
		elseif($_REQUEST['pri']=='2')// < 1000
		{
			$price="AND price < 1000";
		}
		else// > 1000
		{
			$price="AND price > 1000";
		}
		
	}
	else
	{
		$price="";
	}
	



if(isset($_REQUEST['room']) && $_REQUEST['room']!='all')
{
	$sql_room = "INNER JOIN property_room ON properties.id = property_room.property";
	if($_REQUEST['room']==3 || $_REQUEST['room']==4)
	{
		$w_room = "AND property_room.room  BETWEEN 3 AND 4 ";
	}
	else
	{
		$w_room = "AND property_room.room = '".$_REQUEST['room']."' ";
	}
	//$w_room = "AND property_room.room = '".$_REQUEST['room']."' ";
}
else
{
	$w_room = "";
	
}//echo '--->'.$_REQUEST['room'];

//echo $_REQUEST['cate'];
if(isset($_REQUEST['cate']))
{
	if($_REQUEST['cate']!=0)
	{
		$w_cate = "AND property_cate.caategory = '".$_REQUEST['cate']."' ";
	}
	else
	{
		$w_cate = "";
	}
}
										
										
	$sql = $dbc->Query("SELECT
				properties.id AS id,
				properties.`name`,
				properties.brief,
				properties.short_det,
				properties.photo,
				properties.features,
				properties.price,
				properties.status,
				properties.destination AS destination,
				properties.bedroom,
				properties.tag,
				properties.price_range,
				properties.actualbed,
				properties.ht_link,
				properties.subdestination,
				properties.pmin,
				properties.pmax,
				property_cate.caategory
				FROM
				properties
				".$sql_room."
				LEFT JOIN property_cate ON properties.id = property_cate.property
				WHERE
				properties.status > 0 
				".$Destination."
				".$beach."
				".$price."
				".$w_room."
				".$w_cate."
				GROUP BY
				properties.id
				ORDER BY actualbed asc limit ".$starts.",5
			");//room = 1 AND    caategory = 4






	
//	echo $starts."^^^^^ <br><hr>";
//	
//	if($starts==15)
//	{
//		echo "<br><br>";
//	}
	
	//echo "select * from properties   where status > 0 ".$Destination." ".$beach." ".$price."  ORDER BY actualbed asc limit 15,15  ";
//$sql = $dbc->Query("select * from properties   where status > 0 ".$Destination." ".$beach." ".$price."  ORDER BY actualbed asc limit ".$starts.",15  ");//".$Room."
//$sql__1 = $dbc->Query("select * from properties   where status > 0 ".$Destination." ".$beach." ".$price."  ORDER BY actualbed asc  ");//".$Room."
//$num = $dbc->Getnum($sql__1);
//
//
//include "libs/pages/fr_count.php";



$view = $_REQUEST['view'];
$zz = $starts+1;
while($row =  $dbc->Fetch($sql))
{
   /* $laa = $row['latitude'];
    $loo = $row['longtitude'];
    $amap = array(
        'la' => $row['latitude'],
        'lo' => $row['longtitude']
    );
    array_push($arr_map,$amap);*/
    
    if($row['tag']!=0)
    {
        $tag = $dbc->GetRecord("tags","*","id = '".$row['tag']."' ");
        $tag_name = $tag['name'];
    }
    
    $name = explode("|",$row['name']);
    $photo = json_decode($row['photo'],true);
	
	if($view=='grid')
	{
		//echo '<div class="col-xs-12 col-sm-6 col-md-6">';//<a href="?page=blogdetail&blog='.$r_blog['id'].'">
//                        echo '<div class="col-md-12 boxpho nopad">';
//                            if($row['tag']!=0)
//                            {
//                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
//                            }
//                            echo '<a href="/'.$row['ht_link'].'.html" target="_blank">'.slide_photo($photo,$row['id']).'</a>';
//                        echo '</div>';
//                        echo '<div class="col-md-12 boxbot_b nopad">';
//                            echo '<div class="col-md-12 borbo nopad">';
//                                echo '<div class="col-md-9 nopad">';
//                                    echo '<h2 class="btitle" ><strong><span itemprop="name">'.$name[0].'</span></strong></h2>'; 
//                                echo '</div>';
//                                echo '<div class="col-md-3 nopad text-right" style="font-size:14px;margin-top: 22px;">';
//                                $rev = $dbc->GetCount("rating","property=".$row['id']);
//                                    echo $rev.' Reviews'; 
//                                echo '</div>';
//                            echo '</div>';
//                            
//                            echo '<div class="col-md-12 nopad">';
//                                echo '<div class="col-sm-8 nopad" style="font-size: 14px;">';
//                                $ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' limit 1");
//                                while($line = $dbc->Fetch($ch_prop))
//                                {
//                                    $icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
//                                                echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
//                                                echo '&nbsp;&nbsp;'.$icon['name'];
//                                }
//                                    echo '<br>'.string_len(base64_decode($row['brief'],true),40);
//                                echo '</div>';
//                                echo '<div class="col-sm-4 nopad text-right">';
//                                    echo '<span  style="font-size: 12px;    float: left;    padding-left: 30px;">FROM </span><br>';
//                                    echo '<span style="font-size: 32px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($row['price']).'</span>';
//                                    echo '<span style="font-size: 12px;">++ /NT</span>';
//                                echo '</div>';
//                            echo '</div>';
//
//                        echo '</div>';
//                    
//                echo '</div>';
//                echo '<!--room-->';
	}
	else
	{
		//echo '--->'.$row['id'];
		echo '<!--room-->';
			echo '<div class="mg-avl-room">';
				echo '<div class="row">';
					echo '<div class="col-xs-12 col-sm-6">';
					if($row['tag']!=0)
					{
						echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
					}
						echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
						echo slide_photo($photo,$row['id']);
						//echo '<img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
					echo '</div>';
					echo '<div class="col-xs-12 col-sm-6">';
						echo '<h2 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;"><span itemprop="name">'.$name[0].'</span></a> <!--<span>$249<sup>.99</sup>/Night</span>--></h2>';
						echo '<span itemprop="description">'.base64_decode($row['brief']).'</span><br>';
						//echo '<span style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.number_format($row['price']).' ++ /NT</span>';
						//echo '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price" style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
						echo '<span ><span style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
						?>
						<span class="hidden" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
							Price Range 
							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
							-
							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
						</span>
							<?php
						echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
						echo '<div class="gray_mob">';
							echo '<div class="row mg-room-fecilities">';
								$ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
								$b=0;
								while($line = $dbc->Fetch($ch_prop))
								{
									$b++;
									if($b<=6)
									{
										$icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
										echo '<div class="col-xs-6 col-sm-6">';
											echo '<ul>';
												echo '<li>';
													echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
													echo '&nbsp;&nbsp;'.$icon['name'];
												echo '</li>';
											echo '</ul>';
										echo '</div>';
									}
								}
							echo '</div>';
							echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '<!--room-->';
		
		if($zz=='3' || $zz=='8' || $zz=='13')
		{
			echo '<button class="bad"><strong>receive $150</strong> off any excursion booking during your villa stay with us*</button>';
		}
		$zz++;	
	}
	
	
	
    //////////////echo '*************'.$_REQUEST['cate'];
////////////    if(isset($_REQUEST['cate']) && $_REQUEST['cate']!=0)
////////////    {
////////////        if(count($arr_room)>0)
////////////        {
////////////            //echo '++++++++ set room<br>';
////////////            if(in_array($row['id'],$arr_cate))
////////////            {
////////////                if(in_array($row['id'],$arr_room))
////////////                {
////////////                    //echo $row['id'].'----'.$arr_cate[0];
////////////                $photo = json_decode($row['photo'],true);
////////////                echo '<!--room-->';
////////////                    echo '<div class="mg-avl-room">';
////////////                        echo '<div class="row">';
////////////                            echo '<div class="col-sm-6">';
////////////                            if($row['tag']!=0)
////////////                            {
////////////                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
////////////                            }
////////////                                echo '<a href="/'.$row['ht_link'].'.html" target="_blank">'.slide_photo($photo,$row['id']).'</a>';
////////////                                //echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
////////////                            echo '</div>';
////////////                            echo '<div class="col-sm-6">';
////////////                                echo '<h2 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;"><span itemprop="name">'.$name[0].'</span></a> </h2>';
////////////                                echo '<span itemprop="description">'.base64_decode($row['brief']).'</span><br>';
////////////                                echo '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price" style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
////////////                                echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
////////////                                echo '<div class="row mg-room-fecilities">';
////////////                                    $ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
////////////                                    $b=0;
////////////                                    while($line = $dbc->Fetch($ch_prop))
////////////                                    {
////////////                                        $b++;
////////////                                        if($b<=6)
////////////                                        {
////////////                                            $icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
////////////                                            echo '<div class="col-xs-6 col-sm-6">';
////////////                                                echo '<ul>';
////////////                                                    echo '<li>';
////////////                                                        echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
////////////
////////////                                                        echo '&nbsp;&nbsp;'.$icon['name'];
////////////                                                    echo '</li>';
////////////                                                echo '</ul>';
////////////                                            echo '</div>';
////////////                                        }
////////////                                    }
////////////                                echo '</div>';
////////////                                echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
////////////                            echo '</div>';
////////////                        echo '</div>';
////////////                    echo '</div>';
////////////                    echo '<!--room-->';
////////////                }
////////////                
////////////            }
////////////        }
////////////        else
////////////        {
////////////            //echo '------- not set room<br>';
////////////            if(in_array($row['id'],$arr_cate))
////////////            {
////////////                //echo $row['id'].'----'.$arr_cate[0];
////////////                $photo = json_decode($row['photo'],true);
////////////                
////////////                echo '<!--room-->';
////////////                    echo '<div class="mg-avl-room">';
////////////                        echo '<div class="row">';
////////////                            echo '<div class="col-sm-6">';
////////////                            if($row['tag']!=0)
////////////                            {
////////////                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
////////////                            }
////////////                                echo '<a href="/'.$row['ht_link'].'.html" target="_blank">'.slide_photo($photo,$row['id']).'</a>';
////////////                                //echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
////////////                            echo '</div>';
////////////                            echo '<div class="col-sm-6">';
////////////                                echo '<h2 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;"><span itemprop="name">'.$name[0].'</span></a> </h2>';
////////////                                echo '<span itemprop="description">'.base64_decode($row['brief']).'</span><br>';
////////////                                echo '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price" style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
////////////                                echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
////////////                                echo '<div class="row mg-room-fecilities">';
////////////                                    $ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
////////////                                    $b=0;
////////////                                    while($line = $dbc->Fetch($ch_prop))
////////////                                    {
////////////                                        $b++;
////////////                                        if($b<=6)
////////////                                        {
////////////                                            $icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
////////////                                            echo '<div class="col-xs-6 col-sm-6">';
////////////                                                echo '<ul>';
////////////                                                    echo '<li>';
////////////                                                        echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
////////////                                                        echo '&nbsp;&nbsp;'.$icon['name'];
////////////                                                    echo '</li>';
////////////                                                echo '</ul>';
////////////                                            echo '</div>';
////////////                                        }
////////////                                    }
////////////                                echo '</div>';
////////////                                echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
////////////                            echo '</div>';
////////////                        echo '</div>';
////////////                    echo '</div>';
////////////                    echo '<!--room-->';
////////////            }
////////////        }
////////////    }
////////////    //if(isset($_REQUEST['cate']) && $_REQUEST['cate']!=0)
////////////    else //////////////////////////////////////////////////   no collection    /////////////////////////////////////////////////////////////
////////////    {
////////////        $photo = json_decode($row['photo'],true);
////////////        if(count($arr_room)>0)
////////////        {
////////////            if(in_array($row['id'],$arr_room))
////////////            {
////////////                //echo '>>>>>>>>>'.$row['id'].'<br>';
////////////                if($view=='grid')
////////////                {
////////////                    //echo '<div class="col-xs-12 col-sm-6 col-md-6">';//<a href="?page=blogdetail&blog='.$r_blog['id'].'">
//////////////                            echo '<div class="col-md-12 boxpho nopad">';
//////////////                                if($row['tag']!=0)
//////////////                                {
//////////////                                    echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
//////////////                                }
//////////////                                echo '<a href="/'.$row['ht_link'].'.html" target="_blank">'.slide_photo($photo,$row['id']).'</a>';
//////////////                                //echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" width="100%"></a>';
//////////////                            echo '</div>';
//////////////                            echo '<div class="col-md-12 boxbot_b nopad">';
//////////////                                echo '<div class="col-md-12 borbo nopad">';
//////////////                                    echo '<div class="col-md-9 nopad">';
//////////////                                        echo '<h2 class="btitle" ><strong>'.$row['name'].'</strong></h2>'; 
//////////////                                    echo '</div>';
//////////////                                    echo '<div class="col-md-3 nopad text-right" style="font-size:14px;margin-top: 22px;">';
//////////////                                    $rev = $dbc->GetCount("rating","property=".$row['id']);
//////////////                                        echo $rev.' Reviews'; 
//////////////                                    echo '</div>';
//////////////                                echo '</div>';
//////////////                                
//////////////                                echo '<div class="col-md-12 nopad">';
//////////////                                    echo '<div class="col-sm-8 nopad" style="font-size: 14px;">';
//////////////                                    $ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' limit 1");
//////////////                                    while($line = $dbc->Fetch($ch_prop))
//////////////                                    {
//////////////                                        $icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
//////////////                                                    echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
//////////////                                                    echo '&nbsp;&nbsp;'.$icon['name'];
//////////////                                    }
//////////////                                        echo '<br>'.string_len(base64_decode($row['brief'],true),40);
//////////////                                    echo '</div>';
//////////////                                    echo '<div class="col-sm-4 nopad text-right">';
//////////////                                        echo '<span  style="font-size: 12px;    float: left;    padding-left: 30px;">FROM </span><br>';
//////////////                                        echo '<span style="font-size: 32px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($row['price']).'</span>';
//////////////                                        echo '<span style="font-size: 12px;">++ /NT</span>';
//////////////                                    echo '</div>';
//////////////                                echo '</div>';
//////////////
//////////////                            echo '</div>';
//////////////                        
//////////////                    echo '</div>';
//////////////                    echo '<!--room-->';
////////////                }
////////////                else
////////////                {
////////////					echo $row['id'];
////////////                    echo '<!--room-->';
////////////                        echo '<div class="mg-avl-room">';
////////////                            echo '<div class="row">';
////////////                                echo '<div class="col-xs-12 col-sm-6">';
////////////                                if($row['tag']!=0)
////////////                                {
////////////                                    echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
////////////                                }
////////////                                    echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
////////////                                    echo slide_photo($photo,$row['id']);
////////////                                    echo '</a>';
////////////                                echo '</div>';
////////////                                echo '<div class="col-xs-12 col-sm-6">';
////////////                                    echo '<h2 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;"><span itemprop="name">'.$name[0].'</span></a> <span>$249<sup>.99</sup>/Night</span></h2>';
////////////                                    echo '<span itemprop="description">'.base64_decode($row['brief']).'</span><br>';
////////////                                    //echo '<span style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.number_format($row['price']).' ++ /NT</span>';
////////////                                    echo '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price" style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
////////////                                    ?>
<?php /*?>                                <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="color:#f05b46;">
////////////                                    Price Range 
////////////                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="price" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
////////////                                    -
////////////                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="price" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
////////////                                </span>
////////////<?php */?>                                    <?php
////////////                                    echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
////////////                                    echo '<div class="row mg-room-fecilities">';
////////////                                        $ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
////////////                                        $b=0;
////////////                                        while($line = $dbc->Fetch($ch_prop))
////////////                                        {
////////////                                            $b++;
////////////                                            if($b<=6)
////////////                                            {
////////////                                                $icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
////////////                                                echo '<div class="col-xs-6 col-sm-6">';
////////////                                                    echo '<ul>';
////////////                                                        echo '<li>';
////////////                                                            echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
////////////                                                            echo '&nbsp;&nbsp;'.$icon['name'];
////////////                                                        echo '</li>';
////////////                                                    echo '</ul>';
////////////                                                echo '</div>';
////////////                                            }
////////////                                        }
////////////                                    echo '</div>';
////////////                                    echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
////////////                                echo '</div>';
////////////                            echo '</div>';
////////////                        echo '</div>';
////////////                    echo '<!--room-->';
////////////                }
////////////            }
////////////        }
////////////        else //if(count($arr_room)>0)
////////////        {
////////////            if($view=='grid')
////////////            {
////////////                //echo '<div class="col-xs-12 col-sm-6 col-md-6">';//<a href="?page=blogdetail&blog='.$r_blog['id'].'">
//////////////                        echo '<div class="col-md-12 boxpho nopad">';
//////////////                            if($row['tag']!=0)
//////////////                            {
//////////////                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
//////////////                            }
//////////////                            echo '<a href="/'.$row['ht_link'].'.html" target="_blank">'.slide_photo($photo,$row['id']).'</a>';
//////////////                        echo '</div>';
//////////////                        echo '<div class="col-md-12 boxbot_b nopad">';
//////////////                            echo '<div class="col-md-12 borbo nopad">';
//////////////                                echo '<div class="col-md-9 nopad">';
//////////////                                    echo '<h2 class="btitle" ><strong><span itemprop="name">'.$name[0].'</span></strong></h2>'; 
//////////////                                echo '</div>';
//////////////                                echo '<div class="col-md-3 nopad text-right" style="font-size:14px;margin-top: 22px;">';
//////////////                                $rev = $dbc->GetCount("rating","property=".$row['id']);
//////////////                                    echo $rev.' Reviews'; 
//////////////                                echo '</div>';
//////////////                            echo '</div>';
//////////////                            
//////////////                            echo '<div class="col-md-12 nopad">';
//////////////                                echo '<div class="col-sm-8 nopad" style="font-size: 14px;">';
//////////////                                $ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' limit 1");
//////////////                                while($line = $dbc->Fetch($ch_prop))
//////////////                                {
//////////////                                    $icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
//////////////                                                echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
//////////////                                                echo '&nbsp;&nbsp;'.$icon['name'];
//////////////                                }
//////////////                                    echo '<br>'.string_len(base64_decode($row['brief'],true),40);
//////////////                                echo '</div>';
//////////////                                echo '<div class="col-sm-4 nopad text-right">';
//////////////                                    echo '<span  style="font-size: 12px;    float: left;    padding-left: 30px;">FROM </span><br>';
//////////////                                    echo '<span style="font-size: 32px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($row['price']).'</span>';
//////////////                                    echo '<span style="font-size: 12px;">++ /NT</span>';
//////////////                                echo '</div>';
//////////////                            echo '</div>';
//////////////
//////////////                        echo '</div>';
//////////////                    
//////////////                echo '</div>';
//////////////                echo '<!--room-->';
////////////            }
////////////            else
////////////            {
////////////                echo '<!--room-->';
////////////                    echo '<div class="mg-avl-room">';
////////////                        echo '<div class="row">';
////////////                            echo '<div class="col-xs-12 col-sm-6">';
////////////                            if($row['tag']!=0)
////////////                            {
////////////                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
////////////                            }
////////////                                echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
////////////                                echo slide_photo($photo,$row['id']);
////////////                                //echo '<img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
////////////                            echo '</div>';
////////////                            echo '<div class="col-xs-12 col-sm-6">';
////////////                                echo '<h2 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;"><span itemprop="name">'.$name[0].'</span></a></h2>';
////////////								//<!--<span>$249<sup>.99</sup>/Night</span>-->';
////////////                                echo '<span itemprop="description">'.base64_decode($row['brief']).'</span><br>';
////////////                                //echo '<span style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.number_format($row['price']).' ++ /NT</span>';
////////////                                echo '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price" style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
////////////                                ?>
                                <!--<span itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="color:#f05b46;">
////////////                                    Price Range 
////////////                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="price" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
////////////                                    -
////////////                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="price" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
////////////                                </span>-->
                                    <?php
////////////                                echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
////////////                                echo '<div class="row mg-room-fecilities">';
////////////                                    $ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
////////////                                    $b=0;
////////////                                    while($line = $dbc->Fetch($ch_prop))
////////////                                    {
////////////                                        $b++;
////////////                                        if($b<=6)
////////////                                        {
////////////                                            $icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
////////////                                            echo '<div class="col-xs-6 col-sm-6">';
////////////                                                echo '<ul>';
////////////                                                    echo '<li>';
////////////                                                        echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
////////////                                                        echo '&nbsp;&nbsp;'.$icon['name'];
////////////                                                    echo '</li>';
////////////                                                echo '</ul>';
////////////                                            echo '</div>';
////////////                                        }
////////////                                    }
////////////                                echo '</div>';
////////////                                echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
////////////                            echo '</div>';
////////////                        echo '</div>';
////////////                    echo '</div>';
////////////                echo '<!--room-->';
////////////            }
////////////        }
////////////    }
}

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


function tag($id)
{
	global $dbc;
	if($id !='0')
	{
		$tags = $dbc->GetRecord("tags","*","id=".$id);
		return '<button class="btn_tag"><i class="fa fa-tag" aria-hidden="true" style="color: #f05b46;"></i> &nbsp;&nbsp;'.$tags['name'].'</button>';
	}
	else
	{
	}
}

function slide_photo($photo,$i)
{
	global $dbc;
	$photo_name = $dbc->GetRecord("properties","*","id='".$i."'");
	//echo $photo_name['name'];
	$name = explode("|",$photo_name['name']);
	//echo '***************'.$photo[0]['img'];\
	echo '<img itemprop="image" src="'.$photo[0]['img'].'"  alt="'.str_ireplace(' ','-',$name[0]).'"class="img-responsive">';
	
	/*echo '<div id="caro-'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">';
		echo '<!-- Indicators -->';
		echo '<ol class="carousel-indicators">';
		for($a=0;$a<count($photo);$a++)
		{
			$acc = ($a==0)?'active':'';
			if($a<=0)
			{
				echo '<li data-target="#caro-'.$i.'" data-slide-to="'.$a.'" class="'.$acc.'"></li>';
			}
		}
		echo '</ol>';
		
		echo '<!-- Wrapper for slides -->';
		echo '<div class="carousel-inner" role="listbox">';
		$b=0;
			foreach($photo as $img)
			{
				//echo '***************'.$img['img'];
				$actt = ($b==0)?'active':'';
				if($b<=0)
				{
					echo '<div class="item '.$actt.'">';
						echo '<img itemprop="image" src="'.$img['img'].'"  alt="'. str_ireplace(' ','-',$name[0]).'"class="img-responsive">';
					echo '</div>';
				}
				
				$b++;
				
			}
		echo '</div>';
		
		echo '<!-- Controls -->';
		echo '<a class="left carousel-control" href="#caro-'.$i.'" role="button" data-slide="prev">';
		echo '</a>';
		echo '<a class="right carousel-control" href="#caro-'.$i.'" role="button" data-slide="next">';
		echo '</a>';
	echo '</div>';*/
}

?>


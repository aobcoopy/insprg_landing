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
	$textH2 = $_REQUEST['textH2'];
	$starts = $_REQUEST['starts'];
	
	$zzx = $starts;
	
	//echo $_REQUEST['cbbDestination'];
	$Destination='';
	if(isset($_REQUEST['cbbDestination']))
	{
		if($_REQUEST['cbbDestination']!='all')
		{
			$Destination="properties.destination = '".$_REQUEST['cbbDestination']."' ";
		}
		else
		{
			$Destination="properties.destination  BETWEEN '38' AND '39' ";
		}
	}
	
	$SubDes='';
	if(isset($_REQUEST['cbbSub']))
	if($_REQUEST['cbbSub']!='all')
	{
		$SubDes="AND properties.subdestination = '".$_REQUEST['cbbSub']."' ";
	}
	else
	{
		$SubDes="";
	}
	
	
	
	
	$Room='';
	if(isset($_REQUEST['cbbRoom']))
	//$ex_room = explode("-",$_REQUEST['cbbRoom']);
	if($_REQUEST['cbbRoom']=='all')
	{
		$Room="";
	}
	else
	{
		if($_REQUEST['cbbRoom']==3 )
		{
			$Room = "AND property_room.room  BETWEEN '3' AND '4' ";
		}
		else
		{
			$Room = "AND property_room.room = '".$_REQUEST['cbbRoom']."'";
		}
	}
	
	
	
	
	$Collection='';
	if(isset($_REQUEST['cbbCollection']) && $_REQUEST['cbbCollection']!=0)
	{
		$Collection = "AND property_cate.caategory = '".$_REQUEST['cbbCollection']."'  ";
	}
	else
	{
		$Collection = '';
	}
	
	
	
	$link_url = $_REQUEST['link_url'];
	$ar_link = array(
		'/search-rent/thailand/all-beach/all-price/1-4-bedrooms/all-collections/all-sort.html',
		'/search-rent/thailand/all-beach/all-price/5-7-bedrooms/all-collections/all-sort.html',
		'/search-rent/thailand/all-beach/all-price/8-10-bedrooms/all-collections/all-sort.html',
		'/search-rent/thailand/all-beach/all-price/all-bedrooms/beachfront-villas/all-sort.html',
		'/search-rent/thailand/all-beach/all-price/all-bedrooms/wedding-villas/all-sort.html',
		'/search-rent/thailand/all-beach/all-price/all-bedrooms/larger-group-villas/all-sort.html',
		'/search-rent/thailand/all-beach/all-price/all-bedrooms/seaview-villas/all-sort.html',
	);
	$ar_link_2 = array(
		'/search-rent/thailand-koh-samui/all-beach/all-price/all-bedrooms/all-collections/all-sort.html',
	);
	$ar_link_3 = array(
		'/search-rent/thailand/all-beach/all-price/all-bedrooms/all-collections/all-sort.html',
	);
	$ar_link_4 = array(
		'/search-rent/thailand-koh-samui/all-beach/all-price/1-4-bedrooms/all-collections/all-sort.html',
	);
								
	if(in_array($link_url,$ar_link))
	{
		$starts += 5;
		//echo 'YESSSSSS';
	}
	elseif(in_array($link_url,$ar_link_2))
	{
		//$starts +=  10;
		//echo 'YESSSSSS___2';
	}
	elseif(in_array($link_url,$ar_link_3))
	{
		$starts += 10;
		//echo 'YESSSSSS___3';
	}
	elseif(in_array($link_url,$ar_link_4))
	{
		$limit = "15,5";
		//$limit = "5,5";
		//echo 'YESSSSSS___4';
	}
	else
	{
		//echo 'NOOOOOOOOOOOOOOOOOOOOOOOOO';
		//$starts = "0";
	}	
	
	
	$sorted='';
	if(isset($_REQUEST['cbbSort']))
	if($_REQUEST['cbbSort']!='0' )
	{
		$ex_s = explode("|",$_REQUEST['cbbSort']);
		
		/*if($ex_s[0]=='tag')
		{
			$sorted = "AND tag = ".$ex_s[1]." ";
		}
		else
		{
			$sorted = "ORDER BY ".$ex_s[0]." ".$ex_s[1]." ";
		}*/
		
		if($_REQUEST['cbbSort']!='0'  || $_REQUEST['cbbSort']!='')
		{
			//$ex = explode("|",$_REQUEST['cbbSort']);
			
			$sorted = "ORDER BY ".$ex_s[0]." ".$ex_s[1]." limit ".$starts.",5 ";
		}
		else
		{
			$sorted = "";
		}
	}
	else
	{
		$sorted = "";
	}

	
	
	//echo '>>>>>>>>>>>'.$_REQUEST['cbbSort'].'<<<<<<<<<<<<<br>';
//	echo '>>>>>>>>>>>'.$sorted.'<<<<<<<<<<<<<br>';
	
	$sql = "SELECT
				properties.id,
				properties.`name` AS pname,
				properties.destination AS destination,
				properties.subdestination AS beach,
				destinations.`name` AS dname,
				property_room.room AS room,
				property_cate.caategory AS cate,
				categories.`name` AS cname,
				properties.actualbed,
				properties.`status`,
				properties.price,
				properties.pmin,
				properties.pmax,
				properties.price_range,
				properties.ht_link,
				properties.brief,
				properties.short_det,
				properties.detail,
				properties.photo,
				properties.tag,
				
				properties.adults AS adults,
				properties.cate_icon AS cate_icon,
				properties.bedroom_range AS bedroom_range
				
			FROM
			properties
				LEFT JOIN property_cate ON properties.id = property_cate.property
				LEFT JOIN property_room ON properties.id = property_room.property
				LEFT JOIN destinations ON properties.subdestination = destinations.id
				LEFT JOIN categories ON property_cate.caategory = categories.id
			WHERE
				".$Destination."
				".$SubDes."
				".$Room."
				".$Collection."
				AND properties.`status` > 0
				GROUP BY
				properties.id
				".$sorted."	";
				
	//$sql_2 = "SELECT
//				Count(properties.id) AS Coun,
//				properties.`name` AS pname,
//				properties.destination AS destination,
//				properties.subdestination AS beach,
//				destinations.`name` AS dname,
//				property_room.room AS room,
//				property_cate.caategory AS cate,
//				categories.`name` AS cname,
//				properties.actualbed,
//				properties.`status`,
//				properties.price,
//				properties.pmin,
//				properties.pmax,
//				properties.price_range,
//				properties.ht_link,
//				properties.brief,
//				properties.short_det,
//				properties.detail,
//				properties.photo,
//				properties.tag
//			FROM
//			properties
//				LEFT JOIN property_cate ON properties.id = property_cate.property
//				LEFT JOIN property_room ON properties.id = property_room.property
//				LEFT JOIN destinations ON properties.subdestination = destinations.id
//				LEFT JOIN categories ON property_cate.caategory = categories.id
//			WHERE
//				".$Destination."
//				".$SubDes."
//				".$Room."
//				".$Collection."
//				AND properties.`status` > 0
//				GROUP BY
//				properties.id
//				".$sorted."";			
				
	$Qry = $dbc->Query($sql);
	//$Qry_2 = $dbc->Query($sql_2);
	
	//$counts = $dbc->Getnum($Qry_2);
	
	//echo '>>>>>>>>>>>'.$counts.'---'.$zzx.'<<<<<<<<<<<<<br>';
	
	
	/*echo '
			<div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
			<div  style="margin-left:0px;">
			<h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$counts.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
			<h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
			<br>
			</div>
			</div>';*/
	
	
	if($counts==0)
	{?>
		<!--<br>
		<center>
            <font size="+5" color="#f05b46"><img src="/upload/notfound.png" width="200"></font><br><br>
            <font size="+2" color="#112845">Not Found Please try again</font>
        </center>-->
		<?php
	}
	
	
	//$_REQUEST['txs'];	
	$x=0;						
	while($row = $dbc->Fetch($Qry))
	{
		if($row['tag']!=0)
		{
			$tag = $dbc->GetRecord("tags","*","id = '".$row['tag']."' ");
			$tag_name = $tag['name'];
		}
		else
		{
			$tag_name ='';
		}
		$photo = json_decode($row['photo'],true);
		$laa = $row['latitude'];
		$loo = $row['longtitude'];
		$amap = array(
			'la' => $row['latitude'],
			'lo' => $row['longtitude']
		);
		array_push($arr_map,$amap);
		$name = explode("|",$row['pname']);
		
		$catename = explode("-",$row['cname']);
		switch($row['cate_icon'])
		{
			case"4":
				$icon_cate = "beach";
				$icon_name = "Seaview Villa";
			break;
			case"5":
				$icon_cate = "largegroup";
				$icon_name = "Large Group Villa";
			break;
			case"6":
				$icon_cate = "seas";
				$icon_name = "Beachfront Villa";
			break;
			case"8":
				$icon_cate = "wedding";
				$icon_name = "Wedding Villa";
			break;
			case"9":
				$icon_cate = "house";
				$icon_name = "Garden Villa";
			break;
			default:
				$icon_cate = "";
				$icon_name = "";
		}
		
		//echo $row['dname']."<br>";// แสดงข้อความเต็ม
		
		
		
		if(strstr($row['dname'],'Beach'))
		{
			$split = explode(",",$row['dname']);// แบ่งข้อความโดชใช้ ,
			$locations = str_ireplace('Beach','',$split[0]);// แทนที่ข้อความ
			
			$nost = strrpos($locations," ")."<br>";// หาตำแหน่งสุดท้าย
			//echo $row['dname']."<br>";// แสดงข้อความเต็ม
			//echo substr_replace($locations,",",$nost);// แสดงข้อความที่ถูกตัดออก
			$full_location = substr_replace($locations,",",$nost).$split[1];
		}
		elseif(strstr($row['dname'],'Bay'))
		{
			$split = explode(",",$row['dname']);// แบ่งข้อความโดชใช้ ,
			$locations = str_ireplace('Bay','',$split[0]);// แทนที่ข้อความ
			
			$nost = strrpos($locations," ")."<br>";// หาตำแหน่งสุดท้าย
			//echo $row['dname']."<br>";// แสดงข้อความเต็ม
			//echo substr_replace($locations,",",$nost);// แสดงข้อความที่ถูกตัดออก
			$full_location = substr_replace($locations,",",$nost).$split[1];
		}
		elseif(strstr($row['dname'],'Bophut'))
		{
			//echo $row['dname']."<br>";// แสดงข้อความเต็ม
			$full_location = $row['dname'];
		}
		else
		{
			//echo $row['dname']."<br>";// แสดงข้อความเต็ม
			$full_location = $row['dname'];
		}
											
		
		$x++;
		$ft = "";//($x==1)?'ftt':'';
		
		$zzx++;
		
		if($zzx=='1' ||  $zzx=='6' || $zzx=='8' || $zzx=='11' || $zzx=='13')
		{
			$padd = "style='padding-bottom: 40px;'";
		}
		else
		{
			$padd = "";
		}
		
		//echo '<!--room-->';
			echo '<div class="mg-avl-room" '.$padd.'><span itemscope itemtype="http://schema.org/Product">';
				echo '<div class="row">';
					//--------------------------web-----------------------------
					echo '<div class="col-xs-12 col-sm-12 col-md-4">';
					if($row['tag']!=0)
					{
						echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
					}
						echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
						//echo slide_photo($photo,$row['id']);
						if($zz==1)
						{
							echo '<img  src="'.$photo[0]['img'].'" alt="" class="img-responsive" width="100%"></a>';
						}
						else
						{
							echo '<img  data-src="'.$photo[0]['img'].'" alt="" class="img-responsive lazy" width="100%"></a>';
						}
					
					
					?>
						<span class="hidden" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
							Price Range 
							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
							-
							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
						</span>
							<?php
						
					echo '</div>';
					echo '<div class="col-xs-12 col-sm-12 col-md-8 web ">';
					
						echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t33">';
							echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11"><h3 class="mg-avl-room-title vtitle"><a href="/'.$row['ht_link'].'.html" ><span itemprop="name">'.$name[0].'</span></a></h3></div>';
							//echo '<div class="col-xs-12 col-sm-4 col-md-4 text-right nopad r_price tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
						echo '</div>';
						
						echo '<div  class="top20 tb t_t44"><span itemprop="description">'.base64_decode($row['short_det']).'</span></div>';
						//echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range $'.$row['pmin'].' - $'.$row['pmax'].' / room nights / season</span></span>';
						
						//echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
						//echo '</div>';
						echo '<div class="gray_mob">';
							echo '<div class="row mg-room-fecilities">';
								echo '<div class="col-xs-12 col-sm-4 col-md-5 top20 t_t11">';
									echo '<ul>';
										echo '<li style="margin-bottom: -2px;">';
											//echo '<svg width="30" height="30">';
												echo '<image data-src="/upload/location.svg"  class="micon lazy" style="width: 23px !important;"/>';
											//echo '</svg>';
											
											//echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
											echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
										echo '</li>';
										if($row['cate_icon']!='')
										{
										echo '<li>';
											/*echo '<svg width="30" height="30">';
												echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
											echo '</svg>';*/
											if($icon_cate == "seas")
											{
												echo '<image  data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 32px;margin-left: -5px;" />';
											}
											else
											{
												echo '<image  data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
											}
											
											echo '<div class="ic_name">&nbsp;&nbsp;'.$icon_name.'</div>';//str_ireplace('Villas','Villa',$catename[0]).'
										echo '</li>';
										}
										else
										{
											//echo '-----';
										}
								echo '</ul>';
							echo '</div>';
							echo '<div class="col-xs-6 col-sm-4 col-md-3 top21 t_t22">';
									echo '<ul>';
										//echo '<li>';
//																					echo '<svg width="30" height="30">';
//																						echo '<image xlink:href="/upload/location.svg"  class="micon" />';
//																					echo '</svg>';
//																					echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
//																				echo '</li>';
										
										echo '<li>';
											/*echo '<svg width="30" height="30">';
												echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
											echo '</svg>';*/
											echo '<image data-src="/upload/bed.svg"  class="micon lazy" />';
											echo '<div class="ic_name">&nbsp;&nbsp;'.$row['bedroom_range'].'</div>';
											//echo '<div class="ic_name">&nbsp;&nbsp;'.$row['actualbed'].' Bedroom</div>';
										echo '</li>';
										echo '<li>';
											/*echo '<svg width="30" height="30">';
												echo '<image xlink:href="/upload/team.svg"  class="micon" />';
											echo '</svg>';*/
											echo '<image data-src="/upload/team.svg"  class="micon lazy"/>';
											echo '<div class="ic_name">&nbsp;&nbsp;'.$row['adults'].' Guests</div>';
										echo '</li>';
											////$ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
////																					$b=0;
////																					while($line = $dbc->Fetch($ch_prop))
////																					{
////																						$b++;
////																						if($b<=4)
////																						{
////																							$icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
////																							
////																							$ex1 = explode("photo",json_decode($icon['icon'],true));
////																							$ex_name = explode("_",$ex1[1]);
////																							$svg = explode(".",$ex_name[1]);
////																							
////																									echo '<li>';
////																										//echo '<img src="'.json_decode($icon['icon'],true).'" alt="'.$icon['name'].'" class="micon"></i>&nbsp;&nbsp;'.$icon['name'];
////																										echo '<svg width="30" height="30">';
////																											echo '<image xlink:href="/upload/icons/'.$svg[0].'.svg"  class="micon" />';
////																											//src="'.json_decode($fes_r['icon'],true).'"
////																										echo '</svg>';
////																										echo '<div class="ic_name">&nbsp;&nbsp;'.$icon['name'].'</div>';
////																									echo '</li>';
////																						}
////																					}
									echo '</ul>';
								echo '</div>';
							
								echo '<div class="col-xs-6 col-sm-4 col-md-4 t_price text-right nopad t_t33">';
									echo '<div class="col-xs-12 col-sm-12 col-md-12 text-right nopad  tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
									echo '<div class="col-xs-12 col-sm-12 col-md-12  nopad top10 t_t31">';
										echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
									//echo '</div>';
//																			echo '<div class="col-xs-6 col-sm-6 col-md-6  nopad t_t3">';
										echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
										?><?php /*?><button type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');" class="btn_villa btn_enquire" target="_blank">Enquire Now</button><?php */?><?php
									echo '</div>';
								echo '</div>';
							echo '</div>';
							//echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t3">';
//																		echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//																	echo '</div>';
						echo '</div>';
					echo '</div>';
					//--------------------------web-----------------------------
					
					//--------------------------mob-----------------------------
					echo '<div class="col-xs-12 col-sm-12 col-md-6 mob top10">';
						//echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
						//echo '</div>';
						echo '<div class="gray_mob">';
							echo '<div class="row mg-room-fecilities">';
								echo '<div class="col-xs-12 col-sm-12 col-md-6 padleft25 padright25 t_t11">';
									echo '<h3 class=" font_mob top10"><a class="fbk" href="/'.$row['ht_link'].'.html" ><span itemprop="name"><strong>'.$name[0].' </strong></span></a></h3>';
									echo '<div  class="top15 tb f13"><span itemprop="description">'.base64_decode($row['short_det']).'</span></div>';
									echo '</div>';
									//echo '<div class="col-xs-12 col-sm-12 col-md-12 padleft25 top10 t_t41">';
									echo '<div class="col-xs-7 col-sm-6 col-md-6 padleft25 top10 t_t11">';
										echo '<ul>';
											echo '<li>';
												//echo '<svg width="30" height="30" style="padding-left: 5px;">';
//																							echo '<image xlink:href="/upload/location.svg" src="/upload/location.svg"  class="micon" style="width: 20px !important;" />';
//																						echo '</svg>';
												echo '<image data-src="/upload/location.svg"  class="micon lazy" style="width: 22px !important;padding-left: 5px;"/>';
												//echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
												echo '<div class="ic_name f13">&nbsp;'.$full_location.'</div>';
											echo '</li>';
											if($row['cate_icon']!='')
											{
											echo '<li>';
												/*echo '<svg width="30" height="30">';
													echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
												echo '</svg>';*/
												if($icon_cate == "sea")
												{
													echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 37px;margin-left: -5px;background: #ffcdcd00;margin-top: -8px;margin-bottom: -1px !important;" />';
												}
												else
												{
													echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
												}
												echo '<div class="ic_name f13">&nbsp;'.$icon_name.'</div>';//'.str_ireplace('Villas','Villa',$catename[0]).'
											echo '</li>';
											}
										echo '</ul>';
									echo '</div>';
									echo '<div class="col-xs-5 col-sm-6 col-md-6 padleft251 top10 t_t22">';
										echo '<ul>';
											echo '<li>';
												//echo '<svg width="30" height="30">';
//																							echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
//																						echo '</svg>';
												echo '<image data-src="/upload/bed.svg"  class="micon lazy" />';
												echo '<div class="ic_name f13">&nbsp;'.$row['bedroom_range'].'</div>';
											echo '</li>';
											echo '<li>';
												//echo '<svg width="30" height="30">';
//																							echo '<image xlink:href="/upload/team.svg"  class="micon" />';
//																						echo '</svg>';
												echo '<image data-src="/upload/team.svg"  class="micon lazy" />';
												echo '<div class="ic_name f13">&nbsp;'.$row['adults'].' Guests</div>';
											echo '</li>';
										echo '</ul>';
									echo '</div>';
									//echo '<div class="col-xs-6 col-sm-6 col-md-6 padleft25 top10">';
//																				echo '<ul>';
//																				if($row['cate_icon']!='')
//																				{
//																					echo '<li>';
//																						//echo '<svg width="30" height="30">';
////																							echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
////																						echo '</svg>';
//																						//echo '<image src="/upload/'.$icon_cate.'.svg"  class="micon" />';
//																						if($icon_cate == "sea")
//																						{
//																							echo '<image src="/upload/'.$icon_cate.'.svg"  class="micon" style="width: 34px !important;height: 37px;margin-left: -5px;background: #ffcdcd00;margin-top: -8px;margin-bottom: -1px !important;" />';
//																						}
//																						else
//																						{
//																							echo '<image src="/upload/'.$icon_cate.'.svg"  class="micon" />';
//																						}
//																						echo '<div class="ic_name">&nbsp;'.str_ireplace('Villas','Villa',$catename[0]).'</div>';
//																					echo '</li>';
//																				}
//																				echo '</ul>';
//																			echo '</div>';
											
									
							//echo '<div class="col-xs-6 col-sm-6 col-md-6 padleft25 top10 t_t4">';
//																			echo '<ul>';
//																					$ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
//																					$b1=0;
//																					while($line = $dbc->Fetch($ch_prop))
//																					{
//																						$b1++;
//																						if($b1==4)
//																						{
//																							echo '<ul>';
//																							echo '</div>';
//																							echo '<div class="col-xs-6 col-sm-6 col-md-6 top10">';
//																							echo '<ul>';
//																						}
//																						
//																						if($b1<=4)
//																						{
//																							$icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
//																							
//																							$ex1 = explode("photo",json_decode($icon['icon'],true));
//																							$ex_name = explode("_",$ex1[1]);
//																							$svg = explode(".",$ex_name[1]);
//																							
//																									echo '<li>';
//																										//echo '<img src="'.json_decode($icon['icon'],true).'" alt="'.$icon['name'].'" class="micon"></i>';
//																										echo '<svg width="30" height="30">';
//																											echo '<image xlink:href="/upload/icons/'.$svg[0].'.svg" class="micon" />';
//																											//src="'.json_decode($fes_r['icon'],true).'"
//																										echo '</svg>';
//																										echo '<div class="ic_name">&nbsp;&nbsp;'.$icon['name'].'</div>';
//																									echo '</li>';
//																						}
//																					}
//																			echo '</ul>';
//																		echo '</div>';
								echo '<div class="col-xs-12 col-sm-12 col-md-6 t_price  t_t21">';
									//echo '<div class="text-right text_price">From <span class="inprice ">$'.number_format($row['pmin']).'</span> / Night</div>';
									//echo '<div class="col-xs-12 col-sm-12 col-md-12 text-center nopad top20 t_t31">';
//																				echo '<a href="/'.$row['ht_link'].'.html"><button class="btn_villa btn_detail" target="_blank">View Detail</button></a>';
//																			//echo '</div>';
////																			echo '<div class="col-xs-6 col-sm-6 col-md-6  nopad t_t3">';
//																				echo '<a href="/'.$row['ht_link'].'.html"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
//																			echo '</div>';
									
									echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padleft top20 bottom51 t_t31">';
										echo '<div class="text-right text_price tp2">From <span class="inprice ">$'.number_format($row['pmin']).'</span> / Night</div>';
										//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
									echo '</div>';
									echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padright top20 bottom51 t_t31">';
										
										echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa_2 " target="_blank">View Details</button></a>';
										//echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
										?><?php /*?><button class="btn_villa btn_enquire" type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');"> Enquire Now</button><?php */?><?php
									echo '</div>';
									
								echo '</div>';
							echo '</div>';
							//echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t3">';
//																		echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//																	echo '</div>';
						echo '</div>';
					echo '</div>';
					//--------------------------mob-----------------------------
					
				echo '</div>';
			echo '</span></div>';
		//echo '<!--room-->';
												
												
												
												
												
		////echo '<!--room-->';
//			echo '<div class="mg-avl-room"><span itemscope itemtype="http://schema.org/Product">';
//				echo '<div class="row">';
//					echo '<div class="col-xs-12 col-sm-12 col-md-6">';
//					if($row['tag']!=0)
//					{
//						echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
//					}
//						echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
//						//echo slide_photo($photo,$row['id']);
//						echo '<img src="'.$photo[0]['img'].'" alt="" width="100%" class="img-responsive"></a>';
//					echo '</div>';
//					echo '<div class="col-xs-12 col-sm-12 col-md-6">';
//						echo '<h3 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;"><span itemprop="name">'.$name[0].'</span></a></h3>';
//						//echo '<div class="gray_mob">';
//						echo '<span itemprop="description">'.base64_decode($row['brief']).'</span><br>';
//						//echo '<span style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.number_format($row['price']).' ++ /NT</span>';
//						//echo '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price" style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
//						//if(strchr($valu['val'.$i],"++"))
//						//{
////							$exs = explode("+",$valu['val'.$i]);
////							echo '<td class="t'.$i.' tbp text-center">';echo ($valu['val'.$i]!='')?number_format($row['val'.$i]).'++':' 0 ';echo ' </td>';
////						}
////						else
////						{
////							$exs = explode("+",$valu['val'.$i]);
////							echo '<td class="t'.$i.' tbp text-center">';echo ($valu['val'.$i]!='')?number_format($row['val'.$i]):' 0 ';echo ' </td>';
////						}
//						//echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range $'.$row['price_range'].'</span></span>';
//						echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range $'.$row['pmin'].' - $'.$row['pmax'].' / room nights / season</span></span>';
//						//echo '</div>';
//						?>
<!--//						<span class="hidden" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
//							Price Range 
//							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
//							-
//							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
//						</span>
-->							<?php
//						echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
//						//echo '</div>';
//						echo '<div class="gray_mob">';
//							echo '<div class="row mg-room-fecilities">';
//								$ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' ");
//								$b=0;
//								while($line = $dbc->Fetch($ch_prop))
//								{
//									$b++;
//									if($b<=6)
//									{
//										$icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
//										echo '<div class="col-xs-6 col-sm-6">';
//											echo '<ul>';
//												echo '<li>';
//													echo '<img src="'.json_decode($icon['icon'],true).'" alt="'.$icon['name'].'" class="micon"></i>';
//													echo '&nbsp;&nbsp;'.$icon['name'];
//												echo '</li>';
//											echo '</ul>';
//										echo '</div>';
//									}
//								}
//							echo '</div>';
//							echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//						echo '</div>';
//					echo '</div>';
//				echo '</div>';
//			echo '</span></div>';
//		//echo '<!--room-->';
												
												
		//echo $zzx;
		
		
		if($zzx=='2' || $zzx=='6' || $zzx=='11')
		{
			echo '<button class="bad"><strong>receive $150 off any excursion booking during your villa stay with us*</strong></button>';
		}
		
		if($zzx=='4' || $zzx=='8' || $zzx=='13')
		{
			echo '<button class="bad adblu">LET US FIND THE VILLA OPTIONS FOR YOU  - <strong>CONCIERGE SERVICE AVAILABLE</button></strong>';
		}
										
		
	}
	
	
	
	
	
	
	
//	$price='';
//	if(isset($_REQUEST['cbbPrice']))
//	if($_REQUEST['cbbPrice']!='all')
//	{
//		if($_REQUEST['cbbPrice']=='1')//all price
//		{
//			$price="";
//		}
//		elseif($_REQUEST['cbbPrice']=='2')// < 1000
//		{
//			$price="AND price < 1000";
//		}
//		else// > 1000
//		{
//			$price="AND price > 1000";
//		}
//		
//	}
//	else
//	{
//		$price="";
//	}
	
	
	
	
//	$view = '';
//	if(isset($_REQUEST['t_view']))
//	{
//		$view = $_REQUEST['t_view'];
//	}
	
	
	
	
	

		
		
		
		//$num1 = count($prop_villa);
//		if(count($arr_room_load)>0)
//		{
//			echo '
//			<div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
//			<div  style="margin-left:0px;">
//			<h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$u.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
//			<h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
//			<br>
//			</div>
//			</div>';
//			//echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.'</h2>
//			 // <h4 style="    font-family: pt !important;">Displaying '.$u.'  hand picked villas in your search </h4><br></div>';
//		}
//		else
//		{
//			
//				//echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.' </h2>
//			  //<h4 style="    font-family: pt !important;">Displaying '.$nn.'  hand picked villas in your search </h4><br></div>';
//		}
		
			  
		
			  
						
	
	

	
function slide_photo($photo,$i)
{
	//echo '***************'.$photo[0]['img'];
	echo '<div id="caro-'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">';
		echo '<!-- Indicators -->';
		echo '<ol class="carousel-indicators">';
		for($a=0;$a<count($photo);$a++)
		{
			$acc = ($a==0)?'active':'';
			if($a<=2)
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
				if($b<=2)
				{
					echo '<div class="item '.$actt.'">';
						echo '<img src="'.$img['img'].'" alt="" class="img-responsive">';
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
	echo '</div>';
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
?>
<script>
$(document).ready(function(e) {
    $(".lazy").lazyload();
});
</script>
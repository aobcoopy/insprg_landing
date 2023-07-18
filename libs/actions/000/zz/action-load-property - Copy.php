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
	
	$Destination='';
	if(isset($_REQUEST['cbbDestination']))
	if($_REQUEST['cbbDestination']!='all')
	{
		if($_REQUEST['cbbDestination']=='All Phuket Beaches')//all price
		{
			$Destination="";
		}
		else// > 1000
		{
			$Destination="AND destination = '".$_REQUEST['cbbDestination']."'";
		}
		
	}
	else
	{
		$Destination="";
	}
	
	$SubDes='';
	if(isset($_REQUEST['cbbSub']))
	if($_REQUEST['cbbSub']!='all')
	{
		
		$SubDes="AND subdestination = '".$_REQUEST['cbbSub']."'";
		/*if($_REQUEST['cbbSub_sort']=='All Phuket Beaches')//all price
		{
			$SubDes="";
		}
		else// > 1000
		{
			$SubDes="AND destination = '".$_REQUEST['cbbSub_sort']."'";
		}*/
		
	}
	else
	{
		$SubDes="";
	}
	
	
	$price='';
	if(isset($_REQUEST['cbbPrice']))
	if($_REQUEST['cbbPrice']!='all')
	{
		if($_REQUEST['cbbPrice']=='1')//all price
		{
			$price="";
		}
		elseif($_REQUEST['cbbPrice']=='2')// < 1000
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
	
	
	
	
	$sorted='';
	if(isset($_REQUEST['tx_sort']))
	if($_REQUEST['tx_sort']!='0' )
	{
		$ex_s = explode("|",$_REQUEST['tx_sort']);
		if($ex_s[0]=='tag')
		{
			$sorted = "AND tag = ".$ex_s[1]." ";
		}
		else
		{
			$sorted = "ORDER BY ".$ex_s[0]." ".$ex_s[1]." ";
		}
		/*if($_REQUEST['tx_sort']!='0'  || $_REQUEST['tx_sort']!='')
		{
			$ex = explode("|",$_REQUEST['tx_sort']);
			
			$sorted = "ORDER BY ".$ex[0]." ".$ex[1]." ";
		}
		else
		{
			$sorted = "";
		}*/
	}
	else
	{
		$sorted = "";
	}
	
	$view = '';
	if(isset($_REQUEST['t_view']))
	{
		$view = $_REQUEST['t_view'];
	}
	
	$Room='';
	if(isset($_REQUEST['cbbRoom']))
	$ex_room = explode("-",$_REQUEST['cbbRoom']);
	if($_REQUEST['cbbRoom']=='all')
	{
		$Room="";
		/*if($_REQUEST['cbbRoom']==1)
		{
			$Room="";
		}
		else
		{
			$Room="AND actualbed = '".$_REQUEST['cbbRoom']."'";
		}
		*/
	}
	else
	{
		switch($_REQUEST['cbbRoom'])
		{
			case "1":
				$Room="AND actualbed BETWEEN 1 AND 4 ";
			break;
			case "2":
				$Room="AND actualbed BETWEEN 5 AND 7 ";
			break;
			case "3":
				$Room="AND actualbed > 8 ";
				//$Room="AND actualbed BETWEEN 8 AND 10 ";
			break;
			default:
				$Room="AND actualbed > 8 ";
				//$Room="AND actualbed > 10 ";
		}
	}
	/*elseif($_REQUEST['cbbRoom']=='more')
	{
		$Room="AND actualbed > 10 ";
	}
	else
	{
		$Room="AND actualbed BETWEEN ".$ex_room[0]." AND ".$ex_room[1]." ";
	}*/
	
	/*echo '<pre>';
	echo $_REQUEST['cbbRoom'].'-------'.$Room;
	echo '</pre>';*/
	
	$guest='';
	if(isset($_REQUEST['guest']))
	if($_REQUEST['guest']=='all')
	{
		/*if($_REQUEST['guest']==1)
		{
			$guest="";
		}
		else
		{*/
			$guest="";
		/*}*/
	}
	else
	{
		$guest="AND guest = '".$_REQUEST['guest']."'";
	}
	/*echo '<pre>';
	echo $_REQUEST['guest'].'---'.$guest;
	echo '</pre>';*/
	
	$arr_map_cate = array();
	$arr_map = array();
	$prop_villa = array();
	//echo "select * from properties where status > 0 ".$Destination." ".$price." ".$Room." ".$cate." ".$sorted." ".$_REQUEST['t_view']."<br>";
	//echo '<br><br><br><br><br>';
	$propcate = array();
	$prop_price = array();
	$prop_bed = array();
	//$ar_propcate = array();
	
	$arr_room_load = array();
	$sql_room_load = $dbc->Query("select * from property_room where room = '".$_REQUEST['cbbRoom']."' ");
	$zz=0;
	$arr2 = array();
	while($r_room_load = $dbc->Fetch($sql_room_load))
	{
		//echo '******'.$cate_r['property'];
		if($dbc->HasRecord("properties","id= '".$r_room_load['property']."' AND status > 0"))
		{
			$pro = $dbc->GetRecord("properties","*","id= '".$r_room_load['property']."' AND status > 0");
			array_push($arr_room_load,$r_room_load['property']);
			$arrraaay[] = array(
				"proerty" => $pro['id'],
				"acroom" => $pro['actualbed']
			);
			
			$zz++;
		}
		
	}
		
		
	if(isset($_REQUEST['t_Collection']) && $_REQUEST['t_Collection']!=0)
	{
		$sql_cate = $dbc->Query("select * from property_cate where caategory = '".$_REQUEST['t_Collection']."'  ");
		while($li = $dbc->Fetch($sql_cate))
		{
			$proper = $dbc->GetRecord("properties","*","id = '".$li['property']."'  ".$Destination." ".$SubDes." ".$price."  ".$sorted." ");//".$Room." ".$guest."
			
			$ar_prop = array(
				'id' => $proper['id'],
				'price' => $proper['price'],
				'bedroom' => $proper['actualbed']
			);
			$ar_propcate[] = $ar_prop;

			/*array_push($propcate,$proper['id']);
			array_push($prop_price,$proper['id'].'|'.$proper['price']);
			array_push($prop_bed,$proper['id'].'|'.$proper['actualbed']);*/
		}
		
		/*echo '<pre>';
			print_r($ar_propcate);
		echo '</pre>';*/
		foreach ($ar_propcate as $key => $vv) 
		{
			$volume_id[$key]  = $vv['id'];
			$volume_price[$key]  = $vv['price'];
			$volume_bed[$key]  = $vv['bedroom'];
		}

		$ex = explode("|",$_REQUEST['tx_sort']);
		if($ex[0]=='actualbed')
		{
			//$exx = explode("|",$prop_bed);
			$prop_villa = $ar_propcate;
			if($ex[1]=='asc')
			{
				array_multisort($volume_bed, SORT_ASC,$prop_villa);
			}
			else
			{
				array_multisort($volume_bed, SORT_DESC,$prop_villa);
			}
			
		}
		elseif($ex[0]=='price')
		{
			$prop_villa = $ar_propcate;
			if($ex[1]=='asc')
			{
				array_multisort($volume_price, SORT_ASC,$prop_villa);
			}
			else
			{
				array_multisort($volume_price, SORT_DESC,$prop_villa);
			}
		}
		else
		{
			$prop_villa = $ar_propcate;
		}
		
		/*echo '<pre>';
			print_r($prop_villa);
		echo '</pre>';
			*/
		
		$nn=0;$u=0;
		foreach($prop_villa as $p_cate  => $x_value)
		{
			$rest = $dbc->GetRecord("properties","*","status > 0 and id = '".$x_value['id']."' ".$Destination." ".$SubDes." ");//".$price." ".$Room."  ".$sorted."
			if(count($rest['id'])<=0)
			{
			}
			else
			{
				$nn++;
				
				if(count($arr_room_load)>0)
				{
					if(in_array($x_value['id'],$arr_room_load))
					{
						$u++;
					}
				}
			}
			
			
			
			
		}
		
		/*echo '<pre>';
		echo count($arr_room_load);
		print_r($arr_room_load);		
		echo '</pre>';
		
		echo '<pre>';
		echo count($arrraaay);
		print_r($arrraaay);		
		echo '</pre>';*/
		
		
		$num1 = count($prop_villa);
		if(count($arr_room_load)>0)
		{
			echo '
			<div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
			<div  style="margin-left:0px;">
			<h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$u.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
			<h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
			<br>
			</div>
			</div>';
			//echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.'</h2>
			 // <h4 style="    font-family: pt !important;">Displaying '.$u.'  hand picked villas in your search </h4><br></div>';
		}
		else
		{
			echo '
			<div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
			<div  style="margin-left:0px;">
			<h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$nn.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
			<h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
			<br>
			</div>
			</div>';
				//echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.' </h2>
			  //<h4 style="    font-family: pt !important;">Displaying '.$nn.'  hand picked villas in your search </h4><br></div>';
		}
		
		/*echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">All Luxury Vacation Rentals </h2>
			  <h4 style="    font-family: pt !important;">Displaying '.$nn.' hand picked villas in your search </h4><br></div>';*/
			  
		if($nn==0)
		{
				?>
            <br>
            <center><font size="+5" color="#f05b46"><img src="/upload/notfound.png" width="200"></font><br><br><font size="+2" color="#112845">Not Found Please try again</font></center>
			<?php
		}
			  
		//echo '<pre>';
		foreach($prop_villa as $p_cate => $x_value)
		{
			//$ex_prop = explode("|",$p_cate);
			//echo "<pre>**----select * from properties where status > 0 and id = '".$x_value['id']."' ".$Destination." ".$SubDes." ".$price."  ".$guest." ".$sorted." </pre>";
			$rest = $dbc->GetRecord("properties","*","status > 0 and id = '".$x_value['id']."' ".$Destination." ".$SubDes." ".$price."  ".$guest." ".$sorted." ");//".$Room."
			//echo '------------'.$rest['tags'];
			if($rest['tag']!=0)
			{
				$tag = $dbc->GetRecord("tags","*","id = '".$rest['tag']."' ");
				$tag_name = $tag['name'];
			}
			
			
			if(count($rest['id'])<=0)
			{
			
			}
			else
			{
				$photo = json_decode($rest['photo'],true);
				$laa = $rest['latitude'];
				$loo = $rest['longtitude'];
				$amapC = array(
					'la' => $rest['latitude'],
					'lo' => $rest['longtitude']
				);
				array_push($arr_map_cate,$amapC);
				$nam = explode("|",$rest['name']);
				if($view=='grid')
				{
					
					//echo '00000000>'.$rest['ht_link'].'<!--room-->';
					//echo '<div class="mg-avl-room">';
						echo '<div class="col-xs-12 col-sm-6 col-md-6">';//<a href="?page=blogdetail&blog='.$r_blog['id'].'">
								echo '<a href="/'.$rest['ht_link'].'.html" target="_blank"><div class="col-md-12 boxpho nopad">';
									if($rest['tag']!=0)
									{
										echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
									}
									echo ''.slide_photo($photo,$rest['id'].'-s').'';
									//echo '<a href="/'.$rest['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" width="100%"></a>';
								echo '</div></a>';
								echo '<a href="/'.$rest['ht_link'].'.html" target="_blank"><div class="col-md-12 boxbot_b nopad">';
									echo '<div class="col-md-12 borbo nopad">';
										echo '<div class="col-md-9 nopad">';
											echo '<h2 class="btitle" ><strong>'.$nam[0].'</strong></h2>'; 
										echo '</div>';
										echo '<div class="col-md-3 nopad text-right" style="font-size:14px;margin-top: 22px;">';
										$rev = $dbc->GetCount("rating","property=".$rest['id']);
											echo $rev.' Reviews'; 
										echo '</div>';
									echo '</div>';
									
									echo '<div class="col-md-12 nopad">';
										echo '<div class="col-sm-8 nopad" style="font-size: 14px;">';
										$ch_prop = $dbc->Query("select * from property_icon where property = '".$rest['id']."' limit 1");
										while($line = $dbc->Fetch($ch_prop))
										{
											$icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
														echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
														echo '&nbsp;&nbsp;'.$icon['name'];
										}
											echo '<br>'.string_len(base64_decode($rest['brief'],true),40);
										echo '</div>';
										echo '<div class="col-sm-4 nopad text-right">';
											echo '<span  style="font-size: 12px;    float: left;    padding-left: 30px;">FROM </span><br>';
											echo '<span style="font-size: 32px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($rest['price']).'</span>';
											echo '<span style="font-size: 12px;">++ /NT</span>';
										echo '</div>';
									echo '</div>';
	
								echo '</div></a>';
							
						echo '</div>';
					echo '<!--room-->';
	
				}
				else
				{
					
					//echo '---------------------------'.$rest['price'];
					if(count($arr_room_load)>0)
					{
						//echo '<pre>--->'.$rest['id'].'</pre>';
						if(in_array($rest['id'],$arr_room_load))
						{
							//echo '<pre>--->YES---'.$rest['id'].'</pre>';
							echo '<div class="mg-avl-room">';
								echo '<div class="row">';
									echo '<a href="/'.$rest['ht_link'].'.html" target="_blank"><div class="col-sm-6">';
										if($rest['tag']!=0)
										{
											echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
										}
										//echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
										//echo ''.slide_photo($photo,$rest['id'].'-s').'';
										echo '<a href="/'.$rest['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
										//echo '------------>'.$rest['ht_link'];
									echo '</div></a>';
									echo '<div class="col-sm-6">';
										echo '<h2 class="mg-avl-room-title"><a href="/'.$rest['ht_link'].'.html" style="text-transform:uppercase;">'.$nam[0].'</a> <!--<span>$249<sup>.99</sup>/Night</span>--></h2>';
										//$rest['actualbed'].
										echo '<span>'.base64_decode($rest['brief']).'</span><br>';
										//echo '<span style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$rest['price_range'].' </span>';
										?>
                                        <span itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
                                            Price Range 
                                            <span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $rest['pmin'];?>"><?php echo $rest['pmin'];?></span>
                                            -
                                            <span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $rest['pmax'];?>"><?php echo $rest['pmax'];?></span> / night
                                        </span>
										<?php
										echo '<p>'.string_len(base64_decode($rest['short_det'],true),700).'</p>';
										echo '<div class="row mg-room-fecilities">';
											$ch_prop = $dbc->Query("select * from property_icon where property = '".$rest['id']."' ");
											
											while($line = $dbc->Fetch($ch_prop))
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
										echo '</div>';
										
										echo '<a href="/'.$rest['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					}
					else
					{
						echo '<div class="mg-avl-room">';
							echo '<div class="row">';
								echo '<a href="/'.$rest['ht_link'].'.html" target="_blank"><div class="col-sm-6">';
									if($rest['tag']!=0)
									{
										echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
									}
									//echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
									//echo ''.slide_photo($photo,$rest['id'].'-s').'';
									echo '<a href="/'.$rest['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
									//echo '------------>'.$rest['ht_link'];
								echo '</div></a>';
								echo '<div class="col-sm-6">';
									echo '<h2 class="mg-avl-room-title"><a href="/'.$rest['ht_link'].'.html" style="text-transform:uppercase;">'.$nam[0].'</a> <!--<span>$249<sup>.99</sup>/Night</span>--></h2>';
									//$rest['actualbed'].
									echo '<span>'.base64_decode($rest['brief']).'</span><br>';
									//echo '<span style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$rest['price_range'].' </span>';
									?>
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
                                        Price Range 
                                        <span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $rest['pmin'];?>"><?php echo $rest['pmin'];?></span>
                                        -
                                        <span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $rest['pmax'];?>"><?php echo $rest['pmax'];?></span> / night
                                    </span>
                                    <?php
									echo '<p>'.string_len(base64_decode($rest['short_det'],true),700).'</p>';
									echo '<div class="row mg-room-fecilities">';
										$ch_prop = $dbc->Query("select * from property_icon where property = '".$rest['id']."' ");
										
										while($line = $dbc->Fetch($ch_prop))
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
									echo '</div>';
									
									echo '<a href="/'.$rest['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

					}
				}
			}
			
		}
		//print_r($propcate);
		//echo '</pre>';
		
	}
	else
	{
		
		//echo "*****select * from properties   where status > 0 ".$Destination." ".$SubDes." ".$price." ".$Room." ".$sorted." <br><br><br><br><br>";//".$guest." 
		$sql = $dbc->Query("select * from properties   where status > 0 ".$Destination." ".$SubDes." ".$price." ".$sorted." ");// ".$guest." ".$Room."
		$num = $dbc->Getnum($sql);
		
		
		
		/*echo '<pre>';
		echo count($arr_room_load);
		print_r($arr_room_load);		
		echo '</pre>';*/
		
		if(count($arr_room_load)>0)
		{
			echo '
			<div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
			<div  style="margin-left:0px;">
			<h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$zz.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
			<h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
			<br>
			</div>
			</div>';
			//echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.'</h2>
			  //<h4 style="    font-family: pt !important;">Displaying '.$zz.' hand picked villas in your search </h4><br></div>';
		}
		else
		{
			echo '
			<div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
			<div  style="margin-left:0px;">
			<h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$num.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
			<h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
			<br>
			</div>
			</div>';
				//echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.'</h2>
			 // <h4 style="    font-family: pt !important;">Displaying '.$num.' hand picked villas in your search </h4><br></div>';
		}
		
						
		if($num<=0)
		{
				?>
                <br>
                <center><font size="+5" color="#f05b46"><img src="/upload/notfound.png" width="200"></font><br><br><font size="+2" color="#112845">Not Found Please try again</font></center>
                <?php			
		}
		else
		{
			$x=0;
			while($row = $dbc->Fetch($sql))
			{
				//echo '------------'.$row['tag'];
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
				$name = explode("|",$row['name']);
				if($view=='grid')
				{
					
					if(count($arr_room_load)>0)
					{
						if(in_array($row['id'],$arr_room_load))
						{
							$x++;
							
							echo '<div class="col-xs-12 col-sm-6 col-md-6">';//<a href="?page=blogdetail&blog='.$r_blog['id'].'">
								echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><div class="col-md-12 boxpho nopad">';
								if($row['tag']!=0)
								{
									echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
								}
									echo ''.slide_photo($photo,$row['id'].'-s').'';
									//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" width="100%"></a>';
								echo '</div></a>';
								echo '<div class="col-md-12 boxbot_b nopad">';
									echo '<div class="col-md-12 borbo nopad">';
										echo '<div class="col-md-9 nopad">';
											echo '<h2 class="btitle" ><strong>'.$name[0].'</strong></h2>'; 
										echo '</div>';
										echo '<div class="col-md-3 nopad text-right" style="font-size:14px;margin-top: 22px;">';
										$rev = $dbc->GetCount("rating","property=".$row['id']);
											echo $rev.' Reviews'; 
										echo '</div>';
									echo '</div>';
									
									echo '<div class="col-md-12 nopad">';
										echo '<div class="col-sm-8 nopad" style="font-size: 14px;">';
										$ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' limit 1");
										while($line = $dbc->Fetch($ch_prop))
										{
											$icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
														echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
														echo '&nbsp;&nbsp;'.$icon['name'];
										}
											echo '<br>'.string_len(base64_decode($row['brief'],true),40);
										echo '</div>';
										echo '<div class="col-sm-4 nopad text-right">';
											echo '<span  style="font-size: 12px;    float: left;    padding-left: 30px;">FROM </span><br>';
											echo '<span style="font-size: 32px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($row['price']).'</span>';
											echo '<span style="font-size: 12px;">++ /NT</span>';
										echo '</div>';
									echo '</div>';
	
								echo '</div>';
							echo '</div>';						}
					}
					else
					{
							echo '<div class="col-xs-12 col-sm-6 col-md-6">';//<a href="?page=blogdetail&blog='.$r_blog['id'].'">
								echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><div class="col-md-12 boxpho nopad">';
								if($row['tag']!=0)
								{
									echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
								}
									echo ''.slide_photo($photo,$row['id'].'-s').'';
									//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" width="100%"></a>';
								echo '</div></a>';
								echo '<div class="col-md-12 boxbot_b nopad">';
									echo '<div class="col-md-12 borbo nopad">';
										echo '<div class="col-md-9 nopad">';
											echo '<h2 class="btitle" ><strong>'.$name[0].'</strong></h2>'; 
										echo '</div>';
										echo '<div class="col-md-3 nopad text-right" style="font-size:14px;margin-top: 22px;">';
										$rev = $dbc->GetCount("rating","property=".$row['id']);
											echo $rev.' Reviews'; 
										echo '</div>';
									echo '</div>';
									
									echo '<div class="col-md-12 nopad">';
										echo '<div class="col-sm-8 nopad" style="font-size: 14px;">';
										$ch_prop = $dbc->Query("select * from property_icon where property = '".$row['id']."' limit 1");
										while($line = $dbc->Fetch($ch_prop))
										{
											$icon = $dbc->GetRecord("icons","*","id=".$line['icon']);
														echo '<img src="'.json_decode($icon['icon'],true).'" class="micon"></i>';
														echo '&nbsp;&nbsp;'.$icon['name'];
										}
											echo '<br>'.string_len(base64_decode($row['brief'],true),40);
										echo '</div>';
										echo '<div class="col-sm-4 nopad text-right">';
											echo '<span  style="font-size: 12px;    float: left;    padding-left: 30px;">FROM </span><br>';
											echo '<span style="font-size: 32px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($row['price']).'</span>';
											echo '<span style="font-size: 12px;">++ /NT</span>';
										echo '</div>';
									echo '</div>';
	
								echo '</div>';
							echo '</div>';

					}
				}
				else
				{
					//echo '<pre>'.$row['id']."</pre>";
					if(count($arr_room_load)>0)
					{
						if(in_array($row['id'],$arr_room_load))
						{
							$x++;
							$ft = ($x==1)?'ftt':'';
							//echo '---yes';
							//echo '>>>'.$row['id']."<br>";
							//echo '<!--room-->';
							echo '<div class="mg-avl-room">';
								echo '<div class="row">';
									//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><div class="col-sm-6">';
									echo '<div class="col-sm-6">';
									//echo "---------".$row['actualbed'];
										if($row['tag']!=0)
										{
											echo '<div class="tags_bar '.$ft.'"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
										}
										//echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
										//echo ''.slide_photo($photo,$row['id'].'-ss').'';
										echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
										//echo '////////////////////'.$row['ht_link'];
									echo '</div>';
									echo '<div class="col-sm-6">';
										echo '<h2 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;">'.$name[0].'</a> <!--<span>$249<sup>.99</sup>/Night</span>--></h2>';
										echo '<span>'.base64_decode($row['brief']).'</span><br>';
										echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
									//echo '</div>';
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
											
											while($line = $dbc->Fetch($ch_prop))
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
										echo '</div>';
										
										
										echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
									echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							//echo '<!--room-->';
						}
					}
					else
					{
						//echo '>>>'.$row['id']."<br>";
						//echo '<!--room-->';
						$x++;
							$ft = ($x==1)?'ftt':'';
						echo '<div class="mg-avl-room">';
							echo '<div class="row">';
								//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><div class="col-sm-6">';
								echo '<div class="col-sm-6">';
								//echo "---------".$row['actualbed'];
									if($row['tag']!=0)
									{
										echo '<div class="tags_bar '.$ft.'"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
									}
									//echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
									//echo '0000'.slide_photo($photo,$row['id'].'-s').'';
									echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img src="'.$photo[0]['img'].'" alt="" class="img-responsive"></a>';
									//echo '////////////////////'.$row['ht_link'];
								echo '</div>';
								echo '<div class="col-sm-6">';
									echo '<h2 class="mg-avl-room-title"><a href="/'.$row['ht_link'].'.html" style="text-transform:uppercase;">'.$name[0].'</a> <!--<span>$249<sup>.99</sup>/Night</span>--></h2>';
									echo '<span>'.base64_decode($row['brief']).'</span><br>';
									echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range '.$row['price_range'].'</span></span>';
									//echo '</div>';
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
										
										while($line = $dbc->Fetch($ch_prop))
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
									echo '</div>';
									
									echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
								echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						//echo '<!--room-->';

					}
					
				}
				
			}
		}

	}
	///echo '//--------'.$x;
	/*if($_REQUEST['t_Collection']!='')
	{
		if($_REQUEST['t_Collection']==0)
		{
			$cate="";
		}
		else
		{
			$cate="AND category = '".$_REQUEST['t_Collection']."'";
		}
		
	}
	else
	{
	}*/
	
	

	
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

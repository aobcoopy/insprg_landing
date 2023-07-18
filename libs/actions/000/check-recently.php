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
	
	if(count($_SESSION['recent_all'])>0)
	{
		?>
		<div class="col-md-12 nopad bottom50">
		<center>
		<h1 class="mtop255" style="    text-transform: uppercase;" > Interested in one of your recently viewed villas?</h1>
		<?php /*?><h2 class="f16" style="    font-family: pt !important;">Discover Private Pool Villas For Rent</h2><?php */?>
		</center>
		</div>
			<div class="container nopad t_t11">
			<?php
						//echo '<div class="col-md-12 nopad">';
						//echo '<pre>';
		//				print_r($_SESSION['recent_all']);
		//				echo '</pre>';
		//				$ks = $_SESSION['recent_all'];
		//				krsort($ks);
		//				echo '<pre>';
		//				print_r($ks);
		//				echo '</pre>';
						
						$zx=1;
						if(isset($_SESSION['recent_all']))
						{	krsort($_SESSION['recent_all']);
							foreach($_SESSION['recent_all'] as $idv)
							{
								//$row = $dbc->GetRecord("properties","*","id='".$idv."' ");
								$sql = $dbc->Query("SELECT properties.id AS id,properties.`name`,properties.brief,properties.short_det,properties.photo,properties.features,properties.price,properties.status,properties.destination AS destination,properties.bedroom,properties.tag,properties.price_range,properties.actualbed,properties.ht_link,properties.subdestination,properties.pmin,properties.pmax,property_cate.caategory,properties.adults AS adults,categories.name AS cname,properties.cate_icon AS cate_icon,destinations.name AS dname,properties.bedroom_range AS bedroom_range
			FROM properties 
			LEFT JOIN property_cate ON properties.id = property_cate.property
			LEFT JOIN categories ON properties.cate_icon = categories.id
			LEFT JOIN destinations ON properties.subdestination = destinations.id
			WHERE properties.id='".$idv."' ");
								$row = $dbc->Fetch($sql);
			
								$v_name = explode("|",$row['name']);
								$name = explode("|",$row['name']);
								$photo = json_decode($row['photo'],true);
								
								 if($row['tag']!=0)
								{
									$tag = $dbc->GetRecord("tags","*","id = '".$row['tag']."' ");
									$tag_name = $tag['name'];
								}
													
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
									case"10":
										$icon_cate = "house";
										$icon_name = "Tropical Villa";
									break;
									default:
										$icon_cate = "";
										$icon_name = "";
								}
								
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
													
													
							
							echo '<div class="mg-avl-room '.$padd_1.'1 '.$paddbutt.'1 " style="margin-bottom:41px;"><span itemscope itemtype="http://schema.org/Product" >';
                                                    echo '<span itemprop="brand" itemscope itemtype="http://schema.org/Brand"><span itemprop="name" class="tw tbrand" >Inspiring Villas</span></span>';
                                                        echo '<div class="row">';//echo $row['id'];
														
														echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t33 villa_boxs">';
														echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad villa_boxs_inside">';
                                                            //--------------------------web-----------------------------
                                                            echo '<div class="col-xs-12 col-sm-5 col-md-4 nopad t_t22">';  //-------------cheange
                                                            if($row['tag']!=0)
                                                            {
                                                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
                                                            }
                                                                echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
                                                                //echo slide_photo($photo,$row['id']);
                                                                if($zz==1)
                                                                {
                                                                    echo ' <picture><source media="(max-width: 766px)" srcset="'.imagePath_mobile($photo[0]['img']).'"><img src="'.imagePath($photo[0]['img']).'" alt="'.$img_tag.'" class="img-responsive middle_screen" style="width:100%;"></picture> </a>';
																	//echo '<img itemprop="image" src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive middle_screen" width="100%"></a>';
                                                                    
                                                                    //echo '<img itemprop="image" src="'.imagePath($photo[0]['img']).'" alt="'.$img_tag.'" class="img-responsive middle_screen" width="100%"></a>';
                                                                }
                                                                else
                                                                {   
                                                                    echo ' <picture><source media="(max-width: 766px)" srcset="'.imagePath_mobile($photo[0]['img']).'"><img src="'.imagePath($photo[0]['img']).'" alt="'.$img_tag.'" class="img-responsive lazy middle_screen" style="width:100%;"></picture> </a>';
																	//echo '<img itemprop="image" data-src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive middle_screen lazy" width="100%"></a>';
                                                                    //echo '<img itemprop="image" data-src="'.imagePath($photo[0]['img']).'" alt="'.$img_tag.'" class="img-responsive lazy middle_screen" width="100%"></a>';
                                                                }
                                                            array_push($ar_photo,"https://www.inspiringvillas.com".imagePath($photo[0]['img']));
                                                            
                                                            $ar_url[] = array(
                                                              "@type" => "ListItem",
                                                              "name" => $name[0],
                                                              "image" => "https://www.inspiringvillas.com".imagePath($photo[0]['img']),
                                                              "position" => $zz,
                                                              "url" => "https://www.inspiringvillas.com/".$row['ht_link'].".html",
                                                              /*"author"=> array(
                                                                "@type" => "Person",
                                                                "name" => "Inspiring Villas"
                                                              ),*/
                                                            );
                                                            
                                                            $ar_url_2[] = array(
                                                              "@context" => "http://schema.org/",
                                                              "@type" => "Recipe",
                                                              "name" => $name[0],
                                                              "image" => "https://www.inspiringvillas.com".imagePath($photo[0]['img']),
                                                              "position" => $zz,
                                                              "url" => "https://www.inspiringvillas.com/".$row['ht_link'].".html",
                                                              "author"=> array(
                                                                "@type" => "Person",
                                                                "name" => "Inspiring Villas"
                                                              ),
                                                            );
                                                            
                                                            //array_push($ar_url,"https://www.inspiringvillas.com/".$row['ht_link'].'.html');
                                                            
                                                            echo '<img itemprop="image" src="'.imagePath($photo[0]['img']).'" alt="" class="img-responsive " width="100%" style="display:none;">';
                                                            ?>
                                                                <span class="hidden" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
                                                                    Price Range 
                                                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
                                                                    -
                                                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
                                                                </span>
                                                                
                                                                
                                                                    <?php
                                                                
                                                            echo '</div>';
															//------------------------------------------------------------------echo '';
															echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
                                                            echo '<div class="col-xs-12 col-sm-7 col-md-8 web t_t33 v_details" style="margin-top:19px;">';  //-------------cheange
															//echo '<div class="col-xs-12 col-sm-12 col-md-8 web t_t33 v_details" style="margin-top:19px;">';
                                                            
                                                                echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t33">';
                                                                    echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11"><h3 class="mg-avl-room-title vtitle f23_2"><span itemprop="name">'.$name[0].'</span></h3></div>';//'.$row['id'].'  //-------------cheange
																	//echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11"><h3 class="mg-avl-room-title vtitle f23"><span itemprop="name">'.$name[0].'</span></h3></div>';//'.$row['id'].'
																	//echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11"><h3 class="mg-avl-room-title vtitle f23"><a href="/'.$row['ht_link'].'.html" ><span itemprop="name">'.$name[0].'</span></a></h3></div>';//'.$row['id'].'
                                                                    //echo '<div class="col-xs-12 col-sm-4 col-md-4 text-right nopad r_price tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
                                                                echo '</div>';
                                                                
                                                                echo '<div  class="top20 tb t_t44 f18t- f17Desk- f15t " ><div class="indet"><span itemprop="description" style="font-family:pt !important">'.base64_decode($row['short_det']).'</span></div></div>';
                                                                //echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range $'.$row['pmin'].' - $'.$row['pmax'].' / room nights / season</span></span>';
                                                                
                                                                //echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
                                                                //echo '</div>';
                                                                echo '<div class="gray_mob">';
                                                                    echo '<div class="row mg-room-fecilities">';
																		echo '<div class="col-xs-12 col-sm-7 col-md-5 top15 t_t11">';  //-------------cheange
                                                                        //echo '<div class="col-xs-12 col-sm-4 col-md-5 top15 t_t11">';
                                                                            echo '<ul>';
                                                                                echo '<li style="margin-bottom: -2px;">';
                                                                                    //echo '<svg width="30" height="30">';
                                                                                        echo '<image data-src="' . S3_BUCKET_URL . '/upload/location.svg"  class="micon lazy" style="width: 23px !important;"/>';
                                                                                    //echo '</svg>';
                                                                                    
                                                                                    //echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
                                                                                    echo '<div class="ic_name f15t f14ip" >&nbsp;&nbsp;'.$full_location.'</div>';
                                                                                echo '</li>';
                                                                                if($row['cate_icon']!='')
                                                                                {
                                                                                echo '<li>';
                                                                                    /*echo '<svg width="30" height="30">';
                                                                                        echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
                                                                                    echo '</svg>';*/
                                                                                    if($icon_cate == "seas")
                                                                                    {
                                                                                        echo '<image  data-src="' . S3_BUCKET_URL . '/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 28px !important;height: 32px;margin-left: -5px;" />';
                                                                                        $luxu = "Luxury ";
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo '<image  data-src="' . S3_BUCKET_URL . '/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
                                                                                        $luxu = "";
                                                                                    }
                                                                                    
                                                                                    echo '<div class="ic_name f15t" >&nbsp;&nbsp;'.$luxu.''.$icon_name.'</div>';//str_ireplace('Villas','Villa',$catename[0]).'
                                                                                echo '</li>';
                                                                                }
                                                                                else
                                                                                {
                                                                                    //echo '-----';
                                                                                }
                                                                        echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '<div class="col-xs-6 col-sm-5 col-md-3 top15 nopad t_t22">'; //-------------cheange
																	//echo '<div class="col-xs-6 col-sm-4 col-md-3 top15 nopad t_t22">';
                                                                            echo '<ul>';
                                                                                //echo '<li>';
//                                                                                    echo '<svg width="30" height="30">';
//                                                                                        echo '<image xlink:href="/upload/location.svg"  class="micon" />';
//                                                                                    echo '</svg>';
//                                                                                    echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
//                                                                                echo '</li>';
                                                                                
                                                                                echo '<li>';
                                                                                    /*echo '<svg width="30" height="30">';
                                                                                        echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
                                                                                    echo '</svg>';*/
                                                                                    echo '<image data-src="' . S3_BUCKET_URL . '/upload/bed.svg"  class="micon lazy" />';
                                                                                    echo '<div class="ic_name f15t" >&nbsp;&nbsp;'.$row['bedroom_range'].'</div>';
                                                                                    //echo '<br><br><div class="ic_name">&nbsp;&nbsp;'.$row['actualbed'].' Bedroom</div><br><br>';
                                                                                echo '</li>';
                                                                                echo '<li>';
                                                                                    /*echo '<svg width="30" height="30">';
                                                                                        echo '<image xlink:href="/upload/team.svg"  class="micon" />';
                                                                                    echo '</svg>';*/
                                                                                    echo '<image data-src="' . S3_BUCKET_URL . '/upload/team.svg"  class="micon lazy"/>';
                                                                                    echo '<div class="ic_name f15t" >&nbsp;&nbsp;'.$row['adults'].' Guests</div>';
                                                                                echo '</li>';
                                                                            echo '</ul>';
                                                                        echo '</div>';
                                                                    	
																		echo '<div class="col-xs-6 col-sm-12 col-md-4 t_price text-right nopad t_t33">'; //-------------cheange
                                                                        //echo '<div class="col-xs-6 col-sm-4 col-md-4 t_price text-right nopad t_t33">';
                                                                            echo '<div class="col-xs-12 col-sm-5 col-md-12 text-right nopad  tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>'; //-------------cheange
																			//echo '<div class="col-xs-12 col-sm-12 col-md-12 text-right nopad  tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
                                                                            echo '<div class="col-xs-12 col-sm-7 col-md-12  nopad top10 t_t31">'; //-------------cheange
																			//echo '<div class="col-xs-12 col-sm-12 col-md-12  nopad top10 t_t31">';
                                                                                echo '<button class="btn_villa btn_detail" target="_blank">View Details</button>';
																				//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
                                                                            //echo '</div>';
//                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6  nopad t_t3">';
                                                                                echo '<button class="btn_villa btn_enquire" target="_blank">Enquire Now</button>';
																				//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
                                                                                ?><?php /*?><button type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');" class="btn_villa btn_enquire" target="_blank">Enquire Now</button><?php */?><?php
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                    //echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t3">';
//                                                                        echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//                                                                    echo '</div>';
                                                                echo '</div>';
                                                            echo '</div>';
															echo '</a>';
                                                            //--------------------------web-----------------------------
                                                            echo '</div>'; //---------villa_boxs_inside
															echo '</div>'; //---------villa_boxs
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            //--------------------------mob-----------------------------
                                                            echo '<div class="col-xs-12 col-sm-12 col-md-6 mob top10">';
                                                                //echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
                                                                //echo '</div>';
                                                                echo '<div class="gray_mob ">';
                                                                    echo '<div class="row mg-room-fecilities">';
                                                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 padleft25 padright25 t_t11">';
                                                                            echo '<h3 class=" font_mob top0"><a class="fbk" href="/'.$row['ht_link'].'.html" ><span itemprop="name"><strong>'.$name[0].' </strong></span></a></h3>';
                                                                            echo '<div  class="top10 tb f15t "><span itemprop="description" class="pt">'.base64_decode($row['short_det']).'</span></div>';//f13
                                                                            echo '</div>';
                                                                            //echo '<div class="col-xs-12 col-sm-12 col-md-12 padleft25 top10 t_t41">';
                                                                            echo '<div class="col-xs-7 col-sm-6 col-md-6 padleft25 top10 t_t11">';
                                                                                echo '<ul>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30" style="padding-left: 5px;">';
//                                                                                            echo '<image xlink:href="/upload/location.svg" src="/upload/location.svg"  class="micon" style="width: 20px !important;" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="' . S3_BUCKET_URL . '/upload/location.svg"  class="micon lazy" style="width: 22px !important;padding-left: 5px;"/>';
                                                                                        //echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$full_location.'</div>';
                                                                                    echo '</li>';
                                                                                    if($row['cate_icon']!='')
                                                                                    {
                                                                                        echo '<li class="pdmb">';
                                                                                            /*echo '<svg width="30" height="30">';
                                                                                                echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
                                                                                            echo '</svg>';*/
                                                                                            if($icon_cate == "seas")
                                                                                            {
                                                                                                echo '<image data-src="' . S3_BUCKET_URL . '/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 37px;margin-left: -5px;background: #ffcdcd00;margin-top: -8px;margin-bottom: -1px !important;" />';
                                                                                                $luxu_mo = "Luxury ";
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo '<image data-src="' . S3_BUCKET_URL . '/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
                                                                                                $luxu_mo = "";
                                                                                            }
                                                                                            echo '<div class="ic_name f13">&nbsp;'.$luxu_mo.''.$icon_name.'</div>';//'.str_ireplace('Villas','Villa',$catename[0]).'
                                                                                        echo '</li>';
                                                                                    }
                                                                                echo '</ul>';
                                                                            echo '</div>';
                                                                            echo '<div class="col-xs-5 col-sm-6 col-md-6 padleft251 top10 t_t22">';
                                                                                echo '<ul>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30">';
//                                                                                            echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="' . S3_BUCKET_URL . '/upload/bed.svg"  class="micon lazy" />';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$row['bedroom_range'].'</div>';
                                                                                    echo '</li>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30">';
//                                                                                            echo '<image xlink:href="/upload/team.svg"  class="micon" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="' . S3_BUCKET_URL . '/upload/team.svg"  class="micon lazy" />';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$row['adults'].' Guests</div>';
                                                                                    echo '</li>';
                                                                                echo '</ul>';
                                                                            echo '</div>';
                                                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 t_price  t_t21">';
                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padleft top20 bottom51 t_t31">';
                                                                                echo '<div class="text-right text_price tp2">From <span class="inprice ">$'.number_format($row['pmin']).'</span> /Night</div>';
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
//                                                                        echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//                                                                    echo '</div>';
                                                                echo '</div>';
                                                            echo '</div>';
                                                            //--------------------------mob-----------------------------
                                                        echo '</div>';
                                                    echo '</span></div>';
                                                //echo '<!--room-->';
							
							
							
							
							
							
							
							
							
							
							
													
													
							
							$zz++;	
							
							
							}
						}
						//echo '</div>';
						?>
			 </div>
	<?php
	}
	else
	{
			?>
			<div class="col-md-12 nopad bottom50">
				<center>
					<?php /*?><img src="../../upload/empty.png" ><?php */?>
					<h2 class="mtop255" style="    text-transform: uppercase;" >There are no recently viewed villas available at this time</h2><br>
					<a href="/"><button class="btn btn-main text-center" style="margin: auto;">Homepage</button></a>
					<?php /*?><h2 class="f16" style="    font-family: pt !important;">Discover Private Pool Villas For Rent</h2><?php */?>
				</center>
			</div>
		<?php
	}
?>
<script>
$(document).ready(function(e) {
    $(".lazy").lazyload();
});
</script>
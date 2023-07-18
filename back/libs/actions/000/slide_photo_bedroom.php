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

?>
			<script src="/libs/js/jssor.slider-23.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:1500,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1500,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

			/*0: no auto play
			1: continuously
			2: stop at last slide
			4: stop on click
			8: stop on user navigation (click on arrow/bullet/thumbnail, swipe slide, press keyboard left, right arrow key)
			12: stop on click or user navigation*/

            var jssor_1_options = {
              $AutoPlay: 0,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 10,
                $SpacingX: 8,
                $SpacingY: 8,
                $Align: 360,
				$Idle: 10000
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 800);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <style>
        /* jssor slider arrow navigator skin 05 css */
        /*
        .jssora05l                  (normal)
        .jssora05r                  (normal)
        .jssora05l:hover            (normal mouseover)
        .jssora05r:hover            (normal mouseover)
        .jssora05l.jssora05ldn      (mousedown)
        .jssora05r.jssora05rdn      (mousedown)
        .jssora05l.jssora05lds      (disabled)
        .jssora05r.jssora05rds      (disabled)
        */
        .jssora05l, .jssora05r {
             display: block;
			position: absolute;
			width: 80px;
			height: 80px;
			cursor: pointer;
			/*background: url(libs/images/a17.png) no-repeat rgb(17, 40, 69);*/
			overflow: hidden;
			margin-top: 35px;
			/* background: rgb(255, 255, 255); */
			border-radius: 100%;
        }
		.jssora05l, .jssora05r {
			display: block;
			position: absolute;
			/*width: 40px;
			height: 40px;*/
			cursor: pointer;
			/* background: url(libs/images/a17.png) no-repeat rgb(17, 40, 69); */
			/* overflow: hidden; */
			margin-top: 35px;
			/* background: rgb(255, 255, 255); */
			border-radius: 100%;
		}
		
        .jssora05l { background-position: -10px -40px; }
        .jssora05r { background-position: -70px -40px; }
        .jssora05l:hover { background-position: -130px -40px; }
        .jssora05r:hover { background-position: -190px -40px; }
        .jssora05l.jssora05ldn { background-position: -250px -40px; }
        .jssora05r.jssora05rdn { background-position: -310px -40px; }
        .jssora05l.jssora05lds { background-position: -10px -40px; opacity: .3; pointer-events: none; }
        .jssora05r.jssora05rds { background-position: -70px -40px; opacity: .3; pointer-events: none; }
        /* jssor slider thumbnail navigator skin 01 css *//*.jssort01 .p            (normal).jssort01 .p:hover      (normal mouseover).jssort01 .p.pav        (active).jssort01 .p.pdn        (mousedown)*/
		.jssort01 .p {    position: absolute;    top: 0;    left: 0;    width: 122px;    height: 72px;}
		.jssort01 .t {    position: absolute;    top: 0;    left: 0;    width: 100%;    height: 100%;    border: none;}
		.jssort01 .w {    position: absolute;    top: 0px;    left: 0px;    width: 100%;    height: 100%;}
		.jssort01 .c {    position: absolute;    top: 0px;    left: 0px;    width: 122px;    height: 68px;    border: #000 0px solid;    box-sizing: content-box;    background: url('<?php echo $url_link;?>libs/images/t01.png') -800px -800px no-repeat;    _background: none;}
		.jssort01 .pav .c {    top: 0px;    top: 0px;    left: 0px;    left: 0px;    width: 120px;    height: 70px;    border: #000 0px solid;    border: #fff 1px solid;    background-position: 50% 50%;}
		.jssort01 .p:hover .c {    top: 0px;    left: 0px;    width: 120px;    height: 70px;    border: #fff 1px solid;    background-position: 50% 50%;}
		.jssort01 .p.pdn .c {    background-position: 50% 50%;    width: 168px;    height: 68px;    border: #000 0px solid;}
		* html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {    /* ie quirks mode adjust */    width /**/: 122px;    height /**/: 72px;}
		.jssort01 > div
		{
			width:798px !important;
			left: 0px !important;
		}
		@media screen and (max-width:992px)
		{
			.arr
			{
				right:8px;
			}
			.arl
			{
				left:8px;
			}
		}
		@media screen and (min-width:992px)
		{
			.arr
			{
				right:-52px;
			}
			.arl
			{
				left:-52px;
			}
		}
    </style>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:800px;height:500px;visibility:visible;background-color:rgba(0,0,0,0);">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.1);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('<?php echo $url_link;?>img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div  data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:800px;height:400px;" >
        
        	<?php 
			
	
			$room = $dbc->GetRecord("properties","*","id = '".$_REQUEST['room']."' ");
			
			$slide = json_decode($room['bedroom_photo'],true);
			$count = count($slide);
			$i=0;
			$vi_name = explode("|",$room['name']);
			foreach($slide as $img)
			{
				//echo '<li><img src="'.$img.'" alt="Partner Logo">'.tag($room['tag']).'</li>';
				$i++;
				echo '<div>';
				echo '<div class="tt">
				<span class="ti">'.$img['name'].'</span>
				<span class="pull-right"> '.$i.'/'.$count.'</span>
				</div>';
				//echo 'sfdsfsdfsdfsfdsfsdfsdfsfdsfsdfsdfsfdsfsdfsdfsfdsfsdfsdfsfdsfsdfsdfsfdsfsdfsdf';
					echo '<img data-u="image" src="'.imagePath($img['img']).'" alt="'.$vi_name[0].$img['name'].' '.$i.'" style="margin-top:33px;" />';
					//echo '<br><br>';
					echo '<img data-u="thumb" src="'.imagePath($img['img']).'" alt="'.$vi_name[0].$img['name'].' '.$i.'" />';
				echo '</div>';
			}
			?>
           <!-- <div>
                <img data-u="image" src="img/01.jpg" />
                <img data-u="thumb" src="img/thumb-01.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/02.jpg" />
                <img data-u="thumb" src="img/thumb-02.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/03.jpg" />
                <img data-u="thumb" src="img/thumb-03.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/04.jpg" />
                <img data-u="thumb" src="img/thumb-04.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/05.jpg" />
                <img data-u="thumb" src="img/thumb-05.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/06.jpg" />
                <img data-u="thumb" src="img/thumb-06.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/07.jpg" />
                <img data-u="thumb" src="img/thumb-07.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/08.jpg" />
                <img data-u="thumb" src="img/thumb-08.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/09.jpg" />
                <img data-u="thumb" src="img/thumb-09.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/10.jpg" />
                <img data-u="thumb" src="img/thumb-10.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/11.jpg" />
                <img data-u="thumb" src="img/thumb-11.jpg" />
            </div>
            <div>
                <img data-u="image" src="img/12.jpg" />
                <img data-u="thumb" src="img/thumb-12.jpg" />
            </div>-->
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;" data-autocenter="1">
            <!-- Thumbnail Item Skin Begin -->
            <div data-u="slides" style="cursor: default; width:798px;">
                <div data-u="prototype" class="p">
                    <div class="w">
                        <div data-u="thumbnailtemplate" class="t"></div>
                    </div>
                    <div class="c"></div>
                    <!--<div class="titles">rrrrrrrrrrrrrrrrrrr</div>-->
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora05l arl" style="top:158px;width:40px;height:40px;"><img src="<?php //echo $url_link;?>/libs/images/al.png" width="40"></span>
        <span data-u="arrowright" class="jssora05r arr" style="top:158px;width:40px;height:40px;"><img src="<?php //echo $url_link;?>/libs/images/ar.png" width="40"></span>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>
    
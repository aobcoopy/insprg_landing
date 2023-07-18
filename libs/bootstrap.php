<?php ob_start('ob_gzhandler');
 $offset = 60 * 60 * 24 * 7; // 7 Day 
 $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
 header($ExpStr);
 header("Pragma: no-cache"); 
 //header("Cache-Control: must-revalidate");
?>
<!doctype html><html><head> <meta http-equiv="X-UA-Compatible" content="IE=edge"> 

<?php 
    //$url_link = "http://" . $_SERVER['SERVER_NAME'] . "/";
	$url_link = "http://127.0.0.1:8013/";
	//$url_link = "http://www.ijmbe.net/";
    
    include "metatag.php";
    $page=isset($_REQUEST['page'])?$_REQUEST['page']:'home';
    //include "canonical.php";
    //include "noindex.php";
    
?>
    
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $meta_description;?>">
    <meta name="keywords" content="luxury villas,villa,facilities,inspiring,phuket">
    <meta name="author" content="Inspiringvillas">
<?php /*?><meta name="viewport" content="width=device-width, initial-scale=1"> <?php */?>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="msvalidate.01" content="E38E748C2673AE382D71A04F846950AF" />
    
    <meta property="og:title" content="<?php echo $title_tag." - IJMBE.com";?>"/>
    <meta property="og:image" content="<?php echo $photo_web;?>">
    <meta property="og:description" content="<?php echo $meta_description;?>"/>
    
    <title><?php echo $title_tag." - inspiringgroup.com";?></title>    

    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="apple-touch-icon" href="icon.jpg">
    <link href="<?php echo $url_link;?>libs/css/bootstrap.min.css" rel="stylesheet"> 
	<link href="<?php echo $url_link;?>libs/css/font-awesome.min.css" rel="stylesheet"> 
    <!--<link href="<?php echo $url_link;?>libs/css/bootstrap-datepicker3.min.css" rel="stylesheet"> 
    <link rel="preload" href="<?php echo $url_link;?>libs/css/datepicker.css" rel="stylesheet">-->
    <link href="<?php echo $url_link;?>libs/css/style.css?v=00001" rel="stylesheet"> 
    
    
    <script src="<?php echo $url_link;?>libs/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $url_link;?>libs/js/jquery-1.12.4.js"></script>
  	<script src="<?php echo $url_link;?>libs/js/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/93582642db.js" crossorigin="anonymous"></script>
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script defer src="<?php echo $url_link;?>libs/js/jquery-1.10.2-autocomplete.js"></script>-->
</head>
<body>
<?php //$page=isset($_REQUEST['page'])?$_REQUEST['page']:'home';
include "pages/header.php";

switch($page)
{   
    case"home":include "pages/page_home.php";break;
}
include "pages/footer.php";
?> 

<script defer src="<?php echo $url_link;?>libs/js/lazyload.min.js"></script>
<script defer src="<?php echo $url_link;?>libs/js/bootstrap.js"></script>
<!--<script defer src="<?php echo $url_link;?>libs/js/selectFx.js"></script>
<script defer src="<?php echo $url_link;?>libs/js/script.js?v=03"></script> -->
<!--<script defer src="<?php echo $url_link;?>libs/js/star-rating.js"></script>-->
<!--<script defer src="<?php echo $url_link;?>libs/js/bootstrap-datepicker.js"></script>-->


 </body></html>
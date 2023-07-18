<?php
$ppa = $_REQUEST['page'];   

if($ppa=='home' || !isset($ppa))
{
	$title_tag = "Overview";
	$meta_description = "International Journal of Management, Business, and Economics";
}
elseif($ppa=='about')
{
	$title_tag = "About";
	$meta_description = "International Journal of Management, Business, and Economics";
}
elseif($ppa=='authors')
{
	$title_tag = "For Authors";
	$meta_description = "International Journal of Management, Business, and Economics";
}
elseif($ppa=='login')
{
	$title_tag = "Login";
	$meta_description = "International Journal of Management, Business, and Economics";
}
elseif($ppa=='signup')
{
	$title_tag = "Signup";
	$meta_description = "International Journal of Management, Business, and Economics";
}
elseif($ppa=='issue')
{
	$title_tag = "Issue & Articles";
	$meta_description = "International Journal of Management, Business, and Economics";
}
elseif($ppa=='account')
{
	$title_tag = "Account";
	$meta_description = "International Journal of Management, Business, and Economics";
}
elseif($ppa=='search')
{
	$title_tag = "Search";
	$meta_description = "International Journal of Management, Business, and Economics";
}

	
function string_len_meta($text,$amount)
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
<?php session_start();
	include_once "../config/define.php";
	include_once "libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	$dbc = new dbc;
	$dbc->Connect();
	
	include_once "libs/bootstrap.php";
	
?>

<style>
.nopad
{
	padding:0px;
}
/* ============================================================
  switch button
============================================================ */
.switch 
{
	
	width:50px;
	margin:auto;

}

/* ============================================================
  COMMON
============================================================ */
.cmn-toggle {
  position: absolute;
  margin-left: -9999px;
  visibility: hidden;
}
.cmn-toggle + label {
  display: block;
  position: relative;
  cursor: pointer;
  outline: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
/* ============================================================
  SWITCH 1 - ROUND
============================================================ */

/* input.cmn-toggle-round + label {
  padding: 2px;
  width: 50px;
  height: 30px;
  background-color: #dddddd;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
} */

input.cmn-toggle-round + label {
  padding: 14px;
  width: 50px;
  height: 25px;
  background-color: #dddddd;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
}

input.cmn-toggle-round + label:before, input.cmn-toggle-round + label:after {
  display: block;
  position: absolute;
  top: 1px;
  left: 1px;
  bottom: 1px;
  content: "";
}
input.cmn-toggle-round + label:before {
  right: 1px;
  background-color: #f1f1f1;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
  -webkit-transition: background 0.2s;
  -moz-transition: background 0.2s;
  -o-transition: background 0.2s;
  transition: background 0.2s;
}
input.cmn-toggle-round + label:after {
  width: 28px;
  background-color: #fff;
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%;
  -ms-border-radius: 100%;
  -o-border-radius: 100%;
  border-radius: 100%;
  -webkit-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  -webkit-transition: margin 0.2s;
  -moz-transition: margin 0.2s;
  -o-transition: margin 0.2s;
  transition: margin 0.2s;
}

input.cmn-toggle-round:checked + label:before {
  background-color: #27C139;
}
input.cmn-toggle-round:checked + label:after {
  margin-left: 20px;
}

/* ============================================================
  switch button
============================================================ */
</style>
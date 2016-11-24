<?php
session_start();
include_once __DIR__. "/../Koneksi.php";
if(!isset($_SESSION['pen_id']))
	{
		header("location:index.php");
	}
?>
<head>
<style>
#header
{
	background-color:#104e4c;
	height:50px;
	text-align:center;
	font-size: 24px;
	color: white;
	margin-top: 5%;
float: left;
width: 89%;
position:relative;
}
	h1
	{
		margin-top: 1%;
margin-left: 12%;
position: absolute;
font-size: 40px;
	}


#left-menu
{
	 line-height:45px;
    height:300px;
    width:200px;
    float:left;
    padding:5px; 
	margin-top:-23px;
	margin-left:-44px;
	 z-index:-9999;
}	
  ul
  {
	 list-style-type: none;
  }
  
 #kiri1
 {
	 float:left;
	 width:10%;
	 height:102%;
	 background-color: #104e4c;
	 margin-top: -16;
	 position:relative;
	 margin-left: -8px;
 }

  #kiri2
 {
	 float:left;
	 width:1%;
height: 102%;
background-color: #ffb14d;
margin-top: -16;
 position:relative;
 }
 li:hover
 {
  background: -webkit-linear-gradient(left, white, #104e4c); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(right, white, #104e4c); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(right, white, #104e4c); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to right, white, #104e4c); /* Standard syntax */
 }

ul li{
border-bottom:3px solid gray;
}
ul li:last-child
{
border:none;
}
li { padding: 0px; }
li a { margin: 0px; display: block;}


a{text-decoration:none;color:black;}

</style>
</head>

<div id='kiri1'></div>
<div id='kiri2'></div>
<div id='header' >
	<p align='center'> Admin <?=$_SESSION['pen_nm']?> Dashboard </p>
</div>
<div id='left-menu' style='' height='500px' width='100%'>
	<ul>
		<li><a href='profile.php'>Profile</a></li>
		<li><a href='postnewclass.php'>Post New Class</a></li>
		<li><a href='openclass.php'>Open Class</a></li>
		<li><a href='waiting-conf.php'>Waiting Confirmation</a></li>
		<li><a href='activeclasses.php'>Active Classes</a></li>
		<li><a href='finduser.php'>Find User</a></li>
		<li><a href='logout.php'>Logout</a></li>
	</ul>
</div>
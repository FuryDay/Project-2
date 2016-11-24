<?php
session_start();
include_once __DIR__. "/../Koneksi.php";
if(!isset($_SESSION['zen_id']))
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
float: right;
width: 89%;
}
	h1
	{
		margin-top: 2%;
margin-left: 12%;
position: absolute;
font-size: 40px;
	}


#left-menu
{
	 line-height:45px;
    background-color:#eeeeee;
    height:300px;
    width:200px;
    float:left;
    padding:5px; 
	margin-top:5px;
}	
  ul
  {
	 list-style-type: none
  }
  
 #kiri1
 {
	 float:left;
	 width:10%;
	 height:102%;
	 background-color: #104e4c;
	 margin-top: -16;
 }

  #kiri2
 {
	 float:left;
	 width:1%;
height: 102%;
background-color: #ffb14d;
margin-top: -16;
 }

</style>
</head>

<div id='kiri1'></div>
<div id='kiri2'></div>
<div id='header' >
	<p align='center'> Admin Dashboard </p>
</div>
<div id='left-menu' style='' height='500px' width='100%'>
	<ul>
		<li><a href='addInstitute.php'>Add Institute</a></li>
		<li><a href='findInstitute.php'>Find Institute</a></li>
		<li><a href='finduser.php'>Find User</a></li>
		<li><a href='findclass.php'>Find Class</a></li>
		<li><a href='logout.php'>Logout</a></li>
	</ul>
</div>
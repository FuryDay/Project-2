<?php
@ob_start();
include_once __DIR__. "/../Koneksi.php";
?>

<?php
//validasi

if(isset($_POST['submit']))
{
	$unm=$_POST['txtunm'];
	$pass=$_POST['txtpass'];
	$error;
	if(isset($_SESSION['pen_id']))
	{
		header("location:profile.php");
	}
	if($unm=='admin'&&$pass=='Ng3l3s.c0.1d')
	{
		//login ke admin dashboard
	}
	if(empty($unm)||empty($pass))
	{
		$error="username or password is invalid";
	}
	else
	{
		
		if(!preg_match('/^[A-Z0-9]+$/',$unm))
		{
			$error='username or password is invalid';
		}
		else
		{
			$pass=md5($pass);
		$q=mysql_query("SELECT p.IDPenyelenggara,p.Alamat,p.Nama,p.Foto 
		FROM login_institusi l JOIN penyelenggara p ON l.IDPenyelenggara=p.IDPenyelenggara 
		WHERE l.IDLogin='$unm' AND l.PASSWORD='$pass'");
			if(mysql_num_rows($q)==1)
			{
				$d=mysql_fetch_array($q);
				@ob_start();
				session_start();
				$_SESSION['pen_id']=$d['IDPenyelenggara'];
				$_SESSION['pen_nm']=$d['Nama'];
				header("location:Profile.php");
			}
			else 
			{
				$error="username or password is invalid";
			}
		}
		
		
	
	}
	/*$x = 'A999';
	for($i = 0; $i < 10; $i++)
	{
    echo $x++,'<br />';
	}*/
}

?>
<head>
<style>
body{background-color:#292929}

#body
{
width: 100%;
height: 100%;
background-color: #292929;
}

#back
{
background-color: #e3e3e3;
width: 500px;
height: 442px;
top: 50%;
left:50%;
position: absolute;
-webkit-transform: translate(-50%, -50%);
border-radius:50px;
}
#content
{
background-color: #fcfcfc;
width: 366px;
float: left;
margin-top: 12%;
margin-left: 10%;
margin-right: 50%;
padding-left: 35px;
padding-top: 25px;
}

#content input
{
margin-top: 20px;
border-radius: 5px;
width: 300px;
height: 50px;
font-size: 20px;
}

#content input[type=submit] {
    padding:5px 15px; 
    background:#3693fc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
}

#content input[type=submit]:hover {
    padding:5px 15px; 
    background:green; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
}

#error{
font-size:20px;
color:red;
}

a{font-size:30px}

</style>
</head>
<?php
if(isset($_SESSION['pen_nm']))
{
	header("location:profile.php");
}
else
{
?>
<div id='body'>
	<div id='back'>
		<div id='content' >
		<a>Login Form</a>
		<br><br>
		<form method='POST'>
			<table>
				<tr>
					
					<td><input type="text" name="txtunm" placeholder='Username'></td>
				</tr>
				<tr>
					<td><input type="password" name="txtpass" placeholder='Password'></td>
				</tr>
				<tr>
					<td align='center'><input type='submit' name='submit' value='Login'></td>
				</tr>
			</table>
			 <?php
				if(isset($error))
					{
					 echo   "<div id='error'>";
					 echo isset($error) ? $error:'';
					echo'  </div>';
					}
				?>
			</form>
		</div>
	</div>
</div>
<?php
}
?>
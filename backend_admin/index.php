<?php
@ob_start();
session_start();
include_once __DIR__. "/../Koneksi.php";
?>

<?php
//validasi
if(isset($_SESSION['zen_id']))
	{
		header("location:addInstitute.php");
	}
if(isset($_POST['submit']))
{
	$unm=$_POST['txtunm'];
	$pass=$_POST['txtpass'];
	echo $_SESSION['zen_id'];
	$error;
	
	if(empty($unm)||empty($pass))
	{
		$error="username or password is invalid";
	}
	else
	{
		/*
		if(!preg_match('/^[A-Z0-9]+$/',$unm))
		{
			$error='username or password is invalid (B)';
		}*/
		//Ng3l3s.c0.1d
			if($unm=='admin'&&$pass=='Ng3l3s.c0.1d')
			{
				$_SESSION['zen_id']='admin';
				header("location:addInstitute.php");
			}
			else 
			{
				$error="username or password is invalid";
			}
		
		
		
	
	}
	/*$x = 'A999';
	for($i = 0; $i < 10; $i++)
	{
    echo $x++,'<br />';
	}*/
}

?>

<?php
if(isset($_SESSION['pen_nm']))
{
	header("location:addInstitute.php");
}
else
{
?>
<div id='body'>
	<div id='back'>
		<div id='content'>
		<form method='POST'>
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" name="txtunm"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="txtpass"></td>
				</tr>
				<tr>
					<td colspan='2' align='center'><input type='submit' name='submit' value='Login'></td>
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
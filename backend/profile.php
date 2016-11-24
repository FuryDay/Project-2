<?php
include_once __DIR__. "/../Koneksi.php";
include_once __DIR__."/menu.php";
?>


<h1>Profile</h1>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="style__.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	
<style>
	#content
	{
		height:300px;
    width:50%;
    float:left;
    padding:5px; 
		background-color:gray;
		margin-top:25px;
	}
</style>
	
	
</head>


<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
//info 
//cb=cabang
	$nm=$_POST['txtinstitute'];
	$cb=$_POST['Category']; 
	$alamat=$_POST['alamat'];
	$error = array();
	if(empty($nm))
	{
		$error['1']='Institute name must be filled';
	}
	else if(empty($cb))
	{
		$error['2']="Cabang must be choosen";
	}
	else if(empty($alamat))
	{
		$error['3']="Alamat must be filled";
	}
	else
	{
		$qq=mysql_query("Select IDProvinsi from penyelenggara where IDPenyelenggara='$_SESSION[pen_id]'");
		if($cc=mysql_fetch_array($qq))
		{
			$qqq=mysql_query("Select IDKecamatan from kecamatan where IDProvinsi='$cc[IDProvinsi]' AND Nama='$cb'");
			$ccc=mysql_fetch_array($qqq);
			$updt="UPDATE penyelenggara set IDKecamatan='$ccc[IDKecamatan]', Nama='$nm', Alamat='$alamat' where IDPenyelenggara='$_SESSION[pen_id]'";
			if(mysql_query($updt))
			{
				?>
				<script type='text/javascript'>alert('Data successfully updated');</script>
				<?php
			}
		}
	}
}
?>

<div id='content'>
<?php
$idi=$_SESSION['pen_id'];
$qery=mysql_query("Select * from penyelenggara where IDPenyelenggara='$idi'");
if($c=mysql_fetch_array($qery))
{
	
?>




<script>
    $(function() {
        var availableTags = 				
	<?php
										$isi=mysql_query("SELECT  IDKecamatan,Nama from kecamatan where IDProvinsi='$c[IDProvinsi]'");
										echo '[';
										while($data=mysql_fetch_array($isi))
										{
									echo '"'.$data['Nama'].'", ';
										}
										echo ']';
?> 
		;
        $( "#tags" ).autocomplete({
            source: availableTags
        });
    });
</script>

<form method='post'>
	<table>
		<tr>
			<td>Institute</td>
			<td><input type='text' name='txtinstitute' value="<?=$c['Nama']?>"></td>
			<td ><div style="color:red"><?php echo isset($error['1']) ? $error['1'] : '';?></div>  </td>
		</tr>
		<tr>
			<td>Cabang</td>
			<?php
			$cz=mysql_query("select Nama from kecamatan where IDKecamatan='$c[IDKecamatan]' AND IDProvinsi='$c[IDProvinsi]'");
			$d=mysql_fetch_array($cz);
			?>
			
			
			<td>
			
				<form method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td><input style="width:100%;float:center"type="text" id="tags" class="field" name="Category" value="<?=$d['Nama']?><?php echo isset($_POST['Nama']) ? $_POST['Nama'] : '';?>">	
						</tr>
					</table>
				</form>
			<td ><div style="color:red"><?php echo isset($error['2']) ? $error['2'] : '';?></div>  </td>
			</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><textarea name='alamat'><?=$c['Alamat']?></textarea></td>
			<td ><div style="color:red"><?php echo isset($error['3']) ? $error['3'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td><input type='submit' name='submit'value='submit'></td>
		</tr>
	</table>
</form>
<?php
}
?>
</div>
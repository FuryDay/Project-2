<?php
include "menu.php";
$zzxc= realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'); 
$zzxc=$zzxc.'\images\lembaga';
?>
  <h1>Add Institute</h1>
<head>
<title>Add Institute</title>


	<link rel="stylesheet" href="style__.css" type="text/css">
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js">
</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	
<style>
	#content
	{
		height:300px;
    width:75%;
    float:left;
    padding:5px; 
		background-color:gray;
		margin-top:25px;
	}
</style>
	
	
<script type="text/javascript">
function pilih_kota(provinsi)
{
	$.ajax({
        url: 'getProvinsi.php',
        data : 'provinsi='+provinsi,
        dataType: "html",
        success: function(response){
			$('#kecamatan').html(response);
        }
    });
}




function previewFile() {
  var preview = document.querySelector('img');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}
</script>
	
	
	
	
	
</head>


<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$nm=$_POST['txtinstitute'];
	$idtxt=$_POST['Category'];
	$pass=$_POST['txtpass'];
	$pv=$_POST['provinsi'];
	$kc=$_POST['kecamatan'];
	$adds=$_POST['alamat'];
	
	$error = array();
	if(empty($nm))
	{
		$error['1']='Institute name must be filled';
	}
	 if(empty($pass))
	{
		$error['3']="Password must be filled";
	}
	if (!empty($_FILES['image']['tmp_name']))
		{
			$folder=$zzxc;
			$type=$_FILES['image']['type'];
			if($type=="image/jpg"||$type=="image/jpeg"||$type=="image/png"||$type=="image/gif")
			{
				$image = basename($_FILES['image']['name']);
			}
			else
			{
				$error['4']='Image must be chosen from a file with ".jpg", ".jpeg", ".gif" , ".png" format';  
			}
		}		
	if(empty($error))
	{
		
			$in="INSERT INTO penyelenggara values('','$pv','$kc','$nm','$adds','$image')";
			if(mysql_query($in))
			{
				$pass=md5($pass);
				$zisi=mysql_query("Select IDPenyelenggara from penyelenggara order by IDPenyelenggara DESC limit 1");
				$zzisi=mysql_fetch_array($zisi);
				$IDpylgr=$zzisi['IDPenyelenggara'];
				$in2="INSERT INTO login_institusi values('$idtxt','$IDpylgr','$pass')";
				if(mysql_query($in2))
				{
					
					?>
					<script type='text/javascript'>alert(<?=$kc?>.'Has been registered');</script>
					<?php
				}
			}
	}
}
?>

<div id='content'>







<form method='post'>
	<table>
		<tr>
			<td>Institute</td>
			<td><input type='text' name='txtinstitute' value=""></td>
			<td ><div style="color:red"><?php echo isset($error['1']) ? $error['1'] : '';?></div>  </td>
		</tr>
		<tr>
			<td>ID</td>
			
			<?php
				$q=mysql_query("SELECT IDLogin FROM login_institusi  ORDER BY IDPenyelenggara DESC LIMIT 1");
				$isi=mysql_fetch_array($q);
				$zxc=$isi['IDLogin'];
				$zxc++;
			?>
			<td>
			
				<form method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td><input type="text" id="tags" readonly="true"class="field" name="Category" value="<?=$zxc?>">	
						</tr>
					</table>
				</form>
			<td ><div style="color:red"><?php echo isset($error['2']) ? $error['2'] : '';?></div>  </td>
			</td>
		</tr>
		<tr>
			<td>Password</td>
						
							<td><input type="text" name="txtpass" value=""></td>
							<td ><div style="color:red"><?php echo isset($error['3']) ? $error['3'] : '';?></div>  </td>
					
			
		</tr>
		
		<tr>
			<td>Provinsi</td>
			<td>
				<select id='provinsi' name='provinsi' onchange="pilih_kota(this.value);">
				<option value=''>--Select Province--</option>
				<?php
					$q2=mysql_query("Select * from provinsi");
					while($i2=mysql_fetch_array($q2))
					{
						echo"
							<option value='".$i2[IDProvinsi]."'>".$i2[Nama]."</option>
						";
					}
				?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Kecamatan</td>
			<td>
				<select id='kecamatan' name='kecamatan' >
				<option value=''>--Select Kecamatan--</option>
			
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Alamat</td>
			<td><textarea id='alamat' name='alamat'></textarea></td>
		</tr>
		
		<tr>
			<td>Logo</td>
			<td>
				<input name='image' type="file" onchange="previewFile()"><br>
				<img src="" height="200" alt="Image preview...">
			</td>
			<td ><div style="color:red"><?php echo isset($error['4']) ? $error['4'] : '';?></div>  </td>
		</tr>
		
		
		<tr>
			<td><input type='submit' name='submit'value='submit'></td>
		</tr>
	</table>
</form>
</div>
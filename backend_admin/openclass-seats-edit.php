<h1>Open Class - Seats-Edit</h1>
<?php
include "menu.php";
?>

<?php
	if(isset($_POST['submit']))
	{
		$nm=$_POST['nama'];
		$telp=$_POST['telp'];
		$email=$_POST['email'];
		$status=$_POST['pembayaran'];
		$QC=mysql_query("Select * from user");
		$error=array();
		if(empty($nm))
		{
			$error[0]='Nama harus di isi';	
		}
		if(empty($telp))
		{
			$error[1]='Nomor telepon harus di isi';		
		}
		if(!preg_match('/[0-9]/',$telp))
		{
			$error[1]='Nomor telepon hanya berupa angka';		
		}
		if(empty($email))
		{
			$error[2]='Email harus di isi';		
		}
		if (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',$email))
		{
			$error[2]='Format Email salah';		
		}
		while($row=mysql_fetch_array($QC))
		{
			if($email==$row['Email']&&$_GET['id']!=$row['ID'])
			{
				$error[2]='Email yang dimasukkan sudah terdaftar';	
			}
		}
		if(empty($error))
		{
			$update="UPDATE user set Nama='$nm',Telepon='$telp',Email='$email' where ID='$_GET[id]' ";
			if(mysql_query($update))
				{
					$update2="UPDATE booking set Status='$status' where IDUser='$_GET[id]' AND IDCourse='$_GET[idc]'";
					if(mysql_query($update2))
					{
						?>
						<script type='text/javascript'>alert('Data succuessfully updated');</script>
						<?php
					}
				}
		}
	}
?>

<?php
$query=mysql_query("Select u.Nama as nama,
					u.Telepon as telp,
					u.Email as email,
					c.NamaCourse as nc,
					b.Status as status
					from booking b join
					user u on u.ID=b.IDUser join
					course c on 
					c.IDCourse=b.IDCourse
					where b.IDUser='$_GET[id]' AND b.IDCourse='$_GET[idc]'
					");
		if($isi=mysql_fetch_array($query))
		{
			if($isi['status']=='0')
			{
				$st='Incomplete';
			}
			else if($isi['status']=='1')
			{
				$st='Complete';
			}
			else
			{
				$st='Cancelled';
			}
					
?>
<form method='POST'>
<div>
	<table>
		<tr>
			<td>Nama</td>
			<td><input type='text' name='nama' value="<?=$isi['nama']?>"></td>
			<td ><div style="color:red"><?php echo isset($error['0']) ? $error['0'] : '';?></div>  </td>
		</tr>
		<tr>
			<td>No. Telp</td>
			<td><input type='text' name='telp' value="<?=$isi['telp']?>"></td>
			<td ><div style="color:red"><?php echo isset($error['1']) ? $error['1'] : '';?></div>  </td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='text' name='email' value="<?=$isi['email']?>"></td>
			<td ><div style="color:red"><?php echo isset($error['2']) ? $error['2'] : '';?></div>  </td>
		</tr>
		<tr>
			<td>Reigster For</td>
			<td><?=$isi['nc']?></td>
		</tr>
		<tr>
			<td>Status Pembayaran</td>
			<td>
				<select name='pembayaran' id='pembayaran'>
					<option id="<?=$isi['status']?>"><?=$st?></option>
					<option value='0'>Incomplete</option>
					<option value='1'>Complete</option>
					<option value='2'>Cancelled</option>
				</select>
			
			</td>
		</tr>
		<tr>
		<td></td>
		<td><input type='submit' name='submit' value='Confirm Edit'></td>
		</tr>
	</table>
</div>
</form>
<?php
		}
?>
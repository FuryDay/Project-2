<?php
include "menu.php";





/*
if(isset($_POST['submit']))
{
	$nm=$_POST['txtnm'];
	$cn=$_POST['cname'];
	header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	//header("location:finduser.php?nama=$nm&cnama=$cn");
	if(empty($nm))
	{
		?>
				<script type='text/javascript'>alert('Nama harus di isi');</script>
		<?php
	}
}
*/

if(isset($_GET['nama'])&&isset($_GET['cnama']))
{
	
}
else
{
?>

<h1>Find User</h1>
<form method='GET'>
<div>
	<table>
		<tr>
			<td>Name</td>
			<td><input type='text' name='Name'></td>
		</tr>
		<tr>
			<td>Class Name</td>
			<td>
			<select name='category'>
			<?php
			$query=mysql_query("Select IDCourse as idc,NamaCourse nm from course");
			while($isi=mysql_fetch_array($query))
			{
			?>
			<option value="<?=$isi['idc']?>"><?=$isi['nm']?></option>
			
			
			<?php
			}
			?>
			</select>
			<td>
		</tr>
		
		<tr>
			<td colspan='2' align='center'><input type='Submit' name='submit' value='submit'></td>
		</tr>
	</table>
	<?php
	
	if($_GET['submit'])
	{
		$nm=$_GET['Name'];
		$cn=$_GET['Category'];
		
?>

	
<div id='content'>
	<table width='50%'>
		<tr>
			<td>Name</td>
			<td>No. Telp</td>
			<td>Email</td>
			<td>Register For</td>
			<td>Tanggal</td>
			<td>Status Pembayaran</td>
			<td></td>
		</tr>
		
		<?php
		
		
		if(!empty($_GET['delete']))
		{
			$idu=$_GET['delete'];
			$idc=$_GET['id'];
			echo $idu;
			mysql_query("UPDATE booking set status='2' where IDUser='$idu' AND IDCourse='$idc'");
			header ("location:waiting-conf.php");
		}
		if(!empty($_GET['confirm']))
		{
			$idu=$_GET['confirm'];
			$idc=$_GET['id'];
			echo $idu;
			mysql_query("UPDATE booking set status='1' where IDUser='$idu' AND IDCourse='$idc'");
			header ("location:finduser.php");
		}
		
		
		
		
		
		
		
		$query=mysql_query("SELECT u.ID as id,
	u.Nama AS nama,
	u.Telepon AS telp,
	u.Email AS email,
	c.NamaCourse AS course,
	c.IDCOurse as idc,
	b.Status AS stats,
	b.Tanggal as tgl
	FROM user u JOIN booking b
	ON 
	u.ID=b.IDUser
	JOIN course c 
	ON
	c.IDCourse=b.IDCourse
	 WHERE u.Nama LIKE'%$_GET[Name]%' AND b.IDCourse='$_GET[category]'
	");
		while($isi=mysql_fetch_array($query))
		{	
				
			?>
			<tr>
				<td><?=$isi['nama']?></td>
				<td><?=$isi['telp']?></td>
				<td><?=$isi['email']?></td>
				<?php
					if($isi['stats']==1)
					{
						$zxc='Complete';
					}
					else
					{
						$zxc='Incomplete';
					}
				?>
				<td><a href="waiting-conf-regfor.php?id=<?=$isi['idc']?>"><?=$isi['course']?></a></td>
				<td><?=$isi['tgl']?></td>
				<td><?=$zxc?></td>
				<td>
					<a href='?id=<?=$isi['idc']?>&delete=<?=$isi['id']?>'><input type='button' value='Delete'></a>
					<?php
					if($isi['stats']==0)
					{?>
						<a href='?id=<?=$isi['idc']?>&confirm=<?=$isi['id']?>'><input type='button' value='Confirm'></a>
					<?php
					}
					?>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
	<?php
		}
		
	
	?>
	
	
</div>
</form>
<?php } ?>
<h1>Open Class - Seats</h1>
<?php
include "menu.php";
$idc=$_GET['id'];
?>

<div id='content'>
	<table width='50%'>
		<tr>
			<td>Name</td>
			<td>No. Telp</td>
			<td>Email</td>
			<td>Register For</td>
			<td>Status Pembayaran</td>
			<td></td>
		</tr>
		
		<?php
		
		if(!empty($_GET['delete']))
		{
			$idu=$_GET['delete'];
			echo $idu;
			mysql_query("UPDATE booking set status='3' where IDUser='$idu' AND IDCourse='$idc'");
			header ("location:openclass-seats.php?id=$idc");
		}
		
		
		
		
		
		
		
		$query=mysql_query("SELECT u.ID as id,
	u.Nama AS nama,
	u.Telepon AS telp,
	u.Email AS email,
	c.NamaCourse AS course,
	b.Status AS stats
	FROM USER u JOIN booking b
	ON 
	u.ID=b.IDUser
	JOIN course c 
	ON
	c.IDCourse=b.IDCourse
	where b.IDCourse='$idc' ");
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
				<td><a href="openclass-seats.php?id=<?=$idc?>"><?=$isi['course']?></a></td>
				<td><?=$zxc?></td>
				<td>
					<a href="openclass-seats-edit.php?id=<?=$isi['id']?>&idc=<?=$idc?>"><input type='button' value='Edit'></a>
					<a href='?id=<?=$idc?>&delete=<?=$isi['id']?>'><input type='button' value='Delete'></a>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
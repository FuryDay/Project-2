<?php
include "menu.php";
?>
<h1>Waiting Confirmation</h1>
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
			header ("location:waiting-conf.php");
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
	where b.status='0' AND c.IDPenyelenggara='$_SESSION[pen_id]'");
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
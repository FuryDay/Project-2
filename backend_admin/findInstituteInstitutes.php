<?php
include "menu.php";
?>
<h1>Waiting Confirmation</h1>
<div id='content'>
	<table width='50%'>
		<tr>
			<td>INSTITUTE NAME</td>
			<td>CREATED ON</td>
			<td>CLASS START</td>
			<td>CABANG</td>
			<td></td>
		</tr>
		
		<?php
		$nama=$_GET['s'];
		if(!empty($_GET['delete']))
		{
			$idu=$_GET['delete'];
			$idc=$_GET['id'];
			echo $idu;
			mysql_query("UPDATE booking set status='2' where IDUser='$idu' AND IDCourse='$idc'");
			header ("location:waiting-conf.php");
		}
		
		$query=mysql_query("SELECT p.IDPenyelenggara as idp,p.Nama AS nama,p.RegisterDate AS tgl, (SELECT COUNT(*)  FROM course WHERE IDPenyelenggara=1) AS classcount,k.Nama as knm FROM
							penyelenggara p JOIN kecamatan k ON
							p.IDKecamatan=k.IDKecamatan where p.Nama like '%$nama%'");
		while($isi=mysql_fetch_array($query))
		{	
				
			?>
			<tr>
				<td><a href="findInstitute-Institute-Cabang.php?id=<?=$isi['idp']?>"><?=$isi['nama']?></a></td>
				<td><?=$isi['tgl']?></td>
				<td><a href="findInstitute-Institute-Class.php?id=<?=$isi['idp']?>"><?=$isi['classcount']?></a></td>
				<td><?=$isi['knm']?></td>
				<td>
					<a href='?id=<?=$isi['idc']?>&delete=<?=$isi['idp']?>'><input type='button' value='Delete'></a>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
<?php
include "menu.php";
		if(!empty($_GET['delete']))
		{
			$idu=$_GET['delete'];
			$idc=$_GET['id'];
			mysql_query("UPDATE penyelenggara set status='2' where IDPenyelenggara='$idu'");
		}

?>
<h1>Institutes</h1>
<head>
<title>Institutes</title>
</head>
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
		echo $_GET['tags'];
		$nama=$_GET['tags'];

		
		$q2=mysql_query("SELECT IDPenyelenggara as idp, (
				SELECT count( nama )
				FROM penyelenggara
				WHERE Nama LIKE '%C%'
				) AS jml, Nama
				FROM penyelenggara
				WHERE Nama LIKE '%$nama%' AND Status='1'");
		while($sd=mysql_fetch_array($q2))
		{
		
		$query=mysql_query("SELECT p.IDPenyelenggara as idp,p.Nama AS nama,p.RegisterDate AS tgl, (SELECT COUNT(*)  FROM course WHERE IDPenyelenggara=$sd[idp]) AS classcount,k.Nama as knm FROM
							penyelenggara p JOIN kecamatan k ON
							p.IDKecamatan=k.IDKecamatan where p.IDPenyelenggara like '%$sd[idp]%'");
			if($isi=mysql_fetch_array($query))
			{	
					
				?>
				<tr>
					<td><a href="findInstitute-Institute-Cabang.php?id=<?=$isi['idp']?>"><?=$isi['nama']?></a></td>
					<td><?=$isi['tgl']?></td>
					<td><a href="findInstitute-Institute-Class.php?id=<?=$isi['idp']?>"><?=$isi['classcount']?></a></td>
					<td><?=$isi['knm']?></td>
					<td>
						<a href='?delete=<?=$isi['idp']?>'><input type='button' value='Delete'></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</table>
</div>


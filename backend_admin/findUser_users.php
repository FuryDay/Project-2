<?php
include "menu.php";
?>
<h1>Users</h1>
<head>
<title>Users</title>
</head>
<div id='content'>
	<table width='50%'>
		<tr>
			<td>NAME</td>
			<td>PHONE NUMBER</td>
			<td>EMAIL</td>
			<td>CLASS REGISTERED</td>
			<td></td>
		</tr>
		
		<?php
		$nama=$_GET['tags'];
		if(!empty($_GET['delete']))
		{
			$idu=$_GET['delete'];
			echo $idu;
			mysql_query("UPDATE user set status='2' where IDUser='$idu'");
		}
		
		$query=mysql_query("SELECT 
				ID,
				Nama AS nama,
				Telepon AS telp,
				Email AS email,
				(SELECT COUNT(*)FROM booking WHERE IDUser=ID AND STATUS !=2)AS jml FROM 
				user WHERE Nama LIKE '%$nama%'");
		while($isi=mysql_fetch_array($query))
		{	
				
			?>
			<tr>
				<td><?=$isi['nama']?></td>
				<td><?=$isi['telp']?></td>
				<td><?=$isi['email']?></td>
				<td><a href="findInstitute-Institute-RegisteredClass.php?id=<?=$isi['ID']?>"><?=$isi['jml']?></a></td>
				<td>
					<a href='?delete=<?=$isi['ID']?>'><input type='button' value='Delete'></a>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
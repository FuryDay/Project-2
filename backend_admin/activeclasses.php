<head>
	
</head>


<h1>Active Classes</h1>
<?php
include "menu.php";
?>

<div id='content'>
	<table width='50%'>
		<tr>
			<td>Class Name</td>
			<td>Posted at ngeles</td>
			<td>Seats</td>
			<td>Hari Belajar</td>
			<td>Jam Belajar</td>
			<td></td>
		</tr>
		
		<?php
		if(!empty($_GET['finish']))
		{
			$idc=$_GET['finish'];
			mysql_query("UPDATE course set status='3' where IDCOurse='$idc'");
		}
		
		$query=mysql_query("SELECT IDCourse,NamaCourse,tanggalmulai,Capacity,REPLACE(jadwal,'-',',') AS jadwal ,Jam FROM course WHERE STATUS='1'	");
		while($isi=mysql_fetch_array($query))
		{
			$qq=mysql_query("SELECT COUNT(IDBooking) AS ja FROM booking WHERE IDCourse='$isi[IDCourse]' AND status='1'");//dapet jumlah siswa
			
				
			?>
			<tr>
				<td><?=$isi['NamaCourse']?></td>
				<td><?=$isi['tanggalmulai']?></td>
				<?php
				while($isi2=mysql_fetch_array($qq))
				{
					?>
					<td><a href="openclass-seats.php?id=<?=$isi['IDCourse']?>"><?=$isi2['ja']?>/<?=$isi['Capacity']?></a></td>
					<?php
				}
				?>
				<td><?=$isi['jadwal']?></td>
				<td><?=$isi['Jam']?></td>
				<td>
					<a href="?finish=<?$isi['IDCourse']?>"><input type='button' value='End class'></a>
				</td>
			</tr>
			<?php
			
		}
		?>
	</table>
</div>
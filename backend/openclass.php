<?php
include_once __DIR__."/menu.php";
?>
<h1>Open Class</h1>
<head>
</head>
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
		$query=mysql_query("SELECT IDCourse,NamaCourse,tanggalmulai,Capacity,REPLACE(jadwal,'-',',') AS jadwal ,Jam FROM course WHERE STATUS='4'	");
		while($isi=mysql_fetch_array($query))
		{
			$qq=mysql_query("SELECT COUNT(IDBooking) AS ja FROM booking WHERE IDCourse='$isi[IDCourse]' and status='1' ");//dapet jumlah siswa
			
				
			?>
			<tr>
				<td><a href="waiting-conf-regfor.php?id=<?=$isi['IDCourse']?>"><?=$isi['NamaCourse']?></a></td>
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
					<a href="?start=<?=$isi['IDCourse']?>"><input type='button' value='Start program'></a>
					<a href="?close=<?=$isi['IDCourse']?>"><input type='button' value='Close post'></a>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
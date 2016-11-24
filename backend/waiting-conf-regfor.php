<?php
include "menu.php";
?>



<head>
<link rel="stylesheet" href="assets/style.css">	
<link rel="stylesheet" href="assets/jquery.simple-dtpicker.css">	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="assets/jquery.simple-dtpicker.js"></script>
	<!--Load Script and Stylesheet -->
	<script type="text/javascript" src="jquery-1.3.2.js"></script>

	
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

</head>	
<h1>Class Detail</h1>
<?php
if(!empty($_GET['id']))
{
$query=mysql_query("SELECT *,REPLACE(jadwal,'-',',') AS jdwl from course where IDCourse='$_GET[id]'");
if($isi=mysql_fetch_array($query))
{
?>
<form method='POST'>
<div id='content'>
	<table>
		<tr>
			<td>Nama Kelas</td>
			<td><input type='text' readonly value="<?=$isi['NamaCourse']?>"></td>
		</tr>
		
		<tr>
			<td>Ruang</td>
			<?php
				$q=mysql_query("SELECT k.Namakelas as nk FROM jadwal j JOIN kelas k ON j.IDKelas=k.IDKelas JOIN course c ON j.IDCourse=c.IDCourse WHERE j.IDCourse='$isi[IDCourse]' LIMIT 1");
				if($is=mysql_fetch_array($q))
				{
			?>
			<td><input type='text' readonly value="<?=$is['nk']?>"></td>
				<?php } ?>
		</tr>
		
		<tr>
			<td>Kapasitas Kelas</td>
			<td><input type='text' readonly value="<?=$isi['Capacity']?>"></td>
		</tr>
		
		<tr>
			<td>Tingkat Pendidikan</td>
		<td><input type='text' readonly value="<?=$isi['Tingkat']?>"></td>
		</tr>
		
		<tr>
			<td>Metode Belajar</td>
			<?php
				$q=mysql_query("SELECT Nama from metode where ID='$isi[IDMetode]'");
				if($is=mysql_fetch_array($q))
				{
			?>
			<td><input type='text' readonly value="<?=$is['Nama']?>"></td>
				<?php } ?>
		</tr>
		
		<tr>
			<td>Subjek</td>
			<?php
				$q=mysql_query("SELECT Nama from subjek where ID='$isi[IDMetode]'");
				if($is=mysql_fetch_array($q))
				{
			?>
			<td><input type='text' readonly value="<?=$is['Nama']?>"></td>
			<?php } ?>
		</tr>
		
		<tr>
			<td>Harga</td>
			<td><input type='text' readonly value="IDR <?=$isi['Biaya']?>"></td>
		</tr>
		<tr>
			<td>Jumlah Sesi</td>
			<td><input type='text' readonly value="<?=$isi['jumlahsesi']?>"></td>
		</tr>
		
		<tr>
			<td>Hari Pertemuan</td>
			<td><input type='text' readonly value="<?=$isi['jdwl']?>"></td>
		
			 
		</tr>
		<tr><!--Jam-->
			<td>Jam pertemuan</td>
			<td><input type='text' readonly value="<?=$isi['Jam']?>"></td>
		</tr>
		<tr><!--Mulai pertemuan-->
			<td>Mulai Pertemuan</td>
			<td><input type='text' name='tglm' readonly value="<?=$isi['tanggalmulai']?>"></td>
			
		</tr>
		<tr>
			<td>Alamat</td>
			<?php
				$q=mysql_query("SELECT  Alamat FROM penyelenggara p JOIN course c ON c.IDPenyelenggara=p.IDPenyelenggara WHERE c.IDCourse='$isi[IDCourse]'");
				if($is=mysql_fetch_array($q))
				{
			?>
			<td><textarea name='alamat' readonly value=""><?=$is['Alamat']?></textarea></td>
				<?php } ?>
		</tr>
		
		<tr>
			<td>Informasi</td>
			<td><textarea name='txtinfo' readonly value=""><?=$isi['Informasi']?></textarea></td>
		</tr>
		<hr>
		<?php 
		$num=0;
			$z=mysql_query("SELECT L.Nama as n1,M.Nama as n2 FROM lecturercourse lec JOIN materi M ON lec.IDMateri=M.IDMateri JOIN lecturer L ON L.IDLecturer=lec.IDLecturer WHERE lec.IDCourse='$isi[IDCourse]'");
			while($isi2=mysql_fetch_array($z))
			{
				$num++;
		?>
		<tr>
			<td>Lecturer <?=$num?></td>
			<td><input type='text' readonly value="<?=$isi2['n1']?>"</td>
		</tr>
		<tr>
			<td>Job Lecturer <?=$num?></td>
			<td><input type='text' readonly value="<?=$isi2['n2']?>"</td>
		</tr>
			<?php } ?>
		
	</table>
		
</div>
</form>
<?php
}
}
?>

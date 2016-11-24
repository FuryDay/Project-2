<?php
include "menu.php";
?>
<h1>Registered Classes</h1>
<head>
<title>Registered Classe</title>
</head>
<div id='content'>
	<table width='50%'>
		<tr>
			<td>Class NAME</td>
			<td>Start Since</td>
			<td>Status</td>
			<td>Posted At ngeles</td>
			<td>Jam Belajar</td>
			<td>Hari Belajar</td>
			<td></td>
		</tr>
		
		<?php
		$id=$_GET['id'];
		if(!empty($_GET['delete']))
		{
			$del=$_GET['delete'];
			$idc=$_GET['id'];
			//mysql_query("UPDATE booking set status='0' where IDUser='$idu' AND IDCourse='$idc'");
			mysql_query("UPDATE course set status='0' where IDCourse='$del'");
		}
		
		$query=mysql_query("select 
			c.IDCourse as idc,
			c.NamaCourse as nc,
			c.tanggalmulai as tgl,
			c.status as status,
			c.Posted as posted,
			c.jam as jam,
			REPLACE(jadwal,'-',',') as jadwal
			from course c join booking b
			on c.IDCourse=b.IDCourse
			where b.IDUser='$id'");
		while($isi=mysql_fetch_array($query))
		{	
				
			?>
			<tr>
				<td><?=$isi['nc']?></td>
				<td><?=$isi['tgl']?></td>
				<td>
				<?php
				if($isi['status']==0)
				{
					echo "<a style='color:red'>Rejected</a>";
				}
				else if($isi['status']==1)
				{
					echo "<a style='color:Blue'>Not Started yet</a>";
				}
				else if($isi['status']==2)
				{
					echo "<a style='color:Green'>Active</a>";
				}
				else if($isi['status']==3)
				{
					echo "<a style='color:Orange'>Ends</a>";
				}
				else if($isi['status']==4)
				{
					echo "<a style='color:Yellow'>On register</a>";
				}
				?>
				</td>
				<td><?=$isi['posted']?></td>
				<td><?=$isi['jam']?></td>
				<td><?=$isi['jadwal']?></td>
				<td>
					<a href='?id=<?=$id?>&delete=<?=$isi['idc']?>'><input type='button' value='Delete'></a>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
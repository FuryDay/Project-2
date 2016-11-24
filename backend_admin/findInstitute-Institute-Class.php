<?php
include "menu.php";
$id=$_GET['id'];
$q=mysql_query("select Nama from penyelenggara where IDPenyelenggara='$id'");
if($iz=mysql_fetch_array($q))
{
?>
<h1><?=$iz['Nama']?> Classes</h1>
<head>
<title><?=$iz['Nama']?> Classes</title>
</head>
<?php
}

?>


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
			header ("location:findInstitute-Institute-Class.php?id=$idc");
		}
		
		$query=mysql_query("SELECT IDCourse as idc,
		NamaCourse AS nc,
		tanggalmulai AS strtdate,
		Status as status,
		Posted AS posted,
		jam AS jam ,
		REPLACE(jadwal,'-',',') AS jadwal 
		FROM course WHERE IDPenyelenggara=$id");
		while($isi=mysql_fetch_array($query))
		{	
				
			?>
			
			<tr>
				<td><?=$isi['nc']?></td>
				<td><?=$isi['strtdate']?></td>
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
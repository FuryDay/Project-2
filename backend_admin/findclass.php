<?php
include "menu.php";
$zzxc= realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'); 
$zzxc=$zzxc.'\images\lembaga';
	if($_GET['delete'])
	{
		$idc=$_GET['delete'];
		$query=mysql_query("UPDATE course set status='0' where IDCourse='$idc'");
	}
?>
  <h1>Find Class</h1>
<head>
<title>Find Class</title>
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="style__.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	

	
	
	
	
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
	
	#ctent td{
	 padding:0 15px 0 15px;
	}
</style>
	
<script  type="text/javascript">
    $(function() {
        var availableTags = 				
	<?php
			$isi=mysql_query("SELECT distinct NamaCourse from course");
			echo '[';
			while($data=mysql_fetch_array($isi))
			{
				echo '"'.$data['NamaCourse'].'", ';
			}
			echo ']';
?> 
		;
        $( "#tags" ).autocomplete({
            source: availableTags
        });
    });
	
	
/*	
$(document).ready(function(){
    $(".submit").click(function(){
        $("#tags").hide();
		$(".submit").hide();
		
		
    });
});*/
	
	
	
</script>
	
</head>


<div id='content'>






<form action='findclass.php' method="GET">
	<table >
		<tr>
			<td><form method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td><input type="text" id="tags" class="field" name="tags" value="<?php echo isset($_POST['NamaCourse']) ? $_POST['NamaCourse'] : '';?>">	
						</tr>
					</table>
				</form>
				</td>
		</tr>
		
		
		<tr>
			<td><input type='submit' class='submit'name='submit'value='submit'></td>
		</tr>
	</table>
		<?php
		if($_GET['submit'])
		{
		$query=mysql_query("Select c.IDCourse as idc,
					c.NamaCourse as name,
					(select count(IDBooking) from booking where IDCourse=c.IDCourse AND status='1') as current,
					c.Capacity as capacity,
					c.posted as posted,
					c.status as status,
					p.Nama as nama,
					p.IDpenyelenggara as idp
					from course c join penyelenggara p on c.IDPenyelenggara=p.IDPenyelenggara where p.Nama like '%%'");
			?>
		<table id='ctent'>
			<tr>
				<td>ID Course</td>
				<td>Nama Course</td>
				<td>Nama Penyelenggara</td>
				<td>Seats</td>
				<td>Posted</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
			<?php
			while($iz=mysql_fetch_array($query))
			{?>
			<tr>
				<td><?=$iz[idc]?></td>
				<td><?=$iz[name]?></td>
				<td><a href=findInstitute-Institute-Cabang.php?id=<?=$iz[idp]?>><?=$iz[nama]?></a></td>
				<td><?=$iz[current]?> / <?=$iz[capacity]?></td>
				<td><?=$iz[posted]?></td>
				<td>
				<?php
				if($iz['status']==0)
				{
					echo "<a style='color:red'>Rejected</a>";
				}
				else if($iz['status']==1)
				{
					echo "<a style='color:Blue'>Not Started yet</a>";
				}
				else if($iz['status']==2)
				{
					echo "<a style='color:Green'>Active</a>";
				}
				else if($iz['status']==3)
				{
					echo "<a style='color:Orange'>Ends</a>";
				}
				else if($iz['status']==4)
				{
					echo "<a style='color:Yellow'>On register</a>";
				}
				?>
				</td>
				<td>
					<a href=?delete=<?=$iz[idc]?>><input type=button value=Delete></a>
				</td>
				
			</tr>
			<?php
			}
			?>
			
			<?php
		}
		?>
		
	</table>
	
	
</form>

</div>
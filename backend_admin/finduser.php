<?php
include "menu.php";
$zzxc= realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'); 
$zzxc=$zzxc.'\images\lembaga';
?>
<h1>Find User</h1>
<head>
<title>Find User</title>
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="style__.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
$name=$_POST['Category'];
header("location:findUser-users.php?s=$name");
}
?>	
	
	
	
	
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
	
<script>
    $(function() {
        var availableTags = 				
	<?php
										$isi=mysql_query("SELECT distinct Nama from user");
										echo '[';
										while($data=mysql_fetch_array($isi))
										{
									echo '"'.$data['Nama'].'", ';
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






<form action='findUser_users.php' method="GET">
	<table>
		<tr>
			<td><form method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td><input style="width:500px;float:center"type="text" id="tags" class="field" name="tags" value="<?php echo isset($_POST['Nama']) ? $_POST['Nama'] : '';?>">	
						</tr>
					</table>
				</form>
				</td>
		</tr>
		
		
		<tr>
			<td><input type='submit' class='submit'name='submit'value='submit'></td>
		</tr>
	</table>
</form>

</div>
<?php
include "menu.php";

$zzxc= realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'); 
$zzxc=$zzxc.'\images\lembaga';
if($_SERVER['REQUEST_METHOD'] == "POST")
{
$name=$_POST['Category'];
	if(empty($name))
	{
	?>
					<script type='text/javascript'>alert('text must be filled');</script>
					<?php
	}
	else
	{header ("location:findInstituteInstitutes.php?s=$name");
	//header ("location:index.php");
	}
}
?>	
	
<h1>Find Institute</h1>
<head>
<title>Find Institute</title>

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
</style>
	
<script  type="text/javascript">
    $(function() {
        var availableTags = 				
	<?php
			$isi=mysql_query("SELECT distinct Nama from penyelenggara");
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
	
	function pilih_kota(institute)
	{
		$.ajax({
	        url: 'findInstituteInstitutes.php.php',
	        data : 'institute='+institute,
	        dataType: "html",
	        success: function(response){
				$('#kecamatan').html(response);
	        }
	    });
	}
	
</script>
	
</head>


<div id='content'>






<form action='findInstituteInstitutes.php' method="GET">
	<table>
		<tr>
			<td>
					<table>
						<tr>
							<td><input type="text" id="tags" class="field" name="tags" value="<?php echo isset($_POST['Nama']) ? $_POST['Nama'] : '';?>">	
						</tr>
					</table>
			</td>
		</tr>
		
		
		<tr>
			 <!--<button onclick="pilih_kota(tags.value)">Click me</button> -->
			<td><input type='submit' class='submit'name='submit'value='submit'></td>
		</tr>
	</table>
</form>

</div>
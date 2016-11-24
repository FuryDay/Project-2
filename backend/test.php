 
<?php
include_once __DIR__. "../Koneksi.php";
?>

<!--<script>
	function qtybarang()
	{
					

		var checkboxes = document.getElementsByName('hari');
		var vals = "";
		var z=document.getElementById("zxc");
		for (var i=0, n=checkboxes.length;i<n;i++) {
		  if (checkboxes[i].checked) 
		  {
			  if(vals=="")
			  {
				  vals=checkboxes[i].value;
			  }
			  else
			  {
				   vals =vals+"-"+checkboxes[i].value;
					 
					
			  }
			  
		 z.value= vals;
		  }
		}
		if (vals) vals = vals.substring(1);
		
	}
 </script>
 
 <body>
<div align="center" id="checkboxes">
<b>A<input type="checkbox" id='A' name="hari" class="check" value="a" onClick="qtybarang()"></b>
<b>B<input type="checkbox" id='B' name="hari" class="check" value="b" onClick="qtybarang()"></b>
<b>C<input type="checkbox" id='C' name="hari" class="check" value="c" onClick="qtybarang()"></b>
<b>D<input type="checkbox" id='D' name="hari" class="check" value="d" onClick="qtybarang()"></b>
</div>
<table align="center">
<tr>
<td>Text:</td>
<td><input type="text" name="text" id="zxc"></td>
</tr>
</table>
</body>-->




<!--

<html>
<head>
<title>jQuery add / remove textbox example</title>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery-1.3.2.js"></script>

<style type="text/css">
	div{
		padding:8px;
	}
</style>

</head>

-->

<body>

<h1>jQuery add / remove textbox example</h1>

<script type="text/javascript">

$(document).ready(function(){

    var counter = 1;
		
    $("#addButton").click(function () {
				
	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
				
		
				
	newTextBoxDiv.after().html('<label>Lecturer #'+ counter + ' : </label>' + 
	'<Select id=t'+counter+'>' 	<?php
				$q=mysql_query("select * from lecturer where IDPenyelenggara=1");
				while($isi=mysql_fetch_array($q))
				{
	?>		+
	'<option value='+<?=$isi['IDLecturer']?>+'><?=$isi['Nama']?></option>'<?php
				}
				?>+
	'</select> <br> <label> Job Lecturer #'+counter+' : </label>'+
	'<Select id=g'+counter+'>'<?php
				$q=mysql_query("select * from materi");
				while($isi=mysql_fetch_array($q))
				{
	?>		+ 
	'<option value='+<?=$isi['IDMateri']?>+'><?=$isi['Nama']?></option>'<?php
				}
				?>+	   
	'</select> ')   ;
	<!--'<input type="text"  id="textbox' + counter + '" value="" >');-->
            
	newTextBoxDiv.appendTo("#TextBoxesGroup");
				
<!--<option value=''>--Select Metode--</option>-->
				
	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Teacher #" + i + " : " + $('#t' + i).val();
	  msg += " Lesson #" + i + " : " + $('#g' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
</head><body>

<div id='TextBoxesGroup'>

</div>
<input type='button' value='Add Lecturer' id='addButton'>
<input type='button' value='Remove Lecturer' id='removeButton'>
<input type='button' value='Get TextBox Value' id='getButtonValue'>

</body>
</html>
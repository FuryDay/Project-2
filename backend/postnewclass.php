<?php
include "menu.php";
?>
<h1>Post New Class</h1>

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
    width:50%;
    float:left;
    padding:5px; 
		background-color:gray;
		margin-top:25px;
	}
</style>
</head>	
	<h1>Post New Class</h1>


		 <script> <!-- hari dicheckbox-->

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

	
	
<script type="text/javascript"> <!--add new lecturer-->

$(document).ready(function(){

    var counter = 0;
		var z=$('#jmlah');
    $("#addButton").click(function () {
				
	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
				
		
				
	newTextBoxDiv.after().html('<label>Lecturer #'+ (counter+1) + ' : </label>' + 
	'<Select name=t'+counter+' id=t'+counter+'>' 	<?php
				$q=mysql_query("select * from lecturer where IDPenyelenggara=1");
				while($isi=mysql_fetch_array($q))
				{
	?>		+
	'<option value='+<?=$isi['IDLecturer']?>+'><?=$isi['Nama']?></option>'<?php
				}
				?>+
	'</select> <br> <label> Job Lecturer #'+(counter+1)+' : </label>'+
	'<Select name=g'+counter+' id=g'+counter+'>'<?php
				$q=mysql_query("select * from materi");
				while($isi=mysql_fetch_array($q))
				{
	?>		+ 
	'<option value='+<?=$isi['IDMateri']?>+'><?=$isi['Nama']?></option>'<?php
				}
				?>+	   
	'</select> ')   ;
	newTextBoxDiv.appendTo("#TextBoxesGroup");
				
				z.val(counter+1);
	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==0){
          alert("No more textbox to remove");
          return false;
       }   
       
	counter--;
	
			 z.val(z.val()-1);
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
	
	
	
	
	
	<?php 
	if(isset($_POST['submit']))
	{
		$qery=mysql_query("SELECT IDCourse FROM course ORDER BY IDCourse DESC LIMIT 1");
		$idcourse=mysql_fetch_array($qery);
		$idc=$idcourse[0];
		$idc=$idc+1;
		$nama=$_POST['txtnm'];
		$ruang=$_POST['ruang'];
		$cpty=$_POST['txtcpty'];
		$metode=$_POST['metode'];
		$tp=$_POST['pendidikan'];
		$subjek=$_POST['subjek'];
		$harga=$_POST['txthg'];
		$sesi=$_POST['txtsesi'];
		$hari=$_POST['zxc'];
		$jam1=$_POST['txtj1'];
		$men1=$_POST['txtm1'];
		$jam2=$_POST['txtj2'];
		$men2=$_POST['txtm2'];
		$thn=$_POST['cbt'];
		$bln=$_POST['cbb'];
		$hr=$_POST['cbh'];
		$mulai=$thn.'-'.$bln.'-'.$hr;
		$alamat=$_POST['alamat'];
		$info=$_POST['txtinfo'];
		$lec=array();
		$lec2=array();
		$ewr=0;
		$z=$_POST['jmlah'];
		//$penyelenggara=$_SESSION['pen_id'];
		//dapetin data lecturer
		$lec=array();
		$lec2=array();
		if($z!=0||!empty($z))
		{
			for($i=0;$i<$z;$i++)
			{
				$lec[$i]=$_POST['t'.$i];
				$lec2[$i]=$_POST['g'.$i];
			}
		}
		$err=array();
		
		
	
		$jam=$jam1.':'.$men1.'-'.$jam2.':'.$men2; // dapet jam
		{//dapet durasi belajar
		$j1=(($jam1*60)+$men1);
		$j2=(($jam2*60)+$men2);
		$durasi=$j2-$j1;
		}
		$sxcx=0;
		
		$num=0;
		$h=(explode("-",$hari));
		//echo $h[0];
		$eddt=($sesi*7);
		$zaba=date('Y-m-d',strtotime($mulai.'+'.$eddt.' day'));
		if(empty($nama))
		{
			$err[1]='Nama Kelas tidak boleh kosong';
		}
		if(empty($ruang))
		{
			$err[2]='Pilih Ruang terlebih dahulu';
		}
		if(empty($cpty))
		{
			$err[3]='Kapasitas harus diisi';
		}
		if(!preg_match('/[0-9]/',$cpty))
		{
			$err[3]='Kapasitas hanya bisa berupa angka';
		}
		if(empty($tp))
		{
			$err[4]='Pilih Tingkat pendidikan terlebih dahulu';
		}
		if(empty($metode))
		{
			$err[5]='pilih metode terlebih dahulu';
		}
		if(empty($subjek))
		{
			$err[6]='Pilih subjek terlebih dahulu';
		}
		if(empty($harga))
		{
			$err[7]='Harga tidak boleh kosong';
		}
		if(!preg_match('/[0-9]/',$harga))
		{
			$err[7]='Harga hanya bisa berupa angka';
		}
		if(empty($sesi))
		{
			$err[8]='sesi tidak boleh kosong';
		}
		if(!preg_match('/[0-9]/',$sesi))
		{
			$err[8]='sesi hanya bisa berupa angka';
		}
		if(empty($hari))
		{
			$err[9]='Pilih minimal 1 hari';
		}
		if($jam1<$jam2)
		{
			$err[10]='Format tidak valid';
		}
		if(empty($jam))
		{
			$err[10]='Format tidak valid';
		}
		if(empty($thn)||empty($bln)||empty($hr))
		{
			$err[11]='Format tidak valid';
		}
		if(empty($alamat))
		{
			$err[12]='Alamat tidak boleh kosong';
		}
		if(empty($info))
		{
			$err[13]='Informasi tidak boleh kosong';
		}
		if($z==0||empty($z))
		{
			$err[14]='Lecturer tidak boleh kosong';
		}
		else 
		{
			for($i=0;$i<$z;$i++)
			{
				for($j=$i+1;$j<$z;$j++)
				{
					if($lec[$i]==$lec[$j]&&$lec2[$i]==$lec2[$j])
					{
					$err[14]='udah ada lecturer';
					break 2;
					}
				}
				
			}
			if(empty($err))
			{
				{//insert course
				//0 rejected
				//1 accepted
				//2 started
				//3 ended
				//4 created
					$insert2="INSERT INTO course values(null,'$_SESSION[pen_id]','$metode','$subjek','$nama','$hari','$jam','$mulai','$sesi','$harga','$tp','$durasi','$info','$cpty','4')";
					if(mysql_query($insert2))
					{
						for($i=0;$i<$z;$i++)
						{
							$insert3="INSERT INTO lecturercourse VALUES('$idc','$lec[$i]','$lec2[$i]')";
							if(mysql_query($insert3))
							{
								
							}
							else
							{
								$ewr++;
								echo 'error';
							}
						}
						
					}
					if($ewr==0){//insert jadwal
						for($i=0; date('Y-m-d', strtotime($mulai.'+'.$i.' day'))<=$zaba; $i++)
						{
							$hari=date('Y-m-d', strtotime($mulai.'+'.$i.' day'));
							$day = date('w', strtotime($mulai.'+'.$i.' day'));
							
							//echo $day.'#'.$hari.'<br><br><br><br><br>';
							for($ed=0;$ed<count($h);$ed++)
							{
								if($day==$h[$ed])
								{
									if($num==$sesi)
									{
										break;
									}
									$num++;
									if($day==0)
									{
										$ddd='Minggu';
									}
									else if($day==1)
									{
										$ddd='Senin';
									}
									else if($day==2)
									{
										$ddd='Selasa';
									}
									else if($day==3)
									{
										$ddd='Rabu';
									}
									else if($day==4)
									{
										$ddd='Kamis';
									}
									else if($day==5)
									{
										$ddd='Jumat';
									}
									else if($day==6)
									{
										$ddd='Sabtu';
									}
									//	echo 'No. '.$num.' '. $hari.'--'.$day.'<br>';
									$insert="INSERT INTO jadwal Values(null,'$ruang','$idc','$subjek','$ddd','$hari','$jam')";
									if(mysql_query($insert))
									{
													
										$sxcx++;
									}
								}	
							}		
						}
					}
				}
				if($sxcx>0)
				{
					echo 'data successfully added';
				}
			}
		}
	}
	
	?>
	
	



<form method='POST'>
<div id='content'>
	<table>
		<tr>
			<td>Nama Kelas</td>
			<td><input type="text" name='txtnm'></td>
			<td><div style="color:red"><?php echo isset($err['1']) ? $err['1'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Ruang</td>
			<td>
				<select id='ruang' name='ruang'>
				<option value=''>--Select class room--</option>
				<?php
					$query=mysql_query("select IDKelas,Namakelas from kelas where IDPenyelenggara='$_SESSION[pen_id]'");
					while($isi=mysql_fetch_array($query))
					{
						echo"
						<option value='".$isi[IDKelas]."'>".$isi[Namakelas]."</option>
						";
					}
				?>
				</select>
			</td>
			<td><div style="color:red"><?php echo isset($err['2']) ? $err['2'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Kapasitas Kelas</td>
				<td><input type='text' name='txtcpty'></input>
			</td>
			<td><div style="color:red"><?php echo isset($err['3']) ? $err['3'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Tingkat Pendidikan</td>
			<td>
				<select id='pendidikan' name='pendidikan'>
					<option value=''>--Pilih--</option>
					<option value='SD'>SD</option>
					<option value='SMP'>SMP</option>
					<option value='SMA'>SMA</option>
					<option value='S1'>S1</option>
					<option value='S2'>S2</option>
					<option value='S3'>S3</option>
				</select>
			</td>
			<td><div style="color:red"><?php echo isset($err['4']) ? $err['4'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Metode Belajar</td>
			<td>
				<select id='metode' name='metode'>
				<option value=''>--Select Metode--</option>
				<?php
					$query=mysql_query("select ID,Nama from metode");
					while($isi=mysql_fetch_array($query))
					{
						echo"
						<option value='".$isi[ID]."'>".$isi[Nama]."</option>
						";
					}
				?>
				</select>
			</td>
			<td><div style="color:red"><?php echo isset($err['5']) ? $err['5'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Subjek</td>
			<td>
				<select id='subjek' name='subjek'>
				<option value=''>--Select subjek--</option>
				<?php
					$query=mysql_query("select ID,Nama from subjek");
					while($isi=mysql_fetch_array($query))
					{
						echo"
						<option value='".$isi[ID]."'>".$isi[Nama]."</option>
						";
					}
				?>
				</select>
			</td>
			<td><div style="color:red"><?php echo isset($err['6']) ? $err['6'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Harga</td>
			<td>IDR <input type='text' name='txthg'></td>
			<td><div style="color:red"><?php echo isset($err['7']) ? $err['7'] : '';?></div>  </td>
		</tr>
		<tr>
			<td>Jumlah Sesi</td>
			<td><input type='text' name='txtsesi'></td>
			<td><div style="color:red"><?php echo isset($err['8']) ? $err['8'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Hari Pertemuan</td>
			<td><input type='checkbox' name='hari' value='1' onClick="qtybarang()"> Senin </input>
				<input type='checkbox' name='hari' value='2' onClick="qtybarang()" > Selasa </input>
				<input type='checkbox' name='hari' value='3' onClick="qtybarang()" > Rabu </input>
				<input type='checkbox' name='hari' value='4' onClick="qtybarang()" > Kamis </input>
				<input type='checkbox' name='hari' value='5' onClick="qtybarang()" > Jumat </input>
				<input type='checkbox' name='hari' value='6' onClick="qtybarang()" > Sabtu </input>
				<input type='checkbox' name='hari' value='0' onClick="qtybarang()" > Minggu </input>
			</td>
			<td><div style="color:red"><?php echo isset($err['9']) ? $err['9'] : '';?></div>  </td>
			<td>
			   <input type="text" name='zxc' id="zxc" style='visibility:hidden'>
			 </td>
		
			 
		</tr>
		<tr><!--Jam-->
			<td>Jam pertemuan</td>
			<td>
			<select name='txtj1'>
				<option value=''>--Jam--</option>
				<?php
					for($i=0;$i<24;$i++)
					{
						echo"
						<option value='".$i."'>".$i."</option>
						";
					}
				?>
			</select>:
			<select name='txtm1'>
				<option value=''>--Menit--</option>
				<?php
					for($i=0;$i<60;$i++)
					{
						echo"
						<option value='".$i."'>".$i."</option>
						";
					}
				?>
			</select>-
			<select name='txtj2'>
				<option value=''>--Jam--</option>
				<?php
					for($i=0;$i<24;$i++)
					{
						echo"
						<option value='".$i."'>".$i."</option>
						";
					}
				?>
			</select>:
			<select name='txtm2'>
				<option value=''>--Menit--</option>
				<?php
					for($i=0;$i<60;$i++)
					{
						echo"
						<option value='".$i."'>".$i."</option>
						";
					}
				?>
			</select>
			</td>
			<td><div style="color:red"><?php echo isset($err['10']) ? $err['10'] : '';?></div>  </td>
		</tr>
		<tr><!--Mulai pertemuan-->
			<td>Mulai Pertemuan</td>
			<td>
				<select value='' name='cbt'>
				<option value=''>--Tahun--</option>
					<?php
					for($i=date("Y");$i<date("Y")+2;$i++)
					{
						echo"
						<option value='".$i."'>".$i."</option>
						";
					}
				?>
				</select>
				<select value='' name='cbb'>
				<option value=''>--Bulan--</option>
					<?php
					for($i=1;$i<13;$i++)
					{
						
						if($i<10)
						{
						echo"
						<option value='0".$i."'>".$i."</option>
						";
						}
						else
						{
						echo"
						<option value='".$i."'>".$i."</option>
						";
						}
					}
				?>
				</select>
				<select value='' name='cbh'>
				<option value=''>--Tanggal--</option>
					<?php
					for($i=1;$i<32;$i++)
					{
						if($i<10)
						{
						echo"
						<option value='0".$i."'>".$i."</option>
						";
						}
						else
						{
						echo"
						<option value='".$i."'>".$i."</option>
						";
						}
					}
				?>
				</select>
			</td>
			<td><div style="color:red"><?php echo isset($err['11']) ? $err['11'] : '';?></div>  </td>
			<!--<td><input type='text' name='DoB'></input></td>
			<script type="text/javascript">
			
					$(function(){
						$('*[name=DoB]').appendDtpicker({
							"closeOnSelected": true,
							"dateOnly": true,
						"dateFormat": "YYYY-M-DD"
						});
					});
					
			</script>-->
		</tr>
		<tr>
			<td>Alamat</td>
			<td><textarea name='alamat'></textarea></td>
			<td><div style="color:red"><?php echo isset($err['12']) ? $err['12'] : '';?></div>  </td>
		</tr>
		
		<tr>
			<td>Informasi</td>
			<td><textarea name='txtinfo'></textarea></td>
			<td><div style="color:red"><?php echo isset($err['13']) ? $err['13'] : '';?></div>  </td>
		</tr>
		
	</table>
	
	<input type="text"name='jmlah' id="jmlah" value=''style="visibility:hidden">
		<div id='TextBoxesGroup'>

		</div>
		<div style="color:red"><?php echo isset($err['14']) ? $err['14'] : '';?></div>  
		<input type='button' value='Add Lecturer' id='addButton'>
		<input type='button' value='Remove Lecturer' id='removeButton'>
		
		<br><br><br><input type='submit'name='submit' value='submit'>
</div>
</form>


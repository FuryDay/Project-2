<?php
include "menu.php";
$id=$_GET['id'];
$query=mysql_query("select p.Nama as nama, k.Nama as Cabang,p.Alamat as alamat, lp.IDLogin as idp, lp.Password as pass from
penyelenggara p join kecamatan k on p.IDKecamatan=k.IDKecamatan
join
login_institusi lp on lp.IDPenyelenggara=p.IDPenyelenggara where p.IDPenyelenggara=$id");
if($z=mysql_fetch_array($query))
{

?>
<h1>Institute <?=$z['nama']?></h1>
<head>
<title>Institute <?=$z['nama']?></title>
</head>
<div id='content'>
	<table width='50%'>
		<tr>
			<td>INSTITUTE NAME</td>
			<td><?=$z['nama']?></td>
		</tr>
		<tr>
			<td>Cabang</td>
			<td><?=$z['Cabang']?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?=$z['alamat']?></td>
		</tr>
		<tr>
			<td>ID</td>
			<td><?=$z['idp']?></td>
		</tr>
		<tr>
			<td>Password</td>
		</tr>
	</table>
</div>
<?php
}
?>
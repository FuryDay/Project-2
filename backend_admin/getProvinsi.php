<?php
include "menu.php";
$provinsi=$_GET['provinsi'];
$kecamatan=mysql_query("SELECT IDKecamatan,Nama FROM kecamatan where IDProvinsi='$provinsi' order by Nama");
echo "<option>--Select Kecamatan--</option>";
while($k = mysql_fetch_array($kecamatan)){
    echo "<option value=\"".$k['IDKecamatan']."\">".$k['Nama']."</option>\n";
}
?>


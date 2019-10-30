<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM kalkulasi 
					 inner join golongan on kalkulasi.id_golongan = golongan.id_golongan
					 inner join pegawai on kalkulasi.id = pegawai.id
					 inner join gaji on kalkulasi.id_gaji = gaji.id_gaji";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
#form2 table tr #kepala {
	text-align: center;
	font-family: "Courier New", Courier, monospace;
}
#form2 table tr #kepala2 {
	text-align: center;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
}
#form2 table tr #strip {
	text-align: center;
}
</style>
</head>

<body onload="javascript : window.print();">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<p>&nbsp;</p>
</form>
<form id="form2" name="form2" method="post" action="">
  <table width="648" border="0">
    <tr>
      <td colspan="7" id="kepala2">Corporate Slave INC</td>
    </tr>
    <tr>
      <td colspan="7" id="kepala">Terima kasih telah menjadi slave kami</td>
    </tr>
    <tr>
      <td colspan="7" id="strip">----------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td>:</td>
      <td>28 Juli 2019</td>
      <td>&nbsp;</td>
      <td>Admin</td>
      <td>:</td>
      <td>Xie</td>
    </tr>
    <tr>
      <td colspan="7" id="strip">----------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td width="62">ID</td>
      <td width="3">:</td>
      <td width="213"><?php echo $row_Recordset1['id']; ?></td>
      <td width="1">&nbsp;</td>
      <td width="102">Anak</td>
      <td width="3">&nbsp;</td>
      <td width="234"><?php echo $row_Recordset1['anak']; ?></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td colspan="5"><?php echo $row_Recordset1['nama']; ?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td colspan="5"><?php echo $row_Recordset1['alamat']; ?></td>
    </tr>
    <tr>
      <td colspan="7" id="strip">----------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td>Golongan</td>
      <td>:</td>
      <td><?php echo $row_Recordset1['id_golongan']; ?></td>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Profesi</td>
      <td>:</td>
      <td><?php echo $row_Recordset1['nama_golongan']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7" id="strip">----------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td>Gaji</td>
      <td>:</td>
      <td>Rp <?php echo $row_Recordset1['gaji_pokok']; ?>,-</td>
      <td>&nbsp;</td>
      <td>Tunjangan Anak</td>
      <td>:</td>
      <td>Rp <?php echo $row_Recordset1['tunjangan_anak']; ?>,-</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Tunjangan Trans</td>
      <td>:</td>
      <td>Rp <?php echo $row_Recordset1['tunjangan_transport']; ?>,-</td>
    </tr>
    <tr>
      <td>Pajak</td>
      <td>&nbsp;</td>
      <td>Rp <?php echo $row_Recordset1['pajak']; ?>,-</td>
      <td>&nbsp;</td>
      <td>Gaji Bersih</td>
      <td>&nbsp;</td>
      <td>Rp <?php echo $row_Recordset1['jumlah']; ?>,-</td>
    </tr>
    <tr>
      <td colspan="7" id="strip">----------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="7" id="kepala">Harap simpan slip ini sebagai bukti penggajian!</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

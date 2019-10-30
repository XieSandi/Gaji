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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM pegawai";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body onload="javascript : window.print();"><center>
<h2>List of Corporate Slave</h2></center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<center>
<table width="102%" border="0">
  <tr>
    <td width="20%">Kode Perusahaan</td>
    <td width="1%">:</td>
    <td width="28%">0014435</td>
    <td width="16%">&nbsp;</td>
    <td width="14%">Bulan</td>
    <td width="1%">:</td>
    <td width="20%">April</td>
  </tr>
  <tr>
    <td>Admin</td>
    <td>:</td>
    <td>Xie</td>
    <td>&nbsp;</td>
    <td>Tahun </td>
    <td>:</td>
    <td> 2018</td>
  </tr>
</table>
<p>&nbsp;</p>
<table border="1">
  <tr>
    <td width="5%">id</td>
    <td width="20%">avatar</td>
    <td width="30%">nama</td>
    <td width="40%">alamat</td>
    <td width="5%">id_golongan</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['avatar']; ?></td>
      <td><?php echo $row_Recordset1['nama']; ?></td>
      <td><?php echo $row_Recordset1['alamat']; ?></td>
      <td><?php echo $row_Recordset1['id_golongan']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<center>
  <p>&nbsp;</p>
<p>Corporate Slave Inc</p>
</center>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

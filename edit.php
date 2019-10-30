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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pegawai SET nama=%s, alamat=%s, id_golongan=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['id_golongan'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM pegawai WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<div class="page">
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Pelanggan</li>
        <li class="breadcrumb-item active">Edit Pelanggan</li>
  </ol>
        <form action="<?php echo $editFormAction; ?>" method="POST" id="form1" name="form1" role="form" class="form-horizontal">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">ID</label>
                <input class="form-control" name="id" value="<?php echo htmlentities($row_Recordset1['id'], ENT_COMPAT, ''); ?>" id="exampleInputName" type="text" aria-describedby="nameHelp" readonly>
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Nama</label>
                <input class="form-control" name="nama" value="<?php echo htmlentities($row_Recordset1['nama'], ENT_COMPAT, ''); ?>" id="exampleInputName" type="text" aria-describedby="nameHelp" >
              </div>
            </div>
          </div>
          <div class="form-group">
          <div class="form-row">
              <div class="col-md-6">
                <label for="alamat">Alamat</label>
                <input class="form-control" name="alamat" value="<?php echo htmlentities($row_Recordset1['alamat'], ENT_COMPAT, ''); ?>" id="alamat" type="text"  >
              </div>
          <div class="col-md-6">
              <label for="kode">Golongan / Profesi</label>
            <select name="id_golongan" value="<?php echo htmlentities($row_Recordset1['id_golongan'], ENT_COMPAT, ''); ?>" class="form-control" id="kode">
                    <option value="1">Programmer</option>
                    <option value="2">Desainer</option>
            </select>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6"><br>
          </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="MM_insert" value="MM_update">
            Update  
          </button>
            <input type="hidden" name="MM_update" value="form1" />
            <input type="hidden" name="pl_id" value="<?php echo $row_Recordset1['id']; ?>" />
        </form>
</div>
<?php
mysql_free_result($Recordset1);
?>

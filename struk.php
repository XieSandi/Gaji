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
  $updateSQL = sprintf("UPDATE pelanggan SET pl_nama=%s, pl_alamat=%s, pl_telp=%s, pl_jkt_ref=%s, tl_id=%s WHERE pl_id=%s",
                       GetSQLValueString($_POST['pl_nama'], "text"),
                       GetSQLValueString($_POST['pl_alamat'], "text"),
                       GetSQLValueString($_POST['pl_telp'], "text"),
                       GetSQLValueString($_POST['pl_jkt_ref'], "int"),
                       GetSQLValueString($_POST['tl_id'], "int"),
                       GetSQLValueString($_POST['pl_id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$insertSQL = sprintf("INSERT INTO penggunaan (pl_id, pl_nama, pl_jkt_ref, pl_alamat, awal, akhir, tl_id, total, jumlah, bayar, kembalian) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						 GetSQLValueString($_POST['pl_id'], "int"),
						 GetSQLValueString($_POST['pl_nama'], "text"),
						 GetSQLValueString($_POST['pl_jkt_ref'], "int"),
						 GetSQLValueString($_POST['pl_alamat'], "text"),
						 GetSQLValueString($_POST['awal'], "int"),
						 GetSQLValueString($_POST['akhir'], "int"),
						 GetSQLValueString($_POST['tl_id'], "int"),
						 GetSQLValueString($_POST['total'], "int"),
						 GetSQLValueString($_POST['jumlah'], "int"),
						 GetSQLValueString($_POST['bayar'], "int"),
						 GetSQLValueString($_POST['kembalian'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset3 = "SELECT * FROM penggunaan";
$Recordset3 = mysql_query($query_Recordset3, $koneksi) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_free_result($Recordset3);

$colname_Recordset1 = "-1";
if (isset($_GET['pl_id'])) {
  $colname_Recordset1 = $_GET['pl_id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM pelanggan WHERE pl_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['tl_id'])) {
  $colname_Recordset2 = $_GET['tl_id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset2 = sprintf("SELECT * FROM tarif_listrik WHERE tl_id = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $koneksi) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>

<script :>

function startCalc() {
  interval = setInterval("calc()",1);  
}
function calc(){
  var awal = document.getelementbyid('awal').value;
  var akhir = document.getelementbyid('akhir').value;
  var hasil = parseint(awal) - parseint(akhir);
  document.getelementbyid('total').value = hasil;
}

</script>

<Script>
  function tambah(){
    var pertama = document.getElementById('awal').value;
    var kedua = document.getElementById('kedua').value;
    var result = parseInt(kedua) - parseInt(pertama);
    if (!isNaN(result)) {
       document.getElementById('total').value = result;
    }
  }
</script>
<Script>
  function kali(){
    var pertama = document.getElementById('total').value;
    var kedua = document.getElementById('tl_tarif').value;
    var result = parseInt(kedua) * parseInt(pertama);
    if (!isNaN(result)) {
       document.getElementById('jumlah').value = result;
    }
  }
</script>

<Script>
  function kembali(){
    var pertama = document.getElementById('jumlah').value;
    var kedua = document.getElementById('bayar').value;
    var result = parseInt(kedua) - parseInt(pertama);
    if (!isNaN(result)) {
       document.getElementById('kembalian').value = result;
    }
  }
</script>

<body onload="javascript : window.print();">
<div class="page">
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Pelanggan</li>
        <li class="breadcrumb-item active">Bayar</li>
    </ol>

    <div class="card" style="padding:20px">
    <h4>Read This!</h4>
        <p>
            Tekan tombol <strong>TAB</strong> pada form untuk mengupdate kalkulasi total harga pada form
        </p>

    </div>
    <br>
        <form action="<?php echo $editFormAction; ?>" method="POST" id="form1" name="form1" role="form" class="form-horizontal">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Nama</label>
                <input readonly class="form-control" name="pl_nama" value="<?php echo htmlentities($row_Recordset1['pl_nama'], ENT_COMPAT, ''); ?>" id="exampleInputName" type="text" aria-describedby="nameHelp" >
              </div>
              <div class="col-md-6">
                <label for="exampleInputjkp">Kode JKP</label>
                <input readonly class="form-control" name="pl_jkt_ref" value="<?php echo htmlentities($row_Recordset1['pl_jkt_ref'], ENT_COMPAT, ''); ?>" id="exampleInputjkp" type="text" aria-describedby="jkpHelp" >
              </div>
            </div>
          </div>
          <div class="form-group">
                <label for="alamat">Alamat</label>
                <input readonly class="form-control" name="pl_alamat" value="<?php echo htmlentities($row_Recordset1['pl_alamat'], ENT_COMPAT, ''); ?>" id="alamat" type="text"  >
          </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-1">
              <label for="kode">Kode tarif</label>
              <input readonly class="form-control" name="tl_id" value="<?php echo htmlentities($row_Recordset1['tl_id'], ENT_COMPAT, ''); ?>" class="form-control" id="kode" type="text"  >
              </div>
            <div class="col-md-1">
              <label for="daya">Daya</label>
              <input readonly class="form-control" name="tl_daya" value="<?php echo htmlentities($row_Recordset2['tl_daya'] , ENT_COMPAT,'' ); ?>" class="form_control" id="daya" type"text" >
            </div>
            <div class="col-md-1">
              <label for="awal">Awal</label>
              <input class="form-control"  name="awal"  class="form_control" id="awal" type"number" onkeyup='tambah();'  >
            </div>
            <div class="col-md-1">
              <label for="akhir">Akhir</label>
              <input class="form-control"  name="akhir"  class="form_control" id="kedua" type"number" onkeyup='tambah();' >
            </div>
            <div class="col-md-1">
              <label for="akhir">Total</label>
              <input class="form-control" readonly  name="total" class="form_control" id="total" type"number" onkeyup='tambah();' onkeyup='kali();'>
            </div>
            <div class="col-md-1">
              <label for="tarif">Tarif</label>
              <input readonly class="form-control" name="tl_tarif" value="<?php echo htmlentities($row_Recordset2['tl_tarif'] , ENT_COMPAT,'' ); ?>" class="form_control" id="tl_tarif" type"number" onkeyup='kali();' >
            </div>
            <div class="col-md-2">
              <label for="jumlah">Jumlah</label>
              <input readonly class="form-control" name="jumlah" class="form_control" id="jumlah" type"number" onkeyup='kembali();' >
            </div>
            <div class="col-md-2">
              <label for="akhir">bayar</label>
              <input class="form-control"  name="bayar"  class="form_control" id="bayar" type"number" onkeyup='kembali();' >
            </div>
            <div class="col-md-2">
              <label for="jkembalian">Kembalian</label>
              <input readonly class="form-control" name="kembalian" class="form_control" id="kembalian" type"number" >
            </div>
            </div>
            
          </div>
          <br>
          <button type="submit" class="btn btn-primary btn-block" name="MM_insert" value="form1">
            Input  
          </button>
            <input type="hidden" name="MM_insert" value="form1" />
            <input type="hidden" name="pl_id" value="<?php echo $row_Recordset1['pl_id']; ?>" />
        </form>
</div>
</body>
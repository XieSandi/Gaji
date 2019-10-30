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
  $updateSQL = sprintf("UPDATE pegawai SET avatar=%s, nama=%s, alamat=%s, id_golongan=%s WHERE id=%s",
                       GetSQLValueString($_POST['avatar'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['id_golongan'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kalkulasi (anak, gaji_kotor, pajak, jumlah, id, id_golongan, id_gaji) VALUES (%s,%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['anak'], "int"),
                       GetSQLValueString($_POST['gaji_kotor'], "int"),
                       GetSQLValueString($_POST['pajak'], "int"),
                       GetSQLValueString($_POST['jumlah'], "int"),
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['id_golongan'], "int"),
                       GetSQLValueString($_POST['id_gaji'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}


mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM pegawai inner join golongan on pegawai.id_golongan = golongan.id_golongan inner join gaji on golongan.id_gaji = gaji.id_gaji";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<Script>
  function tambah(){
    var pokok = document.getElementById('pokok').value;
    var anak = document.getElementById('ttl_anak').value;
	var tran = document.getElementById('tran').value;
    var result = parseInt(pokok) + parseInt(anak) + parseInt(tran);
    if (!isNaN(result)) {
       document.getElementById('gaji_kotor').value = result;
    }
  }

  function kali(){
    var anak = document.getElementById('anak').value;
    var t_anak = document.getElementById('t_anak').value;
    var result = parseInt(anak) * parseInt(t_anak);
	if (anak >= 3){
		document.getElementById('ttl_anak').value = 1500000;} 
    else if (!isNaN(result)) {
       document.getElementById('ttl_anak').value = result;
    }
  }

  function bagi(){
    var gaji_kotor = document.getElementById('gaji_kotor').value;
    var result = parseInt(gaji_kotor) * 10 /100;
    if (!isNaN(result)) {
       document.getElementById('pajak').value = result;
    }
  }
  
  function totalin(){
    var gaji_kotor = document.getElementById('gaji_kotor').value;
    var pajak = document.getElementById('pajak').value;
	var result = parseInt(gaji_kotor) - parseInt(pajak);
    if (!isNaN(result)) {
       document.getElementById('jumlah').value = result;
    }
  }
</script>


<div class="page">
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Pegawai</li>
        <li class="breadcrumb-item active">Gaji</li>
</ol>

    <div class="card" style="padding:20px">
    <h4>Read This!</h4>
        <p>
            Tekan tombol <strong>TAB</strong> pada form untuk mengupdate kalkulasi gaji pada form
        </p>

    </div>
    <br>
<form action="<?php echo $editFormAction; ?>" method="POST" id="form1" name="form1" role="form" class="form-horizontal">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
              
              <!-- ini hiden value-->
               <input readonly class="form-control" name="t_anak" value="<?php echo htmlentities($row_Recordset1['tunjangan_anak'] , ENT_COMPAT,'' ); ?>" class="form_control" id="t_anak" type"text" hidden>
               <input readonly class="form-control" name="id" value="<?php echo htmlentities($row_Recordset1['id'] , ENT_COMPAT,'' ); ?>" class="form_control" id="id" type"text" hidden>
               <input readonly class="form-control" name="id_golongan" value="<?php echo htmlentities($row_Recordset1['id_golongan'] , ENT_COMPAT,'' ); ?>" class="form_control" id="id_golongan" type"text" hidden >
               <input readonly class="form-control" name="id_gaji" value="<?php echo htmlentities($row_Recordset1['id_gaji'] , ENT_COMPAT,'' ); ?>" class="form_control" id="id_gaji" type"text" hidden >
               <!------------------->
               
                <label for="exampleInputName">Nama</label>
                <input readonly class="form-control" name="nama" value="<?php echo htmlentities($row_Recordset1['nama'], ENT_COMPAT, ''); ?>" id="exampleInputName" type="text" aria-describedby="nameHelp" >
              </div>
              <div class="col-md-6">
                <label for="exampleInputjkp">Golongan / Profesi</label>
                <input readonly class="form-control" name="pl_jkt_ref" value="<?php echo htmlentities($row_Recordset1['nama_golongan'], ENT_COMPAT, ''); ?>" id="exampleInputjkp" type="text" aria-describedby="jkpHelp" >
              </div>
			</div>
  </div>
            <div class="form-group">
          <div class="form-row">
              <div class="col-md-6">
                <label for="alamat">Alamat</label>
                <input readonly class="form-control" name="pl_alamat" value="<?php echo htmlentities($row_Recordset1['alamat'], ENT_COMPAT, ''); ?>" id="alamat" type="text"  >
          </div>
          <div class="col-md-6">
              <label for="kode">Gaji Pokok</label>
              <input readonly class="form-control" name="pokok" id="pokok"value="<?php echo htmlentities($row_Recordset1['gaji_pokok'], ENT_COMPAT, ''); ?>" class="form-control" id="kode" type="text"  >
            </div>
              </div>
  </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-2">
              <label for="akhir">Total Anak</label>
              <input class="form-control"  name="anak"  class="form_control" id="anak" type"number" onkeyup='kali();' >
            </div>
            <div class="col-md-2">
              <label for="daya">Tunjangan Anak</label>
              <input readonly class="form-control" name="ttl_anak" class="form_control" id="ttl_anak" type"text" onkeyup='kali();'>
            </div>
            <div class="col-md-2">
              <label for="akhir">Tunjangan Transport</label>
              <input class="form-control" readonly  name="tran" class="form_control" id="tran" type"number" value="<?php echo htmlentities($row_Recordset1['tunjangan_transport'] , ENT_COMPAT,'' ); ?>" onkeyup='tambah();'>
            </div>
            <div class="col-md-2">
              <label for="daya">Gaji Kotor</label>
              <input readonly class="form-control" name="gaji_kotor" class="form_control" id="gaji_kotor" type"text" onkeyup='bagi();'>
            </div>
            <div class="col-md-2">
              <label for="tarif">Pajak 10%</label>
              <input readonly class="form-control" name="pajak"  class="form_control" id="pajak" type"number" onkeyup='totalin();' >
            </div>
            <div class="col-md-2">
              <label for="jumlah">Jumlah</label>
              <input readonly class="form-control" name="jumlah" class="form_control" id="jumlah" type"number"  >
            </div>
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
        <?php
mysql_free_result($Recordset1);
?>
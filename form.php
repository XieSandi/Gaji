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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO pegawai (avatar, nama, alamat, id_golongan) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['avatar'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['id_golongan'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM pegawai";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<div class="page">
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Pegawai</li>
        <li class="breadcrumb-item active">Pegawai Baru</li>
  </ol>
        <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1" role="form">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Nama</label>
                <input class="form-control" name="nama" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Masukan Nama">
              </div>
              <div class="col-md-6">
                <label for="alamat">Alamat</label>
                <input class="form-control" name="alamat" id="alamat" type="text"  placeholder="Masukan Alamat">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
              <label for="kode">Golongan / Profesi</label>
            <select name="id_golongan" value="<?php echo htmlentities($row_Recordset1['id_golongan'], ENT_COMPAT, ''); ?>" class="form-control" id="kode">
                    <option value="1">Programmer</option>
                    <option value="2">Desainer</option>
                </select>
            </div>
          <div class="col-md-6">
            <label for="avatar">Avatar</label>
            
            <!-- ini input gambar
            
            <input class="form-control" type="file" name="avatar" id="avatar" />
            
            <!-- ini fungsi get file
			<Script>
  				//function ambil(){
    			//var avatar = document.getElementById('avatar').value
				//var avatar_txt = document.getElementById('avatar_value') = avatar;
			  	//}
				var file = $('#avatar')[0].files[0]
				if (file){
					console.log(file.name);
					}
			</script>
            -->
            
            <input class="form-control" type="text" name="avatar" id="avatar"/>
          </div>
          </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6"><br>
          </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="MM_insert" value="form1">
            Input  
          </button>
        </form>
</div>

<p>
  <?php
mysql_free_result($Recordset1);
?>
</p>
<p>&nbsp; </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
</form>

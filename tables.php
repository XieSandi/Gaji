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
$query_Recordset1 = "SELECT * FROM pegawai inner join golongan on pegawai.id_golongan = golongan.id_golongan inner join gaji on golongan.id_gaji = gaji.id_gaji";
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
        <li class="breadcrumb-item active">Data Pegawai</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
      <i class="fa fa-table"></i> Data Pegawai </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Avatar</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Golongan</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Avatar</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Golongan</th>
                  <th>Tools</th>
                </tr>
              </tfoot>
              <tbody>
 				 <?php do { ?>
    				<tr>
      				<td><?php echo $row_Recordset1['id']; ?></td>
      				<td><center><img src="avatar/<?php echo $row_Recordset1['avatar']; ?>" width="100" height="100" /></center></td>
      				<td><?php echo $row_Recordset1['nama']; ?></td>
      				<td><?php echo $row_Recordset1['alamat']; ?></td>
                    <td><?php echo $row_Recordset1['nama_golongan']; ?></td>
              <td>
                <p><a href="index.php?page=bayar&id=<?php echo $row_Recordset1['id']; ?>&id_golongan=<?php echo $row_Recordset1['id_golongan'];?>&id_gaji=<?php echo $row_Recordset1['id_gaji'];?>" class='btn btn-success'>CEK</a>
                  
                  <a href="index.php?page=edit&id=<?php echo $row_Recordset1['id'];?>" class='btn btn-warning'>EDIT</a>
                  <a href="hapus.php?id=<?php echo $row_Recordset1['id']; ?>" class='btn btn-danger'>HAPUS</a></p></td>
              </tr>
    			<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
              </tbody>
            </table>
          </div>
        </div>
</div>
</div>
    <?php
mysql_free_result($Recordset1);
?>
<table width="100%" border="0">
  <tr>
    <td width="50%"><a href="index.php?page=form" class='btn btn-primary btn-block'>Tambah Baru</a></td>
    <td width="50%"><a href="laporan.php" class='btn btn-primary btn-block'>Cetak</a></td>
  </tr>
</table>


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
$query_Recordset1 = "SELECT * FROM golongan inner join gaji where golongan.id_gaji = gaji.id_gaji";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<div class="page">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Daftar Golongan</li>
    </ol>
    <div class="card" style="padding:20px">
    <h4>Read This!</h4>
        <p>
            Gaji ditentukan melalui database berdasarkan ketentuan perusahaan
        </p>
    </div>

    <br>

    <div class="card mb-3">
        <div class="card-header">
      <i class="fa fa-table"></i> Data Gaji </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Gaji Pokok</th>
                  <th>Tunjangan Anak</th>
                  <th>Tunjangan Transport</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Gaji Pokok</th>
                  <th>Tunjangan Anak</th>
                  <th>Tunjangan Transport</th>
                </tr>
              </tfoot>
              <tbody>
 				<?php do { ?>
    				<tr>
      				<td><?php echo $row_Recordset1['id_golongan']; ?></td>
      				<td><?php echo $row_Recordset1['nama_golongan']; ?></td>
      				<td><?php echo $row_Recordset1['gaji_pokok']; ?></td>
      				<td><?php echo $row_Recordset1['tunjangan_anak']; ?></td>
                    <td><?php echo $row_Recordset1['tunjangan_transport']; ?></td>
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

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title><?= $title; ?></title>
  <!--<link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/4/css/bootstrap.min.css' ?>">
  <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.4.1.js' ?>"></script>-->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <div class="container">
    <h1>DAFTAR PERIKSA PASIEN</h1>
    <br>
    <a href="<?= base_url('index.php/daftar_c/vdaftar') ?>" class="btn btn-primary">Pendaftaran</a>
    <br><br>
    <table class="table">
      <thead>
        <tr>
          <th>NO</th>
          <th>TANGGAL</th>
          <th>KODE PASIEN</th>
          <th>PREFIX</th>
          <th>NAMA PASIEN</th>
          <th>NAMA KK</th>
          <th>ALAMAT</th>
          <th>USIA</th>
          <th>AKSI</th>
        </tr>
      </thead>
      <tbody id="targetData1">

      </tbody>
    </table>

  </div>

  </div>

  </div>
  <script type="text/javascript">
    ambilData1();

    function ambilData1() {
      $.ajax({
        type: 'POST',
        url: '<?= base_url() . "index.php/daftar_c/ambildata1" ?>',
        dataType: 'json',
        success: function(data) {
          var baris = '';
          for (var i = 0; i < data.length; i++) {
            baris += '<tr>' +
              '<td>' + (i + 1) + '</td>' +
              '<td>' + data[i].tanggal + '</td>' +
              '<td>' + data[i].kode_pasien + '</td>' +
              '<td>' + data[i].prefix + '</td>' +
              '<td>' + data[i].nama_pasien + '</td>' +
              '<td>' + data[i].nama_kk + '</td>' +
              '<td>' + data[i].alamat + '</td>' +
              '<td>' + data[i].usia + '</td>' +
              '<td><a onclick="hapusdata(' + data[i].id + ')" class="btn btn-primary">Selesai</a></td>' +
              '</tr>';
          }
          $('#targetData1').html(baris);

        }
      })
    } //end ambil data

    function hapusdata(id) {

      $.ajax({
        type: 'POST',
        data: 'id=' + id,
        url: '<?= base_url() . "index.php/daftar_c/selesai" ?>',
        success: function() {
          ambilData1();
        }
      })

    } //end hapusdata
  </script>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

  <!--<script src="<?php echo base_url() . 'assets/js/popper.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/bootstrap/4/js/bootstrap.min.js' ?>"></script>-->
</body>
<footer>
  <p style="text-align: center;"><i class="fa fa-copyright" aria-hidden="true">Copyright &copy; <?= $copy; ?> <?= date("Y"); ?> </i></p>
</footer>

</html>
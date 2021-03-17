<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" /> -->

  <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/bootstrap/4/css/bootstrap.css' ?>" />
  <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/bootstrap/dataTables/css/dataTables.bootstrap4.min.css' ?>" />

</head>

<body>


  <!-- Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!--style="width: 120%;"-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('index.php/daftar_c/vdaftar') ?>">Pendaftaran <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('index.php/daftar_c/vperiksa') ?>">Pasien<span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <!--<button class="btn btn-danger my-2 my-sm-0" type="submit">Log Out</button>-->
      <a href="<?= base_url() . 'index.php/daftar_c/logout' ?>" class="btn btn-danger my-2 my-sm-0">Log Out</a>
    </div>
  </nav>
  <!--End Nav Bar-->

  <div class="container mt-3">
    <!--<h3>Pendaftaran</h3>-->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" onclick="tambahData()">
      Tambah Pasien
    </button>


    <!-- Modal -->
    <div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">#</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body form">

            <form action="#" id="formData">
              <input type="hidden" id="id" name="id" value="">
              <div class="form-group">
                <label for="kd_pasien">Kode Pasien</label>
                <input type="text" class="form-control col-md-6" id="kd_pasien" name="kd_pasien" readonly="readonly" placeholder="Kode Pasien">
              </div>
              <!--<div class="form-group">
                <label for="prefix">Prefix</label>
                <input type="text" class="form-control col-md-4" id="prefix" name="prefix" placeholder="Prefix">
              </div>-->

              <div class="form-group">
                <label for="prefix">Prefix</label>
                <select name="prefix" class="form-control col-md-4" id="prefix">
                  <option value="">Pilih Prefix</option>
                  <option value="Tn">Tn</option>
                  <option value="Ny">Ny</option>
                  <option value="Nn">Nn</option>
                  <option value="An">An</option>
                </select>
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-group">
                <label for="nama_pasien">Nama Pasien</label>
                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" placeholder="Nama Pasien">
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group">
                <label for="nama_kk">Nama KK</label>
                <input type="text" class="form-control" id="nama_kk" name="nama_kk" placeholder="Nama KK">
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group">
                <label for="no_kk">No KK</label>
                <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="No KK">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group">
                <label for="alamat">Usia</label>
                <input type="number" class="form-control col-md-4" id="usia" name="usia" placeholder="Usia" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;">
                <div class="invalid-feedback"></div>
              </div>
            </form>


          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btnSave" onclick="simpanData()">Tambah</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>


    <div class="card">
      <!--style="width:135%"-->
      <div class="card-body">
        <table id="tbDaftar" class="table table-bordered">
          <thead style="text-align: center;">
            <tr>
              <th>No</th>
              <th>Kode Pasien</th>
              <th>Prefix</th>
              <th>Nama Pasien</th>
              <th>Nama KK</th>
              <th>No KK</th>
              <th>Alamat</th>
              <th>Usia</th>
              <th style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tbody style="text-align: center;">

          </tbody>
        </table>

      </div>
    </div>
  </div>

  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script> -->


  <script src="<?= base_url() . 'assets/js/jquery-3.3.1.slim.min.js' ?>"></script>
  <script src="<?= base_url() . 'assets/js/jquery-3.6.0.js' ?>"></script>


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- <script src="<?= base_url() . 'assets/sweetalert2/src/sweetalert2.js' ?>"></script>
  <script src="<?= base_url() . 'assets/sweetalert2/src/sweetalert2@10.js' ?>"></script>-->

  <script src="<?= base_url() . 'assets/bootstrap/4/js/popper.min.js' ?>"></script>
  <script src="<?= base_url() . 'assets/bootstrap/4/js/bootstrap.min.js' ?>"></script>


  <script src="<?= base_url() . 'assets/bootstrap/dataTables/js/jquery.dataTables.min.js' ?>"></script>
  <script src="<?= base_url() . 'assets/bootstrap/dataTables/js/dataTables.bootstrap4.min.js' ?>"></script>

  <script>
    var btnData;
    var modal = $('#modalData');
    var tbData = $('#tbDaftar');
    var formData = $('#formData');
    var modalTitle = $('#modalTitle');
    var btnSave = $('#btnSave');

    $(document).ready(function() {

      tbData.DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          "url": "<?php echo base_url() . "index.php/daftar_c/ambilData" ?>",
          "type": "POST"
        },
        "columnDef": [{
          "target": [-1],
          "orderable": false
        }]
      });
    });

    //fungsi reload datatable
    function reloadTable() {
      tbData.DataTable().ajax.reload();
    }

    //fungsi form modal tambah
    function tambahData() {
      btnSave.text('Tambah');
      btnData = 'tambah';
      formData[0].reset();
      modal.modal('show');
      modalTitle.text('Form Tambah Pasien Baru');
      formData.find('select').removeClass('is-invalid');
      formData.find('input').removeClass('is-invalid');

      $.ajax({
        type: "GET",
        url: "<?= base_url() . "index.php/daftar_c/testData" ?>",
        dataType: "json",
        success: function(hasil) {
          var x = parseInt(hasil);
          var y = x + 1;
          var z = y.toString();
          //console.log(z);
          if (hasil >= 0) {
            $('[name="kd_pasien"]').val("AA" + z);
          }
        }
      });

    }


    //fungsi simpan data
    function simpanData() {
      btnSave.text('Mohon Tunggu....');
      btnSave.attr('disabled', true);
      if (btnData == 'tambah') {

        url = "<?php echo base_url() . "index.php/daftar_c/tambahData" ?>";
      } else if (btnData == 'ubah') {
        url = "<?php echo base_url() . "index.php/daftar_c/ubahData" ?>";
      } else {
        alert('error');
      }
      $.ajax({
        type: "POST",
        url: url,
        data: formData.serialize(),
        dataType: "JSON",
        success: function(simpan) {
          if (simpan.status == 'success') {
            modal.modal('hide');
            reloadTable();
            if (btnData == 'tambah') {
              message('success', 'Data berhasil di Tambah');
            } else if (btnData == 'ubah') {
              message('success', 'Data berhasil di Ubah');
            }
          } else {
            for (i = 0; i < simpan.inputerror.length; i++) {
              $('[name="' + simpan.inputerror[i] + '"]').addClass('is-invalid');
              $('[name="' + simpan.inputerror[i] + '"]').next().text(simpan.error_string[i]);
            }
          }
          btnSave.text('Simpan data');
          btnSave.attr('disabled', false);
        },
        error: function() {
          console.log('Error Database');
        }
      });
    }

    //fungsi ambil data by id
    function byid(id, type) {
      if (type == 'ubah') {
        btnData = 'ubah';
        formData[0].reset();
      }
      $.ajax({
        type: "GET",
        url: "<?= base_url() . "index.php/daftar_c/byid/" ?>" + id,
        dataType: "JSON",
        success: function(getid) {
          if (type == 'ubah') {
            formData.find('input', 'select').removeClass('is-invalid');
            formData.find('select').removeClass('is-invalid');
            modalTitle.text('Form Ubah Data Pasien');
            btnSave.text('Ubah');
            btnSave.attr('disabled', false);
            $('[name="id"]').val(getid.id);
            $('[name="kd_pasien"]').val(getid.kode_pasien);
            $('[name="prefix"]').val(getid.prefix);
            $('[name="nama_pasien"]').val(getid.nama_pasien);
            $('[name="nama_kk"]').val(getid.nama_kk);
            $('[name="no_kk"]').val(getid.no_kk);
            $('[name="alamat"]').val(getid.alamat);
            $('[name="usia"]').val(getid.usia);
            modal.modal('show');
          } else if (type == 'hapus') {

            deleteQuestion(getid.id, getid.nama_pasien);

          } else if (type == 'periksa') {
            var id = getid.id;
            var prefix = getid.prefix;
            var kode_pasien = getid.kode_pasien;
            var nama_pasien = getid.nama_pasien;
            var nama_kk = getid.nama_kk;
            var no_kk = getid.no_kk;
            var alamat = getid.alamat;
            var usia = getid.usia;
            $.ajax({
              type: "POST",
              url: "<?= base_url('index.php/daftar_c/periksa/') ?>" + id,
              data: 'kd_pasien=' + kode_pasien + '&prefix=' + prefix + '&nama_pasien=' + nama_pasien + '&nama_kk=' + nama_kk + '&no_kk=' + no_kk + '&alamat=' + alamat + '&usia=' + usia,
              dataType: "JSON",
              success: function(response) {

                message('success', 'Data Periksa Pasien ' + getid.nama_pasien + ' Berhasil Ditambahkan');

              }
            });
          } else {
            alert('error');
          }
        }
      });
    }
    //fungsi hapus data
    function hapusData(id) {
      $.ajax({
        type: "POST",
        url: "<?= base_url('index.php/daftar_c/hapusData/') ?>" + id,
        dataType: "JSON",
        success: function(hapus) {
          reloadTable();
          message('success', 'Data berhasil di Hapus');
        }
      });
    }

    //fungsi message
    function message(icon, text) {
      Swal.fire({
        icon: icon,
        title: 'Pendaftaran Klinik Sumber Waras',
        text: text,
        showConfirmButton: false,
        showCancelButton: false,
        timer: 2000,
        timerProgressBar: true
      })
    }
    //fungsi delete question
    function deleteQuestion(id, name) {
      Swal.fire({
        title: 'Apakah Anda Yakin',
        text: "Menghapus Data " + name + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya',
      }).then((result) => {
        if (result.isConfirmed) {
          hapusData(id);
        }
      })
    }
  </script>

</body>
<footer>
  <p style="text-align: center;"><i class="fa fa-copyright" aria-hidden="true">Copyright &copy; <?= $copy; ?> <?= date("Y"); ?> </i></p>
</footer>

</html>
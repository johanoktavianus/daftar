<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_c extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Daftar_m');
    $this->load->helper('form');
    $this->load->helper('url');
  }

  public function index()
  {

    $data['copy'] = '<a href="https://www.facebook.com/johan.oktavianus.90/" style="color: black; text-decoration:none">Lie Johan Oktavianus</a>';
    $data['title'] = "Login Pendaftaran";

    //fungsi controller login
    if ($this->Daftar_m->logged_id()) {
      //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
      redirect('daftar_c/vdaftar');
    } else {

      //jika session belum terdaftar

      //set login validation
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      //set message login validation
      $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                   <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> Harus Diisi!</div></div>');

      //cek validasi login
      if ($this->form_validation->run() == TRUE) {

        //get data login dari FORM
        $username = $this->input->post("username", TRUE);
        $password = MD5($this->input->post('password', TRUE));

        //checking data login via model
        $checking = $this->Daftar_m->check_login('tbl_users', array('username' => $username), array('password' => $password));

        //jika ditemukan, maka create session
        if ($checking != FALSE) {
          foreach ($checking as $apps) {

            $session_data = array(
              'user_id'   => $apps->id_user,
              'user_name' => $apps->username,
              'user_pass' => $apps->password,
            );
            //set session userdata
            $this->session->set_userdata($session_data);

            redirect('daftar_c/vdaftar');
          }
        } else {

          $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                       <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Username atau Password Salah, Silahkan Coba Lagi!</div></div>';
          $this->load->view('v_login', $data);
        }
      } else {

        $this->load->view('v_login', $data);
      }
    }
  }

  //fungsi view daftar
  function vdaftar()
  {
    $data['copy'] = '<a href="https://www.facebook.com/johan.oktavianus.90/" style="color: black; text-decoration:none">Lie Johan Oktavianus</a>';
    $data['title'] = "Pendaftaran";
    $this->load->view('daftar', $data);
  }

  //fungsi view periksa
  function vperiksa()
  {
    $data['title'] = "List Periksa";
    $data['copy'] = '<a href="https://www.facebook.com/johan.oktavianus.90/" style="color: black; text-decoration:none">Lie Johan Oktavianus</a>';
    $this->load->view('pasien', $data);
  }

  public function ambilData()
  {

    $results = $this->Daftar_m->getDataPasien();
    $data = [];
    $no = $_POST['start'];

    //$no = isset($_POST['start']) ? $_POST[''] : '';

    foreach ($results as $result) {
      $row = array();
      $row[] = ++$no;
      $row[] = $result->kode_pasien;
      $row[] = $result->prefix;
      $row[] = $result->nama_pasien;
      $row[] = $result->nama_kk;
      $row[] = $result->no_kk;
      $row[] = $result->alamat;
      $row[] = $result->usia;
      $row[] = '
                <a href="#" class="btn btn-success btn-sm" onclick="byid(' . "'" . $result->id . "','ubah'" . ')">Ubah</a>
                <a href="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->id . "','hapus'" . ')">Hapus</a>
                <a href="#" class="btn btn-info btn-sm" onclick="byid(' . "'" . $result->id . "','periksa'" . ')">Periksa</a>
                ';
      $data[] = $row;
    }
    $output = array(
      "draw" => $_POST['draw'],
      //"draw" => isset($_POST['draw']) ? $_POST[''] : '',
      "recordsTotal" => $this->Daftar_m->count_all_data(),
      "recordsFiltered" => $this->Daftar_m->count_filtered_data(),
      "data" => $data,
    );
    $this->output->set_content_type('application/json')->set_output(json_encode($output));
  }

  //fungsi tambah data
  public function tambahData()
  {
    $this->_validasi();
    $data = [
      'kode_pasien' => htmlspecialchars($this->input->post('kd_pasien')),
      'prefix' => htmlspecialchars($this->input->post('prefix')),
      'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien')),
      'nama_kk' => htmlspecialchars($this->input->post('nama_kk')),
      'no_kk' => htmlspecialchars($this->input->post('no_kk')),
      'alamat' => htmlspecialchars($this->input->post('alamat')),
      'usia' => htmlspecialchars($this->input->post('usia'))
    ];
    if ($this->Daftar_m->tambahData($data) > 0) {
      $message['status'] = 'success';
    } else {
      $message['status'] = 'failed';
    };
    $this->output->set_content_type('application/json')->set_output(json_encode($message));
  }
  //fungsi get data id
  public function byid($id)
  {
    $data = $this->Daftar_m->getdataById($id);
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  //fungsi ubah data
  public function ubahData()
  {
    $this->_validasi();
    $data = [
      'kode_pasien' => htmlspecialchars($this->input->post('kd_pasien')),
      'prefix' => htmlspecialchars($this->input->post('prefix')),
      'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien')),
      'nama_kk' => htmlspecialchars($this->input->post('nama_kk')),
      'no_kk' => htmlspecialchars($this->input->post('no_kk')),
      'alamat' => htmlspecialchars($this->input->post('alamat')),
      'usia' => htmlspecialchars($this->input->post('usia'))
    ];
    if ($this->Daftar_m->ubahData(array('id' => $this->input->post('id')), $data) >= 0) {
      $message['status'] = 'success';
    } else {
      $message['status'] = 'failed';
    };
    $this->output->set_content_type('application/json')->set_output(json_encode($message));
  }

  //fungsi hapus data
  public function hapusdata($id)
  {
    if ($this->Daftar_m->hapusData($id) > 0) {
      $message['status'] = 'success';
    } else {
      $message['status'] = 'failed';
    };
    $this->output->set_content_type('application/json')->set_output(json_encode($message));
  }

  //fungsi periksa
  public function periksa($id)
  {

    $data = [
      'kode_pasien' => htmlspecialchars($this->input->post('kd_pasien')),
      'prefix' => htmlspecialchars($this->input->post('prefix')),
      'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien')),
      'nama_kk' => htmlspecialchars($this->input->post('nama_kk')),
      'no_kk' => htmlspecialchars($this->input->post('no_kk')),
      'alamat' => htmlspecialchars($this->input->post('alamat')),
      'usia' => htmlspecialchars($this->input->post('usia'))
    ];

    if ($this->Daftar_m->periksa(array('id' => $this->input->post('id')), $data) > 0) {
      $message['status'] = 'success';
    } else {
      $message['status'] = 'failed';
    };
    $this->output->set_content_type('application/json')->set_output(json_encode($message));
  }

  //ambil data pasien
  function ambildata1()
  {
    $dataPasien1 = $this->Daftar_m->ambildata1('tb_periksa')->result();
    echo json_encode($dataPasien1);
  } //end ambil data pasien

  //fungsi validasi form
  private function _validasi()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = true;


    if ($this->input->post('prefix') == '') {
      $data['inputerror'][] = 'prefix';
      $data['error_string'][] = 'Prefix Wajib di Isi!';
      $data['status'] = false;
    }

    if ($this->input->post('nama_pasien') == '') {
      $data['inputerror'][] = 'nama_pasien';
      $data['error_string'][] = 'Nama Pasien Wajib di Isi!';
      $data['status'] = false;
    }

    if ($this->input->post('nama_kk') == '') {
      $data['inputerror'][] = 'nama_kk';
      $data['error_string'][] = 'Nama KK Wajib di Isi!';
      $data['status'] = false;
    }

    if ($this->input->post('alamat') == '') {
      $data['inputerror'][] = 'alamat';
      $data['error_string'][] = 'Alamat Wajib di Isi!';
      $data['status'] = false;
    }

    if ($this->input->post('usia') == '') {
      $data['inputerror'][] = 'usia';
      $data['error_string'][] = 'Usia Wajib di Isi!';
      $data['status'] = false;
    }

    if ($data['status'] === false) {
      echo json_encode($data);
      exit();
    }
  }


  //fungsi selesai pasien
  function selesai()
  {
    $id = $this->input->post('id');
    $where = array('id' => $id);
    $this->Daftar_m->selesai($where, 'tb_periksa');
  } //end selesai pasien

  //fungsi penambahan otomatis id pasien
  function testData()
  {
    $testData = $this->Daftar_m->testData('tb_daftar')->result();
    $array = json_decode(json_encode($testData), true);
    $asd = $array[0];
    $abc = $asd['id'];
    echo json_encode($abc);
  }


  //fungsi log out
  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_m extends CI_Model
{
  var $table = 'tb_daftar';
  var $table1 = 'tb_periksa';
  var $table2 = 'tbl_users';
  var $column_order =  array('id', 'kode_pasien', 'prefix', 'nama_pasien', 'nama_kk', 'no_kk', 'alamat', 'usia');
  var $order = array('id', 'kode_pasien', 'prefix', 'nama_pasien', 'nama_kk', 'no_kk', 'alamat', 'usia');

  private function _get_data_query()
  {
    $this->db->from($this->table);
    if (isset($_POST['search']['value'])) {
      $this->db->like('kode_pasien', $_POST['search']['value']);
      $this->db->or_like('prefix', $_POST['search']['value']);
      $this->db->or_like('nama_pasien', $_POST['search']['value']);
      $this->db->or_like('nama_kk', $_POST['search']['value']);
      $this->db->or_like('no_kk', $_POST['search']['value']);
      $this->db->or_like('alamat', $_POST['search']['value']);
      $this->db->or_like('usia', $_POST['search']['value']);
    }
    if (isset($_POST['order'])) {
      $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else {
      $this->db->order_by('id', 'DESC');
    }
  }


  public function getDataPasien()
  {

    $this->_get_data_query();
    if ($_POST['length'] !== -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function count_filtered_data()
  {
    $this->_get_data_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all_data()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  function testData($table)
  {
    return $this->db->query('SELECT id FROM tb_daftar WHERE id = (SELECT MAX(id) FROM tb_daftar) LIMIT 1');
  }

  public function tambahData($data)
  {
    $this->db->insert('tb_daftar', $data);
    return $this->db->affected_rows();
  }

  public function getdataById($id)
  {
    return $this->db->get_where($this->table, ['id' => $id])->row();
  }

  public function ubahData($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function hapusData($id)
  {
    $this->db->delete($this->table, ['id' => $id]);
    $this->db->query('ALTER TABLE tb_daftar DROP id');
    $this->db->query('ALTER TABLE tb_daftar ADD id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
    return $this->db->affected_rows();
  }

  //fungsi tombol periksa
  public function periksa($where, $data)
  {
    $this->db->insert($this->table1, $data, $where);
    return $this->db->affected_rows();
  }

  //fungsi cek session
  function logged_id()
  {
    return $this->session->userdata('user_id');
  }

  //fungsi check login
  function check_login($table2, $field1, $field2)
  {
    $this->db->select('*');
    $this->db->from($table2);
    $this->db->where($field1);
    $this->db->where($field2);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
      return FALSE;
    } else {
      return $query->result();
    }
  }

  //fungsi ambil data pasien
  function ambildata1($table1)
  {
    return $this->db->get($table1);
  } //end ambil data pasien

  //fungsi selesai pasien
  function selesai($where, $table)
  {
    $this->db->where($where);
    $this->db->delete($table);
  } //end selesai pasien
}

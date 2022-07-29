<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
    }

    public function getDataUser($email)
    {
        $this->db->select('user.*, akses.tipe_akses, akses.kode_akses');
        $this->db->from('user');
        $this->db->join('akses', 'user.id_akses = akses.id_akses');
        $this->db->where('user.email', $email);
        $sql = $this->db->get();
        $result = $sql->row();
        return $result;
    }

    public function listMenu($roleId)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('ROLE_ID', $roleId);
        $this->db->where('PARENTMENU_ID', null);
        $this->db->where('IS_ACTIVE', '1');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function getDataByNIK($nik)
    {
        $result = $this->db->get_where('dukcapil', ['nik' => $nik]);
        return $result->row();
    }


    public function getDataOfficer($username)
    {
        $result = $this->db->get_where('officer', ['username' => $username]);
        return $result->row();
    }

    public function registerAccount($data)
    {
        $this->db->insert('participant', $data);
    }
}

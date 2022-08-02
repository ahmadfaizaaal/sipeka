<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pengajuan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
    }

    public function getIdJenisByURL($url)
    {
        $sql = $this->db->get_where('jenis', ['url' => $url]);
        $result = $sql->row();
        return $result->id_jenis;
    }

    public function getIdStatusByCode($kode)
    {
        $sql = $this->db->get_where('status', ['kode' => $kode]);
        $result = $sql->row();
        return $result->id_status;
    }

    public function getListNomorSurat($key)
    {
        $this->db->where('user_input', $this->session->userdata('id_user'));
        $this->db->like('nomor_surat', $key);
        $sql = $this->db->get('proposal');
        return $sql->result();
    }

    public function getListNomorSuratByIdKabupaten($idKabupatenKota, $key)
    {
        $this->db->where('id_kabupatenkota', $idKabupatenKota);
        $this->db->like('nomor_surat', $key);
        $sql = $this->db->get('proposal');
        return $sql->result();
    }

    public function getProposalByNomorSurat($nomorSurat)
    {
        $sql = $this->db->get_where('proposal', ['nomor_surat' => $nomorSurat]);
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return false;
        }
    }

    public function getListProvinsi($key)
    {
        $this->db->like('nama', $key);
        $sql = $this->db->get('provinsi');
        return $sql->result();
    }

    public function getListKabupatenKota($idProvinsi, $key)
    {
        $this->db->where('id_provinsi', $idProvinsi);
        $this->db->like('nama', $key);
        $sql = $this->db->get('kabupatenkota');
        return $sql->result();
    }

    public function getListKota($key)
    {
        $this->db->like('nama', $key);
        $sql = $this->db->get('kabupatenkota');
        return $sql->result();
    }

    public function getListKecamatan($idKota, $key)
    {
        $this->db->where('id_kabupatenkota', $idKota);
        $this->db->like('nama', $key);
        $sql = $this->db->get('kecamatan');
        return $sql->result();
    }

    public function getListKelurahan($idKecamatan, $key)
    {
        $this->db->where('id_kecamatan', $idKecamatan);
        $this->db->like('nama', $key);
        $sql = $this->db->get('kelurahan');
        return $sql->result();
    }

    public function getListProposal($user)
    {
        $query = "select pr.id_proposal, kb.nama as kabupaten, pr.nomor_surat, DATE_FORMAT(mp.tgl_buat, '%d-%m-%Y') as tgl_buat, st.*
                from mapping mp
                join proposal pr on mp.id_proposal = pr.id_proposal
                join pengajuan pj on mp.id_pengajuan = pj.id_pengajuan
                join status st on pj.status_pengajuan = st.id_status
                join lokasi l on pj.id_lokasi = l.id_lokasi
                join kelurahan kl on l.id_kelurahan = kl.id_kelurahan
                join kecamatan kc on kl.id_kecamatan = kc.id_kecamatan
                join kabupatenkota kb on kc.id_kabupatenkota = kb.id_kabupatenkota
                where mp.tgl_buat = (select max(mp2.tgl_buat) from mapping mp2 where mp2.id_proposal = mp.id_proposal)
                and pj.user_input = '$user'";
        $sql = $this->db->query($query);
        return $sql->result();
    }

    public function getProposal($param)
    {
        $query = "select pj.*, kb.nama as nama_kabupaten, kc.nama as nama_kecamatan, kl.nama as nama_kelurahan, pr.id_proposal, pr.nomor_surat, pk.nama_poktan, 
                pk.nama_ketua, l.koordinat_a, l.koordinat_b, st.nama_status, DATE_FORMAT(mp.tgl_buat, '%d-%m-%Y') as tgl_mapping, j.url, p.*
                from mapping mp
                join proposal pr on mp.id_proposal = pr.id_proposal
                join pengajuan pj on mp.id_pengajuan = pj.id_pengajuan
                join jenis j on pj.id_jenis = j.id_jenis
                join poktan pk on pj.id_poktan = pk.id_poktan
                join status st on pj.status_pengajuan = st.id_status
                join lokasi l on pj.id_lokasi = l.id_lokasi
                join kelurahan kl on l.id_kelurahan = kl.id_kelurahan
                join kecamatan kc on kl.id_kecamatan = kc.id_kecamatan
                join kabupatenkota kb on kc.id_kabupatenkota = kb.id_kabupatenkota
                join user u on pj.user_input = u.id_user
				join profil p on u.id_user = p.id_user";
        if ($param['id_proposal'] != null) {
            $query .= " where pr.id_proposal = " . $param['id_proposal'];
        } else {
            $query .= " where mp.tgl_buat = (select max(mp2.tgl_buat) from mapping mp2 where mp2.id_proposal = mp.id_proposal)";
        }
        $query .= " and pj.user_input = '" . $param['id_user'] . "'";
        $sql = $this->db->query($query);
        return $sql->result();
    }

    public function getListPengajuan($user, $jenis)
    {
        $this->db->select('pj.*, kb.nama as kabupaten, kc.nama as kecamatan, kl.nama as kelurahan, pr.nomor_surat, pk.nama_poktan, pk.nama_ketua, st.*, j.url');
        $this->db->from('mapping mp');
        $this->db->join('pengajuan pj', 'mp.id_pengajuan = pj.id_pengajuan');
        $this->db->join('proposal pr', 'mp.id_proposal = pr.id_proposal');
        $this->db->join('lokasi l', 'pj.id_lokasi = l.id_lokasi');
        $this->db->join('kelurahan kl', 'l.id_kelurahan = kl.id_kelurahan');
        $this->db->join('kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
        $this->db->join('kabupatenkota kb', 'kc.id_kabupatenkota = kb.id_kabupatenkota');
        $this->db->join('poktan pk', 'pj.id_poktan = pk.id_poktan');
        $this->db->join('status st', 'pj.status_pengajuan = st.id_status');
        $this->db->join('jenis j', 'pj.id_jenis = j.id_jenis');
        $this->db->where('pj.user_input', $user);
        $this->db->where('pj.id_jenis', $jenis);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function getListPengajuan_admin($param)
    {
        $this->db->select('pj.*, kb.nama as nama_kabupaten, kc.nama as nama_kecamatan, kl.nama as nama_kelurahan, pr.id_proposal, pr.nomor_surat, pk.nama_poktan, 
        pk.nama_ketua, l.koordinat_a, l.koordinat_b, st.*');
        $this->db->from('mapping mp');
        $this->db->join('pengajuan pj', 'mp.id_pengajuan = pj.id_pengajuan');
        $this->db->join('proposal pr', 'mp.id_proposal = pr.id_proposal');
        $this->db->join('lokasi l', 'pj.id_lokasi = l.id_lokasi');
        $this->db->join('kelurahan kl', 'l.id_kelurahan = kl.id_kelurahan');
        $this->db->join('kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
        $this->db->join('kabupatenkota kb', 'kc.id_kabupatenkota = kb.id_kabupatenkota');
        $this->db->join('poktan pk', 'pj.id_poktan = pk.id_poktan');
        $this->db->join('status st', 'pj.status_pengajuan = st.id_status');
        $this->db->where('pr.id_kabupatenkota', $param['id_kabupatenkota']);
        $this->db->where('pr.id_proposal', $param['id_proposal']);
        // $this->db->where('pj.status_pengajuan', $param['id_status']);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function getDetailPengajuan($param)
    {
        $this->db->select("pj.*, DATE_FORMAT(mp.tgl_buat, '%d-%m-%Y') as tanggal_buat, kb.id_kabupatenkota, kb.nama as nama_kabupaten, kc.id_kecamatan, kc.nama as nama_kecamatan, kl.id_kelurahan, kl.nama as nama_kelurahan, pr.id_proposal, pr.nomor_surat, pk.id_poktan, pk.nama_poktan, pk.nama_ketua, l.id_lokasi, l.koordinat_a, l.koordinat_b, st.*, p.*");
        $this->db->from('mapping mp');
        $this->db->join('pengajuan pj', 'mp.id_pengajuan = pj.id_pengajuan');
        $this->db->join('proposal pr', 'mp.id_proposal = pr.id_proposal');
        $this->db->join('lokasi l', 'pj.id_lokasi = l.id_lokasi');
        $this->db->join('kelurahan kl', 'l.id_kelurahan = kl.id_kelurahan');
        $this->db->join('kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
        $this->db->join('kabupatenkota kb', 'kc.id_kabupatenkota = kb.id_kabupatenkota');
        $this->db->join('poktan pk', 'pj.id_poktan = pk.id_poktan');
        $this->db->join('status st', 'pj.status_pengajuan = st.id_status');
        $this->db->join('jenis j', 'pj.id_jenis = j.id_jenis');
        // $this->db->join('user u', 'pj.user_input = u.id_user');
        $this->db->join('profil p', 'pj.user_input = p.id_user');
        if ($param['id_pengajuan'] != null) {
            $this->db->where('pj.id_pengajuan', $param['id_pengajuan']);
        }
        if ($param['id_proposal'] != null) {
            $this->db->where('pr.id_proposal', $param['id_proposal']);
        }
        $this->db->where('pj.user_input', $param['id_user']);
        $sql = $this->db->get();
        if ($sql->num_rows() > 0) {
            return $sql->result()[0];
        } else {
            return false;
        }
    }

    public function getDokumen($param)
    {
        $sql = $this->db->get_where('dokumen', ['id_pengajuan' => $param['id_pengajuan']]);
        return $sql->result();
    }

    public function getPengajuanById($param)
    {
        $sql = $this->db->get_where('pengajuan', ['id_pengajuan' => $param]);
        return $sql->result()[0];
    }

    //INSERT PROCESS
    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    //UPDATE PROCESS
    public function updateData($table, $primaryKey, $data)
    {
        // $this->db->set('DTM_UPD', date('Y-m-d H:i:s'));
        // $this->db->set('user_update', $this->session->userdata('officer_column'));
        $this->db->where($primaryKey['column'], $primaryKey['value']);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE PROCESS
    public function deleteData($table, $column, $id)
    {
        $this->db->where($column, $id);
        $this->db->delete($table);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }










    public function getJobAuth($jobLabel)
    {
        $result = $this->db->get_where('pekerjaan', ['LABEL_PEKERJAAN' => $jobLabel]);
        $job = $result->result();
        return $job[0]->IS_NEED_AUTH;
    }

    public function getListJob()
    {
        $query = $this->db->get('pekerjaan');
        return $query->result();
    }

    public function getListQuestion($param)
    {
        $query = "SELECT q.QUESTION_ID, q.IS_ACTIVE, q.QUESTION_LABEL, 
                    (CASE WHEN q.IS_READONLY = '1' THEN 'readonly' ELSE '' END) AS IS_READONLY
                    FROM QUESTION q
                    JOIN QUESTION_OF_GROUP qog ON q.QUESTION_ID = qog.QUESTION_ID
                    JOIN QUESTION_GROUP qg ON qog.QUESTIONGROUP_ID = qg.QUESTIONGROUP_ID
                    WHERE qog.QUESTIONGROUP_ID IN (
                            SELECT qof.QUESTIONGROUP_ID 
                            FROM QUESTIONGROUP_OF_FORM qof
                            JOIN FORM f ON qof.FORM_ID = f.FORM_ID
                            WHERE f.FORM_NAME = '$param'
                    ) AND q.IS_ACTIVE = '1'
                    ORDER BY qg.SEQ ASC, qog.SEQ ASC";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function getCountNikah()
    {
        $query = "SELECT MONTH(DTM_CRT) AS BULAN, sum(1) AS JUMLAH
                FROM REGISTRATION
                WHERE FORM_ID IN (1, 4)
                GROUP BY MONTH(DTM_CRT)";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function getCountRujuk()
    {
        $query = "SELECT MONTH(DTM_CRT) AS BULAN, sum(1) AS JUMLAH
                FROM REGISTRATION
                WHERE FORM_ID IN (2, 5)
                GROUP BY MONTH(DTM_CRT)";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function getCountIsbat()
    {
        $query = "SELECT MONTH(DTM_CRT) AS BULAN, sum(1) AS JUMLAH
                FROM REGISTRATION
                WHERE FORM_ID IN (3, 6)
                GROUP BY MONTH(DTM_CRT)";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function getListAkad()
    {
        $this->db->select('TGL_AKAD');
        $this->db->from('regdetail_tr');
        $sql = $this->db->get();
        $result = $sql->result();
        return $result;
    }

    public function getDisabledHoursByDate($date)
    {
        $this->db->select('TGL_AKAD');
        $this->db->from('regdetail_tr');
        $this->db->like('TGL_AKAD', $date);
        $sql = $this->db->get();
        $result = $sql->result();
        return $result;
    }

    public function getDisabledHours()
    {
        $this->db->select('TGL_AKAD');
        $this->db->from('regdetail_tr');
        $sql = $this->db->get();
        $result = $sql->result();
        return $result;
    }

    public function getStatusId($statusDesc)
    {
        $sql = $this->db->get_where('registration_status', ['STATUS_DESC' => $statusDesc]);
        $result = $sql->row();
        return $result->STATUS_ID;
    }

    public function getFormId($formName)
    {
        $sql = $this->db->get_where('form', ['FORM_NAME' => $formName]);
        $result = $sql->row();
        return $result->FORM_ID;
    }

    public function getEventId($eventName)
    {
        $sql = $this->db->get_where('event', ['EVENT_NAME' => $eventName]);
        $result = $sql->row();
        return $result->EVENT_ID;
    }

    public function getFormName($regId)
    {
        $this->db->select('f.FORM_NAME');
        $this->db->from('registration r');
        $this->db->join('form f', 'r.FORM_ID = f.FORM_ID');
        $this->db->where('r.REG_ID', $regId);
        $sql = $this->db->get();
        $result = $sql->result();
        return $result[0]->FORM_NAME;
    }

    public function getPhoneNumber($regId)
    {
        $this->db->select('rd.NO_HP_S');
        $this->db->from('registration r');
        $this->db->join('regdetail_tr rd', 'r.REG_ID = rd.REG_ID');
        $this->db->where('r.REG_ID', $regId);
        $sql = $this->db->get();
        $result = $sql->result();
        return $result[0]->NO_HP_S;
    }

    public function getEventName($regCode)
    {
        $this->db->select('e.EVENT_NAME');
        $this->db->from('registration r');
        $this->db->join('form f', 'r.FORM_ID = f.FORM_ID');
        $this->db->join('event e', 'f.EVENT_ID = e.EVENT_ID');
        $this->db->where('r.REG_CODE', $regCode);
        $sql = $this->db->get();
        $result = $sql->result();
        return $result[0]->EVENT_NAME;
    }

    public function getRegistrationId($regCode)
    {
        $sql = $this->db->get_where('registration', ['REG_CODE' => $regCode]);
        $result = $sql->row();
        return $result->REG_ID;
    }

    public function getIdQuestion($refId)
    {
        $sql = $this->db->get_where('question', ['REF_ID' => $refId]);
        $result = $sql->row();
        return $result->QUESTION_ID;
    }

    public function getQuestionId($questionLabel)
    {
        $sql = $this->db->get_where('question', ['QUESTION_LABEL' => $questionLabel]);
        $result = $sql->row();
        return $result->QUESTION_ID;
    }

    public function getDataRegistration($statusCode, $formName)
    {
        $this->db->select('rd.*, f.FORM_NAME, st.*, r.REG_CODE, DATE_FORMAT(r.SCHEDULE, "%d-%m-%Y %H:%i:%s") as SCHEDULE, DATE_FORMAT(r.DTM_CRT, "%d-%m-%Y %H:%i:%s") as TGL_DAFTAR, DATE_FORMAT(r.VERIFIED_DATE, "%d-%m-%Y %H:%i:%s") as VERIFIED_DATE');
        // $this->db->select('rd.*, f.FORM_NAME, st.*, r.SCHEDULE_ID as SCHEDULE, r.REG_CODE, DATE_FORMAT(r.DTM_CRT, "%d-%m-%Y %H:%i:%s") as TGL_DAFTAR');
        $this->db->from('registration r');
        $this->db->join('regdetail_tr rd', 'r.REG_ID = rd.REG_ID');
        $this->db->join('form f', 'r.FORM_ID = f.FORM_ID');
        $this->db->join('registration_status st', 'r.STATUS_ID = st.STATUS_ID');
        if ($formName != null) {
            $this->db->where_in('f.FORM_NAME', $formName);
        }
        $this->db->where_in('st.STATUS_CODE', $statusCode);
        $this->db->order_by('r.DTM_CRT', 'desc');
        $this->db->order_by('r.STATUS_ID', 'desc');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function getDetailRegistration($regId)
    {
        $this->db->select('rd.*, f.FORM_NAME, st.*, DATE_FORMAT(r.SCHEDULE, "%d-%m-%Y %H:%i:%s") as SCHEDULE, DATE_FORMAT(r.DTM_CRT, "%d-%m-%Y %H:%i:%s") as TGL_DAFTAR, r.REG_CODE');
        $this->db->from('registration r');
        $this->db->join('regdetail_tr rd', 'r.REG_ID = rd.REG_ID');
        $this->db->join('form f', 'r.FORM_ID = f.FORM_ID');
        $this->db->join('registration_status st', 'r.STATUS_ID = st.STATUS_ID');
        $this->db->where('r.REG_ID', $regId);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function getFiles($column, $regId)
    {
        $this->db->select('r.REG_CODE, rd.QUESTION_LABEL, rd.ANSWER, f.FORM_NAME');
        $this->db->from('registration r');
        $this->db->join('registration_detail rd', 'r.REG_ID = rd.REG_ID');
        $this->db->join('form f', 'r.FORM_ID = f.FORM_ID');
        $this->db->join('question q', 'rd.QUESTION_ID = q.QUESTION_ID');
        $this->db->where('r.REG_ID', $regId);
        $this->db->where_in('q.REF_ID', $column);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function insertRegistration($regCode, $formID, $statusID, $participantID)
    {
        $data = array(
            'REG_CODE' => $regCode,
            'DTM_CRT' => date('Y-m-d H:i:s'),
            'FORM_ID' => $formID,
            'STATUS_ID' => $statusID,
            'PARTICIPANT_ID' => $participantID
        );
        $this->db->insert('registration', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertRegistrationDetail($regID, $questionID, $questionLabel, $answer)
    {
        $data = array(
            'DTM_CRT' => date('Y-m-d H:i:s'),
            'REG_ID' => $regID,
            'QUESTION_ID' => $questionID,
            'QUESTION_LABEL' => $questionLabel,
            'ANSWER' => $answer
        );
        $this->db->insert('registration_detail', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateRegistrationDetail($regID, $questionID, $questionLabel, $answer)
    {
        $data = array(
            'DTM_UPD' => date('Y-m-d H:i:s'),
            'USR_UPD' => $this->session->userdata('officer_id'),
            'REG_ID' => $regID,
            'QUESTION_ID' => $questionID,
            'QUESTION_LABEL' => $questionLabel,
            'ANSWER' => $answer
        );
        $this->db->update('registration_detail', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertHeader($data)
    {
        $this->db->insert('regdetail_tr', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertDetail($data)
    {
        $this->db->insert('regdetail_tr', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDetail($regId, $data)
    {
        $this->db->set('DTM_UPD', date('Y-m-d H:i:s'));
        $this->db->set('USR_UPD', $this->session->userdata('officer_id'));
        $this->db->where('REG_ID', $regId);
        $this->db->update('regdetail_tr', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertVerificationDetail($regID, $verifType, $questionLabel, $answer)
    {
        $data = array(
            'DTM_CRT' => date('Y-m-d H:i:s'),
            'REG_ID' => $regID,
            'VERIF_TYPE' => $verifType,
            'QUESTION_LABEL' => $questionLabel,
            'ANSWER' => $answer
        );
        $this->db->insert('verification', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRegistration($regID)
    {
        $this->db->where('REG_ID', $regID);
        $this->db->delete('registration');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateScheduleRegistration($regCode, $schedule, $statusId)
    {
        $this->db->set('STATUS_ID', $statusId);
        $this->db->set('SCHEDULE', $schedule);
        $this->db->set('DTM_UPD', date('Y-m-d H:i:s'));
        $this->db->set('USR_UPD', $this->session->userdata('officer_id'));
        $this->db->where('REG_CODE', $regCode);
        $this->db->update('registration');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateVerifiedRegistration($regID, $statusId)
    {
        $this->db->set('STATUS_ID', $statusId);
        $this->db->set('VERIFIED_DATE', date('Y-m-d H:i:s'));
        $this->db->set('DTM_UPD', date('Y-m-d H:i:s'));
        $this->db->set('USR_UPD', $this->session->userdata('officer_id'));
        $this->db->where('REG_ID', $regID);
        $this->db->update('registration');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStatusRegistration($regId, $statusId)
    {
        $this->db->set('STATUS_ID', $statusId);
        $this->db->set('DTM_UPD', date('Y-m-d H:i:s'));
        $this->db->set('VALIDATION_DATE', date('Y-m-d H:i:s'));
        $this->db->set('USR_UPD', $this->session->userdata('officer_id'));
        $this->db->where('REG_ID', $regId);
        $this->db->update('registration');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAuthorityRegistration($nik)
    {
        $this->db->select('dk.STATUS_KAWIN');
        $this->db->from('dukcapil dk');
        $this->db->where('dk.NIK', $nik);
        $sql = $this->db->get();
        $result = $sql->result();
        return $result[0]->STATUS_KAWIN;
    }

    public function checkOnGoingRegistration($nik, $where)
    {
        $select = substr($where, 3);
        $this->db->select($where);
        $this->db->from('registration r');
        $this->db->join('regdetail_tr rd', 'r.REG_ID = rd.REG_ID');
        $this->db->where($where, $nik);
        $sql = $this->db->get();
        $result = $sql->result();
        if (null == $result) {
            return null;
        } else {
            return $result[0]->$select;
        }
    }
}

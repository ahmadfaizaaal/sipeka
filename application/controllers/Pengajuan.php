<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
        $this->load->library('form_validation');
        $this->load->model('M_Pengajuan', 'pengajuan');
        $this->load->model('M_Profil', 'profil');
        $this->load->model('M_Auth', 'auth');

        $this->is_logged_in = false;

        if ($this->session->userdata("id_user")) {
            $this->is_logged_in = true;
        }
    }


    public function add($param = null)
    {
        $menu = ['perpipaan' => '', 'perpompaan' => '', 'embung' => '', 'air-tanah' => ''];
        $menu[$param] = 'active';

        $data['menu'] = $menu;
        $data['type'] = 'input';
        $data['kegiatan'] = $param;
        $data['id_jenis'] = $this->pengajuan->getIdJenisByURL($param);
        $data['userLogin'] = $this->session->userdata('nama');
        $data['role'] = $this->session->userdata('role');
        load_page('pengajuan/input-data', 'TAMBAH KEGIATAN ' . strtoupper(str_replace('-', ' ', $param)), $data);
    }

    public function edit()
    {
        $url = $this->uri->segment(3);
        $id_pengajuan = $this->uri->segment(4);
        $menu = ['perpipaan' => '', 'perpompaan' => '', 'embung' => '', 'air-tanah' => ''];
        $menu[$url] = 'active';

        $param = array(
            'id_user' => $this->session->userdata('id_user'),
            'id_pengajuan' => $id_pengajuan,
            'id_proposal' => null,
            'url' => $url,
        );
        $result = $this->pengajuan->getDetailPengajuan($param);
        $docs = $this->pengajuan->getDokumen($param);

        $data['id_pengajuan'] = $id_pengajuan;
        $data['menu'] = $menu;
        $data['type'] = 'input';
        $data['kegiatan'] = $url;
        $data['id_jenis'] = $this->pengajuan->getIdJenisByURL($url);
        $data['role'] = $this->session->userdata('role');
        $data['userLogin'] = $this->session->userdata('nama');
        $data['data'] = $this->initializeResult(array(
            'attr' => $param,
            'result' => $result,
            'docs' => $docs
        ));

        load_page('pengajuan/edit-data', 'EDIT KEGIATAN ' . strtoupper(str_replace('-', ' ', $url)), $data);
    }

    public function delete()
    {
        $idPengajuan = $this->input->post('id_pengajuan');
        $pengajuan = $this->pengajuan->getPengajuanById($idPengajuan);

        $this->pengajuan->deleteData('mapping', 'id_pengajuan', $idPengajuan);
        $this->pengajuan->deleteData('pengajuan', 'id_pengajuan', $idPengajuan);
        $this->pengajuan->deleteData('poktan', 'id_poktan', $pengajuan->id_poktan);
        $result = $this->pengajuan->deleteData('lokasi', 'id_lokasi', $pengajuan->id_lokasi);

        setResponse($result, 'delete');
    }

    public function rollback()
    {
        $url = $this->uri->segment(3);
        $idProposal = $this->uri->segment(4);
        $result = $this->pengajuan->deleteData('proposal', 'id_proposal', $idProposal);
        if ($result) {
            $data['redirect_url'] = base_url('pengajuan/list/' . $url);
            $data['success'] = $result;
            echo json_encode($data);
        } else {
            $data['success'] = $result;
            echo json_encode($data);
        }
    }

    public function list($param = null)
    {
        if ($param == null) {
            redirect('home');
        }
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login/' . $param);
        }

        $menu = ['perpipaan' => '', 'perpompaan' => '', 'embung' => '', 'air-tanah' => ''];
        $menu[$param] = 'active';

        $data['menu'] = $menu;
        $data['type'] = 'list';
        $data['kegiatan'] = $param;
        $data['role'] = $this->session->userdata('role');
        $data['userLogin'] = $this->session->userdata('nama');
        $data['id_jenis'] = $this->pengajuan->getIdJenisByURL($param);

        $page = 'pengajuan/list-data';
        $titlePage = 'KEGIATAN ';
        $tipe_akses = $this->session->userdata('tipe_akses');

        if (strtolower($tipe_akses) == 'tim teknis pusat') {
            $data['bagian'] = $this->session->userdata('bagian');
            $page = 'pengajuan/list-data-admin';
            $titlePage = 'TELAAH KEGIATAN ';
        }

        load_page($page, $titlePage . strtoupper(str_replace('-', ' ', $param)), $data);
    }

    public function dokumen()
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login/');
        }

        $menu = ['perpipaan' => '', 'perpompaan' => '', 'embung' => '', 'air-tanah' => '', 'dokumen' => ''];
        $menu['dokumen'] = 'active';

        $data['menu'] = $menu;
        $data['type'] = 'list';
        // $data['kegiatan'] = $param;
        // $data['id_jenis'] = $this->pengajuan->getIdJenisByURL($param);
        $data['userLogin'] = $this->session->userdata('nama');
        $data['role'] = $this->session->userdata('role');

        load_page('dokumen/list-data-v2', 'DOKUMEN PENGAJUAN', $data);
    }

    public function cari_nomor_surat()
    {
        $param = $this->input->get('q', TRUE);
        $listNomorSurat = $this->pengajuan->getListNomorSurat($param);
        echo json_encode($listNomorSurat);
    }

    public function cari_nomor_surat_bykabupaten($idKabupatenKota)
    {
        $key = $this->input->get('q', TRUE);
        $listNomorSurat = $this->pengajuan->getListNomorSuratByIdKabupaten($idKabupatenKota, $key);
        echo json_encode($listNomorSurat);
    }

    public function cari_provinsi()
    {
        $param = $this->input->get('q', TRUE);
        $listProvinsi = $this->pengajuan->getListProvinsi($param);
        echo json_encode($listProvinsi);
    }

    public function cari_kabupatenkota($param)
    {
        $key = $this->input->get('q', TRUE);
        $listKabupaten = $this->pengajuan->getListKabupatenKota($param, $key);
        echo json_encode($listKabupaten);
    }

    public function cari_kota()
    {
        $param = $this->input->get('q', TRUE);
        $listKota = $this->pengajuan->getListKota($param);
        echo json_encode($listKota);
    }

    public function cari_kecamatan($param)
    {
        $key = $this->input->get('q', TRUE);
        $listKecamatan = $this->pengajuan->getListKecamatan($param, $key);
        echo json_encode($listKecamatan);
    }

    public function cari_desa($param)
    {
        $key = $this->input->get('q', TRUE);
        $listKelurahan = $this->pengajuan->getListKelurahan($param, $key);
        echo json_encode($listKelurahan);
    }

    public function list_pengajuan()
    {
        $user = $this->session->userdata('id_user');
        $jenis = $this->input->post('id_jenis');
        $result = $this->pengajuan->getListPengajuan($user, $jenis);
        if ($result) {
            foreach ($result as $items) {
                $tgl_buat = $items->tanggal_buat;
                $newDate = tgl_indo($tgl_buat, false); //date('l, d F Y', strtotime($tgl_buat));
                $items->tgl_buat = $newDate;
            }
        }
        echo json_encode($result);
    }

    public function list_proposal()
    {
        $param = array(
            'id_user' => $this->session->userdata('id_user'),
            'id_proposal' => null,
        );
        $result = $this->pengajuan->getProposal($param);
        foreach ($result as $items) {
            $tgl_buat = $items->tgl_mapping;
            $newDate = tgl_indo($tgl_buat, true); //date('l, d F Y', strtotime($tgl_buat));
            $items->tgl_buat = $newDate;
        }
        echo json_encode($result);
    }

    public function insert_nomor_surat()
    {
        $data = array(
            'nomor_surat' => $this->input->post('nomorSurat'),
            'user_input' => $this->session->userdata('id_user'),
            'id_kabupatenkota' => $this->input->post('idKota'),
            'tgl_buat' => date('Y-m-d H:i:s')
        );
        $idProposal = $this->pengajuan->insertData('proposal', $data);
        echo json_encode($idProposal);
    }

    public function submitForm($idPengajuan = null)
    {

        $param = $this->initializeParam();


        // echo json_encode($param);
        // die;

        $pengajuan = $param['pengajuan'];

        if ($idPengajuan == null) {
            $pengajuan['id_poktan'] = $this->pengajuan->insertData('poktan', $param['poktan']);
            $pengajuan['id_lokasi'] = $this->pengajuan->insertData('lokasi', $param['lokasi']);

            $id_pengajuan = $this->pengajuan->insertData('pengajuan', $pengajuan);
        } else {
            $param['poktan']['user_update'] = $this->session->userdata('id_user');
            $pengajuan['user_update'] = $this->session->userdata('id_user');

            $this->pengajuan->updateData('poktan', array('column' => 'id_poktan', 'value' => $this->input->post('id-poktan')), $param['poktan']);
            $this->pengajuan->updateData('lokasi', array('column' => 'id_lokasi', 'value' => $this->input->post('id-lokasi')), $param['lokasi']);

            $this->pengajuan->updateData('pengajuan', array('column' => 'id_pengajuan', 'value' => $idPengajuan), $pengajuan);
        }


        //INSERT DOCUMENT PROCESS
        if ($idPengajuan != null) {
            $docs = $this->pengajuan->getDokumen(['id_pengajuan' => $idPengajuan]);
            unlink('assets/pengajuan/PLOTTING AREA/' . $docs[0]->nama_folder . '/' . $docs[0]->nama_dokumen);
            unlink('assets/pengajuan/SUMBER AIR/' . $docs[1]->nama_folder . '/' . $docs[1]->nama_dokumen);
            unlink('assets/pengajuan/LAHAN SAWAH/' . $docs[2]->nama_folder . '/' . $docs[2]->nama_dokumen);
            $this->pengajuan->deleteData('dokumen', 'id_pengajuan', $idPengajuan);
        }

        $plotting_area = '';
        if ($_FILES['doc-plotting-area']['name']) {
            $plotting_area = $this->uploadFile('doc-plotting-area', 'PLOTTING AREA', $param['nama_kelurahan'], $param['url'], $idPengajuan == null ? $id_pengajuan : $idPengajuan);
        }
        $sumber_air = '';
        if ($_FILES['doc-sumber-air']['name']) {
            $sumber_air = $this->uploadFile('doc-sumber-air', 'SUMBER AIR', $param['nama_kelurahan'], $param['url'], $idPengajuan == null ? $id_pengajuan : $idPengajuan);
        }
        $lahan_sawah = '';
        if ($_FILES['doc-lahan-sawah']['name']) {
            $lahan_sawah = $this->uploadFile('doc-lahan-sawah', 'LAHAN SAWAH', $param['nama_kelurahan'], $param['url'], $idPengajuan == null ? $id_pengajuan : $idPengajuan);
        }

        $documents = array($plotting_area, $sumber_air, $lahan_sawah);

        // echo json_encode($documents);
        // die;

        for ($i = 0; $i < count($documents); $i++) {
            $item = $documents[$i];
            $data = array(
                'id_pengajuan' => $idPengajuan == null ? $id_pengajuan : $idPengajuan,
                'identifier' => 'image',
                'nama_folder' => $item[0],
                'nama_dokumen' => $item[1],
                'user_input' => $param['user_input'],
                'tgl_buat' => $param['tgl_buat']
            );

            $this->pengajuan->insertData('dokumen', $data);
        }

        //INSERT MAPPING PROCESS
        $proposal = $this->pengajuan->getProposalByNomorSurat($param['nomor_surat']);

        if (!$proposal) {
            $param_proposal = array(
                'nomor_surat' => $param['nomor_surat'],
                'user_input' => $this->session->userdata('id_user'),
                'id_kabupatenkota' => $param['id_kabupatenkota'],
                'tgl_buat' => date('Y-m-d H:i:s')
            );
            $idProposal = $this->pengajuan->insertData('proposal', $param_proposal);
        } else {
            $idProposal = $proposal->id_proposal;
        }

        $mapping = array(
            'id_proposal' => $idProposal,
            'id_pengajuan' => $idPengajuan == null ? $id_pengajuan : $idPengajuan
        );

        if ($idPengajuan == null) {
            $success = $this->pengajuan->insertData('mapping', $mapping);
            $message = 'Pengajuan Anda berhasil disimpan. Silahkan tunggu informasi selanjutnya!';
        } else {
            $success = $this->pengajuan->updateData('mapping', array('column' => 'id_pengajuan', 'value' => $idPengajuan), $mapping);
            $message = 'Pengajuan Anda berhasil diupdate!';
        }

        if ($message) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> ' . $message .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
            );
            redirect('pengajuan/list/' . $param['url']);
        }
    }

    public function lihat_dokumen()
    {
        $param = array(
            // 'id_user' => $this->session->userdata('id_user'),
            'id_user' => null,
            'id_pengajuan' => $this->input->post('id_pengajuan'),
            'id_proposal' => null,
            'url' => $this->input->post('url'),
        );
        $result = $this->pengajuan->getDetailPengajuan($param);
        $docs = $this->pengajuan->getDokumen($param);

        $tgl_buat = $result->tanggal_buat;
        $tanggal = tgl_indo($tgl_buat, true);

        $data['data'] = array(
            "url" => $param['url'],
            "id_proposal" => $result->id_proposal,
            "nama_kabupaten" => $result->nama_kabupaten,
            "nama_kecamatan" => $result->nama_kecamatan,
            "nama_kelurahan" => $result->nama_kelurahan,
            "poktan" => array(
                "nama_poktan" => $result->nama_poktan,
                "nama_ketua" => $result->nama_ketua,
            ),
            "lokasi" => array(
                "koordinat_a" => $result->koordinat_a,
                "koordinat_b" => $result->koordinat_b,
            ),
            "pengajuan" => array(
                "id_jenis" => $result->id_jenis,
                "luas_layanan" => $result->luas_layanan,
                "unit" => $result->unit,
                "perkiraan_biaya" => $result->perkiraan_biaya,
                "jarak" => $result->jarak,
                "ukuran_pompa" => $result->ukuran_pompa,
                "bak_penampung" => $result->bak_penampung,
                "rumah_pompa" => $result->rumah_pompa,
                "provitas" => $result->provitas,
                "ip" => $result->ip,
                "lahan_sawah" => $result->lahan_sawah,
                "sumber_air" => $result->sumber_air,
                "komoditas" => $result->komoditas,
                "permasalahan" => $result->permasalahan,
                "rencana_solusi" => $result->rencana_solusi,
                "beda_elevasi" => $result->beda_elevasi,
                "user_input" => $result->user_input,
                "status_pengajuan" => $result->status_pengajuan,
                "kelayakan" => $result->kelayakan
            ),
            "dokumen" => array(
                "plotting_area" => $docs[0]->nama_folder . '/' . $docs[0]->nama_dokumen,
                "sumber_air" => $docs[1]->nama_folder . '/' . $docs[1]->nama_dokumen,
                "lahan_sawah" => $docs[2]->nama_folder . '/' . $docs[2]->nama_dokumen
            ),
            "user_input" => $result->user_input,
            'nama_user' => $this->session->userdata('nama'),
            "tgl_buat" => $tanggal,
            "nama_verifikator" => $result->nama_verifikator,
            "alamat_dinas" => $result->alamat_dinas,
            "nama_kadin" => $result->nama_kadin,
            "jabatan" => $result->jabatan,
            "nip" => $result->nip,
            "tanda_tangan" => $result->tanda_tangan
        );

        $data['title'] = 'Kegiatan';
        $html = $this->load->view('pengajuan/data-pengajuan', $data, TRUE);
        $fileName = export_pdf($html, strtoupper($param['url']) . '_' . $result->nama_kelurahan, 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }

    public function lihat_proposal()
    {
        $param = array(
            'id_user' => strtolower($this->session->userdata('role')) == 'pusat' ? null : $this->session->userdata('id_user'),
            'id_pengajuan' => null,
            'id_proposal' => $this->input->post('id_proposal'),
            'url' => null,
        );
        $result = $this->pengajuan->getProposal($param);


        $data['data'] = array();

        foreach ($result as $items) {
            $param['id_pengajuan'] = $items->id_pengajuan;

            $docs = $this->pengajuan->getDokumen($param);

            $tgl_buat = $items->tgl_mapping;
            $tanggal = tgl_indo($tgl_buat, false);

            $temp = array(
                "url" => $items->url,
                "id_proposal" => $items->id_proposal,
                "nama_kabupaten" => $items->nama_kabupaten,
                "nama_kecamatan" => $items->nama_kecamatan,
                "nama_kelurahan" => $items->nama_kelurahan,
                "poktan" => array(
                    "nama_poktan" => $items->nama_poktan,
                    "nama_ketua" => $items->nama_ketua,
                ),
                "lokasi" => array(
                    "koordinat_a" => $items->koordinat_a,
                    "koordinat_b" => $items->koordinat_b,
                ),
                "pengajuan" => array(
                    "id_jenis" => $items->id_jenis,
                    "luas_layanan" => $items->luas_layanan,
                    "unit" => $items->unit,
                    "perkiraan_biaya" => $items->perkiraan_biaya,
                    "jarak" => $items->jarak,
                    "ukuran_pompa" => $items->ukuran_pompa,
                    "bak_penampung" => $items->bak_penampung,
                    "rumah_pompa" => $items->rumah_pompa,
                    "provitas" => $items->provitas,
                    "ip" => $items->ip,
                    "lahan_sawah" => $items->lahan_sawah,
                    "sumber_air" => $items->sumber_air,
                    "komoditas" => $items->komoditas,
                    "permasalahan" => $items->permasalahan,
                    "rencana_solusi" => $items->rencana_solusi,
                    "beda_elevasi" => $items->beda_elevasi,
                    "user_input" => $items->user_input,
                    "status_pengajuan" => $items->status_pengajuan,
                    "kelayakan" => $items->kelayakan
                ),
                "dokumen" => array(
                    "plotting_area" => $docs[0]->nama_folder . '/' . $docs[0]->nama_dokumen,
                    "sumber_air" => $docs[1]->nama_folder . '/' . $docs[1]->nama_dokumen,
                    "lahan_sawah" => $docs[2]->nama_folder . '/' . $docs[2]->nama_dokumen
                ),
                "user_input" => $items->user_input,
                'nama_user' => $this->session->userdata('nama'),
                "tgl_buat" => $tanggal,
                "nama_verifikator" => $items->nama_verifikator,
                "alamat_dinas" => $items->alamat_dinas,
                "nama_kadin" => $items->nama_kadin,
                "jabatan" => $items->jabatan,
                "nip" => $items->nip,
                "tanda_tangan" => $items->tanda_tangan,
                "catatan" => $items->catatan
            );
            array_push($data['data'], $temp);
        }

        // echo json_encode($data['data']);
        // die;

        $data['title'] = 'DATA PROPOSAL';
        $html = $this->load->view('dokumen/data-pengajuan', $data, TRUE);
        $fileName = export_pdf($html, 'PROPOSAL' . '_' . $result[0]->nama_kabupaten, 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }

    public function test()
    {
        // $penomoran = $this->pengajuan->getOne('penomoran', null, array('column' => 'id_penomoran', 'option' => 'desc'));
        // $lastId = $penomoran ? $penomoran->id_penomoran : 0;
        // echo json_encode($penomoran);

        $spks = $this->pengajuan->getOne('spks', array('column' => 'id_penomoran', 'value' => 3), array('column' => 'id_spks', 'option' => 'desc'));
        $noUrutSpks = $spks ? $spks->id_spks : 0;
        echo json_encode($noUrutSpks);
    }

    public function lihat_syarat_penomoran()
    {
        $param = array(
            'id_user' => strtolower($this->session->userdata('role')) == 'pusat' ? null : $this->session->userdata('id_user'),
            'id_pengajuan' => null,
            'id_proposal' => $this->input->post('id_proposal'),
            'url' => null,
        );
        $result = $this->pengajuan->getPenomoran($param);

        $data['data'] = array();

        if ($result) {
            foreach ($result as $items) {
                $param['id_pengajuan'] = $items->id_pengajuan;

                $docs = $this->pengajuan->getDokumenPenomoran($param);

                $tgl_buat = $items->tgl_mapping;
                $tanggal = tgl_indo($tgl_buat, false);

                $temp = array(
                    "url" => $items->url,
                    "id_proposal" => $items->id_proposal,
                    "nomor_surat" => $items->nomor_surat,
                    "nama_provinsi" => $items->nama_provinsi,
                    "nama_kabupaten" => $items->nama_kabupaten,
                    "nama_kecamatan" => $items->nama_kecamatan,
                    "nama_kelurahan" => $items->nama_kelurahan,
                    "poktan" => array(
                        "id_poktan" => $items->id_poktan,
                        "nama_poktan" => $items->nama_poktan,
                        "nama_ketua" => $items->nama_ketua,
                        "nik_ketua" => $items->nik_ketua,
                        "no_hp_ketua" => $items->no_hp_ketua,
                        "nik_upkk" => $items->nik_upkk,
                        "koordinator_upkk" => $items->koordinator_upkk,
                    ),
                    "pengajuan" => array(
                        "id_jenis" => $items->id_jenis,
                        "luas_layanan" => $items->luas_layanan,
                        "unit" => $items->unit,
                        "perkiraan_biaya" => $items->perkiraan_biaya,
                        "jarak" => $items->jarak,
                        "ukuran_pompa" => $items->ukuran_pompa,
                        "bak_penampung" => $items->bak_penampung,
                        "rumah_pompa" => $items->rumah_pompa,
                        "provitas" => $items->provitas,
                        "ip" => $items->ip,
                        "lahan_sawah" => $items->lahan_sawah,
                        "sumber_air" => $items->sumber_air,
                        "komoditas" => $items->komoditas,
                        "permasalahan" => $items->permasalahan,
                        "rencana_solusi" => $items->rencana_solusi,
                        "beda_elevasi" => $items->beda_elevasi,
                        "user_input" => $items->user_input,
                        "status_pengajuan" => $items->status_pengajuan,
                        "kelayakan" => $items->kelayakan,
                        "detail_kegiatan" => $items->detail_kegiatan,
                        "nama_kegiatan" => $items->nama_kegiatan
                    ),
                    "rekening" => array(
                        "no_rekening" => $items->no_rekening,
                        "nama_rekening" => $items->nama_rekening,
                        "nama_bank" => $items->nama_bank,
                        "tgl_buat" => $items->tgl_buka
                    ),
                    "dokumen" => array(
                        "ktp" => $docs[0]->nama_folder . '/' . $docs[0]->nama_dokumen,
                        "buku_tabungan" => $docs[1]->nama_folder . '/' . $docs[1]->nama_dokumen,
                        "surat_rekening_aktif" => $docs[2]->nama_folder . '/' . $docs[2]->nama_dokumen
                    ),
                    'nama_user' => $this->session->userdata('nama'),
                    "tgl_buat" => $tanggal,
                    "nama_verifikator" => $items->nama_verifikator,
                    "alamat_dinas" => $items->alamat_dinas,
                    "nama_kadin" => $items->nama_kadin,
                    "jabatan" => $items->jabatan,
                    "nip" => $items->nip,
                    "tanda_tangan" => $items->tanda_tangan,
                    "catatan" => $items->catatan
                );
                array_push($data['data'], $temp);
            }
        } else {
            $data['data'] = null;
        }

        $data['title'] = 'DATA SYARAT PENOMORAN';
        $html = $this->load->view('dokumen/data-syarat-penomoran', $data, TRUE);
        $fileName = export_pdf($html, 'SYARAT PENOMORAN' . '_' . $result[0]->nama_kabupaten, 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }

    public function download_template()
    {
        force_download('assets/pengajuan/temp/Format Dokumen Pemberkasan Banpem.rar', NULL);
    }

    public function ajukan_penomoran()
    {
        $url = $this->uri->segment(3);
        $idPengajuan = $this->uri->segment(4);
        $menu = ['perpipaan' => '', 'perpompaan' => '', 'embung' => '', 'air-tanah' => '', 'dokumen' => ''];
        $menu['dokumen'] = 'active';

        $param = array(
            'id_user' => null,
            'id_pengajuan' => $idPengajuan,
            'id_proposal' => null,
            'url' => $url,
        );
        $result = $this->pengajuan->getDetailPengajuan($param);
        // $docs = $this->pengajuan->getDokumen($param);

        $data['id_pengajuan'] = $idPengajuan;
        $data['menu'] = $menu;
        $data['type'] = 'input';
        $data['kegiatan'] = $url;
        $data['id_jenis'] = $this->pengajuan->getIdJenisByURL($url);
        $data['userLogin'] = $this->session->userdata('nama');
        $data['data'] = $this->initializeResult(array(
            'attr' => $param,
            'result' => $result,
            'docs' => null
        ));

        load_page('pengajuan/input-syarat-penomoran', 'SYARAT PENOMORAN', $data);
    }

    public function submit_syarat_penomoran($idPengajuan = null)
    {
        $param = $this->initializeParamPenomoran();

        $idPoktan = $this->input->post('id-poktan');

        $this->pengajuan->updateData('poktan', array('column' => 'id_poktan', 'value' => $idPoktan), $param['poktan']);
        $this->pengajuan->updateData('pengajuan', array('column' => 'id_pengajuan', 'value' => $idPengajuan), $param['pengajuan']);
        $rekening = $this->pengajuan->insertData('rekening', $param['rekening']);

        if ($rekening) {
            $scanKTP = '';
            if ($_FILES['doc-scan-ktp']['name']) {
                $scanKTP = $this->uploadFile('doc-scan-ktp', 'SYARAT', 'KTP', $param['url'], $idPengajuan);
            }
            $scanBuktab = '';
            if ($_FILES['doc-scan-buktab']['name']) {
                $scanBuktab = $this->uploadFile('doc-scan-buktab', 'SYARAT', 'BUKU TABUNGAN', $param['url'], $idPengajuan);
            }
            $scanRekAtif = '';
            if ($_FILES['doc-scan-rekaktif']['name']) {
                $scanRekAtif = $this->uploadFile('doc-scan-rekaktif', 'SYARAT', 'SURAT REKENING AKTIF', $param['url'], $idPengajuan);
            }

            $documents = array($scanKTP, $scanBuktab, $scanRekAtif);

            $tgl_buat = date('Y-m-d H:i:s');
            for ($i = 0; $i < count($documents); $i++) {
                $item = $documents[$i];
                $data = array(
                    'id_pengajuan' => $idPengajuan,
                    'identifier' => 'syarat',
                    'nama_folder' => $item[0],
                    'nama_dokumen' => $item[1],
                    'user_input' => $this->session->userdata('id_user'),
                    'tgl_buat' => $tgl_buat
                );

                $this->pengajuan->insertData('dokumen', $data);
            }

            //INSERT INTO TABLE PENOMORAN
            $kegiatan = array(
                'perpipaan' => 'III',
                'perpompaan' => 'IV',
                'embung' => 'II',
                'air-tanah' => 'V'
            );
            $skTimTeknis = '';
            $skPenerimaManfaat = '';
            $exist = $this->pengajuan->getPenomoranById($param['id_proposal']);
            if (!$exist) {
                $penomoran = $this->pengajuan->getOne('penomoran', null, array('column' => 'id_penomoran', 'option' => 'desc'));
                $lastId = $penomoran ? $penomoran->id_penomoran : 0;
                $tgl = substr(date('d-m-Y'), 0, 2);
                $bulan = substr(date('d-m-Y'), 3, 2);
                $tahun = substr(date('d-m-Y'), 6, 4);
                $kode = $kegiatan[$param['url']];

                $lastId = strlen($lastId) == 1 ? '0' . ($lastId + 1) : ($lastId + 1);

                $skTimTeknis = $tgl . '.' . $lastId . '.a.' . $kode . '/Kpts/PPK.7/' . $bulan . '/' . $tahun;
                $skPenerimaManfaat = $tgl . '.' . $lastId . '.b.' . $kode . '/Kpts/PPK.7/' . $bulan . '/' . $tahun;

                $newPenomoran = array(
                    'id_proposal' => $param['id_proposal'],
                    'sk_tim_teknis' => $skTimTeknis,
                    'sk_penerima' => $skPenerimaManfaat,
                    'tgl_buat' => date('Y-m-d H:i:s')
                );

                $insertedIdPenomoran = $this->pengajuan->insertData('penomoran', $newPenomoran);

                //INSERT INTO TABLE SPKS
                if ($insertedIdPenomoran) {
                    $spks = $this->pengajuan->getOne('spks', array('column' => 'id_penomoran', 'value' => $insertedIdPenomoran), array('column' => 'id_spks', 'option' => 'desc'));
                    $noUrutSpks = $spks ? $spks->id_spks : 0;
                    $noUrutSpks = strlen($noUrutSpks) == 1 ? '0' . ($noUrutSpks + 1) : ($noUrutSpks + 1);

                    $nomorSk = $tgl . '.' . $lastId . '.' . $noUrutSpks . '.' . $kode . '/PPK.PSP.7/SPK/' . $bulan . '/' . $tahun;

                    $skema = $param['nominal'] > 100000000 ? '70:30' : '100';

                    $newSpks = array(
                        'id_penomoran' => $insertedIdPenomoran,
                        'id_pengajuan' => $idPengajuan,
                        'nomor_sk' => $nomorSk,
                        'nominal' => $param['nominal'],
                        'skema' => $skema
                    );

                    $insertedIdSpks = $this->pengajuan->insertData('spks', $newSpks);

                    //INSERT INTO TABLE KWINTANSI
                    if ($insertedIdSpks) {
                        if ($skema == '70:30') {
                            $tahap1 = array(
                                'id_spks' => $insertedIdSpks,
                                'nomor_kwitansi' => $tgl . '.' . $lastId . '.' . $noUrutSpks . '.a/KWT.' . $kode . '/' . 'PPK.7/' . $bulan . '/' . $tahun,
                                'nominal_diterima' => 0.7 * $param['nominal'],
                                'tahap' => 'KWITANSI TAHAP 1',
                                'tgl_buat' => date('Y-m-d H:i:s')
                            );
                            $this->pengajuan->insertData('kwitansi', $tahap1);
                            $tahap2 = array(
                                'id_spks' => $insertedIdSpks,
                                'nomor_kwitansi' => $tgl . '.' . $lastId . '.' . $noUrutSpks . '.b/KWT.' . $kode . '/' . 'PPK.7/' . $bulan . '/' . $tahun,
                                'nominal_diterima' => 0.3 * $param['nominal'],
                                'tahap' => 'KWITANSI TAHAP 2',
                                'tgl_buat' => date('Y-m-d H:i:s')
                            );
                            $this->pengajuan->insertData('kwitansi', $tahap2);
                        } else if ($skema == '100') {
                            $kwitansi = array(
                                'id_spks' => $insertedIdSpks,
                                'nomor_kwitansi' => $tgl . '.' . $lastId . '.' . $noUrutSpks . '/KWT.' . $kode . '/' . 'PPK.7/' . $bulan . '/' . $tahun,
                                'nominal_diterima' => $param['nominal'],
                                'tahap' => 'KWITANSI',
                                'tgl_buat' => date('Y-m-d H:i:s')
                            );
                            $this->pengajuan->insertData('kwitansi', $kwitansi);
                        }
                    }
                }
            } else {
                $lastId = $exist->id_penomoran;
                $tgl = substr(date('d-m-Y'), 0, 2);
                $bulan = substr(date('d-m-Y'), 3, 2);
                $tahun = substr(date('d-m-Y'), 6, 4);
                $kode = $kegiatan[$param['url']];

                $lastId = strlen($lastId) == 1 ? '0' . ($lastId) : ($lastId);

                $spks = $this->pengajuan->getOne('spks', array('column' => 'id_penomoran', 'value' => $exist->id_penomoran), array('column' => 'id_spks', 'option' => 'desc'));
                $noUrutSpks = $spks ? $spks->id_spks : 0;
                $noUrutSpks = strlen($noUrutSpks) == 1 ? '0' . ($noUrutSpks + 1) : ($noUrutSpks + 1);

                $nomorSk = $tgl . '.' . $lastId . '.' . $noUrutSpks . '.' . $kode . '/PPK.PSP.7/SPK/' . $bulan . '/' . $tahun;

                $skema = $param['nominal'] > 100000000 ? '70:30' : '100';

                $newSpks = array(
                    'id_penomoran' => $exist->id_penomoran,
                    'id_pengajuan' => $idPengajuan,
                    'nomor_sk' => $nomorSk,
                    'nominal' => $param['nominal'],
                    'skema' => $skema
                );

                $insertedIdSpks = $this->pengajuan->insertData('spks', $newSpks);

                //INSERT INTO TABLE KWINTANSI
                if ($insertedIdSpks) {
                    if ($skema == '70:30') {
                        $tahap1 = array(
                            'id_spks' => $insertedIdSpks,
                            'nomor_kwitansi' => $tgl . '.' . $lastId . '.' . $noUrutSpks . '.a/KWT.' . $kode . '/' . 'PPK.7/' . $bulan . '/' . $tahun,
                            'nominal_diterima' => 0.7 * $param['nominal'],
                            'tahap' => 'KWITANSI TAHAP 1',
                            'tgl_buat' => date('Y-m-d H:i:s')
                        );
                        $this->pengajuan->insertData('kwitansi', $tahap1);
                        $tahap2 = array(
                            'id_spks' => $insertedIdSpks,
                            'nomor_kwitansi' => $tgl . '.' . $lastId . '.' . $noUrutSpks . '.b/KWT.' . $kode . '/' . 'PPK.7/' . $bulan . '/' . $tahun,
                            'nominal_diterima' => 0.3 * $param['nominal'],
                            'tahap' => 'KWITANSI TAHAP 2',
                            'tgl_buat' => date('Y-m-d H:i:s')
                        );
                        $this->pengajuan->insertData('kwitansi', $tahap2);
                    } else if ($skema == '100') {
                        $kwitansi = array(
                            'id_spks' => $insertedIdSpks,
                            'nomor_kwitansi' => $tgl . '.' . $lastId . '.' . $noUrutSpks . '/KWT.' . $kode . '/' . 'PPK.7/' . $bulan . '/' . $tahun,
                            'nominal_diterima' => $param['nominal'],
                            'tahap' => 'KWITANSI',
                            'tgl_buat' => date('Y-m-d H:i:s')
                        );
                        $this->pengajuan->insertData('kwitansi', $kwitansi);
                    }
                }
            }



            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Status data pengajuan anda berhasil diperbarui. Silahkan tunggu informasi selanjutnya!' .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
            );
            redirect('pengajuan/dokumen');
        }
    }

    public function clear_temp_files()
    {
        $files = glob('./assets/pengajuan/temp/pdf/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
        echo json_encode('200 OK');
    }

    private function initializeResult($param)
    {
        $docs = array();
        if ($param['docs'] != null) {
            $docs = array(
                "plotting_area" => $param['docs'][0]->nama_folder . '/' . $param['docs'][0]->nama_dokumen,
                "sumber_air" => $param['docs'][1]->nama_folder . '/' . $param['docs'][1]->nama_dokumen,
                "lahan_sawah" => $param['docs'][2]->nama_folder . '/' . $param['docs'][2]->nama_dokumen
            );
        }
        $data = array(
            "url" => $param['attr']['url'],
            "id_proposal" => $param['result']->id_proposal,
            "nomor_surat" => $param['result']->nomor_surat,
            "id_kabupatenkota" => $param['result']->id_kabupatenkota,
            "nama_kabupaten" => $param['result']->nama_kabupaten,
            "id_kecamatan" => $param['result']->id_kecamatan,
            "nama_kecamatan" => $param['result']->nama_kecamatan,
            "id_kelurahan" => $param['result']->id_kelurahan,
            "nama_kelurahan" => $param['result']->nama_kelurahan,
            "poktan" => array(
                "id_poktan" => $param['result']->id_poktan,
                "nama_poktan" => $param['result']->nama_poktan,
                "nama_ketua" => $param['result']->nama_ketua,
            ),
            "lokasi" => array(
                "id_lokasi" => $param['result']->id_lokasi,
                "koordinat_a" => $param['result']->koordinat_a,
                "koordinat_b" => $param['result']->koordinat_b,
            ),
            "pengajuan" => array(
                "id_pengajuan" => $param['result']->id_pengajuan,
                "id_jenis" => $param['result']->id_jenis,
                "luas_layanan" => $param['result']->luas_layanan,
                "unit" => $param['result']->unit,
                "perkiraan_biaya" => $param['result']->perkiraan_biaya,
                "jarak" => $param['result']->jarak,
                "ukuran_pompa" => $param['result']->ukuran_pompa,
                "bak_penampung" => $param['result']->bak_penampung,
                "rumah_pompa" => $param['result']->rumah_pompa,
                "provitas" => $param['result']->provitas,
                "ip" => $param['result']->ip,
                "lahan_sawah" => $param['result']->lahan_sawah,
                "sumber_air" => $param['result']->sumber_air,
                "komoditas" => $param['result']->komoditas,
                "permasalahan" => $param['result']->permasalahan,
                "rencana_solusi" => $param['result']->rencana_solusi,
                "beda_elevasi" => $param['result']->beda_elevasi,
                "user_input" => $param['result']->user_input,
                "status_pengajuan" => $param['result']->status_pengajuan,
                "kelayakan" => $param['result']->kelayakan
            ),
            "dokumen" => $docs,
            "user_input" => $param['result']->user_input,
            'nama_user' => $this->session->userdata('nama'),
            "tgl_buat" => $param['result']->tgl_buat
        );

        return $data;
    }

    private function initializeParamPenomoran()
    {
        $user_update = $this->session->userdata('id_user');
        $data = array(
            'url' => $this->input->post('url'),
            'nama_kelurahan' => $this->input->post('nama-kelurahan'),
            'id_proposal' => $this->input->post('id-proposal'),
            'nominal' => $this->input->post('nominal'),
            'pengajuan' => array(
                'status_pengajuan' => $this->pengajuan->getIdStatusByCode('PPNMR'), //Pengajuan Penomoran
                'detail_kegiatan' => $this->input->post('penggunaan'),
                'user_update' => $user_update
            ),
            'poktan' => array(
                'nik_ketua' => $this->input->post('nik-ketua'),
                'no_hp_ketua' => $this->input->post('no-hp-ketua'),
                'nik_upkk' => $this->input->post('nik-koord-upkk'),
                'koordinator_upkk' => $this->input->post('nama-koord-upkk'),
                'user_update' => $user_update
            ),
            'rekening' => array(
                'id_poktan' => $this->input->post('id-poktan'),
                'no_rekening' => $this->input->post('no-rekening'),
                'nama_rekening' => $this->input->post('nama-rekening'),
                'nama_bank' => $this->input->post('nama-bank'),
                'tgl_buat' => date('Y-m-d H:i:s', strtotime($this->input->post('tgl-rekening')))
            )
        );

        return $data;
    }

    private function initializeParam()
    {
        $url = $this->input->post('url');
        $user_input = $this->session->userdata('id_user');
        $tgl_buat = date('Y-m-d H:i:s');
        $id_kabupatenkota = $this->session->userdata('kabupatenkota');
        $nama_kabupaten = $this->input->post('nama-kabupaten');
        $data = array(
            'url' => $url,
            'nomor_surat' => $this->input->post('id-proposal'),
            'id_kabupatenkota' => $id_kabupatenkota,
            'nama_kabupaten' => $nama_kabupaten,
            'nama_kecamatan' => $this->input->post('nama-kecamatan'),
            'nama_kelurahan' => $this->input->post('nama-kelurahan'),
            'poktan' => array(
                'nama_poktan' => $this->input->post('nama-poktan'),
                'nama_ketua' => $this->input->post('nama-ketua'),
                'user_input' => $user_input,
                'tgl_buat' => $tgl_buat
            ),
            'lokasi' => array(
                'id_kelurahan' => $this->input->post('desa'),
                'koordinat_a' => $this->input->post('a-koordinat'),
                'koordinat_b' => $this->input->post('b-koordinat'),
                'tgl_buat' => $tgl_buat
            ),
            'pengajuan' => array(
                'id_jenis' => $this->input->post('id-jenis'),
                'nama_kegiatan' => 'PENGEMBANGAN PADAT KARYA PRODUKTIF INFRASTRUKTUR PSP ASPEK IRIGASI PERTANIAN ' . $this->input->post('nama-kabupaten'),
                'luas_layanan' => $this->input->post('luas-layanan') . ' Ha',
                'unit' => $this->input->post('unit'),
                'perkiraan_biaya' => floatval(str_replace('.', '', $this->input->post('perkiraan-biaya'))),
                'jarak' => $this->input->post('panjang-jarak') . ' m',
                'ukuran_pompa' => $this->input->post('ukuran-pompa') . ' inchi',
                'bak_penampung' => $this->input->post('bak-penampung'),
                'rumah_pompa' => $this->input->post('rumah-pompa'),
                'provitas' => $this->input->post('provitas') . ' ton/Ha',
                'ip' => $this->input->post('ip'),
                'lahan_sawah' => $this->input->post('lahan-sawah'),
                'sumber_air' => $this->input->post('sumber-air'),
                'komoditas' => $this->input->post('komoditas'),
                'permasalahan' => $this->input->post('permasalahan'),
                'rencana_solusi' => $this->input->post('rencana-solusi'),
                'beda_elevasi' => $this->input->post('beda-elevasi'),
                'user_input' => $user_input,
                'status_pengajuan' => 1, //Sedang diverifikasi
                'kelayakan' => $this->input->post('status-kelayakan')
            ),
            'user_input' => $user_input,
            'user_update' => $user_input,
            'nama_user' => $this->session->userdata('nama'),
            'tgl_buat' => $tgl_buat
        );
        return $data;
    }

    public function uploadFile($fileName, $fileType, $nama_kelurahan, $urlParam, $id_pengajuan)
    {
        $file = $_FILES[$fileName]['name'];
        $new_fileName = '';
        $date = date('dmY');
        $upload_path = 'assets/pengajuan/' . $fileType . '/' . $date;

        if ($nama_kelurahan == '') {
            $new_fileName = $id_pengajuan . '_' . str_replace(" ", "-", $fileType) . '_' .  $date;
        } else {
            $new_fileName = $id_pengajuan . '_' . str_replace(" ", "-", $fileType) . '_' . str_replace(" ", "-", $nama_kelurahan) . '_' . $date;
        }

        if (!is_dir($upload_path)) {
            mkdir('./' . $upload_path, 0777, true);
        }

        if ($file) {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['max_size'] = 2048;
            $config['upload_path'] = './' . $upload_path . '/';
            $config['file_name'] = $new_fileName;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($fileName)) {
                $result = array($date, $new_fileName . $this->upload->data('file_ext'));
                return $result;
            } else {
                // $this->registration->deleteRegistration($id_pengajuan);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() .
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                );
                redirect('pengajuan/add/' . $urlParam);
            }
        }
    }

    /* ----------- ADMIN SIDE --------------------- */
    public function list_pengajuan_admin()
    {
        $param = array(
            'id_kabupatenkota' => $this->input->post('id_kabupatenkota'),
            'id_proposal' => $this->input->post('id_proposal'),
            // 'id_status' => 1,
        );
        $result = $this->pengajuan->getListPengajuan_admin($param);
        echo json_encode($result);
    }

    public function export_telaah()
    {
        $param = array(
            'id_kabupatenkota' => $this->input->post('id_kabupatenkota'),
            'id_proposal' => $this->input->post('id_proposal'),
            'url' => $this->input->post('url')
        );

        $result = $this->pengajuan->getListPengajuan_admin($param);

        $data['data'] = array();

        foreach ($result as $items) {
            $param['id_pengajuan'] = $items->id_pengajuan;

            $temp = array(
                "url" => $param['url'],
                "nama_kabupaten" => $items->nama_kabupaten,
                "nama_kecamatan" => $items->nama_kecamatan,
                "nama_kelurahan" => $items->nama_kelurahan,
                "poktan" => array(
                    "nama_poktan" => $items->nama_poktan,
                    "nama_ketua" => $items->nama_ketua,
                ),
                "lokasi" => array(
                    "koordinat_a" => $items->koordinat_a,
                    "koordinat_b" => $items->koordinat_b,
                ),
                "pengajuan" => array(
                    "id_jenis" => $items->id_jenis,
                    "luas_layanan" => $items->luas_layanan,
                    "unit" => $items->unit,
                    "perkiraan_biaya" => $items->perkiraan_biaya,
                    "jarak" => $items->jarak,
                    "ukuran_pompa" => $items->ukuran_pompa,
                    "bak_penampung" => $items->bak_penampung,
                    "rumah_pompa" => $items->rumah_pompa,
                    "provitas" => $items->provitas,
                    "ip" => $items->ip,
                    "lahan_sawah" => $items->lahan_sawah,
                    "sumber_air" => $items->sumber_air,
                    "komoditas" => $items->komoditas,
                    "permasalahan" => $items->permasalahan,
                    "rencana_solusi" => $items->rencana_solusi,
                    "beda_elevasi" => $items->beda_elevasi,
                    "user_input" => $items->user_input,
                    "status_pengajuan" => $items->status_pengajuan,
                    "kelayakan" => $items->kelayakan
                ),
                "user_input" => $items->user_input,
                'nama_user' => $this->session->userdata('nama'),
            );
            array_push($data['data'], $temp);
        }

        $data['title'] = 'TELAAH';
        $html = $this->load->view('pengajuan/data-telaah', $data, TRUE);
        $fileName = export_pdf($html, 'TELAAH' . '_' . $result[0]->nama_kabupaten, 'A4', 'landscape', FALSE);
        // $fileName = export_pdf($html, strtoupper($param['url']) . '_' . $this->input->post('id_proposal'), 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }

    public function generate_nota_dinas()
    {
        $param = array(
            'id_kabupatenkota' => $this->input->post('id_kabupatenkota'),
            'id_proposal' => $this->input->post('id_proposal'),
            'url' => $this->input->post('url')
        );

        $result = $this->pengajuan->getListPengajuan_admin($param);
        $profil = $this->profil->getDataProfil(array('id_user' => $this->session->userdata('id_user')));

        $data['data'] = array();

        foreach ($result as $items) {
            $temp = array(
                "url" => $param['url'],
                "nama_provinsi" => $items->nama_provinsi,
                "nama_kabupaten" => $items->nama_kabupaten,
                'tgl_buat' => tgl_indo(date('d-m-Y'), false),
                'nama_instansi' => $items->nama_instansi,
                "jumlah_alokasi" => count($result),
                "jabatan" => $profil->jabatan,
                "nama_kadin" => $profil->nama_kadin,
                "tanda_tangan" => $profil->tanda_tangan
            );
            array_push($data['data'], $temp);
        }

        $data['title'] = 'NOTA DINAS';
        $html = $this->load->view('pengajuan/data-nota-dinas', $data, TRUE);
        $fileName = export_pdf($html, 'NOTA DINAS' . '_' . $result[0]->nama_kabupaten, 'A4', 'potrait', FALSE);
        // $fileName = export_pdf($html, strtoupper($param['url']) . '_' . $this->input->post('id_proposal'), 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }

    public function generate_surat_penerbitan()
    {
        $param = array(
            'id_kabupatenkota' => $this->input->post('id_kabupatenkota'),
            'id_proposal' => $this->input->post('id_proposal'),
            'url' => $this->input->post('url')
        );

        $result = $this->pengajuan->getListPengajuan_admin($param);
        $profil = $this->profil->getDataProfil(array('id_user' => $this->session->userdata('id_user')));

        $data['data'] = array();

        foreach ($result as $items) {
            $temp = array(
                "url" => $param['url'],
                "nama_provinsi" => $items->nama_provinsi,
                "nama_kabupaten" => $items->nama_kabupaten,
                'tgl_buat' => tgl_indo($items->tanggal_buat, false),
                'nama_instansi' => $items->nama_instansi,
                'alamat_instansi' => $items->alamat_dinas,
                'nomor_surat' => $items->nomor_surat,
                "jumlah_alokasi" => count($result),
                "jabatan" => $profil->jabatan,
                "nama_kadin" => $profil->nama_kadin,
                "tanda_tangan" => $profil->tanda_tangan
            );
            array_push($data['data'], $temp);
        }

        $data['title'] = 'SURAT PENERBITAN';
        $html = $this->load->view('pengajuan/data-surat-penerbitan', $data, TRUE);
        $fileName = export_pdf($html, 'SURAT PENERBITAN' . '_' . $result[0]->nama_kabupaten, 'A4', 'potrait', FALSE);
        // $fileName = export_pdf($html, strtoupper($param['url']) . '_' . $this->input->post('id_proposal'), 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }

    public function simpan_telaah()
    {
        $idPengajuan = $this->input->post('id_pengajuan');

        $param = array(
            'pengajuan' => array(
                'status_pengajuan' => $this->pengajuan->getIdStatusByCode('DVR'), //Sudah diverifikasi
                'user_update' => $this->session->userdata('id_user')
            ),
            'mapping' => array(
                'catatan' => $this->input->post('catatan')
            )
        );

        $updated = $this->pengajuan->updateData('pengajuan', array('column' => 'id_pengajuan', 'value' => $idPengajuan), $param['pengajuan']);

        if ($updated) {
            $mapping = $this->pengajuan->updateData('mapping', array('column' => 'id_pengajuan', 'value' => $idPengajuan), $param['mapping']);
            setResponse($mapping, 'update');
        }
    }


    /* TIM PENOMORAN SIDE */

    public function petunjuk_penomoran()
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login/');
        }

        if (strtolower($this->session->userdata('tipe_akses')) != 'tim penomoran pusat') {
            redirect('auth/error401/');
        }

        $data['menu'] = ['petunjuk' => 'active', 'list' => ''];
        $data['type'] = 'list';
        // $data['kegiatan'] = $param;
        $data['role'] = $this->session->userdata('role');
        $data['userLogin'] = $this->session->userdata('nama');
        // $data['id_jenis'] = $this->pengajuan->getIdJenisByURL($param);

        $tipe_akses = $this->session->userdata('tipe_akses');

        load_page('penomoran/petunjuk-penomoran', 'PETUNJUK PENOMORAN', $data);
    }

    public function list_penomoran()
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login/');
        }

        if (strtolower($this->session->userdata('tipe_akses')) != 'tim penomoran pusat') {
            redirect('auth/error401/');
        }

        $data['menu'] = ['petunjuk' => '', 'list' => 'active'];
        $data['type'] = 'list';
        $data['role'] = $this->session->userdata('role');
        $data['userLogin'] = $this->session->userdata('nama');
        load_page('penomoran/list-data-penomoran', 'VERIFIKASI DAFTAR PENOMORAN', $data);
    }

    public function list_data_penomoran()
    {
        $data['result'] = array();

        $penomoran = $this->pengajuan->getListPenomoran();

        $tempIdProposal = null;
        foreach ($penomoran as $objPenomoran) {
            if ($objPenomoran->id_proposal != $tempIdProposal) {
                $tempIdProposal = $objPenomoran->id_proposal;
            } else {
                continue;
            }
            $temp = array(
                'id_pengajuan' => $objPenomoran->id_pengajuan,
                'id_proposal' => $objPenomoran->id_proposal,
                'id_penomoran' => $objPenomoran->id_penomoran,
                'kegiatan' => $objPenomoran->url,
                'status' => $objPenomoran->kode,
                'nama_provinsi' => $objPenomoran->nama_provinsi,
                'nama_kabupaten' => $objPenomoran->nama_kabupaten,
                'nama_kecamatan' => $objPenomoran->nama_kecamatan,
                'nama_kelurahan' => $objPenomoran->nama_kelurahan,
                'nama_poktan' => $objPenomoran->nama_poktan,
                'sk_tim_teknis' => stripslashes($objPenomoran->sk_tim_teknis),
                'sk_penerima' => stripslashes($objPenomoran->sk_penerima),
                'tgl_ppk' => tgl_indo($objPenomoran->tgl_ppk, false),
                'spks' => array(),
                'kwitansi' => array(),
            );
            $spks = $this->pengajuan->getSPKS_Poktan(array('table' => 'spks', 'column' => 'id_penomoran', 'value' => $objPenomoran->id_penomoran));
            if ($spks) {
                foreach ($spks as $objSpks) {
                    $tempSpks = array(
                        'nomor_sk' => stripslashes($objSpks->nomor_sk),
                        'nominal' => $objSpks->nominal,
                        'nama_poktan' => $objSpks->nama_poktan,
                        'skema' => $objSpks->skema
                    );
                    array_push($temp['spks'], $tempSpks);
                    $kwitansi = $this->pengajuan->getData(array('table' => 'kwitansi', 'column' => 'id_spks', 'value' => $objSpks->id_spks));
                    if ($kwitansi) {
                        foreach ($kwitansi as $objKwitansi) {
                            $tempKwitansi = array(
                                'nomor_kwitansi' => stripslashes($objKwitansi->nomor_kwitansi),
                                'nominal_diterima' => $objKwitansi->nominal_diterima,
                                'tahap' => $objKwitansi->tahap,
                                'tgl_kwitansi' => $objKwitansi->tgl_buat
                            );
                            array_push($temp['kwitansi'], $tempKwitansi);
                        }
                    }
                }
            }
            array_push($data['result'], $temp);
        }
        echo json_encode($data['result']);
    }

    public function verifikasi_penomoran()
    {
        $id_proposal = $this->input->post('id_proposal');
        $pic = $this->input->post('pic');

        $pengajuan = $this->pengajuan->getPengajuan($id_proposal);
        if ($pengajuan) {
            foreach ($pengajuan as $items) {
                $updateItem = array(
                    'status_pengajuan' => $this->pengajuan->getIdStatusByCode('TNMR'), //Pengajuan Penomoran
                    'user_update' => $this->session->userdata('id_user')
                );
                $this->pengajuan->updateData('pengajuan', array('column' => 'id_pengajuan', 'value' => $items->id_pengajuan), $updateItem);
            }

            $updated = $this->pengajuan->updateData('penomoran', array('column' => 'id_proposal', 'value' => $id_proposal), array('pic' => $pic));

            if ($updated) {
                setResponse($updated, 'update');
            }
        }
    }

    public function generate_daftar_nominatif()
    {
        $param = array(
            'id_kabupatenkota' => $this->input->post('id_kabupatenkota'),
            'id_proposal' => $this->input->post('id_proposal'),
            'url' => $this->input->post('url')
        );

        $result = $this->pengajuan->getListPenomoranForPrinting($param['id_proposal']);
        // $profil = $this->profil->getDataProfil(array('id_user' => $this->session->userdata('id_user')));

        $data['data'] = array();

        foreach ($result as $items) {
            $temp = array(
                "nama_kabupaten" => $items->nama_kabupaten,
                "nama_kecamatan" => $items->nama_kecamatan,
                "nama_kelurahan" => $items->nama_kelurahan,
                "nama_poktan" => $items->nama_poktan,
                'nama_bank' => $items->nama_bank,
                'no_rekening' => $items->no_rekening,
                'sk_penerima' => stripslashes($items->sk_penerima),
                'nominal' => $items->nominal
            );
            array_push($data['data'], $temp);
        }

        $data['title'] = 'DAFTAR NOMINATIF';
        $html = $this->load->view('penomoran/data-daftar-nominatif', $data, TRUE);
        $fileName = export_pdf($html, 'DAFTAR NOMINATIF' . '_' . $result[0]->nama_kabupaten, 'A4', 'landscape', FALSE);
        // $fileName = export_pdf($html, strtoupper($param['url']) . '_' . $this->input->post('id_proposal'), 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }
}

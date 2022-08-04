<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
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

    public function user()
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login/');
        }

        $param = array(
            'id_user' => $this->session->userdata('id_user')
        );

        $menu = ['perpipaan' => '', 'perpompaan' => '', 'embung' => '', 'air-tanah' => '', 'dokumen' => '', 'profil' => ''];
        $menu['profil'] = 'active';
        $data['menu'] = $menu;
        $data['type'] = 'list';
        $data['userLogin'] = $this->session->userdata('role');
        $data['profil'] = $this->profil->getDataProfil($param);

        load_page('profil/profil-user', 'PROFIL USER', $data);
    }

    public function updateProfil()
    {
        $idUser = $this->input->post('id-user');

        $split       = explode(' ', $this->input->post('alamat-instansi'));
        $alamatInstansi = $split[1] . ' ' . $split[2];

        $param = array(
            'user' => array(
                'nama' => $this->input->post('nama-instansi'),
                'id_kabupatenkota' => $this->input->post('kabupaten')
            ),
            'profil' => array(
                'nama_verifikator' => $this->input->post('nama-verifikator'),
                'alamat_dinas' => $alamatInstansi,
                'nama_kadin' => $this->input->post('nama-kadin'),
                'jabatan' => $this->input->post('jabatan-kadin'),
                'nip' => $this->input->post('nip-kadin'),
                'tanda_tangan' => $this->input->post('prev-ttd')
            )
        );

        if ($_FILES['doc-ttd']['name']) {
            $ttd = $this->uploadFile('doc-ttd', $param['profil']['tanda_tangan'], $param['profil']['alamat_dinas'], $idUser);
            $param['profil']['tanda_tangan'] = $ttd[1];
        }


        $this->profil->updateData('user', array('column' => 'id_user', 'value' => $idUser), $param['user']);
        $updated = $this->profil->updateData('profil', array('column' => 'id_user', 'value' => $idUser), $param['profil']);

        if ($updated) {
            redirect('profil/user/');
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
        $data['userLogin'] = $this->session->userdata('role');
        load_page('pengajuan/input-data', 'KEGIATAN ' . strtoupper(str_replace('-', ' ', $param)), $data);
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
        $data['userLogin'] = $this->session->userdata('role');
        $data['data'] = $this->initializeResult(array(
            'attr' => $param,
            'result' => $result,
            'docs' => $docs
        ));

        load_page('pengajuan/edit-data', 'KEGIATAN ' . strtoupper(str_replace('-', ' ', $url)), $data);
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

    public function list($param)
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login/' . $param);
        }

        $menu = ['perpipaan' => '', 'perpompaan' => '', 'embung' => '', 'air-tanah' => ''];
        $menu[$param] = 'active';

        $data['menu'] = $menu;
        $data['type'] = 'list';
        $data['kegiatan'] = $param;
        $data['userLogin'] = $this->session->userdata('role');
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
        $data['userLogin'] = $this->session->userdata('role');

        load_page('dokumen/list-data', 'DOKUMEN PROPOSAL', $data);
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
        echo json_encode($result);
    }

    public function list_proposal()
    {
        $param = array(
            'id_user' => $this->session->userdata('id_user'),
            'id_proposal' => null,
        );
        $result = $this->pengajuan->getProposal($param);
        // $user = $this->session->userdata('id_user');
        // $result = $this->pengajuan->getListProposal($user);
        foreach ($result as $items) {
            // $tgl_buat = $items->tgl_buat;
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
        $mapping = array(
            'id_proposal' => $param['id_proposal'],
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
            'id_user' => $this->session->userdata('id_user'),
            'id_pengajuan' => $this->input->post('id_pengajuan'),
            'id_proposal' => null,
            'url' => $this->input->post('url'),
        );
        $result = $this->pengajuan->getDetailPengajuan($param);
        $docs = $this->pengajuan->getDokumen($param);

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
            "tgl_buat" => $result->tgl_buat
        );

        $data['title'] = 'Kegiatan';
        $html = $this->load->view('pengajuan/data-pengajuan', $data, TRUE);
        $fileName = export_pdf($html, strtoupper($param['url']) . '_' . $result->nama_kelurahan, 'A4', 'landscape', FALSE);

        echo json_encode(substr($fileName, 9));
    }

    public function lihat_proposal()
    {
        $param = array(
            'id_user' => $this->session->userdata('id_user'),
            'id_pengajuan' => null,
            'id_proposal' => $this->input->post('id_proposal'),
            'url' => null,
        );
        $result = $this->pengajuan->getProposal($param);

        $data['data'] = array();

        foreach ($result as $items) {
            $param['id_pengajuan'] = $items->id_pengajuan;

            $docs = $this->pengajuan->getDokumen($param);

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
                "tgl_buat" => $items->tgl_buat
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
            "dokumen" => array(
                "plotting_area" => $param['docs'][0]->nama_folder . '/' . $param['docs'][0]->nama_dokumen,
                "sumber_air" => $param['docs'][1]->nama_folder . '/' . $param['docs'][1]->nama_dokumen,
                "lahan_sawah" => $param['docs'][2]->nama_folder . '/' . $param['docs'][2]->nama_dokumen
            ),
            "user_input" => $param['result']->user_input,
            'nama_user' => $this->session->userdata('nama'),
            "tgl_buat" => $param['result']->tgl_buat
        );

        return $data;
    }

    private function initializeParam()
    {
        $url = $this->input->post('url');
        $user_input = $this->session->userdata('id_user');
        $tgl_buat = date('Y-m-d H:i:s');
        $nama_kabupaten = $this->input->post('nama-kabupaten');
        $data = array(
            'url' => $url,
            'id_proposal' => $this->input->post('id-proposal'),
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

    public function uploadFile($fileName, $prevFileName, $nama_kabupaten, $id_user)
    {
        $file = $_FILES[$fileName]['name'];
        $new_fileName = '';
        $date = date('Ymd_His');
        $upload_path = 'assets/pengajuan/temp/signature';

        $new_fileName = $id_user . '_' . str_replace(" ", "-", $nama_kabupaten) . '_' . $date;

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
                $old_image = $prevFileName;
                if ($old_image != 'default.png') {
                    unlink('./assets/pengajuan/temp/signature/' . $old_image);
                }
                $result = array($date, $new_fileName . $this->upload->data('file_ext'));
                return $result;
            }
        }
    }

    /* ----------- ADMIN SIDE --------------------- */
    public function list_pengajuan_admin()
    {
        $param = array(
            'id_kabupatenkota' => $this->input->post('id_kabupatenkota'),
            'id_proposal' => $this->input->post('id_proposal'),
            'id_status' => 1
        );
        // $user = $this->session->userdata('id_user');
        // $jenis = $this->input->post('id_jenis');
        $result = $this->pengajuan->getListPengajuan_admin($param);
        echo json_encode($result);
    }
}

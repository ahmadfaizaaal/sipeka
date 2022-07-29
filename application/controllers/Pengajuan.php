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
        $data['userLogin'] = $this->session->userdata('role');
        load_page('pengajuan/input-data', 'KEGIATAN ' . strtoupper(str_replace('-', ' ', $param)), $data);
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
        $data['id_jenis'] = $this->pengajuan->getIdJenisByURL($param);
        $data['userLogin'] = $this->session->userdata('role');

        load_page('pengajuan/list-data', 'KEGIATAN ' . strtoupper(str_replace('-', ' ', $param)), $data);
    }

    public function cari_nomor_surat()
    {
        $param = $this->input->get('q', TRUE);
        $listNomorSurat = $this->pengajuan->getListNomorSurat($param);
        echo json_encode($listNomorSurat);
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

    public function insert_nomor_surat()
    {
        $data = array(
            'nomor_surat' => $this->input->post('nomorSurat'),
            'user_input' => $this->session->userdata('id_user'),
            'tgl_buat' => date('Y-m-d H:i:s')
        );
        $idProposal = $this->pengajuan->insertData('proposal', $data);
        echo json_encode($idProposal);
    }

    public function submitForm()
    {

        $param = $this->initializeParam();
        // echo json_encode($param);
        // die;

        $pengajuan = $param['pengajuan'];
        $pengajuan['id_poktan'] = $this->pengajuan->insertData('poktan', $param['poktan']);
        $pengajuan['id_lokasi'] = $this->pengajuan->insertData('lokasi', $param['lokasi']);

        $id_pengajuan = $this->pengajuan->insertData('pengajuan', $pengajuan);

        //INSERT DOCUMENT PROCESS
        $plotting_area = '';
        if ($_FILES['doc-plotting-area']['name']) {
            $plotting_area = $this->uploadFile('doc-plotting-area', 'PLOTTING AREA', $param['nama_kelurahan'], $param['url'], $id_pengajuan);
        }
        $sumber_air = '';
        if ($_FILES['doc-sumber-air']['name']) {
            $sumber_air = $this->uploadFile('doc-sumber-air', 'SUMBER AIR', $param['nama_kelurahan'], $param['url'], $id_pengajuan);
        }
        $lahan_sawah = '';
        if ($_FILES['doc-lahan-sawah']['name']) {
            $lahan_sawah = $this->uploadFile('doc-lahan-sawah', 'LAHAN SAWAH', $param['nama_kelurahan'], $param['url'], $id_pengajuan);
        }

        $documents = array($plotting_area, $sumber_air, $lahan_sawah);
        for ($i = 0; $i < count($documents); $i++) {
            $item = $documents[$i];
            $data = array(
                'id_pengajuan' => $id_pengajuan,
                'identifier' => 'image',
                'folder_name' => $item[0],
                'nama_dokumen' => $item[1],
                'user_input' => $param['user_input'],
                'tgl_buat' => $param['tgl_buat']
            );

            $this->pengajuan->insertData('dokumen', $data);
        }

        //INSERT MAPPING PROCESS
        $mapping = array(
            'id_proposal' => $param['id_proposal'],
            'id_pengajuan' => $id_pengajuan
        );

        $id_mapping = $this->pengajuan->insertData('mapping', $mapping);

        if ($id_mapping) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Pengajuan Anda berhasil disimpan. Silahkan tunggu informasi selanjutnya!' .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('pengajuan/list/' . $param['url']);
        }
    }

    public function dokumen()
    {
        $data['data'] = array(
            "url" => "perpipaan",
            "id_proposal" => "3",
            "nama_kabupaten" => "KABUPATEN ACEH BESAR",
            "nama_kecamatan" => "LEMBAH SEULAWAH",
            "nama_kelurahan" => "PANCA KUBU",
            "poktan" => array(
                "nama_poktan" => "Kelompok Tani Blang Kuta",
                "nama_ketua" => "Muhammad Jamil",
                "user_input" => "2",
                "tgl_buat" => "2022-07-29 07:21:49"
            ),
            "lokasi" => array(
                "id_kelurahan" => "1108042002",
                "koordinat_a" => "'5°17',55 \"N",
                "koordinat_b" => "95° 15' 9 \" E",
                "tgl_buat" => "2022-07-29 07:21:49"
            ),
            "pengajuan" => array(
                "id_jenis" => "1",
                "nama_kegiatan" => "PENGEMBANGAN PADAT KARYA PRODUKTIF INFRASTRUKTUR PSP ASPEK IRIGASI PERTANIAN KABUPATEN ACEH BESAR",
                "luas_layanan" => "38.22 Ha",
                "unit" => "1",
                "perkiraan_biaya" => 123000000,
                "jarak" => "12 m",
                "ukuran_pompa" => "6 inchi",
                "bak_penampung" => "2,0 m x 2,0 m x 1,5 m",
                "rumah_pompa" => "2,5 m x 2,0 m x 2,0 m",
                "provitas" => "2 ton/Ha",
                "ip" => "2",
                "lahan_sawah" => "Irigasi Teknis",
                "sumber_air" => "mata air dan embung",
                "komoditas" => "padi",
                "permasalahan" => "kekurangan air",
                "rencana_solusi" => "pembuatan rumah pompa dan perpipaan",
                "beda_elevasi" => "4",
                "user_input" => "2",
                "status_pengajuan" => 1,
                'kelayakan' => 'LAYAK'
            ),
            "user_input" => "2",
            'nama_user' => $this->session->userdata('nama'),
            "tgl_buat" => "2022-07-29 07:21:49"
        );
        // $user = $this->session->userdata('id_user');
        // $jenis = $this->input->post('id_jenis');
        // $result = $this->pengajuan->getListPengajuan($user, $jenis);


        $data['title'] = 'Kegiatan';
        $html = $this->load->view('pengajuan/data-pengajuan', $data, TRUE);
        export_pdf($html, 'mypdf', 'A4', 'landscape');
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
                'ukuran_pompa' => $this->input->post('ukuran-pompa') . $url == 'perpompaan' ? ' inchi' : ' m',
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

    // public function test()
    // {
    //     $data['title'] = "Sistem Manajemen Layanan Pernikahan";
    //     $this->load->view('registration/test', $data);
    // }

    // public function picker()
    // {
    //     $this->load->view('registration/datetime');
    // }
}

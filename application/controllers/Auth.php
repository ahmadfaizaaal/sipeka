<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require_once('application/models/Test.php');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // date_default_timezone_set('Asia/Bangkok');
        $this->load->library('form_validation');
        $this->load->model('M_Auth', 'auth');
        date_default_timezone_set('Asia/Bangkok');
    }

    public function login($param = null)
    {
        if ($this->session->userdata('email')) {
            redirect('home');
        }

        // if ($this->session->userdata('username')) {
        //     if ('1' == $this->session->userdata('role_id')) {
        //         redirect('staff');
        //     } else if ('2' == $this->session->userdata('role_id')) {
        //         redirect('penghulu');
        //     }
        // }

        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => "Email harus diisi!"
        ]);
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required|trim', [
            'required' => "Kata sandi harus diisi!"
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Sistem Informasi Pengajuan Alokasi Kegiatan';
            $data['param'] = $param;
            $this->load->view('auth/login', $data);
        } else {
            $this->_login($param);
        }
    }

    private function _login($param)
    {
        $role = '';
        $data = [];
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $userLogin = $this->auth->getDataUser($email);

        // if ($userLogin) {
        //     $role = 'user';
        // } else {
        // $userLogin = $this->auth->getDataOfficer($email);
        if ($userLogin) {
            $role = $userLogin->kode_akses;
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Email tidak terdaftar!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>'
            );
            redirect('auth/login/' . $param);
        }
        // }

        //CHECK IF PASSWORD IS MATCH
        if (password_verify($password, $userLogin->password)) {
            if ('Daerah' == $role) {
                $data = [
                    'id_user' => $userLogin->id_user,
                    'nama' => $userLogin->nama,
                    'email' => $userLogin->email,
                    'role' => $role,
                    'kabupatenkota' => $userLogin->id_kabupatenkota,
                    'last_time_login' => time()
                ];
                $this->session->set_userdata($data);
                if ('' == $param || null == $param) {
                    redirect('home');
                } else {
                    redirect('pengajuan/list/' . $param);
                }
            } else if ('Pusat' == $role) {
                $data = [
                    'id_user' => $userLogin->id_user,
                    'nama' => $userLogin->nama,
                    'tipe_akses' => $userLogin->tipe_akses,
                    'role' => $role,
                    'bagian' => $userLogin->bagian,
                    'last_time_login' => time()
                ];
                $this->session->set_userdata($data);

                if (strtolower($userLogin->tipe_akses) == 'tim penomoran pusat') {
                    redirect('pengajuan/petunjuk-penomoran/');
                }
                redirect('pengajuan/list/' . strtolower($userLogin->bagian));
                // if ('1' == $userLogin->ROLE_ID) {
                //     redirect('staff');
                // } else if ('2' == $userLogin->ROLE_ID) {
                //     redirect('penghulu');
                // }
            }
            // $this->session->set_userdata($data);
            // if ('user' == $role) {
            //     if ('general' == $param) {
            //         redirect('home');
            //     } else {
            //         redirect('home/registration/' . $param);
            //     }
            // } else if ('officer' == $role) {

            // }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Kata sandi salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('auth/login/' . $param);
        }
    }

    public function register($param)
    {
        if ($this->session->userdata('nik')) {
            redirect('home');
        }

        $nik = htmlspecialchars($this->input->post('nik', true));
        $isUser = $this->auth->getDataParticipant($nik);

        if ($isUser) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    NIK telah terdaftar di sistem!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('auth/register/' . $param);
        } else {
            //BEGINNING RULES
            $this->form_validation->set_rules('nik', 'No. KTP', 'required|trim|min_length[16]|max_length[16]|numeric', [
                'min_length' => 'No. KTP minimal sebanyak 16 karakter!',
                'max_length' => 'No. KTP maksimal sebanyak 16 karakter!',
                'numeric' => 'No. KTP harus berupa angka!',
                'required' => "No. KTP harus diisi!"
            ]);
            $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim', [
                'required' => "Nama lengkap harus diisi!"
            ]);
            $this->form_validation->set_rules('birthplace', 'Tempat Lahir', 'required|trim', [
                'required' => "Tempat lahir harus diisi!"
            ]);
            $this->form_validation->set_rules('birthdate', 'Tanggal Lahir', 'required|trim', [
                'required' => "Tanggal lahir harus diisi!"
            ]);
            $this->form_validation->set_rules('address', 'Alamat Sesuai KTP', 'required|trim', [
                'required' => "Alamat sesuai KTP harus diisi!"
            ]);
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|min_length[10]|max_length[12]|numeric', [
                'min_length' => 'No. HP sedikitnya sebanyak 10 karakter!',
                'max_length' => 'No. HP maksimal sebanyak 12 karakter!',
                'numeric' => 'No. HP harus berupa angka!',
                'required' => "No. HP / WA harus diisi!"
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
                'required' => "Email harus diisi!"
            ]);
            $this->form_validation->set_rules('password1', 'Kata sandi', 'required|trim|min_length[6]|matches[password2]', [
                'matches' => "Kata sandi tidak sesuai!",
                'min_length' => "Kata sandi terlalu singkat!",
                'required' => "Kata sandi harus diisi!"
            ]);
            $this->form_validation->set_rules('password2', 'Kata sandi', 'required|trim|matches[password1]', [
                'required' => "Kata sandi harus diisi!"
            ]);

            //SELECTION
            if ($this->form_validation->run() == false) {
                $data['title'] = 'Sistem Manajemen Layanan Pernikahan';
                $data['param'] = $param;
                $this->load->view('auth/register', $data);
            } else {
                $penduduk = $this->auth->getDataByNIK($nik);

                $data = [
                    'NIK' => $nik,
                    'NAME' => htmlspecialchars($penduduk->NAMA),
                    'GENDER' => htmlspecialchars($penduduk->JENIS_KELAMIN),
                    'BIRTH_PLACE' => htmlspecialchars($penduduk->TEMPAT_LAHIR),
                    'BIRTH_DATE' => htmlspecialchars($penduduk->TANGGAL_LAHIR),
                    'JOB' => htmlspecialchars($penduduk->PEKERJAAN),
                    'PHONE' => htmlspecialchars($this->input->post('phone', true)),
                    'EMAIL' => htmlspecialchars($this->input->post('email', true)),
                    'ADDRESS' => htmlspecialchars($this->input->post('address', true)),
                    'PASSWORD' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'DTM_CRT' => date('Y-m-d H:i:s')
                ];

                $this->auth->registerAccount($data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> Akun anda telah berhasil dibuat. Silahkan login untuk melanjutkan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>'
                );
                redirect('auth/login/' . $param);
            }
        }
    }

    public function denied()
    {
        $data['title'] = 'Access Denied!';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/denied');
        $this->load->view('templates/footer');
    }

    public function cekNIK()
    {
        $nik = $this->input->post('nik');
        $penduduk = $this->auth->getDataByNIK($nik);
        echo json_encode($penduduk);
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('kabupatenkota');
        $this->session->unset_userdata('tipe_akses');
        $this->session->unset_userdata('bagian');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Anda telah berhasil logout dari sistem!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>'
        );
        redirect('home');
        $this->session->sess_destroy();
    }

    public function error404()
    {
        $this->load->view("errors/error-404");
    }

    public function error401()
    {
        $this->load->view("errors/error-401");
    }
}

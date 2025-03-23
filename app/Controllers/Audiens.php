<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\AudiensModel;
use App\Models\BuktiPembayaran;
use CodeIgniter\Controller;

class Audiens extends BaseController
{

    protected $userModel;
    protected $user;
    protected $audiensModel;
    protected $buktiPembayaranModel;

    public function __construct()
    {
        helper('session'); // Pastikan session helper dipanggil

        $this->userModel = new User(); // Pastikan UserModel sudah ada
        $this->audiensModel = new AudiensModel(); // Instance model Audiens
        $this->buktiPembayaranModel = new BuktiPembayaran(); // Instance model BuktiPembayaran
        $this->user = session()->get(); // Ambil semua data dari session
    }

    public function homepage()
    {
        return view('templates/headerUser',  ['title' => 'Homepage Theaterform']) .
            view('templates/bodyHomepage') .
            view('templates/footer');
    }

    public function register()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        try {
            // Coba membuat koneksi database
            $db = \Config\Database::connect();

            // Periksa apakah koneksi berhasil atau tidak
            if (!$db instanceof \CodeIgniter\Database\ConnectionInterface) {
                throw new \RuntimeException('Koneksi ke database gagal.');
            }

            // Tidak perlu menampilkan pesan apa pun jika koneksi berhasil
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        // Jika form disubmit
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();

            $rules = [
                'username' => 'required|min_length[3]|max_length[15]',
                'nama'     => 'required',
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]',
                'tgl_lahir' => 'required|valid_date',
                'gender'   => 'required|in_list[male,female]',
                'id_role'  => 'required|in_list[1]', // Role Audiens (id_role = 1)
            ];

            // Gunakan validasi bawaan terlebih dahulu
            // Gunakan metode dari model untuk memeriksa keunikan username dan email
            if (!$this->userModel->isUniqueUsername($data['username'], $data['id_role'])) {
                return redirect()->back()->withInput()->with('errors', ['username' => 'Username sudah digunakan untuk role ini.']);
            }

            if (!$this->userModel->isUniqueEmail($data['email'], $data['id_role'])) {
                return redirect()->back()->withInput()->with('errors', ['email' => 'Email sudah digunakan untuk role ini.']);
            }

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $userData = [
                'id_role' => 1, // Role Audiens
                'username' => $data['username'],
                'nama' => $data['nama'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'email' => $data['email'],
                'login_attempt' => 0,
                'tgl_dibuat' => date('Y-m-d H:i:s'),
                'tgl_dimodif' => date('Y-m-d H:i:s')
            ];

            if (!$this->userModel->save($userData)) {
                session()->setFlashdata('error', 'Gagal menyimpan data pengguna. Silakan coba lagi.');
                return redirect()->back()->withInput();
            }

            // Simpan user ke tabel m_user
            $userId = $this->userModel->getInsertID(); // Ambil ID User yang baru disimpan

            // Input data audiens ke tabel m_audiens
            $audiensData = [
                'id_user' => $userId, // Menghubungkan audiens dengan user
                'tgl_lahir' => $data['tgl_lahir'],
                'gender' => $data['gender'],
            ];

            // Simpan audiens ke tabel m_audiens
            $this->audiensModel->save($audiensData); // id_audiens dihasilkan otomatis oleh database         

            session()->setFlashdata('success', 'Registrasi berhasil! Silakan cek email untuk verifikasi.');
            return redirect()->to(base_url('Audiens/confirmation')); // Arahkan ke halaman konfirmasi
        }

        return view('templates/headerRegist') .
            view('templates/bodyRegist');
    }

    public function confirmation()
    {
        return view('templates/audiensConfirmation');
    }

    public function homepageAfterLogin()
    {
        // Ambil data user dari session (misal data user disimpan di session setelah login)
        $userId = session()->get('id_user'); // Misalnya user_id disimpan di session setelah login
        $user = $this->userModel->find($userId); // Ambil data user berdasarkan user_id

        // Kirim data user ke view
        return view('templates/headerAudiens', ['title' => 'Homepage Audiens', 'user'  => $this->user]) .
            view('templates/bodyHomepage') .
            view('templates/footer');
    }

    public function listPenampilan()
    {
        $sedangTayang = [
            [
                'judul' => 'Beauty and The Beast',
                'komunitas_teater' => 'Mickey Houseclub Production',
                'lokasi_teater' => 'Teater Jakarta, Taman Ismail Marzuki',
                'hari' => 'Sabtu',
                'tanggal' => '10 Februari 2025',
                'jam' => '19:00 WIB',
                'rating_umur' => 'Semua Umur',
                'poster' => base_url('assets/images/poster/poster1.jpg')
            ],
            [
                'judul' => 'The Captain Hook',
                'komunitas_teater' => 'Bengawan Production',
                'lokasi_teater' => 'Gedung Kesenian Jakarta',
                'hari' => 'Minggu',
                'tanggal' => '11 Februari 2025',
                'jam' => '20:00 WIB',
                'rating_umur' => '13+',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
            [
                'judul' => 'The Genie; Secret Wishes',
                'komunitas_teater' => 'Tullyp Ciledug Production',
                'lokasi_teater' => 'Teater Besar TIM',
                'hari' => 'Jumat',
                'tanggal' => '16 Februari 2025',
                'jam' => '18:30 WIB',
                'rating_umur' => '17+',
                'poster' => base_url('assets/images/poster/poster3.jpeg')
            ],
            [
                'judul' => 'The Little Prince from Moon',
                'komunitas_teater' => 'Kapuas Meruya Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 Februari 2025',
                'jam' => '15:00 WIB',
                'rating_umur' => 'Semua Umur',
                'poster' => base_url('assets/images/poster/poster4.jpeg')
            ],
            [
                'judul' => 'The Princess from Knowhere',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 Maret 2025',
                'jam' => '18:00 WIB',
                'rating_umur' => 'Semua Umur',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
        ];

        $akanTayang = $sedangTayang; // Example: Replace with actual data

        return view('templates/headerUser',  ['title' => 'List Penampilan Teater']) .
            view('templates/bodyListPenampilan', compact('sedangTayang', 'akanTayang')) .
            view('templates/footerListPenampilan');
    }

    public function ListAudisi()
    {
        $audisiAktor = [
            [
                'judul' => 'The Princess from Knowhere',
                'karakter_audisi' => 'Putri Liliput',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
            [
                'judul' => 'Tung Tang Ting',
                'karakter_audisi' => 'Lily Tulalit',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 April 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster1.jpg')
            ],
            [
                'judul' => 'The Prince of Konoha',
                'karakter_audisi' => 'Bangsawan Ethan',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster4.jpeg')
            ],
            [
                'judul' => 'Bajak Sambal dan Laut',
                'karakter_audisi' => 'Kapten Hulahoop',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '7 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster3.jpeg')
            ],
            [
                'judul' => 'Hutang Piutang',
                'karakter_audisi' => 'Mak Sukinem',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Februari 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
        ];

        $audisiStaff = [
            [
                'judul' => 'The Princess from Knowhere',
                'jenis_staff' => 'Tata Lampu',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
            [
                'judul' => 'Tung Tang Ting',
                'jenis_staff' => 'Tata Busana',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 April 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster1.jpg')
            ],
            [
                'judul' => 'The Prince of Konoha',
                'jenis_staff' => 'Tata Panggung',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster4.jpeg')
            ],
            [
                'judul' => 'Bajak Sambal dan Laut',
                'jenis_staff' => 'Asisten Sutradara',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '7 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster3.jpeg')
            ],
            [
                'judul' => 'Hutang Piutang',
                'jenis_staff' => 'Tata Properti',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Februari 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
        ];

        return view('templates/headerUser',  ['title' => 'List Audisi Teater']) .
            view('templates/bodyAudisi', compact('audisiAktor', 'audisiStaff')) .
            view('templates/footerListPenampilan');
    }

    public function DetailPenampilan()
    {

        $session = session();

        // Cek apakah user sudah login
        if (!$session->has('id_user')) {
            return redirect()->to(base_url('User/login'))->with('error', 'Silakan login untuk melihat detail.');
        }

        // Data dummy untuk jadwal pertunjukan
        $scheduleData = [
            [
                'kota' => 'Jakarta',
                'tempat' => 'Aula Teater Garuda Krisna',
                'tanggal' => '2024-09-12',
                'waktu' => ['15:00 - 17:00 WIB', '19:00 - 21:00 WIB'],
                'harga' => 'Rp100.000 (Premium), Rp75.000 (Reguler)',
                'denah' => 'seat1.jpg'
            ],
            [
                'kota' => 'Bandung',
                'tempat' => 'Teater Budaya',
                'tanggal' => '2024-09-13',
                'waktu' => ['16:00 - 18:00 WIB', '19:30 - 21:30 WIB'],
                'harga' => 'Rp120.000 (VIP), Rp80.000 (Ekonomi)',
                'denah' => 'seat1.jpg'
            ],
            [
                'kota' => 'Bandung',
                'tempat' => 'Teater Pusaka',
                'tanggal' => '2024-09-14',
                'waktu' => ['19:30 - 21:30 WIB'],
                'harga' => 'Rp90.000 (Reguler)',
                'denah' => 'seat1.jpg'
            ],
        ];

        $groupedSchedule = [];
        $placeInfo = []; // Menyimpan harga dan denah untuk tiap tempat

        foreach ($scheduleData as $row) {
            foreach ($row['waktu'] as $waktu) {
                $groupedSchedule[$row['kota']][$row['tempat']][$row['tanggal']][] = $waktu;
            }

            // Simpan informasi harga dan denah berdasarkan tempat
            $placeInfo[$row['tempat']] = [
                'harga' => $row['harga'],
                'denah' => $row['denah']
            ];
        }

        return view('templates/headerAudiens',  ['title' => 'Detail Penampilan Teater', 'user'  => $this->user]) .
            view('templates/bodyDetailPenampilan', ['groupedSchedule' => $groupedSchedule, 'placeInfo' => $placeInfo]) .
            view('templates/footerListPenampilan', ['needsDropdown' => true]);
    }

    // public function detail($id)
    // {
    //     //$teaterModel = new TeaterModel();
    //     //$teater = $teaterModel->where('id', $id)->first();

    //     // if (!$teater) {
    //     //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     // }

    //    return view('templates/headerAudiens',  ['title' => 'Detail Pertunjukan Teater']).
    //     view('templates/bodyDetailPenampilan').
    //     view('templates/footerListPenampilan');
    // }

    public function penampilanAfterLogin()
    {
        // Ambil data user dari session (misal data user disimpan di session setelah login)
        $userId = session()->get('id_user'); // Misalnya user_id disimpan di session setelah login
        $user = $this->userModel->find($userId); // Ambil data user berdasarkan user_id

        $sedangTayang = [
            [
                'judul' => 'Beauty and The Beast',
                'komunitas_teater' => 'Mickey Houseclub Production',
                'lokasi_teater' => 'Teater Jakarta, Taman Ismail Marzuki',
                'hari' => 'Sabtu',
                'tanggal' => '10 Februari 2025',
                'jam' => '19:00 WIB',
                'rating_umur' => 'Semua Umur',
                'poster' => base_url('assets/images/poster/poster1.jpg')
            ],
            [
                'judul' => 'The Captain Hook',
                'komunitas_teater' => 'Bengawan Production',
                'lokasi_teater' => 'Gedung Kesenian Jakarta',
                'hari' => 'Minggu',
                'tanggal' => '11 Februari 2025',
                'jam' => '20:00 WIB',
                'rating_umur' => '13+',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
            [
                'judul' => 'The Genie; Secret Wishes',
                'komunitas_teater' => 'Tullyp Ciledug Production',
                'lokasi_teater' => 'Teater Besar TIM',
                'hari' => 'Jumat',
                'tanggal' => '16 Februari 2025',
                'jam' => '18:30 WIB',
                'rating_umur' => '17+',
                'poster' => base_url('assets/images/poster/poster3.jpeg')
            ],
            [
                'judul' => 'The Little Prince from Moon',
                'komunitas_teater' => 'Kapuas Meruya Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 Februari 2025',
                'jam' => '15:00 WIB',
                'rating_umur' => 'Semua Umur',
                'poster' => base_url('assets/images/poster/poster4.jpeg')
            ],
        ];

        $akanTayang = $sedangTayang; // Example: Replace with actual data

        return view('templates/headerAudiens',  ['title' => 'List Penampilan Audiens', 'user'  => $this->user]) .
            view('templates/bodyListPenampilan', compact('sedangTayang', 'akanTayang')) .
            view('templates/footerListPenampilan', ['needsDropdown' => true]);
    }

    public function AudisiAfterLogin()
    {
        $audisiAktor = [
            [
                'judul' => 'The Princess from Knowhere',
                'karakter_audisi' => 'Putri Liliput',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
            [
                'judul' => 'Tung Tang Ting',
                'karakter_audisi' => 'Lily Tulalit',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 April 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster1.jpg')
            ],
            [
                'judul' => 'The Prince of Konoha',
                'karakter_audisi' => 'Bangsawan Ethan',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster4.jpeg')
            ],
            [
                'judul' => 'Bajak Sambal dan Laut',
                'karakter_audisi' => 'Kapten Hulahoop',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '7 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster3.jpeg')
            ],
            [
                'judul' => 'Hutang Piutang',
                'karakter_audisi' => 'Mak Sukinem',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Februari 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
        ];

        $audisiStaff = [
            [
                'judul' => 'The Princess from Knowhere',
                'jenis_staff' => 'Tata Lampu',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
            [
                'judul' => 'Tung Tang Ting',
                'jenis_staff' => 'Tata Busana',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '17 April 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster1.jpg')
            ],
            [
                'judul' => 'The Prince of Konoha',
                'jenis_staff' => 'Tata Panggung',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster4.jpeg')
            ],
            [
                'judul' => 'Bajak Sambal dan Laut',
                'jenis_staff' => 'Asisten Sutradara',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '7 Maret 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster3.jpeg')
            ],
            [
                'judul' => 'Hutang Piutang',
                'jenis_staff' => 'Tata Properti',
                'komunitas_teater' => 'Pria Bercerita Production',
                'lokasi_teater' => 'Ciputra Artpreneur Theater',
                'hari' => 'Sabtu',
                'tanggal' => '27 Februari 2025',
                'jam' => '18:00 WIB',
                'poster' => base_url('assets/images/poster/poster2.jpeg')
            ],
        ];

        return view('templates/headerAudiens',  ['title' => 'List Audisi Teater', 'user'  => $this->user]) .
            view('templates/bodyAudisi', compact('audisiAktor', 'audisiStaff')) .
            view('templates/footerListPenampilan', ['needsDropdown' => true]);
    }

    public function DetailAudisiAktor()
    {

        $session = session();

        // Cek apakah user sudah login
        if (!$session->has('id_user')) {
            return redirect()->to(base_url('User/login'))->with('error', 'Silakan login untuk melihat detail.');
        }

        // Data dummy untuk jadwal pertunjukan
        $scheduleData = [
            [
                'kota' => 'Jakarta',
                'tempat' => 'Aula Teater Garuda Krisna',
                'tanggal' => '2024-09-12',
                'waktu' => ['Sesi I 15:00 - 17:00 WIB', 'Sesi II 19:00 - 21:00 WIB'],
            ],
            [
                'kota' => 'Bandung',
                'tempat' => 'Teater Budaya',
                'tanggal' => '2024-09-13',
                'waktu' => ['Sesi I 16:00 - 18:00 WIB', 'Sesi II 19:30 - 21:30 WIB'],
            ],
            [
                'kota' => 'Bandung',
                'tempat' => 'Teater Pusaka',
                'tanggal' => '2024-09-14',
                'waktu' => ['19:30 - 21:30 WIB'],
            ],
        ];

        $groupedSchedule = [];

        foreach ($scheduleData as $row) {
            foreach ($row['waktu'] as $waktu) {
                $groupedSchedule[$row['kota']][$row['tempat']][$row['tanggal']][] = $waktu;
            }
        }

        return view('templates/headerAudiens',  ['title' => 'Detail Audisi Aktor Teater', 'user'  => $this->user]) .
            view('templates/bodyDetailAudisiAktor', ['groupedSchedule' => $groupedSchedule]) .
            view('templates/footerListPenampilan', ['needsDropdown' => true]);
    }

    public function detailAudisiStaff()
    {

        $session = session();

        // Cek apakah user sudah login
        if (!$session->has('id_user')) {
            return redirect()->to(base_url('User/login'))->with('error', 'Silakan login untuk melihat detail.');
        }

        // Data dummy untuk jadwal pertunjukan
        $scheduleData = [
            [
                'kota' => 'Jakarta',
                'tempat' => 'Aula Teater Garuda Krisna',
                'tanggal' => '2024-09-12',
                'waktu' => ['Sesi I 15:00 - 17:00 WIB', 'Sesi II 19:00 - 21:00 WIB'],
            ],
            [
                'kota' => 'Bandung',
                'tempat' => 'Teater Budaya',
                'tanggal' => '2024-09-13',
                'waktu' => ['Sesi I 16:00 - 18:00 WIB', 'Sesi II 19:30 - 21:30 WIB'],
            ],
            [
                'kota' => 'Bandung',
                'tempat' => 'Teater Pusaka',
                'tanggal' => '2024-09-14',
                'waktu' => ['19:30 - 21:30 WIB'],
            ],
        ];

        $groupedSchedule = [];

        foreach ($scheduleData as $row) {
            foreach ($row['waktu'] as $waktu) {
                $groupedSchedule[$row['kota']][$row['tempat']][$row['tanggal']][] = $waktu;
            }
        }

        return view('templates/headerAudiens',  ['title' => 'Detail Audisi Staff Teater', 'user'  => $this->user]) .
            view('templates/bodyDetailAudisiStaff', ['groupedSchedule' => $groupedSchedule]) .
            view('templates/footerListPenampilan', ['needsDropdown' => true]);
    }

    public function profile() {
        $userId = session()->get('id_user');
        $user = $this->userModel->find($userId);

        return  view('templates/headerAudiens', ['title' => 'Detail Penampilan Teater', 'user' => $user]) .
                view('templates/profileUser', ['user' => $user]);
    }
  
    public function uploadBuktiPembayaran()
    {
        $userId = session()->get('id_user');

        // Cari id_audiens berdasarkan id_user
        $audiens = $this->audiensModel->where('id_user', $userId)->first();
        if (!$audiens) {
            return redirect()->back()->with('error', 'Data audiens tidak ditemukan.');
        }

        $idAudiens = $audiens['id_audiens'];
        $idTeater = $this->request->getPost('id_teater');
        $file = $this->request->getFile('bukti');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        $fileName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/bukti/', $fileName);

        $buktiData = [
            'id_audiens' => $idAudiens,
            'id_teater' => $idTeater,
            'tgl_upload' => date('Y-m-d H:i:s'),
            'is_valid' => null,
            'tgl_validated' => date('Y-m-d H:i:s'),
            // 'file_path' => 'uploads/bukti/' . $fileName,
        ];

        $this->buktiPembayaranModel->save($buktiData);

        return redirect()->to(base_url('Audiens/homepageAudiens'))->with('success', 'Bukti pembayaran berhasil diupload.');
    }
}

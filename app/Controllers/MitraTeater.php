<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\MitraModel;
use App\Models\PlatformSosmedModel;
use App\Models\MitraSosmedModel;
use CodeIgniter\Controller;

class MitraTeater extends BaseController
{
    protected $userModel;
    protected $mitraModel;
    protected $platformSosmedModel;
    protected $mitraSosmedModel;

    public function __construct()
    {
        $this->userModel = new User(); // Pastikan UserModel sudah ada.
        $this->mitraModel = new MitraModel();
        $this->platformSosmedModel = new PlatformSosmedModel();
        $this->mitraSosmedModel = new MitraSosmedModel();

        helper('session'); // Pastikan helper session dimuat
        session(); // Pastikan session berjalan
    }

    // Fungsi untuk registrasi akun Mitra Teater
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

        if ($this->request->getMethod() === 'POST') {
            // Ambil semua data dari form
            $data = $this->request->getPost();

            $rules = [
                'username'      => 'required|min_length[3]|max_length[15]',
                'nama'          => 'required',
                'email'         => 'required|valid_email',
                'password'      => 'required|min_length[6]',
                'alamat'        => 'required',
                'berdiri_sejak' => 'required|valid_date',
                'deskripsi'     => 'required',
                'id_role'       => 'required|in_list[2]', // Role Mitra Teater (id_role = 2)
                'hidden_accounts' => 'required',
            ];

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

            // Simpan data user ke tabel m_user
            $userData = [
                'id_role' => 2, // Pastikan role sesuai dengan mitra teater
                'username' => $data['username'],
                'nama' => $data['nama'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'email' => $data['email'],
                'login_attempt' => 0,
                'tgl_dibuat' => date('Y-m-d H:i:s'),
                'tgl_dimodif' => date('Y-m-d H:i:s'),
            ];

            if (!$this->userModel->save($userData)) {
                session()->setFlashdata('error', 'Gagal menyimpan data pengguna. Silakan coba lagi.');
                return redirect()->back()->withInput();
            }

            // Ambil ID user yang baru disimpan
            $idUser = $this->userModel->getInsertID();

            if (!$idUser) {
                session()->setFlashdata('error', 'Gagal mendapatkan ID pengguna.');
                return redirect()->back()->withInput();
            }

            $logo = $this->request->getFile('logo');

            // Periksa apakah file valid
            if (!$logo->isValid()) {
                log_message('error', 'Logo file upload error: ' . $logo->getErrorString());
                return redirect()->back()->withInput()->with('errors', ['logo' => 'File logo tidak valid atau gagal diunggah.']);
            }

            // Periksa tipe file (opsional, untuk memastikan hanya gambar yang diunggah)
            if (!$logo->isValid() || !$logo->hasMoved()) {
                if (!in_array($logo->getMimeType(), ['image/png', 'image/jpeg', 'image/jpg'])) {
                    return redirect()->back()->withInput()->with('errors', ['logo' => 'Format file logo tidak didukung.']);
                }
            }

            // Periksa apakah file valid
            if ($logo->isValid() && !$logo->hasMoved()) {
                $newName = $logo->getRandomName(); // Buat nama unik
                $logo->move('public/uploads/logo/', $newName); // Pindahkan ke folder public
                $logoUrl = 'uploads/logo/' . $newName; // Simpan path relatif
                log_message('debug', 'Logo name: ' . $logoUrl);
            }

            // Simpan data mitra ke tabel m_mitra
            $mitraData = [
                'id_user' => $idUser,
                'alamat' => $data['alamat'],
                'berdiri_sejak' => $data['berdiri_sejak'],
                'deskripsi' => $data['deskripsi'],
                'logo' => $logoUrl,
                'history_show' => $data['history_show'],
                'prestasi' => $data['prestasi'],
                'approval_status' => 'pending', // Default approval status
                'tgl_approved' => null,
                'alasan' => null,
            ];

            if (!$this->mitraModel->save($mitraData)) {
                session()->setFlashdata('error', 'Gagal menyimpan data pengguna. Silakan coba lagi.');
                return redirect()->back()->withInput();
            }

            log_message('debug', 'Form data: ' . json_encode($data));

            $idMitra = $this->mitraModel->getInsertID();
            if (!$idMitra) {
                session()->setFlashdata('error', 'Gagal mendapatkan ID mitra.');
                return redirect()->back()->withInput();
            }

            //Proses media sosial
            $hiddenAccounts = $this->request->getPost('hidden_accounts');
            log_message('debug', 'Hidden Accounts Data: ' . print_r($hiddenAccounts, true));

            if (empty($hiddenAccounts)) {
                log_message('error', 'Hidden Accounts Kosong.');
                return redirect()->back()->withInput()->with('error', 'Harap tambahkan setidaknya satu akun media sosial.');
            }

            log_message('debug', 'Raw hidden_accounts from request: ' . print_r($hiddenAccounts, true));

            // Decode the JSON safely
            $accountsData = json_decode($hiddenAccounts, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'JSON Decoding Error: ' . json_last_error_msg());
                return redirect()->back()->withInput()->with('error', 'Data media sosial tidak valid.');
            }

            log_message('debug', 'Hidden Accounts (Decoded): ' . print_r($accountsData, true));

            if (!is_array($accountsData) || empty($accountsData)) {
                log_message('error', 'Decoded Hidden Accounts is not an array or empty.');
                return redirect()->back()->withInput()->with('error', 'Harap isi setidaknya satu akun media sosial.');
            }

            $dataSosmed = [];
            foreach ($accountsData as $index => $account) {

                // Periksa key "account" di data JSON
                if (
                    !isset($account['platformId']) || trim($account['platformId']) === '' ||
                    !isset($account['account']) || trim($account['account']) === ''
                ) {
                    session()->setFlashdata('error', "Platform atau nama akun pada entri ke-" . ($index + 1) . " tidak boleh kosong.");
                    return redirect()->back();
                }

                $accountName = trim($account['account']);
                log_message('debug', 'Account Name Length: ' . strlen($accountName));
                if (strlen($accountName) > 50) {
                    return redirect()->back()->withInput()->with('error', "Nama akun pada entri ke-" . ($index + 1) . " melebihi 50 karakter.");
                }

                log_message('debug', "Processing platformId: {$account['platformId']}, account: {$accountName}");

                $dataSosmed[] = [
                    'id_mitra' => $idMitra,
                    'id_platform_sosmed' => (int) $account['platformId'],
                    'acc_mitra' => $accountName,
                ];
            }

            var_dump($dataSosmed, 'id_platform_sosmed');

            $platformIds = array_column($dataSosmed, 'id_platform_sosmed');
            $validPlatforms = db_connect()->table('m_platform_sosmed')
                ->select('id_platform_sosmed')
                ->get()
                ->getResultArray();

            $validPlatformIds = array_column($validPlatforms, 'id_platform_sosmed');

            // Filter hanya yang memiliki id_platform_sosmed valid
            $dataSosmed = array_filter($dataSosmed, function ($entry) use ($validPlatformIds) {
                return in_array($entry['id_platform_sosmed'], $validPlatformIds);
            });

            if (empty($dataSosmed)) {
                return redirect()->back()->withInput()->with('error', 'Platform media sosial tidak valid.');
            }

            log_message('debug', 'Final Data to Insert: ' . print_r($dataSosmed, true));

            if (!empty($dataSosmed) && !$this->mitraSosmedModel->insertBatch($dataSosmed)) {
                session()->setFlashdata('error', 'Gagal menyimpan data media sosial.');
                return redirect()->back()->withInput();
            }

            log_message('debug', 'All POST Data: ' . print_r($this->request->getPost(), true));

            session()->setFlashdata('success', 'Registrasi berhasil! Silakan cek email untuk verifikasi.');
            return redirect()->to(base_url('Audiens/confirmation')); // Arahkan ke halaman konfirmasi
        }

        return view('templates/headerRegist') .
            view('templates/bodyRegistMitra');
    }

    public function homepageAfterLogin()
    {
        // Ambil data user dari session (misal data user disimpan di session setelah login)
        $userId = session()->get('id_user'); // Misalnya user_id disimpan di session setelah login
        $user = $this->userModel->find($userId); // Ambil data user berdasarkan user_id

        // Kirim data user ke view
        return view('templates/headerMitra', ['title' => 'Homepage Theaterform', 'user' => $user]) .
            view('templates/bodyHomepageMitra') .
            view('templates/footer');
    }

    public function penampilan()
    {
        // Ambil data user dari session (misal data user disimpan di session setelah login)
        $userId = session()->get('id_user'); // Misalnya user_id disimpan di session setelah login
        $user = $this->userModel->find($userId); // Ambil data user berdasarkan user_id

        return view('templates/headerAdminHomepage', ['user' => $user]) .
            view('templates/bodyPenampilanAdmin') .
            view('templates/footerPenampilanAdmin');
    }

    public function audisi()
    {
        // Ambil data user dari session (misal data user disimpan di session setelah login)
        $userId = session()->get('id_user'); // Misalnya user_id disimpan di session setelah login
        $user = $this->userModel->find($userId); // Ambil data user berdasarkan user_id

        return view('templates/headerAdminHomepage', ['user' => $user]) .
            view('templates/bodyAudisiAdmin') .
            view('templates/footerPenampilanAdmin');
    }

    public function cekStatusView()
    {
        return view('templates/headerUser', ['title' => 'Cek Status Akun Mitra Teater']) .
            view('templates/cekStatus') .
            view('templates/footer');
    }

    public function cekStatus()
    {
        $email = $this->request->getPost('email');

        if (!$email) {
            return redirect()->to(base_url('MitraTeater/cekStatusView'))
                ->with('error', 'Silakan masukkan email.');
        }

        $mitra = $this->mitraModel
            ->select('m_mitra.approval_status, m_mitra.alasan')
            ->join('m_user', 'm_user.id_user = m_mitra.id_user')
            ->where('m_user.email', $email)
            ->where('m_user.id_role', 2)
            ->first();

        if ($mitra) {
            $message = match ($mitra['approval_status']) {
                'approved' => 'Akun Anda telah disetujui!',
                'rejected' => 'Akun Anda ditolak. Alasan: ' . $mitra['alasan'],
                default => 'Akun Anda masih dalam proses verifikasi.',
            };

            $alertClass = match ($mitra['approval_status']) {
                'approved' => 'alert-success',
                'rejected' => 'alert-danger',
                default => 'alert-warning',
            };

            return redirect()->to(base_url('MitraTeater/cekStatusView'))
                ->with('status', $message)
                ->with('class', $alertClass);
        }

        return redirect()->to(base_url('MitraTeater/cekStatusView'))
            ->with('error', 'Email tidak ditemukan atau bukan akun mitra.');
    }

    public function profile() {
        $userId = session()->get('id_user');
        $user = $this->userModel->find($userId);

        return  view('templates/headerMitra', ['title' => 'Homepage Theaterform', 'user' => $user]) .
                view('templates/profileUser', ['user' => $user]);
    }
}

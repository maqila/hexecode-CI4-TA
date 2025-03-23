<!DOCTYPE html>
<html lang="en">

<body>
    <div class="list-audisi">
        <div class="container">
            <div class="header-actions">
                <div class="title">List Audisi Teater</div>

                <!-- Search and Filter -->
                <div class="search-filter">
                    <select class="form-select w-25" id="searchCategory">
                        <option value="" selected disabled>Cari berdasarkan</option>
                        <option value="kategori">Cari berdasarkan Kategori Audisi</option>
                        <option value="tanggal">Cari berdasarkan Tanggal</option>
                        <option value="waktu">Cari berdasarkan Waktu</option>
                        <option value="kota">Cari berdasarkan Kota</option>
                        <option value="harga">Cari berdasarkan Rentang Harga</option>
                        <option value="gaji">Cari berdasarkan Rentang Gaji</option>
                    </select>

                    <!-- Input pencarian yang akan berubah sesuai pilihan -->
                    <div id="searchInputContainer">
                        <input type="text" class="form-control w-50" id="searchInput" placeholder="Cari...">
                    </div>
                    <button class="btn btn-primary" id="filterBtn">Cari</button>
                </div>

                <div class="add-audition-buttons">
                    <button class="btn btn-primary" id="addAuditionActorBtn">Tambah Audisi Aktor</button>
                    <button class="btn btn-primary" id="addAuditionStaffBtn">Tambah Audisi Staff</button>
                </div>
            </div>

            <!-- Audition 1 -->
            <div class="audition-item">
                <div class="poster">
                    <img src="<?= base_url('assets/images/poster/poster3.jpeg') ?>" alt="Poster Audisi">
                </div>
                <div class="audition-info">
                    <span class="badge badge-category">Aktor</span> <!-- atau 'Staff' -->

                    <h4>Perahu Kertas</h4>
                    <div class="details">
                        <p><span class="label">Komunitas/Perusahaan Teater:</span> Es lilin cilacap production</p>
                        <p><span class="label">Terbuka untuk karakter:</span> Usagi (The Rabbit)</p>
                        <p><span class="label">Deskripsi Karakter:</span> Bertampang polos, namun memiliki niat tersembunyi kepada Arisu. Berambut pendek, kebiasaan melompat-lompat, memiliki ekor pompom.</p>
                        <p><span class="label">Persyaratan Aktor:</span> Perempuan berusia 12 - 16 tahun dan konsisten terhadap perannya.</p>
                        <p><span class="label">Persyaratan Dokumen:</span> -</p>
                        <p><span class="label">Gaji Aktor:</span> Rp500,000,- untuk setiap penayangan teater.</p>
                        <p><span class="label">Sutradara:</span> Willy Santoso</p>
                        <p><span class="label">Penulis:</span> Windy Panduwara</p>
                        <p><span class="label">Staff:</span> Bagong Puripurna, Lulu Lunita, Cepri Tagor, Linda Putu.</p>
                        <p><span class="label">Komitmen:</span> Tidak boleh telat, bertahan hingga hari terakhir penayangan.</p>
                        <p><span class="label">Harga Tiket Audisi:</span> -</p>
                        <p><span class="label">Sinopsis: </span> Disebuah hutan, tinggallah bayi kera yang sangat cantik. Saat beranjak remaja, ia berjalan menuju desa manusia.</p>
                        <p><span class="label">Sosial Media:</span> Instagram @eslilincilacapproduction, Facebook 'Es Lilin Cilacap Production'</p>
                        <p><span class="label">Web:</span> www.nsi.com (Komunitas Teater Official)</p>
                    </div>

                    <!-- Tabel Jadwal Audisi -->
                    <div class="schedule-table">
                        <h5>Jadwal Audisi</h5>
                        <table>
                            <thead>
                                <tr>
                                    <th>Kota</th>
                                    <th>Tempat</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jakarta</td>
                                    <td>Aula Teater Garuda Krisna</td>
                                    <td>12 September 2024</td>
                                    <td>Sesi I 15:00 - 17:00 WIB</td>
                                </tr>
                                <tr>
                                    <td>Jakarta</td>
                                    <td>Aula Teater Garuda Krisna</td>
                                    <td>12 September 2024</td>
                                    <td>Sesi II 19:00 - 21:00 WIB</td>
                                </tr>
                                <tr>
                                    <td>Bandung</td>
                                    <td>Teater Budaya</td>
                                    <td>13 September 2024</td>
                                    <td>16:00 - 18:00 WIB</td>
                                </tr>
                                <tr>
                                    <td>Bandung</td>
                                    <td>Teater Budaya</td>
                                    <td>14 September 2024</td>
                                    <td>19:30 - 21:30 WIB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="actions">
                    <button id="editBtn1" class="editBtnAktor">Edit Audisi</button>
                    <button>Hapus Audisi</button>
                    <button><i class="fas fa-eye"></i> 15 Tiket Terjual</button>
                </div>
            </div>

            <!-- Audition 2 -->
            <div class="audition-item">
                <div class="poster">
                    <img src="<?= base_url('assets/images/poster/poster4.jpeg') ?>" alt="Poster Audisi">
                </div>
                <div class="audition-info">
                    <span class="badge badge-category">Staff</span> <!-- atau 'Staff' -->

                    <h4>Perahu Kertas</h4>
                    <div class="details">
                        <p><span class="label">Komunitas/Perusahaan Teater:</span> Es lilin cilacap production</p>
                        <p><span class="label">Jenis Staff:</span> Tata Lampu</p>
                        <p><span class="label">Deskripsi Pekerjaan:</span> Mengatur Lightning.</p>
                        <p><span class="label">Persyaratan Staff:</span> Perempuan berusia 12 - 16 tahun dan konsisten terhadap perannya.</p>
                        <p><span class="label">Persyaratan Dokumen:</span> -</p>
                        <p><span class="label">Gaji Staff:</span> Rp500,000,- untuk setiap penayangan teater.</p>
                        <p><span class="label">Sutradara:</span> Willy Santoso</p>
                        <p><span class="label">Penulis:</span> Windy Panduwara</p>
                        <p><span class="label">Staff:</span> Bagong Puripurna, Lulu Lunita, Cepri Tagor, Linda Putu.</p>
                        <p><span class="label">Komitmen:</span> Tidak boleh telat, bertahan hingga hari terakhir penayangan.</p>
                        <p><span class="label">Harga Tiket Audisi:</span> -</p>
                        <p><span class="label">Sinopsis: </span> Disebuah hutan, tinggallah bayi kera yang sangat cantik. Saat beranjak remaja, ia berjalan menuju desa manusia.</p>
                        <p><span class="label">Sosial Media:</span> Instagram @eslilincilacapproduction, Facebook 'Es Lilin Cilacap Production'</p>
                        <p><span class="label">Web:</span> www.nsi.com (Komunitas Teater Official)</p>
                    </div>

                    <!-- Tabel Jadwal Audisi -->
                    <div class="schedule-table">
                        <h5>Jadwal Audisi</h5>
                        <table>
                            <thead>
                                <tr>
                                    <th>Kota</th>
                                    <th>Tempat</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jakarta</td>
                                    <td>Aula Teater Garuda Krisna</td>
                                    <td>12 September 2024</td>
                                    <td>Sesi I 15:00 - 17:00 WIB</td>
                                </tr>
                                <tr>
                                    <td>Jakarta</td>
                                    <td>Aula Teater Garuda Krisna</td>
                                    <td>12 September 2024</td>
                                    <td>Sesi II 19:00 - 21:00 WIB</td>
                                </tr>
                                <tr>
                                    <td>Bandung</td>
                                    <td>Teater Budaya</td>
                                    <td>13 September 2024</td>
                                    <td>16:00 - 18:00 WIB</td>
                                </tr>
                                <tr>
                                    <td>Bandung</td>
                                    <td>Teater Budaya</td>
                                    <td>14 September 2024</td>
                                    <td>19:30 - 21:30 WIB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="actions">
                    <button id="editBtn1" class="editBtnStaff">Edit Audisi</button>
                    <button>Hapus Audisi</button>
                    <button><i class="fas fa-eye"></i> 20 Tiket Terjual</button>
                </div>
            </div>

            <div class="audition-count">2 Shows</div>
        </div>

        <!-- Popup Form -->
        <div id="auditionPopupAktor" class="popup">
            <div class="popup-content">
                <h3 id="popupTitleAktor">Tambah Audisi Aktor</h3>
                <form id="auditionFormAktor" class="" action="<?= base_url('Admin/saveAuditionAktor') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="popup-body">
                        <input type="hidden" name="tipe_teater" id="tipe_teater" value="audisi">
                        <input type="hidden" name="id_kategori" id="id_kategori" value="1">
                        <!-- Left Side (Form Fields) -->
                        <div class="popup-left">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul pertunjukan yang diaudisi" required>
                            </div>
                            <div class="form-group">
                                <label for="poster">Poster Audisi</label>
                                <input type="file" name="poster" id="poster" class="form-control" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="sinopsis">Sinopsis</label>
                                <textarea id="sinopsis" name="sinopsis" class="form-control" placeholder="Masukkan sinopsis pertunjukan yang diaudisikan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="karakter_audisi">Karakter yang diaudisikan</label>
                                <input type="text" name="karakter_audisi" id="karakter_audisi" class="form-control" placeholder="Masukkan nama karakter" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_karakter">Deskripsi Karakter</label>
                                <textarea id="deskripsi_karakter" name="deskripsi_karakter" class="form-control" placeholder="Masukkan deskripsi karakter yang diaudisikan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="form-label">Jadwal Audisi</label>
                                <div id="schedule-audition-input">
                                    <div class="schedule-audition">
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Masukkan Tanggal Audisi" required>
                                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" placeholder="Masukkan Waktu Audisi" required>
                                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" placeholder="Masukkan Waktu Audisi" required>

                                        <!-- Pilihan Harga -->
                                        <select name="tipe_harga" id="tipe_harga" class="form-control" required>
                                            <option selected disabled>Harga tiket</option>
                                            <option value="Bayar">Bayar</option>
                                            <option value="Gratis">Gratis</option>
                                        </select>

                                        <!-- Toggle Harga (Muncul saat pilih "Bayar") -->
                                        <div id="nominal-harga" style="display:none;">
                                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan harga">
                                        </div>

                                        <!-- <select name="kota[]" id="kota-select" class="form-control" required onchange="toggleLainnya(this)"> -->
                                        <select name="kota[]" id="kota-select" class="form-control" required>
                                            <option selected disabled>Pilih Kota</option>
                                            <option value="Jakarta">Jakarta</option>
                                            <option value="Bogor">Bogor</option>
                                            <option value="Depok">Depok</option>
                                            <option value="Tangerang">Tangerang</option>
                                            <option value="Bekasi">Bekasi</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>

                                        <!-- Input kota tambahan -->
                                        <div id="lainnya-container" style="display: none;">
                                            <!-- <input type="text" name="kota[]" id="kota-input" placeholder="Masukkan kota" class="form-control" oninput="updateKotaValue(this)"> -->
                                            <input type="text" name="kota[]" id="kota-input" placeholder="Masukkan kota" class="form-control">
                                        </div>

                                        <input type="hidden" id="hidden-kota" name="kota_real" />

                                        <textarea name="tempat" id="tempat" class="form-control" placeholder="Masukkan alamat tempat pertunjukan" required></textarea>
                                    </div>
                                    <button type="button" id="addSchedule">Tambah Jadwal Pertunjukan</button>
                                </div>
                                <div id="draft-schedule"></div>
                                <input type="hidden" name="hidden_schedule" value="">
                            </div>
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" id="penulis" name="penulis" class="form-control" placeholder="Masukkan nama penulis" required>
                            </div>
                        </div>

                        <!-- Right Side (Form Fields) -->
                        <div class="popup-right">
                            <div class="form-group">
                                <label for="url_pendaftaran">URL Pendaftaran</label>
                                <input type="text" name="url_pendaftaran" id="url_pendaftaran" class="form-control" placeholder="Masukkan url web">
                            </div>
                            <div class="form-group">
                                <label for="syarat">Persyaratan aktor</label>
                                <textarea id="syarat" name="syarat" class="form-control" placeholder="Masukkan persyaratan aktor" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="syarat_dokumen">Persyaratan dokumen</label>
                                <textarea id="syarat_dokumen" name="syarat_dokumen" class="form-control" placeholder="Masukkan persyaratan dokumen"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="sutradara">Sutradara</label>
                                <input type="text" name="sutradara" id="sutradara" class="form-control" placeholder="Masukkan nama sutradara" required>
                            </div>
                            <div class="form-group">
                                <label for="staff">Staff</label>
                                <input type="text" name="staff" id="staff" class="form-control" placeholder="Masukkan nama staff">
                            </div>
                            <div class="form-group">
                                <label for="gaji">Gaji Aktor</label>
                                <input type="number" name="gaji" id="gaji" class="form-control" placeholder="Masukkan gaji aktor" required>
                            </div>
                            <div class="form-group">
                                <label for="komitmen">Komitmen sebagai Aktor</label>
                                <textarea name="komitmen" id="komitmen" class="form-control" placeholder="Masukkan komitmen aktor"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="mitra_teater_aktor">Pilih Mitra Teater</label>
                                <select id="mitra_teater_aktor" name="mitra_teater" class="form-control" required>
                                    <option value="" selected disabled>Pilih Mitra Teater</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_platform_sosmed[]" class="form-label">Sosial Media Teater</label>
                                <div>
                                    <!-- <input type="checkbox" id="same-sosmed" onchange="copySosmed()"> Sama dengan sosial media komunitas -->
                                    <input type="checkbox" id="same-sosmed"> Sama dengan sosial media komunitas
                                </div>
                                <div id="social-media-input">
                                    <div class="social-media-mitra">
                                        <select name="id_platform_sosmed[]" id="platform_name" class="form-control" aria-label="Platform">
                                            <option value="" selected disabled>Choose Platform</option>
                                            <option value="1" data-nama="instagram">Instagram</option>
                                            <option value="2" data-nama="twitter">Twitter</option>
                                            <option value="3" data-nama="facebook">Facebook</option>
                                            <option value="4" data-nama="threads">Threads</option>
                                            <option value="5" data-nama="tiktok">Tiktok</option>
                                            <option value="7" data-nama="telegram">Telegram</option>
                                            <option value="8" data-nama="discord">Discord</option>
                                            <option value="10" data-nama="line">LINE</option>
                                            <option value="9" data-nama="whatsapp">Whatsapp</option>
                                            <option value="6" data-nama="youtube">Youtube</option>
                                        </select>

                                        <input type="text" name="acc_name[]" id="acc_name" class="form-control" placeholder="Enter your account name">
                                        <?= !empty(\Config\Services::validation()->getError('acc_name')) ? \Config\Services::validation()->getError('acc_name') : \Config\Services::validation()->getError('hidden_accounts') ?>
                                    </div>
                                    <button id="add-account-btn" type="button" class="btn btn-danger add-item">Add Another Account</button>
                                </div>
                                <div id="draft-accounts"></div>
                                <input type="hidden" name="hidden_accounts" id="hidden_accounts" value="[]">
                            </div>
                            <div class="form-group">
                                <label for="judul_web[]" class="form-label">Website Teater</label>
                                <div id="website-input">
                                    <div class="website-teater">
                                        <input type="text" name="judul_web[]" id="judul_web" class="form-control" placeholder="Masukkan judul web">
                                        <input type="text" name="url_web[]" id="url_web" class="form-control" placeholder="Masukkan url web">
                                    </div>
                                    <button id="add-web-btn" type="button" class="btn btn-danger add-item">Tambah Website</button>
                                </div>
                                <div id="draft-web"></div>
                                <input type="hidden" name="hidden_web" value="">
                            </div>
                        </div>
                    </div>

                    <div class="popup-footer">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" id="cancelBtnAktor" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="auditionPopupStaff" class="popup">
            <div class="popup-content">
                <h3 id="popupTitleStaff">Tambah Audisi Staff</h3>
                <form id="auditionFormStaff" action="<?= base_url('Admin/saveAuditionStaff') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="popup-body">
                        <input type="hidden" name="tipe_teater" id="tipe_teater_staff" value="audisi">
                        <input type="hidden" name="id_kategori" id="id_kategori_staff" value="2">


                        <!-- ✅ LEFT SIDE -->
                        <div class="popup-left">
                            <div class="form-group">
                                <label for="judul_staff">Judul</label>
                                <input type="text" id="judul_staff" class="form-control" name="judul" placeholder="Masukkan judul" required>
                            </div>

                            <div class="form-group">
                                <label for="poster_staff">Poster Audisi</label>
                                <input type="file" id="poster_staff" class="form-control" name="poster" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <label for="sinopsis_staff">Sinopsis</label>
                                <textarea id="sinopsis_staff" name="sinopsis" class="form-control" placeholder="Masukkan sinopsis"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="jenis_staff">Staff yang diaudisikan</label>
                                <input type="text" id="jenis_staff" class="form-control" name="jenis_staff" placeholder="Contoh: Tata Lampu" required>
                            </div>

                            <div class="form-group">
                                <label for="jobdesc_staff">Deskripsi Pekerjaan Staff</label>
                                <textarea id="jobdesc_staff" name="jobdesc_staff" class="form-control" placeholder="Deskripsi pekerjaan staff"></textarea>
                            </div>

                            <!-- ✅ Jadwal -->
                            <div class="form-group">
                                <label for="jadwal_staff">Jadwal Audisi</label>
                                <div id="schedule-audition-input-staff">
                                    <div class="schedule-audition">
                                        <input type="date" name="tanggal_staff" id="tanggal_staff" class="form-control" required>
                                        <input type="time" name="waktu_mulai_staff" id="waktu_mulai_staff" class="form-control" required>

                                        <select name="tipe_harga_staff" id="tipe_harga_staff" class="form-control" required>
                                            <option selected disabled>Harga tiket</option>
                                            <option value="Bayar">Bayar</option>
                                            <option value="Gratis">Gratis</option>
                                        </select>

                                        <div id="nominal-harga-staff" style="display:none;">
                                            <input type="number" name="harga_staff" id="harga_staff" class="form-control" placeholder="Masukkan harga">
                                        </div>

                                        <select name="kota_staff[]" id="kota-select-staff" class="form-control" required>
                                            <option selected disabled>Pilih Kota</option>
                                            <option value="Jakarta">Jakarta</option>
                                            <option value="Bogor">Bogor</option>
                                            <option value="Depok">Depok</option>
                                            <option value="Tangerang">Tangerang</option>
                                            <option value="Bekasi">Bekasi</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>

                                        <div id="lainnya-container-staff" style="display: none;">
                                            <input type="text" name="kota_staff[]" id="kota-input-staff" placeholder="Masukkan kota lainnya" class="form-control">
                                        </div>

                                        <input type="hidden" id="hidden-kota-staff" name="kota_real_staff" />

                                        <textarea name="tempat_staff" id="tempat_staff" class="form-control" placeholder="Alamat tempat pertunjukan" required></textarea>
                                    </div>
                                    <button type="button" id="addScheduleStaff">Tambah Jadwal</button>
                                </div>
                                <div id="draft-schedule-staff"></div>
                                <input type="hidden" name="hidden_schedule_staff" value="">
                            </div>

                            <div class="form-group">
                                <label for="penulis_staff">Penulis</label>
                                <input type="text" id="penulis_staff" name="penulis" class="form-control" placeholder="Nama penulis" required>
                            </div>
                        </div>

                        <!-- ✅ RIGHT SIDE -->
                        <div class="popup-right">
                            <div class="form-group">
                                <label for="url_pendaftaran_staff">URL Pendaftaran</label>
                                <input type="text" name="url_pendaftaran" id="url_pendaftaran_staff" class="form-control" placeholder="Masukkan URL">
                            </div>

                            <div class="form-group">
                                <label for="syarat_staff">Persyaratan Staff</label>
                                <textarea id="syarat_staff" name="syarat" class="form-control" placeholder="Persyaratan" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="syarat_dokumen_staff">Persyaratan Dokumen</label>
                                <textarea id="syarat_dokumen_staff" name="syarat_dokumen" class="form-control" placeholder="Persyaratan dokumen"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="sutradara_staff">Sutradara</label>
                                <input type="text" id="sutradara_staff" name="sutradara" class="form-control" placeholder="Nama sutradara" required>
                            </div>

                            <div class="form-group">
                                <label for="staff_name_staff">Nama Staff</label>
                                <input type="text" id="staff_name_staff" name="staff" class="form-control" placeholder="Nama staff">
                            </div>

                            <div class="form-group">
                                <label for="gaji_staff">Gaji Staff</label>
                                <input type="number" id="gaji_staff" name="gaji_staff" class="form-control" placeholder="Masukkan gaji" required>
                            </div>

                            <div class="form-group">
                                <label for="komitmen_staff">Komitmen</label>
                                <textarea id="komitmen_staff" name="komitmen_staff" class="form-control" placeholder="Komitmen staff"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="mitra_teater_staff">Mitra Teater</label>
                                <select id="mitra_teater_staff" name="mitra_teater_staff" class="form-control" required>
                                    <option value="" selected disabled>Pilih Mitra Teater</option>
                                </select>
                            </div>

                            <!-- ✅ Sosial Media -->
                            <div class="form-group">
                                <label>Sosial Media Teater</label>
                                <div>
                                    <input type="checkbox" id="same-sosmed-staff"> Sama dengan sosial media komunitas
                                </div>
                                <div id="social-media-input-staff">
                                    <div class="social-media-mitra">
                                        <select name="id_platform_sosmed_staff[]" class="form-control">
                                            <option value="" selected disabled>Choose Platform</option>
                                            <option value="1">Instagram</option>
                                            <option value="2">Twitter</option>
                                            <option value="3">Facebook</option>
                                            <option value="4">Threads</option>
                                            <option value="5">Tiktok</option>
                                            <option value="6">Youtube</option>
                                            <option value="7">Telegram</option>
                                            <option value="8">Discord</option>
                                            <option value="9">Whatsapp</option>
                                            <option value="10">LINE</option>
                                        </select>

                                        <input type="text" name="acc_name_staff[]" class="form-control" placeholder="Nama akun">
                                    </div>
                                    <button id="add-account-btn-staff" type="button" class="btn btn-danger add-item">Add Another Account</button>
                                </div>
                                <div id="draft-accounts-staff"></div>
                                <input type="hidden" name="hidden_accounts_staff" id="hidden_accounts_staff" value="[]">
                            </div>

                            <!-- ✅ Website -->
                            <div class="form-group">
                                <label>Website Teater</label>
                                <div id="website-input-staff">
                                    <div class="website-teater">
                                        <input type="text" name="judul_web_staff[]" id="judul_web_staff" class="form-control" placeholder="Judul web">
                                        <input type="text" name="url_web_staff[]" id="url_web_staff" class="form-control" placeholder="URL web">
                                    </div>
                                    <button id="add-web-btn-staff" type="button" class="btn btn-danger add-item">Tambah Website</button>
                                </div>
                                <div id="draft-web-staff"></div>
                                <input type="hidden" name="hidden_web_staff" id="hidden_web_staff" value="">
                            </div>
                        </div>
                    </div>

                    <!-- ✅ Footer -->
                    <div class="popup-footer">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" id="cancelBtnStaff" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
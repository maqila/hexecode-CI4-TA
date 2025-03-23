<!DOCTYPE html>
<html lang="en">

<body>
    <div class="list-penampilan">

        <div class="container">
            <div class="header-actions">
                <div class="title">List Pertunjukan Teater</div>

                <!-- Search and Filter -->
                <div class="search-filter">
                    <select class="form-select w-25" id="searchCategory">
                        <option value="" selected disabled>Cari berdasarkan</option>
                        <option value="tanggal">Cari berdasarkan Tanggal</option>
                        <option value="waktu">Cari berdasarkan Waktu</option>
                        <option value="kota">Cari berdasarkan Kota</option>
                        <option value="harga">Cari berdasarkan Rentang Harga</option>
                        <option value="durasi">Cari berdasarkan Rentang Durasi</option>
                        <option value="rating">Cari berdasarkan Rating Umur</option>
                    </select>

                    <!-- Input pencarian yang akan berubah sesuai pilihan -->
                    <div id="searchInputContainer">
                        <input type="text" class="form-control w-50" id="searchInput" placeholder="Cari...">
                    </div>
                    <button class="btn btn-primary" id="filterBtn">Cari</button>
                </div>
                <button class="btn btn-primary" id="addShowBtn">Tambah Pertunjukan</button>
            </div>

            <!-- Test Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Poster</th>
                        <th>Sutradara</th>
                        <th>Penulis</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teaterPenampilan as $show) : ?>
                    <tr>
                        <td><?= $show['judul']; ?></td>
                        <td><img src="<?= base_url('assets/' . $show['poster']); ?>" alt="Poster" style="width: 50px;">
                        </td>
                        <td><?= $show['sutradara']; ?></td>
                        <td><?= $show['penulis']; ?></td>
                        <td>
                            <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-warning btn-sm">Edit</button> -->
                            <button type="button" id="editBtn1" class="btn btn-warning btn-sm editBtn"
                                data-id="<?= $show['id_teater']; ?>">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                            <button class="btn btn-primary btn-sm">View User</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <!-- Show 1 -->
            <div class=" show-item">
                <div class="poster">
                    <img src="<?= base_url('assets/images/poster/poster1.jpg') ?>" alt="Poster Pertunjukan">
                </div>
                <div class="show-info">
                    <h4>Perahu Kertas</h4>
                    <div class="details">
                        <p><span class="label">Komunitas/Perusahaan Teater:</span> Es lilin cilacap production</p>
                        <p><span class="label">Aktor:</span> Jaya Wijaya, Lilith Purnawarman, Toni Jojoni</p>
                        <p><span class="label">Sutradara:</span> Willy Santoso</p>
                        <p><span class="label">Penulis:</span> Windy Panduwara</p>
                        <p><span class="label">Staff:</span> Bagong Puripurna, Lulu Lunita, Cepri Tagor, Linda Putu.</p>
                        <p><span class="label">Durasi:</span> 120 menit</p>
                        <p><span class="label">Rating Umur:</span> Semua Umur (SU)</p>
                        <p><span class="label">Sinopsis: </span> Disebuah hutan, tinggallah bayi kera yang sangat
                            cantik. Saat beranjak remaja, ia berjalan menuju desa manusia.</p>
                        <p><span class="label">Sosial Media:</span> Instagram @eslilincilacapproduction, Facebook 'Es
                            Lilin Cilacap Production'</p>
                        <p><span class="label">Web:</span> www.nsi.com (Komunitas Teater Official)</p>
                    </div>

                    <!-- Tabel Jadwal Pertunjukan -->
                    <div class="schedule-table">
                        <h5 style="color: red;">Jadwal Pertunjukan</h5>
                        <?php $addedHarga = []; // Reset setiap kali tabel Jadwal Pertunjukan dimulai 
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Kota</th>
                                    <th>Tempat</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Harga</th>
                                    <th>Denah Seat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($groupedSchedule as $kota => $tempatList) : ?>
                                <?php $firstKota = true; ?>
                                <?php foreach ($tempatList as $tempat => $tanggalList) : ?>
                                <?php $firstTempat = true; ?>
                                <?php foreach ($tanggalList as $tanggal => $waktuList) : ?>
                                <tr>
                                    <?php if ($firstKota) : ?>
                                    <td rowspan="<?= array_sum(array_map('count', $tempatList)); ?>"><?= $kota; ?></td>
                                    <?php $firstKota = false; ?>
                                    <?php endif; ?>
                                    <?php if ($firstTempat) : ?>
                                    <td rowspan="<?= count($tanggalList); ?>"><?= $tempat; ?></td>
                                    <?php $firstTempat = false; ?>
                                    <?php endif; ?>
                                    <td><?= date('d F Y', strtotime($tanggal)); ?></td>
                                    <td><?= nl2br(implode("\n", $waktuList)); ?></td>
                                    <?php if (!isset($addedHarga[$tempat])) : ?>
                                    <td rowspan="<?= count($tanggalList); ?>">
                                        <?= nl2br(str_replace(', ', "\n", $placeInfo[$tempat]['harga'])); ?></td>
                                    <td rowspan="<?= count($tanggalList); ?>">
                                        <a href="#" class="openSeatMap"
                                            data-image="<?= base_url('assets/images/' . $placeInfo[$tempat]['denah']); ?>">Lihat
                                            Denah</a>
                                    </td>
                                    <?php $addedHarga[$tempat] = true; ?>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="actions">
                    <button id="editBtn1" class="editBtn">Edit Pertunjukan</button>
                    <button>Hapus Pertunjukan</button>
                    <button><i class="fas fa-eye"></i> 15 Tiket Terjual</button>
                </div>
            </div>

            <!-- Show 2 -->
            <div class="show-item">
                <div class="poster">
                    <img src="<?= base_url('assets/images/poster/poster2.jpeg') ?>" alt="Poster Pertunjukan">
                </div>
                <div class="show-info">
                    <h4>Liliput dalam Tulip</h4>
                    <div class="details">
                        <p><span class="label">Komunitas/Perusahaan Teater:</span> Xilacap production</p>
                        <p><span class="label">Aktor:</span> Jaya Wijaya, Lilith Purnawarman, Toni Jojoni</p>
                        <p><span class="label">Sutradara:</span> Willy Santoso</p>
                        <p><span class="label">Penulis:</span> Windy Panduwara</p>
                        <p><span class="label">Staff:</span> Bagong Puripurna, Lulu Lunita, Cepri Tagor, Linda Putu.</p>
                        <p><span class="label">Durasi:</span> 120 menit</p>
                        <p><span class="label">Rating Umur:</span> Semua Umur (SU)</p>
                        <p><span class="label">Sinopsis: </span> Disebuah hutan, tinggallah bayi kera yang sangat
                            cantik. Saat beranjak remaja, ia berjalan menuju desa manusia.</p>
                        <p><span class="label">Sosial Media:</span> Instagram @eslilincilacapproduction, Facebook 'Es
                            Lilin Cilacap Production'</p>
                        <p><span class="label">Web:</span> www.nsi.com (Komunitas Teater Official),
                            www.liliputdalamtulip.com (Teater Official)</p>
                    </div>

                    <!-- Tabel Jadwal Pertunjukan -->
                    <div class="schedule-table">
                        <h5 style="color: red;">Jadwal Pertunjukan</h5>
                        <?php $addedHarga = []; // Reset setiap kali tabel Jadwal Pertunjukan dimulai 
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Kota</th>
                                    <th>Tempat</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Harga</th>
                                    <th>Denah Seat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($groupedSchedule as $kota => $tempatList) : ?>
                                <?php $firstKota = true; ?>
                                <?php foreach ($tempatList as $tempat => $tanggalList) : ?>
                                <?php $firstTempat = true; ?>
                                <?php foreach ($tanggalList as $tanggal => $waktuList) : ?>
                                <tr>
                                    <?php if ($firstKota) : ?>
                                    <td rowspan="<?= array_sum(array_map('count', $tempatList)); ?>"><?= $kota; ?></td>
                                    <?php $firstKota = false; ?>
                                    <?php endif; ?>
                                    <?php if ($firstTempat) : ?>
                                    <td rowspan="<?= count($tanggalList); ?>"><?= $tempat; ?></td>
                                    <?php $firstTempat = false; ?>
                                    <?php endif; ?>
                                    <td><?= date('d F Y', strtotime($tanggal)); ?></td>
                                    <td><?= nl2br(implode("\n", $waktuList)); ?></td>
                                    <?php if (!isset($addedHarga[$tempat])) : ?>
                                    <td rowspan="<?= count($tanggalList); ?>">
                                        <?= nl2br(str_replace(', ', "\n", $placeInfo[$tempat]['harga'])); ?></td>
                                    <td rowspan="<?= count($tanggalList); ?>">
                                        <a href="#" class="openSeatMap"
                                            data-image="<?= base_url('assets/images/' . $placeInfo[$tempat]['denah']); ?>">Lihat
                                            Denah</a>
                                    </td>
                                    <?php $addedHarga[$tempat] = true; ?>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="actions">
                    <button id="editBtn1" class="editBtn">Edit Pertunjukan</button>
                    <button>Hapus Pertunjukan</button>
                    <button><i class="fas fa-eye"></i> 20 Tiket Terjual</button>
                </div>
            </div>

            <div class="show-count">2 Shows</div>
        </div>

        <!-- Popup Denah Seat -->
        <div id="seatMapModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img id="seatMapImage" src="" alt="Denah Seat" style="width: 100%;">
            </div>
        </div>

        <!-- Popup Form -->
        <div id="showPopup" class="popup">
            <div class="popup-content">
                <h3 id="popupTitle">Tambah Pertunjukan</h3>
                <form id="showForm" method="post" action="<?= base_url('Admin/saveAuditionAdmin') ?>"
                    enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_teater" id="id_teater">
                    <div class="popup-body">
                        <input type="hidden" name="tipe_teater" id="tipe_teater" value="penampilan">
                        <!-- Left Side (Form Fields) -->
                        <div class="popup-left">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control"
                                    placeholder="Masukkan judul pertunjukan" required>
                            </div>
                            <div class="form-group">
                                <label for="poster">Poster Pertunjukan</label>
                                <input type="file" name="poster" id="poster" class="form-control" accept="image/*"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="sinopsis">Sinopsis</label>
                                <textarea name="sinopsis" id="sinopsis" class="form-control"
                                    placeholder="Masukkan sinopsis pertunjukan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="form-label">Jadwal Pertunjukan</label>
                                <div id="schedule-show-input">
                                    <div class="schedule-show">
                                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                                            placeholder="Masukkan Tanggal Pertunjukan" required>
                                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control"
                                            required>
                                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control"
                                            required>

                                        <!-- Pilihan Harga -->
                                        <select name="tipe_harga" id="tipe_harga" class="form-control" required>
                                            <option selected disabled>Harga tiket</option>
                                            <option value="Bayar">Bayar</option>
                                            <option value="Gratis">Gratis</option>
                                        </select>

                                        <!-- Toggle Harga (Muncul saat pilih "Bayar") -->
                                        <div id="nominal-harga" style="display:none;">
                                            <input type="text" name="harga" id="harga" class="form-control"
                                                placeholder="Masukkan harga">

                                            <!-- Checkbox untuk Atur Seat (Muncul di dalam toggle harga) -->
                                            <input type="checkbox" id="seat-option"> Atur berdasarkan seat teater

                                            <!-- Toggle Kategori Seat (Muncul jika checkbox dicentang) -->
                                            <div id="seat-config" style="display:none;">
                                                <input type="text" name="nama_kategori" id="nama_kategori"
                                                    class="form-control"
                                                    placeholder="Masukkan nama kategori seat (VIP, Premium, dll.)">
                                                <button type="button" id="addSeatCategory">Tambah Harga per
                                                    Kategori</button>

                                                <!-- Container untuk menampilkan draft kategori -->
                                                <div id="draft-seats"></div>

                                                <input type="file" name="denah_seat" id="denah_seat"
                                                    class="form-control" accept="image/*"
                                                    placeholder="Upload denah tempat duduk">
                                            </div>
                                        </div>

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
                                            <input type="text" name="kota[]" id="kota-input" placeholder="Masukkan kota"
                                                class="form-control">
                                        </div>

                                        <input type="hidden" id="hidden-kota" name="kota_real" />

                                        <textarea name="tempat" id="tempat" class="form-control"
                                            placeholder="Masukkan alamat tempat pertunjukan" required></textarea>
                                    </div>
                                    <button type="button" id="addSchedule">Tambah Jadwal Pertunjukan</button>
                                </div>
                                <div id="draft-schedule"></div>
                                <input type="hidden" name="hidden_schedule" value="">
                            </div>
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" name="penulis" id="penulis" class="form-control"
                                    placeholder="Masukkan nama penulis" required>
                            </div>
                        </div>

                        <!-- Right Side (Form Fields) -->
                        <div class="popup-right">
                            <div class="form-group">
                                <label for="url_pendaftaran">Url Pendaftaran</label>
                                <input type="text" name="url_pendaftaran" id="url_pendaftaran" class="form-control"
                                    placeholder="Masukkan url web">
                            </div>
                            <div class="form-group">
                                <label for="sutradara">Sutradara</label>
                                <input type="text" name="sutradara" id="sutradara" class="form-control"
                                    placeholder="Masukkan nama sutradara" required>
                            </div>
                            <div class="form-group">
                                <label for="staff">Staff</label>
                                <input type="text" name="staff" id="staff" class="form-control"
                                    placeholder="Masukkan nama staff" required>
                            </div>
                            <div class="form-group">
                                <label for="aktor">Aktor</label>
                                <input type="text" name="aktor" id="aktor" class="form-control"
                                    placeholder="Masukkan nama aktor" required>
                            </div>
                            <div class="form-group">
                                <label for="durasi">Durasi (menit)</label>
                                <input type="number" name="durasi" min="0" id="durasi" class="form-control"
                                    placeholder="Masukkan durasi pertunjukan" required>
                            </div>
                            <div class="form-group">
                                <label for="rating_umur[]">Rating Umur</label>
                                <select name="rating_umur[]" id="rating_umur" class="form-control" required>
                                    <option selected disabled>Pilih Rating Umur</option>
                                    <option>Semua Umur (SU)</option>
                                    <option>13+</option>
                                    <option>17+</option>
                                    <option>21+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mitra_teater">Pilih Mitra Teater</label>
                                <select id="mitra_teater" name="mitra_teater" class="form-control">
                                    <option value="" selected disabled>Pilih Mitra Teater</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_platform_sosmed[]" class="form-label">Sosial Media Teater</label>
                                <div>
                                    <input type="checkbox" id="same-sosmed"> Sama dengan sosial media komunitas
                                </div>
                                <div id="social-media-input">
                                    <div class="social-media-teater">
                                        <select name="id_platform_sosmed[]" id="platform_name" class="form-control"
                                            aria-label="Platform" required>
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

                                        <input type="text" name="acc_name[]" id="acc_name" class="form-control"
                                            placeholder="Enter your account name">
                                    </div>
                                    <button id="add-account-btn" type="button" class="btn btn-danger add-item">Add
                                        Another Account</button>
                                </div>
                                <div id="draft-accounts"></div>
                                <input type="hidden" name="hidden_accounts" value="">
                            </div>
                            <div class="form-group">
                                <label for="judul_web[]" class="form-label">Website Teater</label>
                                <div id="website-input">
                                    <div class="website-teater">
                                        <input type="text" name="judul_web[]" id="judul_web" class="form-control"
                                            placeholder="Masukkan judul web">
                                        <input type="text" name="url_web[]" id="url_web" class="form-control"
                                            placeholder="Masukkan url web">
                                    </div>
                                    <button id="add-web-btn" type="button" class="btn btn-danger add-item">Tambah
                                        Website</button>
                                </div>
                                <div id="draft-web"></div>
                                <input type="hidden" name="hidden_web" value="">
                            </div>
                        </div>
                    </div>
                    <div class="popup-footer">
                        <div class="button-group">
                            <button type="submit" id="submitBtn" class="btn btn-success">Simpan</button>
                            <button type="button" id="cancelBtn" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Popup Edit Form -->
        <div id="editPopup" class="popup">
            <div class="popup-content">
                <h3 id="popupTitle">Edit Pertunjukan</h3>
                <form id="editForm" method="post" action=""
                    enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_teater" id="id_teater">
                    <div class="popup-body">
                        <input type="hidden" name="tipe_teater" id="tipe_teater" value="penampilan">
                        <!-- Left Side (Form Fields) -->
                        <div class="popup-left">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control"
                                    placeholder="Masukkan judul pertunjukan" required>
                            </div>
                            <div class="form-group">
                                <label for="poster">Poster Pertunjukan</label>
                                <input type="file" name="poster" id="poster" class="form-control" accept="image/*"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="sinopsis">Sinopsis</label>
                                <textarea name="sinopsis" id="sinopsis" class="form-control"
                                    placeholder="Masukkan sinopsis pertunjukan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="form-label">Jadwal Pertunjukan</label>
                                <div id="schedule-show-input">
                                    <div class="schedule-show">
                                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                                            placeholder="Masukkan Tanggal Pertunjukan" required>
                                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control"
                                            required>
                                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control"
                                            required>

                                        <!-- Pilihan Harga -->
                                        <select name="tipe_harga" id="tipe_harga" class="form-control" required>
                                            <option selected disabled>Harga tiket</option>
                                            <option value="Bayar">Bayar</option>
                                            <option value="Gratis">Gratis</option>
                                        </select>

                                        <!-- Toggle Harga (Muncul saat pilih "Bayar") -->
                                        <div id="nominal-harga" style="display:none;">
                                            <input type="text" name="harga" id="harga" class="form-control"
                                                placeholder="Masukkan harga">

                                            <!-- Checkbox untuk Atur Seat (Muncul di dalam toggle harga) -->
                                            <input type="checkbox" id="seat-option"> Atur berdasarkan seat teater

                                            <!-- Toggle Kategori Seat (Muncul jika checkbox dicentang) -->
                                            <div id="seat-config" style="display:none;">
                                                <input type="text" name="nama_kategori" id="nama_kategori"
                                                    class="form-control"
                                                    placeholder="Masukkan nama kategori seat (VIP, Premium, dll.)">
                                                <button type="button" id="addSeatCategory">Tambah Harga per
                                                    Kategori</button>

                                                <!-- Container untuk menampilkan draft kategori -->
                                                <div id="draft-seats"></div>

                                                <input type="file" name="denah_seat" id="denah_seat"
                                                    class="form-control" accept="image/*"
                                                    placeholder="Upload denah tempat duduk">
                                            </div>
                                        </div>

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
                                            <input type="text" name="kota[]" id="kota-input" placeholder="Masukkan kota"
                                                class="form-control">
                                        </div>

                                        <input type="hidden" id="hidden-kota" name="kota_real" />

                                        <textarea name="tempat" id="tempat" class="form-control"
                                            placeholder="Masukkan alamat tempat pertunjukan" required></textarea>
                                    </div>
                                    <button type="button" id="addSchedule">Tambah Jadwal Pertunjukan</button>
                                </div>
                                <div id="draft-schedule"></div>
                                <input type="hidden" name="hidden_schedule" value="">
                            </div>
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" name="penulis" id="penulis" class="form-control"
                                    placeholder="Masukkan nama penulis" required>
                            </div>
                        </div>

                        <!-- Right Side (Form Fields) -->
                        <div class="popup-right">
                            <div class="form-group">
                                <label for="url_pendaftaran">Url Pendaftaran</label>
                                <input type="text" name="url_pendaftaran" id="url_pendaftaran" class="form-control"
                                    placeholder="Masukkan url web">
                            </div>
                            <div class="form-group">
                                <label for="sutradara">Sutradara</label>
                                <input type="text" name="sutradara" id="sutradara" class="form-control"
                                    placeholder="Masukkan nama sutradara" required>
                            </div>
                            <div class="form-group">
                                <label for="staff">Staff</label>
                                <input type="text" name="staff" id="staff" class="form-control"
                                    placeholder="Masukkan nama staff" required>
                            </div>
                            <div class="form-group">
                                <label for="aktor">Aktor</label>
                                <input type="text" name="aktor" id="aktor" class="form-control"
                                    placeholder="Masukkan nama aktor" required>
                            </div>
                            <div class="form-group">
                                <label for="durasi">Durasi (menit)</label>
                                <input type="number" name="durasi" min="0" id="durasi" class="form-control"
                                    placeholder="Masukkan durasi pertunjukan" required>
                            </div>
                            <div class="form-group">
                                <label for="rating_umur[]">Rating Umur</label>
                                <select name="rating_umur[]" id="rating_umur" class="form-control" required>
                                    <option selected disabled>Pilih Rating Umur</option>
                                    <option>Semua Umur (SU)</option>
                                    <option>13+</option>
                                    <option>17+</option>
                                    <option>21+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mitra_teater">Pilih Mitra Teater</label>
                                <select id="mitra_teater" name="mitra_teater" class="form-control">
                                    <option value="" selected disabled>Pilih Mitra Teater</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_platform_sosmed[]" class="form-label">Sosial Media Teater</label>
                                <div>
                                    <input type="checkbox" id="same-sosmed"> Sama dengan sosial media komunitas
                                </div>
                                <div id="social-media-input">
                                    <div class="social-media-teater">
                                        <select name="id_platform_sosmed[]" id="platform_name" class="form-control"
                                            aria-label="Platform" required>
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

                                        <input type="text" name="acc_name[]" id="acc_name" class="form-control"
                                            placeholder="Enter your account name">
                                    </div>
                                    <button id="add-account-btn" type="button" class="btn btn-danger add-item">Add
                                        Another Account</button>
                                </div>
                                <div id="draft-accounts"></div>
                                <input type="hidden" name="hidden_accounts" value="">
                            </div>
                            <div class="form-group">
                                <label for="judul_web[]" class="form-label">Website Teater</label>
                                <div id="website-input">
                                    <div class="website-teater">
                                        <input type="text" name="judul_web[]" id="judul_web" class="form-control"
                                            placeholder="Masukkan judul web">
                                        <input type="text" name="url_web[]" id="url_web" class="form-control"
                                            placeholder="Masukkan url web">
                                    </div>
                                    <button id="add-web-btn" type="button" class="btn btn-danger add-item">Tambah
                                        Website</button>
                                </div>
                                <div id="draft-web"></div>
                                <input type="hidden" name="hidden_web" value="">
                            </div>
                        </div>
                    </div>
                    <div class="popup-footer">
                        <div class="button-group">
                            <button type="submit" id="submitBtn" class="btn btn-success">Simpan</button>
                            <button type="button" id="cancelBtn" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="detail-show">
        <div class="show-container">
            <div class="show-item">
                <div class="poster">
                    <img src="<?= base_url('assets/images/poster/poster1.jpg') ?>" alt="Poster Pertunjukan">
                    <p>Es Lilin Cilacap Production</p>
                </div>
                <div class="show-info">
                    <h6>Pertunjukan Teater</h6>
                    <h3>Perahu Kertas</h3>
                    <div class="details">
                        <p><span class="label">Aktor:</span> Jaya Wijaya, Lilith Purnawarman, Toni Jojoni</p>
                        <p><span class="label">Sutradara:</span> Willy Santoso</p>
                        <p><span class="label">Penulis:</span> Windy Panduwara</p>
                        <p><span class="label">Staff:</span> Bagong Puripurna, Lulu Lunita, Cepri Tagor, Linda Putu.</p>
                        <p><span class="label">Durasi:</span> 120 menit</p>
                        <p><span class="label">Rating Umur:</span> Semua Umur (SU)</p>
                        <p><span class="label">Sinopsis: </span> Disebuah hutan, tinggallah bayi kera yang sangat cantik. Saat beranjak remaja, ia berjalan menuju desa manusia.</p>

                    </div>
                </div>
            </div>
            <div class="extra-info">
                <div class="social-media">
                    <p><span class="label">Sosial Media:</span>
                    <div class="platform">
                        <i class="fa-brands fa-instagram"></i> <a href="https://instagram.com/eslilincilacapproduction" target="_blank">@eslilincilacapproduction</a><br>
                    </div>
                    <div class="platform">
                        <i class="fa-brands fa-facebook"></i> <a href="https://facebook.com/EsLilinCilacapProduction" target="_blank">Es Lilin Cilacap Production</a>
                    </div>
                    </p>
                </div>
                <div class="web">
                    <p><span class="label">Web:</span>
                        <a href="https://www.nsi.com" target="_blank">Komunitas Teater Official</a>
                    </p>
                </div>
            </div>

            <!-- Tabel Jadwal Pertunjukan -->
            <div class="schedule-table">
                <h5>Jadwal Pertunjukan</h5>
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
                        <?php foreach ($groupedSchedule as $kota => $tempatList): ?>
                            <?php $firstKota = true; ?>
                            <?php foreach ($tempatList as $tempat => $tanggalList): ?>
                                <?php $firstTempat = true; ?>
                                <?php foreach ($tanggalList as $tanggal => $waktuList): ?>
                                    <tr>
                                        <?php if ($firstKota): ?>
                                            <td rowspan="<?= array_sum(array_map('count', $tempatList)); ?>"><?= $kota; ?></td>
                                            <?php $firstKota = false; ?>
                                        <?php endif; ?>
                                        <?php if ($firstTempat): ?>
                                            <td rowspan="<?= count($tanggalList); ?>"><?= $tempat; ?></td>
                                            <?php $firstTempat = false; ?>
                                        <?php endif; ?>
                                        <td><?= date('d F Y', strtotime($tanggal)); ?></td>
                                        <td><?= nl2br(implode("\n", $waktuList)); ?></td>
                                        <?php if (!isset($addedHarga[$tempat])): ?>
                                            <td rowspan="<?= count($tanggalList); ?>"><?= nl2br(str_replace(', ', "\n", $placeInfo[$tempat]['harga'])); ?></td>
                                            <td rowspan="<?= count($tanggalList); ?>">
                                                <a href="#" class="openSeatMap" data-image="<?= base_url('assets/images/' . $placeInfo[$tempat]['denah']); ?>">Lihat Denah</a>
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
            <div class="actions">
                <button id="btnPesan">Pesan Tiket</button>
                <button id="btnUploadBukti">Upload Tiket</button>
            </div>
        </div>

        <div class="overlay" id="overlay"></div>

        <div class="popup" id="popupKonfirmasi">
            <h2>Konfirmasi Pendaftaran</h2>
            <p>Apakah anda yakin ingin melakukan pendaftaran pertunjukan teater ini?</p>
            <p>Harap upload bukti pembayaran setelah berhasil mendaftar di website tujuan.</p>
            <button id="btnYa" class="btn-primary">Ya</button>
            <button id="btnTidak" class="btn-secondary">Batal</button>
        </div>

        <div class="popup" id="popupUpload">
            <h2>Upload Bukti Pembayaran</h2>
            <p>Silakan upload bukti pembayaran.</p>
            <input type="file" id="buktiPembayaran">
            <button id="btnUpload" class="btn-primary">Upload</button>
            <button id="btnBatalUpload" class="btn-secondary">Batal</button>
        </div>

        <!-- Popup Denah Seat -->
        <div id="seatMapModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img id="seatMapImage" src="" alt="Denah Seat" style="width: 100%;">
            </div>
        </div>

        <!-- Form Upload Bukti Pembayaran -->
        <div class="popup" id="popupUploadBukti">
            <h2>Upload Bukti Pembayaran</h2>
            <form id="formUploadBukti" action="<?= base_url('Audiens/uploadBuktiPembayaran') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <!-- <input type="hidden" name="id_teater" value=""> Pastikan ini dikirim dari controller -->
                <input type="hidden" name="id_teater" value="60"> <!-- ini hanya sementara karena view data teater untuk mengambil id belom ada jika sudah ada tambahkan id teater di value -->
                <input type="file" name="bukti" required>
                <br><br>
                <button type="submit" class="btn-primary">Upload</button>
                <button type="button" class="btn-secondary" onclick="closePopup()">Batal</button>
            </form>
        </div>
    </div>
</body>

</html>
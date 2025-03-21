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
                </div>

                <section class="teater-section">
                    <h2>Audisi Aktor</h2>
                    <div class="teater-list">
                        <div class="poster-carousel">
                            <?php foreach ($audisiAktor as $teater): ?>
                                <div class="teater-item" 
                                <?php if (session()->has('id_user')): ?>
                                    onclick="window.location.href='<?= base_url('Audiens/detailAudisiAktor') ?>'"
                                <?php else: ?>
                                    onclick="showLoginPopup()"
                                <?php endif; ?>>
                                    <img class="poster" src="<?= esc($teater['poster']) ?>" alt="<?= esc($teater['judul']) ?>">
                                    <h3 class="karakter_audisi"><?= esc($teater['karakter_audisi']) ?></h3>
                                    <h3 class="judul"><?= esc($teater['judul']) ?></h3>
                                    <p class="name"><?= esc($teater['komunitas_teater']) ?></p>

                                    <div class="teater-details">
                                        <div class="detail">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span><?= esc($teater['lokasi_teater']) ?></span>
                                        </div>
                                        <div class="detail">
                                            <i class="fa-regular fa-calendar"></i>
                                            <span><?= esc($teater['hari']) ?>, <?= esc($teater['tanggal']) ?></span>
                                        </div>
                                        <div class="detail">
                                            <i class="fa-regular fa-clock"></i>
                                            <span><?= esc($teater['jam']) ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <section class="teater-section">
                    <h2>Audisi Staff</h2>
                    <div class="teater-list">
                        <div class="poster-carousel">
                            <?php foreach ($audisiStaff as $teater): ?>
                                <div class="teater-item" 
                                <?php if (session()->has('id_user')): ?>
                                    onclick="window.location.href='<?= base_url('Audiens/detailAudisiStaff') ?>'"
                                <?php else: ?>
                                    onclick="showLoginPopup()"
                                <?php endif; ?>>
                                    <img class="poster" src="<?= esc($teater['poster']) ?>" alt="<?= esc($teater['judul']) ?>">
                                    <h3 class="jenis_staff"><?= esc($teater['jenis_staff']) ?></h3>
                                    <h3 class="judul"><?= esc($teater['judul']) ?></h3>
                                    <p class="name"><?= esc($teater['komunitas_teater']) ?></p>

                                    <div class="teater-details">
                                        <div class="detail">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span><?= esc($teater['lokasi_teater']) ?></span>
                                        </div>
                                        <div class="detail">
                                            <i class="fa-regular fa-calendar"></i>
                                            <span><?= esc($teater['hari']) ?>, <?= esc($teater['tanggal']) ?></span>
                                        </div>
                                        <div class="detail">
                                            <i class="fa-regular fa-clock"></i>
                                            <span><?= esc($teater['jam']) ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!-- Modal Pop-up -->
                <div id="loginPopup" class="popup-container">
                    <div class="popup-content">
                        <p>Silakan login atau registrasi untuk melihat detail audisi.</p>
                        <button onclick="window.location.href='<?= base_url('User/login') ?>'">Login</button>
                        <button onclick="window.location.href='<?= base_url('Audiens/registration') ?>'">Registrasi</button>
                        <button onclick="closeLoginPopup()">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

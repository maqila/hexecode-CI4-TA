<!DOCTYPE html>
<html lang="en">

<body>
    <!-- templates/footer.php -->
    <footer style="background-color: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #ddd;">
        <div class="container">
            <p style="margin: 0; font-size: 14px; color: #6c757d;">
                &copy; <?= date('Y'); ?> Theaterform. All rights reserved.
            </p>
            <div style="margin-top: 10px;">
                <a href="https://facebook.com" target="_blank" class="mx-2 social-link">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="mx-2 social-link">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="mx-2 social-link">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer>
    <!-- Footer end -->

    <!-- all plugins here -->
    <script data-cfasync="false" src="<?= base_url('assets/js/email-decode.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/appear.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/imageload.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/skill.bars.jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/slick.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/dropdown-navbar.js') ?>"></script>
    <script src="<?= base_url('assets/js/search-filter-pertunjukan.js') ?>"></script>

    <script>
        document.querySelectorAll(".openSeatMap").forEach(item => {
            item.addEventListener("click", function(event) {
                event.preventDefault();
                let imageUrl = this.getAttribute("data-image");
                document.getElementById("seatMapImage").src = imageUrl;
                document.getElementById("seatMapModal").style.display = "block";
            });
        });

        document.querySelector(".close").addEventListener("click", function() {
            document.getElementById("seatMapModal").style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == document.getElementById("seatMapModal")) {
                document.getElementById("seatMapModal").style.display = "none";
            }
        });
    </script>

    <script>
        const baseUrl = window.location.origin + "/CodeIgniter4/public";

        let idTeater = null; // Simpan secara global
        let idPenampilan = null;

        document.addEventListener("DOMContentLoaded", function() {
            const popup = document.getElementById("showPopup"); // ID Popup
            const popupTitle = document.getElementById("popupTitle"); // Judul Popup
            const form = document.getElementById("showForm"); // Form di dalam popup
            const addShowBtn = document.getElementById("addShowBtn"); // Tombol untuk membuka popup
            const cancelBtn = document.getElementById("cancelBtn"); // Tombol batal

            // Fungsi untuk mengirim form via AJAX dan mendapatkan id_teater
            form.addEventListener("submit", function(e) {
                e.preventDefault(); // Mencegah reload halaman

                let formData = new FormData(this);

                fetch("/CodeIgniter4/public/Admin/saveShow", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Server Response:", data); // Debug hasil dari server

                        if (data.success) {
                            alert(data.message); // Pesan sukses
                            if (data.redirect) {
                                window.location.href = data.redirect; // Redirect ke halaman tujuan
                            }
                        } else {
                            alert("Gagal menyimpan pertunjukan.");
                            console.error(data.errors || "Tidak ada pesan error dari server."); // Hanya tampilkan error jika ada
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan pada server.");
                    });
            });

            // Buka popup "Tambah Pertunjukan"
            addShowBtn.addEventListener("click", function() {
                popupTitle.textContent = "Tambah Pertunjukan";
                form.reset(); // Bersihkan semua input
                popup.style.display = "flex"; // Tampilkan popup
            });

            // Tombol "Batal" untuk menutup popup dan mereset ID Teater
            cancelBtn.addEventListener("click", function() {
                form.reset(); // Reset semua input dalam form
                idTeater = null; // Hapus nilai ID Teater
                idPenampilan = null;
                popup.style.display = "none"; // Sembunyikan popup
            });
        });

        console.log("Menjalankan script...");

        document.addEventListener('DOMContentLoaded', function() {
            let tipeHarga = document.getElementById('tipe_harga');
            let nominalHarga = document.getElementById('nominal-harga');
            let seatOption = document.getElementById('seat-option');
            let seatConfig = document.getElementById('seat-config');
            let denahSeat = document.getElementById('denah_seat');
            let draftContainer = document.getElementById('draft-seats');

            let hargaSebelumnya = null;
            let kategoriSebelumnya = []; // Menyimpan kategori sebelumnya
            let savedDrafts = []; // Menyimpan sementara draft kursi saat checkbox diubah
            let denahSebelumnya = null; // Simpan denah sebelum dihapus

            // Tampilkan atau sembunyikan input harga berdasarkan tipe harga
            tipeHarga.addEventListener('change', function() {
                if (this.value === "Bayar") {
                    nominalHarga.style.display = "block";
                    if (hargaSebelumnya !== null) {
                        document.getElementById('harga').value = hargaSebelumnya; // Kembalikan harga sebelumnya
                    }
                } else {
                    nominalHarga.style.display = "none";
                    hargaSebelumnya = document.getElementById('harga').value || hargaSebelumnya; // Simpan harga terakhir sebelum diubah
                    document.getElementById('harga').value = null; // Kosongkan input harga

                    // Hapus semua draft seat jika Gratis dipilih
                    draftContainer.innerHTML = '';
                    kategoriSebelumnya = []; // Hapus data kategori sebelumnya
                    denahSeat.value = "";
                    denahSeat.removeAttribute('required');
                }
            });

            // Tampilkan atau sembunyikan konfigurasi kursi
            seatOption.addEventListener('change', function() {
                seatConfig.style.display = this.checked ? "block" : "none";

                if (!this.checked) {
                    // Simpan draft kursi sebelum dihapus
                    savedDrafts = [...draftContainer.children];
                    draftContainer.innerHTML = ''; // Hanya kosongkan tampilan, bukan data
                    denahSebelumnya = denahSeat.value; // Simpan denah seat sebelum dihapus
                    denahSeat.removeAttribute('required');
                    denahSeat.value = ""; // Kosongkan denah
                } else {
                    // Kembalikan draft kursi jika sebelumnya sudah ada
                    if (savedDrafts.length > 0) {
                        savedDrafts.forEach(draft => draftContainer.appendChild(draft));
                        savedDrafts = []; // Kosongkan setelah dikembalikan
                    }

                    if (denahSebelumnya && tipeHarga.value !== "Gratis") {
                        denahSeat.value = denahSebelumnya; // Kembalikan denah sebelumnya
                    }
                }
            });

            // Format harga menjadi ribuan (10,000)
            // function formatHarga(input) {
            //     let value = input.value.replace(/\D/g, ''); // Hanya angka
            //     input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            // }

            // document.getElementById('harga').addEventListener('input', function() {
            //     formatHarga(this);
            // });

            // Tambahkan draft kategori
            document.getElementById('addSeatCategory').addEventListener('click', function() {
                let kategoriInput = document.getElementById('nama_kategori');
                let hargaKategoriInput = document.getElementById('harga'); // Harga kategori seat
                let kategori = kategoriInput.value.trim();
                let hargaKategori = hargaKategoriInput.value.trim();

                if (kategori === '' || hargaKategori === '') {
                    alert("Harap isi kategori dan harga sebelum menambah.");
                    return;
                }

                // Buat elemen draft kategori
                let draftItem = document.createElement('div');
                draftItem.classList.add('draft-item');

                draftItem.innerHTML = `
                    <span title="${kategori}">${kategori}</span> - 
                    <span title="${hargaKategori}">${hargaKategori}</span>
                    <button type="button" class="delete-draft-btn delete-seat-btn">x</button>
                    `;

                // Hidden input untuk backend
                let hiddenKategori = document.createElement('input');
                hiddenKategori.type = 'hidden';
                hiddenKategori.name = 'seat_kategori[]';
                hiddenKategori.value = kategori;

                let hiddenHarga = document.createElement('input');
                hiddenHarga.type = 'hidden';
                hiddenHarga.name = 'seat_harga[]';
                hiddenHarga.value = hargaKategori;

                draftItem.appendChild(hiddenKategori);
                draftItem.appendChild(hiddenHarga);
                draftContainer.appendChild(draftItem);

                kategoriSebelumnya.push({
                    kategori,
                    harga: hargaKategori
                });

                // Reset input setelah ditambahkan ke draft
                kategoriInput.value = '';
                hargaKategoriInput.value = '';

                // **Wajibkan upload denah jika ada draft**
                denahSeat.setAttribute('required', 'required');

                // Hapus item draft jika tombol delete ditekan
                draftItem.querySelector('.delete-draft-btn').addEventListener('click', function() {
                    draftItem.remove();

                    // Jika tidak ada draft seat, upload denah tidak wajib
                    if (draftContainer.children.length === 0) {
                        denahSeat.removeAttribute('required');
                    }
                });
            });

            tipeHarga.addEventListener('change', function() {
                if (this.value === "Bayar" && kategoriSebelumnya.length > 0) {
                    kategoriSebelumnya.forEach(seat => {
                        let draftItem = document.createElement('div');
                        draftItem.classList.add('draft-item');
                        draftItem.innerHTML = `
                    <span title="${seat.kategori}">${seat.kategori}</span> - 
                    <span title="${seat.harga}">${seat.harga}</span>
                    <button type="button" class="delete-draft-btn delete-seat-btn">x</button>
                `;

                        let hiddenKategori = document.createElement('input');
                        hiddenKategori.type = 'hidden';
                        hiddenKategori.name = 'seat_kategori[]';
                        hiddenKategori.value = seat.kategori;

                        let hiddenHarga = document.createElement('input');
                        hiddenHarga.type = 'hidden';
                        hiddenHarga.name = 'seat_harga[]';
                        hiddenHarga.value = seat.harga;

                        draftItem.appendChild(hiddenKategori);
                        draftItem.appendChild(hiddenHarga);
                        draftContainer.appendChild(draftItem);
                    });
                }
            });

            // **Cek sebelum submit form**
            document.querySelector('form').addEventListener('submit', function(event) {
                // Cek jika menggunakan kategori seat, minimal harus 2 kategori
                if (draftContainer.children.length > 0) {
                    if (draftContainer.children.length < 2) {
                        alert("Minimal harus ada dua kategori seat jika sudah menggunakan kategori seat.");
                        event.preventDefault();
                        return;
                    }
                    if (denahSeat.files.length === 0) {
                        alert("Wajib upload denah seat jika menggunakan kategori seat.");
                        event.preventDefault();
                        return;
                    }
                }
            });
        });

        function toggleLainnya(select) {
            var lainnyaContainer = document.getElementById("lainnya-container");
            var kotaInput = document.getElementById("kota-input");

            if (select.value === "lainnya") {
                lainnyaContainer.style.display = "block";
                if (kotaInput) {
                    kotaInput.required = true;
                    kotaInput.focus();
                }
            } else {
                lainnyaContainer.style.display = "none";

                if (kotaInput) {
                    kotaInput.required = false;
                    kotaInput.value = ""; // Reset input kota
                }
            }
        }

        function KotaValue(input) {
            var hiddenKotaInput = document.getElementById("hidden-kota");
            if (hiddenKotaInput) {
                hiddenKotaInput.value = input.value; // Simpan nilai input kota ke hidden input
            }
        }

        document.getElementById('addSchedule').addEventListener('click', function() {
            let tanggal = document.getElementById('tanggal').value;
            let waktuMulai = document.getElementById('waktu_mulai').value;
            let waktuSelesai = document.getElementById('waktu_selesai').value;
            let tipeHarga = document.getElementById('tipe_harga').value;
            let harga = document.getElementById('harga').value.trim();
            let kotaSelect = document.getElementById('kota-select');
            let kotaInput = document.getElementById('kota-input');
            let kota = kotaSelect.value === 'lainnya' && kotaInput ? kotaInput.value : kotaSelect.value; // Update kode
            let tempat = document.getElementById('tempat').value.trim();
            let seatOption = document.getElementById('seat-option').checked;
            let denahSeat = document.getElementById('denah_seat').files.length > 0 ? 'Uploaded' : 'None';
            let draftContainer = document.getElementById('draft-seats');

            if (!tanggal || !waktuMulai || !waktuSelesai || !kota || !tempat || !tipeHarga) {
                alert("Mohon lengkapi semua field.");
                return;
            }

            // Ambil semua kategori seat yang sudah ditambahkan
            let seatDrafts = [];
            document.querySelectorAll('#draft-seats .draft-item').forEach(item => {
                let kategoriInput = item.querySelector('input[name="seat_kategori[]"]');
                let hargaInput = item.querySelector('input[name="seat_harga[]"]');

                console.log("Kategori Input:", kategoriInput);
                console.log("Harga Input:", hargaInput);

                if (kategoriInput && hargaInput) { // Pastikan elemen ditemukan sebelum akses
                    let kategori = kategoriInput.value;
                    let harga = hargaInput.value;
                    seatDrafts.push({
                        kategori,
                        harga
                    });
                }

                if (tipeHarga === "Gratis") {
                    kategori = null;
                    harga = null;
                }
            });

            console.log("Seat Drafts:", seatDrafts);

            // Validasi harga jika memilih "Bayar"
            if (tipeHarga === "Bayar" && seatDrafts.length === 0) {
                let hargaNominal = parseInt(harga.replace(/,/g, ''), 10);
                if (!hargaNominal || hargaNominal <= 0) {
                    alert("Harga harus diisi dengan angka yang valid.");
                    return;
                }
            }

            // Jika ada kategori seat, wajib minimal 2 kategori & harus upload denah seat
            if (seatDrafts.length === 1) {
                alert("Minimal harus ada dua kategori seat jika sudah menggunakan kategori seat.");
                return;
            }
            if (seatDrafts.length >= 2 && document.getElementById('denah_seat').files.length === 0) {
                alert("Wajib upload denah seat jika menggunakan kategori seat.");
                return;
            }

            let draftText = (tipeHarga === "Gratis") ?
                "Gratis" :
                (seatDrafts.length > 0 ?
                    seatDrafts.map(seat => `${seat.kategori} - ${seat.harga}`).join(", ") :
                    harga);

            // Simpan data dalam bentuk JSON
            let newSchedule = {
                tanggal: tanggal,
                waktu_mulai: waktuMulai,
                waktu_selesai: waktuSelesai,
                tipe_harga: tipeHarga,
                nama_kategori: seatDrafts.map(seat => seat.kategori).join(", "), // Simpan nama kategori
                harga: (tipeHarga.value === "Gratis") ? null : (seatDrafts.length > 0 ?
                    seatDrafts.map(seat => seat.harga).join(", ") :
                    harga),
                kota: kota,
                tempat: tempat,
                denah_seat: denahSeat
            };

            let hiddenInput = document.querySelector('input[name="hidden_schedule"]');
            let currentSchedules = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];
            currentSchedules.push(newSchedule);
            hiddenInput.value = JSON.stringify(currentSchedules);

            let draftSchedule = document.getElementById('draft-schedule');
            let scheduleItem = document.createElement('div');
            scheduleItem.classList.add('draft-schedule-item');
            scheduleItem.innerHTML = `
            <p><strong>${tanggal}, ${waktuMulai} - ${waktuSelesai}</strong></p>
            <p>${draftText}</p>
            <p>${kota} - ${tempat}</p>
            <button type="button" class="delete-draft-btn delete-schedule-btn">x</button>
        `;

            draftSchedule.appendChild(scheduleItem);

            console.log("Draft Schedule Item ditambahkan:", scheduleItem.innerHTML);

            scheduleItem.querySelector('.delete-draft-btn').addEventListener('click', function() {
                draftSchedule.removeChild(scheduleItem);

                draftContainer.innerHTML = '';

                let updatedSchedules = currentSchedules.filter(schedule =>
                    !(schedule.tanggal === tanggal &&
                        schedule.waktu_mulai === waktuMulai &&
                        schedule.waktu_selesai === waktuSelesai &&
                        schedule.tipe_harga === tipeHarga &&
                        schedule.nama_kategori === seatDrafts.map(seat => seat.kategori).join(", ") &&
                        schedule.harga === (tipeHarga === "Gratis" ? null : (seatDrafts.length > 0 ? seatDrafts.map(seat => seat.harga).join(", ") : harga)) &&
                        schedule.kota === kota &&
                        schedule.tempat === tempat &&
                        schedule.denah_seat === denahSeat)
                );

                hiddenInput.value = JSON.stringify(updatedSchedules);
                console.log("Updated Hidden Input Value (JSON):", hiddenInput.value);
            });
        });

        document.getElementById("addSchedule").addEventListener("click", function() {
            document.querySelectorAll(".schedule-show input, .schedule-show select, .schedule-show textarea").forEach(el => {
                if (el.name) {
                    el.dataset.tempName = el.name; // Simpan name agar bisa dikembalikan jika dibutuhkan
                    el.removeAttribute("name"); // Hapus name agar tidak dikirim ke server
                }
            });
        });

        //Jika perlu mengembalikan name saat user ingin menyimpan inputnya
        document.getElementById("submitBtn").addEventListener("click", function() {
            document.querySelectorAll(".schedule-show input, .schedule-show select, .schedule-show textarea").forEach(el => {
                if (el.dataset.tempName) {
                    el.name = el.dataset.tempName;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Fetch daftar mitra yang sudah di-approve
            fetch('<?= base_url('teater/getApprovedMitra') ?>')
                .then(response => response.json())
                .then(data => {
                    console.log('Data mitra diterima:', data); // Debugging

                    let selectMitra = document.getElementById('mitra_teater');
                    selectMitra.innerHTML = '<option value="">Pilih Mitra Teater</option>'; // Reset opsi

                    data.forEach(mitra => {
                        let option = document.createElement('option');
                        option.value = mitra.id_mitra;
                        option.textContent = mitra.nama;
                        selectMitra.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching mitra:', error));
        });

        document.addEventListener('DOMContentLoaded', function() {
            const mitraSelect = document.getElementById('mitra_teater');
            const checkbox = document.getElementById('same-sosmed');
            const draftContainer = document.getElementById('draft-accounts');
            const hiddenInput = document.querySelector('input[name="hidden_accounts"]');
            const addAccountBtn = document.getElementById('add-account-btn');
            const platformSelect = document.getElementById('platform_name');
            const accountInput = document.getElementById('acc_name');
            const form = document.getElementById('showForm');

            let hiddenData = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

            async function copySosmed() {
                if (!checkbox.checked) return;

                const mitraId = mitraSelect.value;
                if (!mitraId) {
                    alert('Pilih mitra terlebih dahulu!');
                    checkbox.checked = false;
                    return;
                }

                try {
                    // Fetch sosial media mitra yang sudah dihubungkan ke sosial media teater
                    const response = await fetch(`<?= base_url('teater/getMitraSosmed') ?>/${mitraId}`);
                    const data = await response.json();
                    console.log('Data Sosial Media Mitra yang Terkait:', data); // Debugging

                    if (data.length > 0) {
                        data.forEach(item => {
                            // Cek apakah sosial media ini sudah ada dalam draft
                            const existing = hiddenData.some(d => d.platformId === item.id_platform_sosmed);
                            if (existing) return;

                            const draftItem = document.createElement('div');
                            draftItem.classList.add('draft-item');
                            draftItem.setAttribute('data-platform-id', item.id_platform_sosmed);

                            draftItem.innerHTML = `
                            <span title="${item.platform_name}">${item.platform_name}</span> - 
                            <span title="${item.acc_mitra}">${item.acc_mitra}</span>
                            <button type="button" class="delete-draft-btn delete-sosmed-btn">x</button>
                        `;

                            draftContainer.appendChild(draftItem);

                            // ⬇️ Tambahkan data baru TANPA menghapus data lama
                            hiddenData.push({
                                platformId: item.id_platform_sosmed,
                                platformName: item.platform_name,
                                account: item.acc_mitra
                            });

                            // Tambahkan event listener untuk hapus draft
                            draftItem.querySelector('.delete-draft-btn').addEventListener('click', function() {
                                draftItem.remove();
                                hiddenData = hiddenData.filter(d => !(d.account === item.acc_mitra && d.platformName === item.platform_name));
                                hiddenInput.value = JSON.stringify(hiddenData);
                                console.log('Draft Sosial Media Setelah Hapus:', hiddenData); // Debugging
                            });
                        });

                        // ⬇️ Simpan hasil gabungan ke hidden input
                        hiddenInput.value = JSON.stringify(hiddenData);

                        console.log('Draft Sosial Media Keseluruhan (Setelah Copy Mitra):', hiddenData);
                    } else {
                        alert('Mitra ini tidak memiliki sosial media yang terhubung dengan teater.');
                        checkbox.checked = false;
                    }
                } catch (error) {
                    console.error('Error fetching mitra sosmed:', error);
                }
            }

            // Event listener untuk checkbox
            checkbox.addEventListener('change', copySosmed);

            addAccountBtn.addEventListener('click', function() {
                const platformId = platformSelect.value;
                const platformName = platformSelect.options[platformSelect.selectedIndex].getAttribute('data-nama');
                const accountName = accountInput.value.trim();

                if (!platformId || !accountName) {
                    alert('Pilih platform dan isi nama akun!');
                    return;
                }

                // Cek apakah akun sudah ada dengan platform yang sama
                const existing = hiddenData.some(d => d.account === accountName && d.platformName === platformName);
                if (existing) {
                    alert('Akun ini sudah ada dalam daftar untuk platform yang sama!');
                    return;
                }

                // Buat draft item baru
                const draftItem = document.createElement('div');
                draftItem.classList.add('draft-item');

                draftItem.innerHTML = `
                <span title="${platformName}">${platformName}</span> - 
                <span title="${accountName}">${accountName}</span>
                <button type="button" class="delete-draft-btn delete-sosmed-btn">x</button>
            `;

                draftContainer.appendChild(draftItem);

                // ⬇️ Tambahkan data baru TANPA menghapus data lama
                hiddenData.push({
                    platformId: platformId,
                    platformName: platformName,
                    account: accountName
                });

                // Simpan hasil gabungan ke hidden input
                hiddenInput.value = JSON.stringify(hiddenData);

                console.log('Draft Sosial Media Keseluruhan (Setelah Tambah Manual):', hiddenData);

                // Tambahkan event listener untuk hapus draft
                draftItem.querySelector('.delete-draft-btn').addEventListener('click', function() {
                    draftItem.remove();
                    hiddenData = hiddenData.filter(d => !(d.account === accountName && d.platformName === platformName));
                    hiddenInput.value = JSON.stringify(hiddenData);
                    console.log('Draft Sosial Media Setelah Hapus:', hiddenData);
                });

                // Reset input
                accountInput.value = '';
            });

            document.getElementById('submitBtn').addEventListener('submit', function(event) {
                const hiddenInput = document.querySelector('input[name="hidden_accounts"]');
                const hiddenData = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

                console.log('Final Draft Sosial Media (Sebelum Submit):', hiddenData);

                if (hiddenData.length === 0) {
                    alert('Tambahkan setidaknya satu sosial media!');
                    event.preventDefault();
                    return;
                }

                hiddenInput.value = JSON.stringify(hiddenData);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const addWebButton = document.getElementById('add-web-btn');
            const draftContainer = document.getElementById('draft-web');
            const hiddenInput = document.querySelector('input[name="hidden_web"]');

            function updateHiddenInput() {
                const draftItems = draftContainer.querySelectorAll('.draft-item');
                const data = [];

                draftItems.forEach(item => {
                    const title = item.getAttribute('data-title');
                    const url = item.getAttribute('data-url');
                    data.push({
                        title,
                        url
                    });
                });

                hiddenInput.value = JSON.stringify(data);
                console.log('Updated Hidden Input:', hiddenInput.value);
            }

            if (addWebButton) {
                addWebButton.addEventListener('click', function() {
                    const titleInput = document.querySelector('input[name="judul_web[]"]');
                    const urlInput = document.querySelector('input[name="url_web[]"]');

                    const title = titleInput.value.trim();
                    const url = urlInput.value.trim();

                    // Validasi: Jika salah satu diisi, keduanya harus diisi
                    if ((title !== '' && url === '') || (title === '' && url !== '')) {
                        alert('Harap isi kedua kolom (Judul Web dan URL) atau biarkan keduanya kosong.');
                        return;
                    }

                    // Jika keduanya kosong, tidak menambahkan draft
                    if (title === '' && url === '') return;

                    // Tambahkan item draft ke container draft
                    const draftItem = document.createElement('div');
                    draftItem.classList.add('draft-item');
                    draftItem.setAttribute('data-title', title);
                    draftItem.setAttribute('data-url', url);
                    draftItem.innerHTML = `
                    <span>${title}</span> - 
                    <span>${url}</span>
                    <button type="button" class="delete-draft-btn delete-web-btn">x</button>
                `;

                    draftContainer.appendChild(draftItem);

                    // Perbarui hidden input
                    updateHiddenInput();

                    // Kosongkan input setelah data ditambahkan
                    titleInput.value = '';
                    urlInput.value = '';

                    // Tambahkan listener untuk tombol delete
                    draftItem.querySelector('.delete-draft-btn').addEventListener('click', function() {
                        draftItem.remove();
                        updateHiddenInput(); // Perbarui hidden input setelah menghapus draft
                    });
                });
            }
        });

        // Open popup for "Edit Pertunjukan"
        document.getElementById('editBtn1').addEventListener('click', () => {
            console.log("Tombol Edit ditekan");
            const popupTitle = document.getElementById('popupTitle'); // Pastikan ID ini ada di HTML
            const popup = document.getElementById('showPopup'); // Pastikan ID ini ada di HTML

            if (!popup) {
                console.error("Elemen popup tidak ditemukan di HTML!");
                return;
            }

            popupTitle.textContent = 'Edit Pertunjukan';

            // Mengisi nilai field yang sesuai dengan HTML
            document.getElementById('judul').value = 'Jaya Wijaya Show';

            // Untuk input file, kita tidak bisa mengisi value secara langsung, jadi diabaikan
            // document.getElementById('poster').value = 'https://via.placeholder.com/150';

            document.getElementById('sinopsis').value = 'Ini adalah sinopsis pertunjukan.';
            document.getElementById('tanggal').value = '2024-09-12'; // Sesuaikan dengan input date
            document.getElementById('waktu').value = '15:00'; // Sesuaikan dengan input time
            document.getElementById('kota').value = 'Jakarta';
            document.getElementById('tempat').value = 'Aula Teater Garuda Krisna, Jakarta';
            document.getElementById('harga').value = 75000;
            document.getElementById('penulis').value = 'Jaya Wijaya';
            document.getElementById('sutradara').value = 'Willy Santoso';
            document.getElementById('staff').value = 'Toni Jojoni';
            document.getElementById('aktor').value = 'Jaya Wijaya, Lilith Purnawarman, Toni Jojoni';
            document.getElementById('durasi').value = 120;
            document.getElementById('rating_umur').value = '17+';

            // Sosial Media
            document.getElementById('platform_name').value = '5'; // TikTok
            document.getElementById('acc_name').value = '@JayaWijayaShow';

            // Website
            document.getElementById('judul_web').value = 'Jaya Wijaya Official';
            document.getElementById('url_web').value = 'https://www.jayawijaya.com';

            // Menampilkan popup
            popup.style.display = 'flex';
            console.log("Popup ditampilkan");
        });

        // Close popup
        cancelBtn.addEventListener('click', () => {
            popup.style.display = 'none';
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("approvePopup").style.display = "none";
        });

        function submitApproved() {
            var idMitra = document.getElementById("id_mitra").value;

            if (idMitra) {
                fetch("<?= base_url('Admin/approveMitra') ?>/" + idMitra, {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "<?= csrf_hash() ?>"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Akun berhasil disetujui!");
                            location.reload();
                        } else {
                            alert("Gagal menyetujui akun: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error))
                    .finally(() => closeApprovePopup());
            }
        }

        function confirmApprove(idMitra) {
            document.getElementById("approvePopup").style.display = "flex";
            document.getElementById("id_mitra").value = idMitra;
        }

        function closeApprovePopup() {
            document.getElementById("approvePopup").style.display = "none";
        }

        // Pastikan popup selalu disembunyikan saat halaman pertama kali dimuat
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("rejectionPopup").style.display = "none";
        });

        function submitRejection() {
            var idMitra = document.getElementById("id_mitra").value;
            var reason = document.getElementById("reason").value;

            if (!reason.trim()) {
                alert("Alasan harus diisi!");
                return;
            }

            fetch("<?= base_url('Admin/rejectMitra') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id_mitra=" + encodeURIComponent(idMitra) + "&reason=" + encodeURIComponent(reason)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        alert("Akun berhasil ditolak!");
                        closeRejectPopup(); // Pastikan popup ditutup setelah berhasil
                        location.reload(); // Refresh halaman untuk update tampilan
                    } else {
                        alert("Gagal menolak akun!");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function openRejectPopup(idMitra) {
            document.getElementById("rejectionPopup").style.display = "flex";
            document.getElementById("id_mitra").value = idMitra;
        }

        function closeRejectPopup() {
            document.getElementById("rejectionPopup").style.display = "none";
        }
    </script>
</body>

</html>
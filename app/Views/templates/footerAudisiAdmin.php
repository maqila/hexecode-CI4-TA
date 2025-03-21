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

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let categorySelect = document.getElementById("searchCategory");
            let inputContainer = document.getElementById("searchInputContainer");

            function updateSearchInput(selected) {
                let newInput = "";

                if (selected === "kategori") {
                    newInput = `
                            <select class="form-select w-50" id="searchInput">
                                <option value="">Pilih Kategori</option>
                                <option value="Aktor">Aktor</option>
                                <option value="Staff">Staff</option>
                            </select>
                        `;
                } else if (selected === "tanggal") {
                    newInput = `<input type="date" class="form-control w-50" id="searchInput">`;
                } else if (selected === "waktu") {
                    newInput = `<input type="time" class="form-control w-50" id="searchInput">`;
                } else if (selected === "kota") {
                    newInput = `
                            <select class="form-select w-50" id="searchInput">
                                <option value="">Pilih Kota</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Bandung">Bandung</option>
                                <option value="Surabaya">Surabaya</option>
                            </select>
                        `;
                } else if (selected === "harga") {
                    newInput = `
                            <div class="d-flex gap-2">
                                <input type="number" class="form-control w-25" id="minHarga" placeholder="Min Harga">
                                <input type="number" class="form-control w-25" id="maxHarga" placeholder="Max Harga">
                            </div>
                        `;
                } else if (selected === "gaji") {
                    newInput = `
                            <div class="d-flex gap-2">
                                <input type="number" class="form-control w-25" id="minGaji" placeholder="Min Gaji">
                                <input type="number" class="form-control w-25" id="maxGaji" placeholder="Max Gaji">
                            </div>
                        `;
                } else {
                    // Default: input teks biasa
                    newInput = `<input type="text" class="form-control w-50" id="searchInput" placeholder="Cari...">`;
                }

                // Ganti isi dari inputContainer
                inputContainer.innerHTML = newInput;
            }

            // Jalankan perubahan saat dropdown berubah
            categorySelect.addEventListener("change", function() {
                updateSearchInput(this.value);
            });

            // Set default input pertama kali
            updateSearchInput(categorySelect.value);
        });
    </script>

    <script>
        // Buka popup "Tambah Audisi Aktor"
        const baseUrl = window.location.origin + "/CodeIgniter4/public";

        let idTeater = null; // Simpan secara global
        let idAudisi = null;

        document.addEventListener("DOMContentLoaded", function() {
            const popup = document.getElementById("auditionPopupAktor"); // ID Popup
            const popupTitle = document.getElementById("popupTitleAktor"); // Judul Popup
            const form = document.getElementById("auditionFormAktor"); // Form di dalam popup
            const addShowBtn = document.getElementById("addAuditionActorBtn"); // Tombol untuk membuka popup
            const cancelBtn = document.getElementById("cancelBtnAktor"); // Tombol batal

            // Fungsi untuk mengirim form via AJAX dan mendapatkan id_teater
            form.addEventListener("submit", function(e) {
                e.preventDefault(); // Mencegah reload halaman

                let formData = new FormData(this);

                fetch("/CodeIgniter4/public/Admin/saveAuditionAktor", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Server Response:", data); // Debug hasil dari server

                        if (data.status === "success") {
                            alert(data.message);
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                        } else {
                            alert("Gagal menyimpan audisi.");
                            console.error(data.errors || "Tidak ada pesan error dari server.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan pada server.");
                    });
            });

            // Buka popup "Tambah Pertunjukan"
            document.getElementById("addAuditionActorBtn").addEventListener("click", () => {
                popupTitle.textContent = "Tambah Audisi Aktor";
                form.reset();
                document.getElementById("id_kategori").value = "1"; // Pastikan kategori terisi
                popup.style.display = "flex";
            });

            // Tombol "Batal" untuk menutup popup dan mereset ID Teater
            cancelBtnAktor.addEventListener("click", function() {
                form.reset(); // Reset semua input dalam form
                idTeater = null; // Hapus nilai ID Teater
                idAudisi = null;
                popup.style.display = "none"; // Sembunyikan popup
            });
        });

        console.log("Menjalankan script...");

        document.addEventListener('DOMContentLoaded', function() {
            let tipeHarga = document.getElementById('tipe_harga');
            let nominalHarga = document.getElementById('nominal-harga');

            // Tampilkan atau sembunyikan input harga berdasarkan tipe harga
            tipeHarga.addEventListener('change', function() {
                if (this.value === "Bayar") {
                    nominalHarga.style.display = "block";
                } else {
                    nominalHarga.style.display = "none";
                    document.getElementById('harga').value = null; // Kosongkan input harga
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
        });

        function toggleLainnya(select) {
            const lainnyaContainer = document.getElementById("lainnya-container");
            const kotaInput = document.getElementById("kota-input");

            if (select.value === "lainnya") {
                lainnyaContainer.style.display = "block";
                kotaInput.required = true;
                kotaInput.focus();
            } else {
                lainnyaContainer.style.display = "none";
                kotaInput.required = false;
                kotaInput.value = "";
            }
        }

        document.getElementById("kota-select")?.addEventListener("change", function() {
            toggleLainnya(this);
        });

        /** ✅ FIX: updateKotaValue() */
        function updateKotaValue(input) {
            document.getElementById("hidden-kota").value = input.value;
        }

        document.getElementById("kota-input")?.addEventListener("input", function() {
            updateKotaValue(this);
        });

        //schedule
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

            if (!tanggal || !waktuMulai || !waktuSelesai || !kota || !tempat || !tipeHarga) {
                alert("Mohon lengkapi semua field.");
                return;
            }

            // Validasi harga jika memilih "Bayar"
            if (tipeHarga === "Bayar") {
                let hargaNominal = parseInt(harga.replace(/,/g, ''), 10);
                if (!hargaNominal || hargaNominal <= 0) {
                    alert("Harga harus diisi dengan angka yang valid.");
                    return;
                }
            }

            let draftText = (tipeHarga === "Gratis") ?
                "Gratis" : harga;

            // Simpan data dalam bentuk JSON
            let newSchedule = {
                tanggal: tanggal,
                waktu_mulai: waktuMulai,
                waktu_selesai: waktuSelesai,
                tipe_harga: tipeHarga,
                harga: (tipeHarga.value === "Gratis") ? null : harga,
                kota: kota,
                tempat: tempat,
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

                let updatedSchedules = currentSchedules.filter(schedule =>
                    !(schedule.tanggal === tanggal &&
                        schedule.waktu_mulai === waktuMulai &&
                        schedule.waktu_selesai === waktuSelesai &&
                        schedule.tipe_harga === tipeHarga &&
                        schedule.harga === (tipeHarga === "Gratis" ? null : harga) &&
                        schedule.kota === kota &&
                        schedule.tempat === tempat)
                );

                hiddenInput.value = JSON.stringify(updatedSchedules);
                console.log("Updated Hidden Input Value (JSON):", hiddenInput.value);
            });
        });

        //mitra
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch daftar mitra yang sudah di-approve
            fetch('<?= base_url('teater/getApprovedMitra') ?>')
                .then(response => response.json())
                .then(data => {
                    console.log('Data mitra aktor diterima:', data); // Debugging

                    let selectMitra = document.getElementById('mitra_teater_aktor');
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

        //web
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

        //staff
        document.addEventListener("DOMContentLoaded", function() {
            const popup = document.getElementById("auditionPopupStaff"); // ID Popup
            const popupTitle = document.getElementById("popupTitleStaff"); // Judul Popup
            const form = document.getElementById("auditionFormStaff"); // Form di dalam popup
            const addShowBtn = document.getElementById("addAuditionStaffBtn"); // Tombol untuk membuka popup
            const cancelBtn = document.getElementById("cancelBtnStaff"); // Tombol batal

            // Fungsi untuk mengirim form via AJAX dan mendapatkan id_teater
            form.addEventListener("submit", function(e) {
                e.preventDefault(); // Mencegah reload halaman

                let formData = new FormData(this);

                fetch("/CodeIgniter4/public/Admin/saveAuditionStaff", {
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

            // Buka popup "Tambah Audisi Staff"
            document.getElementById("addAuditionStaffBtn").addEventListener("click", () => {
                popupTitle.textContent = "Tambah Audisi Staff";
                form.reset();
                document.getElementById("id_kategori").value = "2"; // Pastikan kategori terisi
                popup.style.display = "flex";
            });

            // Tombol "Batal" untuk menutup popup dan mereset ID Teater
            cancelBtnStaff.addEventListener("click", function() {
                form.reset(); // Reset semua input dalam form
                idTeater = null; // Hapus nilai ID Teater
                idAudisi = null;
                popup.style.display = "none"; // Sembunyikan popup
            });
        });

        function copySosmed() {
            const mitraSelect = document.getElementById("mitra_teater_aktor");
            const checkbox = document.getElementById("same-sosmed");
            const draftContainer = document.getElementById("draft-accounts");
            const hiddenInput = document.querySelector('input[name="hidden_accounts"]');

            // Cek apakah elemen ditemukan sebelum digunakan
            if (!mitraSelect || !checkbox || !draftContainer || !hiddenInput) {
                console.error("Elemen yang dibutuhkan tidak ditemukan! Pastikan mitra_teater_aktor, same-sosmed, draft-accounts, dan hidden_accounts ada.");
                return;
            }

            if (!checkbox.checked) return; // Jika checkbox tidak dicentang, keluar dari fungsi

            const mitraId = mitraSelect.value;
            if (!mitraId) {
                alert("Pilih mitra terlebih dahulu!");
                checkbox.checked = false;
                return;
            }

            fetch(`/CodeIgniter4/public/teater/getMitraSosmed/${mitraId}`)
                .then((response) => response.json())
                .then((data) => {
                    console.log("Data sosial media mitra yang diterima:", data);

                    if (data.length > 0) {
                        let hiddenData = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

                        data.forEach((item) => {
                            // Cek apakah sosial media ini sudah ada dalam daftar
                            const existing = hiddenData.some((d) => d.platformId === item.id_platform_sosmed);
                            if (existing) return;

                            let draftItem = document.createElement("div");
                            draftItem.classList.add("draft-item");
                            draftItem.innerHTML = `
                        <span title="${item.platform_name}">${item.platform_name}</span> - 
                        <span title="${item.acc_mitra}">${item.acc_mitra}</span>
                        <button type="button" class="delete-draft-btn">x</button>
                    `;

                            draftContainer.appendChild(draftItem);

                            // Simpan data ke hidden input
                            hiddenData.push({
                                platformId: item.id_platform_sosmed,
                                platformName: item.platform_name,
                                account: item.acc_mitra,
                            });

                            hiddenInput.value = JSON.stringify(hiddenData);

                            // Tambahkan event listener untuk hapus item draft
                            draftItem.querySelector(".delete-draft-btn").addEventListener("click", function() {
                                draftItem.remove();
                                hiddenData = hiddenData.filter(
                                    (d) => !(d.account === item.acc_mitra && d.platformName === item.platform_name)
                                );
                                hiddenInput.value = JSON.stringify(hiddenData);
                                console.log("Draft sosial media setelah dihapus:", hiddenData);
                            });
                        });

                        console.log("Draft sosial media setelah ditambahkan:", hiddenData);
                    } else {
                        alert("Mitra ini tidak memiliki sosial media yang terhubung.");
                        checkbox.checked = false;
                    }
                })
                .catch((error) => console.error("Error fetching mitra sosmed:", error));
        }

        // Pastikan event listener hanya ditambahkan jika elemen ada
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("same-sosmed");
            if (checkbox) {
                checkbox.addEventListener("change", copySosmed);
            }
        });


        console.log("Script telah berjalan dengan baik.");

        // Edit Audisi berdasarkan kategori
        // document.querySelectorAll(".editBtnStaff").forEach((btn) => {
        //     btn.addEventListener("click", () => {
        //         const category = document.getElementById('id_kategori'); // Ambil kategori dari data tombol

        //         if (category = 1) {
        //             popupTitleAktor.textContent = "Edit Audisi Aktor";

        //             //Set nilai form Aktor (dummy data)
        //             document.getElementById('judul').value = 'Perahu Kertas';
        //             document.getElementById('sinopsis').value = 'Ini adalah sinopsis audisi.';
        //             document.getElementById('karakter_audisi').value = 'Usagi (The Rabbit)';
        //             document.getElementById('deskripsi_karakter').value = 'Bertampang polos, namun memiliki niat tersembunyi kepada Arisu.';
        //             document.getElementById('syarat').value = 'Perempuan berusia 12 - 16 tahun dan konsisten terhadap perannya.';
        //             document.getElementById('syarat_dokumen').value = '-';
        //             document.getElementById('tanggal').value = '2024-09-12';
        //             document.getElementById('waktu').value = '15:00';
        //             document.getElementById('kota').value = 'Tangerang';
        //             document.getElementById('tempat').value = 'Aula Teater Garuda Krisna, Jakarta';
        //             document.getElementById('harga').value = '';
        //             document.getElementById('gaji').value = 500000;
        //             document.getElementById('sutradara').value = 'Willy Santoso';
        //             document.getElementById('penulis').value = 'Windy Panduwara';
        //             document.getElementById('staff').value = 'Bagong Puripurna, Lulu Lunita, Cepri Tagor, Linda Putu';
        //             document.getElementById('komitmen').value = 'Tidak boleh telat, bertahan hingga hari terakhir penayangan.';
        //             document.getElementById('platform_name').value = 'Instagram';
        //             document.getElementById('acc_name').value = '@eslilincilacapproduction';
        //             document.getElementById('judul_web').value = 'Komunitas Teater Official';
        //             document.getElementById('url_web').value = 'https://www.nsi.com';

        //             popupAktor.style.display = "flex";
        //         } else if (category = 2) {
        //             popupTitleStaff.textContent = "Edit Audisi Staff";

        //             // Set nilai form Staff (dummy data)
        //             document.getElementById('judul').value = 'Perahu Kertas';
        //             document.getElementById('sinopsis').value = 'Ini adalah sinopsis audisi.';
        //             document.getElementById('jenis_staff').value = 'Tata Lampu';
        //             document.getElementById('jobdesc_staff').value = 'Mengatur lightning';
        //             document.getElementById('syarat').value = 'Perempuan berusia 12 - 16 tahun dan konsisten terhadap perannya.';
        //             document.getElementById('syarat_dokumen').value = '-';
        //             document.getElementById('waktu').value = '2024-09-12T15:00';
        //             document.getElementById('tempat').value = 'Aula Teater Garuda Krisna, Jakarta';
        //             document.getElementById('harga').value = '';
        //             document.getElementById('gaji').value = 500000;
        //             document.getElementById('sutradara').value = 'Willy Santoso';
        //             document.getElementById('penulis').value = 'Windy Panduwara';
        //             document.getElementById('staff').value = 'Bagong Puripurna, Lulu Lunita, Cepri Tagor, Linda Putu';
        //             document.getElementById('komitmen').value = 'Tidak boleh telat, bertahan hingga hari terakhir penayangan.';
        //             document.getElementById('platform_name').value = 'Instagram';
        //             document.getElementById('acc_name').value = '@eslilincilacapproduction';
        //             document.getElementById('judul_web').value = 'Komunitas Teater Official';
        //             document.getElementById('url_web').value = 'https://www.nsi.com';

        //             popupStaff.style.display = "flex";
        //         }
        //     });
        // });
    </script>
</body>

</html>
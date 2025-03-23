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

    <!-- PopUp Aktor -->
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

            // harga
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

            //web    
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

        document.getElementById("kota-select")?.addEventListener("change", function() {
            const hiddenKota = document.getElementById("hidden-kota");
            const lainnyaContainer = document.getElementById("lainnya-container");
            const kotaInput = document.getElementById("kota-input");

            if (this.value === "lainnya") {
                lainnyaContainer.style.display = "block"; // Tampilkan input tambahan
                kotaInput.required = true; // Wajib diisi
                kotaInput.focus(); // Otomatis fokus ke input
                hiddenKota.value = kotaInput.value; // Pastikan nilai hidden-kota selalu diperbarui
            } else {
                lainnyaContainer.style.display = "none"; // Sembunyikan input tambahan
                kotaInput.required = false; // Tidak wajib diisi
                kotaInput.value = ""; // Reset input teks
                hiddenKota.value = this.value; // Ambil nilai dari select
            }
        });

        // Update hidden-kota jika user mengetik di input "Lainnya"
        document.getElementById("kota-input")?.addEventListener("input", function() {
            document.getElementById("hidden-kota").value = this.value;
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

        document.getElementById("add-account-btn")?.addEventListener("click", function() {
            const platformSelect = document.querySelector('select[name="id_platform_sosmed[]"]');
            const accInput = document.querySelector('input[name="acc_name[]"]');
            const draftContainer = document.getElementById("draft-accounts");
            const hiddenInput = document.querySelector('input[name="hidden_accounts"]');

            const platformId = platformSelect?.value;
            const platformName = platformSelect?.options[platformSelect.selectedIndex]?.textContent;
            const accName = accInput?.value.trim();

            // Validasi
            if (!platformId || !accName) {
                alert("Silakan pilih platform dan isi nama akun.");
                return;
            }

            let data = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

            // Cek duplikat berdasarkan kombinasi platform + akun
            const isDuplicate = data.some(item => item.platformId === platformId && item.account === accName);
            if (isDuplicate) {
                alert("Sosial media ini sudah ditambahkan.");
                return;
            }

            // Buat elemen draft baru
            const draftItem = document.createElement("div");
            draftItem.classList.add("draft-item");
            draftItem.innerHTML = `
        <span>${platformName}</span> - 
        <span>${accName}</span>
        <button type="button" class="delete-draft-btn">x</button>
    `;

            // Event untuk menghapus item
            draftItem.querySelector(".delete-draft-btn").addEventListener("click", function() {
                draftItem.remove();
                data = data.filter(item => !(item.platformId === platformId && item.account === accName));
                hiddenInput.value = JSON.stringify(data);
            });

            // Tambahkan ke draft container
            draftContainer.appendChild(draftItem);

            // Tambahkan ke hidden input
            data.push({
                platformId,
                platformName,
                account: accName
            });
            hiddenInput.value = JSON.stringify(data);

            // Kosongkan input
            platformSelect.selectedIndex = 0;
            accInput.value = "";
        });

        // console.log("Script telah berjalan dengan baik.");
    </script>

    <!-- PopUp Staff -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const baseUrl = window.location.origin + "/CodeIgniter4/public";

            let idTeaterStaff = null;
            let idAudisiStaff = null;

            const popup = document.getElementById("auditionPopupStaff");
            const popupTitle = document.getElementById("popupTitleStaff");
            const form = document.getElementById("auditionFormStaff");
            const cancelBtn = document.getElementById("cancelBtnStaff");

            // Submit form audisi staff
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                fetch(`${baseUrl}/Admin/saveAuditionStaff`, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Server Response:", data);
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

            // Buka popup audisi staff
            document.getElementById("addAuditionStaffBtn")?.addEventListener("click", () => {
                popupTitle.textContent = "Tambah Audisi Staff";
                form.reset();
                document.getElementById("id_kategori").value = "2";
                popup.style.display = "flex";
            });

            // Tombol batal
            cancelBtn.addEventListener("click", function() {
                form.reset();
                idTeaterStaff = null;
                idAudisiStaff = null;
                popup.style.display = "none";
            });

            // Fetch daftar mitra yang sudah di - approve
            fetch('<?= base_url('teater/getApprovedMitra') ?>')
                .then(response => response.json())
                .then(data => {
                    console.log('Data mitra staff diterima:', data); // Debugging

                    let selectMitra = document.getElementById('mitra_teater_staff');
                    selectMitra.innerHTML = '<option value="">Pilih Mitra Teater</option>'; // Reset opsi

                    data.forEach(mitra => {
                        let option = document.createElement('option');
                        option.value = mitra.id_mitra;
                        option.textContent = mitra.nama;
                        selectMitra.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching mitra:', error));

            // Tipe Harga
            const tipeHarga = document.getElementById("tipe_harga_staff");
            const nominalHarga = document.getElementById("nominal-harga-staff");
            const hargaInput = document.getElementById("harga_staff");

            tipeHarga?.addEventListener("change", function() {
                if (this.value === "Bayar") {
                    nominalHarga.style.display = "block";
                } else {
                    nominalHarga.style.display = "none";
                    hargaInput.value = null;
                }
            });

            // Kota lainnya
            const kotaSelect = document.getElementById("kota-select-staff");
            const kotaInput = document.getElementById("kota-input-staff");
            const hiddenKota = document.getElementById("hidden-kota-staff");

            kotaSelect?.addEventListener("change", function() {
                if (this.value === "lainnya") {
                    document.getElementById("lainnya-container-staff").style.display = "block";
                    kotaInput.required = true;
                    kotaInput.focus();
                    hiddenKota.value = kotaInput.value;
                } else {
                    document.getElementById("lainnya-container-staff").style.display = "none";
                    kotaInput.required = false;
                    kotaInput.value = "";
                    hiddenKota.value = this.value;
                }
            });

            kotaInput?.addEventListener("input", function() {
                hiddenKota.value = this.value;
            });

            // Tambah Jadwal
            document.getElementById("addScheduleStaff")?.addEventListener("click", function() {
                const tanggal = document.getElementById("tanggal_staff").value;
                const waktuMulai = document.getElementById("waktu_mulai_staff").value;
                const tipe = document.getElementById("tipe_harga_staff").value;
                const harga = document.getElementById("harga_staff").value.trim();
                const kotaSelect = document.getElementById("kota-select-staff");
                const kotaInput = document.getElementById("kota-input-staff");
                const kota = kotaSelect.value === "lainnya" ? kotaInput.value : kotaSelect.value;
                const tempat = document.getElementById("tempat_staff").value.trim();

                // Validasi wajib diisi
                if (!tanggal || !waktuMulai || !kota || !tempat || !tipe) {
                    alert("Mohon lengkapi semua field.");
                    return;
                }

                // Validasi harga jika pilih "Bayar"
                if (tipe === "Bayar") {
                    const hargaNominal = parseInt(harga.replace(/,/g, ""), 10);
                    if (!hargaNominal || hargaNominal <= 0) {
                        alert("Harga harus diisi dengan angka yang valid.");
                        return;
                    }
                }

                const scheduleText = (tipe === "Gratis") ? "Gratis" : `Rp ${harga}`;

                const newSchedule = {
                    tanggal: tanggal,
                    waktu_mulai: waktuMulai,
                    waktu_selesai: null, // karena tidak digunakan
                    tipe_harga: tipe,
                    harga: (tipe === "Gratis") ? null : harga,
                    kota: kota,
                    tempat: tempat
                };

                const hiddenInput = document.querySelector('input[name="hidden_schedule_staff"]');
                let currentSchedules = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];
                currentSchedules.push(newSchedule);
                hiddenInput.value = JSON.stringify(currentSchedules);

                const draftContainer = document.getElementById("draft-schedule-staff");
                const item = document.createElement("div");
                item.classList.add("draft-schedule-item");
                item.innerHTML = `
        <p><strong>${tanggal}, ${waktuMulai}</strong></p>
        <p>${scheduleText}</p>
        <p>${kota} - ${tempat}</p>
        <button type="button" class="delete-draft-btn">x</button>
    `;

                item.querySelector(".delete-draft-btn").addEventListener("click", () => {
                    draftContainer.removeChild(item);
                    currentSchedules = currentSchedules.filter(s =>
                        !(s.tanggal === tanggal && s.waktu_mulai === waktuMulai && s.kota === kota && s.tempat === tempat)
                    );
                    hiddenInput.value = JSON.stringify(currentSchedules);
                });

                draftContainer.appendChild(item);
            });


            // Salin sosial media dari mitra
            document.getElementById("same-sosmed-staff")?.addEventListener("change", function() {
                const mitraId = document.getElementById("mitra_teater_staff").value;
                const checkbox = this;
                const draftContainer = document.getElementById("draft-accounts-staff");
                const hiddenInput = document.getElementById("hidden_accounts_staff");

                if (!checkbox.checked) return;
                if (!mitraId) {
                    alert("Pilih mitra terlebih dahulu.");
                    checkbox.checked = false;
                    return;
                }

                fetch(`${baseUrl}/teater/getMitraSosmed/${mitraId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.length === 0) {
                            alert("Mitra ini tidak memiliki sosial media.");
                            checkbox.checked = false;
                            return;
                        }

                        let hiddenData = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

                        data.forEach(item => {
                            if (hiddenData.some(d => d.platformId === item.id_platform_sosmed)) return;

                            const draftItem = document.createElement("div");
                            draftItem.classList.add("draft-item");
                            draftItem.innerHTML = `
                        <span>${item.platform_name}</span> - 
                        <span>${item.acc_mitra}</span>
                        <button type="button" class="delete-draft-btn">x</button>
                    `;

                            draftItem.querySelector(".delete-draft-btn").addEventListener("click", () => {
                                draftItem.remove();
                                hiddenData = hiddenData.filter(d => d.account !== item.acc_mitra);
                                hiddenInput.value = JSON.stringify(hiddenData);
                            });

                            draftContainer.appendChild(draftItem);
                            hiddenData.push({
                                platformId: item.id_platform_sosmed,
                                platformName: item.platform_name,
                                account: item.acc_mitra
                            });

                            hiddenInput.value = JSON.stringify(hiddenData);
                        });
                    })
                    .catch(err => {
                        console.error("Gagal fetch sosmed mitra:", err);
                        alert("Terjadi kesalahan mengambil data sosial media.");
                    });
            });

            document.getElementById("add-account-btn-staff")?.addEventListener("click", function() {
                const platformSelect = document.querySelector('select[name="id_platform_sosmed_staff[]"]');
                const accInput = document.querySelector('input[name="acc_name_staff[]"]');
                const draftContainer = document.getElementById("draft-accounts-staff");
                const hiddenInput = document.getElementById("hidden_accounts_staff");

                const platformId = platformSelect.value;
                const platformName = platformSelect.options[platformSelect.selectedIndex]?.textContent.trim();
                const accName = accInput.value.trim();

                // Validasi input
                if (!platformId || !accName) {
                    alert("Silakan pilih platform dan isi nama akun.");
                    return;
                }

                // Ambil data lama dari hidden input
                let data = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

                // Cegah duplikat akun sosial media
                const isDuplicate = data.some(d => d.platformId === platformId && d.account === accName);
                if (isDuplicate) {
                    alert("Sosial media ini sudah ditambahkan.");
                    return;
                }

                // Buat draft item
                const draftItem = document.createElement("div");
                draftItem.classList.add("draft-item");
                draftItem.innerHTML = `
        <span>${platformName}</span> - 
        <span>${accName}</span>
        <button type="button" class="delete-draft-btn">x</button>
    `;

                // Event hapus draft
                draftItem.querySelector(".delete-draft-btn").addEventListener("click", () => {
                    draftItem.remove();
                    data = data.filter(d => !(d.platformId === platformId && d.account === accName));
                    hiddenInput.value = JSON.stringify(data);
                });

                draftContainer.appendChild(draftItem);

                // Update hidden input
                data.push({
                    platformId,
                    platformName,
                    account: accName
                });
                hiddenInput.value = JSON.stringify(data);

                // Reset input
                platformSelect.selectedIndex = 0;
                accInput.value = "";
            });


            // Tambah Website
            document.getElementById("add-web-btn-staff")?.addEventListener("click", () => {
                const titleInput = document.querySelector('input[name="judul_web_staff[]"]');
                const urlInput = document.querySelector('input[name="url_web_staff[]"]');
                const draftContainer = document.getElementById("draft-web-staff");
                const hiddenInput = document.querySelector('input[name="hidden_web_staff"]');

                const title = titleInput.value.trim();
                const url = urlInput.value.trim();

                if ((title && !url) || (!title && url)) {
                    alert("Isi kedua kolom Website (Judul dan URL) atau biarkan kosong.");
                    return;
                }

                if (!title && !url) return;

                const draftItem = document.createElement("div");
                draftItem.classList.add("draft-item");
                draftItem.setAttribute("data-title", title);
                draftItem.setAttribute("data-url", url);
                draftItem.innerHTML = `
            <span>${title}</span> - 
            <span>${url}</span>
            <button type="button" class="delete-draft-btn">x</button>
        `;

                draftItem.querySelector(".delete-draft-btn").addEventListener("click", () => {
                    draftItem.remove();
                    const items = draftContainer.querySelectorAll(".draft-item");
                    const data = Array.from(items).map(item => ({
                        title: item.getAttribute("data-title"),
                        url: item.getAttribute("data-url")
                    }));
                    hiddenInput.value = JSON.stringify(data);
                });

                draftContainer.appendChild(draftItem);

                const allItems = draftContainer.querySelectorAll(".draft-item");
                const webData = Array.from(allItems).map(item => ({
                    title: item.getAttribute("data-title"),
                    url: item.getAttribute("data-url")
                }));
                hiddenInput.value = JSON.stringify(webData);

                titleInput.value = "";
                urlInput.value = "";
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="eng">

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
    <!-- footer area end -->

    <?php if (isset($needsDropdown) && $needsDropdown === true) : ?>
        <script src="<?= base_url('assets/js/dropdown-navbar.js') ?>"></script>
    <?php endif; ?>


    <!-- all plugins here -->
    <script data-cfasync="false" src="<?= base_url('assets/js/email-decode.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/appear.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/imageload.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/slick.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/search-filter-pertunjukan.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $('.poster-carousel').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                arrows: true,
                dots: false,
                centerMode: false,
                variableWidth: false,

                prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',

                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });

        document.querySelectorAll('.teater-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>

    <script>
        function showLoginPopup() {
            document.getElementById("loginPopup").style.display = "flex";
        }

        function closeLoginPopup() {
            document.getElementById("loginPopup").style.display = "none";
        }
    </script>

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
        document.getElementById("btnPesan").addEventListener("click", function() {
            document.getElementById("popupKonfirmasi").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        });

        document.getElementById("btnTidak").addEventListener("click", function() {
            document.getElementById("popupKonfirmasi").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        });

        document.getElementById("btnYa").addEventListener("click", function() {
            localStorage.setItem("pendingUpload", "true"); // Simpan status
            window.location.href = "https://website-pendaftaran.com";
        });

        window.onload = function() {
            if (localStorage.getItem("pendingUpload") === "true") {
                document.getElementById("popupUpload").style.display = "block";
                document.getElementById("overlay").style.display = "block";
            }
        };

        document.getElementById("btnBatalUpload").addEventListener("click", function() {
            document.getElementById("popupUpload").style.display = "none";
            document.getElementById("overlay").style.display = "none";
            localStorage.removeItem("pendingUpload");
        });

        document.getElementById("btnUpload").addEventListener("click", function() {
            alert("Bukti pembayaran berhasil diupload!");
            document.getElementById("popupUpload").style.display = "none";
            document.getElementById("overlay").style.display = "none";
            localStorage.removeItem("pendingUpload");
        });

        // Buka popup saat tombol "Upload Tiket" diklik
        document.getElementById("btnUploadBukti").addEventListener("click", function() {
            document.getElementById("popupUploadBukti").style.display = "block";
            document.getElementById("overlay").style.display = "block"; // pastikan ada elemen overlay jika ingin efek blur
        });

        // Tutup popup saat tombol "Batal" diklik
        function closePopup() {
            document.getElementById("popupUploadBukti").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMB Kampus 2026 - Penerimaan Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #fff8e7 0%, #fff 100%);
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .timeline-wrapper {
            position: relative;
            padding: 20px 0;
        }

        .timeline-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #f4b400, #ffd54f, #f4b400);
            transform: translateY(-50%);
            z-index: 0;
        }

        @media (max-width: 768px) {
            .timeline-line {
                display: none;
            }
        }

        .timeline-step {
            background: white;
            border-radius: 20px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            height: 100%;
            border-bottom: 4px solid #f4b400;
        }

        .timeline-step:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .step-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #f4b400, #ffd54f);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 20px;
        }

        .step-number {
            position: absolute;
            top: -12px;
            right: 15px;
            background: #1f1f1f;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-warning-custom {
            background: #f4b400;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-warning-custom:hover {
            background: #d89c00;
            transform: translateY(-2px);
            color: white;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 45px;
            color: #f4b400;
            margin-bottom: 20px;
        }

        .about-section {
            background: #1f1f1f;
            color: white;
            padding: 80px 0;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include 'layouts/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-3">
                        Penerimaan <span class="text-warning">Mahasiswa Baru</span>
                        <br>2026
                    </h1>
                    <p class="lead text-secondary mb-4">
                        Sistem PMB online modern, cepat, mudah, dan transparan untuk calon mahasiswa baru.
                        Daftarkan dirimu sekarang dan raih masa depan cerah!
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="auth/register.php" class="btn btn-warning-custom">
                            <i class="bi bi-person-plus-fill"></i> Daftar Sekarang
                        </a>
                        <a href="#alur" class="btn btn-outline-dark rounded-pill px-4 py-2">
                            <i class="bi bi-arrow-down"></i> Lihat Alur
                        </a>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex gap-4">
                            <div><i class="bi bi-check-circle-fill text-warning"></i> Gratis Pendaftaran</div>
                            <div><i class="bi bi-check-circle-fill text-warning"></i> Proses Cepat</div>
                            <div><i class="bi bi-check-circle-fill text-warning"></i> Transparan</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="assets/img/hero.png" class="img-fluid" alt="Hero Image" onerror="this.src='https://placehold.co/600x500/f4b400/white?text=PMB+Kampus'">
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran Section -->
    <section id="alur" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-warning text-dark px-3 py-2 mb-2">ALUR PENDAFTARAN</span>
                <h2 class="fw-bold display-6">Bagaimana Cara Mendaftar?</h2>
                <p class="text-secondary">Ikuti langkah-langkah mudah berikut untuk menjadi mahasiswa baru</p>
            </div>

            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="timeline-step">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h5 class="fw-bold">Online Registration</h5>
                        <p class="text-secondary small">Calon mahasiswa mengisi formulir & upload dokumen persyaratan</p>
                        <span class="badge bg-light text-dark mt-2">Pendaftaran Online</span>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="timeline-step">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <h5 class="fw-bold">Document Review</h5>
                        <p class="text-secondary small">Tim verifikasi memeriksa kelengkapan berkas & kriteria</p>
                        <span class="badge bg-light text-dark mt-2">Seleksi Berkas</span>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="timeline-step">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <h5 class="fw-bold">Results Announcement</h5>
                        <p class="text-secondary small">Pengumuman hasil seleksi berkas & ujian masuk</p>
                        <span class="badge bg-light text-dark mt-2">Pengumuman Hasil</span>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="timeline-step">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <h5 class="fw-bold">Reenrollment & Payment</h5>
                        <p class="text-secondary small">Daftar ulang & pembayaran biaya pendaftaran</p>
                        <span class="badge bg-light text-dark mt-2">Daftar Ulang</span>
                    </div>
                </div>
            </div>

            <!-- Additional info -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="alert alert-warning text-center rounded-4">
                        <i class="bi bi-info-circle-fill"></i>
                        <strong>Perhatian!</strong> Pastikan semua data yang diisi benar dan lengkap untuk mempermudah proses seleksi.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Tentang PMB Kampus 2026</h2>
                    <p class="opacity-75">Penerimaan Mahasiswa Baru (PMB) Kampus 2026 adalah sistem seleksi terintegrasi yang dirancang untuk memberikan kemudahan bagi calon mahasiswa dalam proses pendaftaran.</p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-check-circle-fill text-warning fs-4"></i>
                                <span>Proses 100% Online</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-check-circle-fill text-warning fs-4"></i>
                                <span>Update Status Real-time</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-check-circle-fill text-warning fs-4"></i>
                                <span>Bebas Biaya Pendaftaran</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-check-circle-fill text-warning fs-4"></i>
                                <span>Akses 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="feature-card bg-white text-dark">
                                <div class="feature-icon"><i class="bi bi-mortarboard-fill"></i></div>
                                <h5>10+ Program Studi</h5>
                                <p class="small">Pilihan jurusan terakreditasi</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-card bg-white text-dark">
                                <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                                <h5>5000+ Pendaftar</h5>
                                <p class="small">Bergabung setiap tahunnya</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-card bg-white text-dark">
                                <div class="feature-icon"><i class="bi bi-trophy-fill"></i></div>
                                <h5>100+ Beasiswa</h5>
                                <p class="small">Tersedia setiap tahun</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="feature-card bg-white text-dark">
                                <div class="feature-icon"><i class="bi bi-building"></i></div>
                                <h5>Kampus Unggul</h5>
                                <p class="small">Fasilitas lengkap & modern</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'layouts/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
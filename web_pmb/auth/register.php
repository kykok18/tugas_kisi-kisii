<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register PMB</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }

        .auth-box {
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
        }

        .btn-warning {
            background: #f4b400;
            border: none;
        }

        .btn-warning:hover {
            background: #d89c00;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-lg-5">

                <div class="auth-box">

                    <h2 class="fw-bold text-center mb-4">
                        Register PMB
                    </h2>

                    <form action="proses_register.php" method="POST">

                        <div class="mb-3">

                            <label>Nama Lengkap</label>

                            <input type="text"
                                name="nama"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button class="btn btn-warning w-100 py-2 text-white">
                            Register
                        </button>

                    </form>

                    <p class="text-center mt-3">
                        Sudah punya akun?
                        <a href="login.php">
                            Login
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
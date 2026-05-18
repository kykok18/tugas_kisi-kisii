<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login PMB</title>

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
            background: linear-gradient(135deg,
                    #f4b400,
                    #ffd95c);
        }

        .auth-box {
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .btn-warning {
            background: #f4b400;
            border: none;
        }

        .btn-warning:hover {
            background: #d89c00;
        }

        .captcha-box {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #ddd;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-lg-5">

                <div class="auth-box">

                    <div class="text-center mb-4">

                        <h2 class="fw-bold">
                            Login PMB
                        </h2>

                        <p class="text-secondary">
                            Silahkan login ke akun anda
                        </p>

                    </div>

                    <form action="proses_login.php" method="POST">

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

                        <div class="mb-3">

                            <label>Captcha</label>

                            <div class="captcha-box mb-2">
                                <img src="captcha.php">
                            </div>

                            <input type="text"
                                name="captcha"
                                class="form-control"
                                placeholder="Masukkan captcha"
                                required>

                        </div>

                        <button class="btn btn-warning w-100 py-2 text-white">
                            Login
                        </button>

                    </form>

                    <p class="text-center mt-3">
                        Belum punya akun?
                        <a href="register.php">
                            Register
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
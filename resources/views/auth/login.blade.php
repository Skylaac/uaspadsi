<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SISKK</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #0A1D37, #16345f, #1A2F4A);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .login-title {
            font-weight: 800;
            color: #ffffff;
            text-shadow: 0 2px 6px rgba(0,0,0,0.4);
        }

        label {
            color: #dce4ef;
            font-weight: 500;
        }

        .form-control {
            border-radius: 12px;
            border: none;
            padding: 12px;
        }

        .btn-blue {
            background: #0A1D37;
            border-radius: 12px;
            padding: 12px;
            border: none;
            font-weight: 600;
            color: #fff;
            transition: 0.3s;
        }

        .btn-blue:hover {
            background: #051020;
            transform: scale(1.03);
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: #0A1D37;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        .logo-circle i {
            font-size: 34px;
            color: #dce4ef;
        }
    </style>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="login-card mt-4">

                    <div class="logo-circle">
                        <i class="fa-solid fa-mug-hot"></i>
                    </div>

                    <h2 class="text-center login-title mb-4">
                        SISKK <br>
                        <span style="font-size:15px; font-weight:300; color:#dce4ef;">
                            Sistem Informasi Santai Kawan Kopi
                        </span>
                    </h2>

                    {{-- alert error --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login.proses') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan email">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password">
                        </div>

                        <button type="submit" class="btn btn-blue w-100 mt-2">
                            Login
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>

</body>
</html>

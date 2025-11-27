<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Sistem Peramalan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts & Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
</head>

<body>
    <!-- Loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- Login Form -->
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header text-center mb-4">
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Login</b></h3>
                        </div> {{-- Pesan error atau sukses --}} @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div> @endif @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div> @endif <form method="POST"
                            action="{{ route('login.process') }}"> @csrf <div class="form-group mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group mb-3 position-relative">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" required class="form-control"
                                        placeholder="Password">
                                    <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                                        <i class="feather icon-eye-off" id="eyeIcon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2 mb-4">
                                <a href="{{ route('forgotpassword') }}" class="text-primary text-decoration-none">
                                    Forgot Password? </a>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted mt-4">© {{ date('Y') }} Sistem Peramalan</p>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script>
        // 🌙 Toggle Password Visibility
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        const eyeIcon = document.querySelector("#eyeIcon");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            eyeIcon.classList.toggle("icon-eye");
            eyeIcon.classList.toggle("icon-eye-off");
        });
    </script>
</body>

</html>
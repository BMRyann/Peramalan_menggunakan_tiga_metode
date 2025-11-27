<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { primary: "#0d7ff2" },
                    fontFamily: { display: ["Inter", "sans-serif"] }
                },
            },
        }
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-display">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">🔒 Reset Password</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Masukkan password baru Anda</p>
            </div>

            {{-- ✅ Pesan sukses --}}
            @if (session('status'))
                <div class="bg-green-100 text-green-800 text-sm p-3 rounded-lg mb-4 text-center">
                    {{ session('status') }}
                </div>
            @endif

            {{-- ⚠️ Pesan error --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 text-sm p-3 rounded-lg mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 🔑 Form Reset Password --}}
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Password Baru
                    </label>
                    <input type="password" id="password" name="password"
                        class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-primary focus:border-primary"
                        placeholder="Masukkan password baru" required>
                </div>

                <div class="mb-6">
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-primary focus:border-primary"
                        placeholder="Ketik ulang password" required>
                </div>

                <button type="submit"
                    class="w-full py-2 bg-primary hover:bg-primary/90 text-white font-semibold rounded-lg transition">
                    Simpan Password Baru
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}"
                    class="text-sm text-primary hover:underline flex items-center justify-center gap-1">
                    ← Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</body>

</html>

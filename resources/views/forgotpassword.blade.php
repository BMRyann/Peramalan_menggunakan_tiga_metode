<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { primary: "#0d7ff2" },
                    fontFamily: { display: ["Inter", "sans-serif"] },
                },
            },
        };
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-display transition-all duration-300">
    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <span class="material-symbols-outlined text-6xl text-primary mb-2 animate-pulse">lock_reset</span>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Lupa Password</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Masukkan email Anda untuk mereset password.</p>
            </div>
            <!-- Alert -->
            @if (session('status'))
                <div
                    class="mb-4 px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm rounded-lg text-center">
                    {{ session('status') }}
            </div> @endif <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4"> @csrf <div>
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-primary focus:border-primary placeholder-gray-400 dark:placeholder-gray-500"
                        placeholder="contoh@email.com" required autofocus> @error('email') <p
                        class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                    class="w-full py-2.5 bg-primary hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                    Kirim Link Reset </button>
            </form>
            <!-- Back to login -->
            <div class="text-center mt-6">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center gap-1 text-sm text-primary hover:underline hover:text-blue-700 transition">
                    <span class="material-symbols-outlined text-base">arrow_back</span> Kembali ke Login </a>
            </div>
        </div>
    </div>
</body>

</html>
@extends('layouts.app') @section('title', 'Ubah Password') @section('content') <div
        class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Ubah Password</h2> {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="p-3 mb-4 text-green-800 bg-green-200 rounded">
                {{ session('success') }}
        </div> @endif {{-- Notifikasi error umum --}} @if (session('error'))
            <div class="p-3 mb-4 text-red-800 bg-red-200 rounded">
                {{ session('error') }}
        </div> @endif <form action="{{ route('password.update') }}" method="POST"> @csrf {{-- Password Lama --}} <div
                class="mb-4 relative">
                <label class="block text-gray-700 dark:text-gray-300 mb-1">Password Lama</label>
                <input type="password" name="current_password" id="password_old"
                    class="w-full border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 rounded p-2 pr-10 text-gray-800 dark:text-white">
                <span class="absolute right-3 top-10 cursor-pointer togglePassword" data-target="password_old">
                    <i class="feather icon-eye-off"></i>
                </span> @error('current_password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div> {{-- Password Baru --}} <div class="mb-4 relative">
                <label class="block text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
                <input type="password" name="new_password" id="password_new"
                    class="w-full border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 rounded p-2 pr-10 text-gray-800 dark:text-white">
                <span class="absolute right-3 top-10 cursor-pointer togglePassword" data-target="password_new">
                    <i class="feather icon-eye-off"></i>
                </span> @error('new_password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div> {{-- Konfirmasi Password Baru --}} <div class="mb-4 relative">
                <label class="block text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" id="password_confirm"
                    class="w-full border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 rounded p-2 pr-10 text-gray-800 dark:text-white">
                <span class="absolute right-3 top-10 cursor-pointer togglePassword" data-target="password_confirm">
                    <i class="feather icon-eye-off"></i>
                </span>
            </div>
            <button type="submit" class="bg-primary text-white font-semibold py-2 px-4 rounded-lg hover:bg-primary/80">
                Simpan Perubahan </button>
        </form>
    </div> {{-- JS Toggle Mata --}}
    <script>
        const toggles = document.querySelectorAll('.togglePassword');
        toggles.forEach(icon => {
            icon.addEventListener('click', function () {
                const target = document.getElementById(this.dataset.target);
                const inputType = target.getAttribute('type');

                target.setAttribute('type', inputType === 'password' ? 'text' : 'password');
                this.innerHTML = `<i class="feather ${inputType === 'password' ? 'icon-eye' : 'icon-eye-off'}"></i>`;
            });
        });
</script> @endsection
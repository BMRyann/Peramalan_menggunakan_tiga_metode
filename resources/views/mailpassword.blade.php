<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <div style="background: white; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto;">
        <h2 style="color: #2563eb;">Reset Password Akun Anda</h2>
        <p>Halo, <strong>{{ $user->nama }}</strong>.</p>
        <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda. Klik tombol di bawah ini untuk
            melanjutkan:</p>
        <p style="text-align: center; margin: 20px 0;">
            <a href="{{ $resetLink }}"
                style="background: #2563eb; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px;">
                Atur Ulang Password </a>
        </p>
        <p>Jika Anda tidak meminta pengaturan ulang password, abaikan email ini.</p>
        <p style="color: gray; font-size: 12px;">Terima kasih,<br>Tim {{ config('app.name') }}</p>
    </div>
</body>

</html>
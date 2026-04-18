<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation</title>

    <link href="{{ asset('/css/reset.css') }}" rel="stylesheet">
</head>

<body>
<div class="reset-container">

    <h2>Réinitialiser le mot de passe</h2>

    <form action="{{ route('password.update') }}" method="POST">
    
        @csrf
    
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-box">
            <span class="icon">
                <i class="fas fa-envelope"></i>
            </span>

            <input type="email" name="email" id="email" placeholder="Email" value="{{ $email ?? old('email') }}" required>
        </div>

        <div class="input-box">
            <span class="icon">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" required>
        </div>

        <div class="input-box">
            <span class="icon">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" required>
        </div>

        <button type="submit" class="btn-reset">Réinitialiser</button>

    </form>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>
</html>
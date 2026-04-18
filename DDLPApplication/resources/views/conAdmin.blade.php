<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicons -->
        <link href="{{ asset('/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Satisfy:wght@400&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
        
        <!-- Vendor CSS Files -->
        <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('/css/conAdmin.css') }}" rel="stylesheet">
        
        <title>Connexion</title>
    </head>

    <body>

        <main class="main">
            
            <div class="titre">
                <h1>Connexion administrateur Mairie</h1>
            </div>

            <div class="formulaireCon">
            
                @if($errors->any())
                    <div style="color: red;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('conAdmin') }}" method="POST">
                    @csrf
                    <div class="logo">
                        <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                    </div>
                            
                    <div class="trai"></div>

                    <div>
                        <label for="email">Email de connexion<span>*</span></label>
                        <input type="email" id="email" name="email" required placeholder="Taper votre email de connexion">
                    </div>
                            
                    <div>
                        <label for="password">Mot de Passe <span>*</span></label>
                        <input type="password" id="password" name="password" required placeholder="Saisissez un mot de passe avec 8 caractères">
                    </div>
                            
                    <button id="bouton" type="submit" onmouseover="this.style.backgroundColor='#0056b3'; this.style.color='white';"onmouseout="this.style.backgroundColor='#004B70'; this.style.color='white';">Connexion</button>
                    
                    <p>
                        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    </p>

                    <div class="trai1"></div>

                    <div class="tex">
                        <p><a href="{{ route('admin.createForme') }}">Inscrivez-vous</a></p>
                    </div>
                </form>

            </div>
        </main>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        

        <!-- Vendor JS Files -->
        <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('/vendor/swiper/swiper-bundle.min.js') }}"></script>

        <!-- Main JS File -->
        <script src="{{ asset('/js/conAdmin.js') }}"></script>
    </body>
</html>
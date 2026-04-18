<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Mairie</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

        <!-- Vendor CSS Files -->
        <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('/css/con3.css') }}" rel="stylesheet">

    </head>

    <body class="index-page">

        <div class="container">
            
            <div class="content-container">
               
                <main class="main">

                    <div class="container">

                        <div class="gauche">

                            <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                            <h3>Connectez-vous ou inscrivez-vous en tant qu' Administrateur Mairie</h3>
                        
                        </div>

                        <div class="droite" style="height: 600px;">
                
                            <h1>S'Inscrire</h1>

                            <div class="formu" style="height: 450px;">

                                <style>
                                    .formu form #but{
                                        background-color: #004B70;
                                        color: white;
                                        cursor: pointer;
                                        transition: background-color 0.3s ease, color 0.3s ease;
                                        width: 449px;
                                        height: 40px;
                                        margin-top: 80px;
                                        margin-left: 30px;
                                        padding: 10px;
                                        gap: 10px;
                                        border-radius: 4px;
                                        border: 1px solid #004B70;
                                        font-family: var(--section-font);
                                        font-size: 16px;
                                        font-weight: 600;
                                    }

                                    @media(max-width: 768px){
                                        .formu form #but{
                                            width: 300px;
                                        }
                                    }

                                </style>

                                <form id="createAccountForme" method="POST" action="{{ route('admin.createAdmin') }}" enctype="multipart/form-data">
                                    @csrf

                                    <label for="email">Email<span>*</span></label>
                                    <input type="email" id="email" name="email" placeholder="Taper votre adresse email " required>

                                    <label for="password">Mot de Passe<span>*</span></label>
                                    <input type="password" id="password" placeholder="Taper votre mot de passe" name="password" required>


                                    <button id="but" type="submit" onmouseover="this.style.backgroundColor='#0056b3'; this.style.color='white';" onmouseout="this.style.backgroundColor='#004B70'; this.style.color='white';">Enregistrer</button>
                                </form>

                                <script>

                                    // Activer/Désactiver le bouton de soumission
                                    function toggleSubmitButton() {
                                        const acceptTerms = document.getElementById('acceptTerms');
                                        const submitButton = document.getElementById('submitButton');
                                        submitButton.disabled = !acceptTerms.checked; // Activer si la case est cochée
                                        submitButton.style.cursor = acceptTerms.checked ? 'pointer' : 'not-allowed';
                                    }

                                    // Fonction de soumission
                                    function submitForm(event) {
                                        event.preventDefault();
                                        const form = document.getElementById('createAccountForme');
                                    
                                        fetch(form.action, {
                                            method: 'POST',
                                            body: new FormData(form)
                                        }).then(response => {
                                            if (response.ok) {
                                                alert('Vous avez été enregistrée avec succès');
                                            }
                                        }).catch(error => console.error('Erreur:', error));
                                    }
                                    
                                </script>

                                <div class="trai1"></div>

                                <div class="tex">
                                    <p>Vous êtes déjà inscrit ? <a href="{{ route('conAdmin') }}">Connecter-vous</a></p>
                                </div>
                        
                            </div>

                        </div>

                    </div>
        
                </main> 
            
            </div>
        
        </div>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('/vendor/swiper/swiper-bundle.min.js') }}"></script>

        <!-- Main JS File -->
        <script src="{{ asset('/js/con3.js') }}"></script>
    </body>



</html>
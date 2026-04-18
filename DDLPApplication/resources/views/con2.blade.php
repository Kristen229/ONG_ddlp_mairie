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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

        <!-- Vendor CSS Files -->
        <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('/css/con2.css') }}" rel="stylesheet">

    </head>

    <body class="index-page">

        <div class="container">
            
            <div class="content-container">    

                <main class="main">

                    <div class="container">

                        <div class="gauche">
                            <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                            <h3>Connectez-vous ou inscrivez-vous en tant qu'association ou ONG</h3>
                        </div>

                        <div class="droite">
                            <p>Étape 2 sur 3</p>
                        
                            <h1>S'Inscrire</h1>

                            <div class="formu">
                                
                               <form id="createAccountForme2" method="POST" action="{{ route('user.createUserPartie2') }}" enctype="multipart/form-data">
                                    @csrf

                                    <label for="siege">Siège<span>*</span></label>
                                    <input type="text" id="siege" name="siege" placeholder="Taper ici le siège de l'association ou de l'ONG" required>

                                    <label for="email">Email<span>*</span></label>
                                    <input type="email" id="email" name="email" placeholder="Taper l'adresse email de l’association ou de l’ONG" required>






                                    
                                    
                                    <label for="number1">Numéro de téléphone 1<span>*</span></label>
                                    <input type="tel" id="number1" name="number1" placeholder="Taper le numéro de téléphone de l'association ou de l'ONG" required>

                                    <label for="number2">Numéro de téléphone 2<span>*</span></label>
                                    <input type="tel" id="number2" name="number2" placeholder="Taper le numéro de téléphone de l’association ou de l’ONG">

                                    <label for="identifiant">Identifiant<span>*</span></label>
                                    <input type="text" id="identifiant" placeholder="Taper votre identifiant" name="identifiant" required>
                    
                                    <label for="password">Mot de Passe<span>*</span></label>
                                    <input type="password" id="password" placeholder="Taper votre mot de passe" name="password" required>

                                    <label for="lien">Lien de votre Site Web<span>*</span></label>
                                    <input type="url" id="lien" placeholder="Taper le lien de votre site web" name="lien">

                                    <label for="attachment" class="file-label">
                                        <span class="material-symbols-outlined">add</span>
                                        Pièce jointe
                                    </label>
                                    <input type="file" id="attachment" name="attachment" accept="image/*" required class="file-input">

                                    <button  id="button" type="submit">Continuer</button>
                                </form>


            
                                <script>
                                    function submitForm(event) {
                                        event.preventDefault();
                                        const form = document.getElementById('createAccountForme2');
                                        fetch(form.action, {
                                            method: 'POST',
                                            body: new FormData(form)
                                        }).then(response => {
                                            if (response.ok) {
                                                window.location.href = "{{ route('user.createForme3') }}";
                                            }
                                        }).catch(error => console.error('Erreur:', error));
                                    }
                                </script>

                                <div class="trai1"></div>

                                <div class="tex">
                                    <p>Vous êtes déjà inscrit ? <a href="{{ route('connexion') }}">Connecter-vous</a></p>
                                </div>
                                
                            </div>
                            
                            <div class="but">
                                <button class="btn-with-image" onclick="window.location.href='/user/createForme1';">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                    <span class="btn-text">Retour à la page précédente</span>
                                </button>
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
        <script src="{{ asset('/js/con2.js') }}"></script>
    </body>



</html>
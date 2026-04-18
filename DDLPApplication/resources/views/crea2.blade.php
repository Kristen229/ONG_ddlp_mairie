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
        <link href="{{ asset('/css/crea2.css') }}" rel="stylesheet">

    </head>

    <body class="index-page">

        <div class="container">  

            <div class="content-container">

                <div class="logo">
                    <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                </div>

                <main class="main">

                    <div class="title">

                        <div>
                            <button class="btn-with-image" onclick="window.location.href='/admin';">
                                <span class="material-symbols-outlined" style="color: white;">arrow_back</span>                               
                                <span class="btn-text" style="color: white;">Retour à la page précédente</span>
                            </button>
                        </div>

                    </div>

                    <div class="formu">

                        <div class="formu1">
                            <p>Formulaire d'enregistrement (3/3)</p>
                        </div>

                        <form id="createAccountForm3" method="POST" action="{{ route('admin.createUserType3') }}"  onsubmit="submitForm(event)" enctype="multipart/form-data">
                            @csrf

                            <label for="namePresident">Nom du Président<span>*</span></label>
                            <input type="text" id="namePresident" name="namePresident" placeholder="Taper ici le nom du Président de l’association ou de l’ONG" required>

                            <label for="lastNamePresident">Prénom du Président<span>*</span></label>
                            <input type="text" id="lastNamePresident" name="lastNamePresident" placeholder="Taper ici le prénom du Président de l’association ou de l’ONG" required>

                            <div class="president">
                                <label for="attachment1" class="file-label">
                                    <span class="material-symbols-outlined" style="color: black;">add</span> 
                                    Photo du Président
                                </label>
                                <input type="file" id="attachment1" name="attachment1" accept="image/*" class="file-input">

                                <p>(Fichier image du Président de l’association ou de l’ONG)</p>
                            </div>

                            <div class="trait1"></div>

                            <label for="nameVicePresident">Nom du Vice-Président<span>*</span></label>
                            <input type="text" id="nameVicePresident" name="nameVicePresident" placeholder="Taper ici le nom du Vice-Président de l’association ou de l’ONG" required>

                            <label for="lastNameVicePresident">Prénom du Vice-Président<span>*</span></label>
                            <input type="text" id="lastNameVicePresident" name="lastNameVicePresident" placeholder="Taper ici le prénom du Vice-Président de l’association ou de l’ONG" required>

                            <div class="president">
                                <label for="attachment2" class="file-label">
                                    <span class="material-symbols-outlined" style="color: black;">add</span> 
                                    Photo du Vice-Président
                                </label>
                                <input type="file" id="attachment2" name="attachment2" accept="image/*" class="file-input">

                                <p>(Fichier image du Vice-Président de l’association ou de l’ONG)</p>
                            </div>

                            <div class="trait1"></div>

                            <label for="nameSecretaireGeneral">Nom du Sécrétaire-Général<span>*</span></label>
                            <input type="text" id="nameSecretaireGeneral" name="nameSecretaireGeneral" placeholder="Taper ici le nom du Sécrétaire-Général de l’association ou de l’ONG" required>

                            <label for="lastNameSecretaireGeneral">Prénom du Sécrétaire-Général<span>*</span></label>
                            <input type="text" id="lastNameSecretaireGeneral" name="lastNameSecretaireGeneral" placeholder="Taper ici le prénom du Sécrétaire-Général de l’association ou de l’ONG" required>

                            <div class="president">
                                <label for="attachment3" class="file-label">
                                    <span class="material-symbols-outlined" style="color: black;">add</span> 
                                    Photo du Sécrétaire-Général
                                </label>
                                <input type="file" id="attachment3" name="attachment3" accept="image/*" class="file-input">

                                <p>(Fichier image du Secrétaire-Général de l’association ou de l’ONG)</p>
                            </div>

                            <div class="trait1"></div>

                            <label for="nameTresorierGeneral">Nom du Trésorier-Général<span>*</span></label>
                            <input type="text" id="nameTresorierGeneral" name="nameTresorierGeneral" placeholder="Taper ici le nom du Trésorier-Général de l’association ou de l’ONG" required>

                            <label for="lastNameTresorierGeneral">Prénom du Trésorier-Général<span>*</span></label>
                            <input type="text" id="lastNameTresorierGeneral" name="lastNameTresorierGeneral" placeholder="Taper ici le prénom du Trésorier-Général de l’association ou de l’ONG" required>

                            <div class="president">
                                <label for="attachment4" class="file-label">
                                   <span class="material-symbols-outlined" style="color: black;">add</span> 
                                    Photo du Trésorier-Général
                                </label>
                                <input type="file" id="attachment4" name="attachment4" accept="image/*" class="file-input">

                                <p>(Fichier image du Trésorier-Général de l’association ou de l’ONG)</p>
                            </div>

                            <div class="trait1"></div>

                            <div class="president">
                                <label for="attachment5" class="file-label">
                                    <span class="material-symbols-outlined" style="color: black;">add</span>                                    
                                    Photo de Couverture
                                </label>
                                <input type="file" id="attachment5" name="attachment5" accept="image/*" required class="file-input">

                                <p>(Fichier image)</p>
                            </div>

                            <div class="president">
                                <label for="signature_data" class="file-label">
                                    <span class="material-symbols-outlined" style="color: black;">add</span>                                    
                                    Signature
                                </label>
                                <input type="file" id="signature_data" name="signature_data" accept="image/*" required class="file-input">

                                <p>(Fichier image)</p>
                            </div>

                            <div class="president">
                                <label for="cachet" class="file-label">
                                    <span class="material-symbols-outlined" style="color: black;">add</span>                                    
                                    Cachet
                                </label>
                                <input type="file" id="cachet" name="cachet" accept="image/*" required class="file-input">

                                <p>(Fichier image)</p>
                            </div>
            
                            <div class="button1">
                                <form action="{{ route('admin.createUserType3') }}" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <span class="btn-text">Enregistrer l'Association ou l'ONG</span>
                                    </button>
                                </form>

                            </div>
                            
                        </form>
    
                    </div>

                    <script>
                        function submitForm(event) {
                            event.preventDefault();
                            const form = document.getElementById('createAccountForm3');
                            fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form)
                            }).then(response => {
                                if (response.ok) {
                                    alert('L\'association ou l\'ONG a été enregistrée avec succès');
                                }
                            }).catch(error => console.error('Erreur:', error));
                        }
                    </script>
 
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
        <script src="{{ asset('/js/crea2.js') }}"></script>
    </body>



</html>
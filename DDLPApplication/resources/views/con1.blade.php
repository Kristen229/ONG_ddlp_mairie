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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />

        <!-- Vendor CSS Files -->
        <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- jQuery (requis par Select2) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- CSS Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- JS Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Main CSS File -->
        <link href="{{ asset('/css/con1.css') }}" rel="stylesheet">

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
                            <p>Étape 1 sur 3</p>
                        
                            <h1>S'Inscrire</h1>

                            <div class="formu">

                                <form id="createAccountForme1" method="POST" action="{{ route('user.createUserPartie1') }}" onsubmit="submitForm(event)" enctype="multipart/form-data">
                                    @csrf
                                    <div class="trai"></div>

                                    <label for="groupe">Type de Groupe<span>*</span></label>
                                    <select id="groupe" name="groupe" required>
                                        <option value="" disabled selected>Sélectionner le type de groupe</option>
                                        <option value="ong">ONG</option>
                                        <option value="association">Association</option>
                                    </select>

                                    <label for="name">Nom de l'association ou ONG<span>*</span></label>
                                    <input type="text" id="name" name="name" placeholder="Taper le nom de l'association ou de l'ONG" required>

                                    <label>Domaine<span style="color: red;">*</span></label>

                                    <style>
                                        
                                        .checkbox-group {
                                            display: grid;
                                            grid-template-columns: repeat(3, minmax(120px, max-content));
                                            gap: 6px;
                                            max-width: 50px;
                                            margin-left: -50px;
                                        }

                                        .checkbox-group label {
                                            display: flex;
                                            align-items: flex-start;
                                            gap: 6px;
                                            font-size: 16px;
                                        }

                                        .checkbox-group input[type="checkbox"] {
                                            width: 18px;
                                            height: 18px;
                                        }

                                        /* 📱 Tablette */
                                        @media (max-width: 1024px) {
                                            .checkbox-group {
                                                grid-template-columns: repeat(3, 1fr); /* 3 par ligne */
                                            }
                                        }

                                        /* 📱 Mobile */
                                        @media (max-width: 600px) {
                                            .checkbox-group {
                                                grid-template-columns: repeat(2, 1fr); /* 2 par ligne */
                                            }

                                            .checkbox-group label {
                                                font-size: 14px;
                                            }
                                        }

                                    </style>

                                    <div class="checkbox-group">
                                        <label><input type="checkbox" name="domaine[]" value="Education"> Education</label>
                                        <label><input type="checkbox" name="domaine[]" value="Sociale"> Sociale</label>
                                        <label><input type="checkbox" name="domaine[]" value="Santé"> Santé</label>
                                        <label><input type="checkbox" name="domaine[]" value="Sport"> Sport</label>
                                        <label><input type="checkbox" name="domaine[]" value="Technologie"> Technologie</label>

                                        <label><input type="checkbox" name="domaine[]" value="Environnement"> Environnement</label>
                                        <label><input type="checkbox" name="domaine[]" value="Agricole"> Agricole</label>
                                        <label><input type="checkbox" name="domaine[]" value="Artisanal"> Artisanal</label>
                                        <label><input type="checkbox" name="domaine[]" value="Culturel"> Culturel et Cultuel</label>
                                    </div>


                                    <BR></BR>

                                    <label for="denomination" style="margin-top: -1%;">Dénomination<span>*</span></label>
                                    <input type="text" id="denomination" name="denomination" placeholder="Taper la dénomination de l’association ou de l’ONG" required>

                                    <label for="date">Date de création<span>*</span></label>
                                    <input type="date" id="date" name="date" placeholder="JJ/MM/AAA" required>

                                    <label for="objectif1">Objectif 1<span>*</span></label>
                                    <input type="text" id="objectif1" name="objectif1" placeholder="Taper ici l’objectif 1 de l’association ou de l’ONG" required>

                                    <label for="objectif2">Objectif 2<span>*</span></label>
                                    <input type="text" id="objectif2" name="objectif2" placeholder="Taper ici l’objectif 2 de l’association ou de l’ONG" required>

                                    <label for="objectif3">Objectif 3<span>*</span></label>
                                    <input type="text" id="objectif3" name="objectif3" placeholder="Taper ici l’objectif 3 de l’association ou de l’ONG" required>

                                    <br>
                                    <button id="button" type="submit" onmouseover="this.style.backgroundColor='#0056b3'; this.style.color='white';"onmouseout="this.style.backgroundColor='#004B70'; this.style.color='white';">Continuer</button>
                                </form>
                                
                                <script>
                                    $(document).ready(function() {
                                        $('#domaine').select2({
                                            placeholder: "Sélectionner le(s) domaine(s) d'intervention",
                                            allowClear: true,
                                            width: '100%' // pour bien s'adapter au champ
                                        });
                                    });
                                </script>
                                <script>
                                    function submitForm(event) {
                                        event.preventDefault();
                                        const form = document.getElementById('createAccountForme1');
                                        fetch(form.action, {
                                            method: 'POST',
                                            body: new FormData(form)
                                        }).then(response => {
                                            if (response.ok) {
                                                window.location.href = "{{ route('user.createForme2') }}";
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
                                <button class="btn-with-image" onclick="window.location.href='/connexion';">
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
        <script src="{{ asset('/js/con1.js') }}"></script>
    </body>



</html>
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
        <link href="{{ asset('/css/crea.css') }}" rel="stylesheet">

    </head>

    <body class="index-page">

        <div class="container">

            <div class="content-container">
               
                <main class="main">

                    <div class="logo">
                        <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                    </div>

                    <div class="title">

                        <div>

                            <button class="btn-with-image" onclick="window.location.href='/admin';">

                                <span class="material-symbols-outlined" style="color: white;">arrow_back</span>

                                <span class="btn-text" style="color: white;">Retour à la page précédente</span>

                            </button>

                        </div>

                    </div>

                    <style>
                        form .checkbox-group{
                            display: flex; 
                            flex-wrap: wrap; 
                            gap: 5px; 
                            max-width: 600px; 
                            margin-top: -50px;
                        }

                        form .checkbox-group #one{
                            display: flex; 
                            align-items: center; 
                            margin-left: -50px;
                        }

                        form .checkbox-group #one #part1{
                            display: flex; 
                            align-items: center; 
                            gap: 3px; 
                            cursor: pointer; 
                            width: calc(33.33% - 10px); 
                            user-select: none; 
                            font-size: 16px;
                        }

                        form .checkbox-group #one #part2{
                            display: flex; 
                            align-items: center; 
                            gap: 3px; 
                            cursor: pointer; 
                            width: calc(33.33% - 10px); 
                            user-select: none; 
                            font-size: 16px; 
                            margin-left: -25px;
                        }

                        form .checkbox-group #two{
                            display: flex; 
                            align-items: center; 
                            gap: 3px; 
                            cursor: pointer; 
                            width: calc(33.33% - 10px); 
                            user-select: none; 
                            font-size: 16px; 
                            margin-top: -2px; 
                            margin-left: -2px;
                        }

                        @media(max-width: 768px){
                            form .checkbox-group #one #part1{
                                gap: 1px; 
                                font-size: 14px;
                            }

                            form .checkbox-group #one #part2{
                                gap: 1px;  
                                font-size: 14px; 
                                margin-left: -35px;
                            }

                            form .checkbox-group #two{
                                gap: 1px; 
                                font-size: 14px; 
                                margin-left: -20px;
                            }
                        }

                    </style>

                    <div class="formu">

                        <p>Formulaire d'enregistrement (1/3)</p>

                        <form id="createAccountForm1" method="POST" action="{{ route('admin.createUserType1') }}" onsubmit="submitForm(event)">
                            @csrf
                            <label for="groupe">Type de Groupe<span>*</span></label>
                            <select id="groupe" name="groupe" required>
                                <option value="" disabled selected>Sélectionner le type de groupe</option>
                                <option value="ong">ONG</option>
                                <option value="association">Association</option>
                            </select>

                            <label for="name">Nom de l'association ou ONG<span>*</span></label>
                            <input type="text" id="name" name="name" placeholder="Taper le nom de l'association ou de l'ONG" required>

                            <label>Domaine<span style="color: red;">*</span></label>

                            <div class="checkbox-group">    
                                
                                <div id="one">

                                    <label id="part1">
                                        <input type="checkbox" name="domaine[]" value="Education" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                        Education
                                    </label>

                                    <label id="part2">
                                        <input type="checkbox" name="domaine[]" value="Sociale" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                        Sociale
                                    </label>

                                    <label id="part2">
                                        <input type="checkbox" name="domaine[]" value="Santé" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                        Santé
                                    </label>

                                    <label id="part2">
                                        <input type="checkbox" name="domaine[]" value="Environnement" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                        Environnement
                                    </label>

                                    <label id="part2">
                                        <input type="checkbox" name="domaine[]" value="Sport" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                        Sport
                                    </label>

                                    <label id="part2">
                                        <input type="checkbox" name="domaine[]" value="Agricole" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                        Agricole
                                    </label>
                        
                                </div>

                                <label id="two">
                                    <input type="checkbox" name="domaine[]" value="Technologie" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                    Technologie
                                </label>

                                <label id="two">
                                    <input type="checkbox" name="domaine[]" value="Artisanal" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                    Artisanal
                                </label>

                                <label id="two" style="width: 210px;">
                                    <input type="checkbox" name="domaine[]" value="Culturel et Cultuel" style="width: 18px; height: 18px; vertical-align: middle; margin-top: -30px;">
                                    Culturel et Cultuel
                                </label>

                            </div>

                            <label for="denomination">Dénomination<span>*</span></label>
                            <input type="text" id="denomination" name="denomination" placeholder="Taper la dénomination de l’association ou de l’ONG" required>

                            <label for="date">Date de création<span>*</span></label>
                            <input type="date" id="date" name="date" placeholder="JJ/MM/AAA" required>

                            <label for="objectif1">Objectif 1<span>*</span></label>
                            <input type="text" id="objectif1" name="objectif1" placeholder="Taper ici l’objectif 1 de l’association ou de l’ONG" required>

                            <label for="objectif2">Objectif 2<span>*</span></label>
                            <input type="text" id="objectif2" name="objectif2" placeholder="Taper ici l’objectif 2 de l’association ou de l’ONG" required>

                            <label for="objectif3">Objectif 3<span>*</span></label>
                            <input type="text" id="objectif3" name="objectif3" placeholder="Taper ici l’objectif 3 de l’association ou de l’ONG" required>

                            <div class="button1">
                                <button type="submit">
                                    <span class="btn-text">Page suivante</span>
                                    <img src="{{ asset('/img1/droit.png') }}" alt="Icône" class="btn-icone">
                                </button>
                            </div>
                            
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
                                const form = document.getElementById('createAccountForm1');
                                fetch(form.action, {
                                    method: 'POST',
                                    body: new FormData(form)
                                }).then(response => {
                                    if (response.ok) {
                                        window.location.href = "{{ route('admin.createForm2') }}";
                                    }
                                }).catch(error => console.error('Erreur:', error));
                            }

                        </script>

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
        <script src="{{ asset('/js/crea.js') }}"></script>
    </body>



</html>
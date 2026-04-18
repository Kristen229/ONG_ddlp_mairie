<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Mairie</title>
        <meta name="description" content="">
        <meta name="keywords" content="">

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
        <link href="{{ asset('/css/associationPage.css') }}" rel="stylesheet">

    </head>

    <body class="index-page">
        
        <main class="main">

            <div>

                <button id="button1" class="btn-with-image" onclick="window.location.href='/admin';">
                    
                    <span class="material-symbols-outlined">arrow_back</span>                    
                    <span class="btn-text">Retour</span>

                </button>

            </div>

            <div class="espoir-title">

                <div class="logo">
                    <img src="{{ asset('storage/' . $user->attachment) }}" alt="Logo">
                </div>

                <div class="texte">
                    <h2>{{ $user->name }}</h2> 
                    <p>{{ $user->domaine }}</p> 
                </div>

                <div>

                    <button class="btn-with-image" onclick="window.location.href='{{ $user->lien }}';">
                        <span class="btn-texte">Visiter leur site web</span>
                        <span class="material-symbols-outlined" style="color: white;">arrow_forward</span>                    
                    </button>

                </div>

            </div>

            <div class="info" >
                <h3>Identifiant de connexion :</h3>
                <p>Email: <span>{{ $user->email }}</span></p>
                <p>Identifiant: <span>{{ $user->identifiant }}</span></p>
                <p>Date d'enregistrement: <span>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span></p>
            </div>

            <!-- Nouvelle Section pour le Bureau Exécutif -->
            <div class="bureau-executif">

                <h2>Les Représentants du bureau exécutif</h2>

                <div class="member">

                    <!-- Président -->
                    <div class="executif-member">
                        
                        @if($user->attachment1)
                            <img src="{{ asset('storage/' . $user->attachment1) }}" alt="Photo Président" class="executif-photo">
                        @endif
                        <h2>{{ $user->namePresident }} {{ $user->lastNamePresident }}</h2>
                        <p>Président</p>
                        
                    </div>

                    <!-- Vice-président -->
                    <div class="executif-member">

                        @if($user->attachment2)
                            <img src="{{ asset('storage/' . $user->attachment2) }}" alt="Photo Vice-Président" class="executif-photo">
                        @endif

                        <h2>{{ $user->nameVicePresident }} {{ $user->lastNameVicePresident }}</h2>
                        <p>Vice-Président</p>
                        
                    </div>

                    <!-- Secrétaire Général -->
                    <div class="executif-member">

                        @if($user->attachment3)
                            <img src="{{ asset('storage/' . $user->attachment3) }}" alt="Photo Secrétaire Général" class="executif-photo">
                        @endif

                        <h2>{{ $user->nameSecretaireGeneral }} {{ $user->lastNameSecretaireGeneral }}</h2>
                        <p>Secrétaire-Général</p>

                    </div>

                    <!-- Trésorier Général -->
                    <div class="executif-member">

                        @if($user->attachment4)
                            <img src="{{ asset('storage/' . $user->attachment4) }}" alt="Photo Trésorier Général" class="executif-photo">
                        @endif

                        <h2>{{ $user->nameTresorierGeneral }} {{ $user->lastNameTresorierGeneral }}</h2>
                        <p>Trésorier-Général</p>
                        
                    </div>

                </div>
                
            </div>

            <div class="image">
                <img src="{{ asset('storage/' . $user->attachment5) }}" alt="Image">
            </div>

            <div class="espoir-title1">

                <div class="image1">
                    <img src="{{ asset('/img1/utilisateur.png') }}" alt="">
                </div>

                <div class="texte">
                    <h2>DENOMINATION: <span>{{ $user->denomination }} Créé le {{ \Carbon\Carbon::parse($user->date)->format('d/m/Y') }}</span></h2>
                </div>

            </div>

            <div class="espoir-title2">

                <div class="image2">
                    <img src="{{ asset('/img1/objectif.png') }}" alt="">
                </div>

                <div class="texte">
                    <h2>LES OBJECTIFS:</h2>
                </div>

            </div>

            <div class="objectifs">

                <div class="trait"></div>

                <ul class="objectifs-container">
                    <li>{{ $user->objectif1 }}</li> 
                    <li>{{ $user->objectif2 }}</li>
                    <li>{{ $user->objectif3 }}</li>
                </ul>

            </div>

            <div class="espoir-title3">

                <div class="image3">
                    <img src="{{ asset('/img1/broche-de-localisation.png') }}" alt="">
                </div>

                <div class="texte">
                    <h2>SIEGE DE L’ASSOCIATION OU ONG :</h2>
                </div>

            </div>

            <div class="localisation">
                <div class="localisation-container">
                    <p>{{ $user->siege }}</p>
                </div>
            </div>

            <div class="espoir-title4">

                <div class="image4">
                    <img src="{{ asset('/img1/courriel-de-contact.png') }}" alt="">
                </div>

                <div class="texte">
                    <h2>CONTACT : </h2>
                </div>

            </div>

            <div class="contact">

                <div class="trait"></div>

                <div class="contact-container">
                    <p>. Téléphones : {{ $user->number1 }} / {{ $user->number2 }}</p> <!-- Dynamique -->
                    <p>. Email : <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p> <!-- Dynamique -->
                </div>

            </div>
            
        </main>


        <footer id="footer" class="footer dark-background">

            <div class="container">
            
                <div class="row gy-3">
            
                    <div class="col-lg-3 col-md-6 d-flex">
          
                        <div class="address">
                            <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 d-flex">
            
                        <div>
                            <h4>Lien utiles</h4>
                            <p>Association & ONG <br>
                                À Propos <br>
                                FAQ <br>
                                Contact
                            </p>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 d-flex">

                        <div>
                            <h4>Politique de Confidentialité</h4>
                            <p>Conditions d'Utilisation <br>
                                Politiques en matière des cookies
                            </p>
                        </div>

                    </div>

                </div>
                
            </div>

            <div class="container copyright text-center mt-4">
                <h3>2024 © Copyright</h3>              
            </div>

        </footer>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('/vendor/swiper/swiper-bundle.min.js') }}"></script>

        <!-- Main JS File -->
        <script src="{{ asset('/js/associationPage.js') }}"></script>

    </body>

</html>
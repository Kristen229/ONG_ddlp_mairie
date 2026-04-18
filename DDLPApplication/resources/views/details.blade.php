<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Mairie-Détails</title>
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

        <!-- Vendor CSS Files -->
        <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('/css/details.css') }}" rel="stylesheet">

    </head>
    
    <body class="index-page">

        <header id="header" class="header fixed-top">

            <div class="branding d-flex align-items-cente">

                <div class="container position-relative d-flex align-items-center justify-content-between">

                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                    </a>

                    <nav id="navmenu" class="navmenu">

                        <ul>
                            <li><a href="accueil#acceuil" class="active">Accueil</a></li>
                            <li><a onclick="window.location.href='/association-et-ong';">Associations et ONG</a></li>
                            <!-- Menu déroulant pour "Associations et ONG" -->
                            <li><a href="/accueil#activite">Activité</a></li>
                            <li><a onclick="window.location.href='/connexion';" class="cta-btn">Connexion membre</a></li>
                        </ul>

                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

                    </nav>

                </div>

            </div>
    
        </header>

        <main class="main">

            <div>

                <button class="btn-with-image" onclick="window.location.href='{{ route('association-et-ong') }}'">
                    <img src="{{ asset('/img1/precedent.png') }}" alt="Icône" class="btn-icon">
                    <span class="btn-text">Retour</span>
                </button>

            </div>

            <div class="espoir-title">
                <div class="logo">
                    <img src="{{ asset('storage/' . $association->attachment) }}" alt="{{ $association->name }}">
                </div>

                <div class="texte">
                    <h2>{{ $association->name }}</h2>
                    <p>{{ $association->domaine }}</p>
                </div>

                <div>
                    <button class="btn-with-image" onclick="window.location.href='{{ $association->lien }}';">
                        <span class="btn-texte">Visiter leur site web</span>
                        <img src="{{ asset('/img1/arrow.png') }}" alt="Icône" class="btn-icon">
                    </button>
                </div>
            </div>

            <div class="image">
                <img src="{{ asset('storage/' . $association->attachment5) }}" alt="">
            </div>

            <div class="espoir-title1">
                <div class="image1">
                    <img src="{{ asset('/img1/utilisateur.png') }}" alt="">
                </div>

                <div class="texte">
                    <h2>DENOMINATION: <span>{{ $association->denomination }} Créé le {{ $association->date }}</span></h2>
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
                <div class="objectifs-container">
                    <p>. {{ $association->objectif1 }}.</p>
                    <p>. {{ $association->objectif2 }}.</p>
                    <p>. {{ $association->objectif3 }}.</p>
                </div>
            </div>

            <div class="espoir-title3">
                <div class="image3">
                    <img src="{{ asset('/img1/broche-de-localisation.png') }}" alt="">
                </div>

                <div class="texte">
                    <h2>SIEGE DE L’ASSOCIATION OU  ONG :</h2>
                </div>
            </div>

            <div class="localisation">
                <div class="localisation-container">
                    <p>{{ $association->siege }}</p>
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
                    <p>. Téléphones : (+229) {{ $association->number1 }} / {{ $association->number2 }}</p>
                    <p>. Email : {{ $association->email }}</p>
                </div>
            </div>

            <div class="tr"></div>
            
            <div class="espoir-title5">
    
                <div class="texte">
                    <h2>Les Activités de l'Association/ONG</h2>
                </div>

            </div>

            <style>
                .activities{
                    margin-top: 30px;
                }

                .activities ul{
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .activities ul .activite-item{
                    display: flex; 
                    justify-content: space-between; 
                    align-items: flex-start; 
                    margin-bottom: 40px; 
                    gap: 30px;
                }

                .activities ul .activite-item .activites img{
                    width: 500px; 
                    height: 300px; 
                    border-radius: 14px; 
                    object-fit: cover;
                }

                .activities ul .activite-item .activites1{
                    flex: 1;
                }

                .activities ul .activite-item .activites1 .activitesA{
                    display: flex; 
                    align-items: center; 
                    gap: 20px; 
                    margin-bottom: 10px;
                }

                .activities ul .activite-item .activites1 .activitesA .AD img{
                    width: 56px; 
                    height: 56px; 
                    border: 1px solid black; 
                    border-radius: 50%;
                }

                .activities ul .activite-item .activites1 .activitesA .AC h2{
                    margin: 0; 
                    font-size: 18.71px; 
                    font-weight: 700; 
                    color: #000; 
                    font-family: var(--section-font);
                }

                .activities ul .activite-item .activites1 .activitesA .AC p{
                    margin: 0; 
                    font-size: 16.84px; 
                    color: #000000; 
                    font-weight: 500; 
                    font-family: var(--section-font);
                }

                .activities ul .activite-item .activites1 .heure p{
                    margin: 0; 
                    font-size: 14.03px; 
                    color: #A2A2A2; 
                    font-weight: 500;
                }

                .activities ul .activite-item .activites1 h3{
                    margin: 10px 0; 
                    font-family: var(--section-font); 
                    font-size: 18.71px; 
                    font-weight: 700; 
                    color: #000000;
                }

                .activities ul .activite-item .activites1 p{
                    margin: 0 0 15px 0; 
                    font-size: 14.03px; 
                    font-weight: 500; 
                    font-family: var(--section-font); 
                    line-height: 1.5; 
                    color: #000;
                }

                .activities ul .activite-item .activites1 #button{
                    background-color: #000000; 
                    color: white; 
                    border:2px solid black; 
                    margin-left:20px;
                }

                @media(max-width: 768px){
                    .activities ul .activite-item{
                        display: flex; 
                        flex-direction: column;
                        margin-bottom: 40px; 
                        gap: 30px;
                    }

                    .activities ul .activite-item .activites1 .activitesA .AD img{
                        margin-left: 300px;
                    }

                    .activities ul .activite-item .activites1 .heure p{
                        margin-left: 350px; 
                    }

                    .activities ul .activite-item .activites1 h3{
                        margin-left: 300px; 
                    }

                    .activities ul .activite-item .activites1 p{
                        margin-left: 300px; 
                    }

                    .activities ul .activite-item .activites1 #button{
                        margin-left:400px;
                    }
                }
            </style>

            <div class="activities">

                @if($association->activities->isEmpty())
                    <p>Aucune activité pour cette association.</p>
                @else

                    <ul>

                        @foreach($association->activities as $activity)

                            <li class="activite-item">

                                <div class="activites">
                                    <img src="{{ asset('storage/attachments/' . basename($activity->attachment)) }}" alt="">
                                </div>

                                <div class="activites1">
                                    
                                    <div class="activitesA">

                                        <div class="AD">
                                            <img src="{{ asset('storage/' . $activity->user->attachment) }}" alt="logo">
                                        </div>

                                        <div class="AC">

                                            <h2>
                                                {{ $activity->user->name }}
                                            </h2>

                                            <p>
                                                {{ $activity->user->domaine }}
                                            </p>

                                        </div>

                                    </div>

                                    <div class="heure" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">

                                        <div class="tr" style="width: 10.29px; height: 10.29px; border-radius: 50%; background-color: #A2A2A2; margin-top: -1px"></div>

                                        <p>
                                            {{ $activity->created_at->format('d-m-Y H:i') }}
                                        </p>

                                    </div>

                                    <h3>
                                        {{ $activity->titre }}
                                    </h3>

                                    <p>
                                        {{ $activity->description }}
                                    </p>

                                    <button id="button" class="btn btn-info" onclick="showOverlay ({{ $activity->id }})">Voir détails</button>
                                </div>
                            </li>

                            <!-- Overlay pour afficher les détails -->
                            <div id="overlay{{ $activity->id }}" class="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow-y: auto; background-color: rgba(0, 0, 0, 0.8); z-index: 1000;">

                                <div class="overlay-content" style="margin-top:100px; max-width: 800px; background: white; padding: 20px; border-radius: 10px;">

                                    <div class="tit" style="display: flex; align-items:center" >
                                        <div class="AD" style="margin-left: 100px;">                                                    
                                            <img src="{{ asset('storage/' . $activity->user->attachment) }}" alt="logo" style=" width: 56.13px;height: 56.13px;border: 1px solid black;border-radius: 50%;margin-left: -50px;">
                                        </div>

                                        <div class="AC" style="margin-left: 150px; margin-top:10px;">
                                            <h2 style="width: 262.87px;
                                                height: 28px;
                                                margin-top: -0.5px;
                                                font-family: var(--section-font);
                                                font-size: 18.71px;
                                                font-weight: 700;
                                                line-height: 27.95px;
                                                letter-spacing: -0.03em;
                                                text-align: left;
                                                text-underline-position: from-font;
                                                text-decoration-skip-ink: none;
                                                color: #000000;
                                                margin-left: -100px;">
                                                {{ $activity->user->name }}
                                            </h2>
                                                    
                                            <p style="width: 262.87px;
                                                height: 26.19px;
                                                margin-left: -100px;
                                                font-family: var(--section-font);
                                                font-size: 16.84px;
                                                font-weight: 500;
                                                line-height: 27.95px;
                                                letter-spacing: -0.03em;
                                                text-align: left;
                                                text-underline-position: from-font;
                                                text-decoration-skip-ink: none;
                                                color: #000000;">
                                                {{ $activity->user->domaine }}
                                            </p>
                                        </div>

                                        <span class="close-btn" onclick="hideOverlay({{ $activity->id }})" style="margin-left:150px; font-size:20px; font-weight:400;">&times;</span>

                                    </div>

                                    <img src="{{ asset('storage/attachments/' . basename($activity->attachment)) }}" alt="{{ $activity->titre }}" class="img-fluid">

                                    <h2 style= "width: 491.13px; font-family: var(--section-font); font-size: 18.71px; font-weight: 700; line-height: 27.95px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: #000000; margin-top:50px">
                                        {{ $activity->titre }}
                                    </h2> 
                                    <br>
                                    <div class="body">
                                        <p style=" width: 1146px; font-family: var(--section-font); font-size: 15px; font-weight: 500; line-height: 29.88px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: #000000;">
                                            {{ $activity->description }}
                                        </p>
                                        
                                        <div class="dat" style="display: flex; align-items: center; gap: 20px;">
                                            <div class="dat1" style="width: 350px; height: 132px; background-color: #001925; border-radius: 5px; border: 1px solid #001925; margin-left:20px;">
                                                <h2 style="width: 346px; margin-top: 30px; margin-left: 30px; font-family: var(--section-font); font-size: 18px; font-weight: 700; line-height: 29.88px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: var(--contrast-color);">
                                                    <img src="{{ asset('/img2/broche-de-localisation.png') }}" alt="" style="width: 22px; height: 22px;">
                                                    Lieu de l'activité
                                                </h2>
                                                <p style=" width: 459px; height: 30px; margin-left: 30px; font-family: var(--section-font); font-size: 15px; font-weight: 500; line-height: 29.88px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: var(--contrast-color);">{{ $activity->lieu }}</p>
                                            </div>

                                            <div class="dat2" style="width: 350px; height: 132px; top: 873px; left: 77px; background-color: #001925; border-radius: 5px; border: 1px solid #001925;">
                                                <h2 style="width: 346px; margin-top: 30px; margin-left: 30px; font-family: var(--section-font); font-size: 18px; font-weight: 700; line-height: 29.88px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: var(--contrast-color);">
                                                    <img src="{{ asset('/img2/calendrier-2.png') }}" alt="" style="width: 22px; height: 22px; gap: 0px; opacity: 0px;">
                                                    Date ou Période de l'activité
                                                </h2>
                                                <p style="width: 459px; height: 30px; margin-left: 30px; font-family: var(--section-font); font-size: 15px; font-weight: 500; line-height: 29.88px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: var(--contrast-color);">{{ $activity->date }}</p>
                                            </div>
                                        </div>

                                        <div class="da" style="width: 529px; height: 29px; top: 1028px; left: 76px; gap: 0px; opacity: 0px; font-family: Montserrat; font-size: 15px; font-style: italic; font-weight: 500; line-height: 29.88px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: #000000;">
                                            <p>Publié le {{ $activity->created_at->format('d-m-Y H:i') }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                @endif
            </div>

            
            <script>
                function showOverlay(id) {
                    const overlay = document.getElementById(`overlay${id}`);
                    overlay.style.display = 'flex';
                }

                function hideOverlay(id) {
                    const overlay = document.getElementById(`overlay${id}`);
                    overlay.style.display = 'none';
                }

            </script>

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
        <script src="{{ asset('/js/details.js') }}"></script>
    </body>
</html>

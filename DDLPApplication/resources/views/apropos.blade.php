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

        <!-- Vendor CSS Files -->
        <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('/css/apropos.css') }}" rel="stylesheet">

    </head>
    <body>

        <header id="header" class="header fixed-top">
            <div class="branding d-flex align-items-cente">
                <div class="container position-relative d-flex align-items-center justify-content-between">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                    </a>

                    <nav id="navmenu" class="navmenu">
                        <ul>
                            <li><a href="accueil#acceuil" class="active">Accueil</a></li>
                            <li><a onclick="window.location.href='association-et-ong';">Associations et ONG</a></li>
                            <!-- Menu déroulant pour "Associations et ONG" -->
                            <li><a href="accueil#activite">Activité</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropbtn" onclick="toggleDropdown()">Plus</a>
                                <ul class="dropdown-content">
                                    <li>
                                        <a onclick="window.location.href='apropos';">
                                            <div class="prop">
                                                <div class="prop1">
                                                    <img src="{{ asset('/img2/Premium_Vector-Documents_with.png') }}" alt="Image Description">
                                                </div>
                                                <div class="traitd"></div>
                                                <div class="tex">
                                                    <h2>À Propos</h2>
                                                    <p>Découvrez la mission de la Mairie de Cotonou et son engagement pour soutenir les associations et ONG locales, et améliorer 
                                                        <br>l'impact de leurs actions dans la communauté.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="window.location.href='faq';">
                                            <div class="prop">
                                                <div class="prop1">
                                                    <img src="{{ asset('/img2/Premium-Vector.jpeg') }}" alt="Image Description">
                                                </div>
                                                <div class="traitd"></div>
                                                <div class="tex">
                                                    <h2>FAQ</h2>
                                                    <p>Retrouvez ici les réponses aux questions fréquemment posées sur la plateforme de la Mairie de Cotonou et le soutien 
                                                        <br>aux associations et ONG locales.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>                                   
                                    <li>
                                        <a onclick="window.location.href='contact';">
                                            <div class="prop">
                                                <div class="prop1">
                                                    <img src="{{ asset('/img2/3d-Contact.jpeg') }}" alt="Image Description">
                                                </div>
                                                <div class="traitd"></div>
                                                <div class="tex">
                                                    <h2>Contact</h2>
                                                    <p>Contactez la Mairie de Cotonou pour toute question ou assistance concernant la plateforme dédiée aux associations et ONG 
                                                        <br>locales.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>                                
                                </ul>
                            </li>


                            <li><a onclick="window.location.href='connexion';" class="cta-btn">Connexion membre</a></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>


                </div>

            </div>
    
        </header>

        <main class="main">

            <div class="contenu">

                <div class="contenu1">
                    <h1>A PROPOS DE CETTE PLATEFORME</h1>
                    <P>Découvrez la mission de la Mairie de Cotonou et son engagement pour soutenir les associations et ONG locales, et améliorer l'impact de leurs actions dans la communauté.</P>
                </div>

                <div class="log">
                    <img src="{{ asset('/img2/Premium_Vector-Documents_with.png') }}" alt="Image Description">
                </div>

            </div>

            <div class="te">
                <p>Bienvenue sur la plateforme des Associations et ONG de la mairie, une <span>solution innovante dédiée à la gestion et au suivi des associations et ONG</span> de la commune de Cotonou.</p>
            </div>

            <div class="contenu2">
                <div class="contenu2A">
                    <img src="{{ asset('/img2/graph.jpeg') }}" alt="Image Description">
                </div>

                <div class="contenu2B">
                    <h1>Notre mission</h1>

                    <p>Cette plateforme a été créée pour renforcer la collaboration entre la mairie, les associations, et les ONG. Nous visons à :
                        <br>
                        <br>. Simplifier la gestion administrative des associations.

                        <br>
                        <br>. Améliorer la visibilité des initiatives locales auprès des citoyens.

                        <br>
                        <br>. Favoriser un suivi transparent et efficace des projets communautaires.
                    </p>
                    
                </div>
            </div>

            <div class="contenu3">
                
                <div class="contenu3A">

                    <h1>Fontionnalités clés</h1>

                    <p>. Enregistrement des associations et ONG : Permet aux structures de s'inscrire et de gérer leur profil en toute autonomie.

                        <br><br>. Soumission des demandes : Les associations peuvent solliciter un accompagnement ou un partenariat directement en ligne.

                        <br><br>. Historique des activités : Suivez les projets publiés par les associations et ONG pour rester informé des initiatives locales.

                        <br><br>. Espace administrateur : Un outil dédié à la mairie pour gérer les enregistrements, valider les demandes, et suivre les actions.
                    </p>
                    
                </div>

                <div class="contenu3B">
                    <img src="{{ asset('/img2/personne.jpeg') }}" alt="Image Description">
                </div>
            </div>

            <div class="contenu4">
                <div class="contenu4A">
                    <img src="{{ asset('/img2/rire.jpeg') }}" alt="Image Description">
                </div>

                <div class="contenu4B">
                    <h1>Pourquoi utiliser notre plateforme?</h1><br><br>
                    <p>1. Simplicité : Une interface intuitive et accessible à tous.

                        <br><br>2. Efficacité : Un gain de temps pour toutes les parties prenantes.

                        <br><br>3. Transparence : Un suivi clair des projets et des associations actives.
                    </p>
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

        <script>// Fonction pour afficher ou masquer la liste déroulante lors du clic sur "Plus"
            function toggleDropdown() {
                var dropdown = document.querySelector('.dropdown-content');
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        </script>
        
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
        <script src="{{ asset('/js/user.js') }}"></script>
    </body>
</html>
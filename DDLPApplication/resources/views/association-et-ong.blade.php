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
        <link href="{{ asset('/css/association-et-ong.css') }}" rel="stylesheet">

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
                                                        <br>locales.
                                                    </p>
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

            <section id="partie1" class="partie1 section">

                <div class="gauche">

                    <h2>Découvrez et explorez les associations et ONG actives dans la commune de Cotonou.</h2>

                    <div class="search-container">
                        <input type="text" id="rechercheAssociation" placeholder="Rechercher une association ou une ONG" style="width: 300px; height: 40px; border: 1px solid black; border-radius: 10px; background-color: #efefef;">
                    </div>
        
                    <script>
 
                        document.addEventListener('DOMContentLoaded', () => {
                            const inputRecherche = document.getElementById('rechercheAssociation');
                            const associations = document.querySelectorAll('.asso1');

                            inputRecherche.addEventListener('input', () => {
                                const query = inputRecherche.value.trim().toLowerCase();

                                associations.forEach(asso => {
                                    const nom = asso.getAttribute('data-nom');
                                    if (nom.includes(query)) {
                                        asso.style.display = 'block';
                                    } else {
                                        asso.style.display = 'none';
                                    }
                                });
                            });
                        });

                    </script>

                </div>

                <div class="exe">
                    <h2>
                        <span class="a-prefix">A-</span><img src="{{ asset('/img1/téléchargement-removebg-preview.png') }}" alt="">

                        <span>ONG</span>
                    </h2>
                </div>

            </section>

            <section id="partie2" class="partie2 section">

                <div class="title">
                    <h2>Liste des associations et ONG actives</h2>
                </div>

                <div class="bor1">

                    <p>
                        Recherche par domaine
                        <img src="{{ asset('/img2/trois.png') }}" alt="">
                    </p>

                </div>

                <div class="bor2">

                    <div class="un">
                        <p>Éducation</p>
                        <input type="checkbox" class="carre" data-domaine="Education">
                    </div>
                    
                    <div class="un">
                        <p>Santé</p>
                        <input type="checkbox" class="carre" data-domaine="Santé">
                    </div>

                    <div class="un">
                        <p>Environnement</p>
                        <input type="checkbox" class="carre" data-domaine="Environnement">
                    </div>

                    <div class="un">
                        <p>Sociale</p>
                        <input type="checkbox" class="carre" data-domaine="Sociale">
                    </div>

                    <div class="un">
                        <p>Sport</p>
                        <input type="checkbox" class="carre" data-domaine="Sport">
                    </div>

                    <div class="un">
                        <p>Agricole</p>
                        <input type="checkbox" class="carre" data-domaine="Agricole">
                    </div>

                    <div class="un">
                        <p>Technologie</p>
                        <input type="checkbox" class="carre" data-domaine="Technologie">
                    </div>

                </div>

                <div class="asso">

                    @foreach ($associations as $association)

                        <div class="asso1" data-domaine="{{ $association->domaine }}" data-nom="{{ strtolower($association->name) }}" style="display: block;">

                            <h3>{{ $association->name }}</h3>

                            <img src="{{ asset('storage/' . $association->attachment) }}" alt="{{ $association->name }}">
                            
                            <p><strong>Dénomination:</strong> {{ $association->denomination }}</p>
                            
                            <p><strong>Domaine:</strong> {{ $association->domaine }}</p>
                            
                            <p><strong>Objectifs:</strong> {{ $association->objectif1 }}</p>
                            
                            <p>{{ $association->objectif2 }}</p>
                            
                            <p>{{ $association->objectif3 }}</p>
                            
                            <button class="btn"onclick="window.location.href='{{ route('association.details', ['id' => $association->id]) }}'";>
                                Voir plus en détails
                            </button>

                        </div>

                    @endforeach

                </div>

                <div class="pagination-container">
                    {{ $associations->links() }}
                </div>

                <script>
                   
                    document.querySelectorAll('.carre').forEach(item => {
                        item.addEventListener('change', function () {
                            // Récupérer tous les domaines cochés
                            const domainesSelectionnes = Array.from(document.querySelectorAll('.carre:checked')).map(checkbox =>
                                checkbox.getAttribute('data-domaine')
                            );

                            // Afficher ou masquer les associations
                            document.querySelectorAll('.asso1').forEach(asso => {
                                const domainesAsso = asso.getAttribute('data-domaine')?.toLowerCase() || "";

                                // Vérifie si au moins un des domaines sélectionnés est présent dans les domaines de l'association
                                const doitAfficher = domainesSelectionnes.some(d => domainesAsso.includes(d.toLowerCase()));

                                asso.style.display = doitAfficher ? 'block' : 'none';
                            });
                        });
                    });

                    document.addEventListener('DOMContentLoaded', () => {
                        const inputRecherche = document.getElementById('rechercheAssociation'); // Champ de recherche
                        const associations = document.querySelectorAll('.asso1'); // Toutes les associations

                        // Écouter les entrées dans le champ de recherche
                        inputRecherche.addEventListener('input', () => {
                            const query = inputRecherche.value.trim().toLowerCase(); // Texte saisi en minuscule et sans espaces

                            associations.forEach(asso => {
                                const nom = asso.getAttribute('data-nom'); // Récupère le nom de l'association
                                if (nom.includes(query)) {
                                    asso.style.display = 'block'; // Affiche l'association correspondante
                                } else {
                                    asso.style.display = 'none'; // Cache les autres associations
                                }
                            });
                        });
                    });

                </script>

            </section>

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
        <script src="{{ asset('/js/association-et-ong.js') }}"></script>

    </body>

</html>

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
    <link href="{{ asset('/css/accueil.css') }}" rel="stylesheet">

</head>
<body>

    <header id="header" class="header fixed-top">
            
        <div class="branding d-flex align-items-cente">
                
            <div class="container position-relative d-flex align-items-center justify-content-between">
                    
                <a href="index.html" class="logo d-flex align-items-center">
                        
                    <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="logo">

                </a>

                <nav id="navmenu" class="navmenu">
                        
                    <ul>
                            
                        <li><a href="#acceuil" class="active">Accueil</a></li>
                            
                        <li><a onclick="window.location.href='association-et-ong';">Associations et ONG</a></li>
                            
                        <!-- Menu déroulant pour "Associations et ONG" -->
                            
                        <li><a href="#activite">Activité</a></li>
                            
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
                                                    <br>l'impact de leurs actions dans la communauté.
                                                </p>
                                                
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
                                                    <br>aux associations et ONG locales.
                                                </p>
                                                
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

        <!--Acceuil Section  -->
        <section id="acceuil" class="acceuil section">

            <div class="acceuil-container">

                <div class="title">

                    <h1>Bienvenue sur le Répertoire des Associations et ONG de la Mairie de Cotonou</h1>
                        
                    <p>Plusieurs association et ONG interviennent activement dans la commune de Cotonou. Découvrez, suivez et participez aux initiatives locales.</p>

                    <div class="container">

                        <div class="row">

                            <div class="col-lg-4">
                        
                                <div class="card-item">
                                    <img src="{{ asset('/img1/silhouette-dutilisateurs-multiples-blanc.png') }}" alt="img">
                                    <p>150+ Association et ONG enregistrées actives</p>
                                </div>
          
                            </div><!-- Card Item -->

                            <div class="col-lg-4">
            
                                <div class="card-item">
                                    <img src="{{ asset('/img1/coche-png-blanc.png') }}" alt="">
                                    <p>200+ Projets locaux menés à bien</p>
                                </div><!-- Card Item -->

                            </div>

                            <div class="col-lg-4">
            
                                <div class="card-item">
                                    <img src="{{ asset('/img1/communaute-PNG-BLANC.png') }}" alt="">
                                    <p>10,000+ Citoyens impactés</p>
                                </div><!-- Card Item -->

                            </div>

                            <div class="col-lg-4">
            
                                <div class="card-item">
                                    <img src="{{ asset('/img1/activites-(2)-png-blanc.png') }}" alt="">
                                    <p>20+ Domaines d'intervention (éducation, santé, environnement, etc.)</p>
                                </div><!-- Card Item -->

                            </div>
                    
                        </div>
                    </div>

                    <div id="acceuil-carousel" class="carousel slide carousel-fade">

                        <div class="carousel-item active">                    
                            <div class="carousel-container">
                                <div>
                                    <a onclick="window.location.href='association-et-ong';" class="btn-get-started1">Consultez les Associations et ONG</a>
                                    <a onclick="window.location.href='connexion';" class="btn-get-started2">Connexion membre Association ou ONG</a>
                                </div>
                            </div>
        
                        </div><!-- End Carousel Item -->

                    </div>

                </div>

            </div>

        </section>

        <!--A Propos Section -->
        <section id="apropos" class="apropos section">

            <div class="apropos-container">

                <div class="title1">
                    <h1>À Propos de cette Plateforme?</h1>
                </div>

                <div class="row1">

                    <div class="col1">
                        <img src="{{ asset('/img1/4469bddf-fb4a-4003-9684-73ca66a47ad6-removebg-preview.png') }}" alt="">
                    </div>

                    <div class="col2">
                        
                        <div class="row2A">
                                
                            <div class="row2A1">
                                <img src="{{ asset('/img1/livraison-express-blanc.png') }}" alt="">
                                <h2>Accès rapide et facile aux informations</h2>
                                <p>Retrouvez en un seul endroit toutes les associations et ONG actives dans la commune de Cotonou, ainsi que leurs projets, missions, et événements. Que vous souhaitiez vous impliquer ou simplement en savoir plus, la plateforme vous permet d'accéder à toutes les informations importantes.</p>
                            </div>

                            <div class="row2A2">
                                <img src="{{ asset('/img1/suivre-removebg-preview-blanc.png') }}" alt="">
                                <h2>Suivi des initiatives locales</h2>
                                <p>Grâce à la plateforme, suivez en temps réel l’évolution des projets et initiatives locales. Vous pouvez voir quels projets sont en cours, quels impacts ils ont sur la communauté et comment y contribuer.</p>
                            </div>
                            
                        </div>

                        <div class="row2B"> 

                            <div class="row2B1">
                                <img src="{{ asset('/img1/simplifier-removebg-preview-BLANC.png') }}" alt="">
                                <h2>Simplification des démarches administratives</h2>
                                <p>Pour les associations et ONG, la plateforme offre un espace dédié pour soumettre des demandes à la mairie (financements, partenariats, etc.), suivre leur statut et consulter les documents requis, rendant les démarches plus simples et rapides.</p>
                            </div>

                            <div class="row2B2">
                                <img src="{{ asset('/img1/concentrer-blanc.png') }}" alt="">
                                <h2>Centralisation des ressources et opportunités</h2>
                                <p>Que vous soyez une association, une ONG ou un citoyen, vous trouverez sur la plateforme des ressources utiles (guides, contacts, etc.) ainsi que des opportunités (formations, appels à projets) pour vous accompagner dans vos initiatives.</p>
                            </div>

                        </div>

                    </div>

                </div>

                <div id="hero-carousel" class="carousel slide" >

                    <div class="carousel-item active">
                    
                        <div class="carousel-container">
                            <img src="{{ asset('/img1/livraison-express-blanc.png') }}" alt="">
                            <h2>Accès rapide et facile aux informations</h2>
                            <p>Retrouvez en un seul endroit toutes les associations et ONG actives dans la commune de Cotonou, ainsi que leurs projets, missions, et événements. Que vous souhaitiez vous impliquer ou simplement en savoir plus, la plateforme vous permet d'accéder à toutes les informations importantes.</p>
                        </div>
    
                    </div><!-- End Carousel Item -->

                    <div class="carousel-item">

                        <div class="carousel-container">
                            <img src="{{ asset('/img1/suivre-removebg-preview-blanc.png') }}" alt="">
                            <h2>Suivi des initiatives locales</h2>
                            <p>Grâce à la plateforme, suivez en temps réel l’évolution des projets et initiatives locales. Vous pouvez voir quels projets sont en cours, quels impacts ils ont sur la communauté et comment y contribuer.</p>
                        </div>

                    </div><!-- End Carousel Item -->

                    <div class="carousel-item">

                        <div class="carousel-container">
                            <img src="{{ asset('/img1/simplifier-removebg-preview-BLANC.png') }}" alt="">
                            <h2>Simplification des démarches administratives</h2>
                            <p>Pour les associations et ONG, la plateforme offre un espace dédié pour soumettre des demandes à la mairie (financements, partenariats, etc.), suivre leur statut et consulter les documents requis, rendant les démarches plus simples et rapides.</p>
                        </div>

                    </div><!-- End Carousel Item -->

                    <div class="carousel-item">

                        <div class="carousel-container">
                            <img src="{{ asset('/img1/concentrer-blanc.png') }}" alt="">
                            <h2>Centralisation des ressources et opportunités</h2>
                            <p>Que vous soyez une association, une ONG ou un citoyen, vous trouverez sur la plateforme des ressources utiles (guides, contacts, etc.) ainsi que des opportunités (formations, appels à projets) pour vous accompagner dans vos initiatives.</p>
                        </div>
                        
                    </div><!-- End Carousel Item -->

                    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                    </a>

                    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                    </a>

                    <ol class="carousel-indicators"></ol>

                </div>

            </div>
            
        </section>
        
        <!-- A La une des associations et ONG-->
        <section id="associationONG" class="associationONG section">
            <div class="associationONG-container">
                
                <div class="title2">
                    <h1>À la Une des Associations et ONG</h1>
                </div>

                <div>
                    <p>Découvrez les associations et ONG qui brillent par leurs projets et leur impact sur la communauté de Cotonou</p>
                </div>
 
                <div class="main-container">
                        
                    <div class="inner-container">

                        @if(isset($associations) && $associations->count() > 0)

                            @foreach ($associations as $association)

                                <div class="item">
                                    <h2>{{ $association->name }}</h2>
                                        
                                    <p style="gap: 10px;"><span style="text-decoration: underline;">Domaine d'intervention :</span>  {{ $association->domaine }}</p>
                                        
                                    <img src="{{ asset('storage/' . $association->attachment5) }}" alt="{{ $association->name }}">
                                        
                                    <button id="btn-{{ $association->id }}" class="btn">
                                        En savoir plus...
                                    </button>

                                    <script>
                                        document.getElementById("btn-{{ $association->id }}").addEventListener("click", function() {
                                            window.location.href = "{{ route('association.details', $association->id) }}";
                                        });
                                    </script>

                                </div>
                                
                            @endforeach
                            
                        @endif
                        
                    </div>
                    
                </div>

                <div>
                    <button class="btn-with-image" onclick="window.location.href='association-et-ong';">
                        <span class="btn-texte">Consultez ici tous les Associations et ONG</span>
                        <img src="{{ asset('/img1/droit.png') }}" alt="Icône" class="btn-icon">
                    </button>                    
                </div>

            </div>
        
        </section>

        <!--FAQ Section-->
        <section id="faq" class="faq section">
                
            <div class="faq-container">
                    
                <h2>FAQ</h2>
                    
                <h4>Explorez la FAQ pour vos questions les plus fréquents</h4>
                    
                <div class="question">
                        
                    <div class="question-title">
                            
                        <h2>Comment puis-je consulter la liste des associations et ONG actives à Cotonou?</h2>
                            
                        <img src="{{ asset('/img1/droit.png') }}" alt="Icône" class="btn-icon">
                        
                    </div>
                        
                    <p>Allez sur la page Association et ONG et vous trouverez une barre de recherche qui vous permet de rechercher différentes associations et ONG actives dans la commune de Cotonou</p>
                    
                </div>

                <div class="question">
                        
                    <div class="question-title" id="title1">
                                
                        <h2>Comment s'enregistrer en tant qu'association ou ONG dans la commune de Cotonou?</h2>
                                    
                        <img src="{{ asset('/img1/droit.png') }}" alt="Icône" class="btn-icon">
                        
                    </div>
                            
                    <p>Cliquez sur le bouton Connexion membre en haut à droite, une fois que c'est fait vous trouverez un lien inscription.</p>
                
                </div>

                <div class="question">
                        
                    <div class="question-title" id="title2">
                            
                        <h2>Comment soumettre une demande d'accompagnement auprès de la mairie de Cotonou?</h2>
                            
                        <img src="{{ asset('/img1/droit.png') }}" alt="Icône" class="btn-icon">
                        
                    </div>
                        
                    <p>Pour soumettre une demande, il fau se connecterà son espace membre, cliquer sur Demande à gauche et suivre les indications</p>
                    
                </div>
                    
                <div class="question">
                        
                    <div class="question-title">
                            
                        <h2>Comment puis-je suivre l’état de ma demande d’accompagnement ?</h2>
                            
                        <img src="{{ asset('/img1/droit.png') }}" alt="Icône" class="btn-icon">
                        
                    </div>
                        
                    <p>Après avoir soumis une demande, vous pouvez suivre son avancement dans votre espace membre, via la page " statut d’une demande". Vous y verrez si votre demande est en attente, en cours de traitement, ou approuvée.</p>
                    
                </div>
            </div>

            <script>
                    
                document.querySelectorAll('.btn-icon').forEach(icon => {
                        
                    icon.addEventListener('click', function() {
                            
                        // Obtenez le parent .question de l'icône cliquée
                            
                        const questionDiv = this.closest('.question');
                            
                        const paragraph = questionDiv.querySelector('p');
            
                        // Basculer entre l'état initial (79px, p masqué) et l'état déployé
                            
                        if (questionDiv.style.height === 'auto') {
                                
                            // Retour à l'état initial : hauteur de 79px, paragraphe masqué, rotation réinitialisée
                                
                            questionDiv.style.height = '79px';
                                
                            paragraph.style.display = 'none';
                                
                            this.classList.remove('rotated');
                            
                        } else {
                                
                            // État déployé : hauteur automatique, paragraphe visible, rotation de 90 degrés
                                
                            questionDiv.style.height = 'auto';
                                
                            paragraph.style.display = 'block';
                                
                            this.classList.add('rotated');
                            
                        }
                        
                    });
                    
                });

                window.onload = function() {
                        
                    var dropdown = document.querySelector('.dropdown-content');
                        
                    dropdown.style.display = 'none';  // Cache le menu au chargement de la page
                };

            </script>

        </section>

        <!--Activité Section-->
        <section id="activite" style="overflow-x: auto; white-space: nowrap; padding-bottom: 10px;">

            <style>
                #activite .red{
                    display: flex; 
                    gap: 20px;
                    height: auto; 
                    border-radius: 20px; 
                    padding: 10px;
                }
            </style>
                
            <div class="red">
                    
                @if(isset($activities) && $activities->count() > 0)
                        
                    @foreach($activities as $activity)

                        @if($activity->is_visible)
                            
                            <div class="activite-item" style="min-width: 530px; background-color: #333; border-radius: 20px;">
                                    
                                <div class="activites">
                                        
                                    <img src="{{ asset('storage/attachments/' . basename($activity->attachment)) }}" alt="{{ $activity->titre }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 14px 14px 0 0;">
                                
                                </div>

                                <div class="activites1" style="padding: 15px; color: white;">
                                        
                                    <div class="activitesA" style="display: flex; align-items: center; gap: 15px;">
                                        
                                        <div class="AD">
                                                
                                            <img src="{{ asset('storage/' . $activity->user->attachment) }}" alt="logo" style="width: 56px; height: 56px; border-radius: 50%;">
                                            
                                        </div>

                                        <div class="AC">
                                                
                                            <h2 style="font-size: 18px; font-weight: bold;     font-family: var(--section-font); color: white;">{{ $activity->user->name }}</h2>
                                                
                                            <p style="font-size: 16px;">{{ $activity->user->domaine }}</p>
                                        
                                        </div>
                                        
                                    </div>

                                    <div class="heure" style="margin-top: 10px;">
                                        <p style="color: #A2A2A2; font-size: 14px;">{{ $activity->created_at->format('d-m-Y H:i') }}</p>
                                    </div>

                                    <h3 style="font-size: 18px; font-weight: bold; margin-top: 10px;">{{ $activity->titre }}</h3>
                                    <p style="font-size: 14px;">{{ $activity->description }}</p>
                                
                                </div>
                            
                            </div>

                        @endif
                    
                    @endforeach
                
                @endif
            
            </div>

            <script>
                    
                const activiteContainer = document.getElementById('activite');

                function scrollAutomatically() {
                    activiteContainer.scrollLeft += 1;
                    if (activiteContainer.scrollLeft >= activiteContainer.scrollWidth - activiteContainer.clientWidth) {
                        activiteContainer.scrollLeft = 0;
                    }
                }

                setInterval(scrollAutomatically, 20);
                
            </script>
            
        </section>
       
        <!--Contact Section-->
        <section id="contact" class="contact section">
                
            <div class="contact-container">
                    
                <h2>Contactez-nous</h2>
                    
                <div class="info">
                        
                    <p>Vous avez des questions ou besoin d’informations supplémentaires ? Nous sommes là pour vous aider. Contactez-nous via l’un des moyens ci-dessous.</p>
                        
                    <div class="info1">
                            
                        <img src="{{ asset('/img2/email.jpg') }}" alt="">
                            
                        <p>Adresse email: ddlpmairie@gmail.com</p>
                        
                    </div>
                        
                    <div class="info2">
                            
                        <img src="{{ asset('/img2/phone.jpg') }}" alt="">
                            
                        <p>Numéro de téléphone : (+229) 21309569</p>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </section>
            
        <script>// Fonction pour afficher ou masquer la liste déroulante lors du clic sur "Plus"
            
            function toggleDropdown() {
                
                var dropdown = document.querySelector('.dropdown-content');
                    
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                
            }

                
            const container = document.querySelector('.inner-container');
                
            container.addEventListener('mouseover', () => {
                    
                container.style.animationPlayState = 'paused';
                
            });
                
            container.addEventListener('mouseout', () => {
                    
                container.style.animationPlayState = 'running';
                
            });
            
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
            <h3>2025 © Copyright</h3>              
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
    <script src="{{ asset('/js/accueil.js') }}"></script>

</body>
</html>
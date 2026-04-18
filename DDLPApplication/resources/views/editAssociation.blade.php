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
        <link href="{{ asset('/css/editAssociation.css') }}" rel="stylesheet">

    </head>

    <body class="index-page">

        <div class="container">

            <nav class="sidebar">

                <div class="logo">
                    <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                </div>

                <div class="trait"></div>
                
                <ul class="nav-links">

                    <li>
                        <a href="#dashboard" class="dashboard">
                            <span class="material-symbols-outlined">home</span> 
                            Accueil
                        </a>
                    </li>                    
                    
                    <li>
                        <a href="#gestionAsso" class="gestionAsso">
                            <span class="material-symbols-outlined">manage_accounts</span> 
                            Gestion Association et ONG
                        </a>
                    </li>                    
    
                    <li>
                        <a href="#admin-panel" class="gestionDemande">
                            <span class="material-symbols-outlined">bookmark_manager</span> 
                            Gestion des Demandes
                        </a>
                    </li>                    
                    
                    <li>
                        <a href="#gestionNotif" class="gestionNotif">
                            <span class="material-symbols-outlined">notifications</span> 
                            Gestion des Notifications
                        </a>
                    </li>                    

                    <li>
                        <a href="#gestionAct" class="gestionAct">
                            <span class="material-symbols-outlined">collections_bookmark</span> 
                            Gestion des Activités
                        </a>
                    </li>                    
                    
                    <li>
                        <a href="#stat" class="gestionStat">
                            <span class="material-symbols-outlined">analytics</span> 
                            Dashboard
                        </a>
                    </li>

                </ul>

                <div class="trait1"></div>

                <div>
                    <button class="btn-with-image" onclick="window.location.href='connexion';">
                        <img src="{{ asset('/img3/log.png') }}" alt="Icône" class="btn-icon">
                        <span class="btn-text">Déconnexion</span>
                    </button>
                </div>

            </nav>


            <div class="content-container">

                <header id="header" class="header fixed-top">
                    <h2>Espace administrateur de suivie et de gestion des Associations et ONG</h2>
                </header>

                <main class="main">

                    <!-- admin.blade.php -->
                    <section id="gestionAsso" class="gestionAsso section">

                        <div class="gestionAsso-container">

                            <div class="container1">
                                <h2>Gérer les association et ONG </h2>
                            </div>

                            <div class="container2">

                                <p id="paragraphe">Ajouter , modifier ou supprimer des associations à partir d’ici</p>

                                <div>
                                    <button class="btn-with-image" onclick="window.location.href='admin/createForm1';">
                                        <span class="btn-text">Ajouter une nouvelle Association ou ONG</span>
                                    </button>
                                </div>

                            </div>

                        </div>

                        <div class="title">

                            <h2>Modification d'une Association ou ONG</h2>

                            <div>
                                <button class="btn-with-image" onclick="window.location.href='{{ route('admin') }}'">
                                    <img src="{{ asset('/img1/droit.png') }}" alt="Icône" class="btn-icon">
                                    <span class="btn-text">Retour à la page précédente</span>
                                </button>
                            </div>

                        </div>

                        <div class="container">
                            
                            <form action="{{ route('admin.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="formu">

                                @csrf
                                <!-- Formulaire 1 : Informations générales -->
                                <h2>Formulaire 1</h2>
                                
                                <select id="groupe" name="groupe" required>
                                    <option value="" disabled {{ !$user->groupe ? 'selected' : '' }}>Sélectionner le type de groupe...</option>
                                    @foreach(['ONG', 'Association'] as $option)
                                        <option value="{{ $option }}" {{ $user->groupe === $option ? 'selected' : '' }}>
                                            {{ ucfirst($option) }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="name">Nom de l'association ou ONG<span>*</span></label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" placeholder="Taper le nom de l'association ou de l'ONG" required>

                                <label for="domaine">Domaine<span>*</span></label>
                                <select id="domaine" name="domaine" required>
                                    <option value="" disabled {{ !$user->domaine ? 'selected' : '' }}>Sélectionner le domaine d'intervention...</option>
                                    @foreach(['Education', 'Sociale', 'Sante', 'Environnement', 'Sport', 'Agricole', 'Technologie','Artisanal', 'Cuturel et Cultuel'] as $option)
                                        <option value="{{ $option }}" {{ $user->domaine === $option ? 'selected' : '' }}>
                                            {{ ucfirst($option) }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="denomination">Dénomination<span>*</span></label>
                                <input type="text" id="denomination" name="denomination" value="{{ $user->denomination }}" placeholder="Taper la dénomination de l’association ou de l’ONG" required>

                                <label for="date">Date de création<span>*</span></label>
                                <input type="date" id="date" name="date" value="{{ $user->date }}" placeholder="JJ/MM/AAA" required>

                                <label for="objectif1">Objectif 1<span>*</span></label>
                                <input type="text" id="objectif1" name="objectif1" value="{{ $user->objectif1 }}" placeholder="Taper ici l’objectif 1 de l’association ou de l’ONG" required>

                                <label for="objectif2">Objectif 2<span>*</span></label>
                                <input type="text" id="objectif2" name="objectif2" value="{{ $user->objectif2 }}" placeholder="Taper ici l’objectif 2 de l’association ou de l’ONG" required>

                                <label for="objectif3">Objectif 3<span>*</span></label>
                                <input type="text" id="objectif3" name="objectif3" value="{{ $user->objectif3 }}" placeholder="Taper ici l’objectif 3 de l’association ou de l’ONG" required>
                            
                                <!-- Autres champs -->

                                <!-- Formulaire 2 : Adresse et contacts -->
                                <h2 id="titre2">Formulaire 2</h2>


                                <label for="siege">Siège<span>*</span></label>
                                <input type="text" id="siege" name="siege" value="{{ $user->siege }}" placeholder="Taper ici le siège de l'association ou de l'ONG" required>

                                <label for="email">Email<span>*</span></label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" placeholder="Taper l'adresse email de l’association ou de l’ONG" required>

                                <label for="number1">Numéro de téléphone 1<span>*</span></label>
                                <input type="tel" id="number1" name="number1" value="{{ $user->number1 }}" placeholder="Taper le numéro de téléphone de l'association ou de l'ONG" required>

                                <label for="number2">Numéro de téléphone 2 (falcutative)</label>
                                <input type="tel" id="number2" name="number2" value="{{ $user->number2 }}" placeholder="Taper le numéro de téléphone de l’association ou de l’ONG" required>

                                <label for="attachment" class="file-label">
                                    <img src="{{ asset('/img2/plus.jpg') }}" alt=""> 
                                    Pièce jointe
                                </label>
                                <input type="file" id="attachment" name="attachment" accept="image/*" class="file-input">
                                @if($user->attachment)
                                    <img src="{{ asset('storage/attachments/' . basename($user->attachment)) }}" alt="Image actuelle" style="display: none;">
                                @endif

                                <label for="identifiant">Identifiant<span>*</span></label>
                                <input type="text" id="identifiant" name="identifiant" value="{{ $user->identifiant }}" placeholder="Taper votre identifiant" required>

                                <label for="password">Mot de Passe<span>*</span></label>
                                <input type="password" id="password" name="password" value="{{ $user->password }}" placeholder="Taper votre mot de passe" required>

                                <label for="lien">Lien de votre Site Web<span>*</span></label>
                                <input type="url" id="lien" name="lien" value="{{ $user->lien }}" placeholder="Taper le lien de votre site web" required>
                            
                                <!-- Autres champs -->

                                <!-- Formulaire 3 : Informations supplémentaires -->
                                <h2 id="titre3">Formulaire 3</h2>
                                <!-- Autres champs -->


                                <label for="namePresident">Nom du Président<span>*</span></label>
                                <input type="text" id="namePresident" name="namePresident" value="{{ $user->namePresident }}" placeholder="Taper ici le nom du Président de l’association ou de l’ONG" required>

                                <label for="lastNamePresident">Prénom du Président<span>*</span></label>
                                <input type="text" id="lastNamePresident" name="lastNamePresident" value="{{ $user->lastNamePresident }}" placeholder="Taper ici le prénom du Président de l’association ou de l’ONG" required>

                                <div class="president">
                                    <label for="attachment1" class="file-label">
                                        <span class="material-symbols-outlined" style="color: black;">add</span>                                        
                                        Photo du Président
                                    </label>
                                    <input type="file" id="attachment1" name="attachment1" accept="image/*" class="file-input">
                                    @if($user->attachment1)
                                        <img src="{{ asset('storage/attachments/' . basename($user->attachment1)) }}" alt="Image actuelle du Président" style="display: none;">
                                    @endif

                                </div>

                                
                                <div class="trait1"></div>

                                <label for="nameVicePresident">Nom du Vice-Président<span>*</span></label>
                                <input type="text" id="nameVicePresident" name="nameVicePresident" value="{{ $user->nameVicePresident }}" placeholder="Taper ici le nom du Vice-Président de l’association ou de l’ONG" required>

                                <label for="lastNameVicePresident">Prénom du Vice-Président<span>*</span></label>
                                <input type="text" id="lastNameVicePresident" name="lastNameVicePresident" value="{{ $user->lastNameVicePresident }}" placeholder="Taper ici le prénom du Vice-Président de l’association ou de l’ONG" required>

                                <div class="president">
                                    <label for="attachment2" class="file-label">
                                        <span class="material-symbols-outlined" style="color: black;">add</span>                                        
                                        Photo du Vice-Président
                                    </label>
                                    <input type="file" id="attachment2" name="attachment2" accept="image/*" class="file-input">
                                    @if($user->attachment2)
                                        <img src="{{ asset('storage/attachments/' . basename($user->attachment2)) }}" alt="Image actuelle du Vice-Président" style="display: none;">
                                    @endif

                                </div>

                                <div class="trait1"></div>

                                <label for="nameSecretaireGeneral">Nom du Sécrétaire-Général<span>*</span></label>
                                <input type="text" id="nameSecretaireGeneral" name="nameSecretaireGeneral" value="{{ $user->nameSecretaireGeneral }}" placeholder="Taper ici le nom du Sécrétaire-Général de l’association ou de l’ONG" required>

                                <label for="lastNameSecretaireGeneral">Prénom du Sécrétaire-Général<span>*</span></label>
                                <input type="text" id="lastNameSecretaireGeneral" name="lastNameSecretaireGeneral" value="{{ $user->lastNameSecretaireGeneral }}" placeholder="Taper ici le prénom du Sécrétaire-Général de l’association ou de l’ONG" required>

                                <div class="president">
                                    <label for="attachment3" class="file-label">
                                        <span class="material-symbols-outlined" style="color: black;">add</span>                                        
                                        Photo du Secrétaire-Général
                                    </label>
                                    <input type="file" id="attachment3" name="attachment3" accept="image/*" class="file-input">
                                    @if($user->attachment3)
                                        <img src="{{ asset('storage/attachments/' . basename($user->attachment3)) }}" alt="Image actuelle du Secrétaire-Général" style="display: none;">
                                    @endif

                                </div>

                                <div class="trait1"></div>

                                <label for="nameTresorierGeneral">Nom du Trésorier-Général<span>*</span></label>
                                <input type="text" id="nameTresorierGeneral" name="nameTresorierGeneral" value="{{ $user->nameTresorierGeneral }}" placeholder="Taper ici le nom du Trésorier-Général de l’association ou de l’ONG" required>

                                <label for="lastNameTresorierGeneral">Prénom du Trésorier-Général<span>*</span></label>
                                <input type="text" id="lastNameTresorierGeneral" name="lastNameTresorierGeneral" value="{{ $user->lastNameTresorierGeneral }}" placeholder="Taper ici le prénom du Trésorier-Général de l’association ou de l’ONG" required>

                                <div class="president">
                                    <label for="attachment4" class="file-label">
                                        <span class="material-symbols-outlined" style="color: black;">add</span>                                        
                                        Photo du Trésorier-Général
                                    </label>
                                    <input type="file" id="attachment4" name="attachment4" accept="image/*" class="file-input">
                                    @if($user->attachment4)
                                        <img src="{{ asset('storage/attachments/' . basename($user->attachment4)) }}" alt="Image actuelle du Trésorier-Général" style="display: none;">
                                    @endif
                                </div>

                                <div class="trait1"></div>

                                <div class="president">
                                    <label for="attachment5" class="file-label">
                                        <span class="material-symbols-outlined" style="color: black;">add</span>                                        
                                        Photo de couverture
                                    </label>
                                    <input type="file" id="attachment5" name="attachment5" accept="image/*" class="file-input">
                                    @if($user->attachment5)
                                        <img src="{{ asset('storage/attachments/' . basename($user->attachment5)) }}" alt="Image actuelle du Trésorier-Général" style="display: none;">
                                    @endif
                                </div>

                                <div class="president">
                                    <label for="signature_data" class="file-label">
                                        <span class="material-symbols-outlined" style="color: black;">add</span>                                        
                                        Signature
                                    </label>
                                    <input type="file" id="signature_data" name="signature_data" accept="image/*" class="file-input">
                                    @if($user->signature_data)
                                        <img src="{{ asset('storage/attachments/' . basename($user->signature_data)) }}" alt="Image actuelle du Trésorier-Général" style="display: none;">
                                    @endif
                                </div>

                                <div class="president">
                                    <label for="cachet" class="file-label">
                                        <span class="material-symbols-outlined" style="color: black;">add</span>                                        
                                        Cachet
                                    </label>
                                    <input type="file" id="cachet" name="cachet" accept="image/*" class="file-input">
                                    @if($user->cachet)
                                        <img src="{{ asset('storage/attachments/' . basename($user->cachet)) }}" alt="Image actuelle du Trésorier-Général" style="display: none;">
                                    @endif
                                </div>

                                <div class="trait1"></div>

                                <button type="submit" class="btn btn-success" style="margin-top: 50px;">Mettre à jour</button>
                            </form>

                        </div>
                        
                    </section>

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
        <script src="{{ asset('/js/editAssociation.js') }}"></script>
    </body>



</html>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="keywords" content="">


        <!-- Favicons -->
        <link href="{{ asset('/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <link href="{{ asset('/css/show.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



        <title>Profil Utilisateur</title>
    </head>

    <body class="index-page">

        <div class="container">

            <nav class="sidebar">

                <div class="logo">
                    <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                </div>

                <div class="trait"></div>

                <ul>
                    <li><a href="#" data-target="#accueil" class="menu-item"><span class="material-symbols-outlined" >person</span> Profil</a></li>
                    <li><a href="#" data-target="#demande" class="menu-item"><span class="material-symbols-outlined">ink_pen</span> Demande</a></li>
                </ul>

                <div class="trait1"></div>

                <div>
                    <button class="btn-with-image" onclick="window.location.href='/connexion';">
                        <span class="material-symbols-outlined">logout</span>                    
                        <span class="btn-text">Déconnexion</span>
                    </button>
                </div>

            </nav>

            <div class="content-container">

                <header id="header" class="header fixed-top">

                    <div class="espoir-title">

                        <div class="logo">
                            <img src="{{ asset('storage/attachments/' . basename ($user->attachment)) }}" alt="logo">
                        </div>

                        <div class="texte">
                            <h2>{{ $user->name }}</h2>
                            <p>{{ $user->domaine }}</p>
                        </div>
                        
                        <div class="user-notifications">

                            <!-- Cloche de notification -->
                            <div id="bell-container">

                                <div id="bell" class="notification-bell" style="cursor: pointer;">
                                    <i class="fas fa-bell"></i>
                                </div>

                            </div>

                            <!-- Modal de notifications -->
                            <div id="notifications-modal" class="notifications-modal">

                                <!-- Fond semi-transparent -->
                                <div class="modal-overlay" id="modal-overlay"></div>

                                <!-- Conteneur des notifications -->
                                <div class="modal-content">

                                    <button id="close-modal">
                                        <span>x</span>
                                    </button>

                                    <h2>Notifications</h2>
                                    
                                    <ul>

                                        <div id="userNotifications">

                                            @foreach ($notifications as $notification)

                                                <div class="user-notification">

                                                    <div class="id">
                                                        <img src="{{ asset('/img1/cloche.png') }}" alt="">
                                                        <p>{{ $notification->created_at->format('d/m/Y, H:i') }}</p>
                                                    </div>

                                                    <br>
                                                    <h3>{{ $notification->title }}</h3>
                                                    <p>{{ $notification->message }}</p>   

                                                </div>
                                        
                                            @endforeach

                                        </div>

                                    </ul>
                                    
                                </div>

                            </div>

                        </div>

                        <div class="user-settings">

                            <!-- Icône de paramètre -->
                            <div id="settings-icon" style="cursor: pointer;">
                                <i class="fas fa-cog"></i>
                            </div>

                            <!-- Fond semi-transparent -->
                            <div id="settings-overlay"></div>

                            <!-- Modal de paramètres -->
                            <div id="settings-modal">
                               
                                <!-- Bouton de fermeture -->
                                <button id="close-settings">&times;</button>

                                <h3>Paramètres</h3>

                                <!-- Sélection de la langue -->
                                <div>
                                    <select id="language-select" style="width: 100%; padding: 5px; margin-top: 10px; font-weight:bold" aria-placeholder="Langues de la Plateforme">
                                        <option value="fr" selected>Français</option>
                                        <option value="en">English</option>

                                    </select>
                                </div>

                                <!-- Informations de connexion -->
                                <div style="margin-top: 20px;">
                                    <h4>Informations de connexion :</h4>
                                    <p>Email: {{ $user->email }}</p>
                                </div>
                                
                            </div>
                        </div>

                        <script>
                            // Récupération des éléments
                            const settingsIcon = document.getElementById('settings-icon');
                            const settingsModal = document.getElementById('settings-modal');
                            const settingsOverlay = document.getElementById('settings-overlay');
                            const closeSettings = document.getElementById('close-settings');

                            // Affichage du modal et de l'overlay
                            settingsIcon.addEventListener('click', () => {
                                settingsModal.style.display = 'block';
                                settingsOverlay.style.display = 'block';
                            });

                            // Fermeture du modal et de l'overlay
                            closeSettings.addEventListener('click', () => {
                                settingsModal.style.display = 'none';
                                settingsOverlay.style.display = 'none';
                            });

                            // Clic sur l'overlay pour fermer
                            settingsOverlay.addEventListener('click', () => {
                                settingsModal.style.display = 'none';
                                settingsOverlay.style.display = 'none';
                            });

                        </script>

                    </div>

                </header>

                <main class="main">

                    <section id="accueil" class="accueil section">

                        <h2 class="titre">Bienvenue sur votre espace membre</h2>
                        
                        <div class="representant">

                            <div class="modif">

                                <h2 class="title">Les Représentants du Bureau Exécutif</h2>

                                <button id="btn-modifier" class="btn btn-primary">  

                                    <img src="{{ asset('/img3/pen.png') }}" alt="">
                                    <p>Modifier</p>
                                </button>

                            </div>
                            
                            <div class="representants">

                                @if(isset($user))

                                    <div class="representants1">
                                        <img src="{{ asset('storage/' . $user->attachment1) }}" alt="Président" style="object-fit: cover;">
                                        <h2>{{ $user->namePresident }} {{ $user->lastNamePresident }}</h2>
                                        <p>Président</p>
                                    </div>

                                    <div class="representants1">
                                        <img src="{{ asset('storage/' . $user->attachment2) }}" alt="Vice-Président">
                                        <h2>{{ $user->nameVicePresident }} {{ $user->lastNameVicePresident }}</h2>
                                        <p>Vice-Président</p>
                                    </div>

                                    <div class="representants1">
                                        <img src="{{ asset('storage/' . $user->attachment3) }}" alt="Sécrétaire Général">
                                        <h2>{{ $user->nameSecretaireGeneral }} {{ $user->lastNameSecretaireGeneral }}</h2>
                                        <p>Sécrétaire Général</p>
                                    </div>
                                    
                                    <div class="representants1">
                                        <img src="{{ asset('storage/' . $user->attachment4) }}" alt="Trésorier Général">
                                        <h2>{{ $user->nameTresorierGeneral }} {{ $user->lastNameTresorierGeneral }}</h2>
                                        <p>Trésorier Général</p>
                                    </div>

                                @else
                                    <p>Informations des représentants non disponibles.</p>
                                @endif

                            </div>

                            <!-- Div contenant le formulaire -->
                            <div id="form-modifier">

                                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="ferm">

                                        <button type="button" class="btn btn-secondary" onclick="closeForm()">&times;</button>

                                        <h2>Modification Informations membres</h2>

                                        <div>
                                            <button id="button" type="submit" class="btn btn-primary"><p>Enregistrer</p></button>
                                        </div>

                                    </div>
                                      
                                    <div class="ferme">

                                        <h2>Président</h2>

                                        <label for="namePresident" style="width: 300px;">Nom <span style="color: red;">*</span></label><br>

                                        <input type="text" id="namePresident" name="namePresident" value="{{ $user->namePresident }}" required>

                                    </div>

                                    <div class="ferme">

                                        <label for="lastNamePresident" style="width: 300px;">Prénom <span style="color: red;">*</span></label><br>
                                        
                                        <input type="text" id="lastNamePresident" name="lastNamePresident" value="{{ $user->lastNamePresident }}" required>
                                    
                                    </div>

                                    <div class="president">

                                        <label for="attachment1" class="file-label" id="image">

                                            <span class="material-symbols-outlined">add</span>

                                            <p>Photo du Président</p>

                                            <input type="file" id="attachment1" name="attachment1" accept="image/*" class="file-input">

                                        </label>

                                        <p>(Fichier image du Président)</p>
                                    </div>

                                    <div class="ferme">

                                        <h2>Vice Président</h2>

                                        <label for="nameVicePresident">Nom <span style="color: red;">*</span></label><br>

                                        <input type="text" id="nameVicePresident" name="nameVicePresident" value="{{ $user->nameVicePresident }}" required>
                                    
                                    </div>

                                    <div class="ferme">

                                        <label for="lastNameVicePresident" style="width: 300px;">Prénom <span style="color: red;">*</span></label><br>
                                        
                                        <input type="text" id="lastNameVicePresident" name="lastNameVicePresident" value="{{ $user->lastNameVicePresident }}" required>
                                    
                                    </div>

                                    <!-- Photo de pièce jointe -->
                                    <div class="president">

                                        <label for="attachment2" class="file-label" id="image">

                                            <span class="material-symbols-outlined">add</span>

                                            <p>Photo du Vice Président</p>

                                            <input type="file" id="attachment2" name="attachment2" accept="image/*" class="file-input">

                                        </label>

                                        <p>(Fichier image du Vice-Président)</p>
                                    </div>

                                    <div class="ferme">

                                        <h2>Secretaire Général</h2>

                                        <label for="nameSecretaireGeneral" style="width: 300px;">Nom <span style="color: red;">*</span></label><br>

                                        <input type="text" id="nameSecretaireGeneral" name="nameSecretaireGeneral" value="{{ $user->nameSecretaireGeneral }}" required>

                                    </div>

                                    <div class="ferme">

                                        <label for="lastNameSecretaireGeneral" style="width: 300px;">Prénom <span style="color: red;">*</span></label><br>

                                        
                                        <input type="text" id="lastNameSecretaireGeneral" name="lastNameSecretaireGeneral" value="{{ $user->lastNameSecretaireGeneral }}" required>
                                    </div>

                                    <!-- Photo de pièce jointe -->
                                    <div class="president">

                                        <label for="attachment3" class="file-label" id="image">

                                            <span class="material-symbols-outlined">add</span>

                                            <p>Photo du Secrétaire Général</p>

                                            <input type="file" id="attachment3" name="attachment3" accept="image/*" class="file-input">

                                        </label>

                                        <p>(Fichier image du Secrétaire Général)</p>

                                    </div>

                                    <div class="ferme">

                                        <h2>Trésoroer Général</h2>

                                        <label for="nameTresorierGeneral" style="width: 300px;">Nom <span style="color: red;">*</span></label><br>
                                        
                                        <input type="text" id="nameTresorierGeneral" name="nameTresorierGeneral" value="{{ $user->nameTresorierGeneral }}" required>
                                    </div>

                                    <div class="ferme">

                                        <label for="lastNameTresorierGeneral" style="width: 300px;">Prénom <span style="color: red;">*</span></label><br>
                                        
                                        <input type="text" id="lastNameTresorierGeneral" name="lastNameTresorierGeneral" value="{{ $user->lastNameTresorierGeneral }}" required>
                                    
                                    </div>

                                    <!-- Photo de pièce jointe -->
                                    <div class="president">

                                        <label for="attachment4" class="file-label" id="image">

                                            <span class="material-symbols-outlined">add</span>

                                            <p>Photo du Trésorier Général</p>

                                            <input type="file" id="attachment4" name="attachment4" accept="image/*" class="file-input">

                                        </label>
                                        
                                        <p>(Fichier image du Trésorier Général)</p>

                                    </div>

                                </form>

                            </div>

                            <script>
                                document.getElementById('btn-modifier').addEventListener('click', function() {
                                    const form = document.getElementById('form-modifier');
                                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                                });

                                function closeForm() {
                                    document.getElementById('form-modifier').style.display = 'none';
                                }

                                function openForm() {
                                    document.getElementById("form-modifier").style.display = "block";
                                }

                                function closeForm() {
                                    document.getElementById("form-modifier").style.display = "none";
                                }
                            </script>

                        </div>
                        
                        <div class="mes-activites">

                            <button id="btn-mes-activites" class="btn">Mes activités</button>
                            <button id="btninf" class="btn1">Informations Générales</button>

                        </div>

                        <div id="form-activite">

                            <form action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">

                                <div class="titre">

                                    <div class="trait"></div>
                                    <h1>Publié une activité...</h1>

                                </div>

                                @csrf
                                <div>
                                    <label for="titre">Titre</label>
                                    <br>
                                    <input type="text" id="titre" name="titre" placeholder="Veuillez mettre le titre de l'activité ici" required>
                                </div>

                                <div>
                                    <label for="description">Description</label> <br>
                                    <textarea id="description" name="description" placeholder="Veuillez mettre une description de l'activité ici" required></textarea>
                                </div>

                                <div class="champ">

                                    <div class="champ-file">
                                        <label for="attachment" id="label-attachment" class="file-label">
                                            <i class="fa-solid fa-image"></i> <p>Ajouter une image</p>
                                        </label>

                                        <input type="file" id="attachment" name="attachment" required class="file-input">
                                    </div>

                                    <div class="champ-lieu">
                                        <label for="lieu" id="label-lieu">
                                            <i class="fa-solid fa-location-dot"></i> <p>Lieu de l'activité</p>
                                        </label>
                                        <input type="text" id="lieu" name="lieu">
                                    </div>

                                    <div class="champ-date">
                                        <label for="date" id="label-date">
                                            <i class="fa-solid fa-calendar-days"></i> <p>Période de l'activité</p> 
                                        </label>
                                        <input type="date" id="date" name="date" required>
                                    </div>
                                    
                                </div>

                                <br>
                                <br>
                                <div>
                                    <label for="beneficiaries_expected" style="width: 400px;">Nombre de bénéficiaires prévus</label>
                                    <br>
                                    <input type="number" id="beneficiaries_expected" 
                                        name="beneficiaries_expected" 
                                        placeholder="Nombre de bénéficiaires attendus" required>
                                </div>

                                <div>
                                    <label for="budget_expected">Budget prévu (FCFA)</label>
                                    <br>
                                    <input type="number" step="0.01" id="budget_expected" 
                                        name="budget_expected" 
                                        placeholder="Budget prévu pour l'activité" required>
                                </div>

                                <button type="submit" class="btn6">Publier une activité</button>

                            </form>
                            
                        </div>

                        <script>
                            const labelLieu = document.getElementById('label-lieu');
                            const inputLieu = document.getElementById('lieu');

                            const labelDate = document.getElementById('label-date');
                            const inputDate = document.getElementById('date');

                            labelLieu.addEventListener('click', () => {
                                inputLieu.style.display = "block";
                                inputLieu.focus();
                            });

                            labelDate.addEventListener('click', () => {
                                inputDate.style.display = "block";
                                inputDate.focus();
                            });

                        </script>

                        <div class="activites-list">
                            
                            <h2>Historique de vos activités publiées</h2>

                            @foreach($activities as $activity)

                                @if($activity->is_visible)

                                    <div class="activite-item">

                                        <div class="activites">
                                            <img src="{{ asset('storage/attachments/' . basename($activity->attachment)) }}" alt="{{ $activity->titre }}" >
                                        </div>

                                        <div class="activites1">

                                            <div class="activitesA">

                                                <div class="AD">
                                                    <img src="{{ asset('storage/' . $user->attachment) }}" alt="logo">
                                                </div>

                                                <div class="AC">
                                                    <h2>{{ $user->name }}</h2>
                                                    <p>{{ $user->domaine }}</p>
                                                </div>

                                            </div>

                                            <div class="heure">
                                                <div class="tr"></div>
                                                <p>{{ $activity->created_at->format('d-m-Y H:i') }}</p>
                                            </div>

                                            <h3>{{ $activity->titre }}</h3>

                                            <p>{{ $activity->description }}</p>

                                            <div>

                                                <!-- Bouton pour ouvrir le modal -->
                                                <button type="button" class="btn2" data-bs-toggle="modal" data-bs-target="#detailsModal-{{ $activity->id }}">
                                                    Voir détails
                                                </button>

                                                <button type="button" class="btn1" data-bs-toggle="modal" data-bs-target="#editModal-{{ $activity->id }}">
                                                    <img src="{{ asset('/img3/pen.png') }}" alt="">
                                                </button>

                                                <form action="{{ route('activites.destroy', $activity->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <img src="{{ asset('/img3/trash.png') }}" alt="">
                                                    </button>
                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- Modal pour afficher les détails de l'activité -->
                                    <div class="modal fade" id="detailsModal-{{ $activity->id }}" tabindex="-1" aria-labelledby="detailsModalLabel-{{ $activity->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">

                                            <div class="modal-content">
                                                
                                                <div class="modal-header">
                                                    <div class="part1">
                                                        <div class="lo">
                                                            <img src="{{ asset('storage/' . $user->attachment) }}" alt="logo">
                                                        </div>

                                                        <div class="lo1">
                                                            <h2>{{ $user->name }}</h2>
                                                            <p>{{ $user->domaine }}</p>
                                                        </div>
                                                    </div>                                            
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                
                                                <div class="activites">
                                                    <img src="{{ asset('storage/attachments/' . basename($activity->attachment)) }}" alt="{{ $activity->titre }}">
                                                </div>

                                                <h1>{{ $activity->titre }}</h1>

                                                <div class="modal-body">
                                                    <p>{{ $activity->description }}</p>
                                                    
                                                    <div class="dat">
                                                        <div class="dat1">
                                                            <h2>
                                                                <img src="{{ asset('/img2/broche-de-localisation.png') }}" alt="">
                                                                Lieu de l'activité
                                                            </h2>
                                                            <p>{{ $activity->lieu }}</p>
                                                        </div>

                                                        <div class="dat2">
                                                            <h2>
                                                                <img src="{{ asset('/img2/calendrier-2.png') }}" alt="">
                                                                Date ou Période de l'activité
                                                            </h2>
                                                            <p>{{ $activity->date }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="da">
                                                        <p>Publié le {{ $activity->created_at->format('d-m-Y H:i') }}</p>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <!-- Modal pour modifier l'activité -->
                                    <div class="modal fade" id="editModal-{{ $activity->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $activity->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel-{{ $activity->id }}">Modifier l'activité</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="{{ route('activites.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="titre-{{ $activity->id }}" class="form-label">Titre</label>
                                                            <input type="text" class="form-control" id="titre-{{ $activity->id }}" name="titre" value="{{ $activity->titre }}" required style="width: 300px;">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description-{{ $activity->id }}" class="form-label">Description</label>
                                                            <textarea class="form-control" id="description-{{ $activity->id }}" name="description" rows="3" required style="width: 300px;">{{ $activity->description }}</textarea>
                                                        </div>

                                                        <div class="mb-3" >
                                                            <label for="attachment-{{ $activity->id }}" class="form-label">Image</label>
                                                            <input type="file" class="form-control" id="attachment-{{ $activity->id }}" name="attachment" style="width: 400px;">
                                                        </div>

                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre réel de bénéficiaires</label>
                                                        <input type="number" class="form-control"
                                                            name="beneficiaries_actual"
                                                            value="{{ $activity->beneficiaries_actual }}"
                                                            style="width: 300px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Budget réel utilisé (FCFA)</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                            name="budget_actual"
                                                            value="{{ $activity->budget_actual }}"
                                                            style="width: 300px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Date réelle de l'activité</label>
                                                        <input type="date" class="form-control"
                                                            name="actual_date"
                                                            value="{{ $activity->actual_date }}"
                                                            style="width: 300px;">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                            @endforeach
                           
                        </div>

                        <div id="infos" class="deno" style="display: none;">

                            <button id="btn-modifie" class="btn-modifie">
                                                                                
                                <img src="{{ asset('/img3/pen.png') }}" alt="">

                                <p>Modifier les informations générales</p>
                            
                            </button>


                            <div class="texte1">

                                <h2>
                                    <span>Dénomination:</span> 
                                    << {{ $user->denomination ?? 'Non spécifiée' }} >> Créé le {{ $user->date ? \Carbon\Carbon::parse($user->date)->format('d/m/Y') : '...' }}
                                </h2>
                                
                            </div>

                            <div class="texte2">

                                <h2>Les Objectifs:</h2>

                                <div class="objectifs-container">
                                    <li>{{ $user->objectif1 }}</li>
                                    <li>{{ $user->objectif2 }}</li>
                                    <li>{{ $user->objectif3 }}</li>
                                </div>
                                
                            </div>

                            <div class="texte3">
                                <h2>Siège:</h2>
                                <div class="localisation-container">
                                    <p>{{ $user->siege }}</p>
                                </div>
                            </div>
                
                            <div class="texte4">
                                <h2>Contact: </h2>
                                <div class="contact-container">
                                    <p>. Téléphones : (+229) {{ $user->number1 }} / {{ $user->number2 }}</p>
                                    <p>. Email : {{ $user->email }}</p>
                                </div>
                            </div>
                
                        </div>

                        <div id="editFormUser" class="form-modifier">

                            <form action="{{ route('user.updateInfos', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="ferm">

                                    <button type="button" id="btn-fermer-form" onclick="closeForm()">&times;</button>

                                    <h2>Modification Informations membres</h2>

                                    <div>
                                        <button id="button" type="submit" class="btn-save"><p>Enregistrer</p></button>
                                    </div>

                                </div>

                                <div class="contenue">
                                     
                                    <div class="partie1">

                                        <div class="content">

                                            <h4>Photo de profil ou Logo</h4>
                                            
                                            <label for="attachment" class="file-label" id="image">

                                                <span class="material-symbols-outlined">add</span>

                                                <p>Photo ou Logo</p>

                                                <input type="file" id="attachment" name="attachment" accept="image/*" class="file-input">

                                            </label>

                                        </div>

                                        <div class="content">

                                            <h4>Image de couverture</h4>
                                            
                                            <label for="attachment5" class="file-label" id="image">

                                                <span class="material-symbols-outlined">add</span>

                                                <p>Image de couverture</p>

                                                <input type="file" id="attachment5" name="attachment5" accept="image/*" class="file-input">

                                            </label>

                                        </div>
                                    </div>

                                    <div class="partie2">

                                        <label>Type de Groupe</label>
                                    
                                        <select id="groupe" name="groupe" required>
                                                    
                                            <option value="{{ $user->groupe }}" selected>
                                                {{ ucfirst($user->groupe) }}
                                            </option>

                                            @if($user->groupe !== 'ong')
                                                <option value="ong">ONG</option>
                                            @endif

                                            @if($user->groupe !== 'association')
                                                <option value="association">Association</option>
                                            @endif
                                                
                                        </select>

                                    </div>
                                    
                                    <div class="partie3">

                                        <div class="one">
                                            <label>Nom de l'association <span style="color: red;">*</span></label>
                                            <input type="text" name="name" value="{{ $user->name }}">
                                        </div>
                                        
                                        <div class="one2">
                                            <label>Dénomination <span style="color: red;">*</span></label>
                                            <input type="text" name="denomination" value="{{ $user->denomination }}">
                                        </div>
                                    
                                    </div>

                                    <div class="partie4">

                                        <div class="one">
                                            <label>Date de création <span style="color: red;">*</span></label>
                                            <input type="date" name="date" value="{{ $user->date }}">
                                        </div>
                                        
                                        <div class="one2">
                                            <label>Email <span style="color: red;">*</span></label>
                                            <input type="email" name="email" value="{{ $user->email }}">
                                        </div>
                                        
                                    </div>

                                    <div class="partie5">

                                        <div class="one">
                                            <label>Numéro de Téléphone 1 <span style="color: red;">*</span></label>
                                            <input type="text" name="number1" value="{{ $user->number1 }}">
                                        </div>
                                        
                                        <div class="one2">
                                            <label>Numéro de Téléphone 2 <span style="color: red;">*</span></label>
                                            <input type="text" name="number2" value="{{ $user->number2 }}">
                                        </div>
                                        
                                    </div>

                                    <div class="partie6">
                                        <label>Siège <span style="color: red;">*</span></label>
                                        <input type="text" name="siege" value="{{ $user->siege }}">
                                    </div>

                                    <div class="partie7">

                                        <label>Objectif 1 <span style="color: red;">*</span></label>
                                        <input type="text" name="objectif1" value="{{ $user->objectif1 }}">

                                    </div>

                                    <div class="partie8">

                                        <label>Objectif 2 <span style="color: red;">*</span></label>
                                        <input type="text" name="objectif2" value="{{ $user->objectif2 }}">

                                    </div>

                                    <div class="partie9">

                                        <label>Objectif 3 <span style="color: red;">*</span></label>
                                        <input type="text" name="objectif3" value="{{ $user->objectif3 }}">

                                    </div>

                                    <div class="partie10">
                                        <div class="content">

                                            <h4>Signature</h4>
                                            
                                            <label for="signature_data" class="file-label" id="image">

                                                <span class="material-symbols-outlined">add</span>

                                                <p>Photo ou Logo</p>

                                                <input type="file" id="signature_data" name="signature_data" accept="image/*" class="file-input">

                                            </label>

                                        </div>
                                    </div>

                                    <div class="partie11">
                                        <div class="content">

                                            <h4>Cachet</h4>
                                            
                                            <label for="cachet" class="file-label" id="image">

                                                <span class="material-symbols-outlined">add</span>

                                                <p>Photo ou Logo</p>

                                                <input type="file" id="cachet" name="cachet" accept="image/*" class="file-input">

                                            </label>

                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </section>

                    <section id="demande" class="demande section">

                        <div class="demande-title">

                            <h2>Soumission de demande d'accompagnement</h2>

                            <div>
                                <button class="btn-with-image" onclick="showUserRequests();">
                                    <span class="btn-text">Statut d'une demande</span>
                                </button>
                            </div>

                        </div>

                        <div class="demande-container1">

                            <p>Les associations et ONG de la commune de Cotonou peuvent soumettre ici leurs demandes d'accompagnement pour obtenir des ressources, des partenariats, ou un soutien pour leurs projets.
                                <br>
                                <span>
                                    Critères de soumission
                                    <br>
                                    . La demande doit concerner des projets dans la commune de Cotonou. <br>
                                    Document nécessaire <br>
                                    . La demande doit comporter un documents PDF Contenant (devis, plan de projet, et tous les informations nécessaire.)
                                </span>
                            </p>

                            <p>Remplissez le formulaire ci-dessous pour que votre demande soit traitée par la mairie</p>

                        </div>

                        <div class="formulaire">
                            <br>

                            <h1>Formulaire de soumission de demande</h1>

                            <form action="{{ route('courrier.generate') }}" method="POST" enctype="multipart/form-data" style="height: 850px;">

                                @csrf

                                <div class="form-group">
                                    <label for="title">Titre de la demande <span>*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Taper le titre du projet" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type">Type d'accompagnement <span>*</span></label>
                                    <select id="type" name="type" required>
                                        <option value="Attestation de Présence">Attestation de Présence</option>
                                        <option value="Lettre de Recompmandation">Lettre de Recommandation</option>
                                        <option value="Demande de partenariat">Demande de partenariat</option>
                                        <option value="Demande d'Assistance technique, matérielle et Financière">Demande d'Assistance technique, matérielle et Financière</option>
                                        <option value="Demande D'autorisation">Demande D'autorisation</option>
                                        <option value="Demande de reconnaissance ou d'existence">Demande de reconnaissance ou d'existence</option>

                                    </select>                                    
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="location">Lieu d'intervention <span>*</span></label>
                                    <input type="text" class="form-control" id="title" name="location" placeholder="Taper le lieu d'intervention (quartier ou zone géographique dans Cotonou)" value="{{ old('location') }}" required>
                                    @error('location')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Description brève du projet <span>*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="destinataire">Destinataire :</label>
                                    <select name="destinataire" id="destinataire" required>
                                        <option value="Maire de la Commune de Cotonou">Maire de la Commune de Cotonou</option>
                                        <option value="Secretaire exécutif">Secretaire exécutif</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="reference">Numéro de Référence <span>*</span></label>
                                    <textarea class="form-control" id="reference" name="reference" required>{{ old('reference') }}</textarea>
                                    @error('reference')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button id="bouton" type="submit" class="btn btn-primary">Soumettre</button>

                            </form>

                        </div>

                    </section>

                    <section id="user-requests" style="display: none;">

                        <div class="requests-container">
                            <h2>Vérifier le statut d'une demande</h2>
                        </div>

                        <div class="container1">
                            <p>Cette page vous permet de suivre l’avancement de votre demande d’accompagnement auprès de la mairie de Cotonou. En quelques clics, consultez le statut de votre demande, qu’elle soit en cours de traitement, approuvée ou en attente de documents supplémentaires. Restez informé en temps réel pour savoir où en est votre projet et les prochaines étapes à suivre.</p>
                        </div>

                        <form action="{{ route('check.request.status') }}" method="GET" style="margin-bottom: 20px;">
                            @csrf
                            <label for="request-name">Nom de la demande :</label>
                            <input type="text" id="request-name" name="request_name" placeholder="Entrez le nom de la demande" required>
                            <button id="bu" type="submit">Vérifier</button>
                        </form>
                        
                    </section>

                </main>
            </div>
        </div>

        <script>

            document.getElementById('bell').addEventListener('click', function() {
                document.getElementById('userNotifications').style.display = 'block';
            });

            document.addEventListener('DOMContentLoaded', function () {
                const bell = document.getElementById('bell');
                const modal = document.getElementById('notifications-modal');
                const closeModal = document.getElementById('close-modal');
                const overlay = document.getElementById('modal-overlay');

                // Ouvrir la modal
                bell.addEventListener('click', function () {
                    modal.style.display = 'block';
                });

                // Fermer la modal
                closeModal.addEventListener('click', function () {
                    modal.style.display = 'none';
                });

                // Fermer en cliquant sur le fond
                overlay.addEventListener('click', function () {
                    modal.style.display = 'none';
                });
            });

            function showUserRequests() {
                // Masquer tout le contenu sauf #user-requests
                document.body.querySelectorAll('section').forEach(element => {
                    if (element.id !== 'user-requests') {
                        element.style.display = 'none';
                    }
                });

                // Afficher la section #user-requests
                document.getElementById('user-requests').style.display = 'block';
            }

            // Attendre que la page soit chargée
            document.addEventListener('DOMContentLoaded', function () {
                // Récupérer tous les liens de navigation
                const navLinks = document.querySelectorAll('.sidebar ul li a');
                const sections = document.querySelectorAll('main .section');

                // Fonction pour masquer toutes les sections
                function hideAllSections() {
                    sections.forEach(section => {
                        section.style.display = 'none';
                    });
                }

                // Ajouter un écouteur d'événement sur chaque lien
                navLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault(); // Empêche le comportement par défaut du lien
                        const target = document.querySelector(this.dataset.target);

                        if (target) {
                            // Masquer toutes les sections
                            hideAllSections();

                            // Afficher la section cible
                            target.style.display = 'block';
                        }
                    });
                });

                // Afficher uniquement la section d'accueil par défaut
                hideAllSections();
                document.querySelector('#accueil').style.display = 'block';
            });

            document.addEventListener("DOMContentLoaded", function () {
                const btnInfo = document.getElementById("btninf");
                const denoSection = document.querySelector(".deno");
                const formulaire = document.getElementById("form-activite");
                const liste = document.querySelector(".activites-list");

                // Ajouter un événement de clic sur le bouton
                btnInfo.addEventListener("click", function () {
                    // Basculer l'affichage de la section
                    if (denoSection.style.display === "none" || denoSection.style.display === "") {
                        denoSection.style.display = "block"; // Afficher la section
                        formulaire.style.display = "none";
                        liste.style.display = "none";
                    } else {
                        denoSection.style.display = "none"; // Masquer la section
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                const btnModifier  = document.getElementById("btn-modifie");
                const contenu      = document.getElementById("infos");
                const form         = document.getElementById("editFormUser");
                const btnFermer    = document.getElementById("btn-fermer-form");

                btnModifier.addEventListener("click", function() {
                    contenu.style.display = "none";
                    form.style.display = "block";
                });

                btnFermer.addEventListener("click", function() {
                    form.style.display = "none";
                    contenu.style.display = "block";
                });
            });
        </script>

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
        <script src="{{ asset('/js/show.js') }}"></script>
    </body>
</html>

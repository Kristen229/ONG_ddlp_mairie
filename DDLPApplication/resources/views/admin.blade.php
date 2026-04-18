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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        


        <!-- Main CSS File -->
        <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
        

    </head>

    <style>
        .status-dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .status-dot.en-attente {
            background-color: white;
            border-color: black;
        }

        .status-dot.acceptée {
            background-color: green;
            border-color: green;
        }

        .status-dot.rejetée {
            background-color: red;
            border-color: red;
        }


    </style>

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
                            Statistiques
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

                    <!-- Tableau des demandes en attente dans la section Dashboard -->
                    <section id="dashboard" class="section-content">

                        <h2>Bienvenue sur votre page admintrateur</h2>

                        <div class="dashboard-container">

                            <span>Donnée de suivie des associations et ONG</span>

                            <div class="container1">

                                <div class="containerA">

                                    <img src="{{ asset('/img1/silhouette-dutilisateurs-multiples.png') }}" alt="">
                                    <p>150 Associations et ONG actives</p>

                                </div>

                                <!-- Icône ou image qui déclenche l'affichage du tableau -->
                                <div class="toggle-button">

                                    @if(isset($pendingRequestsCount) && $pendingRequestsCount > 0)
                                        <span class="blue-dot"></span> <!-- Point bleu -->
                                        <img src="{{ asset('/img1/liste-de-travail.png') }}" alt="Afficher les demandes" class="toggle-icon" onclick="toggleTableVisibility()">
                                        <p>{{ $pendingRequestsCount }} demande(s) en attentes</p>
                                    @endif
                                    
                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="im">

                            <div class="im1">

                                <div class="nav-links">
                                    <a href="#gestionAsso"><img src="{{ asset('/img1/la-gestion.png') }}" alt=""></a>
                                </div>

                                <div>
                                    <h2>Gérer les associations et ONG</h2>
                                    <p>Ajouter, Supprimer ou modifier des associations et ONG</p>
                                </div>

                            </div>

                            <div class="im1">

                                <div class="nav-links">
                                    <a href="#admin-panel"><img src="{{ asset('/img1/liste-de-travail.png') }}" alt=""></a>
                                </div>

                                <div>
                                    <h2>Gérer les demandes d’accompagnement</h2>
                                    <p>Gérer les demandes d’accompagnement des associations et ONG</p>
                                </div>

                            </div>

                            <div class="im1" >

                                <div class="nav-links">
                                    <a href="#gestionNotif"><img src="{{ asset('/img1/cloche.png') }}" alt=""></a>
                                </div>

                                <div>
                                    <h2>Gérer les notifications</h2>
                                    <p>Envoyer des notifications aux associations et ONG</p>
                                </div>

                            </div>

                            <div class="im1" class="nav-links">

                                <div>
                                    <a href="#gestionAct"><img src="{{ asset('/img1/activites.png') }}" alt=""></a>
                                </div>

                                <div>
                                    <h2>Gérer les activités</h2>
                                    <p>Gérer les activités publiée des associations et ONG</p>
                                </div>

                            </div>

                        </div>
                        
                        <table class="requests-table hidden" id="pendingRequestsTable">

                            <thead>

                                <tr>
                                    <th>Nom de l'association</th>
                                    <th>Type de demande</th>
                                    <th>Date de soumission</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @if($requests->isNotEmpty())

                                    @foreach ($requests as $request)

                                        @if($request->statut == 'En attente')

                                            <tr id="pending-request-{{ $request->id }}" class="pending">

                                                <td>{{ $request->user->name }}</td>
                                                <td>{{ $request->type }}</td>
                                                <td>{{ $request->created_at ? $request->created_at->format('d/m/Y') : 'N/A' }}</td>

                                                <td>
                                                    <span class="status">{{ ucfirst($request->statut) }}</span>
                                                </td>

                                                <td>
                                                    <button onclick="showDetails('{{ $request->id }}')">Voir plus</button>
                                                </td>

                                            </tr>

                                        @endif

                                    @endforeach
                                    
                                @endif

                            </tbody>

                        </table>

                    </section>

                    <!-- admin.blade.php -->
                    <section id="gestionAsso" class="section-content">

                        <div class="part1">

                            @if(isset($userCount))

                                <div class="contentA">
                                    
                                    <p>{{ $userCount }}</p>

                                    <div class="contentA1">

                                        <img src="{{ asset('/img1/ecole.jpg') }}" alt="Logo" class="rounded-circle">
                                                
                                        <h5>Associations/ONG enregistrées</h5>
                                            
                                    </div>

                                </div>

                            @endif

                            @if(isset($associationCount))

                                <div class="contentB">
                                    
                                    <p>{{ $associationCount }}</p>

                                    <div class="contentB1">

                                        <img src="{{ asset('/img2/asso.jpeg') }}" alt="Logo" class="rounded-circle">
                                                
                                        <h5>Associations enregistrées</h5>
                                            
                                    </div>

                                </div>
                                
                            @endif

                            @if(isset($ongCount))

                                <div class="contentC">
                                    
                                    <p>{{ $ongCount }}</p>

                                    <div class="contentC1">

                                        <img src="{{ asset('/img2/ong.jpeg') }}" alt="Logo" class="rounded-circle">
                                                
                                        <h5>ONG enregistrées</h5>
                                            
                                    </div>

                                </div>
                                
                            @endif
                            
                        </div>
                        
                        <div class="gestionAsso-container">
                            
                            <div class="container1">

                                <div class="one">
                                    <p>Liste des associations et ong</p>
                                </div>

                                <div class="two">
                                    <button class="btn-with-image" onclick="window.location.href='admin/createForm1';">
                                        <span class="btn-text">Ajouter une nouvelle Association ou ONG</span>
                                    </button>
                                </div>
                                
                            </div>

                        </div>

                        <div class="new">
                            
                            <div class="tab">

                                <button class="tabe active" data-filter="all">Tout</button>
                                <button class="tabe" data-filter="association">Association</button>
                                <button class="tabe" data-filter="ong">ONG</button>

                            </div>

                            <!-- Boutons -->
                            <div class="controls">

                                <div class="dropdown">

                                    <button class="filterBtn">
                                        Filtre 
                                        <span class="material-symbols-outlined" style="color: black;">filter</span>
                                    </button>

                                    <div class="dropdown-content" style="display: none;">
                                        <a href="#" class="tab-link" data-tab="user-list">Auto-enregistrées</a>
                                        <a href="#" class="tab-link" data-tab="admin-list">Enregistrées par la mairie</a>
                                    </div>

                                </div>  

                               <!-- Ton bouton -->
                                <button class="btn-filter" style="height: 60px;">
                                    Exporter
                                    <span class="material-symbols-outlined" style="color: black;">file_export</span>
                                </button>

                                <form action="{{ route('pdf.exportByDomaine') }}" method="GET" target="_blank" style="display:flex; gap:10px; height: 60px; margin-top: -1px">
    
                                    <select name="domaine" required>
                                        <option value="">-- Choisir un domaine --</option>
                                        <option value="Santé">Santé</option>
                                        <option value="Education">Éducation</option>
                                        <option value="Social">Social</option>
                                        <option value="Environnement">Environnement</option>
                                    </select>

                                    <button type="submit" class="btn-filter" style="color:black; width: 200px;">
                                        Exporter par domaine
                                        <span class="material-symbols-outlined">picture_as_pdf</span>
                                    </button>

                                </form>

                                <!-- Ta liste cachée -->
                                <div class="export-list" style="display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 10px;">
                                    <ul>

                                        @foreach($users as $user)

                                            <li>
                                                <a href="{{ route('pdf.download', $user->id) }}" target="_blank">
                                                    Télécharger le PDF de {{ $user->name }}
                                                </a>
                                            </li>

                                        @endforeach

                                    </ul>
                                </div>
                                
                            </div>

                        </div>

                        <!-- Tableau principal -->
                        <div class="tableau" id="list" style="margin-left: 100px; margin-top: 50px;">

                            <table class="table table-bordered table-striped" >

                                <thead>

                                    <tr>
                                        <th>LOGO</th>
                                        <th>NOM</th>
                                        <th>TYPE DE GROUPE</th>
                                        <th>DOMAINE</th>
                                        <th>DATE D'ENREGISTREMENT</th>
                                        <th>ACTION</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @if(isset($associations) && $associations->count() > 0)

                                        @foreach($associations as $user)

                                            <tr class="table-success" data-type="{{ $user->groupe }}">

                                                <td>
                                                    @if($user->attachment)
                                                        <img src="{{ asset('storage/attachments/' . basename($user->attachment)) }}" alt="Logo" width="50" height="50">
                                                    @else
                                                        Pas de logo
                                                    @endif
                                                </td>

                                                <td>{{ $user->name ?? 'Nom non disponible' }}</td>

                                                <td>{{ $user->groupe ?? 'Non défini' }}</td>

                                                <td>{{ $user->domaine ?? 'Non défini' }}</td>

                                                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Date inconnue' }}</td>

                                                <td>
                                                    <a href="{{ route('account.show', $user->id) }}" class="btn btn-info btn-sm" style="color: black;">Voir Plus</a>
                                                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm"><img src="{{ asset('/img3/pen.png') }}" alt="" style="width: 30px; height: 30px;"></a>
                                                    <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ?')">
                                                            <img src="{{ asset('/img3/trash.png') }}" alt="" style="width: 30px; height: 30px;">                                                        
                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Aucune association créée par les utilisateurs.</td>
                                        </tr>
                                    @endif

                                </tbody>

                            </table>

                        </div>

                        <!-- Tableau Auto-enregistrées -->
                        <div class="tab-content" id="user-list" style="margin-top: 20px; display: none;">
    
                            <table class="table table-bordered table-striped">

                                <thead>

                                    <tr>
                                        <th>LOGO</th>
                                        <th>NOM</th>
                                        <th>TYPE DE GROUPE</th>
                                        <th>DOMAINE</th>
                                        <th>DATE D'ENREGISTREMENT</th>
                                        <th>ACTION</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($userAssociations as $user)

                                        <tr>

                                            <td>
                                                @if($user->attachment)
                                                    <img src="{{ asset('storage/attachments/' . basename($user->attachment)) }}" alt="Logo" width="50">
                                                @else
                                                    Pas de logo
                                                @endif
                                            </td>

                                            <td>{{ $user->name ?? 'Nom non disponible' }}</td>

                                            <td>{{ $user->groupe ?? 'Non défini' }}</td>
                                                
                                            <td>{{ $user->domaine ?? 'Non défini' }}</td>
                                            
                                            <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Date inconnue' }}</td>
                                                                                            
                                            <td>
                                                <a href="{{ route('account.show', $user->id) }}" class="btn btn-info btn-sm" style="color: black;">Voir Plus</a>
                                                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm"><img src="{{ asset('/img3/pen.png') }}" alt="" style="width: 30px; height: 30px;"></a>
                                                <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ?')">
                                                        <img src="{{ asset('/img3/trash.png') }}" alt="" style="width: 30px; height: 30px;">                                                        
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="3">Aucune association créée par les utilisateurs.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
    
                            </table>

                        </div>

                        <!-- Tableau Enregistrées par la mairie -->
                        <div class="tab-content" id="admin-list" style="margin-top: 20px; display: none;">
    
                            <table class="table table-bordered table-striped">

                                <thead>

                                    <tr>
                                        <th>LOGO</th>
                                        <th>NOM</th>
                                        <th>TYPE DE GROUPE</th>
                                        <th>DOMAINE</th>
                                        <th>DATE D'ENREGISTREMENT</th>
                                        <th>ACTION</th>
                                    </tr>

                                </thead>
                                
                                <tbody>
                                    @forelse($adminAssociations as $user)
                                        <tr>

                                            <td>
                                                @if($user->attachment)
                                                    <img src="{{ asset('storage/attachments/' . basename($user->attachment)) }}" alt="Logo" width="50">
                                                @else
                                                    Pas de logo
                                                @endif
                                            </td>

                                            <td>{{ $user->name ?? 'Nom non disponible' }}</td>

                                            <td>{{ $user->groupe ?? 'Non défini' }}</td>
                                                
                                            <td>{{ $user->domaine ?? 'Non défini' }}</td>
                                            
                                            <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Date inconnue' }}</td>
                                                                                            
                                            <td>
                                                <a href="{{ route('account.show', $user->id) }}" class="btn btn-info btn-sm" style="color: black;">Voir Plus</a>
                                                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm"><img src="{{ asset('/img3/pen.png') }}" alt="" style="width: 30px; height: 30px;"></a>
                                                <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ?')">
                                                        <img src="{{ asset('/img3/trash.png') }}" alt="" style="width: 30px; height: 30px;">                                                        
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Aucune association créée par la mairie.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>

                        </div>

                        <script>

                            function  updateUserType2(userId) {
                                // Envoie une requête pour enregistrer l'ID de l'utilisateur dans la session et redirige vers la page de modification
                                fetch(`/admin/user/update/{id}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({ userId })
                                }).then(() => {
                                    window.location.href = '/admin/updateUserType2';
                                });
                            }
                            
                            function deleteUser(userId) {
                                if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
                                    // Effectue la suppression via AJAX
                                    fetch(`/admin/deleteUser/${userId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        }
                                    }).then(response => {
                                        if (response.ok) {
                                            // Recharge la page après suppression
                                            window.location.reload();
                                        } else {
                                            alert("Erreur lors de la suppression de l'utilisateur.");
                                        }
                                    });
                                }
                            }

                            document.addEventListener("DOMContentLoaded", function () {
                                const filterBtn = document.querySelector(".filterBtn");
                                const dropdownContent = document.querySelector(".dropdown-content");
                                const tabLinks = document.querySelectorAll(".tab-link"); // correction ici
                                const mainTable = document.getElementById("list");
                                const tabButtons = document.querySelectorAll('.tabe');
                                const allTables = document.querySelectorAll(".tab-content");

                                // Toggle dropdown
                                filterBtn.addEventListener("click", () => {
                                    dropdownContent.style.display =
                                        dropdownContent.style.display === "block" ? "none" : "block";
                                });

                                // Onglets dropdown
                                tabLinks.forEach(link => {
                                    link.addEventListener("click", (e) => {
                                        e.preventDefault();
                                        const target = link.dataset.tab;
                                        const content = document.getElementById(target);

                                        // Masquer tous les tableaux secondaires
                                        allTables.forEach(c => c.style.display = "none");

                                        // Afficher le tableau choisi
                                        if (content) content.style.display = "block";

                                        // Masquer tableau principal
                                        if (mainTable) mainTable.style.display = "none";

                                        // Masquer dropdown
                                        dropdownContent.style.display = "none";
                                    });
                                });

                                // Filtrage du tableau principal
                                tabButtons.forEach(button => {
                                    button.addEventListener('click', () => {
                                        tabButtons.forEach(btn => btn.classList.remove('active'));
                                        button.classList.add('active');

                                        const filter = button.dataset.filter;
                                        const rows = document.querySelectorAll('#list tbody tr');

                                        rows.forEach(row => {
                                            if (filter === "all" || row.dataset.type.toLowerCase() === filter) {
                                                row.style.display = "";
                                            } else {
                                                row.style.display = "none";
                                            }
                                        });
                                    });
                                });

                                // Activer le premier filtre
                                if (tabButtons.length > 0) tabButtons[0].click();
                            });

                            document.addEventListener("DOMContentLoaded", function () {
                                const exportBtn = document.querySelector(".btn-filter");
                                const exportList = document.querySelector(".export-list");

                                exportBtn.addEventListener("click", () => {
                                    // Toggle l’affichage
                                    if (exportList.style.display === "block") {
                                        exportList.style.display = "none";
                                    } else {
                                        exportList.style.display = "block";
                                    }
                                });

                                // Fermer si on clique ailleurs
                                document.addEventListener("click", (e) => {
                                    if (!exportBtn.contains(e.target) && !exportList.contains(e.target)) {
                                        exportList.style.display = "none";
                                    }
                                });
                            });

                        </script>

                    </section>
                    
                    <section id="admin-panel" class="section-content">
                        <h2>Gérer les demandes des associations et ONG</h2>

                        <!-- Tableau des demandes -->
                        <table class="requests-table" id="requestsTable" style="border-spacing: 0 10px; border-collapse: separate; width: 1000px; max-width: 100%;">
                            
                            <thead>

                                <tr>
                                    <th>Nom de l'association</th>
                                    <th>Type de demande</th>
                                    <th>Date de soumission</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            
                            <tbody class="spaced-tbody">
                            
                                @if($requests->count() > 0)

                                    @foreach ($requests as $request)

                                        <tr class="{{ $request->statut == 'En attente' ? 'pending' : '' }}">
                                            
                                            <td style="width: 1000px; font-weight: 500; font-size: 12px; Line-height: 18.3px; letter-spacing: -3%; font-family: Montserrat; color:black; background-color: white;">
                                        
                                                <div class="association-info" style="display: flex; align-items: center; gap: 10px;">
                                                    <img src="{{ asset('storage/' . $request->user->attachment) }}" alt="Logo" style="width: 50px; height: 50px; border-radius:50%;" >
                                                    <span>{{ $request->user->name }}</span>
                                                </div>

                                            </td>

                                            <td style="width: 1000px; font-weight: 500; font-size: 12px; Line-height: 18.3px; letter-spacing: -3%; font-family: Montserrat; color:black; background-color: white;">
                                                {{ $request->type }}
                                            </td>

                                            <td style="width: 1000px; font-weight: 500; font-size: 12px; Line-height: 18.3px; letter-spacing: -3%; font-family: Montserrat; color:black; background-color: white;">
                                                {{ $request->created_at->format('d/m/Y, H:i') }}
                                            </td>

                                            <td style="width: 1000px; font-weight: 500; font-size: 12px; line-height: 18.3px; letter-spacing: -3%; font-family: Montserrat; color:black; background-color: white;">
                                                <span class="status">
                                                    <span class="status-dot" style="background-color: {{ $request->statut === 'Acceptée' ? 'green' : ($request->statut === 'Refusée' ? 'red' : 'yellow') }};"> </span>
                                                    {{ ucfirst($request->statut) }}
                                                </span>
                                            </td>

                                            <td style="width: 1000px; padding: 10px; border-radius: 5px; background-color: white;">
                                                
                                                <button style="border: 2px solid #004B70; border-radius: 5px; width: 100px; height: 30px; background-color: white; color: black; font-size: 14px; cursor: pointer; padding-bottom: 25px;" onclick="showDetails('{{ $request->id }}')">
                                                    Voir plus 
                                                </button>

                                            </td>

                                        </tr>


                                    @endforeach

                                @endif

                            </tbody>

                        </table>

                        <!-- Overlay pour afficher les détails -->
                        <div id="details-overlay" class="overlay hidden" style="margin-left: 150px;">

                            <div class="overlay-content" style="margin-top: 180px;">

                                <button class="close" onclick="closeOverlay()" style="color: #000000;">X</button>

                                <h3 style="margin-top: 10px; margin-left: 200px; font-size: 40px; font-weight: 700;">Détails de la demande</h3>

                                <br>
                                <div id="details-container">
                                    <!-- Contenu dynamique via JS -->
                                </div>

                                <h4>Actions administratives</h4>

                                <!-- Formulaire de validation -->
                                <form id="approve-form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="approve-request-id" name="request_id" value="">
                                    <input type="email" name="email" placeholder="Email" required>
                                    <textarea name="motif" placeholder="Motif d'approbation" required></textarea>
                                    <button type="submit">Valider</button>
                                </form>

                                <!-- Formulaire de rejet -->
                                <form id ="reject-form" method="POST">
                                    @csrf
                                    <input type="hidden" id="reject-request-id" name="request_id" value="">
                                    <input type="email" name="email" placeholder="Email" required>
                                    <textarea name="motif" placeholder="Motif de rejet" required></textarea>
                                    <button type="submit" >Rejeter</button>
                                </form>

                            </div>

                        </div>

                        <script>

                            function showDetails(requestId) {
                                fetch(`/requests/${requestId}`)
                                
                                    .then(response => response.json())
                                    .then(data => {

                                        console.log('Données reçues dans showDetails:', data); // <-- ici


                                        document.getElementById('details-container').innerHTML = `
                                            <p><strong>Nom de l'association :</strong> ${data.user.name}</p>
                                            <p><strong>Destinataire :</strong> ${data.destinataire}</p>
                                            <p><strong>Type de demande :</strong> ${data.type}</p>
                                            <p><strong>Description :</strong> ${data.description}</p>
                                            <p><strong>Date de soumission :</strong> ${new Date(data.created_at).toLocaleDateString()}</p>
                                            <p><strong>Statut :</strong> ${data.statut}
                                            </p><a href="/storage/${data.pdf_path}" target="_blank">Voir la pièce jointe</a><br>

                                        `;

                                        // Mettre à jour l'ID de la demande dans le formulaire
                                        document.getElementById('approve-request-id').value = requestId;
                                        document.getElementById('reject-request-id').value = data.id;

                                        // Ouvrir l'overlay
                                        document.getElementById('details-overlay').classList.remove('hidden');
                                    })
                                    .catch(error => {
                                        console.error('Erreur lors de la récupération des détails :', error);
                                        alert('Impossible de récupérer les détails de la demande.');
                                    });


                            }

                            function closeOverlay() {
                                document.getElementById('details-overlay').classList.add('hidden');
                            }



                            // Fonction pour gérer l'envoi du formulaire d'approbation
                            document.getElementById('approve-form').addEventListener('submit', function(event) {
                                event.preventDefault();

                                const formData = new FormData(this);
                                const requestId = formData.get('request_id');

                                if (!requestId) {
                                    console.error('L\'ID de la demande est manquant');
                                    return;
                                }

                                const url = `/admin/approve/${requestId}`;
                                fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json'
                                    },
                                    body: formData,
                                    redirect: 'manual' // Désactiver les redirections automatiques
                                })
                                .then(response => {
                                    console.log('Réponse reçue :', response);
                                    if (response.ok) {
                                        return response.json();
                                    }
                                    return response.text().then(text => {
                                        throw new Error(`Erreur serveur : ${text}`);
                                    });
                                })
                                .then(data => {
                                    console.log('Succès :', data);
                                    alert('Demande approuvée avec succès !');
                                })
                                .then(data => {
                                    // Mettre à jour le tableau admin-panel en supprimant la ligne de la demande
                                    updateAdminTableAfterStatusChange(requestId, 'approuvé');
                                })
                                .catch(error => {
                                    console.error('Erreur lors de l\'approbation', error);
                                    alert('Une erreur est survenue : ' + error.message);
                                });
                            });

                            // Fonction pour gérer l'envoi du formulaire de rejet
                            document.getElementById('reject-form').addEventListener('submit', function(event) {
                                event.preventDefault();

                                const formData = new FormData(this);
                                const requestId = formData.get('request_id');

                                if (!requestId) return;

                                fetch(`/admin/reject/${requestId}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json'
                                    },
                                    body: formData
                                })
                                .then(response => response.json()) // On sait maintenant que Laravel renvoie du JSON
                                .then(data => {
                                    if (data.success) {
                                        alert(data.message);
                                        updateAdminTableAfterStatusChange(requestId, 'rejeté');
                                    } else {
                                        alert('Erreur : ' + (data.message || 'Une erreur est survenue.'));
                                    }
                                })
                                .catch(error => {
                                    console.error('Erreur AJAX', error);
                                    alert('Une erreur réseau est survenue : ' + error.message);
                                });
                            });



                            // Fonction pour afficher les demandes en attente
                            function updateDashboard() {
                                fetch('/get-pending-requests')  // Assurez-vous d'avoir un point de terminaison pour récupérer les demandes en attente
                                    .then(response => response.json())
                                    .then(data => {
                                        const tableBody = document.querySelector('#dashboard tbody');
                                        tableBody.innerHTML = '';  // Vider le tableau actuel

                                        data.forEach(request => {
                                            if (request.statut === 'En attente') {
                                                const row = `
                                                    <tr>
                                                        <td>${request.user.name}</td>
                                                        <td>${request.type}</td>
                                                        <td>${request.created_at}</td>
                                                        <td>${request.statut}</td>
                                                        <td><button onclick="showDetails(${request.id})">Voir plus</button></td>
                                                    </tr>
                                                `;
                                                tableBody.innerHTML += row;  // Ajouter la nouvelle ligne pour chaque demande en attente
                                            }
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Erreur:', error);
                                    });
                            }

                            // Fonction pour mettre à jour le tableau après une approbation ou un rejet
                            function updateAdminTableAfterStatusChange(requestId, newStatus) {
                                const row = document.getElementById('request-' + requestId);
                                if (row) {
                                    row.querySelector('.statut').innerText = newStatus;
                                    row.querySelector('.statut').classList.add(newStatus);
                                }

                                // Une fois le statut modifié, retirez la demande de la liste des "en attente" dans le tableau Dashboard
                                const pendingRow = document.getElementById('pending-request-' + requestId);
                                if (pendingRow) {
                                    pendingRow.remove();
                                }
                            }

                            // Fonction pour afficher ou masquer le tableau
                            function toggleTableVisibility() {
                                const table = document.getElementById('pendingRequestsTable');
                                const currentDisplay = table.style.display;

                                // Si le tableau est actuellement masqué, on l'affiche, sinon on le cache
                                if (currentDisplay === 'none' || currentDisplay === '') {
                                    table.style.display = 'table';
                                } else {
                                    table.style.display = 'none';
                                }
                            }

                            function handleRequest(requestId, status) {
                                fetch('/admin/update-status', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        request_id: requestId,
                                        status: statut
                                    })
                                })
                                .then(response => {
                                    if (response.ok) {
                                        alert("Statut mis à jour !");
                                        location.reload(); // Rafraîchir la page pour voir le changement
                                    }
                                });
                            }

                        </script>

                    </section>

                    <section id="gestionNotif" class="section-content">

                        <div class="admin-container">

                            <h1>Gérer les notifications</h1>

                            <div class="notif-container">

                                <p>Envoyez des notifications aux associations et ONG à partir d’ici</p>

                                <!-- Formulaire pour envoyer une notification -->
                                <button id="sendNotificationBtn">Envoyer une notification</button>

                            </div>
                            
                            <div style="display: flex; gap: 450px;">
                                <h2>Notifications envoyées</h2>
                                <button id="loadMoreBtn" style="border: 1px solid black; border-radius: 5px; text-align: center; height: 40px; margin-top: 20px;">Afficher plus</button>
                            </div>                          

                            <div id="notificationForm" style="display: none; width: 700px; margin-left:200px">

                                <form action="{{ route('notifications.send') }}" method="POST" style="width: 600px;">
                                    @csrf
                                    <input type="text" name="title" placeholder="Titre" required>
                                    <textarea name="message" placeholder="Message" required></textarea>
                                    <input type="text" name="recipient_name" placeholder="Nom du destinataire" required>
                                    <input type="email" name="recipient_email" placeholder="Email du destinataire" required>
                                    <button type="submit">Envoyer</button>
                                </form>

                            </div>

                            <!-- Liste des notifications -->
                            <div id="notificationsContainer" class="notifications">

                                @foreach ($notifications as $notification)

                                    <div class="notification">

                                        <p>Titre de la notification: <span>{{ $notification->title }}</span></p>
                                        <p>Message: <span>{{ $notification->message }}</span></p>
                                        <p>Nom du destinataire: <span>{{ $notification->recipient_name }}</span></p>
                                        <p>Adresse E-mail: <span>{{ $notification->recipient_email }}</span></p>
                                        <p>Date d'envoi: <span>{{ $notification->created_at->format('d/m/Y H:i') }}</span></p>

                                    </div>

                                @endforeach

                            </div>
                                                       

                            <!-- Section historique complet (cachée au début) -->
                            <div id="moreNotifications" style="display:none;">

                                @foreach ($allNotifications as $notification)

                                    <div class="notification">

                                        <p>Titre de la notification: <span>{{ $notification->title }}</span></p>
                                        <p>Message: <span>{{ $notification->message }}</span></p>
                                        <p>Nom du destinataire: <span>{{ $notification->recipient_name }}</span></p>
                                        <p>Adresse E-mail: <span>{{ $notification->recipient_email }}</span></p>
                                        <p>Date d'envoi: <span>{{ $notification->created_at->format('d/m/Y H:i') }}</span></p>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                        <script>

                            // Afficher le formulaire de notification
                            document.getElementById('sendNotificationBtn').addEventListener('click', function() {
                                document.getElementById('notificationForm').style.display = 'block';
                            });

                            document.getElementById('loadMoreBtn').addEventListener('click', function() {
                                const more = document.getElementById('moreNotifications').innerHTML;
                                const container = document.getElementById('notificationsContainer');

                                // On ajoute les notifications restantes
                                container.insertAdjacentHTML('beforeend', more);

                                // On cache le bouton
                                this.style.display = 'none';
                            });

                        </script>

                    </section>

                    <section id="gestionAct" class="section-content" style="margin-top: 150px;">

                        <div class="row" style="margin-left: 150px; margin-top: 20px; width: 980px;">

                            @if(isset($activityCount))
                                    
                                <div class="col-md-4 d-flex justify-content-center">
                                        
                                    <div class="card shadow p-4" style="width: 300px; height: 110px;">
                                            
                                        <p id="totalActivites" class="display-6 text-warning" style="margin-top: -15px;">{{ $activityCount }}</p>
                                            
                                        <h5 style="display: flex; gap: 5px; font-size: 16px; font-weight: 400; margin-top: -10px; width: 300px">

                                            <img src="{{ asset('/img2/Racine.png') }}" alt="" style="width:20px; height: 20px; border-radius: 50%; object-fit: cover;">
                                            Activités publiées par l'ensemble

                                        </h5>
                                        
                                    </div>
                                    
                                </div>
                                
                            @endif

                            @if(isset($activityseCount))
                                    
                                <div class="col-md-4 d-flex justify-content-center">
                                        
                                    <div class="card shadow p-4" style="width: 300px; height: 110px;">
                                            
                                        <p id="totalActivites" class="display-6 text-warning" style="margin-top: -15px;">{{ $activityseCount }}</p>
                                            
                                        <h5 style="display: flex; gap: 5px; font-size: 16px; font-weight: 400; margin-top: -10px; width: 250px">                                            
                                                
                                            <img src="{{ asset('/img2/tamaee.png') }}" alt="" style="width:20px; height: 20px; border-radius: 50%; object-fit: cover;">
                                            Activités publiées par les associations
                                            
                                        </h5>
                                        
                                    </div>
                                    
                                </div>
                                
                            @endif

                            @if(isset($activitysCount))
                                    
                                <div class="col-md-4 d-flex justify-content-center">
                                        
                                    <div class="card shadow p-4" style="width: 300px; height: 110px;">
                                            
                                        <p id="totalActivites" class="display-6 text-warning" style="margin-top: -15px;">{{ $activitysCount }}</p>
                                            
                                        <h5 style="display: flex; gap: 5px; font-size: 16px; font-weight: 400; margin-top: -10px; width: 300px">
                                                
                                            <img src="{{ asset('/img2/rosée.png') }}" alt="" style="width:20px; height: 20px; border-radius: 50%; object-fit: cover;">
                                                
                                            Activités publiées par les ONG
                                            
                                        </h5>
                                        
                                    </div>
                                    
                                </div>
                                
                            @endif
                                
                        </div>
                        
                        <div class="title">

                            <h2>Les activités publiées</h2>

                            <div class="clique">
                                
                                <a href="{{ route('admin.activities.create') }}" class="btn btn-primary" >
                                    <p>Ajouter une activité</p>
                                </a>

                            </div>
                            
                        </div>
                        
                        <form method="GET" action="{{ route('activities.index') }}" style="margin-bottom: 20px;">
                            <input type="text" name="search" placeholder="Rechercher une association ou ONG" value="{{ request('search') }}" 
                                style="padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 5px; margin-left:180px;">
                            <button type="submit" style="padding: 10px 20px; background-color: transparent; color: black; border: none; border-radius: 5px;">
                                <span class="material-symbols-outlined">search</span>                                       
                            </button>
                        </form>

                        @if(isset($activities) && $activities->count() > 0)

                            <div class="liste-activites">

                                @foreach($activities as $activity) 

                                    @if($activity->is_visible)

                                        <div class="activite-item">

                                            <div class="activites">
                                                <img src="{{ asset('storage/attachments/' . basename($activity->attachment)) }}" alt="{{ $activity->titre }}">
                                            </div>

                                            <div class="activites1">

                                                <div class="activitesA">

                                                    <div class="AD">
                                                        <img src="{{ asset('storage/' . $activity->user->attachment) }}" alt="logo">
                                                    </div>
                                                        
                                                    <div class="AC">

                                                        <h2>{{ $activity->user->name }}</h2>
                                                            
                                                        <p>{{ $activity->user->domaine }}  </p>

                                                    </div>
        
                                                </div>

                                                <div class="heure">

                                                    <div class="tr"></div>

                                                    <p>{{ $activity->created_at->format('d-m-Y H:i') }}</p>

                                                </div>

                                                <h3>{{ $activity->titre }}</h3>

                                                <p>{{ $activity->description }}</p>

                                                <!-- Bouton pour afficher l'overlay -->
                                                <button id="btn1" onclick="showOverlay('{{ $activity->id }}')">Voir détails</button>


                                                <!-- Bouton de validation -->
                                                <form action="{{ route('activites.validate', $activity->id) }}" 
                                                    method="POST" 
                                                    style="display:inline;">

                                                    @csrf

                                                    <button id="btn4" type="submit" style="background-color: green; color:white;">
                                                        Valider
                                                    </button>

                                                </form>
                                                <!-- Bouton pour envoyer un avertissement -->
                                                <form action="{{ route('activites.warn', $activity->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button id="btn2" type="submit">Avertissement</button>
                                                </form>

                                                <!-- Formulaire pour supprimer l'activité -->
                                                <form action="{{ route('activites.destroy', $activity->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="btn3" type="submit">Supprimer</button>
                                                </form>  

                                            </div>

                                            <!-- Overlay pour afficher les détails -->
                                            <div id="overlay{{ $activity->id }}" class="overlay" style="display: none;" >

                                                <div class="overlay-content" style=" margin-top:200px; margin-left:250px;">

                                                    <div class="tit" style="display: flex; align-items:center" >

                                                        <div class="AD" style="margin-left: 100px;">                                                    
                                                            <img src="{{ asset('storage/' . $activity->user->attachment) }}" alt="logo" style=" width: 56.13px;height: 56.13px;border: 1px solid black;border-radius: 50%;margin-left: -50px;">
                                                        </div>

                                                        <div class="AC" style="margin-left: 150px; margin-top:10px;">

                                                            <h2 style="width: 262.87px; height: 28px; margin-top: -0.5px; font-family: var(--section-font); font-size: 18.71px; font-weight: 700; line-height: 27.95px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: #000000; margin-left: -100px;">
                                                                {{ $activity->user->name }}
                                                            </h2>
                                                                    
                                                            <p style="width: 262.87px; height: 26.19px; margin-left: -100px; font-family: var(--section-font); font-size: 16.84px; font-weight: 500; line-height: 27.95px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: #000000;">
                                                                {{ $activity->user->domaine }}
                                                            </p>

                                                        </div>

                                                    </div>

                                                    <span class="close-btn" onclick="hideOverlay('{{ $activity->id }}')">&times;</span>

                                                    <img src="{{ asset('storage/attachments/' . basename($activity->attachment)) }}" alt="{{ $activity->titre }}" class="img-fluid" style="width: 900px; height: 300px; object-fit: cover;">

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

                                                        <div class="da" style="width: 229px; height: 29px; top: 1028px; left: 76px; gap: 0px; opacity: 0px; font-family: Montserrat; font-size: 15px; font-style: italic; font-weight: 500; line-height: 29.88px; letter-spacing: -0.03em; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; color: #000000;">
                                                            <p>Publié le {{ $activity->created_at->format('d-m-Y H:i') }}</p>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        
                                        </div>

                                    @endif

                                @endforeach

                            </div>

                        @else

                            <div style="margin-left: 300px;">
                                <td colspan="3">Aucune association créée par les utilisateurs.</td>
                            </div>

                        @endif  

                    </section>

                    <style>

                        .stat-group {
                            display: none;
                            margin-top: 20px;
                            padding: 10px;
                            border: 1px solid #ccc;
                        }

                        button {
                            border: none;               /* Pas de bordure par défaut */
                            background: none;           /* Transparent */
                            padding: 10px 20px;
                            font-size: 16px;
                            cursor: pointer;
                            outline: none;              /* Supprime le contour bleu au focus */
                            transition: border-bottom 0.3s linear;
                        }

                        button.active {
                            border-bottom: 2px solid #000000;  /* Bordure du bas visible quand actif */
                        }

                    </style>
                    
                    <section id="stat" class="section-content">
    
                        <h2>Vue d'ensemble globale</h2>

                        <div style="margin-left: 500px;">
                            <button data-section="asso-ong" style="font-weight: 700;">Associations & ONG</button>
                            <button data-section="demandes" style="font-weight: 700;">Demandes d'accompagnement</button>
                            <button data-section="activites" style="font-weight: 700;">Activités</button>

                            <button onclick="exportStatsPDF()" class="btn btn-danger" style="color: black;">
                                Exporter les statistiques (PDF avec graphes)
                            </button>

                        </div>
    
                        <div style="border: #d9d9d9 1px solid; width: 980px; margin-left: 500px;"></div>

                        <div class="stat-group asso-ong" style="margin-left: 500px; display: block; width: 980px;">

                            <h3 style="margin-top: 10px; margin-left: 20px;">Vue d'ensemble globale sur les associations et ONG</h3>

                            <div class="row" style="margin-left: -10px; margin-top: 20px; width: 980px;">
                                
                                @if(isset($userCount))
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow p-3" style="width: 300px;">
                                            <p id="totalEntities" class="display-6 text-primary">{{ $userCount }}</p>
                                            
                                            <div style="display: flex; align-items: center; gap: 8px; width: 400px;">
                                                <img src="{{ asset('/img2/solidaire.jpeg') }}" alt="Logo" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                                <h5 style="font-size: 16px; font-weight: 400; width: 400px;">Associations & ONG enregistrées</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($associationCount))
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow p-3" style="width: 300px;">
                                            <p id="totalAssociations" class="display-6 text-success">{{ $associationCount }}</p>
                                                                        
                                            <div style="display: flex; align-items: center; gap: 8px; width: 400px;">
                                                <img src="{{ asset('/img2/asso.jpeg') }}" alt="Logo" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                                <h5 style="font-size: 16px; font-weight: 400; width: 400px;">Associations enregistrées</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($ongCount))
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow p-3" style="width: 300px;">
                                            <p id="totalOng" class="display-6 text-info">{{ $ongCount }}</p>
                                                                        
                                            <div style="display: flex; align-items: center; gap: 8px; width: 400px;">
                                                <img src="{{ asset('/img2/ong.jpeg') }}" alt="Logo" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                                <h5>ONG</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                            </div>

                            <div style="display: flex; align-items: center;  margin-top: 10px;">

                                <div class="lis" style="display: flex; flex: 1;">

                                    <ul style="list-style: none; padding-left: 0; margin: 0; flex: 1;">

                                        @foreach($lastUsers->take(4) as $user)
                                            <li style="display: flex; align-items: center; padding: 5px 0;">
                                                <img src="{{ asset('storage/' . $user->attachment) }}" alt="Logo"
                                                    style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                                                <span style="font-size: 14px; margin-left: 20px;">{{ $user->name }}</span>
                                            </li>
                                        @endforeach

                                    </ul>

                                    <ul style="list-style: none; padding-left: 0; margin-left: -170px; flex: 1;">
                                        @foreach($lastUsers->skip(4) as $user)
                                            <li style="display: flex; align-items: center; padding: 5px 0;">
                                                <img src="{{ asset('storage/' . $user->attachment) }}" alt="Logo" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                                                <span style="font-size: 14px; margin-left: 20px;">{{ $user->name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>

                                <canvas id="donutChart" width="300" height="300" style="width: 300px; height: 300px;"></canvas>

                            </div>

                            <div style="margin-top: 40px; margin-bottom: 10px; margin-left: 600px;">

                                <button onclick="showGraph('lineChart')" class="btn btn-primary" style="background-color: transparent; color:#000000; width:100px; height: 50px;">Tous</button>
                                
                                <button onclick="showGraph('lineChartAssociations')" class="btn btn-success" style="background-color: transparent; color:#000000; width:120px; height: 50px;">Association</button>
                                
                                <button onclick="showGraph('lineChartOng')" class="btn btn-info" style="background-color: transparent; color:#000000; width:100px; height: 50px;">ONG</button>
                            
                            </div>

                            <!-- Graphique Association et ONG -->

                            <div id="graph-lineChart">
                                <canvas id="lineChart" width="400" height="200"></canvas>
                            </div>
                            
                            <!-- Graphique Association -->

                            <div id="graph-lineChartAssociations">
                                <canvas id="lineChartAssociations" width="400" height="200"></canvas>
                            </div>

                            <!-- Graphique ONG -->
                            <div id="graph-lineChartOng">
                                <canvas id="lineChartOng" width="400" height="200"></canvas>
                            </div>

                        </div>

                        <div class="stat-group demandes" style="display: none; margin-left: 500px; width: 980px;">
                
                            <div class="row" style="margin-left: -10px; margin-top: 20px; width: 980px;">
        
                                @if(isset($requestCount))

                                    <div class="col-md-3 mb-3" >
            
                                        <div class="card shadow p-3" style="width: 180px; height: 100px;">
                                            <p id="demandesSoumises" class="display-6 text-secondary" >{{ $requestCount }}</p>
                                            <h5 style="font-size: 16px; font-weight: 400; width: 400px; margin-top: -10px;">Demandes soumises</h5>
                                        </div>

                                    </div>
                                @endif

                                @if(isset($requesttCount))

                                    <div class="col-md-3 mb-3">
            
                                        <div class="card shadow p-3" style="width: 160px; height: 100px; margin-left: -50px;">
                                            <p id="demandesTraitees" class="display-6 text-success">{{ $requesttCount }}</p>
                                            <h5 style="font-size: 16px; font-weight: 400; width: 400px; margin-top: -10px;">Demandes traitées</h5>
                                        </div>
        
                                    </div>
                                @endif

                                @if(isset($requestaCount))

                                    <div class="col-md-3 mb-3">
            
                                        <div class="card shadow p-3" style="width: 190px; height: 100px; margin-left: -120px;">
                                            <p id="demandesApprouvees" class="display-6 text-primary">{{ $requestaCount }} </p>
                                            <h5 style="font-size: 16px; font-weight: 400; width: 400px; margin-top: -10px;">Demandes approuvées</h5>
                                        </div>
            
                                    </div>
                                @endif

                                @if(isset($requestrCount))

                                    <div class="col-md-3 mb-3">
            
                                        <div class="card shadow p-3" style="width: 160px; height: 100px; margin-left: -160px;">
                                            <p id="demandesRejetees" class="display-6 text-danger">{{ $requestrCount }}</p>
                                            <h5 style="font-size: 16px; font-weight: 400; width: 400px; margin-top: -10px;">Demandes rejetées</h5>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($requesteCount))

                                    <div class="col-md-3 mb-3">
            
                                        <div class="card shadow p-3" style="width: 200px; height: 100px; margin-top: -115px; margin-left: 755px;">
                                            <p id="demandesAttente" class="display-6 text-danger">{{ $requesteCount }}</p>
                                            <h5 style="font-size: 16px; font-weight: 400; width: 400px; margin-top: -10px;">Demandes en attente</h5>
                                        </div>
                                    </div>
                                @endif

                            </div> 
                            
                            <div style="margin-top: 40px;">
                                <canvas id="barChartDemandes" width="800" height="300"></canvas>
                            </div>

                            <div style="margin-top: 40px;">
                                <canvas id="donutChartDemandes" style="width: 200px; height: 200px;"></canvas>
                            </div>

                        </div>

                        <div class="stat-group activites" style="display: none; margin-left: 500px; width: 980px;">
                            
                            <div class="row" style="margin-left: -10px; margin-top: 20px; width: 980px;">

                                @if(isset($activityCount))
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <div class="card shadow p-4" style="width: 300px; height: 130px;">
                                            <p id="totalActivites" class="display-6 text-warning">{{ $activityCount }}</p>
                                            <h5 style="font-size: 16px; font-weight: 400;">Activités publiées</h5>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($activityseCount))
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <div class="card shadow p-4" style="width: 300px; height: 130px;">
                                            <p id="totalActivites" class="display-6 text-warning">{{ $activityseCount }}</p>
                                            <h5 style="font-size: 16px; font-weight: 400;">Activités publiées par les associations</h5>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($activitysCount))
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <div class="card shadow p-4" style="width: 300px; height: 130px;">
                                            <p id="totalActivites" class="display-6 text-warning">{{ $activitysCount }}</p>
                                            <h5 style="font-size: 16px; font-weight: 400;">Activités publiées par les ONG</h5>
                                        </div>
                                    </div>
                                @endif
                                
                            </div>

                          <!-- Boutons -->
                            <div style="margin-top: 40px; margin-bottom: 10px; margin-left: 600px;">
                                <button onclick="showGraphe('total')" class="btn btn-primary" style="color: black;">Tous</button>
                                <button onclick="showGraphe('asso')" class="btn btn-success" style="color: black;">Association</button>
                                <button onclick="showGraphe('ong')" class="btn btn-info">ONG</button>
                            </div>

                            <!-- Graphiques -->
                            <div class="graphe-container" data-type="total" style="display: block;">
                                <canvas id="canvas-total"></canvas>
                            </div>
                            <div class="graphe-container" data-type="asso" style="display: none;">
                                <canvas id="canvas-asso"></canvas>
                            </div>
                            <div class="graphe-container" data-type="ong" style="display: none;">
                                <canvas id="canvas-ong"></canvas>
                            </div>

                            <div style="margin-top:40px;">

                                <h4 style="margin-bottom:15px;">Évaluation des performances</h4>

                                <table class="table table-bordered table-striped" style="margin-left: -5px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Association/ONG</th>
                                            <th>Activité</th>
                                            <th>Score</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($activities as $activity)
                                        <tr>
                                            <td>
                                                <div style="display:flex; align-items:center; gap:10px;">

                                                    @if($activity->user->attachment)
                                                        <img src="{{ asset('storage/' . $activity->user->attachment) }}"
                                                            alt="Logo"
                                                            style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                                                    @endif

                                                    <span style="font-weight:500;">
                                                        {{ $activity->user->name }}
                                                    </span>

                                                </div>
                                            </td>

                                            <td>{{ $activity->titre }}</td>

                                            <td>
                                                @if(!is_null($activity->score))
                                                    {{ number_format($activity->score,2) }} %
                                                @else
                                                    Non évalué
                                                @endif
                                            </td>

                                            <td>
                                                @if(!is_null($activity->score))

                                                    @if($activity->score >= 80)
                                                        <span class="badge bg-success">Performant</span>

                                                    @elseif($activity->score >= 50)
                                                        <span class="badge bg-warning text-dark">Moyen</span>

                                                    @else
                                                        <span class="badge bg-danger">Faible</span>

                                                    @endif

                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </section>

                    <!-- Chart.js uniquement une fois -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        // Données pour le graphique en ligne
                        
                        const monthlyData = @json(array_values($countsByMonth));

                        const monthlyAssociations =  {!! json_encode(array_values($countsAssociations  ?? [])) !!};
    
                        const monthlyOng = {!! json_encode(array_values($countsOng ?? [])) !!};
                        
    

                        const ctxLine = document.getElementById('lineChart').getContext('2d');

                        new Chart(ctxLine, {
                            type: 'line',
                            data: {
                                labels: [
                                    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                                ],
                                datasets: [{
                                    label: "Évolution des associations et ONG",
                                    data: monthlyData,
                                    fill: false,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    tension: 0.3,
                                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                    pointRadius: 5
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: Math.max(...monthlyData) + 5
                                    }
                                },
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });

                        // Graphique Associations uniquement
                        const ctxAssoc = document.getElementById('lineChartAssociations').getContext('2d');
                        new Chart(ctxAssoc, {
                            type: 'line',
                            data: {
                                labels: [
                                    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                                ],
                                datasets: [{
                                    label: "Associations enregistrées",
                                    data: monthlyAssociations,
                                    borderColor: 'rgb(108, 179, 90)',
                                    backgroundColor: 'rgba(108, 179, 90, 0.2)',
                                    fill: false,
                                    tension: 0.3,
                                    pointRadius: 4
                                }]
                            },
                        
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: Math.max(...monthlyData) + 5
                                    }
                                },
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }

                        });

                        // Graphique ONG uniquement
                        const ctxOng = document.getElementById('lineChartOng').getContext('2d');
                        new Chart(ctxOng, {
                            type: 'line',
                            data: {
                                labels: [
                                    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                                ],
                                datasets: [{
                                    label: "ONG enregistrées",
                                    data: monthlyOng,
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    fill: false,
                                    tension: 0.3,
                                    pointRadius: 4
                                }]
                            },
                              
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: Math.max(...monthlyData) + 5
                                    }
                                },
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });

                        // Données pour le donut
                        const total = Number('{{ $userCount ?? 0 }}');
                        const max = 200; 

                        const ctxDonut = document.getElementById('donutChart').getContext('2d');

                        new Chart(ctxDonut, {
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    data: [total, max - total],
                                    backgroundColor: ['#4CAF50', '#E0E0E0'],
                                    borderWidth: 0
                                }]
                            },
                            options: {
                                responsive: false,
                                maintainAspectRatio: false,
                                cutout: '60%',
                                plugins: {
                                    tooltip: { enabled: false },
                                    legend: { display: false }
                                }
                            },
                            plugins: [{
                                id: 'textCenter',
                                beforeDraw: function(chart) { 
                                    const width = chart.width,
                                        height = chart.height,
                                        ctx = chart.ctx;
                                    ctx.restore();
                                    const fontSize = Math.min(height / 5, 40);
                                    ctx.font = fontSize + "px Arial";
                                    ctx.textBaseline = "middle";

                                    const text = total.toString(),
                                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                                        textY = height / 2;

                                    ctx.fillText(text, textX, textY);
                                    ctx.save();
                                }
                            }]
                        });


                        function showGraph(graphId) {
                            const graphs = ['lineChart', 'lineChartAssociations', 'lineChartOng'];

                            graphs.forEach(id => {
                                const div = document.getElementById('graph-' + id);
                                if (div) {
                                    div.style.display = (id === graphId) ? 'block' : 'none';
                                }
                            });
                        }

                        // Par défaut, afficher "Tous"
                        document.addEventListener("DOMContentLoaded", function () {
                            showGraph('lineChart');
                        });
                    </script>

                    <script>
                        const demandesParMois = {!! json_encode(array_values($requestCounts ?? [])) !!};

                        const ctxDemandes = document.getElementById('barChartDemandes').getContext('2d');
                        new Chart(ctxDemandes, {
                            type: 'bar',
                            data: {
                                labels: [
                                    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                                ],
                                datasets: [{
                                    label: 'Demandes soumises',
                                    data: demandesParMois,
                                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        stepSize: 1,
                                        ticks: {
                                            callback: function(value) {
                                                return Number.isInteger(value) ? value : null;
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    </script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const typeLabels = {!! json_encode($labels) !!};
                            const typeData = {!! json_encode($data) !!};
                            const ctxDonut = document.getElementById('donutChartDemandes')?.getContext('2d');
                            if (ctxDonut) {
                                new Chart(ctxDonut, {
                                    type: 'doughnut',
                                    data: {
                                        labels: typeLabels,
                                        datasets: [{
                                            data: typeData,
                                            backgroundColor: ['#4CAF50', '#E0E0E0'], // adapte selon tes besoins
                                            borderWidth: 0
                                        }]
                                    },
                                    
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: { position: 'bottom' },
                                            title: {
                                                display: true,
                                                text: 'Répartition des types de demandes (2025)'
                                            }
                                        }
                                    }
                                });
                            } 
                        });
                    </script>

                    <script>
                        function showGraphe(type) {
                            // Récupérer tous les graphes
                            const graphs = document.querySelectorAll('.graphe-container');

                            graphs.forEach(graph => {
                                // Afficher uniquement le graph correspondant au type demandé
                                if (graph.getAttribute('data-type') === type) {
                                    graph.style.display = 'block';
                                } else {
                                    graph.style.display = 'none';
                                }
                            });
                        }

                        const labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'];

                        // Injecter les données PHP dans JavaScript
                        const dataTotal = @json($statsTotal);
                        const dataAsso = @json($statsAsso);
                        const dataONG = @json($statsONG);


                        new Chart(document.getElementById('canvas-total'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Total activités',
                                    data: dataTotal,
                                    borderColor: 'orange',
                                    backgroundColor: 'orange',
                                    fill: false,
                                    tension: 0.3
                                }]
                            }
                        });

                        new Chart(document.getElementById('canvas-asso'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Activités des associations',
                                    data: dataAsso,
                                    borderColor: 'blue',
                                    backgroundColor: 'blue',
                                    fill: false,
                                    tension: 0.3
                                }]
                            }
                        });

                        new Chart(document.getElementById('canvas-ong'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Activités des ONG',
                                    data: dataONG,
                                    borderColor: 'green',
                                    backgroundColor: 'green',
                                    fill: false,
                                    tension: 0.3
                                }]
                            }
                        });

                        // Afficher "total" par défaut au chargement
                        document.addEventListener("DOMContentLoaded", () => {
                            showGraphe('total');
                        });
                    </script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const links = document.querySelectorAll(".nav-links a");
                            const sections = document.querySelectorAll(".section-content");

                            // Fonction pour masquer toutes les sections
                            function hideAllSections() {
                                sections.forEach(section => section.classList.remove("active"));
                            }

                            // Ajouter un écouteur de clic pour chaque lien
                            links.forEach(link => {
                                link.addEventListener("click", function (e) {
                                    e.preventDefault(); // Empêcher le comportement par défaut du lien
                                                
                                    // Masquer toutes les sections
                                    hideAllSections();

                                    // Récupérer l'ID de la section cible à partir de l'attribut href du lien
                                    const targetSectionId = this.getAttribute("href").substring(1);
                                    const targetSection = document.getElementById(targetSectionId);

                                    // Afficher la section cible
                                    if (targetSection) {
                                        targetSection.classList.add("active");
                                    }
                                });
                            });

                            // Afficher la première section par défaut
                            if (sections.length > 0) {
                                sections[0].classList.add("active");
                            }
                        });

                        // Fonction pour afficher l'overlay
                        function showOverlay(activityId) {
                            var overlay = document.getElementById('overlay' + activityId);
                            overlay.style.display = 'block'; // Afficher l'overlay
                        }

                        // Fonction pour masquer l'overlay
                        function hideOverlay(activityId) {
                            var overlay = document.getElementById('overlay' + activityId);
                            overlay.style.display = 'none'; // Masquer l'overlay
                        }         
      
  
                    </script>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            document.querySelectorAll('button[data-section]').forEach(button => {
                                button.addEventListener('click', () => {
                                    // Retirer la classe active de tous les boutons
                                    document.querySelectorAll('button[data-section]').forEach(btn => btn.classList.remove('active'));

                                    // Ajouter la classe active au bouton cliqué
                                    button.classList.add('active');

                                    // Afficher la section correspondante
                                    const section = button.dataset.section;
                                    showStats(section);
                                });
                            });

                            function showStats(section) {
                                document.querySelectorAll('.stat-group').forEach(s => s.style.display = 'none');
                                const target = document.querySelector('.stat-group.' + section);
                                if (target) {
                                    target.style.display = 'block';
                                }
                            }
                        });

                        window.addEventListener('DOMContentLoaded', () => {
                            showStats('asso-ong'); // Affiche cette section dès le chargement
                            document.querySelector('button[data-section="asso-ong"]').classList.add('active'); // Active aussi le bouton
                        });

                    </script>

                    <script>
                    function exportStatsPDF() {
                        const charts = [
                            'lineChart', 'lineChartAssociations', 'lineChartOng',
                            'donutChart', 'barChartDemandes', 'donutChartDemandes',
                            'canvas-total', 'canvas-asso', 'canvas-ong'
                        ];

                        // Affiche temporairement toutes les sections masquées
                        const hiddenSections = [];
                        document.querySelectorAll('.stat-group').forEach(section => {
                            if (section.style.display === 'none') {
                                hiddenSections.push(section);
                                section.style.display = 'block';
                            }
                        });

                        let images = {};
                        charts.forEach(id => {
                            const canvas = document.getElementById(id);
                            if (canvas) {
                                try {
                                    images[id] = canvas.toDataURL("image/png");
                                } catch(e) {
                                    console.error("Erreur canvas "+id, e);
                                }
                            }
                        });

                        // Rétablir les sections masquées
                        hiddenSections.forEach(section => section.style.display = 'none');

                        fetch("{{ route('admin.stats.pdf') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ images })
                        })
                        .then(res => res.blob())
                        .then(blob => {
                            const url = window.URL.createObjectURL(blob);
                            window.open(url);
                        });
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Main JS File -->
        <script src="{{ asset('/js/admin.js') }}"></script>

    </body>

</html>
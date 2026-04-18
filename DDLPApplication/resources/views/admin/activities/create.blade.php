<!DOCTYPE html>
<html lang="en">
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

    <title>Publié une activité</title>

</head>

<body>
    <div style="width: 700px; margin: auto; margin-top:150px;">

    <div id="form-activite" style="margin-left: -150px;">

        <form method="POST" action="{{ route('admin.activities.store') }}" enctype="multipart/form-data">
                                
            <div class="titre">

                <div class="trait" style="margin-left: 80px"></div>
                <h1 style="color: black; margin-left: 10px;">Publié une activité...</h1>

            </div>

            @csrf

            <label style="width: 300px;">Choisir l’association ou ONG</label>
            <select name="user_id" required class="form-control"  style="width:700px; margin-left:114px !important;">
                <option value="">Choisissez une association ou ONG</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->groupe }})</option>
                @endforeach
            </select>
            <br><br>
                        
            <div>
                <label for="titre">Titre</label>
                <br>
                <input type="text" id="titre" name="titre" class="form-control" style="width:700px;" placeholder="Veuillez mettre le titre de l'activité ici" required>
            </div>

            <div>
                <label for="description">Description</label> <br>
                <textarea id="description" name="description" class="form-control" style="width:700px;" placeholder="Veuillez mettre une description de l'activité ici" required></textarea>
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

    
</div>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/requests.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

    <title>Statut de la demande</title>
</head>

<body>

    <style>
        .title{
            margin-top: 50px; 
            margin-left: 370px; 
            margin-right: 200px;
        }

        .title h1{
            font-weight: 1000; 
            font-size: 50px; 
            text-shadow: 2px 2px 5px black;
        }

        @media(max-width: 768px){
            .title{
                margin-left: 50px;
            }

            .title h1{
                font-weight: 1000; 
                font-size: 30px; 
                text-shadow: 2px 2px 5px black;
            }
        }
    </style>

    <div class="title">
    
        <h1>STATUT DE LA DEMANDE</h1>

    </div>

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @else

    <style>

        table.separation-colonnes {
            border-collapse: collapse; /* supprime les espaces entre cellules */
            margin-top: 50px; 
            border: 2px solid black; 
            margin-left: 150px;
        }

        table.separation-colonnes th,
        table.separation-colonnes td {
            border-left: 1px solid black; /* ligne verticale à gauche de chaque cellule */
            padding: 10px;
            font-size: 18px;
        }

        /* Supprimer la bordure gauche de la première cellule */
        table.separation-colonnes th:first-child,
        table.separation-colonnes td:first-child {
            border-left: none;
        }

        @media(max-width: 768px){
             table.separation-colonnes {
            border-collapse: collapse; /* supprime les espaces entre cellules */
            margin-top: 50px; 
            border: 2px solid black; 
            margin-left: 5px;
        }
        }

    </style>

    <table class="separation-colonnes">
        <thead>
            <tr style="font-size: 25px;">
                <th>Nom de la demande</th>
                <th style="padding-left: 60px;">Type de la demande</th>
                <th>Date de soumission</th>
                <th>Statut de la demande</th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>{{ $request->title }}</td>
                <td>{{ $request->type }}</td>
                <td>{{ $request->created_at->format('d/m/Y') }}</td>
                <td>
                    <span class="status {{ $request->statut }}">
                        {{ ucfirst($request->statut) }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
@endif
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courrier généré</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #e9f2ff, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }

        .card-custom {
            max-width: 650px;
            margin: 80px auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .title-success {
            color: #1e3a8a;
            font-weight: bold;
        }

        .info-label {
            font-weight: 600;
            color: #444;
        }

        .btn-download {
            background-color: #0d6efd;
            color: white;
        }

        .btn-download:hover {
            background-color: #084298;
        }

        .btn-gec {
            background-color: #198754;
            color: white;
        }

        .btn-gec:hover {
            background-color: #146c43;
        }

        .icon-success {
            color: #198754;
            font-size: 40px;
        }
    </style>
</head>

<body>

<div class="card card-custom p-4">

    <div class="text-center mb-4">
        <i class="fa-solid fa-circle-check icon-success"></i>
        <h2 class="title-success mt-2">Votre courrier a été généré avec succès</h2>
    </div>

    <div class="mb-3">
        <p><span class="info-label"><i class="fa-solid fa-pen"></i> Titre :</span> {{ $soumission->title }}</p>
        <p><span class="info-label"><i class="fa-solid fa-layer-group"></i> Type :</span> {{ $soumission->type }}</p>
        <p><span class="info-label"><i class="fa-solid fa-location-dot"></i> Lieu :</span> {{ $soumission->location }}</p>
    </div>

    <div class="d-grid gap-3 mt-4">

        <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-download btn-lg">
            <i class="fa-solid fa-file-pdf"></i> Télécharger le PDF
        </a>

        <a href="https://bjidoc.gouv.bj/gec-mcot/dist/#/login"
           target="_blank"
           class="btn btn-gec btn-lg">
            <i class="fa-solid fa-paper-plane"></i> Soumettre sur le portail GEC
        </a>

    </div>

    <div class="alert alert-info mt-4">
        <i class="fa-solid fa-circle-info"></i>
        Le statut de votre demande sera mis à jour sur cette plateforme
        après traitement officiel par la mairie.
    </div>

</div>

</body>
</html>
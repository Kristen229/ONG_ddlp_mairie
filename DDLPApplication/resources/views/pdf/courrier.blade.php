<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    /* ==== Styles globaux ==== */
    body {
        font-family: "Times New Roman", serif;
        font-size: 13px;
        line-height: 1.6;
        margin: 30px;
    }

    /* ==== En-tête ==== */
    .header {
        width: 100%;
        margin-bottom: 20px;
    }

    .left, .right {
        width: 48%;
        display: inline-block;
        vertical-align: top;
    }

    .right {
        text-align: right;
    }

    .logo, .attachment5 {
        display: block;
    }

    .title {
        font-weight: bold;
        text-transform: uppercase;
        font-size: 16px;
        margin-top: 10px;
    }

    /* ==== Date et destinataire ==== */
    .date {
        text-align: right;
        margin-top: 20px;
        page-break-after: avoid;
    }

    .reference {
        margin-top: 20px;
        page-break-after: avoid;
    }

    .objet {
        margin-top: 20px;
        page-break-after: avoid;
    }

    /* ==== Contenu ==== */
    .content {
        text-align: justify;
        margin-top: 15px;
        page-break-inside: auto; /* autorise la rupture sur plusieurs pages */
    }

    .content p {
        page-break-inside: avoid; /* empêche de couper un paragraphe */
        margin-bottom: 12px;
    }

    /* ==== Signature ==== */
    .signature {
        margin-top: 40px;
        text-align: right;
        page-break-inside: avoid;
    }

    .signature img {
        width: 120px;
        height: auto;
        margin-left: 10px;
    }

    .signature div {
        display: flex;
        justify-content: flex-end;
        gap: 20px;
    }

    /* ==== Images ==== */
    .header img {
        max-width: 100%;
        height: auto;
        border-radius: 20px;
    }

    /* ==== Page-break général ==== */
    @page {
        margin: 30px;
    }
</style>
</head>

<body>

<!-- EN-TÊTE -->
<div class="header">
    <div class="left">
        <img src="{{ public_path('storage/attachments/' . basename($user->attachment)) }}" alt="Logo" style="width: 150px; height: 100px;">
        <strong>{{ $user->namePresident }} {{ $user->lastNamePresident }}</strong><br>
        Adresse : {{ $user->siege ?? '' }}<br>
        Tél : {{ $user->number1 ?? '' }}/{{ $user->number2 ?? '' }}<br>
        Email : {{ $user->email ?? '' }}
    </div>

    <div class="right">
        <img src="{{ public_path('storage/attachments/' . basename($user->attachment5)) }}" alt="Logo" style="width: 250px; height: 100px;">
        <div class="title">{{ strtoupper($user->denomination ?? '') }}</div>
    </div>
</div>

<!-- DATE -->
<div class="date">
    Cotonou, le {{ $date }}<br><br>
    À<br>
    Monsieur le {{ $data['destinataire'] }}
</div>

<!-- REFERENCE -->
<div class="reference">
    <p><strong>N/Réf :</strong> {{ $data['reference'] }}</p>
</div>

<!-- OBJET -->
<div class="objet">
    <span>Objet :</span> {{ $data['type'] }}
</div>

<!-- CONTENU -->
<div class="content">
    <p>{!! nl2br(e($data['description'])) !!}</p>
</div>

<!-- SIGNATURE -->
<div class="signature">
    <div>
        <img src="{{ public_path('storage/attachments/' . basename($user->signature_data)) }}" alt="Signature">
        <img src="{{ public_path('storage/attachments/' . basename($user->cachet)) }}" alt="Cachet">
    </div>
    <strong>{{ $user->name ?? '' }}</strong>
</div>

</body>
</html>

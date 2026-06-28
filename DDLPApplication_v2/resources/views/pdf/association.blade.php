<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 25px 25px 50px 25px; } /* top, right, bottom, left */
        body { font-family: DejaVu Sans, sans-serif; color: #000000; font-size: 11px; margin-bottom: 20px; }
        h1 { color: #000000; font-size: 18px; margin-bottom: 4px; text-align: center; text-transform: uppercase; text-decoration: underline; }
        .subtitle { text-align: center; font-size: 11px; margin-bottom: 25px; font-weight: bold; }
        h2 { color: #000000; font-size: 13px; margin-top: 20px; border-bottom: 1px solid #000000; padding-bottom: 4px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; }
        th, td { border: 1px solid #000000; padding: 10px; text-align: left; vertical-align: top; }
        th { background: #e5e7eb; color: #000000; width: 30%; font-weight: bold; }
        .muted { color: #374151; font-style: italic; }
    </style>
</head>
<body>
    @include('pdf.header')
    
    <h1>Fiche Signalétique - {{ $user->name }}</h1>
    <div class="subtitle">
        Extrait du registre des associations et ONG (Généré le {{ now()->format('d/m/Y à H:i') }})
    </div>

    <h2>Informations générales</h2>
    <table>
        <tr><th>Sigle / Dénomination</th><td>{{ $user->denomination ?: 'Non renseigné' }}</td></tr>
        <tr><th>Type de structure</th><td>{{ $user->groupe?->value ?: 'Non renseigné' }}</td></tr>
        <tr><th>Domaine(s) d'intervention</th><td>{{ $user->domaine ?: 'Non renseigné' }}</td></tr>
        <tr><th>Date de création officielle</th><td>{{ $user->date ? $user->date->format('d/m/Y') : 'Non renseignée' }}</td></tr>
        <tr><th>Identifiant unique</th><td>{{ $user->identifiant ?: 'Non renseigné' }}</td></tr>
    </table>

    <h2>Coordonnées & Contact</h2>
    <table>
        <tr><th>Email principal</th><td>{{ $user->email }}</td></tr>
        <tr><th>Téléphones</th><td>{{ $user->number1 }}{{ $user->number2 ? ' / ' . $user->number2 : '' }}</td></tr>
        <tr><th>Adresse physique</th><td>{{ $user->maison }}, {{ $user->quartier }}, {{ $user->arrondissement }}, {{ $user->commune }}</td></tr>
        <tr><th>Site web ou Lien</th><td>{{ $user->lien ?: 'Non renseigné' }}</td></tr>
    </table>

    <h2>Objectifs principaux</h2>
    @php $objectifs = is_array($user->objectifs) ? $user->objectifs : []; @endphp
    @if(count($objectifs))
        <ol style="margin-top: 10px; padding-left: 20px; line-height: 1.5;">
            @foreach($objectifs as $objectif)
                <li>{{ $objectif }}</li>
            @endforeach
        </ol>
    @else
        <p class="muted">Aucun objectif renseigné dans le système.</p>
    @endif

    @include('pdf.footer')
</body>
</html>

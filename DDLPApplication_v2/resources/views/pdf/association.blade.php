<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 12px; }
        h1 { color: #0f766e; font-size: 22px; margin-bottom: 4px; }
        h2 { color: #334155; font-size: 14px; margin-top: 22px; border-bottom: 1px solid #e5e7eb; padding-bottom: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #f8fafc; color: #475569; width: 32%; }
        .muted { color: #64748b; }
    </style>
</head>
<body>
    <h1>{{ $user->name }}</h1>
    <p class="muted">Fiche d'association/ONG exportée le {{ now()->format('d/m/Y à H:i') }}</p>

    <h2>Informations générales</h2>
    <table>
        <tr><th>Sigle</th><td>{{ $user->denomination ?: 'Non renseigné' }}</td></tr>
        <tr><th>Type</th><td>{{ $user->groupe?->value ?: 'Non renseigné' }}</td></tr>
        <tr><th>Domaine(s)</th><td>{{ $user->domaine ?: 'Non renseigné' }}</td></tr>
        <tr><th>Date de création</th><td>{{ $user->date ? $user->date->format('d/m/Y') : 'Non renseignée' }}</td></tr>
        <tr><th>Identifiant</th><td>{{ $user->identifiant ?: 'Non renseigné' }}</td></tr>
    </table>

    <h2>Contact</h2>
    <table>
        <tr><th>Email</th><td>{{ $user->email }}</td></tr>
        <tr><th>Téléphones</th><td>{{ $user->number1 }}{{ $user->number2 ? ' / ' . $user->number2 : '' }}</td></tr>
        <tr><th>Adresse</th><td>{{ $user->maison }}, {{ $user->quartier }}, {{ $user->arrondissement }}, {{ $user->commune }}</td></tr>
        <tr><th>Lien</th><td>{{ $user->lien ?: 'Non renseigné' }}</td></tr>
    </table>

    <h2>Objectifs</h2>
    @php $objectifs = is_array($user->objectifs) ? $user->objectifs : []; @endphp
    @if(count($objectifs))
        <ol>
            @foreach($objectifs as $objectif)
                <li>{{ $objectif }}</li>
            @endforeach
        </ol>
    @else
        <p class="muted">Aucun objectif renseigné.</p>
    @endif
</body>
</html>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 11px; }
        h1 { color: #0f766e; font-size: 20px; margin-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #e5e7eb; padding: 7px; text-align: left; vertical-align: top; }
        th { background: #f1f5f9; color: #334155; }
        .muted { color: #64748b; }
    </style>
</head>
<body>
    <h1>Export des associations et ONG</h1>
    <p class="muted">Domaine: {{ $domaine === 'all' ? 'Tous les domaines' : $domaine }} - {{ $users->count() }} structure(s) - {{ now()->format('d/m/Y à H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Structure</th>
                <th>Type</th>
                <th>Domaine(s)</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td><strong>{{ $user->name }}</strong><br>{{ $user->denomination }}</td>
                    <td>{{ $user->groupe?->value }}</td>
                    <td>{{ $user->domaine ?: 'Non renseigné' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->number1 }}</td>
                    <td>{{ $user->quartier }}, {{ $user->arrondissement }}</td>
                </tr>
            @empty
                <tr><td colspan="6">Aucune structure trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

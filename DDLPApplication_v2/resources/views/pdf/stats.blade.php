<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 12px; }
        h1 { color: #0f766e; font-size: 22px; margin-bottom: 4px; }
        h2 { color: #334155; font-size: 14px; margin-top: 20px; border-bottom: 1px solid #e5e7eb; padding-bottom: 6px; }
        .grid { width: 100%; border-collapse: collapse; margin-top: 12px; }
        .grid td { width: 25%; border: 1px solid #e5e7eb; padding: 10px; }
        .label { color: #64748b; font-size: 10px; text-transform: uppercase; font-weight: bold; }
        .value { font-size: 20px; font-weight: bold; color: #0f172a; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #e5e7eb; padding: 7px; text-align: left; }
        th { background: #f8fafc; }
    </style>
</head>
<body>
    <h1>Tableau de bord DDLP</h1>
    <p>Export généré le {{ now()->format('d/m/Y à H:i') }}</p>

    <table class="grid">
        <tr>
            <td><div class="label">Structures</div><div class="value">{{ $userCount ?? 0 }}</div></td>
            <td><div class="label">ONG</div><div class="value">{{ $ongCount ?? 0 }}</div></td>
            <td><div class="label">Associations</div><div class="value">{{ $associationCount ?? 0 }}</div></td>
            <td><div class="label">Activités</div><div class="value">{{ $activityCount ?? 0 }}</div></td>
        </tr>
        <tr>
            <td><div class="label">Avis</div><div class="value">{{ $reviewCount ?? 0 }}</div></td>
            <td><div class="label">Courriers reçus</div><div class="value">{{ $totalRequests ?? 0 }}</div></td>
            <td><div class="label">Courriers traités</div><div class="value">{{ $resolvedRequests ?? 0 }}</div></td>
            <td><div class="label">Candidatures</div><div class="value">{{ $pendingCandidatesCount ?? 0 }}</div></td>
        </tr>
    </table>

    <h2>Domaines les plus représentés</h2>
    <table>
        <thead><tr><th>Domaine</th><th>Total</th></tr></thead>
        <tbody>
            @forelse(($topDomaines ?? collect()) as $domaine)
                <tr><td>{{ $domaine->nom }}</td><td>{{ $domaine->total }}</td></tr>
            @empty
                <tr><td colspan="2">Aucune donnée.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 25px 25px 50px 25px; } /* top, right, bottom, left */
        body { font-family: DejaVu Sans, sans-serif; color: #000000; font-size: 11px; margin-bottom: 20px; }
        h1 { color: #000000; font-size: 16px; margin-bottom: 8px; text-align: center; text-transform: uppercase; text-decoration: underline; }
        .subtitle { text-align: center; font-size: 11px; margin-bottom: 25px; font-weight: bold; }
        h2 { color: #000000; font-size: 13px; margin-top: 20px; border-bottom: 1px solid #000000; padding-bottom: 4px; text-transform: uppercase; }
        .grid { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; }
        .grid td { width: 25%; border: 1px solid #000000; padding: 12px; text-align: center; }
        .label { color: #374151; font-size: 10px; text-transform: uppercase; font-weight: bold; }
        .value { font-size: 22px; font-weight: bold; color: #000000; margin-top: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; }
        th, td { border: 1px solid #000000; padding: 8px; text-align: left; }
        th { background: #e5e7eb; color: #000000; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .chart-container { text-align: center; margin-top: 20px; }
        .chart-container img { max-width: 100%; height: auto; border: 1px solid #e5e7eb; padding: 10px; background: #fff; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    @include('pdf.header')
    
    <h1>STATISTIQUES DE GESTION DES ONG ET ASSOCIATIONS DE LA VILLE DE COTONOU</h1>
    <div class="subtitle">
        Arrêté à la date du : {{ now()->format('d/m/Y à H:i') }}
    </div>

    <h2>Synthèse Globale</h2>
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

    <h2>Domaines d'intervention les plus représentés</h2>
    <table>
        <thead><tr><th>Domaine</th><th style="width: 20%; text-align: center;">Nombre de structures</th></tr></thead>
        <tbody>
            @forelse(($topDomaines ?? collect()) as $domaine)
                <tr><td>{{ $domaine->nom }}</td><td style="text-align: center; font-weight: bold;">{{ $domaine->total }}</td></tr>
            @empty
                <tr><td colspan="2" style="text-align: center;">Aucune donnée.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if(!empty($chartRep) || !empty($chartIns))
        <div class="page-break"></div>
        @include('pdf.header')
        
        <h2>Indicateurs Visuels (KPIs)</h2>
        
        <table style="border: none; width: 100%; margin-top: 20px;">
            <tr>
                @if(!empty($chartRep))
                    <td style="border: none; width: 50%; vertical-align: top; text-align: center;">
                        <h3 style="font-size: 12px;">Répartition des Structures</h3>
                        <div class="chart-container">
                            <img src="{{ $chartRep }}" style="max-height: 250px;">
                        </div>
                    </td>
                @endif
                
                @if(!empty($chartIns))
                    <td style="border: none; width: 50%; vertical-align: top; text-align: center;">
                        <h3 style="font-size: 12px;">Inscriptions Mensuelles</h3>
                        <div class="chart-container">
                            <img src="{{ $chartIns }}" style="max-height: 250px;">
                        </div>
                    </td>
                @endif
            </tr>
        </table>
    @endif

    @include('pdf.footer')
</body>
</html>

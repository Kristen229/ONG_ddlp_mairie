<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Statistique - Associations & ONG</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #000; }
        h1, h2, h3, h4 { margin-bottom: 5px; }
        h1 { text-align: center; font-size: 20px; }
        .section { margin-top: 25px; page-break-inside: avoid; }
        .stat-grid { display: table; width: 100%; margin-bottom: 15px; }
        .stat-box { display: table-cell; padding: 8px; text-align: center; border: 1px solid #ddd; }
        .stat-value { font-size: 22px; font-weight: bold; }
        .graph { text-align: center; margin-top: 15px; }
        .graph img { width: 90%; margin-bottom: 15px; }
        .page-break { page-break-after: always; }
        footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>

<body>

<h1>Rapport Statistique Global</h1>
<p style="text-align:center;">Associations, ONG, Demandes et Activités</p>

<!-- ================= ASSOCIATIONS & ONG ================= -->
<div class="section">
    <h2>1. Associations & ONG</h2>

    <div class="stat-grid">
        <div class="stat-box"><div class="stat-value">{{ $userCount ?? 0 }}</div>Total</div>
        <div class="stat-box"><div class="stat-value">{{ $associationCount ?? 0 }}</div>Associations</div>
        <div class="stat-box"><div class="stat-value">{{ $ongCount ?? 0 }}</div>ONG</div>
    </div>

    @foreach([
        'donutChart' => 'Répartition Associations / ONG',
        'lineChart' => 'Évolution générale',
        'lineChartAssociations' => 'Évolution Associations',
        'lineChartOng' => 'Évolution ONG'
    ] as $key => $title)
        @if(!empty($images[$key]))
            <div class="graph">
                <h4>{{ $title }}</h4>
                <img src="{{ $images[$key] }}">
            </div>
        @endif
    @endforeach
</div>

<div class="page-break"></div>

<!-- ================= DEMANDES ================= -->
<div class="section">
    <h2>2. Demandes d’accompagnement</h2>

    <div class="stat-grid">
        <div class="stat-box"><div class="stat-value">{{ $requestCount ?? 0 }}</div>Soumises</div>
        <div class="stat-box"><div class="stat-value">{{ $requestaCount ?? 0 }}</div>Approuvées</div>
        <div class="stat-box"><div class="stat-value">{{ $requestrCount ?? 0 }}</div>Rejetées</div>
        <div class="stat-box"><div class="stat-value">{{ $requesteCount ?? 0 }}</div>En attente</div>
    </div>

    @foreach([
        'barChartDemandes' => 'Répartition des demandes',
        'donutChartDemandes' => 'Évolution des demandes'
    ] as $key => $title)
        @if(!empty($images[$key]))
            <div class="graph">
                <h4>{{ $title }}</h4>
                <img src="{{ $images[$key] }}">
            </div>
        @endif
    @endforeach
</div>

<div class="page-break"></div>

<!-- ================= ACTIVITÉS ================= -->
<div class="section">
    <h2>3. Activités</h2>

    <div class="stat-grid">
        <div class="stat-box"><div class="stat-value">{{ $activityCount ?? 0 }}</div>Total</div>
        <div class="stat-box"><div class="stat-value">{{ $activityseCount ?? 0 }}</div>Associations</div>
        <div class="stat-box"><div class="stat-value">{{ $activitysCount ?? 0 }}</div>ONG</div>
    </div>

    @foreach([
        'canvas-total' => 'Évolution totale activités',
        'canvas-asso' => 'Évolution activités Associations',
        'canvas-ong' => 'Évolution activités ONG'
    ] as $key => $title)
        @if(!empty($images[$key]))
            <div class="graph">
                <h4>{{ $title }}</h4>
                <img src="{{ $images[$key] }}">
            </div>
        @endif
    @endforeach
</div>

<footer>
    Rapport généré le {{ now()->format('d/m/Y H:i') }}
</footer>

</body>
</html>

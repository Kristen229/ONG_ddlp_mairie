<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 25px 25px 50px 25px; } /* top, right, bottom, left */
        body { font-family: DejaVu Sans, sans-serif; color: #000000; font-size: 10px; margin-bottom: 20px; }
        h1 { color: #000000; font-size: 16px; margin-bottom: 8px; text-align: center; text-transform: uppercase; text-decoration: underline; }
        .subtitle { text-align: center; font-size: 11px; margin-bottom: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000000; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #e5e7eb; color: #000000; font-weight: bold; text-transform: uppercase; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9fafb; }
    </style>
</head>
<body>
    @include('pdf.header')
    
    <h1>LISTE DES ONG ET ASSOCIATIONS DE LA VILLE DE COTONOU</h1>
    <div class="subtitle">
        Domaine: {{ $domaine === 'all' ? 'Tous les domaines' : $domaine }} | {{ $users->count() }} structure(s)
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 25%">Structure</th>
                <th style="width: 10%">Type</th>
                <th style="width: 20%">Domaine(s)</th>
                <th style="width: 15%">Email</th>
                <th style="width: 12%">Téléphone</th>
                <th style="width: 18%">Adresse</th>
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
                <tr><td colspan="6" style="text-align: center; padding: 20px;">Aucune structure trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>

    @include('pdf.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>

<h2>Liste des associations / ONG<br>Domaine : {{ $domaine }}</h2>

<table>
    <thead>
        <tr>
            <th>Logo</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Domaine</th>
            <th>Date d'enregistrement</th>
        </tr>
    </thead>

    <tbody>
        @foreach($associations as $asso)
            <tr>
                <td style="text-align: center;">
                    @if($asso->attachment)
                        <img 
                            src="{{ public_path('storage/attachments/' . basename($asso->attachment)) }}" 
                            width="50" 
                            height="50"
                        >
                    @else
                        —
                    @endif
                </td>

                <td>{{ $asso->name }}-{{ $asso->denomination }}</td>
                <td>{{ $asso->groupe }}</td>
                <td>{{ $asso->domaine }}</td>
                <td>{{ $asso->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

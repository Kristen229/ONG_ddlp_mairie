<!DOCTYPE html>
<html>
<head>
    <title>Demande approuvée</title>
</head>
<body>
    @isset($motif)
        <p>{{ $motif }}</p>
    @else
        <p>Le motif n'est pas défini.</p>
    @endisset


    <h1>Demande approuvée</h1>
    <p>Bonjour,</p>
    <p>Votre demande a été approuvée avec succès.</p>
    <p>Nom de l'association : {{ $associationName }}</p>
    <p>Motif : {{ $motif }}</p>


</body>
</html>



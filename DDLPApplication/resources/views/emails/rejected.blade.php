<!DOCTYPE html>
<html>
<head>
    <title>Demande refusée</title>
</head>
<body>
   

    @isset($motif)
        <p>{{ $motif }}</p>
    @else
        <p>Le motif n'est pas défini.</p>
    @endisset


    <h1>Demande rejetée</h1>
    <p>Bonjour,</p>
    <p>Votre demande a été refusée.</p>
    <p>Motif : {{ $motif }}</p>
    <p>Merci de votre confiance.</p>
</body>
</html>

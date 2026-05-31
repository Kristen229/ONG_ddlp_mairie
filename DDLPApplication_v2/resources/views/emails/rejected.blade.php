<!DOCTYPE html>
<html lang="fr">
<body style="font-family: Arial, sans-serif; color: #0f172a; line-height: 1.6;">
    <h1 style="color: #be123c;">Votre courrier a été refusé</h1>

    <p>Bonjour {{ $assocRequest->user?->name ?? 'Madame, Monsieur' }},</p>

    <p>
        Votre courrier
        <strong>{{ $assocRequest->objet ?? $assocRequest->title }}</strong>
        n'a pas été approuvé.
    </p>

    <p><strong>Motif / réponse de l'administration :</strong></p>
    <p>{{ $motif }}</p>

    <p>Cordialement,<br>La Mairie de Cotonou</p>
</body>
</html>

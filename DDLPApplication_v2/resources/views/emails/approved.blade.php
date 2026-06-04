<!DOCTYPE html>
<html lang="fr">
<body style="font-family: Arial, sans-serif; color: #0f172a; line-height: 1.6;">
    <h1 style="color: #1d4ed8;">Votre courrier a été approuvé</h1>

    <p>Bonjour {{ $assocRequest->user?->name ?? 'Madame, Monsieur' }},</p>

    <p>
        Votre courrier
        <strong>{{ $assocRequest->objet ?? $assocRequest->title }}</strong>
        a été approuvé par la Mairie.
    </p>

    <p><strong>Réponse de l'administration :</strong></p>
    <p>{{ $motif }}</p>

    <p>Cordialement,<br>La Mairie de Cotonou</p>
</body>
</html>

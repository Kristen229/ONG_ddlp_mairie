<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
    
        <div class="titre">

            <div style="display: inline-block; vertical-align: middle;">
                
                <img src="{{ public_path('storage/attachments/' . basename($user->attachment)) }}" alt="Logo" style="border-radius: 50%; width: 200px; height: 150px; ">

            </div>

            <div style="display: inline-block; vertical-align: middle;">
        
                <h1 style="font-weight: 700;">{{ $user->name }}_{{ $user ->denomination }}</h1> <p>( {{ $user ->groupe }})</p>

            </div>

        </div>

        <div>
            <h2>
                <strong style="text-decoration: underline;">Domaine: </strong> {{ $user ->domaine }}
            </h2>
        </div>

        <div>

            <h2>
                <strong style="text-decoration: underline;">Date de création: </strong> {{ $user ->date }}
            </h2>       

        </div>

        <br>
                      
        <img src="{{ public_path('storage/attachments/' . basename($user->attachment5)) }}" alt="Logo" style="border-radius: 20px; width: 450px; height: 300px; margin-left: 100px;">

        <div>
            <h2>Objectifs: </h2>

            <ul>
                <li>{{ $user ->objectif1 }}</li>
                <li>{{ $user ->objectif2 }}</li>
                <li>{{ $user ->objectif3 }}</li>

            </ul>
        </div>

        <div>
            <h2>Membres du Bureau</h2>

            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <!-- Président -->
                <div style="flex: 0 0 50%; text-align: center;">
                    <img src="{{ public_path('storage/attachments/' . basename($user->attachment1)) }}" 
                        alt="Logo" style="border-radius: 20px; width: 150px; height: 100px;">
                    <p>{{ $user->namePresident }} {{ $user->lastNamePresident }}</p>
                    <p><strong>Président</strong></p>
                </div>

                <!-- Vice-Président -->
                <div style="flex: 0 0 50%; text-align: center;">
                    <img src="{{ public_path('storage/attachments/' . basename($user->attachment2)) }}" 
                        alt="Logo" style="border-radius: 20px; width: 150px; height: 100px;">
                    <p>{{ $user->nameVicePresident }} {{ $user->lastNameVicePresident }}</p>
                    <p><strong>Vice-Président</strong></p>
                </div>

                <!-- Secrétaire Général(e) -->
                <div style="flex: 0 0 50%; text-align: center;">
                    <img src="{{ public_path('storage/attachments/' . basename($user->attachment3)) }}" 
                        alt="Logo" style="border-radius: 20px; width: 150px; height: 100px;">
                    <p>{{ $user->nameSecretaireGeneral }} {{ $user->lastNameSecretaireGeneral }}</p>
                    <p><strong>Secrétaire Général(e)</strong></p>
                </div>

                <!-- Trésorier(e) Général(e) -->
                <div style="flex: 0 0 50%; text-align: center;">
                    <img src="{{ public_path('storage/attachments/' . basename($user->attachment4)) }}" 
                        alt="Logo" style="border-radius: 20px; width: 150px; height: 100px;">
                    <p>{{ $user->nameTresorierGeneral }} {{ $user->lastNameTresorierGeneral }}</p>
                    <p><strong>Trésorier(e) Général(e)</strong></p>
                </div>
            </div>

        </div>

        <footer>
            <p style="font-style: italic;">{{ $user ->siege}}</p>
            <p style="font-style: italic;">{{ $user ->email}} , {{ $user ->number1}}/{{ $user ->number2}}</p>
            <p style="font-style: italic;">{{ $user ->lien}}</p>
        </footer>
    
                          

</body>
</html>
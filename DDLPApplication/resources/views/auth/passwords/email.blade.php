<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicons -->
        <link href="{{ asset('/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Satisfy:wght@400&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
        
        <!-- Vendor CSS Files -->
        <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('/css/email.css') }}" rel="stylesheet">
        
        <title>Réinitialisation</title>
    </head>
    
    <body>

        <main class="main">

            <div class="container">
                
                <div class="gauche">
                    <img src="{{ asset('/img1/logo-cotonou.png') }}" alt="">
                </div>

                <div class="droite">
                    
                    <h1>Mot de Passe Oublié</h1>                    

                    <div class="con">

                        @if (session('status'))
                            <div style="color: green;">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="trai"></div>

                            <p>Veuillez saisir votre adresse e-mail et soumettre le formulaire pour recevoir un lien de réinitialisation de votre mot de passe.</p>

                            <div>
                                <label for="email">Email <span>*</span></label>
                                <input type="email" name="email" id="email" required placeholder="Entrez votre email">
                            </div>
                            
                            <button id="bouton" type="submit" onmouseover="this.style.backgroundColor='#0056b3'; this.style.color='white';" onmouseout="this.style.backgroundColor='#004B70'; this.style.color='white';">Envoyer pour la réinitialisation</button>

                            <div class="trai1"></div>

                            <div class="pass">
                                <a href="{{ route('connexion') }}">Retour à la page de connexion</a>
                            </div>
                        </form>

                    </div>
                    
                    <style>
                        .container .droite{
                            width: 650px !important;
                        }

                        #bouton{
                            background-color: #004B70;
                            color: white;
                            cursor: pointer;
                            transition: background-color 0.3s ease, color 0.3s ease;
                            width: 449px;
                            height: 40px;
                            margin-top: 40px;
                            margin-left: 30px;
                            padding: 10px;
                            gap: 10px;
                            border-radius: 4px;
                            border: 1px solid #004B70;
                            font-family: var(--section-font);
                            font-size: 16px;
                            font-weight: 600;
                        }
                        @media(max-width: 768px){
                            .container .droite h1{
                                width: 500px;
                                margin-left: -160px;
                                font-size: 35px;
                                margin-top: 10px;
                                margin-bottom: -30px;
                            }

                            #bouton{
                                width: 300px;
                            }

                        }

                    </style>

                </div>

            </div>

        </main>

    </body>
</html>
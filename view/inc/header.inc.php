
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="view/inc/css/style.css">
    <title><?= $title ?></title>
</head>
<body>

<header>
    <nav id="nav" class="navbar is-info">
        <div class="navbar-brand">
            <a class="title is-2 has-text-white" href="https://bulma.io"><i class="fas fa-code has-text-danger"></i> Web Dev Trends | Blog</a>
        </div>
        <div class="navbar-menu">
            <div class="navbar-end">
                <form action="index.php?action=connexion" method="post">
                    <div class="field is-grouped">
                        <div class="control has-icons-left">
                            <input class="input is-grey-light" type="text" id="log" name="login" placeholder="Login">
                            <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                        </div>
                        <div class="control has-icons-left">
                            <input class="input is-grey-light" type="password" id="password" name="pass" placeholder="Password">
                            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                        </div>
                        <div class="control">
                            <input class="button is-danger" type="submit" value="Connexion">
                        </div>
                        <div class="control">
                            <input id="button" type="button" class="button is-primary" value="Inscription">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>


    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <form id="inscription" action="index.php?action=inscription" method="post">
                <div class="field">
                    <div class="control has-icons-left">
                        <input type="text" class="input is-primary is-large" id="firstName" name="firstName" placeholder="Prénom">
                        <span class="icon is-small is-left"><i class="fas fa-user"></i>
                    </div>
                    <div class="control has-icons-left">
                        <input type="text" class="input is-primary is-large" id="lastName" name="lastName" placeholder="Nom">
                        <span class="icon is-small is-left"><i class="fas fa-user"></i>
                    </div>
                    <div class="control has-icons-left">
                        <input type="email" class="input is-primary is-large" id="mail" name="mail" placeholder="Email">
                        <span class="icon is-small is-left"><i class="fas fa-at"></i>
                    </div>
                    <div class="control has-icons-left">
                        <input type="text" class="input is-primary is-large" id="login" name="login" placeholder="Login">
                        <span class="icon is-small is-left"><i class="fas fa-user"></i>
                    </div>
                    <div class="control has-icons-left">
                        <input type="password" class="input is-primary is-large" id="pass" name="pass" placeholder="Password">
                        <span class="icon is-small is-left"><i class="fas fa-key"></i>
                    </div>
                    <div id="modalButton" class="control">
                        <input type="submit" class="button is-primary is-large" id="submit" name="submit" value="Valider">
                    </div>
                </div>
            </form>
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>
</header>



<script>
    const button = document.querySelector('#button');
    const modal = document.querySelector('.modal');
    const close = document.querySelector('button');

    button.addEventListener('click', function(){
        modal.classList.add('is-active');
    });
    close.addEventListener('click', function(){
        modal.classList.remove('is-active');
    });
</script>




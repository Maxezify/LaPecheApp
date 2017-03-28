<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Application La Pêche</title>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
    <nav class="orange lighten-3" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">La Pêche</a>
        </div>
    </nav>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br>
            <h4 class="header center orange-text">Bienvenue sur la Pêche !</h4>
            <div class="row center">
                <h6 class="header col s12 light">Une application de la monnaie locale La Pêche</h6>
            </div>
            <br>
            <br>
            <br>
            <div class="row center">
                <form method="post" action="#" id="monForm">
                    <label for="pseudo">Pseudo</label>
                    <div class="col s12">
                        <input type="text" id="pseudo" name="pseudo" placeholder="Tapez votre pseudo ici" class="validate">
                    </div>

                    <br>

                    <label for="mdp">Mot de Passe</label>
                    <div class="col s12">
                        <input type="password" id="password" name="password" placeholder="Tapez votre mot de passe ici" class="validate">
                    </div>

                    <div class="col s12">
                        <input type="submit" id="envoyer" value="Envoyer" />
                    </div>

                    <div id="loader" style="display: none">
                        <img src="ajax-loader.gif" alt="loader" />
                    </div>

                </form>
            </div>
            <br>

        </div>
    </div>
    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

    <script src="js/materialize.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#monForm").submit(function () {

                $("#loader").show(); //gif
                pseudo = $(this).find("input[name=pseudo]").val(); //recuperation de valeur entré dans le formulaire
                mdp = $(this).find("input[name=password]").val();

                $.post('cible_inscription.php', {
                    pseudo: pseudo,
                    mdp: mdp
                }, function (data) {
                    $("#loader").hide();
                    alert(data);
                })

                return false;

            });

        });
    </script>

</body>

</html>
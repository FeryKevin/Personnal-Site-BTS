<!-- php : controle des champs et insert -->

<?php

require('connexion.php');

/* declaration variable php */

$nom = $sujet = $prenom = $email = $message = "";
$nomError = $sujetError = $prenomError = $emailError = $messageError = "";
$isSuccess = false;


/* controle des champs du formulaire */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = verifyInput($_POST["nom"]);
    $sujet = verifyInput($_POST["sujet"]);
    $prenom = verifyInput($_POST["prenom"]);
    $email = verifyInput($_POST["email"]);
    $message = verifyInput($_POST["message"]);
    $isSuccess = true;

    if (empty($nom)) {
        $nomError = "Veuillez saisir votre nom.";
        $isSuccess = false;
    }

    if (empty($sujet)) {
        $sujetError = "Veuillez saisir le sujet de votre message.";
        $isSuccess = false;
    }

    if (empty($prenom)) {
        $prenomError = "Veuillez saisir votre prénom.";
        $isSuccess = false;
    }

    if (!isEmail($email)) {
        $emailError = "Veuillez saisir un e-mail valide.";
        $isSuccess = false;
    }

    if (empty($message)) {
        $messageError = "Veuillez saisir un message.";
        $isSuccess = false;
    }

    /* insert dans la base de donnée */

    if ($isSuccess) {
        $db = connect();
        $statement = $db->prepare("INSERT INTO personnes (nom,prenom,email) values(?, ?, ?)");
        $statement->execute(array($nom, $prenom, $email));
        $statement = $db->prepare("INSERT INTO messages (sujet,message) values(?, ?)");
        $statement->execute(array($sujet, $message));
        $db = disconnect();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- tarteaucitron : cookies -->

    <script src="tarteaucitron/tarteaucitron.js"></script>

    <script>
        tarteaucitron.init({
            "privacyUrl": "", /* Privacy policy url */
            "bodyPosition": "bottom", /* or top to bring it as first element for accessibility */
            "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
            "cookieName": "tarteaucitron", /* Cookie name */

            "orientation": "middle", /* Banner position (top - bottom) */

            "groupServices": false, /* Group services by category */
            "serviceDefaultState": "wait", /* Default state (true - wait - false) */

            "showAlertSmall": false, /* Show the small banner on bottom right */
            "cookieslist": false, /* Show the cookie list */

            "closePopup": false, /* Show a close X on the banner */

            "showIcon": false, /* Show cookie icon to manage cookies */
            //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
            "iconPosition": "BottomRight", /* BottomRight, BottomLeft, TopRight and TopLeft */

            "adblocker": false, /* Show a Warning if an adblocker is detected */

            "DenyAllCta": true, /* Show the deny all button */
            "AcceptAllCta": true, /* Show the accept all button when highPrivacy on */
            "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */

            "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

            "removeCredit": false, /* Remove credit link */
            "moreInfoLink": true, /* Show more info link */

            "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
            "useExternalJs": false, /* If false, the tarteaucitron.js file will be loaded */

            //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */

            "readmoreLink": "", /* Change the default readmore link */
            "mandatory": true, /* Show a message about mandatory cookies */
            "mandatoryCta": true /* Show the disabled accept button when mandatory on */
        });

        /* google analytics */
        tarteaucitron.user.gtagUa = 'G-28M5D2P3BH';
        tarteaucitron.user.gtagMore = function () { };
        (tarteaucitron.job = tarteaucitron.job || []).push('gtag');

    </script>

    <title>Fery Kevin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body data-spy="scroll" data-target="#myNavbar" data-offset="60">

    <!-- création de la navbar -->

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- création des catégories de la navbar -->

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="#presentation">Présentation</a></li>
                    <li><a href="#projets">Projets</a></li>
                    <li><a href="#competences">Compétences</a></li>
                    <li><a href="#parcoursScolaire">Parcours scolaire</a></li>
                    <li><a href="#formulaire">Contactez-moi</a></li>
                    <li><a href="#documentation">Documentations</a></li>
                    <li><a href="login.php" id="connexion">Connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- section présentation -->

    <section id="presentation">
        <div class="container-fluid">
            <div class="row">

                <!-- création image présentation -->

                <div class="col-lg-5 col-lg-offset-1 col-md-6 col-sm-12">
                    <div class="photoProfil">
                        <img src="images/photo-de-profil.png" alt="Kevin Fery" class="img-circle">
                    </div>
                </div>

                <!-- création texte présentation -->

                <div class="col-lg-5 col-lg-offset--1 col-md-6 col-sm-12">
                    <div class="textProfil">
                        <h1>FERY Kevin</h1>
                        <h3>Développeur Web Junior</h3>
                        <div class="flexGit">
                            <a class="lienGithub" href="https://github.com/FeryKevin" target="_blank">Github</a>
                        </div>
                        <a href="documents/CV_FERY_KEVIN.pdf" download="CV_Fery_Kevin" class="buttonp">Télécharger mon
                            CV</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section projets -->

    <section id="projets">
        <div class="container">

            <!-- création titre de projets -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="h2Projets">Projets</h2>
                </div>
            </div>

            <!-- affichage dynamique -->

            <?php

            $db = connect();

            $statement = $db->query("SELECT * FROM projets");

            /* boucle permettant d'afficher tous les projets */

            while ($projet = $statement->fetch()) {
                echo "<div class='col-lg-4 col-md-6 col-sm-12'>
                        <a class='thumbnail' href='#' data-toggle='modal' data-target='#modal" . $projet['id_projet'] . "'><img src='images/" . $projet['image'] . " ' class='imageprojet' alt='image_projet'></a>
                        <div class='modal fade' id='modal" . $projet['id_projet'] . "'> 
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                        <h5 class='modal-title'>" . $projet['titre'] . "</h5>
                                    </div>
                                    <div class='modal-body'>
                                        <p>Vous allez être redirigé vers une autre page, voulez-vous continuer ?</p>
                                    </div>
                                    <div class='modal-footer'>
                                        <a href='projets/projet.php?id=" . $projet['id_projet'] . ".' class='buttons '>Continuer</a>
                                        <button type='button' class='buttons' data-dismiss='modal'>Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>";
            }

            disconnect();

            ?>

        </div>
    </section>

    <!-- section compétences -->

    <section id="competences">
        <div class="container">

            <!-- création titre de compétences -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="h2Competences">Compétences</h2>
                </div>
            </div>


            <!-- bouton affichant les compétences en fonction de l'année scolaire -->

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <button type="button" class="btn btn-primary" id="a2021">Consulter l'année 2021-2022</button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <button type="button" class="btn btn-primary" id="a2022">Consulter l'année 2022-2023</button>
                </div>
            </div>

            <!-- timeline année 2022-2023-->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="timeline" id="timeline2">

                        <!-- timeline mai 2023 -->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Mai 2023</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : JavaScript</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline avril 2023 -->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Avril 2023</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet encadré : Finissions d'un site pour le CSE du
                                        lycée Saint-Vincent en Symfony et réalisation d'une documentation technique et fonctionnelle</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline mars 2023 -->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Mars 2023</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet encadré : Création d'un site pour le CSE du
                                        lycée Saint-Vincent en Symfony</p>
                                    <p class="pProjet">Autre : Certification PIX (395 PIX)</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline février 2023 -->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Février 2023</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet réalisé en stage : Création d'un site de gestion des
                                        clients, des hébergeurs et des projets d'une entreprise en Symfony, Tailwind CSS
                                        et JavaScript et réalisation d'un manuel d'utilisation</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline janvier 2023 -->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Janvier 2023</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet réalisé en stage : Intégration d'un slider principalement en JavaScript</p>
                                    <p class="pProjet">Projet réalisé en stage : Création d'un site de gestion des
                                        clients, des hébergeurs et des projets d'une entreprise en Symfony, Tailwind CSS
                                        et JavaScript</p>
                                    <p class="pProjet">Stack technique : Tailwind CSS</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline decembre 2022 -->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Décembre 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Veille complète sur PHP</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline novembre 2022 -->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Novembre 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : Symfony</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline octobre 2022-->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Octobre 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : Axure RP</p>
                                    <p class="pProjet">Projet encadré : Application de gestion des clients, des produits
                                        et des devis en POO en C# et réalisation d'une documentation technique et fonctionnelle</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline septembre 2022-->

                        <li class="timeline-inverted">
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Septembre 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : POO C#</p>
                                    <p class="pProjet">Stack technique : POO PHP</p>
                                    <p class="pProjet">Projet encadré : Site de gestion des clients, des hébergeurs, des
                                        projets en POO en PHP avec l'intervention de M. Jeff MARTINS</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- timeline année 2021-2022 -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="timeline" id="timeline">

                        <!-- timeline aout 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Août 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : Tarteaucitron.js</p>
                                    <p class="pProjet">Projet encadré : Amélioration du site personnel en HTML, CSS,
                                        Bootstrap, PHP et SQL et création de maquettes fonctionnelles avec <a
                                            href="https://wireframe.cc/" class="lienUdemy">Wireframe.cc</a>, ainsi qu'un
                                        kit UI et d'un manuel d'utilisation de ce site</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline juillet 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Juillet 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet individuel : Amélioration du site personnel en HTML, CSS,
                                        Bootstrap, PHP et SQL : <span style="color: #5bc0de">validation W3C et google
                                            speed</span></p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline juin 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Juin 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet réalisé en stage : Création d'un site de gestion des
                                        clients, des hébergeurs et des projets d'une entreprise en HTML, CSS, Bootstrap,
                                        PHP et SQL</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline mai 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Mai 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : Winwheel.js</p>
                                    <p class="pProjet">Projet encadré : Création d'une roue de la fortune en Winwheel
                                        (librairie de JavaScript) avec des contraintes en PHP</p>
                                    <p class="pProjet">Projet encadré : Création d'un site de gestion des clients d'une
                                        entreprise en HTML, CSS, Bootstrap, PHP et SQL</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline avril 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Avril 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : jQuery</p>
                                    <p class="pProjet">Projet encadré : Création d'un site en jQuery via la plateforme
                                        <a href="https://www.udemy.com" class="lienUdemy">Udemy.com</a>
                                    </p>
                                    <p class="pProjet">Projet encadré : Création d'un site en respectant un cahier des
                                        charges en HTML, CSS, Bootstrap, PHP et SQL</p>
                                    <p class="pProjet">Projet encadré : Troisième version du site personnel en HTML,
                                        CSS, Bootstrap, jQuery, PHP et SQL</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline mars 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Mars 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : Python</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline février 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Février 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet encadré : Gestion d'un formulaire en HTML, CSS, PHP et SQL
                                        avec l'intervention de M. Jérémy MARQUES</p>
                                    <p class="pProjet">Projet encadré : Deuxième version du site personnel en HTML, CSS,
                                        Bootstrap, jQuery, PHP et SQL</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline janvier 2022-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Janvier 2022</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : PHP</p>
                                    <p class="pProjet">Projet encadré : Création d'un site dynamique en HTML, CSS, PHP
                                        et SQL via la plateforme <a href="https://www.udemy.com"
                                            class="lienUdemy">Udemy.com</a></p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline décembre 2021-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Décembre 2021</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet encadré : Première version du site personnel en HTML, CSS,
                                        Bootstrap et jQuery</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline novembre 2021-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Novembre 2021</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Projet encadré : Intégration d'une maquette en responsive en
                                        HTML, CSS et Bootstrap avec l'intervention de M. Christopher ESPARGELIERE</p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline octobre 2021-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Octobre 2021</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : Bootstrap</p>
                                    <p class="pProjet">Projet encadré : Portfolio en HTML, CSS, jQuery et Bootstrap via
                                        la plateforme <a href="https://www.udemy.com" class="lienUdemy">Udemy.com</a>
                                    </p>
                                </div>
                            </div>
                        </li>

                        <!-- timeline septembre 2021-->

                        <li>
                            <div class="timeline-badge info"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><i class="glyphicon glyphicon-calendar"
                                            style="color: #008"></i>&nbsp;Septembre 2021</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="pProjet">Stack technique : HTML, CSS, SQL et C#</p>
                                    <p class="pProjet">Projet encadré : Intégration d'un CV en HTML et en CSS</p>
                                    <p class="pProjet">Projet encadré : Création d'un site de voyage en HTML et en CSS
                                        via la plateforme <a href="https://www.udemy.com"
                                            class="lienUdemy">Udemy.com</a></p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- section parcours scolaire -->

    <section id="parcoursScolaire">
        <div class="container">

            <!-- création titre du parcours scolaire -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="h2Scolaire">Parcours Scolaire</h2>
                </div>
            </div>

            <!-- création du premier article du parcours scolaire -->

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-5">
                    <article style="background-image: url(images/st-joseph.jpg)">
                        <div class="overlay1">
                            <h4>Institution Saint-Joseph du Moncel</h4>
                            <p class="lieuScolaire0"><span class="glyphicon glyphicon-map-marker">
                                    Pont-Ste-Maxence</span></p>
                            <p class="dateScolaire0"><span class="glyphicon glyphicon-calendar"> 2014-2021</span></p>
                            <p class="dyplomeScolaire0"><span class="glyphicon glyphicon-education"> Baccalauréat STMG
                                    option Mercatique</span></p>
                            <a href="https://www.isjm.fr/" target="_blank" class="buttons">Consulter le site</a>
                        </div>
                    </article>
                </div>

                <!-- création du second article du parcours scolaire -->

                <div
                    class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-5 col-lg-offset-2">
                    <article style="background-image: url(images/st-vincent.jpg)">
                        <div class="overlay1">
                            <h4>Lycée Privé Saint-Vincent</h4>
                            <p class="lieuScolaire"><span class="glyphicon glyphicon-map-marker"> Senlis</span></p>
                            <p class="dateScolaire"><span class="glyphicon glyphicon-calendar"> Depuis 2021</span></p>
                            <a href="https://www.lycee-stvincent.fr/" target="_blank" class="buttons">Consulter le
                                site</a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- section formulaire -->

    <section id="formulaire">
        <div class="container">
            <div class="row">

                <!-- création titre du formulaire -->

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="h2Formulaire">Contactez-moi</h2>
                </div>

                <!-- création du formulaire et utilisation de la methode post -->

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form id="contact-form" method="post"
                        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">

                                <!-- création label, input nom avec utilisation variable php et commentaire -->

                                <label for="nom" class="labelFormulaire">Nom<span style="color:red;"> *</span></label>
                                <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom"
                                    value="<?php echo $nom; ?>">
                                <p style="color:red; font-style:italic;">
                                    <?php echo $nomError; ?>
                                </p>

                                <!-- création label, input prénom avec utilisation variable php et commentaire -->

                                <label for="prenom" class="labelFormulaire">Prénom<span style="color:red;">
                                        *</span></label>
                                <input type="text" id="prenom" name="prenom" class="form-control"
                                    placeholder="Votre prénom" value="<?php echo $prenom; ?>">
                                <p style="color:red; font-style:italic;">
                                    <?php echo $prenomError; ?>
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">

                                <!-- création label, input email avec utilisation variable php et commentaire  -->

                                <label for="email" class="labelFormulaire">E-mail<span style="color:red;">
                                        *</span></label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Votre e-mail" value="<?php echo $email; ?>">
                                <p style="color:red; font-style:italic;">
                                    <?php echo $emailError; ?>
                                </p>

                                <!-- création label, input sujet avec utilisation variable php et commentaire -->

                                <label for="sujet" class="labelFormulaire">Sujet<span style="color:red;">
                                        *</span></label>
                                <input type="text" id="sujet" name="sujet" class="form-control" placeholder="Sujet"
                                    value="<?php echo $sujet; ?>">
                                <p style="color:red; font-style:italic;">
                                    <?php echo $sujetError; ?>
                                </p>
                            </div>

                            <!-- création de la zone textarea du formulaire et commentaire -->

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="message" class="labelFormulaire">Message<span style="color:red;">
                                        *</span></label>
                                <textarea id="message" name="message" class="form-control" placeholder="Votre message"
                                    rows="4"></textarea>
                                <p style="color:red; font-style:italic;">
                                    <?php echo $messageError; ?>
                                </p>
                            </div>

                            <!-- création zone de remerciement -->

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="remerciement" style="display:<?php if ($isSuccess)
                                    echo 'block';
                                else
                                    echo 'none'; ?>">Votre message
                                    a bien été envoyé. Merci de m'avoir contacté.</p>
                            </div>

                            <!-- création du bouton du formulaire -->

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="submit" class="buttonf" value="Envoyer">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- création du mailto -->

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a href="mailto:kevin.fery@outlook.com" class="mailtoForm">Ou cliquer ici pour me contacter</a>
                </div>
            </div>
        </div>
    </section>

    <!-- section documentation -->

    <section id="documentation">
        <div class="container">
            <div class="row">

                <!-- création titre du formulaire -->

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="h2Scolaire">Documentations</h2>
                </div>

                <!-- annexe -->

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <br>
                    <!-- documentations -->
                    <div class="col-lg-4 col-md-4 col-lg-12">
                        <h4 class="hdoc"><strong>Documentations : </strong></h4><br>
                        <p class="pannexe"><a href="documents/Wireframe_site_personnel.pdf" target="_blank">- Maquettes
                                (wireframe)</a></p>
                        <p class="pannexe">- Kit UI <a href="documents/kit_ui/Kit%20UI.pdf" target="_blank">(pdf) </a><a
                                href="documents/kit_ui/KIT_UI.zip" download="kfery_kit_ui.zip">(zip)</a></p>
                        <p class="pannexe" style="margin-bottom: 25px;"><a href="documents/Manuel_utilisation.pdf"
                                target="_blank">- Manuel d'utilisation</a></p>
                    </div>


                    <!-- validation -->
                    <div class="col-lg-4 col-md-4 col-lg-12">
                        <h4 class="hdoc"><strong>Validations : </strong></h4><br>
                        <p class="pannexe"><a href="documents/W3C.png" target="_blank">- Validation W3C</a></p>
                        <p class="pannexe" style="margin-bottom: 25px;"><a href="documents/google_speed.png"
                                target="_blank">- Google Speed</a></p>
                    </div>


                    <!-- autres -->
                    <div class="col-lg-4 col-md-4 col-lg-12">
                        <h4 class="hdoc"><strong>Autres : </strong></h4><br>
                        <p class="pannexe"><a href="#tarteaucitron">- Gestion des cookies</a></p>
                        <p class="pannexe"><a href="404.html">- Page 404 personnalisé</a></p>
                        <p class="pannexe"><a href="documents/Veille_PHP.pdf" target="_blank">- Veille complète sur
                                PHP</a></p>
                        <p class="pannexe"><a href="documents/Présentation_Stage2.pptx" target="_blank">- Stage de
                                deuxième année</a></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- création du footer -->

    <footer id="finPortfolio">
        <a href="#presentation">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <h5>© 2023 FERY Kevin</h5>
    </footer>

</body>

</html>
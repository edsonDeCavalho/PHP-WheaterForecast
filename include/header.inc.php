<!DOCTYPE html>
<html lang="fr">
<head>
<title>Wheather Forecast</title>
<meta charset="utf-8"/>
<meta name="author" content="MOROUS" />
<meta name="date" content="2020-03-20T19:27:04+0100" />
<meta name="description" content="Page de accueil"/>
<link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
<header>	
    <!--Menu de navigation-->
<h1>Wheather Forecast</h1>
<nav class="navbar">
    <img src="./img/CY_Cergy_Paris_Universite_Pant446.png" width="180" height="60" class="logo" alt="logo_CY" />
    <div class="topnav">
    <?php
    if(isset($_GET['active'])){
        $page=$_GET['active'];
        switch($page){
            case "'Statiques'" :
            ?>
            <a href="./index.php?">Page d'acceuil</a>
            <a class='active' href="./statistiques.php?active='Statiques'">Statistiques</a>
            <a href="./new.php?active='New'">New</a>
             <?php
            break;
			case "'New'" :
            ?>
            <a href="./index.php?">Page d'acceuil</a>
            <a href="./statistiques.php?active='Statiques'">Statistiques</a>
            <a class='active' href="./new.php?active='New'">New</a>
            <?php
             break;
			case "'About'" :
            ?>
            <a href="./index.php?">Page d'acceuil</a>
            <a href="./statistiques.php?active='Statiques'">Statistiques</a>
            <a href="./new.php?active='New'">New</a>
            <?php
            break;
			default:
            ?>
            <a  href="./index.php?">Page d'acceuil</a>
            <a href="./statistiques.php?active='Statiques'">Statistiques</a>
            <a class='active' href="./new.php?active='New'">New</a>
            <?php
            break;
        }
    }
    else{
         ?>
        <a class='active' href="./index.php?">Page d'acceuil</a>
        <a href="./statistiques.php?active='Statiques'">Statistiques</a>
        <a href="./new.php?active='New'">New</a>
        <?php
    }
    ?>
    </div>
</nav>
</header>
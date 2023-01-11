<?php
session_start();                       // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');  // WARNING : NE PAS EFFACER CETTE LIGNE


//je crée mon tableau des produits
$produits=chargerFichier("data/products.json");
$tab=chargerFichier("data/avis.json");
$nbProduit=0;
foreach($_SESSION["panier"] as $k => $p){
    $nbProduit=$nbProduit+$p;
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>The Computer Shop</title>
    <link rel="stylesheet" href="assets/site/style.css">
</head>

<body> 
    <div class="banner">
        <img src="assets/site/banner.jpg">
        <p>The computer shop</p>
    </div>

    <p class="care">We take care of your PC</p>
        <div class="menu">
            <div class="bar">
            <a href="index.php">Accueil</a>
            <a href="magasin.php">Le shop</a> 
            <a href="nosmagasins.php">Nos magasins</a>  
            <a href="contact.php">Nous contacter</a>  
            </div>    
            <div class="panier">  
                <a href="visuPanier.php">
                <div class="notif">
                <p> <?php echo $nbProduit ; ?></p>
                </div>
                <img src="assets/site/pannier.svg" > 
                <p class="ssPanier">Panier</p>
                </a>
            </div>
        </div>

<?php
foreach($produits as $ref => $p){
    afficheProduit($p,$ref);
}

?>
<footer>
    <p class="txtFoot">© 2022 Alex Hannier - Arthur Cuvillon</p>
</footer>
</body>
</html>

<?php
session_start();                       // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');  // WARNING : NE PAS EFFACER CETTE LIGNE


//je crée mon tableau des produits (il sera utile...)
$produits=chargerFichier("data/products.json");
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
    <div class="magasins">
       <p> Idéalement situé pres du stade Bollaert, notre Magasin est situé dans la ville de Lens</p>
        <img src="assets/site/devanture.jpg">
        <center>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2471.652013070082!2d2.8052500776185583!3d50.43841929142156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47dd308a06db2f01%3A0x2671190e96c659c0!2sIUT+de+LENS!5e0!3m2!1sfr!2sfr!4v1451495619417"
                        width="390" height="335" frameborder="0" style="border:0;margin-top:25px" allowfullscreen></iframe></center>
</div>
<footer>
    <p class="txtFoot">© 2022 Alex Hannier - Arthur Cuvillon</p>
</footer>
</body>
</html>

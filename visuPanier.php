<?php
session_start();                       // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');  // WARNING : NE PAS EFFACER CETTE LIGNE
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
    <?php
    $prixTotal=0;
    $nbProduit=0;
    if($_SESSION['panier']!=null){
    echo "<div class='miaou'>
    <div class='panierr'>
        <p class='titre'>VOTRE PANIER</p>
        <table>
            <tr class='premierLpanier'>
                <th> </th>
                <th class='désignation'> Désignation</th>
                <th class='PrixU'>P.U TTC</th>                    
                <th class='Qte'>Quantité</th>    
                <th class='ttc'>Total TTC</th>                    
            </tr>
            ";
foreach($_SESSION["panier"] as $k => $p){
    echo "<tr>
    <th><img src=";
    echo $produits[$k]["imageUrl"];
    echo " class='imgprod'></th>
    <th class='désignation'> <a href='article.php?reference=$k'>";
    echo $produits[$k]["titre"];
    echo "</a></th>
    <th class='PrixU'>";
    echo $produits[$k]["prix"];
    echo "</th>                    
    <th class='Qte'>";
    echo $p;
    echo "<a href='supprimerPanier.php?reference=$k'> <img src='assets/site/rmProduct.png' class='achat'></a></th>    
    <th class='ttc'>";
    $prixtotTTC=$produits[$k]["prix"]*$p;
    echo $prixtotTTC;
    echo "</th>  
    </tr>";
    $prixTotal=$prixTotal+$produits[$k]["prix"]*$p;
    $nbProduit=$nbProduit+$p;
}}else{
    echo "<div class='miaou'>
    <div class='panierr'>
        <p class='titre'>VOTRE PANIER EST VIDE</p>
            ";
}
echo "</table></div>";
echo "<div class='recap'>
<p class='titre'>Récapitulatif</p>
<table >
    <tr>
        <th> Panier ($nbProduit produit(s))</th>
        <th class='price'> $prixTotal €</th>
    </tr>
    <tr >
        <th>Frais de Livraison :</th>
        <th class='price'>GRATUIT</th>
    </tr>
    <tr class='totrecap'>
        <th> TOTAL :</th>
        <th class='priceTot'> $prixTotal €</th>
    </tr>
</table>
<a href='https://www.paypal.com/paypalme/aserlite' class='paie'> PAIEMENT </a>
<p class='modesPaiement'> Modes de paiement</p>
<img src='assets/site/paiement.png'> 
</div>
</div>";
$_SESSION["nbProduit"]=$nbProduit;
?>
<footer>
    <p class="txtFoot">© 2022 Alex Hannier - Arthur Cuvillon</p>
</footer>
</body>
</html>

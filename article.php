<?php
session_start();                       // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');  // WARNING : NE PAS EFFACER CETTE LIGNE


//je crée mon tableau des produits (il sera utile...)
$produits=chargerFichier("data/products.json");
$reference = $_GET["reference"];
$produit = $produits[$reference]; 
//je crée mon tableau de commentaires
$commentaires=chargerFichier("data/avis.json");
$commentaires=$commentaires["commentaires"];
//J'ajoute mes commentaires dans le tableau des produits
$comms=[];
//print_r($commentaires);
for($i=0;$i<count($commentaires);$i++){
    if($commentaires[$i]["reference"]==$reference){
        $comms[]=$commentaires[$i];
    }
}    
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
// a votre imagination    
afficheProduit($produit,$reference);
echo"<style>.produit{border:none}</style>
<div class='commentaires'>";
if ($comms==NULL){
    echo "<p class='rien'>Il n'y a pas de retour disponible pour ce produit </p>";
}else{
    for($i=0;$i<count($comms);$i++){
        afficheCommentaire($comms[$i]);
    }
}
echo "</div>";
?>

<p class='interet'>Ces produits pourraient egalement vous interesser</p>
<?php   

echo"<div class='containerSim'>";
afficheArticleSimilaire($reference);
echo"</div>";
?>
<footer>
    <p class="txtFoot">© 2022 Alex Hannier - Arthur Cuvillon</p>
</footer>
</body>
</html>

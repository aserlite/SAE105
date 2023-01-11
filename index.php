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

<?php
$ref=[];
$bestseller=$_SESSION['panier'];
$rndTab=[];
$mixTab=[];

foreach($produits as $k => $p){
    $ref[]=$k;
}

//Création d'un tableau réunissant les references les plus présentes dans le panier affiché uniquement quand le panier contient au moins un produit
$best=[];

if($bestseller!=NULL){
    $temp=0;
    $tmpBest=0;
    foreach($bestseller as $k => $v){
        if($v>$temp){
            $temp=$v;
            $tmpBest=$k;
        }
    }
    unset($bestseller[$tmpBest]);
    $best[]=$tmpBest;
}

if($bestseller!=NULL){
    $temp=0;
    $tmpBest=0;
    foreach($bestseller as $k => $v){
        if($v>$temp){
            $temp=$v;
            $tmpBest=$k;
        }
    }
    unset($bestseller[$tmpBest]);
    $best[]=$tmpBest;
}

if($bestseller!=NULL){
    $temp=0;
    $tmpBest=0;
    foreach($bestseller as $k => $v){
        if($v>$temp){
            $temp=$v;
            $tmpBest=$k;
        }
    }
    unset($bestseller[$tmpBest]);
    $best[]=$tmpBest;
}


//Creation d'un tableau reunissant des references aléatoires
for($i=0;$i<3;$i++){
    $tmp=random_int(0,count($ref)-1);
    while(in_array($ref[$tmp],$rndTab)!=false){
        $tmp=random_int(0,count($ref));
    }
    $rndTab[]=$ref[$tmp];
}

//Creation d'un tableau reunissant les references des produits les mieux notés
$bestNote=[];

$temp=0;
$tmpBest=0;
for($i=0;$i<count($ref);$i++){
    if(calculeMoyenne($ref[$i])>$temp){
        $temp=calculeMoyenne($ref[$i]);
        $tmpBest=$i;
    }
}

$bestNote[]=$ref[$tmpBest];
unset($ref[$tmpBest]);
$temp=0;
$tmpBest=0;
for($i=0;$i<count($ref);$i++){
    if(calculeMoyenne($ref[$i])>$temp){
        $temp=calculeMoyenne($ref[$i]);
        $tmpBest=$i;
    }
}

$bestNote[]=$ref[$tmpBest];
unset($ref[$tmpBest]);
$temp=0;
$tmpBest=0;
for($i=0;$i<count($ref);$i++){
    if(calculeMoyenne($ref[$i])>$temp){
        $temp=calculeMoyenne($ref[$i]);
        $tmpBest=$i;
    }
}

$bestNote[]=$ref[$tmpBest];
unset($ref[$tmpBest]);

//Creation d'un tableau regroupant un produit aleatoire de chacun des trois tableaux precedents
if($_SESSION['panier']!=NULL){$mixTab[]=$best[random_int(0,count($best)-1 )];}
$mixTab[]=$rndTab[random_int(0,count($rndTab)-1)];
$mixTab[]=$bestNote[random_int(0,count($bestNote)-1)];
echo "<div class='accueil'>";
if($_SESSION['panier']!=NULL){echo "<div class='containerAccueil'><p class='titAccueil'>Les produits les plus vendus</p>";
affichageAccueil($best);
echo "</div>";}else{echo"<div class='containerAccueilB'><p class='titAccueil'>Les produits les plus vendus</p> <p>Aucun produit n'a été acheté par nos utilisateurs pour l'instant</p></div>";}
echo"<div class='containerAccueil'><p class='titAccueil'>Recommandations aléatoires</p>";
affichageAccueil($rndTab);
echo "</div><div class='containerAccueil'><p class='titAccueil'>Les produits les mieux notés</p>";
affichageAccueil($bestNote);
echo "</div><div class='containerAccueil'><p class='titAccueil'>Le mix des recommandations</p>";
affichageAccueil($mixTab);
echo "</div>";
echo "</div>";
?>
<footer>
    <p class="txtFoot">© 2022 Alex Hannier - Arthur Cuvillon</p>
</footer>
</body>
</html>

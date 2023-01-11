<?php

// prend en paramètre le nom d'un fichier (au format JSON) à charger
// retourne un tableau associatif
// Question : $nomFichier est : une chaine de caractère 
function chargerFichier($nomFichier) {
    $tab = file_get_contents("$nomFichier");
    $tab=json_decode($tab,true);
    return $tab;
}

// prend en paramètre un produit
// affiche le code html permettant l'affichage du produit
// Question : $produit est : un tableau associatif qui contient le titre du produit, le lien de l'image corespondante, 
//une description, un prix, et un type.

function afficheProduit($produit,$reference) {
    $url=$produit["imageUrl"];
    $titre=$produit["titre"];
    $description=$produit["description"];
    $prix=$produit["prix"];
    $type=$produit["type"];
    $commentaires=chargerFichier("data/avis.json");
    $commentaires=$commentaires["commentaires"];
    $notes=[];
    
    for($i=0;$i<count($commentaires);$i++){
        if($commentaires[$i]["reference"]==$reference){
            $notes[]=$commentaires[$i]["note"];
        }
    }
    $tmp=0;
    $tot=0;
    for($j=0;$j<count($notes);$j++){
        $tot=$tot+$notes[$j];
        $tmp=$tmp+1;
    }
    if($tmp!=0){$moyenne=$tot/$tmp;}

    echo"
    <div class='produit'>
    <div class='case'>
        <div>
            <img src='$url' class='imgproduit'>
        </div>
        <div class='txtProduit'>
            <a href='article.php?reference=$reference'><p class='nomProduit'> $titre</p></a>
            <p class='description'>$description</p>
        </div>
        <div class='buy'>
            <p class='avis'>";
        if($tmp==0){
            echo "Pas encore d'avis pour ce produit";
        }else{
            echo number_format($moyenne,2);
            echo " /10 (";
            echo $tmp;
            echo " avis)";
        }
       
        echo "</p>
            <a href='ajoutPanier.php?reference=$reference'><img src='assets/site/buy.png'></a>
            <p class='prix'>$prix €</p>
        </div>
    </div>
</div>";
}

// prend en paramètre un comentaire
// Affiche le code html permettant l'affichage d'un commentaire
// Question : $avis : un tableau, une chaine de caractère, ou un entier ? Si c'est un tableau que contient il ?
function afficheCommentaire($avis) {
echo"<table>
<tr>
    <th>par <b>";
echo $avis["auteur"];
echo "</b></th>
    <th class='com'>";
echo $avis["avis"];
echo "</th>
</tr>
<tr>
    <th>Posté le ";
echo $avis["date"];
echo "</th>   
</tr>
<tr>   
    <th class='note'>";
echo $avis["note"] ;
echo "/10</th>
</tr>
</table>  ";
}

// Prend en paramètre un produit
// Affiche le code HTML permettant d'afficher le bloc correspondant au produi similaire
// Question : $produit est : un tableau, une chaine de caractère, ou un entier ? Si c'est un tableau que contient il ?
function afficheArticleSimilaire($produit) {
    $produits=chargerFichier("data/products.json"); 
    $similaires=[];
    foreach($produits as $k => $p){
        if($p["type"]==$produits[$produit]["type"]){
            $similaires[]=$k;
        }
    }
    for($i=0;$i<count($similaires);$i++){
        if($produit!=$similaires[$i]){  
            echo"<div class='card'> <a href='article.php?reference=";
            echo $similaires[$i];
            echo "'>";
            echo"<p class='titreSim'>";
            echo $produits[$similaires[$i]]["titre"];
            echo"</p><img src=";
            echo $produits[$similaires[$i]]["imageUrl"];
            echo" class='similaires'><p class='simPrix'>";
            echo $produits[$similaires[$i]]["prix"];
            echo" € </p></a></div>";
        }
    }

}
function affichageAccueil($tab){
    $produits=chargerFichier("data/products.json"); 
    echo"<div class='containerAcc'>";
    for($l=0;$l<count($tab);$l++){
    echo"<div class='cardAcc'> <a href='article.php?reference=";
    echo $tab[$l];
    echo "'>";
    echo"<p class='titreAcc'>";
    echo $produits[$tab[$l]]["titre"];
    echo"</p><img src=";
    echo $produits[$tab[$l]]["imageUrl"];
    echo" class='Acc'><p class='simPrix'>";
    echo $produits[$tab[$l]]["prix"];
    echo" € </p></a></div>";}
    echo "</div>";
}

// prend en paramètre un tableau indicé de commentaires
// retourne la moyenne des notes relative aux avis associés à cette référence
function calculeMoyenne($reference) {
    $commentaires=chargerFichier("data/avis.json");
    $commentaires=$commentaires["commentaires"];
    $notes=[];
    for($i=0;$i<count($commentaires);$i++){
        if($commentaires[$i]["reference"]==$reference){
            $notes[]=$commentaires[$i]["note"];
        }
    }
    $tmp=0;
    $tot=0;
    for($j=0;$j<count($notes);$j++){
        $tot=$tot+$notes[$j];
        $tmp=$tmp+1;
    }
    if($tmp!=0){$moyenne=$tot/$tmp;}
    $moyenne = number_format($moyenne,2);
    return $moyenne;
}


//----------------------------------------------------------------------------------------
// WARNING : ne pas modifier ces lignes
//----------------------------------------------------------------------------------------

if(isset($_SESSION['panier']) == false)
    $_SESSION['panier'] = [];
$panier = $_SESSION["panier"];

?>

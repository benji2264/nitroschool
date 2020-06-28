<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
    <head>
      <!-- Polices d'écriture et style CSS -->
      <link rel="stylesheet" href="css/newstyle.css">
      <link href="https://fonts.googleapis.com/css?family=Alegreya&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Crimson+Text&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nobile&display=swap" rel="stylesheet">
      <link rel="icon" href="images/favicon.ico">
      <link rel="stylesheet" href="fonts/fonts.css" type="text/css"  />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <title>L'Autoécole du futur</title>
    </head>
    <body>
      <!-- Barre de navigation -->
      <div class="newnav">
        <div style="background-color:white">
          <a href="index.html"><img class="logo" height="54px" style="margin-left:95px;padding-bottom:9px;" src="images/logoRoro.png" alt="logo"></a>
          <div style="margin-left:3.5%" class="dropdown"><a href="ajouter_eleve.html"><button class="dropbtn">S'inscrire</button></a></div>
          <div class="dropdown"><a href="tarifs.html"><button class="dropbtn">Tarifs</button></a></div>
          <a class="deco" href="portail_moniteur.html" style="padding:12px;float:right;margin-right:75px;">Portail Moniteur</a>
        </div>
        <!-- Ombre sous la barre -->
        <div class="shadow"></div>
      </div>

    <!-- Message de remerciement -->
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 5%;padding-left: 12%;font-family: 'boldfont', serif;font-weight: lighter;">Merci
    <?php
      // Récupération des informations saisies
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $mail = $_POST['email'];
      echo "$prenom $nom";
     ?>
     </h3>
     <p style="margin-left:12%;margin-right:12%;text-indent:5%;font-size:18px;">Tu as fait le bon choix <?php echo "$prenom"; ?> ! Nous te contacterons bientôt à ton adresse <?php echo "$mail"; ?>, dès qu'un moniteur aura confirmé ton inscription ! Nous en profiterons pour te donner plus d'informations, mais en attendant bienvenue chez Nitroschool, l'auto-école du futur!</p>

     <!-- Pied de page -->
         <div class="bottom-container" style="margin-top:200px;">
           <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
           <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
           <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
           <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
         </div>
       </body>
     </html>

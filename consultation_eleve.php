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
            <!-- Menu Elèves -->
            <div style="margin-left:3.5%" class="dropdown">
                <button class="dropbtn">Elèves  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
                <div class="dropdown-content">
                <a href="liste_eleves.php">Consulter un élève</a>
                <a href="ajouter_eleve2.html">Ajouter un élève</a>
                <a href="calendrier_eleve.php">Calendrier élève</a>
                <a href="statistiques_eleve.php">Statistiques élève</a>
                </div>
              </div>
          <!-- Menu Séances -->
          <div class="dropdown">
              <button class="dropbtn">Séances  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
              <div class="dropdown-content">
              <a href="liste_seances.php">Afficher les séances</a>
              <a href="ajouter_seance.php">Ajouter une séance</a>
              <a href="supprimer_seance.php">Supprimer une séance</a>
              <a href="inscription.php">Inscrire un élève</a>
              <a href="desinscription.php">Désinscrire un élève</a>
              <a href="resultats.php">Saisir résultats d'une séance</a>
              </div>
            </div>
        <!-- Menu Thèmes -->
        <div class="dropdown">
            <button class="dropbtn">Thèmes  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
            <div class="dropdown-content">
            <a href="liste_themes.php">Gérer les thèmes</a>
            <a href="ajouter_theme.html">Ajouter un thème</a>
            </div>
        </div>
        <a class="deco" href="index.html" style="padding:12px;float:right;margin-right:75px;">Déconnexion</a>
      </div>
      <!-- Ombre sous la barre -->
      <div class="shadow"></div>
    </div>
    <?php
      //Connexion
      date_default_timezone_set('Europe/Paris');
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // On récupère l'ID de l'élève choisi
      $id = $_GET['id'];

      // $eleve récupère la ligne de la table élève correspondante
      $sql = "SELECT * FROM `eleves2` WHERE id_eleve='$id'";
      $result = mysqli_query($conn, $sql);
      $eleve = $result -> fetch_array();

      // On stocke tous les attributs de l'élève dans des variables
      $nom= $eleve['nom'];
      $prenom = $eleve['prenom'];
      $sexe = $eleve['sexe'];
      $email = $eleve['email'];
      $date_naissance = $eleve['date_naissance'];
      $date_inscription = $eleve['date_inscription'];
    ?>

    <!-- Affichage de l'élève -->
    <div class="formulaire" style="height:880px;padding:10px">
      <h3 style="font-size:3.5rem;text-align:center;color: #333;padding:0;margin-left:auto;margin-right:auto;"><?php echo "$prenom $nom";?></h3>
      <?php
        // On affiche une image différente en fonction du sexe
        if ($sexe == 'F') {
          echo "<img src='images/femaleicon.jpg' alt='Male Gender' height='130' width='130' style='position:absolute;margin-left:10.7%;margin-top:-2%;border:3px solid black;border-radius:100%;'>";
          echo '<div style="position:absolute; font-family:'.'Roboto'.', sans-serif; margin-left:11.4%;margin-top:110px;font-size:1rem;color:#333;font-family: '.'Roboto'.', sans-serif;font-weight:normal;">
                    Sexe : Féminin
                  </div>';
        } else {
          echo "<img src='images/maleicon.jpg' alt='Male Gender' height='130' width='130' style='position:absolute;margin-left:10.7%;margin-top:-2%;border:3px solid black;border-radius:100%;'>";
          echo '<div style="position:absolute; font-family:'.'Roboto'.', sans-serif; margin-left:11.4%;margin-top:110px;font-size:1rem;color:#333;font-family: '.'Roboto'.', sans-serif;font-weight:normal;">
                    Sexe : Masculin
                  </div>';
        }
      ?>
      <form style="font-family: 'Roboto', sans-serif;font-size:1.5rem;margin-left:60px; margin-right:60px;">
        <br><br><br><br><br> <label>Informations Générales</label><br><br>
        <!-- Affichage des informations de l'élève -->
        <label style="font-size:1rem;color:#333;font-family: 'Roboto', sans-serif;font-weight:normal;">ID de l'élève : <?php echo "#$id"; ?></label><br>
        <hr class="underrule">
        <label style="font-size:1rem;color:#333;font-family: 'Roboto', sans-serif;font-weight:normal;">Prénom Nom : <?php echo "$prenom $nom"; ?></label><br>
        <hr class="underrule">
        <label style="font-size:1rem;color:#333;font-family: 'Roboto', sans-serif;font-weight:normal;">Date de naissance : <?php echo "$date_naissance"; ?></label><br>
        <hr class="underrule">
        <label style="font-size:1rem;color:#333;font-family: 'Roboto', sans-serif;font-weight:normal;">Adresse email : <?php echo "$email"; ?></label><br>
        <hr class="underrule">
        <label style="font-size:1rem;color:#333;font-family: 'Roboto', sans-serif;font-weight:normal;">Date d'inscription : <?php echo "$date_inscription"; ?></label><br>
        <hr class="underrule">
      </form>

      <!-- Boutons pour consulter les statistiques ou le calendrier de cet élève -->
      <form action="statistiques_eleve2.php" method="post">
        <input type="hidden" name="eleve" value="<?php echo "$id"; mysqli_close($conn);?>">
        <button type="submit" class="button" style="margin-left:15%;padding: 8px 45px;font-size:1rem;">Statistiques</button>
        <button type="submit" class="button" style="margin-left:20px;padding: 8px 45px;font-size:1rem;" formaction="calendrier_eleve2.php">Calendrier</button>
      </form>
    </div><br><br><br><br>

    <a class="button" href="liste_eleves.php" style="padding: 15px 45px;margin-top:120px;margin-left:45.5%;margin-right:auto;">Retour</a>
    <!-- Pied de page -->
    <div class="bottom-container" style="margin-top:200px;">
        <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
        <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
        <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
        <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
    </div>
  </body>
</html>

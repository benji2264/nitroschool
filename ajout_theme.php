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
      $date = date("Y-m-d");
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // Récupération des informations saisies
      $nom = mysqli_escape_string($connect,$_POST['nom_theme']);
      $desc= mysqli_escape_string($connect,$_POST['desc_theme']);

      // $result récupère la liste des thèmes actifs
      $sql = "SELECT * FROM `themes2` WHERE nom='$nom' AND supprime=0";
      $result = mysqli_query($connect, $sql);

      // $result3 récupère la liste des thèmes actifs
      $sql3 = "SELECT * FROM `themes2` WHERE nom='$nom' AND supprime=1";
      $result3 = mysqli_query($connect, $sql3);

      // Si le thème existe déjà et est actif, on renvoie une erreur
      if ($row = $result->fetch_array()){
        echo '
        <div class="formulaire" style="background-color:#ff7770;padding:10px;padding-top:20px;padding-bottom:20px;text-align:center;color:white;font-size:1.25rem;font-weight:bold;font-family:'."Roboto".';">
            CE THEME EXISTE DEJA
        </div>
        ';
        }

        // Si le thème existe déjà mais est inactif, on demande s'il doit être réactivé
        else if($row3 = $result3->fetch_array()) {
        echo '
        <div class="formulaire" style="background-color:#ff7770;padding:10px;padding-top:20px;padding-bottom:20px;text-align:center;color:white;font-size:1.25rem;font-weight:bold;font-family:'."Roboto".';">
            CE THEME A ETE DESACTIVE <br> VOULEZ-VOUS LE REACTIVER ?
            <form method="POST" action="verifier_theme.php">
              <input type="hidden" name="nom" value='."$nom".'>
              <button type="submit" class="buttonsub" style="font-size:1rem;padding:5px 58px;margin:0;margin-top:15px;border:2px solid white";>Réactiver</button>
              <button type="submit" class="buttonsub" style="font-size:1rem;padding:5px 60px;margin:0;margin-top:15px;margin-left:5%;border:2px solid white;" formaction="ajouter_theme.html">Annuler</button>
            </form>
        </div>';
          }
          // Si le thème n'existe pas, on l'ajoute
          else {
      $query = "insert into themes2 values (NULL, '$nom','0', '$desc')"; // Est-ce que cela fonctionne ?
      $result  =  mysqli_query($connect,  $query);
      echo '
      <div class="formulaire" style="background-color:#7ac27e;padding:10px;padding-top:20px;padding-bottom:20px;text-align:center;color:white;font-size:1.25rem;font-weight:bold;font-family:'."Roboto".';">
          THEME AJOUTE AVEC SUCCES
      </div>
      ';}
      mysqli_close($connect);
    ?>
        <!-- Formulaire d'ajout d'un thème -->
        <div class="formulaire" style="margin: 2% 35% 0%;height:720px;padding:10px">
            <div class="inscription" style="  margin-top:1%">
              <img height="70px" style="padding:0px;margin-left:2.75%" src="images/icontheme.png" alt="icon">
              <h3 style="font-size:3.5rem;text-align:center;color: #333;padding-left:95px;">  Ajout Thème</h3>
            </div>
          <form style="font-family:'Roboto';font-size:1.5rem;margin-left:60px; margin-right:60px;" class="" action="ajout_theme.php" method="post">
              <br>
            <label for="nom_theme">Nom du thème</label><br>
            <input type="text" id="nom_theme" name="nom_theme" required max="25" placeholder="Nom du thème"><br>
            <hr class="underrule">
            <label for="desc_theme">Description du thème</label><br>
            <textarea name="desc_theme" rows="6" style="padding:15px;width:93%;resize:none;border:1px solid #858585; border-radius:12px;margin-top:20px;" placeholder="Description..." required></textarea>
            <hr class="underrule">
            <input type="submit" style="margin-top:52px;padding:10px;width:50%;margin-left:24%">
          </form>
        </div>';
        <!-- Pied de page -->
            <div class="bottom-container" style="margin-top:200px;">
              <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
              <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
              <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
              <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
            </div>
          </body>
        </html>

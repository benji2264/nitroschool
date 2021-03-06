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
      // Connexion
      date_default_timezone_set('Europe/Paris');
      $date = date("Y-m-d");
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a001';
      $dbpass = '8kxDVZYm';
      $dbname = 'nf92a001';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      // On récupère les informations saisies
      $nom = mysqli_escape_string($connect,$_POST['nom']);
      $prenom= mysqli_escape_string($connect,$_POST['prenom']);
      $sexe=$_POST['sexe'];
      $email = mysqli_escape_string($connect,$_POST['email']);
      $naissance=$_POST['naissance'];

      // On vérifie si l'élève existe déjà dans la base
      $sql2 = "SELECT * FROM `eleves2` WHERE (nom='$nom') AND (prenom='$prenom')";
      $result2 = mysqli_query($connect, $sql2);
      // S'il existe déjà, on demande confirmation
      if($row2 = $result2->fetch_array()){
        echo '
        <div class="formulaire" style="line-height: 150%;background-color:#ff7770;padding:10px;padding-top:20px;padding-bottom:20px;text-align:center;color:white;font-size:1.25rem;font-weight:bold;font-family:'."Roboto".';">
            CET ELEVE EXISTE DEJA <br>';
          $result2 = mysqli_query($connect, $sql2);
          while ($row2 = $result2->fetch_array()) {
          $id_existant = $row2['id_eleve'];
          $inscription_existant = $row2['date_inscription'];
          $naissance_existant = $row2['date_naissance'];
          $nom_uppercase = strtoupper($nom);
          $prenom_uppercase = strtoupper($prenom);
           echo "#$id_existant $nom_uppercase $prenom_uppercase".'<br>
              NÉ(E) LE '."$naissance_existant".' <br>
              INSCRIT LE '."$inscription_existant <br>";
            } echo '
              <form method="POST" action="verifier_eleve.php">
                <input type="hidden" name="sexe" value='."$sexe".'>
                <input type="hidden" name="nom" value='."$nom".'>
                <input type="hidden" name="prenom" value='."$prenom".'>
                <input type="hidden" name="email" value='."$email".'>
                <input type="hidden" name="naissance" value='."$naissance".'>
                <input type="hidden" name="date" value='."$date".'>
                <button type="submit" class="buttonsub" style="font-size:1rem;padding:5px 10px;margin:0;margin-top:15px;border:2px solid white";>Ajouter quand même</button>
                <button type="submit" class="buttonsub" style="font-size:1rem;padding:5px 60px;margin:0;margin-top:15px;margin-left:5%;border:2px solid white;" formaction="ajouter_eleve2.html">Annuler</button>

              </form>
          </div>';
      } else {
        // S'il n'existe pas, on j'ajoute
        $query = "insert into eleves2 values (NULL, '$nom', '$prenom', '$sexe','$email','$naissance','$date')"; // Est-ce que cela fonctionne ?
        $result  =  mysqli_query($connect,  $query);

        echo '
        <div class="formulaire" style="background-color:#7ac27e;padding:10px;padding-top:20px;padding-bottom:20px;text-align:center;color:white;font-size:1.25rem;font-weight:bold;font-family:'."Roboto".';">
            ELEVE AJOUTE AVEC SUCCES
        </div>
        ';
      }
        mysqli_close($connect);
    ?>
    <!-- Formulaire d'ajout d'un élève -->
    <div class="formulaire" style="margin: 2% 35% 0%;height:880px;padding:10px">
        <div class="inscription" style="  margin-top:1%">
            <img height="70px" style="padding:0px;margin-left:2.7%" src="images/character.png" alt="icon">
          <h3 style="font-size:3.5rem;text-align:center;color: #333"> Ajout Elève</h3>
        </div>
      <form style="  font-family: 'Roboto', sans-serif;font-size:1.5rem;margin-left:60px; margin-right:60px;" class="" action="ajout_eleve.php" method="post">
        <!-- Choix du sexe avec des radio boutons-->
        <div class="sexe">
          <label class="container" style="padding-right:35px;">Homme
            <input type="radio" checked="checked" name="sexe" value="H">
            <span class="checkmark"></span>
          </label>
          <label class="container">Femme
            <input type="radio" name="sexe" value="F">
            <span class="checkmark"></span>
          </label>
        </div><br>
        <!-- Nom, prénom adresse mail, date de naissance -->
        <label for="nom">Nom de l'élève</label><br>
        <input type="text" id="nom" name="nom" required minlength="1" placeholder="Nom de l'élève"><br>
        <hr class="underrule">
        <label for="prenom">Prénom de l'élève</label><br>
        <input type="text" id="prenom" name="prenom" required minlength="1" placeholder="Prénom de l'élève"><br>
        <hr class="underrule">
        <label for="naissance">Date de naissance</label><br>
        <input max="2004-12-01" type="date" id="naissance" name="naissance"><br>
        <hr class="underrule">
        <label for="email">Adresse Mail</label><br>
        <input type="email" id="email" name="email" required minlength="1" placeholder="exemple@email.fr"><br>
        <hr class="underrule">
        <input type="submit" style="margin-top:52px;padding:10px;width:50%;margin-left:24%">
      </form>
      </div>
      <!-- Pied de page -->
          <div class="bottom-container" style="margin-top:200px;">
            <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
            <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
            <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
            <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
          </div>
        </body>
      </html>

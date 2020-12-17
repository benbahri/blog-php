<!doctype html>
<?php require_once("connect.php"); ?>
<html>
<head>
  <meta charset="UTF­8">
  <title>EUROBuvettes</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <section name="header" class="header">
    <div id="banner" class="banner">
      <img class="logo" href="img/logo.jpg"  />
      <div>
        <span class="title">EUROBuvettes</span>
        <span class="subtitle">Le site de gestion des buvettes de l'EURO 2018</span>
      </div>
    </div>
    <div id="menu" class="menu">
      <ul>
        <li><a href="accueil.php">Nouveauté</a></li>
        <li><a href="statistiques.php">Statistiques</a></li>
        <li><a href="recherchemembres.php">Recherche Membres</a></li>
        <li><a href="affectations.php">Affectations</a></li>
        <li><a href="prive.php">Administrateur</a></li>
      </ul>
    </div>

  </section>
  <section name="container" class="container">
    <?php
      $req = "SELECT m.idM as mid, m.date, m.scoreA, m.scoreB, a.pays as paysA, a.drapeau as drapeauA, b.pays as paysB, b.drapeau as drapeauB, COUNT(*) AS b_ouverte
              FROM `Match` m, `Equipe` a, `Equipe` b, `Est_ouverte` eo
              WHERE m.eqA = a.idE
              AND m.eqB = b.idE
              AND m.idM = eo.idM
              GROUP BY m.idM
              ";

              $result = mysqli_query($idConnexion , $req);
    ?>
    <table border="1" width="80%" align = "center ">
      <tbody>
        <th>Date du Match</th>
        <th>Equipe A</th>
        <th>Equipe B</th>
        <th>Score</th>
        <th>Buvettes Ouvertes</th>
        <th>Volontaires</th>
      </tbody>
    <?php
    //this is a comment
      while ($row = mysqli_fetch_array($result)){
        $requete_nbV = "SELECT COUNT(*)
                        FROM `Match` m, `Est_present` ep
                        WHERE m.idM = ep.idM
                        AND m.idM =". $row['mid'] ;
        $res = mysqli_query($idConnexion, $requete_nbV);
        $nbV = mysqli_fetch_array($res);

        echo "
          <tr>
            <td>".
              $row['date'].
            "</td>
            <td><img src=\"".$row['drapeauA']."\" alt=\"".$row['paysA']."\" height=\"50px\"/></td>
            <td><img src=\"".$row['drapeauB']."\" alt=\"".$row['paysB']."\" height=\"50px\"/></td>
            <td>".$row['scoreA']." - " .$row['scoreB']."</td>
            <td>".$row['b_ouverte']."</td>
            <td>".$nbV[0]."</td>
          </tr>
        ";
      }
    ?>
    </table>
  </section>
  <section name="footer" class="footer">
    <div>
      Pied de page
    </div>
  </section>

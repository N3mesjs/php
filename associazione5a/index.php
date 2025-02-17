<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once "navbar.php" ?>
    <?php require_once "sqlCon.php" ?>
    <div class="d-flex grid gap-3">
    <?php
        $sqlAtt = "SELECT * FROM attivita";
        $sqlAnim = "SELECT persone.Nome, persone.Cognome, attivita.idatt FROM ((anima INNER JOIN attivita ON anima.Estidatt = attivita.idatt) INNER JOIN persone ON anima.idanim = persone.id)";

        $prepAtt = $conn->prepare($sqlAtt);
        $prepAtt->execute();
        $resultAtt = $prepAtt->fetchAll();

        $prepAnim = $conn->prepare($sqlAnim);
        $prepAnim->execute();
        $resultAnim = $prepAnim->fetchAll();

        foreach ($resultAtt as $row) {
            echo "<div class='card' style='width: 18rem;'>
            <div class='card-body'>
              <h5 class='card-title'>".$row["NomeAtt"]."</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>";

            foreach($resultAnim as $rowAnim){
                if($row["idatt"] == $rowAnim["idatt"]){
                    echo $rowAnim["Nome"]." ".$rowAnim["Cognome"]." ";
                }
              }
            echo "</h6>
              <p class='card-text'>".$row["Descrizione"]."</p>
              <a href='page.php?idatt='".$row["idatt"]."''><button type='button' class='btn btn-dark'>Informazioni</button></a>
            </div>
          </div>";
        }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
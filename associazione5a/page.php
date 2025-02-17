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

<div class="container d-flex flex-column align-items-center">
<?php 
    $sql = "SELECT * FROM attivita WHERE idatt='".$_GET["idatt"]."'";
    $prep = $conn->prepare($sql);
    $prep->execute();
    $result = $prep->fetchAll();
    foreach( $result as $row ) {
        echo "<h1 class='text-center'>".$row["NomeAtt"]."</h1>";
        echo "<div class='container text-center'>".$row["Descrizione"]."</div>";
    }
?>

<div class="mt-5">
        <?php echo "<a href='editPage.php?idatt=".$_GET["idatt"]."'><button type='button' class='btn btn-dark'>Modifica</button></a>" ?>
    </div>
</div>

</body>
</html>
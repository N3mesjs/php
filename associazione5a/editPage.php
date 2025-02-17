<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifica Attività</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once "navbar.php" ?>
    <?php require_once "sqlCon.php" ?>

    <div class="container mt-5">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idatt = $_POST["idatt"];
                $nomeAtt = $_POST["NomeAtt"];
                $descrizione = $_POST["Descrizione"];

                $sql = "UPDATE attivita SET NomeAtt = :NomeAtt, Descrizione = :Descrizione WHERE idatt = :idatt";
                $prep = $conn->prepare($sql);
                $prep->bindParam(':NomeAtt', $nomeAtt);
                $prep->bindParam(':Descrizione', $descrizione);
                $prep->bindParam(':idatt', $idatt);
                $prep->execute();

                header("Location: index.php");
                exit();
            }

            $idatt = $_GET["idatt"];
            $sql = "SELECT * FROM attivita WHERE idatt = :idatt";
            $prep = $conn->prepare($sql);
            $prep->bindParam(':idatt', $idatt);
            $prep->execute();
            $result = $prep->fetch(PDO::FETCH_ASSOC);
        ?>

        <h1 class="text-center">Modifica Attività</h1>
        <form method="post" action="editPage.php">
            <input type="hidden" name="idatt" value="<?php echo $result['idatt']; ?>">
            <div class="mb-3">
                <label for="NomeAtt" class="form-label">Nome Attività</label>
                <input type="text" class="form-control" id="NomeAtt" name="NomeAtt" value="<?php echo $result['NomeAtt']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Descrizione" class="form-label">Descrizione</label>
                <textarea class="form-control" id="Descrizione" name="Descrizione" rows="3" maxlength="60" required><?php echo $result['Descrizione']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Salva Modifiche</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
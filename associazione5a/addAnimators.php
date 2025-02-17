<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aggiungi Animatori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require_once "navbar.php" ?>
    <?php require_once "sqlCon.php" ?>

    <div class="container mt-5">
        <h1 class="text-center">Assegna Animatori alle Attività</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $estidpers = $_POST["Estidpers"];
                $estidatt = $_POST["Estidatt"];
                $note = $_POST["note"];

                $sql = "INSERT INTO anima (Estidpers, Estidatt, note) VALUES (:Estidpers, :Estidatt, :note)";
                $prep = $conn->prepare($sql);
                $prep->bindParam(':Estidpers', $estidpers);
                $prep->bindParam(':Estidatt', $estidatt);
                $prep->bindParam(':note', $note);
                $prep->execute();

                echo "<div class='alert alert-success' role='alert'>Animatore assegnato con successo!</div>";
            }

            $sqlPers = "SELECT id, Nome, Cognome FROM persone";
            $prepPers = $conn->prepare($sqlPers);
            $prepPers->execute();
            $resultPers = $prepPers->fetchAll(PDO::FETCH_ASSOC);

            $sqlAtt = "SELECT idatt, NomeAtt FROM attivita";
            $prepAtt = $conn->prepare($sqlAtt);
            $prepAtt->execute();
            $resultAtt = $prepAtt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <form method="post" action="addAnimators.php">
            <div class="mb-3">
                <label for="Estidpers" class="form-label">Animatore</label>
                <select class="form-select" id="Estidpers" name="Estidpers" required>
                    <option value="" selected disabled>Seleziona un animatore</option>
                    <?php
                        foreach ($resultPers as $row) {
                            echo "<option value='".$row['id']."'>".$row['Nome']." ".$row['Cognome']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Estidatt" class="form-label">Attività</label>
                <select class="form-select" id="Estidatt" name="Estidatt" required>
                    <option value="" selected disabled>Seleziona un'attività</option>
                    <?php
                        foreach ($resultAtt as $row) {
                            echo "<option value='".$row['idatt']."'>".$row['NomeAtt']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Assegna Animatore</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
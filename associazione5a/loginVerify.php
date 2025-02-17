<?php 
    session_start();
?>

<?php require_once "sqlCon.php"?>
<?php 

    $_SESSION = $_POST;

    $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    $_SESSION["authenticated"] = false;
    $_SESSION["isAdmin"] = false;

    try {
        $sql = "SELECT * FROM utenti WHERE user=:user AND password=:pass";
        $prep = $conn->prepare($sql);
        $prep->bindParam(':user', $user);
        $prep->bindParam(':pass', $pass);
        $prep->execute();
        $result = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            if($row["user"] == $user && $row["password"] == $pass){
                $_SESSION["authenticated"] = true;
                if($row["livello"] == 0) $_SESSION["isAdmin"] = true;
                header("Location: index.php");
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
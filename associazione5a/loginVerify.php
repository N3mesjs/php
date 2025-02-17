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

    $sql = "SELECT FROM utenti WHERE user='".$user."' && password='".$pass."'";
    $prep = $conn->prepare($sql);
    $prep->execute();
    $result = $prep->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        if($row["user"] == $user && $row["password"] == $pass){
            $_SESSION["authenticated"] = true;
            if($row["livello"] == 0) $_SESSION["isAdmin"] == true;
            header("Location: index.php");
        }
    }
?>
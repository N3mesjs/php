<?php 
    session_start();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4 d-flex justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Associazioni</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <?php 
                    if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true) {
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='addAnimators.php'>Aggiungi Animatori</a>
                              </li>";
                    }
                ?>
            </ul>
        </div>
    </div>
    <div>
        <?php 
            echo isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true ? "<a href='logout.php'><button type='button' class='navbar-brand btn btn-danger text-white'>Logout</button></a>" : "<a href='login.php'><button type='button' class='navbar-brand btn btn-dark text-white'>Accedi</button></a>";
        ?>
    </div>
</nav>
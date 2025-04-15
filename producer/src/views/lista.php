<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<?php
session_start();
use Database\Gateway\UserGateway;
use Components\Alert;
try {
    $alert = new Alert;
    $conn = new PDO('sqlite:../database/database.db');
    UserGateway::setConnection($conn);
    $users = UserGateway::all();

} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <?php
                if (isset($_SESSION['id'])) {
                    echo "<span class='fs-4'>Olá " . $user->nome  . "</span>";
                } else {
                    echo "<span class='fs-4'>Faça login para ver suas informações</span";
                }
                ?>
            </a>
            <ul class="nav nav-pills">
                <!-- <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li> -->
                <!-- <li class="nav-item"><a href="#" class="nav-link">Features</a></li> -->
                <!-- <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li> -->
                <?php
                if (isset($_SESSION['id'])) {
                    echo "
                        <li class='nav-item'>
                            <a href='../services/processar_logout.php' class='nav-link'>
                                Logoff <i class='bi bi-box-arrow-in-right'></i>
                            </a>
                        </li>
                        <li class='nav-item'>
                            <a href='./login.php' class='nav-link'>
                                Apagar conta<i class='bi bi-trash-fill'></i>
                            </a>
                        </li>";
                }
                ?>
                <li class="nav-item">
                    <a href="./index.php" class="nav-link">
                        Cadastro
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./login.php" class="nav-link">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./lista.php" class="nav-link">
                        Lista de usuários
                    </a>
                </li>
            </ul>
        </header>
        <?php
        if (isset($_SESSION['message'])) {
            // echo "<div class='alert alert-success'> {$_SESSION['message']} </div>";
            $alert->success($_SESSION['message']);
            unset($_SESSION['message']);
        }
        ?>
        <div class="container">
            <h2 class="fs-3">Lista de usuários cadastrados </h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <!-- <th scope="col">Handle</th> -->
                    </tr>
                </thead>
                <tbody>
        
                    <?php
                    if ($users) {
                        foreach ($users as $user) {
                            echo "
                            <tr>
                                <th scope='row'>{$user->id}</th>
                                <td>{$user->nome}</td>
                                <td>{$user->email}</td>
                            </tr>";
                        }
                    }else{
                        echo "<p class='alert alert-warning w-75 mx-auto'>Sem usuários para visualizar</p>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../assets/js/showPassword.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>
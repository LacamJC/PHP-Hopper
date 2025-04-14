<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<?php
session_start();
require_once '../classes/events/Alert.php';
$alert = new Alert
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
        <form class="container" method="POST" action="../services/processar_login.php">
            <h1 class="fs3">Faça Login</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="joao@gmail.com" ;
                    required
                    onfocus>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input
                    type="password"
                    class="form-control"
                    id="senha"
                    name="senha"
                    required
                    minlength="6"
                    value="123456"
                    maxlength="12">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="show">
                <label class="form-check-label" for="show">Mostrar senha</label>
            </div>
            <div class="mb-3">
                <p class="fw-light">Não possui uma conta ? <a href="./index.php" class="link">Cadastre-se aqui</a></p>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
        <?php
        if (isset($_SESSION['errorMessage'])) {
            $alert->warning($_SESSION['errorMessage']);
            unset($_SESSION['errorMessage']);
        }
        ?>
    </div>
    <script src="../assets/js/showPassword.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>
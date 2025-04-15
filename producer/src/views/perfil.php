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

if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $alert = new Alert;
    $conn = new PDO('sqlite:../database/database.db');
    UserGateway::setConnection($conn);
    $user = UserGateway::find($_SESSION['id']);
} else {
    header('Location:./index.php');
}

?>

<body>
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

    <form class="container" method="POST" action="../services/processar_update.php">
        <h1 class="fs-3">Suas informações</h1>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome de usuário</label>
            <input
                type="text"
                class="form-control"
                id="nome_usuario"
                name="nome_usuario"

                value="<?php echo $user->nome ?>" ;>

        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input
                type="text"
                class="form-control"
                id="email"
                name="email"

                value="<?php echo $user->email ?>" ;>

        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input
                type="password"
                class="form-control disabled    "
                id="senha"
                name="senha"
                readonly
                value="<?php echo $user->senha ?>" ;>

        </div>



        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="show">
            <label class="form-check-label" for="show">Mostrar senha</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="alterData">
            <label class="form-check-label" for="alterData">Permitir alteração dos dados</label>
        </div>
        <button type="submit" class="btn btn-danger" id="btnSubmit">Cadastrar</button>
    </form>
    <script>
        const alterData = document.getElementById('alterData');;
        const btnSubmit = document.getElementById('btnSubmit');
        const inputs = [document.getElementById('nome_usuario'), document.getElementById('senha'), document.getElementById('email')];
        addEventListener('DOMContentLoaded', () => {
            console.log('campos desabilitados');
            inputs.forEach((input) => {
                input.disabled = true
            });

        })
        alterData.addEventListener('click', () => {
            console.log('click');
            console.log(inputs);
            if (alterData.checked) {
                console.log('campos habilidatos');
                inputs.forEach((input) => {
                    input.disabled = false
                    btnSubmit.classList.remove('btn-danger');
                    btnSubmit.classList.add('btn-primary');
                });
            } else {
                console.log('campos desabilitados');

                inputs.forEach((input) => {
                    input.disabled = true
                    btnSubmit.classList.add('btn-danger');
                    btnSubmit.classList.remove('btn-primary');
                });
            }
        })
    </script>
    <script src="../assets/js/showPassword.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>
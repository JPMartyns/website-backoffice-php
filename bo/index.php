<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
 
$formUser = $formPassword = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formUser = $_POST['user'];
    $formPassword = $_POST['password'];
    $formPassword = md5($formPassword);
    $isFormOk = true;
 
    require_once "config.php";
 
    $sql = "SELECT * FROM users WHERE username = '$formUser' AND password = '$formPassword'";
 
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Login bem-sucedido
        $_SESSION['user'] = $formUser;
    } else {
        $isFormOk = false;
    }
}
 
include "header.php";
?>


<section class="container">
    <div class="row">
        <div class="col">

            <h1>HOMEPAGE DO BACKOFFICE</h1>
            <h4>Bem-vindo ao Back Office do João Martins Photography!</h4>

        </div>
    </div>

    <?php if (isset($_SESSION['user'])) { ?>
 
    <div class="alert alert-success" role="alert">
        Você está logado como <?= $_SESSION['user'] ?>
    </div>

    <br>
    <div class="row">
        <div class="col">
            <a href="<?=BASE_ADMIN_URL?>redes.php" class="btn btn-secondary">Adicionar Rede Social</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="<?=BASE_ADMIN_URL?>item_menu.php" class="btn btn-secondary">Adicionar Item Menu</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="<?=BASE_ADMIN_URL?>galeria.php" class="btn btn-secondary">Galeria</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="<?=BASE_ADMIN_URL?>form-checker.php" class="btn btn-secondary">Formulário</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="<?= BASE_URL ?>" target="_blank" class="btn btn-secondary">Site Oficial</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="<?= BASE_ADMIN_URL ?>logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>

    <?php } else { ?>

    <div class="row">
        <div class="col">
            <h2>LOGIN</h2>
            <p>Por favor, preencha as credenciais de acesso</p>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input class="my-2" type="text" name="user" placeholder="Utilizador..." require>
                <input type="password" name="password" placeholder="Password..." require>
                <button type="submit" class="btn btn-secondary my-2">Entrar</button>
            </form>
        </div>
    </div>

    <?php } ?>

</section>

<?php
include "footer.php";
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ... require_once "Layouts/header.php";
require_once "Layouts/header.php";
require_once "Layouts/nav.php";
if (isset($_SESSION['type_user_invalid'])) {
    $tipe_user_invalid = $_SESSION['type_user_invalid'];
    unset($_SESSION['type_user_invalid']);
}
if (isset($_SESSION['not_exist_especiality'])) {
    $not_exist_especiality = $_SESSION['not_exist_especiality'];
    unset($_SESSION['not_exist_especiality']);
}
if (isset($_SESSION['success_cad_speciality'])) {
    $success_cad_speciality = $_SESSION['success_cad_speciality'];
    unset($_SESSION['success_cad_speciality']);
}
?>


<div class="container">

    <!-- bloco preventivo para evitar que clientes cadastrem especialidades -->
    <?php if (isset($tipe_user_invalid)): ?>
        <div class="alert alert-danger mt-5">
            <?= $tipe_user_invalid ?>
        </div>
    <?php endif; ?>
    <!-- bloco preventivo para previnir busca de especialidades inexistentes -->
    <?php if (isset($not_exist_especiality)): ?>
        <div class="alert alert-danger mt-5">
            <?= $not_exist_especiality ?>
        </div>
    <?php endif; ?>
    <!-- menssagem de sucesso ao cadastrar uma nova especialidade -->
    <?php if (isset($success_cad_speciality)): ?>
        <div class="alert alert-success mt-5">
            <?= $success_cad_speciality ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="banho" name="especialidade">
                <input type="submit" class="btm btn-info form-control" value="Banho">
            </form>
        </div>

        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="curativo" name="especialidade" class="btm btn-info">
                <input type="submit" class="btm btn-success form-control" value="Curativo">
            </form>
        </div>

        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="diaria" name="especialidade">
                <input type="submit" class="btm btn-primary form-control" value="Diária">
            </form>
        </div>

        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="pernoite" name="especialidade" class="btm btn-info">
                <input type="submit" class="btm btn-secondary form-control" value="Pernoite">
            </form>
        </div>

    </div>

    <!-- <script>
        // função para as menssagens com alert sumam

        // trecho para esperar o DOM carregar
        document.addEventListener("DOMContentLoaded", () => {
            // Seleciona todos os elementos com a classe alert
            const alerts = document.querySelectorAll(".alert");

            // Define um tempo (3 segundos = 3000ms)
            setTimeout(() => {
                alerts.forEach(alert => {
                    // Adiciona uma transição suave antes de sumir
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";

                    // Remove do DOM depois que a transição termina
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                });
            }, 3000);
        });
    </script> -->

    <?php
    require_once "Layouts/footer.php";
    ?>
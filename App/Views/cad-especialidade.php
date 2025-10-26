<?php

use App\Controllers\GetAllSpecialitysController;

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
if (isset($_SESSION['success_add_speciality'])) {
    $success_add_speciality = $_SESSION['success_add_speciality'];
    unset($_SESSION['success_add_speciality']);
}
if (isset($_SESSION['check_if_exists_specialitys'])) {
    $check_if_exists_specialitys = $_SESSION['check_if_exists_specialitys'];
    unset($_SESSION['check_if_exists_specialitys']);
}


$id_cuidador = $_SESSION['user']['id_cuidador'];
if ($id_cuidador) {
    GetAllSpecialitysController::get_all_specialitys($id_cuidador);
}

$especialidades = $_SESSION['all_specialitys'];

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
    <?php if (isset($success_add_speciality)): ?>
        <div class="alert alert-success mt-5">
            <?= $success_add_speciality ?>
        </div>
    <?php endif; ?>

    <!-- se o cuidador tentar cadastrar uma especialidade ja cadastrada -->
     <?php if (isset($check_if_exists_specialitys)): ?>
        <div class="alert alert-danger mt-5">
            <?= $check_if_exists_specialitys ?>
        </div>
    <?php endif; ?>



    <h2 class="mt-4 mb-3">Minhas Especialidades</h2>

    <?php if (!empty($especialidades)): ?>
        <ul class="list-group mb-4">
            <?php foreach ($especialidades as $esp): ?>
                <li class="list-group-item">
                    <?= htmlspecialchars($esp['nome_especialidade']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info">Nenhuma especialidade cadastrada ainda.</div>
    <?php endif; ?>

    <hr>

    <h4>Adicionar nova especialidade:</h4>

    <div class="row">
        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="banho" name="especialidade">
                <input type="submit" class="btn btn-info form-control" value="Banho">
            </form>
        </div>

        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="curativo" name="especialidade">
                <input type="submit" class="btn btn-success form-control" value="Curativo">
            </form>
        </div>

        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="diaria" name="especialidade">
                <input type="submit" class="btn btn-primary form-control" value="Diária">
            </form>
        </div>

        <div class="col-3">
            <form action="/projeto_PI/cad-especialidade-submit" method="post">
                <input type="hidden" value="pernoite" name="especialidade">
                <input type="submit" class="btn btn-secondary form-control" value="Pernoite">
            </form>
        </div>
    </div>

    
</div>













<script>
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
</script>

<?php
require_once "Layouts/footer.php";
?>
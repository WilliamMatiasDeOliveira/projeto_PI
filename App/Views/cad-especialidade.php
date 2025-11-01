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

<section class="dashboard-cuidador-container flexdashboard">

    <div class="sidebar-dashboard">

        <div class="sidebar-topo">
            <div class="sidebar-header">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M88 289.6L64.4 360.2L64.4 160C64.4 124.7 93.1 96 128.4 96L267.1 96C280.9 96 294.4 100.5 305.5 108.8L343.9 137.6C349.4 141.8 356.2 144 363.1 144L480.4 144C515.7 144 544.4 172.7 544.4 208L544.4 224L179 224C137.7 224 101 250.4 87.9 289.6zM509.8 512L131 512C98.2 512 75.1 479.9 85.5 448.8L133.5 304.8C140 285.2 158.4 272 179 272L557.8 272C590.6 272 613.7 304.1 603.3 335.2L555.3 479.2C548.8 498.8 530.4 512 509.8 512z"
                        fill="currentColor" />
                </svg>
                <h3>Dashboard</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="/projeto_PI/dashboard-cuidador"> <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M463 448.2C440.9 409.8 399.4 384 352 384L288 384C240.6 384 199.1 409.8 177 448.2C212.2 487.4 263.2 512 320 512C376.8 512 427.8 487.3 463 448.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 336C359.8 336 392 303.8 392 264C392 224.2 359.8 192 320 192C280.2 192 248 224.2 248 264C248 303.8 280.2 336 320 336z"
                                fill="currentColor" />
                        </svg> Perfil</a>
                </li>
                <li>
                    <a href="/projeto_PI/cad-especialidade
                        "><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                                fill="currentColor" />
                        </svg> Cadastrar Especialidade </a>
                </li>
                <li>
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM288 224C288 206.3 302.3 192 320 192C337.7 192 352 206.3 352 224C352 241.7 337.7 256 320 256C302.3 256 288 241.7 288 224zM280 288L328 288C341.3 288 352 298.7 352 312L352 400L360 400C373.3 400 384 410.7 384 424C384 437.3 373.3 448 360 448L280 448C266.7 448 256 437.3 256 424C256 410.7 266.7 400 280 400L304 400L304 336L280 336C266.7 336 256 325.3 256 312C256 298.7 266.7 288 280 288z"
                                fill="currentColor" />
                        </svg> Estatisticas</a>
                </li>
                <li>
                    <a href=""> <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M128 128C128 92.7 156.7 64 192 64L341.5 64C358.5 64 374.8 70.7 386.8 82.7L493.3 189.3C505.3 201.3 512 217.6 512 234.6L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM336 122.5L336 216C336 229.3 346.7 240 360 240L453.5 240L336 122.5zM248 320C234.7 320 224 330.7 224 344C224 357.3 234.7 368 248 368L392 368C405.3 368 416 357.3 416 344C416 330.7 405.3 320 392 320L248 320zM248 416C234.7 416 224 426.7 224 440C224 453.3 234.7 464 248 464L392 464C405.3 464 416 453.3 416 440C416 426.7 405.3 416 392 416L248 416z"
                                fill="currentColor" />
                        </svg> Histórico</a>
                </li>
                <li>
                    <a href="/projeto_PI/logout
                        "><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                                fill="currentColor" />
                        </svg> Avaliações</a>
                </li>
                <li>
                    <a href="/projeto_PI/logout
                        "><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                                fill="currentColor" />
                        </svg> Agenda</a>
                </li>
                <li>
                    <a href="/projeto_PI/logout
                        "><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                                fill="currentColor" />
                        </svg> Sair</a>
                </li>
            </ul>
        </div>
        <div class="sidebar-baixo">
            <a class="sidebar-perfil">
                <?php if ($user['foto'] === null): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-person-square mx-auto mt-1" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    </svg>
                <?php else: ?>
                    <img src="assets/imgs/cuidadores/<?= $user['foto'] ?>">
                <?php endif; ?>
                <div class="sidebar-nome">
                    <p><?= $user['nome'] ?></p>
                </div>
            </a>
        </div>
    </div>


    <!-- /////////////////////////////////////////////////////////////// -->
    <!-- /////////////////////////////////////////////////////////////// -->


    <div class="container">

        <!-- bloco preventivo para evitar que clientes cadastrem especialidades -->
        <?php if (isset($tipe_user_invalid)): ?>
            <div class="alert alert-danger mt-1">
                <?= $tipe_user_invalid ?>
            </div>
        <?php endif; ?>

        <!-- bloco preventivo para previnir busca de especialidades inexistentes -->
        <?php if (isset($not_exist_especiality)): ?>
            <div class="alert alert-danger mt-1">
                <?= $not_exist_especiality ?>
            </div>
        <?php endif; ?>

        <!-- menssagem de sucesso ao cadastrar uma nova especialidade -->
        <?php if (isset($success_add_speciality)): ?>
            <div class="alert alert-success mt-1">
                <?= $success_add_speciality ?>
            </div>
        <?php endif; ?>

        <!-- se o cuidador tentar cadastrar uma especialidade ja cadastrada -->
        <?php if (isset($check_if_exists_specialitys)): ?>
            <div class="alert alert-danger mt-1">
                <?= $check_if_exists_specialitys ?>
            </div>
        <?php endif; ?>

        <div class="especialidade-container">
            <div class="especialidade-text">
                <h2>Especialidades cadastradas:</h2>
                <p>Gerencie as áreas em que você atua como cuidador.</p>
            </div>

            <div class="especialidade-scroll">
                <div class="especialidade-list">
                    <?php if (!empty($especialidades)): ?>
                        <?php foreach ($especialidades as $esp): ?>
                            <button class="item-especialidade">
                                <div class="especialidade-remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                                <div class="especialidade-nome">
                                    <?= htmlspecialchars($esp['nome_especialidade']) ?>
                                </div>
                            </button>
                        <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="alert alert-info">Nenhuma especialidade cadastrada ainda.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="especialidade-container">
            <div class="especialidade-text">
                <h2>Adicionar nova especialidade:</h2>
                <p>Selecione uma especialidade para adicionar ao seu perfil de cuidador.</p>
            </div>

            <div class="especialidade-adicionar">
                <div class="especialidade-group-text">
                    <p>Cuidados pessoais</p>
                </div>
                <div class="especialidade-scroll-horizontal">
                    <div class="especialidade-group">
                        <form action="/projeto_PI/cad-especialidade-submit" method="post">
                            <input type="hidden" name="especialidade" value="banho">
                            <button type="submit">Banho</button>
                        </form>
                    </div>
                </div>

                <div class="especialidade-group-text">
                    <p>Cuidados de Saúde</p>
                </div>
                <div class="especialidade-scroll-horizontal">
                    <div class="especialidade-group">
                        <form action="/projeto_PI/cad-especialidade-submit" method="post">
                            <input type="hidden" value="curativo" name="especialidade">
                            <button type="submit" value="Curativo">Curativo</button>
                        </form>
                    </div>
                </div>

                <div class="especialidade-group-text">
                    <p>Rotina e Acompanhamento</p>
                </div>
                <div class="especialidade-scroll-horizontal">
                    <div class="especialidade-group">
                        <form action="/projeto_PI/cad-especialidade-submit" method="post">
                            <input type="hidden" value="diaria" name="especialidade">
                            <button type="submit" value="Diária">Diária</button>
                        </form>
                        <form action="/projeto_PI/cad-especialidade-submit" method="post">
                            <input type="hidden" value="pernoite" name="especialidade">
                            <button type="submit" value="Pernoite">Pernoite</button>
                        </form>
                    </div>
                </div>

                <div class="especialidade-group-text">
                    <p>Apoio Emocional e Social</p>
                </div>
                <div class="especialidade-scroll-horizontal">
                    <div class="especialidade-group">
                    </div>
                </div>

                <div class="especialidade-group-text">
                    <p>Tarefas Domésticas</p>
                </div>
                <div class="especialidade-scroll-horizontal">
                    <div class="especialidade-group">
                    </div>
                </div>
            </div>

        </div>
</section>

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

    document.getElementById('add-espec-form').addEventListener('submit', function(e) {
        const select = document.getElementById('nova-especialidade');
        const value = select.value.trim();
        if (!value) {
            e.preventDefault();
            alert('Selecione uma especialidade antes de adicionar.');
            return;
        }
        document.getElementById('especialidade-hidden').value = value;
    });
</script>

<?php
require_once "Layouts/footer.php";
?>
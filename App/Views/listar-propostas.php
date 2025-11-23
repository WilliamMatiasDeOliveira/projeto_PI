<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

// array contendo todos od dados vindo da tabela servicos
if (isset($_SESSION['propostas'])) {
    $propostas = $_SESSION['propostas'];
    // unset($_SESSION['propostas']);

    // echo "<pre>";
    // print_r($propostas);
}

// array de nomes buscados pelo cliente_id
if (isset($_SESSION['nomes'])) {
    $nomes = $_SESSION['nomes'];
    // unset($_SESSION['nomes']);
}

// se ocorreu um erro no aceite ou recusa da proposta
if (isset($_SESSION['erro_envio_resposta'])) {
    $erro_envio_resposta = $_SESSION['erro_envio_resposta'];
    unset($_SESSION['erro_envio_resposta']);
}


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
        <!-- ///////////////////////////////////////////////////////////////// -->
        <div class="sidebar-baixo d-block align-items-center">

            <a class="sidebar-perfil">
                <?php if (empty($user['foto'])): ?>
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

            <a href="/projeto_PI/delete" class="justify-content-center bg-danger text-white p-2 align-items-center"
                data-bs-toggle="modal" data-bs-target="#modalExcluirConta">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-trash me-2" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1z" />
                </svg>

                Excluir conta
            </a>
        </div>
        <!-- /////////////////////////////////////////////////////////////////// -->
    </div>

    <section class="propostas-container">
        <h2 class="mb-4">Propostas Recebidas</h2>

        <?php if (isset($erro_envio_resposta)): ?>
            <div class="alert alert-secondary">
                <?= $erro_envio_resposta ?>
            </div>
        <?php endif; ?>



        <div class="propostas-content">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Data do envio</th>
                        <th>Valor da proposta</th>
                        <th>Cliente</th>
                        <th>Descrição do serviço</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($propostas as $index => $proposta): ?>
                        <tr>
                            <td><?= htmlspecialchars($proposta['data_inicio']) ?></td>
                            <td>R$ <?= number_format($proposta['valor_proposta'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($nomes[$index]['nome']) ?></td>
                            <td><?= htmlspecialchars($proposta['descricao_paciente']) ?></td>
                            <td>
                                <?= htmlspecialchars($proposta['estatus']) ?>
                            </td>
                            <td>
                                <!-- Formulário para aceitar -->
                                <form method="post" action="/projeto_PI/aceitar-recusar" style="display:inline-block;">
                                    <input type="hidden" name="id_proposta" value="<?= $proposta['id_servico'] ?>">
                                    <input type="hidden" name="cliente_id" value="<?= $proposta['cliente_id'] ?>">
                                    <input type="hidden" name="acao" value="aceitar">
                                    <button type="submit" class="btn btn-success btn-sm" title="Aceitar">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                </form>
                                <!-- Formulário para recusar -->
                                <form method="post" action="/projeto_PI/aceitar-recusar" style="display:inline-block;">
                                    <input type="hidden" name="id_proposta" value="<?= $proposta['id_servico'] ?>">
                                    <input type="hidden" name="cliente_id" value="<?= $proposta['cliente_id'] ?>">
                                    <input type="hidden" name="acao" value="recusar">
                                    <button type="submit" class="btn btn-danger btn-sm" title="Recusar">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
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
</script>



<?php
require_once "Layouts/footer.php";
?>
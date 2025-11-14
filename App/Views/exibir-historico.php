<?php

declare(strict_types=1);

use App\DAO\AdicionarAvaliacaoDAO;
use App\DAO\CarregarCuidadoOuClienterDAO;

require_once "Layouts/header.php";
require_once "Layouts/nav.php";

$res = $_SESSION['res'] ?? [];

if (isset($_SESSION['Usuario_ja_avaliado'])) {
    $usuario_ja_avaliado = $_SESSION['Usuario_ja_avaliado'];
    unset($_SESSION['Usuario_ja_avaliado']);
}

if (isset($_SESSION['Usuario_avaliado_com_sucesso'])) {
    $usuario_avaliado_com_sucesso = $_SESSION['Usuario_avaliado_com_sucesso'];
    unset($_SESSION['Usuario_avaliado_com_sucesso']);
}



?>

<div class="container mt-4">
    <h3 class="mb-4 text-center">Histórico de Serviços</h3>

    <!-- >>>> CONDICIONAIS PARA EVITAR MULTIPLAS AVALIAÇÕES <<<< -->

    <!-- Caso o cuidador já tenha sido avaliado pelo cliente -->
    <?php if (isset($usuario_ja_avaliado)): ?>
        <div class="alert alert-danger">
            <?= $usuario_ja_avaliado ?>
        </div>
    <?php endif; ?>
    <!-- Caso o cuidador ainda não tenha sido avaliado pelo cliente  -->
    <?php if (isset($usuario_avaliado_com_sucesso)): ?>
        <div class="alert alert-success">
            <?= $usuario_avaliado_com_sucesso ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($res)): ?>
        <table class="table table-primary table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Data do Contato</th>
                    <th>Descrição do Paciente</th>
                    <th>Valor Proposto</th>
                    <?php if ($_SESSION['user']['tipo'] === "cliente"): ?>
                        <th>Cuidador</th>
                    <?php else: ?>
                        <th>Cliente</th>
                    <?php endif; ?>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $carregarCuidadorOuCliente = new AdicionarAvaliacaoDAO();

                foreach ($res as $item):
                    // Decide qual nome buscar com base no tipo do usuário logado
                    if ($_SESSION['user']['tipo'] === "cliente") {
                        $avaliacao = $carregarCuidadorOuCliente->AdicionarAvaliacao((int)$item['cuidador_id']);
                        $idUsuarioQueVaiReceberAvaliacao = $avaliacao['id_cuidador'];
                    } else {
                        $avaliacao = $carregarCuidadorOuCliente->AdicionarAvaliacao((int)$item['cliente_id']);
                        $idUsuarioQueVaiReceberAvaliacao = $avaliacao['id_cliente'];
                    }

                    //    conteudo de $avaliaçao
                    /*
                Array
(
    [id_cuidador] => 2
    [nome] => sheila
    [email] => williamsheilami@gmail.com
    [cpf] => 33665296833
    [senha] => $2y$10$t2qVVe9CQkWio9G82pbhLetIlmKgG8Gh1bk3sJjCYobdfSg16eeIy
    [tipo] => cuidador
    [telefone] => 14998546814
    [foto] => cuidador_69164eed7fde47.53046113.jpg
    [curriculo] => curriculo_69164eed803831.78885013.pdf
    [endereco_id] => 3
    [reset_token] => 
    [token_expiration] => 
)
                */

                    $_SESSION['avaliacao'] = $avaliacao;



                    $nomeUsuario = $avaliacao['nome'] ?? 'Desconhecido';
                ?>
                    <tr>
                        <td><?= date("d//m//Y", strtotime($item['data_inicio'])) ?? '-' ?></td>
                        <td><?= $item['descricao_paciente'] ?? '-' ?></td>
                        <td>R$ <?= number_format((float)$item['valor_proposta'], 2, ',', '.') ?></td>
                        <td><?= $nomeUsuario ?></td>
                        <td class="text-center">
                            <!-- Botões de like e dislike -->
                            <a href="/projeto_PI/setarLike?id=<?= $idUsuarioQueVaiReceberAvaliacao ?>&tipo=g" class="btn btn-success btn-sm me-2" title="Curtir">
                                <i class="bi bi-hand-thumbs-up"></i>
                            </a>
                            <a href="/projeto_PI/setarLike?id=<?= $idUsuarioQueVaiReceberAvaliacao ?>&tipo=ng" class="btn btn-danger btn-sm" title="Não curtir">
                                <i class="bi bi-hand-thumbs-down"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            Nenhum histórico encontrado.
        </div>
    <?php endif; ?>
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
<?php

declare(strict_types=1);

use App\DAO\AdicionarAvaliacaoDAO;
use App\DAO\CarregarCuidadoOuClienterDAO;

require_once "Layouts/header.php";
require_once "Layouts/nav.php";

$res = $_SESSION['res'] ?? [];
?>

<div class="container mt-4">
    <h3 class="mb-4 text-center">Histórico de Serviços</h3>

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
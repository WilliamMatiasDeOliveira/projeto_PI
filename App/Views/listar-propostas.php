<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

// array contendo todos od dados vindo da tabela servicos
if (isset($_SESSION['propostas'])) {
    $propostas = $_SESSION['propostas'];
    unset($_SESSION['propostas']);

}

// array de nomes buscados pelo cliente_id
if(isset($_SESSION['nomes'])){
    $nomes = $_SESSION['nomes'];
    unset($_SESSION['nomes']);
}
?>

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
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="id_proposta" value="<?= $proposta['id_servico'] ?>">
                        <input type="hidden" name="acao" value="aceitar">
                        <button type="submit" class="btn btn-success btn-sm" title="Aceitar">
                            <i class="bi bi-check-circle-fill"></i>
                        </button>
                    </form>

                    <!-- Formulário para recusar -->
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="id_proposta" value="<?= $proposta['id_servico'] ?>">
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





<?php
require_once "Layouts/footer.php";
?>
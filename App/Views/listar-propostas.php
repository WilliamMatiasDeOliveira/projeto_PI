<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

// array contendo todos od dados vindo da tabela servicos
if (isset($_SESSION['propostas'])) {
    $propostas = $_SESSION['propostas'];
    // unset($_SESSION['propostas']);
}

// array de nomes buscados pelo cliente_id
if(isset($_SESSION['nomes'])){
    $nomes = $_SESSION['nomes'];
    // unset($_SESSION['nomes']);
}

// se ocorreu um erro no aceite ou recusa da proposta
if(isset($_SESSION['erro_envio_resposta'])){
    $erro_envio_resposta = $_SESSION['erro_envio_resposta'];
    unset($_SESSION['erro_envio_resposta']);
}


?>

<?php if(isset($erro_envio_resposta)): ?>
    <div class="alert alert-danger">
        <?= $erro_envio_resposta ?>
    </div>
<?php endif; ?>



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
                    <form method="post"action="/projeto_PI/aceitar-recusar" style="display:inline-block;">
                        <input type="hidden" name="id_proposta" value="<?= $proposta['id_servico'] ?>">
                        <input type="hidden" name="cliente_id" value="<?= $proposta['cliente_id'] ?>">
                        <input type="hidden" name="acao" value="aceitar">
                        <button type="submit" class="btn btn-success btn-sm" title="Aceitar">
                            <i class="bi bi-check-circle-fill"></i>
                        </button>
                    </form>

                    <!-- Formulário para recusar -->
                    <form method="post"action="/projeto_PI/aceitar-recusar" style="display:inline-block;">
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
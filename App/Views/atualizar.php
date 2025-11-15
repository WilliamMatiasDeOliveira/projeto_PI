<?php

use App\DAO\GetAddressToUserInSession;

require_once "Layouts/header.php";
require_once "Layouts/nav.php";

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $endereco = $_SESSION['endereco'];
}

$id = "";
$tipo = "";

if ($user['tipo'] === "cliente") {
    $id = $user['id_cliente'];
    $tipo = "cliente";
    $user['id_cliente'] = $id;
} else {
    $id = $user['id_cuidador'];
    $tipo = "cuidador";
    $user['id_cuidador'] = $id;
}

?>

<div class="form-cliente-container">

    <section class="form-cliente">

        <div class="form-cliente-side">
            <img src="assets/imgs/cadastro.png" alt="Imagem de fundo">
        </div>

        <form action="/projeto_PI/atualizar-submit" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="tipo" value="<?= $tipo ?>">

            <div class="form-cliente-pessoal form">
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?= $user['nome'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['nome'])): ?>
                        <div class="text-warning">
                            <?= $erros['nome'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="cpf">Cpf</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" value="<?= $user['cpf'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['cpf'])): ?>
                        <div class="text-warning">
                            <?= $erros['cpf'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['email'])): ?>
                        <div class="text-warning">
                            <?= $erros['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" value="<?= $user['telefone'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['telefone'])): ?>
                        <div class="text-warning">
                            <?= $erros['telefone'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-cliente-endereco form">
                <div>
                    <label for="cep">Cep</label>
                    <input type="text" name="cep" id="cep" class="form-control" value="<?= $endereco['cep'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['cep'])): ?>
                        <div class="text-warning">
                            <?= $erros['cep'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control" value="<?= $endereco['rua'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['rua'])): ?>
                        <div class="text-warning">
                            <?= $erros['rua'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" value="<?= $endereco['cidade'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['cidade'])): ?>
                        <div class="text-warning">
                            <?= $erros['cidade'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="form-control" value="<?= $endereco['bairro'] ?>">
                    <!-- erro -->
                    <?php if (isset($erros['bairro'])): ?>
                        <div class="text-warning">
                            <?= $erros['bairro'] ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="form-cliente-fim form">
                <div class="form-cliente-foto">
                    <label for="foto">Alterar Foto</label>
                    <input type="file" name="foto" class="form-control" placeholder="jpg, jpeg, png">
                    <!-- erro -->
                    <?php if (isset($erros['foto_invalida'])): ?>
                        <div class="text-warning">
                            <?= $erros['foto_invalida'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-4 ">
                <input type="submit" class="btn btn-secondary form-control btn-cliente" value="Atualizar">
            </div>
        </form>
    </section>
</div>

<?php
require_once "Layouts/footer.php";
?>
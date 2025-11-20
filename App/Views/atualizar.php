<?php

use App\DAO\GetAddressToUserInSession;

require_once "Layouts/header.php";
require_once "Layouts/nav.php";

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $endereco = $_SESSION['endereco'];
}

$foto = $user['foto'] ?? null;

// pasta depende do tipo
$pasta = $user['tipo'] === "cliente" ? "clientes" : "cuidadores";

$caminhoFoto = "assets/imgs/$pasta/" . $foto;

// define imagem final: foto ou ícone
$fotoPath = (!empty($foto) && file_exists($caminhoFoto))
    ? $caminhoFoto
    : null; // vai cair no SVG depois


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
            <!-- <img src="assets/imgs/cadastro.png" alt="Imagem de fundo"> -->
             <!-- <img class="" src="" id="img"> -->
              <!-- <img class="" src="<?= $fotoPath ?>" id="img" width="270" height="200"> -->
               <?php if (empty($fotoPath)): ?>
        <!-- Ícone caso não exista foto -->
        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
            class="bi bi-person-circle mt-1" viewBox="0 0 16 16" id="img">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37
                C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
        </svg>
    <?php else: ?>
        <!-- Foto atual -->
        <img src="<?= $fotoPath ?>" 
             alt="Foto do usuário"
             id="img"
             width="270"
             height="200"
             class="border border-3 border-info rounded">
    <?php endif; ?>

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
                    <input type="file" name="foto" class="form-control"onchange="mostrar(this)" placeholder="jpg, jpeg, png">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script>
		function mostrar(img) {
    if (img.files && img.files[0]) {

        const reader = new FileReader();
        reader.onload = (el) => {

            const atual = document.getElementById('img');

            // se for SVG, troca por IMG
            if (atual.tagName.toLowerCase() === 'svg') {
                const novo = document.createElement('img');
                novo.id = 'img';
                novo.className = 'border border-3 border-info rounded';
                novo.width = 270;
                novo.height = 200;
                atual.replaceWith(novo);
            }

            $('#img')
                .attr('src', el.target.result)
                .width(270)
                .height(200);
        };

        reader.readAsDataURL(img.files[0]);
    }
}

	</script>

<?php
require_once "Layouts/footer.php";
?>
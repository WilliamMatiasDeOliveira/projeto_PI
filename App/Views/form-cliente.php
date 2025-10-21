<?php
$title = "Create Account";
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

// Se existir inputs vazios na submissão do formulario
// Exibe os erros 
// Session vinda de ClienteController form_cliente_submit()
if (isset($_SESSION['erros'])) {
    $erros = $_SESSION['erros'];
    unset($_SESSION['erros']);
}

if(isset($_SESSION['old'])){
    $old = $_SESSION['old'];
    unset($_SESSION['old']);
}
?>

<!-- se o e-mail já existir no bd -->
<?php if (isset($erros['email_exists'])): ?>
    <div class="alert alert-danger text-center">
        <?= $erros['email_exists']; ?>
    </div>
<?php endif; ?>
<!-- se o salvamento da foto falhou -->
<?php if (isset($erros['fail_foto_saved'])): ?>
    <div class="alert alert-danger text-center">
        <?= $erros['fail_foto_saved']; ?>
    </div>
<?php endif; ?>



<div class="form-cliente-container">

    <section class="form-cliente">

        <div class="form-cliente-side">
            <h1>Cadastre-se Gratuitamente!</h1>
            <p>Preencha os campos abaixo para criar sua conta como cliente.</p>
            <p>Ja possui uma conta? <a href="/projet_PI/login">Entre aqui!</a></p>
            <img src="assets/imgs/cadastro.png" alt="Imagem de fundo">
        </div>

        <form action="/projeto_PI/form-cliente-submit" method="post" enctype="multipart/form-data">

            <input type="hidden" name="tipo" value="cliente">

            <div class="form-cliente-pessoal form">
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control"value="<?= $old['nome'] ?? "" ?>">
                    <!-- erro -->
                    <?php if (isset($erros['nome'])): ?>
                        <div class="text-warning">
                            <?= $erros['nome'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="cpf">Cpf</label>
                    <input type="text" name="cpf" id="cpf" class="form-control"value="<?= $old['cpf'] ?? "" ?>">
                    <!-- erro -->
                    <?php if (isset($erros['cpf'])): ?>
                        <div class="text-warning">
                            <?= $erros['cpf'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control"value="<?= $old['email'] ?? "" ?>">
                    <!-- erro -->
                    <?php if (isset($erros['email'])): ?>
                        <div class="text-warning">
                            <?= $erros['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control"value="<?= $old['telefone'] ?? "" ?>">
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
                    <input type="text" name="cep" id="cep" class="form-control"value="<?= $old['cep'] ?? "" ?>">
                    <!-- erro -->
                    <?php if (isset($erros['cep'])): ?>
                        <div class="text-warning">
                            <?= $erros['cep'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control"value="<?= $old['rua'] ?? "" ?>">
                    <!-- erro -->
                    <?php if (isset($erros['rua'])): ?>
                        <div class="text-warning">
                            <?= $erros['rua'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control"value="<?= $old['cidade'] ?? "" ?>">
                    <!-- erro -->
                    <?php if (isset($erros['cidade'])): ?>
                        <div class="text-warning">
                            <?= $erros['cidade'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="form-control"value="<?= $old['bairro'] ?? "" ?>">
                    <!-- erro -->
                    <?php if (isset($erros['bairro'])): ?>
                        <div class="text-warning">
                            <?= $erros['bairro'] ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="form-cliente-senha form">
                <div>
                    <label for="password">Senha</label>
                    <input type="password" name="senha" class="form-control">
                    <!-- erro -->
                    <?php if (isset($erros['senha'])): ?>
                        <div class="text-warning">
                            <?= $erros['senha'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" name="confirmar_senha" class="form-control">
                    <!-- erro -->
                    <?php if (isset($erros['confirmar_senha'])): ?>
                        <div class="text-warning">
                            <?= $erros['confirmar_senha'] ?>
                        </div>
                    <?php endif; ?>
                    <!-- erro -->
                    <?php if (isset($erros['confirmar_senha'])): ?>
                        <div class="text-warning">
                            <?= $erros['confirmar_senha'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-cliente-fim form">
                <div class="form-cliente-foto">
                    <label for="foto">Foto de Perfil</label>
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
                <input type="submit" class="btn btn-secondary form-control btn-cliente" value="Cadastrar-se">
            </div>
</div>

</form>
</section>

</div>

<script>

    // função para integrar a api viaCep ao form

    // trecho para esperar o dom carregar
    document.addEventListener('DOMContentLoaded', () => {
        const cepInput = document.getElementById('cep');
        const ruaInput = document.getElementById('rua');
        const bairroInput = document.getElementById('bairro');
        const cidadeInput = document.getElementById('cidade');

        cepInput.addEventListener('blur', async () => {
            let cep = cepInput.value.replace(/\D/g, ''); // remove tudo que não for número

            if (cep.length !== 8) {
                alert('CEP inválido.');
                return;
            }

            try {
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                if (!response.ok) throw new Error('Erro na requisição');

                const data = await response.json();
                if (data.erro) {
                    alert('CEP não encontrado.');
                    ruaInput.value = '';
                    bairroInput.value = '';
                    cidadeInput.value = '';
                    return;
                }

                // Preenche os campos automaticamente
                ruaInput.value = data.logradouro;
                bairroInput.value = data.bairro;
                cidadeInput.value = data.localidade;

            } catch (error) {
                console.error(error);
                alert('Não foi possível consultar o CEP. Tente novamente.');
            }
        });
    });

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
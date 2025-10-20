<?php
$title = "Create Account";
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

// Se existir inputs vazios na submissão do formulario
// Exibe os erros 
// Session vinda de ClienteController form_cliente_submit()
if(isset($_SESSION['erros'])){
    $erros = $_SESSION['erros'];
    unset($_SESSION['erros']);
}
?>

<div class="form-cliente-container">
    <section class="form-cliente">

        <div class="form-cliente-side">
            <h1>Cadastre-se Gratuitamente!</h1>
            <p>Preencha os campos abaixo para criar sua conta como cliente.</p>
            <p>Ja possui uma conta? <a href="/projet_PI/login">Entre aqui!</a></p>
            <img src="assets/imgs/cadastro.png" alt="Imagem de fundo">
        </div>

        <form action="/projeto_PI/form-cliente-submit" method="post" enctype="multipart/form-data">

            <input type="hidden" name="tipo_usuario" value="cliente">

            <div class="form-cliente-pessoal form">
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control">
                    <!-- erro -->
                    <?php if(isset($erros['nome'])): ?>
                        <div class="text-warning">
                            <?= $erros['nome'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="cpf">Cpf</label>
                    <input type="text" name="cpf" id="cpf" class="form-control">
                    <!-- erro -->
                    <?php if(isset($erros['cpf'])): ?>
                        <div class="text-warning">
                            <?= $erros['cpf'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control">
                     <!-- erro -->
                    <?php if(isset($erros['email'])): ?>
                        <div class="text-warning">
                            <?= $erros['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control">
                     <!-- erro -->
                    <?php if(isset($erros['telefone'])): ?>
                        <div class="text-warning">
                            <?= $erros['telefone'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-cliente-endereco form">
                <div>
                    <label for="cep">Cep</label>
                    <input type="text" name="cep" id="cep" class="form-control">
                     <!-- erro -->
                    <?php if(isset($erros['cpf'])): ?>
                        <div class="text-warning">
                            <?= $erros['cep'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control">
                     <!-- erro -->
                    <?php if(isset($erros['rua'])): ?>
                        <div class="text-warning">
                            <?= $erros['rua'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control">
                     <!-- erro -->
                    <?php if(isset($erros['cidade'])): ?>
                        <div class="text-warning">
                            <?= $erros['cidade'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="form-control">
                     <!-- erro -->
                    <?php if(isset($erros['bairro'])): ?>
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
                    <?php if(isset($erros['senha'])): ?>
                        <div class="text-warning">
                            <?= $erros['senha'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input type="password" name="confirmar_senha" class="form-control">
                     <!-- erro -->
                    <?php if(isset($erros['confirmar_senha'])): ?>
                        <div class="text-warning">
                            <?= $erros['confirmar_senha'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-cliente-fim form">
                <div class="form-cliente-foto">
                    <label for="foto">Foto de Perfil</label>
                    <input type="file" name="foto" class="form-control">
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
</script>


<?php
require_once "Layouts/footer.php";
?>
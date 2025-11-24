<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

// caso o usuario tenha submetido o formulario com campo vazio
if (isset($_SESSION['erros'])) {
    $erros = $_SESSION['erros'];
    unset($_SESSION['erros']);
}

// este é o old value se algun imput foi preenchido
if (isset($_SESSION['old'])) {
    $old = $_SESSION['old'];
    unset($_SESSION['old']);
}
?>

<div class="form-login-container">

    <!-- se a criação da conta foi um sucesswo -->
    <?php if (isset($success)): ?>
        <div class="alert alert-success text-center">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <section class="form-login">
        <div class="logo-form">
            <img src="assets/imgs/logos/logobranca.svg" alt="">
        </div>
        <form action="/projeto_PI/login-submit" method="post">

            <div>
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="<?= $old['email'] ?? '' ?>">
                <!-- erros -->
                <?php if (isset($erros['email'])): ?>
                    <div class="text-warning">
                        <?= $erros['email'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control">
                <!-- erros -->
                <?php if (isset($erros['senha'])): ?>
                    <div class="text-warning">
                        <?= $erros['senha'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <input type="submit" class="btn btn-secondary form-control mt-4 mb-4" value="LOGIN">
            </div>
            <div class="links">
                <a href="/projeto_PI/cadastro" class="text-light">Ainda não tem conta ?</a>
                <a href="/projeto_PI/forgot-password" class="text-light">Esqueceu a senha ?</a>
            </div>
        </form>
    </section>

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
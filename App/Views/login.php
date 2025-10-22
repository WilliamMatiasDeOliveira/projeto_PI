<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
?>

<div class="form-login-container">

    <?php if (isset($success)): ?>
        <div class="alert alert-success text-center">
            <?= $success ?>
        </div>
    <?php endif; ?>
    <section class="form-login">
        <div class="logo-form">
            <img src="assets/imgs/logos/logobranca.svg" alt="">
        </div>
        <form action="projeto_PI/login_submit" method="post">

            <div>
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div>
                <label for="password">Senha</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div>
                <input type="submit" class="btn btn-secondary form-control mt-4 mb-4" value="LOGIN">
            </div>
            <div class="links">
                <a href="#" class="text-light">Ainda não tem conta ?</a>
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
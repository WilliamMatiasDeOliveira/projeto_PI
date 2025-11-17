<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

if (isset($_SESSION['deletado_sucesso'])) {
    $deletado_sucesso = $_SESSION['deletado_sucesso'];
    unset($_SESSION['deletado_sucesso']);
}
?>

<div class="hero-bg">

    <?php if (isset($deletado_sucesso)): ?>
        <div class="alert alert-danger">
            <?= $deletado_sucesso ?>
        </div>
    <?php endif; ?>

    <div class="hero">
        <div class="hero-intro">
            <h1>
                Conectamos quem cuida a quem precisa. <br><strong>Simples, rápido e humano.</strong>
            </h1>
            <p>
                Encontre o cuidador ideal para suas necessidades ou ofereça seus serviços de cuidado de forma fácil
                e segura. Nossa plataforma simplifica a busca e a conexão, priorizando o cuidado humanizado e a
                confiança entre as partes.
            </p>
            <a href="/projeto_PI/cadastro" class="btn btn-success">Quero saber mais</a>
        </div>
        <div class="hero-img">
            <img src="assets/imgs/hero4.png" alt="Imagem de fundo">
        </div>
    </div>
</div>

<section class="home-sobre">
    <div class="home-sobre-img">
        <div>
            <img src="assets/imgs/1.png" alt="Sobre 2">
        </div>
    </div>
    <div class="home-sobre-info">
        <h1>Quem somos nós?</h1>
        <p>No <strong>Conecte Cuidadores</strong>, acreditamos que todos merecem cuidado e atenção de qualidade.
            Nossa plataforma nasceu com um propósito simples: <strong>aproximar cuidadores experientes de pessoas
                que precisam de assistência</strong>, de forma rápida, acessível e confiável.</p>

        <p><strong>Nossa Missão é clara:</strong> facilitar a conexão entre aqueles que precisam de apoio no dia a
            dia e profissionais dedicados ao bem-estar e à saúde. Queremos tornar essa busca mais <strong>simples,
                rapida e humana</strong>.</p>
    </div>
</section>

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
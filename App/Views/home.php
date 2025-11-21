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
        <div class="alert alert-secondary">
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
            <img src="assets/imgs/hero_img.png" alt="Imagem de fundo">
        </div>
    </div>
</div>



<!-- ===== DESTAQUES DA PLATAFORMA ===== -->
<section class="destaques">
    <div class="container">
        <h2 class="destaque-titulo">Destaques da Plataforma</h2>

        <div class="destaques-flex">
            <div class="destaque-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->
                        <path d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3>Segurança</h3>
                <p>Verificamos informações básicas e priorizamos a privacidade para uma conexão segura.</p>
            </div>

            <div class="destaque-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path d="M434.8 54.1C446.7 62.7 451.1 78.3 445.7 91.9L367.3 288L512 288C525.5 288 537.5 296.4 542.1 309.1C546.7 321.8 542.8 336 532.5 344.6L244.5 584.6C233.2 594 217.1 594.5 205.2 585.9C193.3 577.3 188.9 561.7 194.3 548.1L272.7 352L128 352C114.5 352 102.5 343.6 97.9 330.9C93.3 318.2 97.2 304 107.5 295.4L395.5 55.4C406.8 46 422.9 45.5 434.8 54.1z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3>Conexão rápida</h3>
                <p>Perfil simples e fluxo intuitivo para encontrar ou oferecer serviços em poucos passos.</p>
            </div>

            <div class="destaque-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path d="M268.9 85.2L152.3 214.8c-4.6 5.1-4.4 13 .5 17.9 30.5 30.5 80 30.5 110.5 0l31.8-31.8c4.2-4.2 9.5-6.5 14.9-6.9 6.8-.6 13.8 1.7 19 6.9L505.6 376 576 320 576 32 464 96 440.2 80.1C424.4 69.6 405.9 64 386.9 64l-70.4 0c-1.1 0-2.3 0-3.4 .1-16.9 .9-32.8 8.5-44.2 21.1zM116.6 182.7L223.4 64 183.8 64c-25.5 0-49.9 10.1-67.9 28.1L112 96 0 32 0 320 156.4 450.3c23 19.2 52 29.7 81.9 29.7l15.7 0-7-7c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l41 41 9 0c19.1 0 37.8-4.3 54.8-12.3L359 441c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l32 32 17.5-17.5c8.9-8.9 11.5-21.8 7.6-33.1l-137.9-136.8-14.9 14.9c-49.3 49.3-129.1 49.3-178.4 0-23-23-23.9-59.9-2.2-84z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3>Humanizado</h3>
                <p>Foco na experiência do cuidador e do cliente: comunicação clara e respeito às necessidades.</p>
            </div>

            <div class="destaque-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path d="M80 0C44.7 0 16 28.7 16 64l0 384c0 35.3 28.7 64 64 64l224 0c35.3 0 64-28.7 64-64l0-384c0-35.3-28.7-64-64-64L80 0zm72 416l80 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3>Responsivo</h3>
                <p>Funciona bem em celulares e computadores para facilitar o uso em qualquer lugar.</p>
            </div>
        </div>
    </div>
</section>



<section class="home-sobre-bg">
    <div class="home-sobre">
        <div class="home-sobre-img">
            <img src="assets/imgs/sobre-bg.png" alt="Sobre nós">
        </div>
        <div class="home-sobre-info">
            <h2>Quem somos nós?</h2>
            <p>No <strong>Conecte</strong>, acreditamos que cuidado de verdade começa com uma boa conexão.
                Nosso propósito é aproximar cuidadores qualificados de pessoas que precisam de apoio —
                com rapidez, simplicidade e humanidade.</p>
            <p>Nossa missão é oferecer segurança, confiança e praticidade para famílias, enquanto valorizamos
                profissionais comprometidos com o bem-estar e a saúde de quem precisa.</p>
        </div>
    </div>
</section>


<!-- ===== pq ===== -->
<section class="why">
    <div class="container">
        <h2 class="why-titulo">Por que usar o Conecte?</h2>

        <div class="why-flex">
            <div class="why-card">
                <h3>Zero Burocracia</h3>
                <p>Cadastro simples e comunicação direta entre cliente e cuidador.</p>
            </div>

            <div class="why-card">
                <h3>Transparência</h3>
                <p>Avaliações e informações claras para facilitar a escolha com confiança.</p>
            </div>

            <div class="why-card">
                <h3>Flexibilidade</h3>
                <p>Encontre profissionais por disponibilidade, local ou tipo de cuidado.</p>
            </div>

            <div class="why-card">
                <h3>Suporte</h3>
                <p>Mapeamos problemas comuns e deixamos o fluxo simples para resolver no dia a dia.</p>
            </div>
        </div>
    </div>
</section>



<!-- ===== estatisticas ===== -->

<section class="stats">
    <div class="container stats-dentro">
        <div class="stat">
            <div class="stat-numero" data-target="24">0</div>
            <div class="stat-label">Cuidadores</div>
        </div>

        <div class="stat">
            <div class="stat-numero" data-target="12">0</div>
            <div class="stat-label">Famílias conectadas</div>
        </div>

        <div class="stat">
            <div class="stat-numero" data-target="95">0</div>
            <div class="stat-label">Satisfação (%)</div>
        </div>

        <div class="stat">
            <div class="stat-numero" data-target="150">0</div>
            <div class="stat-label">Horas de atendimento</div>
        </div>
    </div>
    <div class="stats-nota">
        <p><strong>*</strong> Números baseados em dados fictícios para demonstração</p>
    </div>
</section>

<!-- <section class="final-cta">
    <div class="container cta-dentro">
        <div class="cta-text">
            <h2>Pronto para começar?</h2>
            <p>Escolha o seu papel e inicie em poucos minutos. Simples, rápido e humano.</p>
        </div>

        <div class="cta-actions">
            <a href="/projeto_PI/prefill?role=client" class="btn btn-primary">Sou Cliente</a>
            <a href="/projeto_PI/prefill?role=caregiver" class="btn btn-outline">Sou Cuidador</a>
        </div>
    </div>
</section> -->

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

    (function() {
        const stats = document.querySelectorAll('.stat-numero');
        const options = {
            threshold: 0.4
        };

        function runCounter(el) {
            const target = +el.dataset.target;
            const duration = 1200;
            const start = 0;
            const startTime = performance.now();

            function step(now) {
                const progress = Math.min((now - startTime) / duration, 1);
                el.textContent = Math.floor(progress * (target - start) + start);
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    runCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, options);

        stats.forEach(s => observer.observe(s));
    })();
</script>


<?php
require_once "Layouts/footer.php";
?>
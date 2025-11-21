<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

// se email ou senha for invalidos
if (isset($_SESSION['fail_login'])) {
    $fail_login = $_SESSION['fail_login'];
    unset($_SESSION['fail_login']);
}
?>


<section class="papeis-container">

    <!-- se email ou senha for invalidos -->
    <?php if (isset($fail_login)): ?>
        <div class="alert alert-secondary text-center">
            <?= $fail_login ?>
        </div>
    <?php endif; ?>


    <h1>A ajuda certa, no momento certo!</h1>
    <div class="papeis">
        <div class="papeis-item item1">
            <h2>Buscando um <br> cuidador ?</h2>
            <ul>
                <li>Profissionais confiáveis.</li>
                <li>Escolha fácil e rápida.</li>
                <li>Sem burocracia.</li>
                <li>Encontre ajuda quando mais precisar.</li>
            </ul>
            <a href="/projeto_PI/form-cliente" class="btn form-control">Preciso de um</a>
        </div>
        <div class="papeis-item item2">
            <h2>Quer oferecer <br> cuidado ?</h2>
            <ul>
                <li>Alcance mais pessoas.</li>
                <li>Destaque sua experiência.</li>
                <li>Conexão direta, sem burocracia.</li>
                <li>Flexibilidade para escolher seus serviços.</li>
            </ul>
            <a href="/projeto_PI/form-cuidador" class="btn form-control">Seja Cuidador</a>
        </div>
    </div>
</section>

<div class="como-funciona-container">

    <h1 class="">Como Funciona ?</h1>

    <section class="como-funciona">

        <div class="card color1">
            <div class="funciona-icon-bg"><img src="assets/imgs/funciona1.png" class="funciona-icon" alt="..."></div>
            <div class="card-body">
                <h5 class="card-title">Escolha seu papel</h5>
                <p class="card-text">
                    Quer oferecer cuidado? Cadastre-se como cuidador. <br> Precisa de um cuidador? Busque profissionais
                    qualificados.
                </p>
            </div>
        </div>

        <div class="card color2">
            <div class="funciona-icon-bg"><img src="assets/imgs/funciona2.png" class="funciona-icon" alt="..."></div>
            <div class="card-body">
                <h5 class="card-title">Preencha um formulário</h5>
                <p class="card-text">
                    Preencha um formulário simples com suas informações e preferências. Quanto mais detalhes, melhor a
                    conexão!
                </p>
            </div>
        </div>

        <div class="card color2">
            <div class="funciona-icon-bg"><img src="assets/imgs/funciona3.png" class="funciona-icon" alt="..."></div>
            <div class="card-body">
                <h5 class="card-title">Conecte-se com facilidade</h5>
                <p class="card-text">
                    Receba contatos rapidamente e converse diretamente com o cuidador ou quem precisa do serviço.
                </p>
            </div>
        </div>

        <div class="card color1">
            <div class="funciona-icon-bg"><img src="assets/imgs/funciona4.png" class="funciona-icon" alt="..."></div>
            <div class="card-body">
                <h5 class="card-title">Comece o cuidado</h5>
                <p class="card-text">
                    Combine os detalhes, alinhe expectativas e inicie um cuidado seguro e de confiança.
                </p>
            </div>
        </div>

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
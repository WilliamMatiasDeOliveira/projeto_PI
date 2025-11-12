<?php

require_once "Layouts/header.php";
require_once "Layouts/nav.php";
// se não houver cuidador cadastrado com a especialidade
// retorna uma menssagem para a pagina buscar-cuidador.php
if (isset($_SESSION['not_exists_cuidador_with_especiality'])) {
  $not_exists_cuidador_with_especiality = $_SESSION['not_exists_cuidador_with_especiality'];
  unset($_SESSION['not_exists_cuidador_with_especiality']);
}
// carrega os cuidadores buscados 
if (isset($_SESSION['cuidadores'])) {
  $cuidadores = $_SESSION['cuidadores'];
  unset($_SESSION['cuidadores']);
}
// quando for enviada uma proposta para o cuidador
if (isset($_SESSION['sucesso_proposta_enviada'])) {
  $proposta_success = $_SESSION['sucesso_proposta_enviada'];
  unset($_SESSION['sucesso_proposta_enviada']);
}

?>

<section class="dashboard-cuidador-container flexdashboard">


  <div class="sidebar-dashboard">

    <div class="sidebar-topo">

      <div class="sidebar-header">
        <svg xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
          <path
            d="M88 289.6L64.4 360.2L64.4 160C64.4 124.7 93.1 96 128.4 96L267.1 96C280.9 96 294.4 100.5 305.5 108.8L343.9 137.6C349.4 141.8 356.2 144 363.1 144L480.4 144C515.7 144 544.4 172.7 544.4 208L544.4 224L179 224C137.7 224 101 250.4 87.9 289.6zM509.8 512L131 512C98.2 512 75.1 479.9 85.5 448.8L133.5 304.8C140 285.2 158.4 272 179 272L557.8 272C590.6 272 613.7 304.1 603.3 335.2L555.3 479.2C548.8 498.8 530.4 512 509.8 512z"
            fill="currentColor" />
        </svg>
        <h3>Dashboard</h3>
      </div>
      <ul class="list-unstyled components">
        <li>
          <a href="/projeto_PI/dashboard-cliente"> <svg xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
              <path
                d="M463 448.2C440.9 409.8 399.4 384 352 384L288 384C240.6 384 199.1 409.8 177 448.2C212.2 487.4 263.2 512 320 512C376.8 512 427.8 487.3 463 448.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 336C359.8 336 392 303.8 392 264C392 224.2 359.8 192 320 192C280.2 192 248 224.2 248 264C248 303.8 280.2 336 320 336z"
                fill="currentColor" />
            </svg> Perfil</a>
        </li>
        <li>
          <a href="/projeto_PI/buscar-cuidador
                        "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
              <path d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z"
                fill="currentColor" />
            </svg>
            Buscar Cuidadores</a>
        </li>

        <li>
          <a href="">
            <svg xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
              <path
                d="M128 128C128 92.7 156.7 64 192 64L341.5 64C358.5 64 374.8 70.7 386.8 82.7L493.3 189.3C505.3 201.3 512 217.6 512 234.6L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM336 122.5L336 216C336 229.3 346.7 240 360 240L453.5 240L336 122.5zM248 320C234.7 320 224 330.7 224 344C224 357.3 234.7 368 248 368L392 368C405.3 368 416 357.3 416 344C416 330.7 405.3 320 392 320L248 320zM248 416C234.7 416 224 426.7 224 440C224 453.3 234.7 464 248 464L392 464C405.3 464 416 453.3 416 440C416 426.7 405.3 416 392 416L248 416z"
                fill="currentColor" />
            </svg> Histórico</a>
        </li>
        <li>
          <a href="/projeto_PI/logout
                        "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
              <path d="M144 224C161.7 224 176 238.3 176 256L176 512C176 529.7 161.7 544 144 544L96 544C78.3 544 64 529.7 64 512L64 256C64 238.3 78.3 224 96 224L144 224zM334.6 80C361.9 80 384 102.1 384 129.4L384 133.6C384 140.4 382.7 147.2 380.2 153.5L352 224L512 224C538.5 224 560 245.5 560 272C560 291.7 548.1 308.6 531.1 316C548.1 323.4 560 340.3 560 360C560 383.4 543.2 402.9 521 407.1C525.4 414.4 528 422.9 528 432C528 454.2 513 472.8 492.6 478.3C494.8 483.8 496 489.8 496 496C496 522.5 474.5 544 448 544L360.1 544C323.8 544 288.5 531.6 260.2 508.9L248 499.2C232.8 487.1 224 468.7 224 449.2L224 262.6C224 247.7 227.5 233 234.1 219.7L290.3 107.3C298.7 90.6 315.8 80 334.6 80z"
                fill="currentColor" />
            </svg>
            </svg> Avaliações</a>
        </li>
        <li>
          <a href="/projeto_PI/logout
                        "><svg xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
              <path
                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                fill="currentColor" />
            </svg> Sair</a>
        </li>
      </ul>
    </div>

    <div class="sidebar-baixo  d-flex align-items-center">
      <a class="sidebar-perfil">
        <?php if (empty($user['foto'])): ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
            class="bi bi-person-circle mt-1" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37
                      C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
          </svg>
        <?php else: ?>
          <img src="assets/imgs/clientes/<?= $user['foto'] ?>"
            alt="Foto de perfil do usuário" width="50" height="50"
            class="mt-1 rounded-circle">
        <?php endif; ?>
        <div class="sidebar-nome mt-2">
          <p class="mb-0"><?= $user['nome'] ?></p>
        </div>
      </a>
    </div>
  </div>


  <div class="busca-dashboard">

    <!-- menssagem de alerta quando não existir cuidador cadastrado com a especialidade buscada  -->
    <?php if (isset($not_exists_cuidador_with_especiality)): ?>
      <div class="alert alert-danger">
        <?= $not_exists_cuidador_with_especiality ?>
      </div>
    <?php endif; ?>
    <!-- menssagem de sucesso quando for enviada uma proposta ao cuidador -->
    <?php if (isset($proposta_success)): ?>
      <div class="alert alert-success">
        <?= $proposta_success ?>
      </div>
    <?php endif; ?>

    <div class="busca-content">

      <div class="busca-side-a">

        <div class="busca-side-a-text">
          <h3>Filtros</h3>
        </div>

        <div class="busca-categoria">
          <button class="busca-categoria-text">
            <svg class="seta" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->
              <path d="M355.2 85C348.2 72.1 334.7 64 320 64C305.3 64 291.8 72.1 284.8 85L68.8 485C62.1 497.4 62.4 512.4 69.6 524.5C76.8 536.6 89.9 544 104 544L536 544C550.1 544 563.1 536.6 570.4 524.5C577.7 512.4 577.9 497.4 571.2 485L355.2 85z"
                fill="currentColor" />
            </svg>
            <h5>Pessoais</h5>
          </button>
          <div class="busca-categoria-list">
            <div class="busca-item">
              <form action="/projeto_PI/buscar-cuidador-submit" method="post">
                <input type="hidden" value="banho" name="especialidade">
                <input type="submit" class="" value="Banho">
              </form>
            </div>
            <div class="busca-item">
              <form action="/projeto_PI/buscar-cuidador-submit" method="post">
                <input type="hidden" value="banho" name="especialidade">
                <input type="submit" class="" value="Banho">
              </form>
            </div>
          </div>
        </div>

        <div class="busca-categoria">
          <button class="busca-categoria-text">
            <svg class="seta" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->
              <path d="M355.2 85C348.2 72.1 334.7 64 320 64C305.3 64 291.8 72.1 284.8 85L68.8 485C62.1 497.4 62.4 512.4 69.6 524.5C76.8 536.6 89.9 544 104 544L536 544C550.1 544 563.1 536.6 570.4 524.5C577.7 512.4 577.9 497.4 571.2 485L355.2 85z"
                fill="currentColor" />
            </svg>
            <h5>Saúde</h5>
          </button>
          <div class="busca-categoria-list">
            <div class="busca-item">
              <form action="/projeto_PI/buscar-cuidador-submit" method="post">
                <input type="hidden" value="curativo" name="especialidade">
                <input type="submit" class="" value="Curativo">
              </form>


            </div>
            <div class="busca-item">
              <form action="/projeto_PI/buscar-cuidador-submit" method="post">
                <input type="hidden" value="curativo" name="especialidade">
                <input type="submit" class="" value="Curativo">
              </form>
            </div>
          </div>
        </div>

        <div class="busca-categoria">
          <button class="busca-categoria-text">
            <svg class="seta" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->
              <path d="M355.2 85C348.2 72.1 334.7 64 320 64C305.3 64 291.8 72.1 284.8 85L68.8 485C62.1 497.4 62.4 512.4 69.6 524.5C76.8 536.6 89.9 544 104 544L536 544C550.1 544 563.1 536.6 570.4 524.5C577.7 512.4 577.9 497.4 571.2 485L355.2 85z"
                fill="currentColor" />
            </svg>
            <h5>Rotina</h5>
          </button>
          <div class="busca-categoria-list">
            <div class="busca-item">
              <form action="/projeto_PI/buscar-cuidador-submit" method="post">
                <input type="hidden" value="diaria" name="especialidade">
                <input type="submit" class="" value="Diária">
              </form>
            </div>
            <div class="busca-item">
              <form action="/projeto_PI/buscar-cuidador-submit" method="post">
                <input type="hidden" value="pernoite" name="especialidade">
                <input type="submit" class="" value="Pernoite">
              </form>
            </div>
          </div>
        </div>

        <div class="busca-categoria">
          <button class="busca-categoria-text">
            <svg class="seta" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->
              <path d="M355.2 85C348.2 72.1 334.7 64 320 64C305.3 64 291.8 72.1 284.8 85L68.8 485C62.1 497.4 62.4 512.4 69.6 524.5C76.8 536.6 89.9 544 104 544L536 544C550.1 544 563.1 536.6 570.4 524.5C577.7 512.4 577.9 497.4 571.2 485L355.2 85z"
                fill="currentColor" />
            </svg>
            <h5>Apoio</h5>
          </button>
          <div class="busca-categoria-list">
            <div class="busca-item">
            </div>
          </div>
        </div>

        <div class="busca-categoria">
          <button class="busca-categoria-text">
            <svg class="seta" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->
              <path d="M355.2 85C348.2 72.1 334.7 64 320 64C305.3 64 291.8 72.1 284.8 85L68.8 485C62.1 497.4 62.4 512.4 69.6 524.5C76.8 536.6 89.9 544 104 544L536 544C550.1 544 563.1 536.6 570.4 524.5C577.7 512.4 577.9 497.4 571.2 485L355.2 85z"
                fill="currentColor" />
            </svg>
            <h5>Tarefas</h5>
          </button>
          <div class="busca-categoria-list">
            <div class="busca-item">
            </div>
          </div>
        </div>
      </div>



      <div class="busca-side-b">
        <div class="busca-cuidadores">

          <?php if (isset($cuidadores)): ?>
            <?php foreach ($cuidadores as $cuidador): ?>

              <div class="cuidador-card">
                <div class="cuidador-foto">
                  <img src="assets/imgs/cuidadores/<?= $cuidador['foto'] ?>" alt="...">
                </div>

                <div class="cuidador-body">

                  <h4 class="cuidador-nome"><?= $cuidador['nome'] ?></h4>

                  <div class="cuidador-actions">
                    <a href="assets/imgs/curriculos/<?= $cuidador['curriculo'] ?>" class="btn-cv" target="_blank">Currículo</a>
                    <a href="/projeto_PI/proposta?id_cuidador=<?= $cuidador['id_cuidador'] ?>" class="btn-contratar">Contratar</a>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>


    </div>

  </div>

</section>

</div><!-- fim container -->

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

  document.querySelectorAll('.busca-categoria-text').forEach((header) => {
    header.addEventListener('click', () => {
      const list = header.nextElementSibling;

      if (!list.classList.contains('open')) {
        // abrir
        list.style.height = list.scrollHeight + "px";
        list.classList.add('open');
        header.classList.add('active');
      } else {
        // fechar
        list.style.height = list.scrollHeight + "px";
        requestAnimationFrame(() => {
          list.style.height = "0px";
        });
        list.classList.remove('open');
        header.classList.remove('active');
      }
    });
  });
</script>


<?php
require_once "Layouts/footer.php";
?>
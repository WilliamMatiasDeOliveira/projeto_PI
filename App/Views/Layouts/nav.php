<?php
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}
?>

<style>
  .navbar {
    transition: all 0.3s ease;
  }

  .logo-img {
    height: 45px;
    width: auto;
  }

  .nav-link {
    color: #333 !important;
    font-weight: 500;
    margin: 0 8px;
    transition: color 0.3s ease, transform 0.2s;
  }

  .nav-link:hover {
    color: #007bff !important;
    transform: scale(1.05);
  }

  .navbar .btn {
    border-radius: 20px;
    font-weight: 500;
  }

  .btn-outline-primary:hover {
    color: #fff !important;
  }

  /* Responsivo */
  @media (max-width: 992px) {
    .navbar-collapse {
      background-color: #f8f9fa;
      padding: 1rem;
      border-radius: 10px;
    }

    .nav-link {
      display: block;
      margin: 10px 0;
      text-align: center;
    }

    .d-flex.gap-2 {
      flex-direction: column;
      align-items: center;
    }

    .navbar .btn {
      width: 100%;
    }
  }
</style>

<!-- /* ======== NAVBAR ======== */ -->

<div class="navbar navbar-expand-lg bg-light shadow-sm py-2">
  <div class="container d-flex justify-content-between align-items-center">

    <!-- LOGO -->
    <a href="/projeto_PI/" class="navbar-brand d-flex align-items-center">
      <img src="/projeto_PI/App/public/assets/imgs/logos/logoescura.svg" alt="Logo" class="logo-img">
    </a>

    <!-- BOTÃO HAMBÚRGUER -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- LINKS -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-3">
        <li class="nav-item">
          <a href="/projeto_PI/" class="nav-link active">Home</a>
        </li>
        <li class="nav-item">
          <a href="/projeto_PI/form-cliente" class="nav-link">Contrate um Cuidador</a>
        </li>
        <li class="nav-item">
          <a href="/projeto_PI/form-cuidador" class="nav-link">Sou Cuidador</a>
        </li>
        <li class="nav-item">
          <a href="/projeto_PI/sobre-nos" class="nav-link">Sobre Nós</a>
        </li>
        <li class="nav-item">
          <a href="/projeto_PI/contatos" class="nav-link">Contatos</a>
        </li>
      </ul>

      <!-- BOTÕES
        <div class="d-flex gap-2">
          <a href="/projeto_PI/login" class="btn btn-outline-primary px-3">Entrar</a>
          <a href="/projeto_PI/cadastro" class="btn btn-primary px-3">Cadastrar</a>
        </div> -->

         <!-- BOTÕES -->
      <div class="d-flex gap-2">
        <?php if (isset($user['tipo'])): ?>
          <?php if ($user['tipo'] === 'cliente'): ?>
            <a href="/projeto_PI/dashboard-cliente" class="btn btn-outline-primary px-3">Perfil</a>
          <?php else: ?>
            <a href="/projeto_PI/dashboard-cuidador" class="btn btn-outline-primary px-3">Perfil</a>
          <?php endif; ?>
          <!-- <a href="/projeto_PI/logout" class="btn btn-primary px-3">Sair</a> -->

            <form action="/projeto_PI/logout" method="post">
              <input type="submit"class="btn btn-primary px-3"value="Sair">
            </form>



        <?php else: ?>
          <a href="/projeto_PI/login" class="btn btn-outline-primary px-3">Entrar</a>
          <a href="/projeto_PI/cadastro" class="btn btn-primary px-3">Cadastrar</a>
        <?php endif; ?>
      </div>



    </div>
  </div>
</div>
<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";
?>

<div class="container py-5">
  <h2 class="text-center mb-4">Buscar Cuidador por Especialidade</h2>
  
  <div class="row g-3">
    <!-- Card Banho -->
    <div class="col-md-3 col-sm-6">
      <a href="buscar-cuidador.php?especialidade=banho" class="text-decoration-none">
        <div class="card text-white bg-info text-center shadow-sm">
          <div class="card-body py-4">
            <h5 class="card-title">Banho</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Card Curativo -->
    <div class="col-md-3 col-sm-6">
      <a href="buscar-cuidador.php?especialidade=curativo" class="text-decoration-none">
        <div class="card text-white bg-success text-center shadow-sm">
          <div class="card-body py-4">
            <h5 class="card-title">Curativo</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Card Diária -->
    <div class="col-md-3 col-sm-6">
      <a href="buscar-cuidador.php?especialidade=diaria" class="text-decoration-none">
        <div class="card text-white bg-primary text-center shadow-sm">
          <div class="card-body py-4">
            <h5 class="card-title">Diária</h5>
          </div>
        </div>
      </a>
    </div>

    <!-- Card Pernoite -->
    <div class="col-md-3 col-sm-6">
      <a href="buscar-cuidador.php?especialidade=pernoite" class="text-decoration-none">
        <div class="card text-white bg-secondary text-center shadow-sm">
          <div class="card-body py-4">
            <h5 class="card-title">Pernoite</h5>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>




<?php
require_once "Layouts/footer.php";
?>
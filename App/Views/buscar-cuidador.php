<?php

use App\Functions\Helpers;

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

?>

<div class="container py-5">

  <?php if (isset($not_exists_cuidador_with_especiality)): ?>
    <div class="alert alert-danger">
      <?= $not_exists_cuidador_with_especiality ?>
    </div>
  <?php endif; ?>

  <h2 class="text-center mb-4">Buscar Cuidador por Especialidade</h2>

  <div class="row">
    <div class="col-3">
      <form action="/projeto_PI/buscar-cuidador-submit" method="post">
        <input type="hidden" value="banho" name="especialidade">
        <input type="submit" class="btn btn-info form-control" value="Banho">
      </form>
    </div>

    <div class="col-3">
      <form action="/projeto_PI/buscar-cuidador-submit" method="post">
        <input type="hidden" value="curativo" name="especialidade">
        <input type="submit" class="btn btn-success form-control" value="Curativo">
      </form>
    </div>

    <div class="col-3">
      <form action="/projeto_PI/buscar-cuidador-submit" method="post">
        <input type="hidden" value="diaria" name="especialidade">
        <input type="submit" class="btn btn-primary form-control" value="Diária">
      </form>
    </div>

    <div class="col-3">
      <form action="/projeto_PI/buscar-cuidador-submit" method="post">
        <input type="hidden" value="pernoite" name="especialidade">
        <input type="submit" class="btn btn-secondary form-control" value="Pernoite">
      </form>
    </div>
  </div>




  <?php if (isset($cuidadores)): ?>

    <?php foreach ($cuidadores as $cuidador): ?>

      <div class="row">

        <div class="card" style="width: 18rem;">
          <img src="assets/imgs/cuidadores/<?= $cuidador['foto'] ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?= $cuidador['nome'] ?></h5>

            <p class="d-flex flex-column">
              <a href="mailto:<?= $cuidador['email'] ?>" class="d-block text-light">
                <?= $cuidador['email'] ?>
              </a>
              <a href="tel:<?= $cuidador['telefone'] ?>" class="d-block text-light">Tel:
                <?= Helpers::formatarTelefone($cuidador['telefone']) ?>
              </a>
            </p>

            <a href="assets/imgs/curriculos/<?= $cuidador['curriculo'] ?>" class="btn btn-primary form-control" target="_blank">Curriculo</a>
          </div>
        </div>

      </div>

    <?php endforeach; ?>

  <?php endif; ?>





</div><!--fim container-->



















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
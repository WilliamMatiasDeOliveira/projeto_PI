<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

if(isset($_GET['id_cuidador'])){
  $id_cuidador = $_GET['id_cuidador'];
}


if (isset($_SESSION['erro_envio_proposta'])) {
  $proposta_error = $_SESSION['erro_envio_proposta'];
  unset($_SESSION['erro_envio_proposta']);
}
// if (isset($_SESSION['sucesso_proposta_enviada'])) {
//   $proposta_success = $_SESSION['sucesso_proposta_enviada'];
//   unset($_SESSION['sucesso_proposta_enviada']);
// }
?>

<div class="container mt-5 mb-5">

  <?php if (isset($proposta_error)): ?>
    <div class="alert alert-secondary">
      <?= $_SESSION['erro_envio_proposta'] ?>

    </div>
  <?php endif; ?>

  <?php if (isset($proposta_success)): ?>
    <div class="alert alert-success">
      <?= $proposta_success ?>
    </div>
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

          <form action="/projeto_PI/enviar-proposta" method="POST">
            <input type="hidden" name="id_cuidador" value="<?= htmlspecialchars($id_cuidador) ?>">

            <div class="form-group mb-4">
              <label for="descricao_paciente" class="form-label fw-semibold">
                Descreva a condição do paciente:
              </label>
              <textarea
                name="descricao_paciente"
                id="descricao_paciente"
                class="form-control"
                rows="6"
                placeholder="Exemplo: Paciente idoso com Alzheimer, precisa de cuidados diários..."
                required></textarea>
            </div>

            <div class="form-group mb-4">
              <label for="periodo" class="form-label fw-semibold">Período desejado:</label>
              <select name="periodo" id="periodo" class="form-select" required>
                <option value="">Selecione</option>
                <option value="diaria">Diária</option>
                <option value="semanal">Semanal</option>
                <option value="mensal">Mensal</option>
                <option value="pernoite">Pernoite</option>
              </select>
            </div>

            <div class="form-group mb-4">
              <label for="valor_proposta" class="form-label fw-semibold">Valor da proposta (R$):</label>
              <input
                type="number"
                name="valor_proposta"
                id="valor_proposta"
                class="form-control"
                step="0.01"
                placeholder="Ex: 200.00"
                required>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-secondary px-4">Enviar Proposta</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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

<?php require_once "Layouts/footer.php"; ?>
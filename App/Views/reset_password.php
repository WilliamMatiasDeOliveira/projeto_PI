<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";

$token = $_GET['token'] ?? '';
$type = $_GET['type'] ?? '';
?>

<div class="container py-5 d-flex flex-column stretch justify-content-center" style="min-height: 65vh;">
    <h2 class="text-center mb-4">Redefinir Senha</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-secondary text-center"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="/projeto_PI/reset-password-submit" method="post" class="w-50 mx-auto">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">

        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha</label>
            <input type="password" class="form-control" name="senha" required>

            <label for="confirmar_senha" class="form-label">Confirmar a senha Senha</label>
            <input type="password" class="form-control" name="confirmar_senha" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Salvar Nova Senha</button>
    </form>
</div>

<?php
require_once "Layouts/footer.php";
?>

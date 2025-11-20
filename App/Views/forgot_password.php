<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";
?>

<div class="container py-5 d-flex flex-column stretch justify-content-center" style="min-height: 65vh;">
    <h2 class="text-center mb-4">Recuperar Senha</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success text-center"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form action="/projeto_PI/forgot_password/send" method="post" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="email" class="form-label">Digite seu e-mail</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Enviar Link de Recuperação</button>
    </form>
</div>

<?php
require_once "Layouts/footer.php";
?>

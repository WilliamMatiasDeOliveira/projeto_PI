<?php
require_once "Layouts/header.php";
require_once "Layouts/nav.php";
?>

 <div class="form-login-container">

        <section class="form-login">
            <div class="logo-form">
                <img src="assets/imgs/logos/logobranca.svg" alt="">
            </div>
            <form action="projeto_PI/login_submit" method="post">

                <div>
                    <label for="email">E-mail</label>
                    <input type="email"name="email" class="form-control">
                </div>

                <div>
                    <label for="password">Senha</label>
                    <input type="password"name="password" class="form-control">
                </div>

                <div>
                    <input type="submit"class="btn btn-secondary form-control mt-4 mb-4" value="LOGIN">
                </div>
                <div class="links">
                    <a href="{{ route('cadastro') }}" class="text-light">Ainda não tem conta ?</a>
                    <a href="#"class="text-light">Esqueceu a senha ?</a>
                </div>
            </form>
        </section>

    </div>




<?php
require_once "Layouts/footer.php";
?>
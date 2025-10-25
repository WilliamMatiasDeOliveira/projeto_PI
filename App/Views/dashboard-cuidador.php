<?php

use App\DAO\GetAddressToUserInSession;

require_once "Layouts/header.php";
require_once "Layouts/nav.php";


if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if ($user) {
    // função para buscar o endereco do usuario logado na sessão
    $dao = new GetAddressToUserInSession();
    $endereco = $dao->getEnderecoToUserInSession($user);
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
                    <a href="/projeto_PI/dashboard-cuidador"> <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M463 448.2C440.9 409.8 399.4 384 352 384L288 384C240.6 384 199.1 409.8 177 448.2C212.2 487.4 263.2 512 320 512C376.8 512 427.8 487.3 463 448.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 336C359.8 336 392 303.8 392 264C392 224.2 359.8 192 320 192C280.2 192 248 224.2 248 264C248 303.8 280.2 336 320 336z"
                                fill="currentColor" />
                        </svg> Perfil</a>
                </li>
                <li>
                    <a href="/projeto_PI/cad-especialidade
                        "><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                                fill="currentColor" />
                        </svg> Cadastrar Especialidade </a>
                </li>
                <li>
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM288 224C288 206.3 302.3 192 320 192C337.7 192 352 206.3 352 224C352 241.7 337.7 256 320 256C302.3 256 288 241.7 288 224zM280 288L328 288C341.3 288 352 298.7 352 312L352 400L360 400C373.3 400 384 410.7 384 424C384 437.3 373.3 448 360 448L280 448C266.7 448 256 437.3 256 424C256 410.7 266.7 400 280 400L304 400L304 336L280 336C266.7 336 256 325.3 256 312C256 298.7 266.7 288 280 288z"
                                fill="currentColor" />
                        </svg> Estatisticas</a>
                </li>
                <li>
                    <a href=""> <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M128 128C128 92.7 156.7 64 192 64L341.5 64C358.5 64 374.8 70.7 386.8 82.7L493.3 189.3C505.3 201.3 512 217.6 512 234.6L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM336 122.5L336 216C336 229.3 346.7 240 360 240L453.5 240L336 122.5zM248 320C234.7 320 224 330.7 224 344C224 357.3 234.7 368 248 368L392 368C405.3 368 416 357.3 416 344C416 330.7 405.3 320 392 320L248 320zM248 416C234.7 416 224 426.7 224 440C224 453.3 234.7 464 248 464L392 464C405.3 464 416 453.3 416 440C416 426.7 405.3 416 392 416L248 416z"
                                fill="currentColor" />
                        </svg> Histórico</a>
                </li>
                <li>
                    <a href="/projeto_PI/logout
                        "><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                                fill="currentColor" />
                        </svg> Avaliações</a>
                </li>
                <li>
                    <a href="/projeto_PI/logout
                        "><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"
                                fill="currentColor" />
                        </svg> Agenda</a>
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
        <div class="sidebar-baixo">
            <a class="sidebar-perfil">
                <?php if ($user['foto'] === null): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-person-square mx-auto mt-1" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    </svg>
                <?php else: ?>
                    <img src="assets/imgs/cuidadores/<?= $user['foto'] ?>">
                <?php endif; ?>
                <div class="sidebar-nome">
                    <p><?= $user['nome'] ?></p>
                </div>
            </a>
        </div>
    </div>

    <!-- /////////////////////////////////////////////////////////////// -->
    <!-- /////////////////////////////////////////////////////////////// -->

    <div class=" main-dashboard">
        <h1>Bem vindo, <strong><?= $user['nome'] ?><strong>!</h1>
        <div class="main-content">
            <div class="main-a">


                <div class="nome-foto">
                    <div class="d-flex justify-content-center">
                        <?php if (empty($user['foto'])): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        <?php else: ?>
                            <img src="assets/imgs/cuidadores/<?= $user['foto'] ?>"
                                alt="Foto de perfil do usuário" width="120" height="120"
                                class=" mt-1 rounded-circle">
                        <?php endif; ?>
                    </div>

                    <div class="nome-text text-center">
                        <h3><?= $user['nome'] ?></h3>
                        <small>Cuidador</small>
                    </div>
                </div>

                <div class="sobre-mim">
                    <h3>Sobre mim</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate praesentium, cumque eos
                        laboriosam atque, quibusdam beatae repellendus aspernatur ipsa reprehenderit ex. Expedita a
                        possimus molestiae reprehenderit cupiditate facere veritatis autem!</p>
                </div>

            </div>
            <div class="main-b">
                <h2>Informações do Úsuario:</h2>
                <ul>
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z"
                                fill="currentColor" />
                        </svg>
                        E-mail:
                    </h4>
                    <span><?= $user['email'] ?></span>

                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M224.2 89C216.3 70.1 195.7 60.1 176.1 65.4L170.6 66.9C106 84.5 50.8 147.1 66.9 223.3C104 398.3 241.7 536 416.7 573.1C493 589.3 555.5 534 573.1 469.4L574.6 463.9C580 444.2 569.9 423.6 551.1 415.8L453.8 375.3C437.3 368.4 418.2 373.2 406.8 387.1L368.2 434.3C297.9 399.4 241.3 341 208.8 269.3L253 233.3C266.9 222 271.6 202.9 264.8 186.3L224.2 89z"
                                fill="currentColor" />
                        </svg>
                        Telefone:
                    </h4>
                    <span>
                        <?= $user['telefone'] ?></span>

                    <h4>

                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M128 128C128 92.7 156.7 64 192 64L448 64C483.3 64 512 92.7 512 128L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 128zM224 472C224 485.3 234.7 496 248 496L392 496C405.3 496 416 485.3 416 472C416 458.7 405.3 448 392 448L248 448C234.7 448 224 458.7 224 472zM406.6 272C401.8 298.4 385.1 320.7 362.4 333.2C369.1 316.2 373.6 295.2 375 272L406.6 272zM233.5 272L265.1 272C266.5 295.1 271.1 316.2 277.7 333.2C255 320.7 238.3 298.4 233.5 272zM309.9 327C303.7 313.6 298.8 294.5 297.2 272L343 272C341.4 294.5 336.5 313.6 330.3 327C325.8 336.6 322.1 340.8 320.1 342.5C318.1 340.8 314.4 336.7 309.9 327zM309.9 185C314.4 175.4 318.1 171.2 320.1 169.5C322.1 171.2 325.8 175.3 330.3 185C336.5 198.4 341.4 217.5 343 240L297.2 240C298.8 217.5 303.7 198.4 309.9 185zM406.6 240L375 240C373.6 216.9 369 195.8 362.4 178.8C385.1 191.3 401.8 213.6 406.6 240zM265 240L233.4 240C238.2 213.6 254.9 191.3 277.6 178.8C270.9 195.8 266.4 216.8 265 240zM448 256C448 185.3 390.7 128 320 128C249.3 128 192 185.3 192 256C192 326.7 249.3 384 320 384C390.7 384 448 326.7 448 256z"
                                fill="currentColor" />
                        </svg>
                        CPF:
                    </h4>
                    <span><?= $user['cpf'] ?></span>

                    <h4>

                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M352 64C316.7 64 288 92.7 288 128L288 160L240 160L240 88C240 74.7 229.3 64 216 64C202.7 64 192 74.7 192 88L192 160L128 160L128 88C128 74.7 117.3 64 104 64C90.7 64 80 74.7 80 88L80 162C52.4 169.1 32 194.2 32 224L32 512C32 547.3 60.7 576 96 576L544 576C579.3 576 608 547.3 608 512L608 320C608 284.7 579.3 256 544 256L480 256L480 128C480 92.7 451.3 64 416 64L352 64zM416 176L416 208C416 216.8 408.8 224 400 224L368 224C359.2 224 352 216.8 352 208L352 176C352 167.2 359.2 160 368 160L400 160C408.8 160 416 167.2 416 176zM400 256C408.8 256 416 263.2 416 272L416 304C416 312.8 408.8 320 400 320L368 320C359.2 320 352 312.8 352 304L352 272C352 263.2 359.2 256 368 256L400 256zM416 368L416 400C416 408.8 408.8 416 400 416L368 416C359.2 416 352 408.8 352 400L352 368C352 359.2 359.2 352 368 352L400 352C408.8 352 416 359.2 416 368zM528 352C536.8 352 544 359.2 544 368L544 400C544 408.8 536.8 416 528 416L496 416C487.2 416 480 408.8 480 400L480 368C480 359.2 487.2 352 496 352L528 352zM288 368L288 400C288 408.8 280.8 416 272 416L240 416C231.2 416 224 408.8 224 400L224 368C224 359.2 231.2 352 240 352L272 352C280.8 352 288 359.2 288 368zM272 256C280.8 256 288 263.2 288 272L288 304C288 312.8 280.8 320 272 320L240 320C231.2 320 224 312.8 224 304L224 272C224 263.2 231.2 256 240 256L272 256zM160 368L160 400C160 408.8 152.8 416 144 416L112 416C103.2 416 96 408.8 96 400L96 368C96 359.2 103.2 352 112 352L144 352C152.8 352 160 359.2 160 368zM144 256C152.8 256 160 263.2 160 272L160 304C160 312.8 152.8 320 144 320L112 320C103.2 320 96 312.8 96 304L96 272C96 263.2 103.2 256 112 256L144 256z"
                                fill="currentColor" />
                        </svg>
                        Cidade:
                    </h4>
                    <span><?= $endereco['cidade'] ?></span>

                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M288 112C288 85.5 309.5 64 336 64L432 64C458.5 64 480 85.5 480 112L480 160L528 160L528 88C528 74.7 538.7 64 552 64C565.3 64 576 74.7 576 88L576 160L592 160C618.5 160 640 181.5 640 208L640 528C640 554.5 618.5 576 592 576L336 576C309.5 576 288 554.5 288 528L288 112zM352 176L352 208C352 216.8 359.2 224 368 224L400 224C408.8 224 416 216.8 416 208L416 176C416 167.2 408.8 160 400 160L368 160C359.2 160 352 167.2 352 176zM368 256C359.2 256 352 263.2 352 272L352 304C352 312.8 359.2 320 368 320L400 320C408.8 320 416 312.8 416 304L416 272C416 263.2 408.8 256 400 256L368 256zM352 368L352 400C352 408.8 359.2 416 368 416L400 416C408.8 416 416 408.8 416 400L416 368C416 359.2 408.8 352 400 352L368 352C359.2 352 352 359.2 352 368zM528 256C519.2 256 512 263.2 512 272L512 304C512 312.8 519.2 320 528 320L560 320C568.8 320 576 312.8 576 304L576 272C576 263.2 568.8 256 560 256L528 256zM512 368L512 400C512 408.8 519.2 416 528 416L560 416C568.8 416 576 408.8 576 400L576 368C576 359.2 568.8 352 560 352L528 352C519.2 352 512 359.2 512 368zM96 544L96 384L80 384C35.8 384 0 348.2 0 304C0 277.3 13.1 253.7 33.2 239.1C32.4 234.2 32 229.1 32 224C32 171 75 128 128 128C181 128 224 171 224 224L224 320C224 355.3 195.3 384 160 384L160 544C160 561.7 145.7 576 128 576C110.3 576 96 561.7 96 544z"
                                fill="currentColor" />
                        </svg>
                        Bairro:
                    </h4>
                    <span><?= $endereco['bairro'] ?></span>

                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M287.9 96L211.7 96C182.3 96 156.6 116.1 149.6 144.6L65.4 484.5C57.9 514.7 80.8 544 112 544L287.9 544L287.9 480C287.9 462.3 302.2 448 319.9 448C337.6 448 351.9 462.3 351.9 480L351.9 544L528 544C559.2 544 582.1 514.7 574.6 484.5L490.5 144.6C483.4 116.1 457.8 96 428.3 96L351.9 96L351.9 160C351.9 177.7 337.6 192 319.9 192C302.2 192 287.9 177.7 287.9 160L287.9 96zM351.9 288L351.9 352C351.9 369.7 337.6 384 319.9 384C302.2 384 287.9 369.7 287.9 352L287.9 288C287.9 270.3 302.2 256 319.9 256C337.6 256 351.9 270.3 351.9 288z"
                                fill="currentColor" />
                        </svg>
                        Rua:
                    </h4>
                    <span>
                        <?= $endereco['rua'] ?></span>
                </ul>
                <a href="{{ route('update', encrypt(Auth::user()->id)) }}" class="btn btn-primary w-100">Atualizar
                    Dados</a>
            </div>
        </div>
</section>




<?php
require_once "Layouts/footer.php";
?>
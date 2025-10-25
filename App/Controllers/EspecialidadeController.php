<?php

namespace App\Controllers;

use App\DAO\AddSpeciality;
use App\DAO\EspecialidadeDAO;
use App\Functions\Helpers;

class EspecialidadeController
{

    public static function cad_especialidade_submit()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $especialidade = Helpers::cleanInput($_POST['especialidade'] ?? "");

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                // bloco preventivo para bloquear clientes ao cadastro de especialidades
                if ($user['tipo'] !== "cuidador") {
                    $_SESSION['type_user_invalid'] = "Apenas cuidadores podem cadastrar especialidade";
                    header("Location: /projeto_PI/cad-especialidade");
                    exit;
                }

                $especialidadeId = new EspecialidadeDAO();
                // esta função retorna o id da especialidade
                $especialidade_id = $especialidadeId->checkIfThisSpecialtyExists($especialidade);

                // bloco preventivo para especialidades não existente;
                if (!$especialidade_id) {
                    $_SESSION['not_exist_especiality'] = "Esta especialidade não existe !";
                    header("Location: /projeto_PI/cad-especialidade");
                    exit;
                }

                $adicionar_especialidade = new AddSpeciality();
                // verifica se esta especialidade já foi cadastrada pello cuidador
                $checkIfExistsSpecialitys = $adicionar_especialidade->add_speciality($user['id_cuidador'], $especialidade_id);

                // se o cuidador já tem cadastrada esta especialidade
                // retorna a menssagem 
                if (!$checkIfExistsSpecialitys) {
                    $_SESSION['check_if_exists_specialitys'] = "Esta especialidade já esta cadastrada !";
                    header("Location: /projeto_PI/cad-especialidade");
                    exit;
                }

                // Caso tudo ocorra sem erros redireciona para a pagina cad-especialidade.php
                // com uma menssagem dfe sucesso
                $_SESSION['success_add_speciality'] = "Especialidade cadastrada com sucesso !";
                header("Location: /projeto_PI/cad-especialidade");
                exit;
            }
        }
    }
}

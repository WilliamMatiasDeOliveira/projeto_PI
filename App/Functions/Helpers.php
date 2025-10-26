<?php

namespace App\Functions;

class Helpers
{

    public static function cleanInput($value)
    {
        return htmlspecialchars(strip_tags(stripslashes(trim(strtolower($value)))));
    }

    public static function formatarTelefone($telefone)
    {
        // Remove tudo que não for número
        $telefone = preg_replace('/\D/', '', $telefone);

        // Verifica se tem DDD + 9 dígitos (11 no total)
        if (strlen($telefone) === 11) {
            return sprintf(
                '(%s)%s-%s',
                substr($telefone, 0, 2),  // DDD
                substr($telefone, 2, 5),  // primeiros 5 dígitos
                substr($telefone, 7)      // últimos 4 dígitos
            );
        }

        // Caso tenha apenas 10 dígitos (sem o 9)
        if (strlen($telefone) === 10) {
            return sprintf(
                '(%s)%s-%s',
                substr($telefone, 0, 2),
                substr($telefone, 2, 4),
                substr($telefone, 6)
            );
        }

        // Se não encaixar em nenhum formato conhecido
        return $telefone;
    }
}

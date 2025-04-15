<?php

namespace Validation\Inputs;
use Exception;

class ValidateUser
{
    private $nome;
    private $email;
    private $senha;


    public function __construct(string $n, string  $e, string  $s, string  $c,)
    {
        $this->nome = $this->validateString($n);
        $this->email = $this->validateString($e);
        $this->senha = $this->validatePassword($s, $c);
    }

    public function validatePassword($password, $confirm)
    {
        $errorMessages = [];
        if (empty($password)) {
            // throw new Exception('A senha não pode ser vazia');
            $errorMessages[] = 'A senha não pode ser vazia';
        }
        if (strlen($password) < 6) {
            // throw new Exception('A senha deve conter pelo menos 8 caracteres');
            $errorMessages[] = 'A senha deve conter pelo menos 8 caracteres';
        }

        if ($password != $confirm or strlen($password) != strlen($confirm)) {
            // throw new Exception('A senha deve ser identica ao confirma');
            $errorMessages[] = 'A senha deve ser identica ao confirma';
        }

        if ($errorMessages) {
            $erros = '';
            foreach ($errorMessages as $msg) {
                $erros .= " $msg -";
            }
            throw new Exception($erros);
        } else {
            return $password;
        }
    }

    private function validateString($string)
    {
        $errorMessages = [];

        if (strlen($string) <= 0) {
            $errorMessages[] = "O campo deve ter no minimo 1 caracter";
        }

        if ($errorMessages) {
            $erros = '';
            foreach ($errorMessages as $msg) {
                $erros .= " $msg -";
            }
            throw new Exception($erros);
        } else {
            return $string;
        }
    }
}

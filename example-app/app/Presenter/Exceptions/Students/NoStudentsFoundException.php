<?php

namespace App\Presenter\Exceptions\Students;

use Exception;

class NoStudentsFoundException extends Exception
{
    protected $message = 'Nenhum estudante encontrado.';
}

<?php

namespace App\Enums;

enum HttpResponseMessage : string
{
    case REQUEST_ERROR_PROCESS = 'Houve um erro ao processa sua solicitação';
}

<?php

namespace App\Enums;

enum RequestStatus: string
{
    case PENDING = 'en_attente';
    case APPROVED = 'acceptee';
    case REJECTED = 'refusee';
}

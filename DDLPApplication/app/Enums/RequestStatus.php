<?php

namespace App\Enums;

enum RequestStatus: string
{
    case PENDING = 'En attente';
    case APPROVED = 'Acceptée';
    case REJECTED = 'Rejetée';
}

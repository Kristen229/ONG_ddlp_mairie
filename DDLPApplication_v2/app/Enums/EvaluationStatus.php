<?php

namespace App\Enums;

enum EvaluationStatus: string
{
    case PENDING = 'en_attente';
    case COMPLIANT = 'conforme';
    case NON_COMPLIANT = 'non_conforme';
    case WARNING = 'avertissement';
}

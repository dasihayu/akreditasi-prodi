<?php

namespace App\Enums;

enum UserRole: string
{
    case DOSEN = 'DOSEN';
    case KAPRODI = 'KAPRODI';
    case ASESOR = 'ASESOR';
    case EKSTERNAL = 'EKSTERNAL';
    case SUPERADMIN = 'SUPERADMIN';
}

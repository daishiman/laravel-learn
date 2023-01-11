<?php

declare(strict_types=1);

namespace App\Enums;

enum Permission: string
{
    case CreateStudent = 'create student';
    case UpdateStudent = 'update student';
}

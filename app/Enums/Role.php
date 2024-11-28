<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Faculty = 'faculty';
    case Student = 'student';
}

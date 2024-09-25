<?php

namespace App\Enums;

enum SpecialityEnum : string
{
    case STUDENT = 'alumno';
    case TEACHER = 'profesor';
    case ADMIN = 'administrador';
}
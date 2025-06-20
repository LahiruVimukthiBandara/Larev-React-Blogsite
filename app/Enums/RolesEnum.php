<?php

namespace App\Enums;

enum RolesEnum:string {
    case Admin = 'Admin';
    case Writer = 'Writer';
    case Reader = 'Reader';
}

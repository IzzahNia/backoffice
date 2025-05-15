<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case HOST = 'host';
    case VENDOR = 'vendor';
    case CREW = 'crew';
    case COLLABORATOR = 'collaborator';
    case USER = 'user';
}

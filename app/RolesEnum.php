<?php

namespace App;

enum RolesEnum: string
{
    case TENANT_MANAGER   = 'tenant_manager';
    case MANAGER          = 'manager';
    case STAFF            = 'staff';
    case SITE_MANAGER     = 'site_manager';
    case ADMIN            = 'admin';
    case HR_MANAGER       = 'hr_manager';
    case ACCOUNT_MANAGER  = 'account_manager';

    /**
     * Return the string label (role name).
     */
    public function label(): string
    {
        return $this->value;
    }
}

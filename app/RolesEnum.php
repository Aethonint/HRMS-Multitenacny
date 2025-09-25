<?php

namespace App;  // Update this to reflect that the file is in the app/ directory

enum RolesEnum: string
{
    case TENANT_MANAGER = 'tenant_manager';
    case MANAGER = 'manager';
    case STAFF = 'staff';
    case SITE_MANAGER = 'site_manager';
    case ADMIN = 'admin';
    case HR_MANAGER = 'hr_manager';
    case ACCOUNT_MANAGER = 'account_manager';
}

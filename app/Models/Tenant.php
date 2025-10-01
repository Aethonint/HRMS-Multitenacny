<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
   
  public static function getCustomColumns() :array
    {
         return [
            'id',
            'name',
            'data',
            'logo',
           
         ];
    }
    // Define the relationship to the users
    public function user()
    {
        return $this->hasOne(User::class, 'tenant_id', 'id'); // tenant_id in users table references id in tenants table
    }

    // Define the relationship to the domains
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }
    
       public function users()
    {
        return $this->hasMany(User::class, 'tenant_id', 'id');
    }

    
    
    
  
}
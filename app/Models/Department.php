<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'tenant_id',
        'name',
        'head_of_department',
        'description',
        'added_by',
    ];

    public function head()
    {
        return $this->belongsTo(User::class, 'head_of_department');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'department_id'); // if you add department_id in users table
    }
    public function addedBy()
{
    return $this->belongsTo(User::class, 'added_by');
}

}

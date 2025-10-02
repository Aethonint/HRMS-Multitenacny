<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
      protected $fillable = [
        'tenant_id',
        'department_id',
        'title',
        'description',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

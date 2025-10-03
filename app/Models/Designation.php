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
          'added_by',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
      public function addedBy()
{
    return $this->belongsTo(User::class, 'added_by');
}
}

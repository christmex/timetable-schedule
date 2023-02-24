<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'school_year_name',
        'is_active',
    ];

    public function setSchoolYearNameAttribute($value)
    {
        $this->attributes['school_year_name'] = ucwords($value);
    }
}

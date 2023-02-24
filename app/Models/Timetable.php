<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    
    protected $fillable = [
        'subject',
        'start',
        'end',
        'description'
    ];

    public function setSubjectAttribute($value)
    {
        $this->attributes['subject'] = ucwords($value);
    }
}

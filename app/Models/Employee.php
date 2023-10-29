<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'name',
        'phone_number',
        'alternate_phone_number',
        'email_id',
        'address',
        'soft_delete'
    ];
}

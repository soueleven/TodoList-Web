<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const STATUS_UNCOMPLETED = 0;

    const STATUS_COMPLETED = 1;
    
    protected $fillable = [
        'text',
        'status'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age',];

    public static function helloWorld()
    {
        return 'Hello, World!!';
    }

    public function sayHello()
    {
        return 'Hello!!';
    }
}
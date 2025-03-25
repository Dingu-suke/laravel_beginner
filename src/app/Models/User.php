<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'tel', 'address', 'email', 'password'];

    public static function helloWorld()
    {
        return 'Hello, World!!';
    }

    public function sayHello()
    {
        return 'Hello!!';
    }
}
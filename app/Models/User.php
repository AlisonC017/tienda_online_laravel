<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;


    public function getUsername()
    {
        return 'correo';
    }

    public function getEmailAttribute()
    {
        return $this->correo;
    }

    public function imagen()
    {
        return $this->foto ?: asset('uploads/user.png');
    }

    public function tienda()
    {
        return $this->hasOne(Tienda::class, 'id_usuario');
    }
}

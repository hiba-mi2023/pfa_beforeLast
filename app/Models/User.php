<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
  
    protected $fillable = [
        'first_name', 'family_name', 'email', 'password', 'university', 'study_field', 'study_level', 'photo_de_profil','phone','is_admin','is_approved'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Adjust the column names for the getters and setters as needed
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value); // Example: Convert the first name to uppercase first letter
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value); // Example: Convert the first name to lowercase
    }
     public function notes()
    {
        return $this->hasMany(Note::class, 'ID_utilisateur');
    }

    // Similarly, define getters and setters for other attributes if needed
}


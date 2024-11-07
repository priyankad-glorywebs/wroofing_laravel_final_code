<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    public $table = 'social_accounts';

    protected $fillable = [
     'user_id',
     'provider', 
     'provider_user_id',
     'email', 
     'name', 
     'avatar', 
     'token', 
     'social_type',
     'role_type',
     'created_by',
     'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


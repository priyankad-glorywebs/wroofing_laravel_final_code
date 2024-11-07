<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class Contractor extends Authenticatable implements MustVerifyEmail
{
    use  Notifiable;

    protected $table = "contractors";
    protected $casts = [
        'contractor_portfolio' => 'array','email_verified_at' => 'datetime',

    ];
    
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'address',
        'country_code',
        'contact_number', 
        'zip_code', 
        'profile_image', 
        'contractor_portfolio',
        'company_name',
        'banner_image',
        'company_logo',
        'facebook_id',
        'google_id'
    ];

    


    public function sendEmailVerificationNotification()
    {
        $guard = 'contractor';
        $this->notify(new \App\Notifications\CustomVerifyEmailNotification($guard));
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
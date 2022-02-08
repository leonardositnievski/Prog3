<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Usuario extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory, Authenticatable;
    protected $fillable = [
        'name',
        'bio',
        'photo_url',
        'email',
        'username',
        'settings'
    ];
    protected $casts = [
        'admin' => 'boolean'

    ];
    protected $hidden = ['password'];


    public function getAuthIdentifier(){
        return $this->id;
    }
    public function getAuthIdentifierName(){
        return 'id';
    }
    public function getAuthPassword(){
        return $this->password;
    }
    public function getPhotoUrlAttribute(){
        return $this->attributes['photo_url'] ? route('image',['url' => $this->attributes['photo_url']]) : asset('images/default-user.png');
    }

    public function getProfileUrlAttribute(){
        return routeLang('profile', ['id'=>$this->id]);
    }

    public function getIsAdminAttribute(){
        return $this->admin;
    }
    public function posts(){
        return $this->hasMany(Postagem::class, 'owner_id', 'id');
    }

    public function getSettingsAttribute(){
        return json_decode($this->attributes['settings']);
    }
    public function getRememberToken(){}
    public function setRememberToken($value){}
    public function getRememberTokenName(){}
    

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->api_token = Str::random(80);

        });
    }
    
    /**
     * Returns the current User
     *
     * @return Usuario
     */
    public static function current(){
        return Auth::user();
    }


}

<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function getListUser()
    {
        return self::get();
    }

    public function createUser($data)
    {
        $store = new store();
        // var_dump($data);exit;
        $store::create($data);

    }

    public function updateUser($idStore, Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $idStore->update($data);
        echo 'done';
    }

    public function deleteUser($idStore)
    {

        $idStore->delete();
        return 'done';
    }

}
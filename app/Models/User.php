<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Modules\Store\Entities\Store;
use Validator;

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

    public function getIdUserItem(Request $request)
    {

        $usr = $request->user('api');
        var_dump($usr);exit;
    }
    public function createUser(Request $request)
    {

        // $validator = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => 'error',
                'errors' => 'error',
            ]);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        return response()->json([
            'status' => 'success',
        ]);

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

    public function login(Request $request)
    {

        // $this->checkUser();exit;
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'fails',
                'message' => 'Unauthorized',
            ], 401);
        }

        if (auth()->attempt($credentials)) {

            //generate the token for the user
            $user_login_token = auth()->user()->createToken('Test Token 25-9')->accessToken;
            //var_dump($user_login_token);

            return response(['user' => auth()->user(), 'access_token' => $user_login_token], 200);
        } else {
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'ko dang nhap duoc'], 401);
        }

    }

    public function Store()
    {

        return $this->hasMany(Store::class);
    }
}

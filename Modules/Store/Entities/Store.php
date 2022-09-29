<?php

namespace Modules\Store\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class store extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'name', 'users_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\StoreFactory::new ();
    }

    protected $table = 'store';

    public function getListStore()
    {
        return self::get();
    }

    public function listStoreIdUser(Request $request)
    {
        $bearerToken = $request->bearerToken();

        $user = Auth::guard('api')->user();
        $listStoreUser = store::where("users_id", $user['id'])->get();
        return response()->json([
            'listStoreUser' => $listStoreUser,
        ]);
    }
    public function postIdUser(Request $request)
    {

    }
    public function createStore($data)
    {
        $store = new store();
        // var_dump($data);exit;
        $store::create($data);

    }

    public function updateStore($idStore, Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $idStore->update($data);
        echo 'done';
    }

    public function deleteStore($idStore)
    {

        $idStore->delete();
        return 'done';
    }

    public function userStore()
    {
        return $this->belongsTo(User::class);
    }
}

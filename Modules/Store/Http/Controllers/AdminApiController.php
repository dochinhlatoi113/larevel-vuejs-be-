<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\Store;

class AdminApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function __construct(store $store)
    {
        $this->store = $store;

    }

    public function index()
    {
        $listStore = $this->store->getListStore();
        // return view('store::index');
        return response()->json($listStore);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('store::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //

        if ($request->isMethod('post')) {
            // $store = new $store;

            $data = $request->validate([
                'users_id' => 'required',
                'name' => 'required',
                'description' => 'required',

            ]);

            return $this->store->createStore($data);

        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {
        return $this->store->listStoreIdUser($request);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('store::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update($id, Request $request)
    {
        $idStore = Store::find($id);

        // $store = new $store;

        if (isset($idStore)) {

            $this->store->updateStore($idStore, $request);

        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
        //

        $idStore = Store::find($id);

        // $store = new $store;

        if (isset($idStore)) {

            $this->store->deleteStore($idStore);

        }
    }
}

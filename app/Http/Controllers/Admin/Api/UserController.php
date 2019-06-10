<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\User;
use App\Http\Controllers\Controller;
use phpseclib\Crypt\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $paginate
     * @return UserResource
     */
    public function index($paginate = 50)
    {
        return UserResource::collection(User::paginate($paginate));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request)
    {
        $password = Hash::make($request->password);
        $data = $request->all();
        $data['password'] = $password;

        $user = User::create($data);

        return UserResource::collection($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show($id)
    {
        return UserResource::collection(User::firstOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        if($request->has('password')){
            $data['password'] = Hash::make($request->password);
        }
        $user = User::where('id',$id)->update($data);

        return UserResource::collection($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function destroy($id)
    {
        $user = User::destroy($id);

        return UserResource::collection($user);

    }
}

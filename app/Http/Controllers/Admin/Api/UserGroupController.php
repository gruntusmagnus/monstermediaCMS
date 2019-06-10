<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Requests\UserGroupRequest;
use App\Http\Resources\UserGroupResource;
use App\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $paginate
     * @return UserGroupResource
     */
    public function index($paginate = 50)
    {
       return new UserGroupResource(UserGroup::paginate($paginate));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserGroupResource
     */
    public function store(UserGroupRequest $request)
    {
        $userGroup = UserGroup::create($request->all());

        return new UserGroupResource($userGroup);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserGroupResource
     */
    public function show($id)
    {
        return new UserGroupResource(UserGroup::findOrFaild($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserGroupResource
     */
    public function update(UserGroupRequest $request, $id)
    {
        $userGroup = UserGroup::where('id',$id)->update($request->all());

        return new UserGroupResource($userGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return UserGroupResource
     */
    public function destroy($id)
    {
        $userGroup = UserGroup::destroy($id);

        return new UserGroupResource($userGroup);
    }
}

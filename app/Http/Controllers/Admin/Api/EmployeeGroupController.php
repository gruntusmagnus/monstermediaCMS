<?php

namespace App\Http\Controllers\Admin\Api;

use App\EmployeeGroup;
use App\Http\Requests\EmployeeGroupRequest;
use App\Http\Resources\EmployeeGroupResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $paginate
     * @return EmployeeGroupResource
     */
    public function index($paginate = 50)
    {
        return new EmployeeGroupResource(EmployeeGroup::paginate($paginate));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return EmployeeGroupResource
     */
    public function store(EmployeeGroupRequest $request)
    {
        $employeeGroup = EmployeeGroup::create($request->all());

        return new EmployeeGroupResource($employeeGroup);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return EmployeeGroupResource
     */
    public function show($id)
    {
        return new EmployeeGroupResource(EmployeeGroup::firstOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return EmployeeGroupResource
     */
    public function update(EmployeeGroupRequest $request, $id)
    {
        $employeeGroup = EmployeeGroup::where('id',$id)->update($request->all());

        return new EmployeeGroupResource($employeeGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return EmployeeGroupResource
     */
    public function destroy($id)
    {
        $employeeGroup = EmployeeGroup::destroy($id);

        return new EmployeeGroupResource($employeeGroup);

    }
}

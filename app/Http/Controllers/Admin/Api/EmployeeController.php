<?php

namespace App\Http\Controllers\Admin\Api;

use App\Employee;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $paginate
     * @return EmployeeResource
     */
    public function index($paginate = 50)
    {
        return EmployeeResource::collection(Employee::paginate($paginate));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return EmployeeResource
     */
    public function store(StoreEmployeeRequest $request)
    {
        $password = Hash::make($request->password);
        $data = $request->all();
        $data['password'] = $password;

        $employee = Employee::create($data);

        return EmployeeResource::collection($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return EmployeeResource
     */
    public function show($id)
    {
        return EmployeeResource::collection(Employee::firstOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return EmployeeResource
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $data = $request->all();
        if($request->has('password')){
            $data['password'] = Hash::make($request->password);
        }
        $employee = Employee::where('id',$id)->update($data);

        return EmployeeResource::collection($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return EmployeeResource
     */
    public function destroy($id)
    {
        $employee = Employee::destroy($id);

        return EmployeeResource::collection($employee);

    }
}

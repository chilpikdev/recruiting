<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\RoleFormRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Role::select("id", "name")->orderBy("created_at", "desc")->get();

        return view("admin.pages.role.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perrmissions = Permission::all();

        return view("admin.pages.role.create")->with(['permissions' => $perrmissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleFormRequest $request)
    {
        $role = Role::create(['guard_name' => 'admin', 'name' => $request->name]);

        if ($request->permissions)
        {
            foreach($request->permissions as $value)
            {
                $role->givePermissionTo($value);
            }
        }

        return redirect(route("admin.roles.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Role::findOrFail($id);
        $permissions = Permission::all();

        return view("admin.pages.role.create")->with(["data" => $data, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleFormRequest $request, string $id)
    {
        $role = Role::findOrFail($id);

        if ($request->permissions)
        {
            $role->syncPermissions($request->permissions);
        }

        $role->update([
            'name' => $request->name,
        ]);

        return redirect(route("admin.roles.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if (count($role->permissions) > 0)
        {
            foreach($role->permissions as $value)
            {
                $role->revokePermissionTo($value->name);
            }
        }

        Role::destroy($id);

        return back();
    }
}

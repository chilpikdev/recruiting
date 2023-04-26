<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\PermissionFormRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Permission::select("id", "name")->orderBy("created_at", "desc")->get();

        return view("admin.pages.permission.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view("admin.pages.permission.create")->with(['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionFormRequest $request)
    {
        $permission = Permission::create(['guard_name' => 'admin', 'name' => $request->name]);

        if ($request->roles)
        {
            foreach($request->roles as $id)
            {
                DB::insert('INSERT INTO role_has_permissions (permission_id, role_id) VALUES (?, ?)', [$permission->id, $id]);
            }
        }

        return redirect(route("admin.permission.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Permission::findOrFail($id);
        $roles = Role::all();

        return view("admin.pages.permission.create")->with(["data" => $data, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionFormRequest $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        if (count($permission->roles) > 0)
        {
            foreach($permission->roles as $value)
            {
                DB::delete('DELETE FROM role_has_permissions WHERE permission_id = ? AND role_id = ?', [$permission->id, $value->id]);
            }
        }

        if ($request->roles)
        {
            foreach($request->roles as $id)
            {
                DB::insert('INSERT INTO role_has_permissions (permission_id, role_id) VALUES (?, ?)', [$permission->id, $id]);
            }
        }

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect(route("admin.permissions.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);

        if (count($permission->roles) > 0)
        {
            foreach($permission->roles as $value)
            {
                DB::delete('DELETE FROM role_has_permissions WHERE permission_id = ? AND role_id = ?', [$permission->id, $value->id]);
            }
        }

        Permission::destroy($id);

        return back();
    }
}

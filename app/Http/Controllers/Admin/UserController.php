<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\UserFormRequest;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::select("id", "name", "email", "img")->orderBy("created_at", "desc")->get();

        return view("admin.pages.user.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view("admin.pages.user.create")->with(['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users|string',
            'img' => 'mimes:jpg,bmp,png,svg',
            'password' => 'required|min:6|confirmed',
            'roles' => 'array|nullable',
        ]);

        if ($request->has('img')) {
            $file = $request->file('img') ;
            $fileName = $this->random_string(15).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/images/user' ;
            $path = $file->move($destinationPath,$fileName);
            $data["img"] = 'images/user/'.$fileName;
        }

        $data["password"] = bcrypt($request->password);

        $user = User::create($data);

        if (isset($request->roles))
        {
            $user->assignRole($request->roles);
        }

        return redirect(route("admin.users.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        $roles = Role::all();

        return view("admin.pages.user.create")->with(["data" => $data, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|string',
            'img' => 'mimes:jpg,bmp,png,svg',
            // 'password' => 'nullable',
            'rules' => 'array|nullable'
        ]);

        if ($user->email != $request->email) {
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'min:6|confirmed',
            ]);

            $data["password"] = bcrypt($request->password);
        }

        if ($request->has('img')) {
            if (!empty($user->img)) {
                $image_path = public_path($user->img);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $data["img"] = null;
            }

            $file = $request->file('img') ;
            $fileName = $this->random_string(15).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/images/user' ;
            $path = $file->move($destinationPath,$fileName);
            $data["img"] = 'images/user/'.$fileName;
        }

        if (isset($request->roles))
        {
            $user->syncRoles($request->roles);
        }

        $user->update($data);


        return redirect(route("admin.users.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (auth('admin')->user()->id != $id) {
            if (!empty($user->img)) {
                $image_path = public_path($user->img);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            if (count($user->roles) > 0)
            {
                foreach($user->roles as $value)
                {
                    $user->removeRole($value->name);
                }
            }

            $user->delete();
        }

        return back();
    }

    /**
     * random string
     */
    protected function random_string($length)
    {
        $str = random_bytes($length);
        $str = base64_encode($str);
        $str = str_replace(["+", "/", "="], "", $str);
        $str = substr($str, 0, $length);
        return $str;
    }
}

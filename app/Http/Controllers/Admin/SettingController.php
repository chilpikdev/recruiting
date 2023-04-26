<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Setting::select("id", "title", "value")->orderBy("created_at", "desc")->get();

        return view("admin.pages.setting.index")->with(["data" => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Setting::findOrFail($id);

        return view("admin.pages.setting.update")->with("data", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting = Setting::findOrFail($id);

        $data = $request->validate([
            'value' => 'required',
        ]);

        if ($request->file('value'))
        {
            $data = $request->validate([
                'value' => 'mimes:jpg,bmp,png,svg',
            ]);

            if (!empty($setting->value)) {
                $image_path = public_path($setting->value);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $data["value"] = null;
            }

            $file = $request->file('value') ;
            $fileName = $this->random_string(15).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/images/setting' ;
            $path = $file->move($destinationPath,$fileName);
            $data["value"] = 'images/setting/'.$fileName;
        }
        else
        {
            $data = $request->validate([
                'value' => 'string|max:255'
            ]);
        }

        $setting->update($data);

        return redirect(route("admin.settings.index"));
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

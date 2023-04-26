<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Language;
use App\Http\Requests\Admin\LanguageFormRequest;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Language::all();

        return view("admin.pages.language.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.language.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageFormRequest $request)
    {
        $data = $request->validated();

        Language::create($data);

        return redirect(route("admin.languages.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Language::findOrFail($id);

        return view("admin.pages.language.create")->with("data", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageFormRequest $request, string $id)
    {
        $lang = Language::findOrFail($id);

        $data = $request->validated();

        $lang->update($data);

        return redirect(route("admin.languages.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Language::destroy($id);

        return back();
    }
}

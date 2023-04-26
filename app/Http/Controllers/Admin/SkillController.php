<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Skill;
use App\Http\Requests\Admin\SkillFormRequest;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Skill::all();

        return view("admin.pages.skill.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.skill.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillFormRequest $request)
    {
        $data = $request->validated();

        Skill::create($data);

        return redirect(route("admin.skills.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Skill::findOrFail($id);

        return view("admin.pages.skill.create")->with("data", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillFormRequest $request, string $id)
    {
        $skill = Skill::findOrFail($id);

        $data = $request->validated();

        $skill->update($data);

        return redirect(route("admin.skills.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Skill::destroy($id);

        return back();
    }
}

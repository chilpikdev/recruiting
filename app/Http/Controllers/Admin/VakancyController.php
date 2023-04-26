<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Position;
use App\Models\Admin\Skill;
use Illuminate\Http\Request;
use App\Models\Admin\Vakancy;
use App\Http\Requests\Admin\VakancyFormRequest;
use Illuminate\Support\Facades\DB;

class VakancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth('admin')->user()->hasRole('admin'))         {
            $data = Vakancy::all();
        } else {
            $data = Vakancy::where('user_id', auth('admin')->user()->id)->get();
        }

        return view("admin.pages.vakancy.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $skills = Skill::all();

        return view("admin.pages.vakancy.create")->with(['positions' => $positions, 'skills' => $skills]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VakancyFormRequest $request)
    {
        $data = [
            'title' => $request->title,
            'salary' => $request->salary,
            'work_procedures' => $request->work_procedures,
            'position_id' => $request->position_id,
            'user_id' => auth('admin')->user()->id,
        ];

        $vakancy = Vakancy::create($data);

        if (count($request->skills) > 0) {
            foreach ($request->skills as $value) {
                DB::insert('INSERT INTO skill_vakancy (skill_id, vakancy_id) VALUES (?, ?)', [$value, $vakancy->id]);
            }
        }

        return redirect(route("admin.vakancies.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Vakancy::findOrFail($id);
        $positions = Position::all();
        $skills = Skill::all();

        return view("admin.pages.vakancy.create")->with(["data" => $data, "positions" => $positions, 'skills' => $skills]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VakancyFormRequest $request, string $id)
    {
        $vakancy = Vakancy::findOrFail($id);

        $data = [
            'title' => $request->title,
            'salary' => $request->salary,
            'work_procedures' => $request->work_procedures,
            'position_id' => $request->position_id,
        ];

        if (count($vakancy->getSkills) > 0) {
            foreach ($vakancy->getSkills as $value) {
                DB::delete('DELETE FROM skill_vakancy WHERE skill_id = ? AND vakancy_id = ?', [$value->id, $vakancy->id]);
            }
        }

        if (count($request->skills) > 0) {
            foreach ($request->skills as $value) {
                DB::insert('INSERT INTO skill_vakancy (skill_id, vakancy_id) VALUES (?, ?)', [$value, $vakancy->id]);
            }
        }

        $vakancy->update($data);

        return redirect(route("admin.vakancies.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vakancy = Vakancy::findOrFail($id);

        if (count($vakancy->getSkills) > 0) {
            foreach ($vakancy->getSkills as $value) {
                DB::delete('DELETE FROM skill_vakancy WHERE skill_id = ? AND vakancy_id = ?', [$value->id, $vakancy->id]);
            }
        }

        $vakancy->delete();

        return back();
    }
}

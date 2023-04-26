<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Position;
use App\Http\Requests\Admin\PositionFormRequest;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Position::all();

        return view("admin.pages.position.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.position.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionFormRequest $request)
    {
        $data = $request->validated();

        Position::create($data);

        return redirect(route("admin.positions.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Position::findOrFail($id);

        return view("admin.pages.position.create")->with("data", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionFormRequest $request, string $id)
    {
        $position = Position::findOrFail($id);

        $data = $request->validated();

        $position->update($data);

        return redirect(route("admin.positions.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Position::destroy($id);

        return back();
    }
}

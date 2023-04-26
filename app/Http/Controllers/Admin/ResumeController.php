<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Language;
use App\Models\Admin\Position;
use App\Models\Admin\Skill;
use Illuminate\Http\Request;
use App\Models\Admin\Resume;
use App\Http\Requests\Admin\ResumeFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth('admin')->user()->hasRole('admin'))         {
            $data = Resume::all();
        } else {
            $data = Resume::where('user_id', auth('admin')->user()->id)->get();
        }

        return view("admin.pages.resume.index")->with(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $skills = Skill::all();
        $languages = Language::all();

        return view("admin.pages.resume.create")->with(['positions' => $positions, 'skills' => $skills, 'languages' => $languages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResumeFormRequest $request)
    {
        $data = [
            'experience' => $request->experience,
            'expected_salary' => $request->expected_salary,
            'user_id' => auth('admin')->user()->id,
        ];

        if ($request->has('avatar')) {
            $file = $request->file('avatar') ;
            $fileName = $this->random_string(15).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/files/resume/avatar' ;
            $path = $file->move($destinationPath,$fileName);
            $data["avatar"] = 'files/resume/avatar/'.$fileName;
        }

        $resumeFiles = [];

        foreach($request->files as $files) {
            foreach($files as $file) {
                $fileName = $this->random_string(15).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path().'/files/resume/file' ;
                $path = $file->move($destinationPath,$fileName);
                $resumeFiles[] = 'files/resume/file/'.$fileName;
            }
        }

        $data["files"] = (count($resumeFiles) > 0) ? json_encode($resumeFiles) : null;

        $resume = Resume::create($data);

        if (count($request->positions) > 0) {
            foreach ($request->positions as $value) {
                DB::insert('INSERT INTO position_resume (position_id, resume_id) VALUES (?, ?)', [$value, $resume->id]);
            }
        }

        if (count($request->skills) > 0) {
            foreach ($request->skills as $value) {
                DB::insert('INSERT INTO resume_skill (resume_id, skill_id) VALUES (?, ?)', [$resume->id, $value]);
            }
        }

        if (count($request->languages) > 0) {
            foreach ($request->languages as $value) {
                DB::insert('INSERT INTO language_resume (language_id, resume_id) VALUES (?, ?)', [$value, $resume->id]);
            }
        }

        return redirect(route("admin.resumes.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Resume::findOrFail($id);
        $positions = Position::all();
        $skills = Skill::all();
        $languages = Language::all();

        return view("admin.pages.resume.create")->with(["data" => $data, "positions" => $positions, 'skills' => $skills, 'languages' => $languages]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResumeFormRequest $request, string $id)
    {
        $resume = Resume::findOrFail($id);

        $data = [
            'experience' => $request->experience,
            'expected_salary' => $request->expected_salary,
        ];

        if ($request->has('avatar')) {
            if (!empty($resume->avatar)) {
                $image_path = public_path($resume->avatar);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $data["avatar"] = null;
            }

            $file = $request->file('avatar') ;
            $fileName = $this->random_string(15).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/files/resume/avatar' ;
            $path = $file->move($destinationPath,$fileName);
            $data["avatar"] = 'files/resume/avatar/'.$fileName;
        }

        if ($request->has('files')) {
            if (!empty($resume->files)) {
                foreach(json_decode($resume->files) as $value) {
                    $file_path = public_path($value);

                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }

                $data["files"] = null;
            }

            $resumeFiles = [];

            foreach($request->files as $files) {
                foreach($files as $file) {
                    $fileName = $this->random_string(15).'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path().'/files/resume/file' ;
                    $path = $file->move($destinationPath,$fileName);
                    $resumeFiles[] = 'files/resume/file/'.$fileName;
                }
            }

            $data["files"] = json_encode($resumeFiles);
        }

        /**
         * POSITIONS
         */
        if (count($resume->getPositions) > 0) {
            foreach ($resume->getPositions as $value) {
                DB::delete('DELETE FROM position_resume WHERE position_id = ? AND resume_id = ?', [$value->id, $resume->id]);
            }
        }
        if (count($request->positions) > 0) {
            foreach ($request->positions as $value) {
                DB::insert('INSERT INTO position_resume (position_id, resume_id) VALUES (?, ?)', [$value, $resume->id]);
            }
        }
        /**
         * SKILLS
         */
        if (count($resume->getSkills) > 0) {
            foreach ($resume->getSkills as $value) {
                DB::delete('DELETE FROM resume_skill WHERE resume_id = ? AND skill_id = ?', [$resume->id, $value->id]);
            }
        }
        if (count($request->skills) > 0) {
            foreach ($request->skills as $value) {
                DB::insert('INSERT INTO resume_skill (resume_id, skill_id) VALUES (?, ?)', [$resume->id, $value]);
            }
        }
        /**
         * LANGUAGES
         */
        if (count($resume->getLanguages) > 0) {
            foreach ($resume->getLanguages as $value) {
                DB::delete('DELETE FROM language_resume WHERE language_id = ? AND resume_id = ?', [$value->id, $resume->id]);
            }
        }
        if (count($request->languages) > 0) {
            foreach ($request->languages as $value) {
                DB::insert('INSERT INTO language_resume (language_id, resume_id) VALUES (?, ?)', [$value, $resume->id]);
            }
        }

        $resume->update($data);

        return redirect(route("admin.resumes.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resume = Resume::findOrFail($id);

        if (count($resume->getPositions) > 0) {
            foreach ($resume->getPositions as $value) {
                DB::delete('DELETE FROM position_resume WHERE position_id = ? AND resume_id = ?', [$value->id, $resume->id]);
            }
        }

        if (count($resume->getSkills) > 0) {
            foreach ($resume->getSkills as $value) {
                DB::delete('DELETE FROM resume_skill WHERE resume_id = ? AND skill_id = ?', [$resume->id, $value->id]);
            }
        }

        if (count($resume->getLanguages) > 0) {
            foreach ($resume->getLanguages as $value) {
                DB::delete('DELETE FROM language_resume WHERE language_id = ? AND resume_id = ?', [$value->id, $resume->id]);
            }
        }

        if (!empty($resume->avatar)) {
            $image_path = public_path($resume->avatar);

            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        if (!empty($resume->files)) {
            foreach(json_decode($resume->files) as $value) {
                $file_path = public_path($value);

                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
            }
        }

        $resume->delete();

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

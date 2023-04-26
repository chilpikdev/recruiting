<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Resume;
use App\Models\Admin\Vakancy;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * GET ALL VAKANCIES
     */
    public function getVakancies(Request $request)
    {
        $vakancies = Vakancy::all();

        $data = [];

        foreach($vakancies as $vakancy)
        {
            $data = [
                'id' => $vakancy->id,
                'title' => $vakancy->title,
                'position' => $vakancy->getPosition,
                'user' => $vakancy->getUser,
                'skills' => $vakancy->getSkills,
                'salary' => $vakancy->salary,
                'work_procedures' => $vakancy->work_procedures,
                'views' => $vakancy->views,
                'created_at' => $vakancy->created_at,
                'updated_at' => $vakancy->updated_at,
            ];
        }

        return $data;
    }

    /**
     * GET ALL VAKANCIES
     */
    public function getResumes(Request $request)
    {
        $resumes = Resume::all();

        $data = [];

        foreach($resumes as $resume)
        {
            $data = [
                'id' => $resume->id,
                'user' => $resume->getUser,
                'avatar' => $resume->avatar,
                'files' => json_decode($resume->files),
                'experience' => $resume->experience,
                'expected_salary' => $resume->expected_salary,
                'position' => $resume->getPositions,
                'skills' => $resume->getSkills,
                'languages' => $resume->getLanguages,
                'created_at' => $resume->created_at,
                'updated_at' => $resume->updated_at,
            ];
        }

        return $data;
    }
}

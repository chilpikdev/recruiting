<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Vakancy;
use App\Models\Admin\Resume;
use App\Models\Admin\CheckedVakancy;

class GetVakancyController extends Controller
{
    /**
     * get index page
     */
    public function getVakancies()
    {
        $myResumes = Resume::where('user_id', auth('admin')->user()->id)->get();
        $result = [];

        foreach($myResumes as $value)
        {
            $vakancies = [];

            foreach($value->getPositions as $position)
            {
                $res = Vakancy::where('position_id', $position->id)->get();

                if (count($res) > 1) {
                    foreach($res as $value)
                    {
                        $vakancies[] = $value;
                    }
                } elseif (count($res) == 1) {
                    $vakancies[] = $res->first();
                }
            }

            $data = [];

            foreach($vakancies as $vakancy)
            {
                $data[] = [
                    'id' => $vakancy->id,
                    'title' => $vakancy->title,
                    'position' => $vakancy->getPosition,
                    'user' => $vakancy->getUser,
                    'skills' => $vakancy->getSkills,
                    'salary' => $vakancy->salary,
                    'work_procedures' => $vakancy->work_procedures,
                    'views' => $vakancy->views,
                    'created_at' => $vakancy->created_at,
                    'resume_id' => $value->id,
                ];
            }

            if (!empty($data))
            {
                foreach($value->getSkills as $skill)
                {
                    foreach($data as $val)
                    {
                        if(in_array($skill->title, $val['skills']->first()->toArray())) {
                            $result[] = $val;
                        }
                    }
                }
            }
        }

        return view('admin.pages.getvakancy.index')->with('data', $result);
    }

    /**
     * CHECK VAKANCY
     */
    public function check($vakancy_id, $author_id, $resume_id)
    {
        CheckedVakancy::create(['vakancy_id' => $vakancy_id, 'author_id' => $author_id, 'resume_id' => $resume_id]);

        $vakancy = Vakancy::findOrFail($vakancy_id);
        $vakancy->views += 1;
        $vakancy->update();

        return back();
    }

    /**
     * GET CHECKED VAKANCIES
     */
    public function getCheckeds()
    {
        $vakants = CheckedVakancy::where('author_id', auth()->user()->id)->get();

        return view('admin.pages.getvakant.index')->with('data', $vakants);
    }
}

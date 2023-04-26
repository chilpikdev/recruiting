<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CheckedVakancy;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Vakancy;
use App\Models\Admin\Resume;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        $lastWeek  = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));
        $thisWeek = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d"), date("Y")));

        $byWeek = DB::select('SELECT * FROM vakancies WHERE created_at >= ? AND created_at < ?', [$lastWeek, $thisWeek]);

        $checkeds = [];

        foreach($byWeek as $value)
        {
            $res = CheckedVakancy::where('vakancy_id', $value->id)->get();

            if (count($res) > 1) {
                foreach($res as $value)
                {
                    $checkeds[] = $value;
                }
            } elseif (count($res) == 1) {
                $checkeds[] = $res->first();
            }
        }

        return view("admin.pages.dashboard")->with(['byWeek' => $byWeek, 'checkeds' => $checkeds]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Staff;
use App\Models\TimeSheet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TimeSheetController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
    }

    public function create(Request $request) {
        $staff_id = $request->input('id');
        $staff = Staff::find($staff_id);
        return view('time_sheet.create', compact('staff'));
    }

    public function store(Request $request) {
        $work_start = $this->ConvertStringToTime($request->work_start_hour, $request->work_start_minute);
        $work_end = $this->ConvertStringToTime($request->work_end_hour, $request->work_end_minute);
        $d = new Carbon();
        dd($d);

        $origin = new DateTime('2009-10-11');

        DB::table('time_sheets')->insert([
            'staff_id' => $request->staff_id,
            'workday' => $request->workday,
            'work_start' => $work_start,
            'work_end' => $work_end,
            'work_hour' => $work_hour,
        ]);
    }

    private function ConvertStringToTime($hour, $minute) {
        return $hour . ':' . $minute . ':00';
    }

    private function ConvertHourTimeStartToEnd($start, $end) {

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Staff;
use App\Models\TimeSheet;
use App\Http\Requests\timeSheetRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TimeSheetController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $filleble = [
        'staff_id',
        'workday',
        'work_hour',
        'work_start',
        'work_end',
    ];

    public function index() {
    }

    public function create(Request $request) {
        $hour_array = $this->getHourArray();
        $minute_array = $this->getMinuteArray();
        $staff_id = $request->input('id');
        $staff = Staff::find($staff_id);
        $today = Carbon::today();
        return view('time_sheet.create', compact('staff', 'hour_array', 'minute_array', 'today'));
    }

    public function store(timeSheetRequest $request) {
        $work_start = $this->ConvertStringToTime($request->work_start_hour, $request->work_start_minute);
        $work_end = $this->ConvertStringToTime($request->work_end_hour, $request->work_end_minute);
        $work_hour = $this->getWorkHour($request);

        $time_sheet = TimeSheet::create([
            'staff_id' => $request->staff_id,
            'workday' => $request->workday,
            'work_start' => $work_start,
            'work_end' => $work_end,
            'work_hour' => $work_hour,
        ]);

        if($time_sheet) {
            return redirect()->route('staff.detail', ['id' => $request->staff_id])->with('flash_message', '登録しました');
        }
    }

    public function update(timeSheetRequest $request) {
        $work_start = $this->ConvertStringToTime($request->work_start_hour, $request->work_start_minute);
        $work_end = $this->ConvertStringToTime($request->work_end_hour, $request->work_end_minute);
        $work_hour = $this->getWorkHour($request);

        $data = [
            'staff_id' => $request->staff_id,
            'workday' => $request->workday,
            'work_start' => $work_start,
            'work_end' => $work_end,
            'work_hour' => $work_hour,
        ];

        $time_sheet = TimeSheet::find($request->id);
        if($time_sheet->fill($data)->save()) {
            return redirect()->route('staff.detail', ['id' => $request->staff_id])->with('flash_message', '登録しました');
        }
        return false;
        
    }

    private function ConvertStringToTime($hour, $minute) {
        return $hour . ':' . $minute . ':00';
    }

    private function getWorkHour($request) {

        $workday_arr = explode('-', $request->workday);

        $start_year = $workday_arr[0];
        $start_month = $workday_arr[1];
        $start_day = $workday_arr[2];
        $start_hour = $request->work_start_hour;
        $start_minute = $request->work_start_minute;
        $start_second = '00';

        $end_year = $workday_arr[0];
        $end_month = $workday_arr[1];
        $end_day = $workday_arr[2];
        $end_hour = $request->work_end_hour;
        $end_minute = $request->work_end_minute;
        $end_second = '00';

        $work_start_datetime = Carbon::create($start_year, $start_month, $start_day, $start_hour, $start_minute, $start_second);
        $work_end_datetime = Carbon::create($end_year, $end_month, $end_day, $end_hour, $end_minute, $end_second);

        $diff_minute = $work_end_datetime->diffInMinutes($work_start_datetime);

        return $diff_minute / 60;
    }

    public function edit($time_sheet_id) {
        $time_sheet = TimeSheet::find($time_sheet_id);
        $staff_id = $time_sheet->staff_id;
        $staff = Staff::where('id',$staff_id)->first();
        $work_start_arr = explode(':', $time_sheet->work_start);
        $work_end_arr = explode(':', $time_sheet->work_end);

        $work_start_hour = $work_start_arr[0];
        $work_start_minute = $work_start_arr[1];
        $work_end_hour = $work_end_arr[0];
        $work_end_minute = $work_end_arr[1];

        $hour_array = $this->getHourArray();
        $minute_array = $this->getMinuteArray();

        // 初期値用のindex
        $work_start_hour_i = (array_search($work_start_hour,$hour_array));
        $work_start_minute_i = (array_search($work_start_minute,$minute_array));
        $work_end_hour_i = (array_search($work_end_hour,$hour_array));
        $work_end_minute_i = (array_search($work_end_minute,$minute_array));


        return view('time_sheet.edit', compact('staff', 'time_sheet', 'hour_array', 'minute_array', 'work_start_hour_i', 'work_start_minute_i', 'work_end_hour_i', 'work_end_minute_i'));
    }

    public function delete($time_sheet_id) {
        $time_sheet = TimeSheet::find($time_sheet_id);
        $staff_id = $time_sheet->staff_id;

        if($time_sheet->delete()) {
            return redirect()->route('staff.detail', ['id' => $staff_id])->with('flash_message', '削除しました');
        }
    }
    

    public function getHourArray() {
        return [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            10 => 10,
            11 => 11,
            12 => 12,
            13 => 13,
            14 => 14,
            15 => 15,
            16 => 16,
            17 => 17,
            18 => 18,
            19 => 19,
            20 => 20,
            21 => 21,
            22 => 22,
            23 => 23,
        ];
    }

    public function getMinuteArray() {
        return [
            '00' => '00', 
            '15' => '15', 
            '30' => '30', 
            '45' => '45'
        ];
    }

}

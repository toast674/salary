<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\staffRequest;
use App\Models\Staff;
use App\Models\TimeSheet;
use Illuminate\Support\Facades\Config;
class StaffController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $staffs = Staff::get();
        return view('index', compact('staffs'));
    }

    public function create() {
        return view('staff/create');
    }

    public function store(staffRequest $request) {
        $staff = Staff::create([
            'name' => $request->name,
            'hourly_wage' => $request->hourly_wage,
        ]);

        if($staff) {
            return redirect()->route('staff.index', ['id' => $staff->id])->with('flash_message', '登録しました');
        }
    }

    public function detail(Request $request, $staff_id) {
        $staff = Staff::find($staff_id);
        $now_year = $request->input('year');
        $now_month = $request->input('month');

        // 初期表示用
        if(!($now_year && $now_month)) {
            $now_year = date('Y');
            $now_month = date('n');
        }

        //　ページネーション機能をtime_sheetsに使うため、あえてstaffに紐づく$time_sheetsを取得し直す
        $time_sheets = TimeSheet::where('staff_id',$staff_id)->whereYear('workday', $now_year)->whereMonth('workday', $now_month);
        $total_work_hour = $time_sheets->sum('work_hour');

        $total_month_sulary = $total_work_hour * $staff->hourly_wage;
        $time_sheets = $time_sheets->paginate(10);

        return view('staff/detail', compact('staff', 'time_sheets', 'now_year', 'now_month', 'total_work_hour', 'total_month_sulary' ));
    }

    public function edit($staff_id) {
        $staff = Staff::find($staff_id);
        return view('staff/edit', compact('staff'));
    }

    public function update(staffRequest $request) {
        $data = [
            'id' => $request->staff_id,
            'name' => $request->name,
        ];

        $staff = Staff::find($request->staff_id);

        if($staff->fill($data)->save()) {
            return redirect()->route('staff.index', ['id' => $request->staff_id])->with('flash_message', '更新しました');
        }
        return false;
    }

    public function delete($staff_id) {
        $staff = Staff::find($staff_id);
        if($staff->delete()) {
            return redirect()->route('staff.index', ['id' => $staff_id])->with('flash_message', '削除しました');
        }
        return false;   
    }

    // public function timesheets_search(Request $request, $staff_id) {

    //     $staff = Staff::find($staff_id);
    //     $now_year = $request->input('year');
    //     $now_month = $request->input('month');
    //     $time_sheets = TimeSheet::where('staff_id',$staff_id)->whereYear('workday', $now_year)->whereMonth('workday', $now_month);
    //     $time_sheets = $time_sheets->paginate(10);

    //     return view('staff/detail', compact('staff', 'time_sheets', 'now_year', 'now_month'));        
    // }
}

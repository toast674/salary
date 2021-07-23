<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\TimeSheet;
class StaffController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $staffs = Staff::get();
        return view('index', compact('staffs'));
    }

    public function store() {
        $staff = Staff::create([
            'name' => $request->name,
            'hourly_wage' => $request->hourly_wage,
        ]);

        if($staff) {
            return redirect()->route('staff.detail', ['id' => $request->staff_id])->with('flash_message', '登録しました');
        }
    }

    public function detail($staff_id) {
        $staff = Staff::find($staff_id);
        return view('staff/detail', compact('staff'));
    }

    public function edit($staff_id) {
        $staff = Staff::find($staff_id);
        return view('staff/edit', compact('staff'));
    }

    public function update(Request $request) {
        $data = [
            'id' => $request->staff_id,
            'name' => $request->name,
            'hourly_wage' => $request->hourly_wage,
        ];

        $staff = Staff::find($request->staff_id);

        if($staff->fill($data)->save()) {
            return redirect()->route('staff.index', ['id' => $request->staff_id])->with('flash_message', '更新しました');
        }
        return false;
    }
    
    public function create() {
        return view('staff/create');
    }

    public function delete($staff_id) {
        if($time_sheet->delete()) {
            return redirect()->route('staff.index', ['id' => $staff_id])->with('flash_message', '削除しました');
        }
        return false;   
    }
}

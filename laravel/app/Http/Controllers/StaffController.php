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

    public function detail($staff_id) {
        $staff = Staff::find($staff_id);
        //　ページネーション機能をtime_sheetsに使うため、あえてstaffに紐づく$time_sheetsを取得し直す
        $time_sheets = TimeSheet::where('staff_id',$staff_id);
        $perPage = $time_sheets->count();
        $time_sheets = $time_sheets->paginate(10);
        return view('staff/detail', compact('staff', 'time_sheets'));
    }

    public function edit($staff_id) {
        $staff = Staff::find($staff_id);
        return view('staff/edit', compact('staff'));
    }

    public function update(staffRequest $request) {
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

    public function delete($staff_id) {
        $staff = Staff::find($staff_id);
        if($staff->delete()) {
            return redirect()->route('staff.index', ['id' => $staff_id])->with('flash_message', '削除しました');
        }
        return false;   
    }
}

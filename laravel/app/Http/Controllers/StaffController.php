<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Staff;
use App\Models\TimeSheet;
class StaffController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        $staffs = Staff::get();
        foreach($staffs as $staff) {
            echo $staff->time_sheets;
        }
        return view('index', compact('staffs'));
    }

    public function list($staff_id) {
        $staff = Staff::find($staff_id);
        return view('staff/list', compact('staff'));
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TimeSheet extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id',
        'workday',
        'work_hour',
        'work_start',
        'work_end',
    ];

    protected $dates = [
        'workday'
    ];

    public function staff() {
        return  $this->belongsTo('App\Staff');
    }

    public function getTimeSheetAsYearMonth($year, $month) {
        $time_sheets = TimeSheet::whereYear('workday', $year)->whereMonth('workday', $month)->get();
        return $time_sheets;
        // ->orderBy('workday')
        // ->get()
        // ->groupBy(function ($row) {
        //     return $row->workday->format('m');
        // })
        // ->map(function ($day) {
        //     return $day->sum('count');
        // });

    }

}

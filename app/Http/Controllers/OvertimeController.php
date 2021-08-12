<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Overtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OvertimeController extends Controller
{

    public function index()
    {
        $overtimes = Overtime::latest()->get();
        $employees = Employee::select('id','name')->orderBy('name', 'ASC')->get();
        return view('overtime', [
            'overtimes' => $overtimes,
            'employees' => $employees
        ]);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'work_date' => 'required|date',
            'employee_id' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
            'description' => 'required|string|max:255'
        ]);
        if ($validate->fails()) {
            return redirect('/overtime')->with('messages', 'Validator : '.$validate->errors()->first());
        }else{
            $checkDate =  Attendance::where('work_date', '=', date('Y-m-d', strtotime(request('work_date'))))
            ->count();
            $checkWeekend = date('D',strtotime(request('work_date')));
            if($checkWeekend != "Sun" || $checkWeekend != "Sat" ){
                if ($checkDate > 0) {
                    Overtime::create($request->all());
                    return redirect('/overtime')->with('messages', 'Berhasil Menambah lembur');
                }
                return redirect('/overtime')->with('messages', 'Validator : Tanggal yang Anda masukkan tidak cocok dengan absensi');
            }
            return redirect('/overtime')->with('messages', 'Validator : Tanggal yang Anda masukkan hari weekend');
        }
    }

    public function show($id)
    {
        //
    }

    
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'work_date' => 'required|date',
            'employee_id' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
            'description' => 'required|string|max:255'
        ]);
        if ($validate->fails()) {
            return redirect('/overtime')->with('messages', 'Validator : '.$validate->errors()->first());
        }else{
            $checkDate =  Attendance::where('work_date', '=', date('Y-m-d', strtotime(request('work_date'))))
            ->count();
            $checkWeekend = date('D',strtotime(request('work_date')));
            if($checkWeekend != "Sun" || $checkWeekend != "Sat" ){
                if ($checkDate > 0) {
                    $overtime = [
                        'employee_id' => request('employee_id'),
                        'work_date' => request('work_date'),
                        'time_in' => request('time_in'),
                        'time_out' => request('time_out'),
                        'description' => request('description')
                    ];
                    Overtime::where('id','=', request('del_id'))->update($overtime);
                    return redirect('/overtime')->with('messages', 'Berhasil merubah lembur');
                }
                return redirect('/overtime')->with('messages', 'Validator : Tanggal yang Anda masukkan tidak cocok dengan absensi');
            }
            return redirect('/overtime')->with('messages', 'Validator : Tanggal yang Anda masukkan hari weekend');
        }
    }

    
    public function delete()
    {
        try {
            Overtime::where('id', '=', request('del_id'))->delete();
            return back()->with('messages', 'Success menghapus data');
        } catch (\Throwable $th) {
            return back()->with('messages', 'Gagal menghapus data' .$th);
        }
    }
}

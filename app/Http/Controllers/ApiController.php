<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index() {
        $attendances = Attendance::get();
        return response()->json([
            'status' => 'success',
            'data' => $attendances
        ]);
    }
}

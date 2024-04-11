<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AttendanceController extends Controller
{
    public function unsetAttendance($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return Redirect::back()->with('success', 'Attendance unset!');
    }
}

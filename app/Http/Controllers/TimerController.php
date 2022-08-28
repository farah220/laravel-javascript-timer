<?php

namespace App\Http\Controllers;
use App\Models\Timer;
use App\Models\User;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function index()
    {
        $times =  Timer::all();

        return view('web.index',compact('times'));

    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
           'name' => ['required'],
            'time' => ['required'],
            'user_id' => ['required']
        ]);
        Timer::create($attributes);
        return redirect()->back();

    }

    public function update(Request $request, $id)
    {
        $timer = Timer::find($id);
        $timer->time = $request->input('timerInput');
        $timer->save();
        return redirect()->back();

    }


}

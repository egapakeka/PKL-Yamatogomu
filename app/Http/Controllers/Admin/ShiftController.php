<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Http\Requests\AdminShiftRequest;

class ShiftController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $shifts = Shift::paginate(20);
        return view('admin.shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('admin.shifts.create');
    }

    public function store(AdminShiftRequest $request)
    {
        Shift::create($request->validated());
        return redirect()->route('admin.shifts.index')->with('success','Shift created');
    }

    public function edit(Shift $shift)
    {
        return view('admin.shifts.edit', compact('shift'));
    }

    public function update(AdminShiftRequest $request, Shift $shift)
    {
        $shift->update($request->validated());
        return redirect()->route('admin.shifts.index')->with('success','Shift updated');
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('admin.shifts.index')->with('success','Shift deleted');
    }
}

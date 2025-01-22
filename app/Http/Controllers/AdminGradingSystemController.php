<?php namespace App\Http\Controllers;

use App\Models\GradingSystem;
use Illuminate\Http\Request;

class AdminGradingSystemController extends Controller
{
    public function index()
    {
        $grades = GradingSystem::orderBy('min_days')->get();
        return view('admin.grading.index', compact('grades'));
    }

    public function create()
    {
        return view('admin.grading.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'min_days' => 'required|integer',
            'grade' => 'required|string',
        ]);

        GradingSystem::create($request->all());

        return redirect()->route('grading-system.index')->with('success', 'Grade added successfully');
    }

    public function edit($id)
    {
        $grade = GradingSystem::find($id);
        return view('admin.grading.edit', compact('grade'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'min_days' => 'required|integer',
            'grade' => 'required|string',
        ]);

        $grade = GradingSystem::find($id);
        $grade->update($request->all());

        return redirect()->route('grading-system.index')->with('success', 'Grade updated successfully');
    }

    public function destroy($id)
    {
        GradingSystem::destroy($id);
        return redirect()->route('grading-system.index')->with('success', 'Grade deleted successfully');
    }
}
?>
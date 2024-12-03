<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show the create student form and display all students
    public function create()
    {
        $students = Student::all(); // Fetch all students
        return view('students.create', compact('students'));
    }

    // Store the student data in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'npm' => 'required|unique:students,npm', // Ensure unique NPM
            'name' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
        ]);

        // Create a new student record
        Student::create([
            'npm' => $request->npm,
            'name' => $request->name,
            'study_program' => $request->study_program,
        ]);

        // Redirect to the create form with a success message
        return redirect()->route('students.create')->with('success', 'Student created successfully.');
    }

    // Delete the student data
    public function destroy($id)
    {
        // Find the student by ID
        $student = Student::find($id);

        if ($student) {
            // Delete the student record
            $student->delete();

            // Redirect with success message
            return redirect()->route('students.create')->with('success', 'Student deleted successfully.');
        }

        // Redirect with error message if student not found
        return redirect()->route('students.create')->with('error', 'Student not found.');
    }

    // Export students to Excel
    public function exportExcel()
    {
        return Excel::download(new StudentsExport, 'students.xlsx'); // Download Excel file
    }
}

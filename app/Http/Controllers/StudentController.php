<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(5);
        $i = (request()->input('page', 1) - 1) * 5;

        return view('students.index', compact('students', 'i'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'rayon' => 'required',
            'rombel' => 'required',
            'ket' => 'required'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Berhasil Menyimpan !!');
    }

    public function show(Student $student)
    {
        return view('student.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'rayon' => 'required',
            'rombel' => 'required',
            'ket' => 'required'
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Berhasil Update !!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Berhasil Hapus !');
    }
}

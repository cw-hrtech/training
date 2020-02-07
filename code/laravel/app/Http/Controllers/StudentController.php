<?php

namespace App\Http\Controllers;

use App\Student;

class StudentController extends Controller
{
    public function index(Student $student)
    {
        $page = request()->get('page', 1);
        $perPage = 10;
        $result = $student->getAllStudent($perPage);
        return view('student.index', [
            'data' => $result,
            'currentPage' => $page,
            'perPage' => $perPage
        ]);
    }
}

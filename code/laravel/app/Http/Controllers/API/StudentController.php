<?php

namespace App\Http\Controllers\API;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends ApiController
{
    /**
     * @var Student
     */
    private $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->student->getAllStudent();
        return $this->success($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|unique:students,code',
                'name' => 'required',
                'age' => 'required|integer|min:18|max:35',
                'gender' => 'required',
                'email' => 'required|email|unique:students,email',
                'address' => 'required'
            ]);

            $result = $this->student->createStudent([
                'code' => $request->get('code'),
                'name' => $request->get('name'),
                'age' => $request->get('age'),
                'gender' => $request->get('gender') == Student::MALE,
                'email' => $request->get('email'),
                'address' => $request->get('address')
            ]);

            return $this->success($result);

        } catch (ValidationException $e) {
            return $this->error($e->errors());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $result = $this->student->getStudentById($id);
            return $this->success($result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'code' => 'required|unique:students,code,' . $id . ',id',
                'name' => 'required',
                'age' => 'required|integer|min:18|max:35',
                'gender' => 'required',
                'email' => 'required|email|unique:students,email,' . $id . ',id',
                'address' => 'required'
            ]);

            $result = $this->student->updateStudent([
                'code' => $request->get('code'),
                'name' => $request->get('name'),
                'age' => $request->get('age'),
                'gender' => $request->get('gender') == Student::MALE,
                'email' => $request->get('email'),
                'address' => $request->get('address')
            ], $id);

            return $this->success($result);

        } catch (ValidationException $e) {
            return $this->error($e->errors());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->student->removeStudentById($id);
        return $this->success($result);
    }
}

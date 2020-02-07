<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const MALE = 1;
    const FEMALE = 0;

    public function getAllStudent($perPage = 10)
    {
        return $this->orderBy('id', 'DESC')->paginate($perPage);
    }

    public function getStudentById(int $id)
    {
        return $this->findOrFail($id);
    }

    public function removeStudentById(int $id)
    {
        return $this->destroy($id);
    }

    public function createStudent(array $attributes)
    {
        $student = new static();
        foreach ($attributes as $key => $value) {
            $student->{$key} = $value;
        }
        return $student->save();
    }

    public function updateStudent(array $attributes, int $id)
    {
        $student = $this->findOrFail($id);
        foreach ($attributes as $key => $value) {
            $student->{$key} = $value;
        }
        return $student->save();
    }
}

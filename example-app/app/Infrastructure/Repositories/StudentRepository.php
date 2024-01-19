<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Student;

class StudentRepository
{
    public function save(Student $student)
    {
        // Usar o Eloquent para persistir o usuário
        $student->save();
    }

    public function getAll()
    {
        $student = Student::get();

        return $student;
    }

    public function getById($id)
    {
        $student = Student::where('id', $id)->get();
        return $student;
    }

    public function update(String $id, String $name, String $course)
    {
        if (Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->name = is_null($name) ? $student->name : $name;
            $student->course = is_null($course) ? $student->course : $course;
            $student->save();

            return $student;
        } else {
            return null;
        }
    }

    public function delete(String $id)
    {
        if (Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->delete();

            return $student;
        } else {
            return null;
        }
    }
}


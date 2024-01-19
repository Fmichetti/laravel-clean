<?php

namespace App\Application\UseCases\Student;

use App\Infrastructure\Repositories\StudentRepository;

class UpdateStudentUseCase
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function execute(string $id, string $name, string $course)
    {
        // Persistir o estudante
        $student = $this->studentRepository->update($id, $name, $course);

        return $student;
    }
}

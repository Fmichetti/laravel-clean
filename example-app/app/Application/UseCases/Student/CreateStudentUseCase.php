<?php

namespace App\Application\UseCases\Student;

use App\Domain\Entities\Student;
use App\Infrastructure\Repositories\StudentRepository;

class CreateStudentUseCase
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function execute(string $name, string $course): Student
    {
        // Lógica de negócios para criar um estudante
        $student = new Student(['name' => $name, 'course' => $course]);

        // Persistir o estudante
        $this->studentRepository->save($student);

        return $student;
    }
}

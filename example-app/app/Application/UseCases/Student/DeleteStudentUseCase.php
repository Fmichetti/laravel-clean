<?php

namespace App\Application\UseCases\Student;

use App\Infrastructure\Repositories\StudentRepository;

class DeleteStudentUseCase
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function execute(string $id)
    {
        // Persistir o estudante
        $student = $this->studentRepository->delete($id);

        return $student;
    }
}

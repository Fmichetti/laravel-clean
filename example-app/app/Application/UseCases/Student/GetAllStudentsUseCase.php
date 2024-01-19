<?php

namespace App\Application\UseCases\Student;

use App\Infrastructure\Repositories\StudentRepository;

class GetAllStudentsUseCase
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function execute()
    {
        // Persistir o estudante
        $student = $this->studentRepository->getAll();

        return $student;
    }
}

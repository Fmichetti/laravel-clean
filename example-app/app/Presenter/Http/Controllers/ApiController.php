<?php

namespace App\Presenter\Http\Controllers;

use App\Application\UseCases\Student\CreateStudentUseCase;
use App\Application\UseCases\Student\GetAllStudentsUseCase;
use App\Application\UseCases\Student\GetStudentUseCase;
use App\Application\UseCases\Student\UpdateStudentUseCase;
use App\Application\UseCases\Student\DeleteStudentUseCase;
use App\Presenter\Exceptions\Students\NoStudentsFoundException;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $createStudentUseCase;
    private $getAllStudentsUseCase;
    private $getStudentUseCase;
    private $updateStudentUseCase;
    private $deleteStudentUseCase;

    public function __construct(
        CreateStudentUseCase $createStudentUseCase,
        GetAllStudentsUseCase $getAllStudentsUseCase,
        GetStudentUseCase $getStudentUseCase,
        UpdateStudentUseCase $updateStudentUseCase,
        DeleteStudentUseCase $deleteStudentUseCase,
    ) {
        $this->createStudentUseCase = $createStudentUseCase;
        $this->getAllStudentsUseCase = $getAllStudentsUseCase;
        $this->getStudentUseCase = $getStudentUseCase;
        $this->updateStudentUseCase = $updateStudentUseCase;
        $this->deleteStudentUseCase = $deleteStudentUseCase;
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $course = $request->input('course');

        // Executar o caso de uso para criar um usuário
        $student = $this->createStudentUseCase->execute($name, $course);

        return response()->json($student);
    }

    public function getAllStudents()
    {
        try {
            $students = $this->getAllStudentsUseCase->execute();

            if ($students->isEmpty()) {
                throw new NoStudentsFoundException();
            }

            return response()->json($students);
        } catch (NoStudentsFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            // Outras exceções não previstas
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }

    public function getStudent($id)
    {
        try {
            $student = $this->getStudentUseCase->execute($id);

            if ($student->isEmpty()) {
                throw new NoStudentsFoundException();
            }

            return response()->json($student);
        } catch (NoStudentsFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            // Outras exceções não previstas
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        try {
            $name = $request->input('name');
            $course = $request->input('course');

            $student = $this->updateStudentUseCase->execute($id, $name, $course);

            if ($student == null) {
                throw new NoStudentsFoundException();
            }

            return response()->json($student);
        } catch (NoStudentsFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }

    public function deleteStudent($id)
    {
        try {
            $student = $this->deleteStudentUseCase->execute($id);

            if ($student == null) {
                throw new NoStudentsFoundException();
            }

            return response('',200);
        } catch (NoStudentsFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }
}

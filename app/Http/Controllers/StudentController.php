<?php

// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use function Laravel\Prompts\alert;

class StudentController extends Controller
{
    public function index(Request $request)

    {

        $query = Student::query();

        // Searching by multiple fields
        if ($request->has('name') || $request->has('surname') || $request->has('birth_place') || $request->has('birth_date')) {
            $name = $request->input('name');
            $surname = $request->input('surname');
            $birthPlace = $request->input('birth_place');
            $birthDate = $request->input('birth_date');

            $query->where(function ($q) use ($name, $surname, $birthPlace, $birthDate) {
                if (!empty($name)) {
                    $q->where('name', 'like', "%{$name}%");
                }
                if (!empty($surname)) {
                    $q->where('surname', 'like', "%{$surname}%");
                }
                if (!empty($birthPlace)) {
                    $q->where('birth_place', 'like', "%{$birthPlace}%");
                }
                if (!empty($birthDate)) {
                    $q->whereDate('birth_date', $birthDate);
                }
            });
        }

        if ($request->has('sort_by') && $request->has('sort_order')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order');
            $query->orderBy($sortBy, $sortOrder);
        }



        $students = $query->paginate(5);

        return view('students.index', ["students" => $students]);
    }

    public function store(Request $request)
    { //dd(request());
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        Student::create($request->all());

        return redirect()->route('students_index');
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        $student->update($request->all());
        //$request->all();
        // dd(request());
        return redirect()->route('students_index');
    }


    public function destroy(Request $request)
    {
        Student::find($request->id)->delete();

        return redirect()->route('students_index');
    }
}

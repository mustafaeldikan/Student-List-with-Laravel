<!DOCTYPE html>
<html>

<head>
    <title>Students</title>
</head>

<body>


    <table border="1">
        <thead>
            <tr>
                <th><a
                        href="{{ route('students_index', ['sort_by' => 'id', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Sid</a>
                </th>
                <th><a
                        href="{{ route('students_index', ['sort_by' => 'name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">First
                        Name</a></th>
                <th><a
                        href="{{ route('students_index', ['sort_by' => 'surname', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Surname</a>
                </th>
                <th><a
                        href="{{ route('students_index', ['sort_by' => 'birth_place', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Birth
                        Place</a></th>
                <th><a
                        href="{{ route('students_index', ['sort_by' => 'birth_date', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}">Birth
                        Date</a></th>
                <th>Actions</th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <form action="{{ route('students_index') }}" method="GET">
                    <td><input type='hidden' name='search' value=''></td>
                    <td><input type='text' name= 'name' value='{{ request('name') }}'></td>
                    <td><input type='text' name= 'surname' value='{{ request('surname') }}'></td>
                    <td><input type='text' name= 'birth_place' value='{{ request('birth_place') }}'></td>
                    <td><input type='date' name ='birth_date' value='{{ request('birth_date') }}'></td>
                    <td><button onclick='searchRow()'>SEARCH</button></td>
                    <td><button type='button' class='add-button'
                            onclick='window.location.href=window.location.pathname'>CLEAR</button></td>
                </form>

            </tr>


            <td>
                <form action="{{ route('student_store') }}" method="POST">
                    @csrf
           <th><input type="text" name="name" placeholder="Enter First Name" class="tablo-input"></th>
                <th><input type="text" name="surname" placeholder="Enter Last Name" class="tablo-input"></th>
                <th><input type="text" name="birth_place" placeholder="Enter Birthplace" class="tablo-input"></th>
                <th><input type="date" name="birth_date" class="tablo-input"></th>
                <th><button type="submit">INSERT</button></th>
                <th><button type="reset">CLEAR</button></th>
            </form>
            </td>


            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>
                        @if (request('edit_id') == $student->id)
                            <form action="{{ route('student_update', ['id' => $student->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ old('name', $student->name) }}"
                                    style="background-color: rgb(171, 167, 167);">
                            @else
                                {{ $student->name }}
                        @endif
                    </td>
                    <td>
                        @if (request('edit_id') == $student->id)
                            <input type="text" name="surname" value="{{ old('surname', $student->surname) }}"
                                style="background-color: rgb(171, 167, 167);">
                        @else
                            {{ $student->surname }}
                        @endif
                    </td>
                    <td>
                        @if (request('edit_id') == $student->id)
                            <input type="text" name="birth_place"
                                value="{{ old('birth_place', $student->birth_place) }}"
                                style="background-color: rgb(171, 167, 167);">
                        @else
                            {{ $student->birth_place }}
                        @endif
                    </td>
                    <td>
                        @if (request('edit_id') == $student->id)
                            <input type="date" name="birth_date"
                                value="{{ old('birth_date', $student->birth_date) }}"
                                style="background-color: rgb(171, 167, 167);">
                    </td>
                    <td><button type="submit">Update</button>


                        </form>
                    @else
                        {{ $student->birth_date }}
            @endif


            @if (request('edit_id') == $student->id)
                <a href="{{ route('students_index') }}">Cancel</a>
                </td>
            @else
                <td>
                    <a href="{{ route('students_index', ['edit_id' => $student->id]) }}">Edit</a>
                </td>

                <td>
                    <a href="{{ route('student_delete', ['id' => $student->id]) }}"
                        onclick="event.preventDefault();
                             document.getElementById('delete-form-{{ $student->id }}').submit();">
                        Delete
                    </a>

                    <form id="delete-form-{{ $student->id }}"
                        action="{{ route('student_delete', ['id' => $student->id]) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
            @endif
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $students->appends(request()->query())->links() }}
    </div>



    <script>
        document.querySelectorAll('.tablo-input').forEach((input, index, inputs) => {
            input.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const nextInput = inputs[index + 1];
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            });
        });
    </script>
</body>

</html>

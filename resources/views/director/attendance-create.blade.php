@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">📝 أخذ التفقد</h2>

        {{-- رسالة نجاح --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        {{-- رسائل الخطأ --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('director.attendance.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">اختر الطالب</label>
                <select name="student_id" class="form-select" required>
                    <option value="">-- اختر الطالب --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->firstname }} {{ $student->lastname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">تاريخ التفقد</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الحالة</label>
                <select name="status" class="form-select" required>
                    <option value="حاضر">حاضر</option>
                    <option value="غائب">غائب</option>
                    <option value="متأخر">متأخر</option>
                </select>
            </div>

            <input type="hidden" name="director_id" value="{{ auth()->id() }}">

            <button type="submit" class="btn btn-success">✅ حفظ التفقد</button>
        </form>
    </div>
@endsection

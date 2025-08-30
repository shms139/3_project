@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">➕ إضافة علامة جديدة</h2>

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

        <form action="{{ route('director.marks.store') }}" method="POST">
            @csrf
            <input type="hidden" name="director_id" value="{{ auth()->user()->id }}">

            <!-- اختيار الطالب -->
            <div class="mb-3">
                <label for="student_id" class="form-label">👨‍🎓 اختر الطالب</label>
                <select name="student_id" id="student_id" class="form-select" required>
                    <option value="">-- اختر الطالب --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->firstname }} {{ $student->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- اختيار المادة -->
            <div class="mb-3">
                <label for="subject_id" class="form-label">📘 اختر المادة</label>
                <select name="subject_id" id="subject_id" class="form-select" required>
                    <option value="">-- اختر المادة --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                    @endforeach
                </select>
            </div>

            <!-- اختيار الصف -->
            <div class="mb-3">
                <label for="the_class_id" class="form-label">🏫 اختر الصف</label>
                <select name="the_class_id" id="the_class_id" class="form-select" required>
                    <option value="">-- اختر الصف --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- العلامة -->
            <div class="mb-3">
                <label for="mark" class="form-label">📝 العلامة</label>
                <input type="number" name="mark" id="mark" class="form-control" min="0" max="100" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">💾 حفظ</button>
            </div>
        </form>
    </div>
@endsection

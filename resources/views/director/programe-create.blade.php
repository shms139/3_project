@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">➕ إضافة برنامج أسبوعي جديد</h2>

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

        {{-- رسالة نجاح --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('director.programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="director_id" value="{{ auth()->user()->id }}">

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

            <!-- رفع الملف -->
            <div class="mb-3">
                <label for="program_image" class="form-label">📄 رفع الملف (صورة أو PDF)</label>
                <input type="file" name="program_image" id="program_image" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">💾 حفظ</button>
            </div>
        </form>
    </div>
@endsection

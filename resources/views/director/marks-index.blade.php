@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">📊 قائمة العلامات</h2>

        {{-- رسائل الخطأ --}}
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        {{-- رسائل النجاح --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- زر إضافة علامة -->
        <a href="{{ route('director.marks.create') }}" class="btn btn-success mb-3">➕ إضافة علامة</a>

        <!-- جدول العلامات -->
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📝 جميع العلامات</h5>
            </div>
            <div class="card-body p-0">
                @if($marks->isEmpty())
                    <p class="text-center p-3 text-muted">🚫 لا توجد علامات بعد</p>
                @else
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>👨‍🎓 الطالب</th>
                            <th>📘 المادة</th>
                            <th>🏫 الصف</th>
                            <th>📝 العلامة</th>
                            <th>📅 تاريخ الإدخال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($marks as $index => $mark)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mark->student->firstname }} {{ $mark->student->lastname }}</td>
                                <td>{{ $mark->subject->subject ?? '---' }}</td>
                                <td>{{ $mark->class->name ?? '---' }}</td>
                                <td>{{ $mark->mark }}</td>
                                <td>{{ $mark->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

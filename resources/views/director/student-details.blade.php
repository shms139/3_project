@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">📖 تفاصيل الطالب</h2>

        {{-- بيانات الطالب --}}
        <div class="card shadow-lg border-0 rounded-3 mb-4">
            <div class="card-body">
                <h4 class="mb-3">{{ $student->firstname }} {{ $student->lastname }}</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>📍 العنوان:</strong> {{ $student->address }}</li>
                    <li class="list-group-item"><strong>🏫 الصف:</strong> {{ $student->the_class }}</li>
                    <li class="list-group-item"><strong>📞 الموبايل:</strong> {{ $student->mobile }}</li>
                    <li class="list-group-item"><strong>📧 الإيميل:</strong> {{ $student->email }}</li>
                    <li class="list-group-item"><strong>👨‍👩‍👧 ولي الأمر:</strong> {{ $student->parents_name }}</li>
                    <li class="list-group-item"><strong>🎂 تاريخ الميلاد:</strong> {{ $student->date }}</li>
                </ul>
            </div>
        </div>

        {{-- العلامات --}}
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📝 العلامات</h5>
            </div>
            <div class="card-body p-0">
                @if($student->marks->isEmpty())
                    <p class="text-center p-3 text-muted">🚫 لا توجد علامات لهذا الطالب بعد</p>
                @else
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>المادة</th>
                            <th>العلامة</th>
                            <th>تاريخ الإدخال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student->marks as $index => $mark)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mark->subject->subject ?? '---' }}</td>
                                <td>{{ $mark->mark }}</td>
                                <td>{{ $mark->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- زر العودة --}}
        <div class="mt-3">
            <a href="{{ route('director.students.index') }}" class="btn btn-secondary">⬅ رجوع للقائمة</a>
        </div>
    </div>
@endsection

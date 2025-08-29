@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">📋 قائمة الطلاب</h2>

        {{-- رسائل النجاح أو الفشل --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>الاسم الأول</th>
                <th>الكنية</th>
                <th>العنوان</th>
                <th>الصف</th>
                <th>الموبايل</th>
                <th>الإيميل</th>
                <th>ولي الأمر</th>
                <th>تاريخ الميلاد</th>
                <th>إجراءات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->firstname }}</td>
                    <td>{{ $student->lastname }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->the_class }}</td>
                    <td>{{ $student->mobile }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->parents_name }}</td>
                    <td>{{ $student->date }}</td>
                    <td>
                        <!-- زر التفاصيل -->
                        <a href="{{ route('director.students.show', $student->id) }}"
                           class="btn btn-sm btn-info">
                            تفاصيل
                        </a>

                        <!-- زر الحذف -->
                        <form action="{{ route('director.students.destroy', $student->id) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟ ⚠️');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">🚫 لا يوجد طلاب بعد</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

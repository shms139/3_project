@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">📋 سجلات التفقد</h2>

        @if($records->isEmpty())
            <div class="alert alert-warning text-center">🚫 لا يوجد سجلات تفقد</div>
        @else
            <table class="table table-bordered table-striped shadow-sm">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم الطالب</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->student->firstname }} {{ $record->student->lastname }}</td>
                        <td>{{ $record->date }}</td>
                        <td>
                            @if($record->status === 'حاضر')
                                <span class="badge bg-success">حاضر</span>
                            @elseif($record->status === 'غائب')
                                <span class="badge bg-danger">غائب</span>
                            @else
                                <span class="badge bg-warning text-dark">متأخر</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

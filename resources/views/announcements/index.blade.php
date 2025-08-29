@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>قائمة الإعلانات</h2>

        {{-- رسائل النجاح --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('announcements.create') }}" class="btn btn-success mb-3">إضافة إعلان جديد</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>العنوان</th>
                <th>المحتوى</th>
                <th>التاريخ</th>
                <th>الصف</th>
            </tr>
            </thead>
            <tbody>
            @forelse($announcements as $item)
                <tr>
                    <td>{{ $item->announcement->title }}</td>
                    <td>{{ $item->announcement->body }}</td>
                    <td>{{ $item->announcement->date }}</td>
                    <td>{{ $item->theClass->name ?? "اعلان عام " }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">لا يوجد إعلانات بعد.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection




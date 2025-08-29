@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>إضافة إعلان جديد</h2>

        {{-- رسائل النجاح --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- رسائل الأخطاء --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('announcements.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" name="title" class="form-control" required maxlength="255">
            </div>

            <div class="form-group">
                <label for="body">المحتوى</label>
                <textarea name="body" class="form-control" rows="4" required maxlength="255"></textarea>
            </div>

            <div class="form-group">
                <label for="date">التاريخ</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="the_class_id">اختر الصف</label>
                <select name="the_class_id" class="form-control" required>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- نخزن المستخدم الحالي كمدير --}}
            <input type="hidden" name="admin_id" value="{{ auth()->id() }}">

            <button type="submit" class="btn btn-primary">حفظ</button>
            <a href="{{ route('announcements.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>
@endsection

@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-primary">➕ تسجيل طالب جديد</h2>

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
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('director.students.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">الاسم الأول</label>
                <input type="text" name="firstname" class="form-control" required maxlength="10">
            </div>

            <div class="mb-3">
                <label class="form-label">الكنية</label>
                <input type="text" name="lastname" class="form-control" required maxlength="10">
            </div>

            <div class="mb-3">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">اسم ولي الأمر</label>
                <input type="text" name="parents_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">وظيفة ولي الأمر</label>
                <input type="text" name="parents_job" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">تاريخ الميلاد</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الصف</label>
                <select name="the_class" class="form-control" required>
                    <option value="first">الأول</option>
                    <option value="second">الثاني</option>
                    <option value="third">الثالث</option>
                    <option value="fourth">الرابع</option>
                    <option value="fifth">الخامس</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">رقم الموبايل</label>
                <input type="text" name="mobile" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الإيميل</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            {{-- هذول غالباً بتعبّيهم من السيستم --}}
            <input type="hidden" name="director_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="p_student_id" value="1">

            <button type="submit" class="btn btn-success">تسجيل</button>
        </form>
    </div>
@endsection

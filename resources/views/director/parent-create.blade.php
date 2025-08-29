@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center text-primary fw-bold">🧑‍👦 تسجيل ولي أمر طالب</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('director.parents.store') }}" method="POST" class="card shadow p-4">
            @csrf

            <div class="mb-3">
                <label class="form-label">الاسم الأول</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الكنية</label>
                <input type="text" name="lastname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">اسم الابن</label>
                <input type="text" name="son_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الموبايل</label>
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

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <button type="submit" class="btn btn-success">💾 حفظ</button>
            <a href="{{ route('director.dashboard') }}" class="btn btn-secondary">↩️ رجوع</a>
        </form>
    </div>
@endsection


@extends('layouts.master')

@section('content')
    <div class="container" style="max-width: 400px; margin-top: 50px;">
        <h2 class="mb-4">تسجيل دخول المدير / الموجه</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="form-group mb-3">
                <label for="password">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
        </form>
    </div>
@endsection

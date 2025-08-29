@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Add Director</h2>

        {{-- رسالة نجاح --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- عرض الأخطاء --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.store-director') }}">
            @csrf

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" required>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
            </div>

            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

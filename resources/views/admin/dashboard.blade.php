@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>لوحة المدير / الموجه</h2>
        <p>مرحباً {{ auth()->user()->email }}</p>
    </div>
@endsection

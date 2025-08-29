@extends('layouts.master')

@section('content')
    <div class="container mt-5">

        {{-- عرض رسالة نجاح --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">🎓 لوحة تحكم الموجه</h2>
            <a href="{{ route('director.logout') }}" class="btn btn-danger">تسجيل الخروج</a>
        </div>

        <div class="row g-4">
            <!-- تسجيل ولي أمر طالب -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">تسجيل ولي أمر طالب</h5>
                        <a href="{{ route('director.parent-create') }}" class="btn btn-outline-primary">إضافة</a>
                    </div>
                </div>
            </div>


            <!-- تسجيل طالب -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-user-plus fa-3x text-success mb-3"></i>
                        <h5 class="card-title">تسجيل طالب</h5>
                        <p class="text-muted">إضافة طالب جديد للنظام</p>
                        <a href="{{ route('director.students.create') }}" class="btn btn-outline-success">إضافة</a>
                    </div>
                </div>
            </div>

            <!-- عرض الطلاب -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">إدارة الطلاب</h5>
                        <p class="text-muted">عرض وحذف الطلاب</p>
                        <a href="{{ route('director.students.index') }}" class="btn btn-outline-primary">عرض</a>
                    </div>
                </div>
            </div>


            <!-- إضافة علامات -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-plus-circle fa-3x text-warning mb-3"></i>
                        <h5 class="card-title">إضافة علامات</h5>
                        <p class="text-muted">إدخال علامات المواد</p>
                        <a href="{{ route('director.marks.create') }}" class="btn btn-outline-warning">إضافة</a>
                    </div>
                </div>
            </div>

            <!-- عرض العلامات -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-clipboard-list fa-3x text-info mb-3"></i>
                        <h5 class="card-title">عرض العلامات</h5>
                        <p class="text-muted">عرض نتائج الطلاب</p>
                        <a href="{{ route('director.marks.index') }}" class="btn btn-outline-info">عرض</a>
                    </div>
                </div>
            </div>

            <!-- إضافة برنامج أسبوعي -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-calendar-plus fa-3x text-success mb-3"></i>
                        <h5 class="card-title">إضافة برنامج أسبوعي</h5>
{{--                        <p class="text-muted">إدخال برنامج جديد</p>--}}
                        <a href="{{ route('director.programs.create') }}" class="btn btn-outline-success">إضافة</a>
                    </div>
                </div>
            </div>

            <!-- عرض البرنامج الأسبوعي -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">عرض البرنامج الأسبوعي</h5>
{{--                        <p class="text-muted">متابعة البرامج</p>--}}
                        <a href="{{ route('director.programs.index') }}" class="btn btn-outline-primary">عرض</a>
                    </div>
                </div>
            </div>

            <!-- أخذ التفقد -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-check-square fa-3x text-dark mb-3"></i>
                        <h5 class="card-title">أخذ التفقد</h5>
                        <p class="text-muted">تسجيل الحضور والغياب</p>
                        <a href="{{ route('director.attendance') }}" class="btn btn-outline-dark">بدء</a>
                    </div>
                </div>
            </div>

            <!-- عرض التفقد -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-lg border-0 rounded-3 h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-list fa-3x text-info mb-3"></i>
                        <h5 class="card-title">عرض التفقد</h5>
                        <p class="text-muted">عرض سجلات الحضور والغياب</p>
                        <a href="{{ route('director.attendance.index') }}" class="btn btn-outline-info">عرض</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

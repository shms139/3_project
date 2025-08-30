@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary mb-4">📅 البرامج الأسبوعية</h2>

{{--        @if($programs->isEmpty())--}}
{{--            <p class="text-center text-muted">🚫 لا توجد برامج أسبوعية بعد</p>--}}
{{--        @else--}}
            <div class="row">
                <h5 class="card-title">🏫 الصف: {{ $program->the_class_id ?? 'غير محدد' }}</h5>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                {{ $program->the_class_id ?? 'غير محدد' }}
                                {{ $program->director_id ?? 'غير محدد' }}
                                رض البرنامج
                                </a>
                            </div>
                        </div>
                    </div>
{{--                @endforeach--}}
            </div>
{{--        @endif--}}
    </div>
@endsection

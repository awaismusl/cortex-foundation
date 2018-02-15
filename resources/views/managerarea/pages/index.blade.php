{{-- Master Layout --}}
@extends('cortex/foundation::managerarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ config('app.name') }} » {{ trans('cortex/foundation::common.managerarea') }}
@endsection

{{-- Main Content --}}
@section('content')

    <div class="content-wrapper">

        {{-- Main content --}}
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa fa-dashboard"></i> {{ trans('cortex/foundation::common.managerarea_welcome') }}</h1>
                    <h4>{{ trans('cortex/foundation::common.managerarea_welcome_body') }}</h4>
                </div>

            </div>

        </section>
    </div>

@endsection

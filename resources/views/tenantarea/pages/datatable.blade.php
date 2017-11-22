{{-- Master Layout --}}
@extends('cortex/foundation::tenantarea.layouts.default')

{{-- Page Title --}}
@section('title')
    {{ config('app.name') }} » {{ trans('cortex/foundation::common.tenantarea') }} » {{ $phrase }}
@stop

{{-- Main Content --}}
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $phrase }}</h1>
            <!-- Breadcrumbs -->
            {{ Breadcrumbs::render() }}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">

                            {!! $dataTable->table(['class' => 'table table-striped table-hover responsive dataTableBuilder', 'id' => "{$id}"]) !!}

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@push('styles')
    <link href="{{ mix('css/datatables.css', 'assets') }}" rel="stylesheet">
@endpush

@push('scripts-vendor')
    <script src="{{ mix('js/datatables.js', 'assets') }}" type="text/javascript"></script>
@endpush

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush

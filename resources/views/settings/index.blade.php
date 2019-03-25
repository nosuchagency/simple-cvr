@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <settings-card inline-template>
                    <div class="card">
                        @include('settings.partials.header')
                        @include('settings.partials.body')
                    </div>
                </settings-card>
            </div>
        </div>
    </div>
@endsection
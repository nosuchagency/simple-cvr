@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <queries-card inline-template>
                    <div class="card">
                        @include('queries.partials.header')
                        @include('queries.partials.body')
                    </div>
                </queries-card>
            </div>
        </div>
    </div>
@endsection

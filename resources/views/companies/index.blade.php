@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <companies-card inline-template>
                    <div class="card">
                        @include('companies.partials.header')
                        @include('companies.partials.body')
                    </div>
                </companies-card>
                <br>
                @include('companies.partials.pagination')
            </div>
        </div>
    </div>
@endsection

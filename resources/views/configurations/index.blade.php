@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-content">
                            <span>Konfigurationer</span>
                            <div class="ml-auto">
                                <b-button variant="primary"
                                          size="sm"
                                          href="{{route('configurations.create')}}"
                                          v-b-tooltip.hover
                                          title="Opret ny konfiguration">
                                    <i class="fas fa-plus"></i>
                                </b-button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Navn</th>
                                <th scope="col">Afvis dubletter</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($configurations as $configuration)
                                <tr>
                                    <td class="align-middle">{{$configuration->name}}</td>
                                    <td class="align-middle">{{$configuration->reject_duplicates ? 'Ja' : 'Nej'}}</td>
                                    <td class="text-center">
                                        <b-button class="mr-2"
                                                  variant="success"
                                                  size="sm"
                                                  v-b-tooltip.hover
                                                  title="Rediger konfiguration"
                                                  href="{{route('configurations.edit', ['configuration' => $configuration])}}">
                                            <i class="fas fa-edit"></i>
                                        </b-button>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($configurations) === 0)
                                <tr>
                                    <td class="text-center"
                                        colspan="7">
                                        Ingen resultater
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

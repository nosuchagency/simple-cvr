<div class="card-body">
    <form method="GET" action="{{route('companies.index')}}">
        <div class="row">
            <div class="col-md-2">
                <div class="input-group">
                    <select class="custom-select"
                            name="pagination">
                        @foreach([50, 100, 500, 1000, 3000] as $number)
                            <option value="{{$number}}" {{$number == $companies->perPage() ? 'selected' : ''}}>
                                {{$number}} pr. side
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 offset-md-3">
                <div class="input-group">
                    <select class="custom-select"
                            name="branch">
                        <option value="">Branchekode</option>
                        @foreach($branches as $bra)
                            <option value="{{$bra}}" {{$bra === $branch ? 'selected' : ''}}>
                                {{$bra}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <select class="custom-select"
                            name="segment">
                        <option value="">Segment</option>
                        @foreach($segments as $seg)
                            <option value="{{$seg}}" {{$seg === $segment ? 'selected' : ''}}>
                                {{$seg}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input type="text"
                           class="form-control"
                           placeholder="Søg..."
                           name="search"
                           value="{{$search}}">
                    <div class="input-group-append">
                        <b-button variant="primary"
                                  type="submit">
                            <i class="fas fa-search"></i>
                        </b-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">CVR</th>
            <th scope="col">Navn</th>
            <th scope="col">Adresse</th>
            <th scope="col">Postnummer</th>
            <th scope="col">By</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            @include('companies.partials.table-row', ['company' => $company])
        @endforeach
        @if($companies->count() === 0)
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
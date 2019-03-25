<div class="card-body">
    <form method="POST" action="{{route('queries.execute')}}">
        @csrf
        <div class="form-group">
            <label>
                Branchekode
                <a target="_blank" href="http://datahub.virk.dk/dataset/branchekoder">
                    (Find koder)
                </a>
            </label>
            <input type="text"
                   name="branch"
                   class="form-control {{ $errors->has('branch') ? 'is-invalid' : '' }}"
                   value="{{ old('branch') }}">
            @if ($errors->has('branch'))
                <span class="text-danger">{{ $errors->first('branch') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>
                Segment
                <i class="fas fa-question-circle"
                   v-b-tooltip.hover
                   title="Angiv segment for udtrækket og det vil være nemmere at fremsøge i listen">
                </i>
            </label>
            <input type="text"
                   name="segment"
                   class="form-control {{ $errors->has('segment') ? 'is-invalid' : '' }}"
                   value="{{ old('segment') }}">
            @if ($errors->has('segment'))
                <span class="text-danger">{{ $errors->first('segment') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>
                Konfiguration
                <i class="fas fa-question-circle"
                   v-b-tooltip.hover
                   title="Benyt en konfiguration for at filtrere resultaterne">
                </i>
            </label>
            <select class="form-control {{ $errors->has('configuration') ? 'is-invalid' : '' }}"
                    name="configuration">
                <option value="">Vælg konfiguration</option>
                @foreach($configurations as $configuration)
                    <option value="{{$configuration->id}}" {{old('configuration') == $configuration->id ? 'selected' : ''}}>
                        {{$configuration->name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('configuration'))
                <span class="text-danger">{{ $errors->first('configuration') }}</span>
            @endif
        </div>
        @if ($errors->has('http_error'))
            <div class="alert alert-danger">
                {{ $errors->first('http_error') }}
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <b-button type="submit"
                  variant="primary"
                  class="float-right"
                  @click="processing = true">
            <template v-if="!processing">
                Kør udtræk
            </template>
            <template v-else>
                <i class="fas fa-sync fa-spin"></i>
            </template>
        </b-button>
    </form>
</div>
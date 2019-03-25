<div class="card-body">
    <form method="POST" action="{{route('settings.update')}}">
        @csrf
        {{method_field('PUT')}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Brugernavn</label>
                <input type="text"
                       name="username"
                       class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                       value="{{ isset($setting) ? $setting->username : old('username') }}">
                @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label>Password</label>
                <input type="text"
                       name="password"
                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       value="{{ isset($setting) ? $setting->password : old('password') }}">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
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
                Gem indstillinger
            </template>
            <template v-else>
                <i class="fas fa-sync fa-spin"></i>
            </template>
        </b-button>
    </form>
</div>
<div class="card-header">
    <div class="card-header-content">
        <span>Virksomhedslisten</span>
        <div class="ml-auto">
            <b-button variant="danger"
                      size="sm"
                      class="mr-2"
                      v-b-tooltip.hover
                      title="Ryd hele listen"
                      @click="purgeList">
                <i class="fas fa-trash" v-if="!purging"></i>
                <i class="fas fa-sync fa-spin" v-else></i>
            </b-button>
            <b-button variant="success"
                      size="sm"
                      v-b-tooltip.hover
                      title="Export til CSV"
                      @click="showExportModal = true">
                <i class="fas fa-file-csv"></i>
            </b-button>
            <portal to="modals"
                    :disabled="!showExportModal">
                <b-modal v-model="showExportModal"
                         ok-title="Export"
                         title="Export til CSV">
                    <form method="GET"
                          action="{{route('companies.export')}}"
                          id="export-form">
                        <input type="hidden"
                               name="branch"
                               value="{{$branch}}">
                        <input type="hidden"
                               name="segment"
                               value="{{$segment}}">
                        <input type="hidden"
                               name="search"
                               value="{{$search}}">
                        <input type="hidden"
                               name="page"
                               value="{{$page}}">
                        <input type="hidden"
                               name="pagination"
                               value="{{$pagination}}">
                        <div class="form-group">
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
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size"
                                       value="full" checked="checked">
                                <label class="form-check-label">
                                    Hele listen ({{$companies->total()}})
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size"
                                       value="partial">
                                <label class="form-check-label">
                                    Nuværende visning ({{$companies->count()}})
                                </label>
                            </div>
                            @if ($errors->has('size'))
                                <span class="text-danger">{{ $errors->first('size') }}</span>
                            @endif
                        </div>
                    </form>
                    <template v-slot:modal-footer>
                        <b-button @click="showExportModal = false">
                            Luk
                        </b-button>
                        <b-button variant="success"
                                  type="submit"
                                  form="export-form">
                            Export
                        </b-button>
                    </template>
                </b-modal>
            </portal>
        </div>
    </div>
</div>
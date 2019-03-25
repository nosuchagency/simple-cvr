<tr>
    <td class="align-middle">{{$company->cvr}}</td>
    <td class="align-middle">{{$company->name}}</td>
    <td class="align-middle">{{$company->address}}</td>
    <td class="align-middle text-center">{{$company->postcode}}</td>
    <td class="align-middle">{{$company->city}}</td>
    <td class="align-middle text-center">
        <i class="fas fa-exclamation-circle {{$company->getTooltipColor()}}"
           title="{{$company->getTooltipText()}}"
           v-b-tooltip.hover>
        </i>
    </td>
    <td class="text-center">
        <form method="POST"
              action="{{route('companies.destroy', [
                  'company' => $company,
                  'branch' => $branch,
                  'segment' => $segment,
                  'search' => $search,
                  'page' => $page,
                  'pagination' => $pagination
              ])}}">
            @csrf
            {{method_field('DELETE')}}
            <b-button type="submit"
                      variant="danger"
                      size="sm"
                      v-b-tooltip.hover
                      title="Slet virksomheden fra listen">
                <i class="fas fa-trash"></i>
            </b-button>
        </form>
    </td>
</tr>
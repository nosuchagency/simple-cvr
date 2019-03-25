<?php

namespace App\Http\Controllers;

use App\Company;
use App\Configuration;
use App\Exports\CompanyExport;
use App\Http\Requests\ExportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CompaniesController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $companies = Company::filter($request)->paginate($request->input('pagination', 50));

        return view('companies.index', [
            'companies' => $companies,
            'segments' => Company::groupBy('segment')->pluck('segment'),
            'branches' => Company::groupBy('branch')->pluck('branch'),
            'configurations' => Configuration::select('id', 'name')->get(),
            'branch' => $request->input('branch'),
            'segment' => $request->input('segment'),
            'search' => $request->input('search'),
            'page' => $request->input('page'),
            'pagination' => $request->input('pagination')
        ]);
    }


    /**
     * @param Request $request
     * @param Company $company
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index', [
            'branch' => $request->input('branch'),
            'segment' => $request->input('segment'),
            'search' => $request->input('search'),
            'page' => $request->input('page'),
            'pagination' => $request->input('pagination'),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purge()
    {
        Company::query()->truncate();

        return redirect()->route('companies.index');
    }

    /**
     * @param ExportRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(ExportRequest $request)
    {
        $companies = Company::active()->filter($request);

        if ($request->input('size') === 'partial') {
            $companies = $companies->paginate($request->input('pagination', 50));
        } else {
            $companies = $companies->get();
        }

        return Excel::download(new CompanyExport($companies), 'export.csv');
    }
}

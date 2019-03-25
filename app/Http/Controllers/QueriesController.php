<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Requests\QueryRequest;
use App\Services\CompanyService;
use App\Services\ElasticSearch;

class QueriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $configurations = Configuration::select('id', 'name')->get();

        return view('queries.index', compact('configurations'));
    }

    /**
     * @param QueryRequest $request
     * @param ElasticSearch $client
     * @param CompanyService $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function execute(QueryRequest $request, ElasticSearch $client, CompanyService $service)
    {
        $branch = $request->get('branch');

        if ($configuration = $request->get('configuration')) {
            $client->applyConfiguration(Configuration::find($configuration));
        }

        try {
            $companies = $client->getCompanies($branch);
        } catch (\Exception $exception) {
            return back()->withErrors(['http_error' => [__('errors.' . $exception->getCode())]])->withInput();
        }

        foreach ($companies as $company) {
            $service->create(
                $request->get('segment'),
                $branch,
                $company
            );
        }

        return redirect()->route('queries.index')->with('message', 'Kørsel af udtræk færdig!');
    }
}

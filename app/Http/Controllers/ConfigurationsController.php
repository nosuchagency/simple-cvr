<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Requests\ConfigurationRequest;

class ConfigurationsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $configurations = Configuration::all();

        return view('configurations.index', compact('configurations'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('configurations.create');
    }

    /**
     * @param ConfigurationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConfigurationRequest $request)
    {
        $configuration = Configuration::create($request->validated());

        return redirect()->route('configurations.edit', ['configuration' => $configuration])->with('message', 'Konfiguration oprettet!');
    }

    /**
     * @param Configuration $configuration
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Configuration $configuration)
    {
        return view('configurations.show', ['configuration' => $configuration]);
    }

    /**
     * @param Configuration $configuration
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Configuration $configuration)
    {
        return view('configurations.edit', ['configuration' => $configuration]);
    }

    /**
     * @param ConfigurationRequest $request
     * @param Configuration $configuration
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(ConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->fill($request->validated())->save();

        return redirect()->route('configurations.index');
    }

    /**
     * @param Configuration $configuration
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Configuration $configuration)
    {
        $configuration->delete();

        return redirect()->route('configurations.index');
    }
}

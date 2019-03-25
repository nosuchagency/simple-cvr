<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Setting;
use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $setting = Setting::query()->first();

        return view('settings.index', ['setting' => $setting]);
    }

    /**
     * @param SettingRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingRequest $request)
    {
        $setting = Setting::query()->first();

        if (!$setting) {
            $setting = new Setting();
        }

        $setting->fill($request->validated())->save();

        return redirect()->route('settings.index')->with('message', 'Indstillinger gemt!');
    }
}

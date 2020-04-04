<?php


namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ConfigurationController extends BaseController
{
    public function setActive(Feature $feature, $active = 1)
    {
        $feature->getConfig->update(['active' => (int)$active]);
    }

    public function getConfigurationForm(Feature $feature)
    {
        return $feature->configurationForm();
    }

    public function setData(Request $request, Feature $feature)
    {
        dd($request->all());
    }
}

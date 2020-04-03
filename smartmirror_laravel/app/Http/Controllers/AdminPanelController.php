<?php


namespace App\Http\Controllers;


use App\Feature;
use App\MirrorConfig;
use GuzzleHttp\Client;

class AdminPanelController
{
    public function getConfigurationPage()
    {
        $features = Feature::all();
        return view('panel.configuration', ['features' => $features]);
    }

    public function getExternalAccountsPage()
    {
        return view('panel.external-accounts');
    }

    public function getWebsocketsTestPage()
    {
        $features = MirrorConfig::all();
        return view('panel.test-websockets', ['features'=>$features]);
    }

    public function getHelpPage()
    {
        return view('panel.help');
    }

    public function getInfoPage()
    {
        return view('panel.info');
    }

    public function getChangelogPage()
    {
        $client = new Client();
        $response = $client->request('GET',
            'https://api.github.com/repos/KrzychuW/BlackMirror/commits');
        $data = json_decode($response->getBody()->getContents());
        $commits = collect(array_slice($data, 0, 12))->pluck('commit');
        return view('panel.changelog', ['commits' => $commits]);
    }
}

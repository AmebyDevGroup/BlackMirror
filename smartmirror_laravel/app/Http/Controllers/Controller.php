<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\MirrorConfig;
use App\WeatherCity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Jobs;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test()
    {
        dd('stop');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function help()
    {
        return view('help');
    }

    public function admin()
    {
        $viewData['microsoft'] = $this->loadMicrosoftViewData();
        $viewData['weather_cities'] = WeatherCity::all();
        $viewData['rss'] = $this->loadRssChannels();
        return view('panel.admin', $viewData);
    }

    public function saveConfig(Request $request)
    {
        foreach ($request->except('_token') as $slug => $config) {
            $db_config = MirrorConfig::where('name', $slug)->first();
            if ($db_config) {
                $db_config->update([
                    'active' => $config['enabled'] ?? 0,
                    'data' => $config
                ]);
            } else {
                MirrorConfig::create([
                    'name' => $slug,
                    'active' => $config['enabled'] ?? 0,
                    'data' => $config
                ]);
            }
        }
        $config = MirrorConfig::all();
        $message = [];
        foreach ($config as $config_object) {
            $val = false;
            if ($config_object->active) {
                $val = true;
            }
            $message[$config_object->name] = $val;
        }
        broadcast(new Message('config', $message));
        $this->forceSync();
        return redirect()->back();
    }

    public function forceSync()
    {
        $config = MirrorConfig::where('active', 1)->get();
        foreach ($config as $item) {
            switch ($item->name) {
                case "air":
                    dispatch(new Jobs\SendAirQualityJob());
                    break;
                case "calendar":
                    dispatch(new Jobs\SendCalendarJob());
                    break;
                case "news":
                    dispatch(new Jobs\SendNewsJob());
                    break;
                case "tasks":
                    dispatch(new Jobs\SendTasksJob());
                    break;
                case "weather":
                    dispatch(new Jobs\SendWeatherJob());
                    break;
                case "covid":
                    dispatch(new Jobs\SendCovidJob());
                    break;
            }
        }
    }

    public function loadMicrosoftViewData()
    {
        $viewData = [];
        // Check for flash errors
        if (session('error')) {
            $viewData['error'] = session('error');
            $viewData['errorDetail'] = session('errorDetail');
        }
        // Check for logged on user
        if (session('userName')) {
            $viewData['userName'] = session('userName');
            $viewData['userEmail'] = session('userEmail');
        }
        return $viewData;
    }

    public function loadRssChannels()
    {
        return [
            'https://www.tvn24.pl/najnowsze.xml' => 'TVN24 - najnowsze',
            'https://www.tvn24.pl/wiadomosci-z-kraju,3.xml' => 'TVN24 - kraj',
            'https://www.tvn24.pl/wiadomosci-ze-swiata,2.xml' => 'TVN24 - świat',
            'https://joemonster.org/backend.php' => 'JoeMonster',
            'https://www.gazetaprawna.pl/rss.xml' => 'GazetaPrawna',
            'https://asta24.pl/feed' => 'Asta24 - powiat pilski',
            'https://www.gry-online.pl/rss/news.xml' => 'GryOnline',
        ];
    }

    public function getTasksFolder($provider)
    {
        $folders = [];
        switch ($provider) {
            case 'microsoft':
                $folders = app('\App\Http\Controllers\MicrosoftController')->taskFolders();
                break;
            default:
                break;
        }
        return response()->json($folders);
    }
}

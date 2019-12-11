<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome()
    {
        return view('welcome');
    }

    public function admin()
    {
        $viewData['microsoft'] = $this->loadMicrosoftViewData();
        $viewData['config'] = config('mirror');
        $viewData['weather_cities'] = app('\App\Http\Controllers\WeatherController')->getCities();
        $viewData['rss'] = $this->loadRssChannels();
        return view('panel.admin', $viewData);
    }

    public function saveConfig(Request $request)
    {
        if(config('mirror')) {
            Config::set('tmp_mirror', config('mirror'));
        }
        Config::set('tmp_mirror.tasks.enabled', $request->input('config.tasks'));
        if($request->input('tasks.provider', false)) {
            Config::set('tmp_mirror.tasks.provider', $request->input('tasks.provider'));
        }
        if($request->input('tasks.directory', false)) {
            Config::set('tmp_mirror.tasks.directory', $request->input('tasks.directory'));
        }

        Config::set('tmp_mirror.calendar.enabled', $request->input('config.calendar'));
        if($request->input('calendar.provider', false)) {
            Config::set('tmp_mirror.calendar.provider', $request->input('calendar.provider'));
        }
        if( $request->input('calendar.directory', false)) {
            Config::set('tmp_mirror.calendar.directory', $request->input('calendar.directory'));
        }

        Config::set('tmp_mirror.news.enabled', $request->input('config.news'));
        Config::set('tmp_mirror.weather.enabled', $request->input('config.weather'));
        if($request->input('weather.city', false)) {
            Config::set('tmp_mirror.weather.city', $request->input('weather.city'));
        }
        Config::set('tmp_mirror.air.enabled', $request->input('config.air'));
        if($request->input('air.station', false)) {
            Config::set('tmp_mirror.air.station', $request->input('air.station'));
        }

        $fp = fopen(base_path() .'/config/mirror.php' , 'w');
        fwrite($fp, '<?php return ' . var_export(config('tmp_mirror'), true) . ';');
        fclose($fp);
        Config::set('mirror', config('tmp_mirror'));
        Artisan::call('config:clear');
        return redirect()->back();
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

    public function loadMicrosoftViewData()
    {
        $viewData = [];
        // Check for flash errors
        if (session('error')) {
            $viewData['error'] = session('error');
            $viewData['errorDetail'] = session('errorDetail');
        }
        // Check for logged on user
        if (session('userName'))
        {
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
}

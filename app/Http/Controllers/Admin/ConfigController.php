<?php

namespace App\Http\Controllers\Admin;

use App;
use Storage;
use Artisan;
use Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\MaintenanceModeEnabled;
use App\Notifications\MaintenanceModeDisabled;

class ConfigController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.configs.base');
    }

    public function maintenance()
    {
        $exists = file_exists(storage_path('framework/down'));
        $message = "";
        $retry = "";
        $allowed = "";
        $time = "";
        $days = "";
        $hours = "";
        $minutes = "";
        $emails = config('system.maintenance.emails');

        if ($exists) {
            $content = json_decode(file_get_contents(storage_path('framework/down')), true);
            $message = $content['message'];
            $retry = $content['retry'];
            $allowed = implode(', ', $content['allowed']);
            $time = date('Y-m-d H:s', $content['time']);
            $now = time();
            $days = round(($now - $content['time']) / (60 * 60 * 24));
            $hours = round(($now - $content['time']) / (60 * 60));
            $minutes = round(($now - $content['time']) / (60));
        }

        return view('admin.configs.maintenance', ['maintenance' => [
            "status" => $exists ? 'down' : 'up',
            "message" => $message,
            "retry" => $retry,
            "allowed" => $allowed,
            "time" => $time,
            "days" => $days,
            "hours" => $hours,
            "minutes" => $minutes,
            "emails" => $emails,
        ]]);
    }

    public function setMaintenance(Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        config(['system.maintenance.emails' => $request->input('emails', '')]);

        if ($request->input('status') == 'down') {
            $command = 'down';
            $message = $request->input('message', null);
            $retry = $request->input('retry', null);
            $allowed = explode(',', $request->input('allowed', null));
            $emails = $request->input('emails', '');

            if ($message != null) {
                $command = $command . ' --message="' . $message . '"';
            }

            if ($retry != null) {
                $command = $command . ' --retry=' . $retry;
            }

            if (!in_array($request->ip(), $allowed)) {
                array_push($allowed, $request->ip());
            }

            foreach ($allowed as $key => $allow) {
                if (!empty($allow)) {
                    $command = $command . ' --allow=' . trim($allow);
                }
            }

            Artisan::call($command);

            foreach (explode(',', $emails) as $email) {
                Notification::route('mail', trim($email))
                            ->notify(new MaintenanceModeEnabled($message));
            }

            return redirect()->route('admin.configs.maintenance')->with('status', 'Successfully enabled maintenance mode!');
        } else {
            $emails = $request->input('emails', '');

            Artisan::call('up');

            foreach (explode(',', $emails) as $email) {
                Notification::route('mail', trim($email))
                            ->notify(new MaintenanceModeDisabled());
            }

            return redirect()->route('admin.configs.maintenance')->with('status', 'Successfully disabled maintenance mode!');
        }
    }

    public function base()
    {
        $configs = [
            'app',
            'auth',
            'broadcasting',
            'cache',
            'database',
            'filesystems',
            'hashing',
            'logging',
            'mail',
            'queue',
            'services',
            'session',
            'tinker',
            'view',
            'system',
            'themes',
            'content'
        ];

        $configs = array_filter($configs, function ($config) {
            return Storage::disk('config')->exists($config . '.php');
        });

        return view('admin.configs.base', ['configs' => $configs]);
    }

    public function updateBase(Request $request)
    {
        $request->validate([
            'config' => 'required',
            'content' => 'required'
        ]);

        try {
            $config = $request->input('config');
            $content = $request->input('content');
            Storage::disk('config')->put($config.'.php', $content);
            return response()->json(["result" => "success"]);
        } catch (\Exception $e) {
            abort(400);
        }
    }
}

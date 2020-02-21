<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    const MODULE_SYSTEM = 'system';
    const MODULE_THEMES = 'themes';
    const MODULE_PLUGINS = 'plugins';
    const MODULE_SECURITY = 'security';
    const MODULE_CONTENT = 'content';

    const MODULE_ARRAY = [
        self::MODULE_SYSTEM,
        self::MODULE_THEMES,
        // self::MODULE_PLUGINS,
        // self::MODULE_SECURITY,
        self::MODULE_CONTENT,
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function get($key)
    {
        return self::where('key', $key)->first();
    }

    public static function getValue($key)
    {
        return self::get($key)->value;
    }

    public static function getStorage()
    {
        return config('content.storage.host') . ':' . config('content.storage.port');// . '/';
    }
}

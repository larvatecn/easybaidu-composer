<?php

declare(strict_types=1);

/*
 * This file is part of the EasyBaiduComposer.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyBaiduComposer\Laravel;

use EasyBaiduComposer\EasyBaidu;
use EasyBaiduComposer\Encryption\DefaultEncrypter;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use RuntimeException;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->publishes([
            __DIR__.'/config.php' => config_path('easybaidu-composer.php'),
        ]);

        EasyBaidu::setEncryptionKey(
            $defaultKey = $this->getKey()
        );

        EasyBaidu::withDelegation()
                    ->toHost($this->config('delegation.host'))
                    ->ability($this->config('delegation.enabled'));

        $this->app->when(DefaultEncrypter::class)->needs('$key')->give($defaultKey);
    }

    /**
     * Register routes.
     */
    protected function registerRoutes()
    {
        Route::prefix('easybaidu-composer')->namespace('EasyBaiduComposer\Laravel\Http\Controllers')->group(function () {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->configure();
    }

    /**
     * Register config.
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'easybaidu-composer'
        );
    }

    /**
     * Get the specified configuration value.
     *
     * @param string|null $key
     * @param mixed       $default
     *
     * @return mixed
     */
    protected function config($key = null, $default = null)
    {
        $config = $this->app['config']->get('easybaidu-composer');

        if (is_null($key)) {
            return $config;
        }

        return Arr::get($config, $key, $default);
    }

    /**
     * @return string
     */
    protected function getKey()
    {
        return $this->config('encryption.key') ?: $this->getMd5Key();
    }

    /**
     * @return string
     */
    protected function getMd5Key()
    {
        $ttl = (version_compare(Application::VERSION, '5.8') === -1) ? 30 : 1800;

        return Cache::remember('easybaidu-composer.encryption_key', $ttl, function () {
            throw_unless(file_exists($path = base_path('composer.lock')), RuntimeException::class, 'No encryption key provided.');

            return md5_file($path);
        });
    }
}
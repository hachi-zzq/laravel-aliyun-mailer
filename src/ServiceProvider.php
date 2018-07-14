<?php

namespace Hachi\LaravelAliyunMailer;

/**
 * Created by PhpStorm.
 * DateTime: 2018/7/13 15:38
 * Author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>
 */

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Hachi\Alibaba\Application as AliyunApplication;
use Hachi\LaravelAliyunMailer\Transport\TransportManager as AliyunTransportManager;

class ServiceProvider extends LaravelServiceProvider
{

    /**
     * register custom mail transport
     * @apiVersion 1.0.0
     * @author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>
     */
    public function register()
    {
        $this->registerAliyunServiceProvider($this->app->get('config')['aliyun']);

        $this->app->singleton('swift.transport', function ($app) {
            return new AliyunTransportManager($app);
        });
    }

    /**
     * register alibaba service container
     * @param array $config
     * @author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>
     */
    protected function registerAliyunServiceProvider(array $config)
    {
        $this->app->singleton(AliyunApplication::class, function ($app) use ($config) {
            return new AliyunApplication($config);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php'=>config_path('aliuyn.php')
        ],'aliyun');
    }
}
<?php

namespace Hachi\LaravelAliyunMailer;

/**
 * Created by PhpStorm.
 * DateTime: 2018/7/13 15:38
 * Author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>
 */

use Hachi\LaravelAliyunMailer\Transport\AliyunTransport;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Hachi\Alibaba\Application as AliyunApplication;

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

        /**
         * @var \Illuminate\Mail\TransportManager $transportManager
         */
        $transportManager = $this->app->get('swift.transport');

        $transportManager->extend(AliyunTransport::class, function ($app) {
            /**
             * @var \Illuminate\Contracts\Foundation\Application $app
             */
            return new AliyunTransport();
        });
    }

    /**
     * register alibaba service container
     * @param array $config
     * @author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>
     */
    protected function registerAliyunServiceProvider(array $config)
    {
        $this->app->singleton(AliyunApplication::class,function($config){
           return new AliyunApplication($config);
        });
    }
}
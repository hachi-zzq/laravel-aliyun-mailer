<?php

namespace Hachi\LaravelAliyunMailer\Transport;

use Illuminate\Mail\TransportManager as LaravelTransportManager;


class TransportManager extends LaravelTransportManager
{
    /**
     * 返回阿里云邮件驱动
     * @apiVersion 1.0.0
     * @return AliyunTransport
     * @author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>
     */
    public function createAliyunDriver()
    {
        return new AliyunTransport();
    }
}

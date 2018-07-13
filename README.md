## 基于 `hachi-zzq/alibaba` 的适用于 Laravel 的邮件推送服务

> author:zhuzhengqian<hachi.zzq@gmail.com>


## 如何安装

### composer 引入

```$shell

composer require hachi-zzq/laravel-aliyun-mailer

```

## 开始使用

### 添加配置文件到 config/alibab.php

```php
<?php

/**
 * 阿里云参数配置
 */
return [
    /**
     * access_key_id
     */
    'access_key_id'     => 'access_key_id',

    /**
     * access_key_secret
     */
    'access_key_secret' => 'access_key_secret',

    'response_type' => 'collection',

    /**
     * 邮件推送服务
     */
    'direct_mail'   => [

        /**
         * 发信人，必须与阿里云后台配置的发信人一致
         */
        'from'          => '',

        /**
         * 发信人昵称
         */
        'from_alias'    => '',

        /**
         * 回信地址
         */
        'reply_address' => false
    ]
];

```

### 注册serviceProvider

在 config/app.php 的 ``providers`` 数组中添加如下

```php

 Hachi\LaravelAliyunMailer\ServiceProvider::class

```
## 适用

适用方法和 Laravel 本身的 Mail 使用方法一致。















 
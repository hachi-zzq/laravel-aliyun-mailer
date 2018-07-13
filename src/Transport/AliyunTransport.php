<?php

namespace Hachi\LaravelAliyunMailer\Transport;

use Hachi\Alibaba\Application;
use Hachi\Alibaba\DirectMail\HtmlMessage;
use Hachi\Alibaba\DirectMail\TextMessage;
use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;

/**
 * Created by PhpStorm.
 * DateTime: 2018/7/13 15:48
 * Author: Zhengqian.zhu <zhuzhengqian@vchangyi.com>
 */
class AliyunTransport extends Transport
{
    /**
     * Send the given Message.
     *
     * Recipient/sender data will be retrieved from the Message API.
     * The return value is the number of recipients who were accepted for delivery.
     *
     * @param Swift_Mime_SimpleMessage $message
     * @param string[] $failedRecipients An array of failures by-reference
     *
     * @return int
     * @throws \Hachi\Alibaba\Kernel\Exceptions\MailSendException
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        /**
         * @var \Hachi\Alibaba\Application $aliyunApplication
         */
        $aliyunApplication = app(Application::class);

        $messageContent = $message->getContentType();

        if ($messageContent === 'text/html') {
            $mailContent = new HtmlMessage($message->getBody());
        } else {
            $mailContent = new TextMessage($message->getBody());
        }

        $aliyunApplication->direct_mail->singleSend(array_keys($message->getTo()), $mailContent, null, $message->getSubject());

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }
}
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class GeneralNotification extends Notification
{
    use Queueable;
    public $options;

    public function __construct($options=[])
    {
        array_merge([
            'content'           => "",
            'action_url'        => env("APP_URL"),
            'btn_text'          => env("APP_NAME"),
            'methods'           => ['database'],
            'image'             => env("DEFAULT_IMAGE_AVATAR"),
            'inline_content'    => ""
        ], $options);
        $this->options = $options;
        $this->options['inline_content']=implode("\n", $options['content']);
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject(__("You have a new notification"))
                ->greeting(__("Welcome!"))
                ->line($this->options['inline_content'])
                ->action($this->options['btn_text'], $this->options['action_url']);
    }
    public function toArray($notifiable)
    {
        $content = $this->options['inline_content'];
        return [
            'message'=> $content,
            'image'=> $this->options['image'],
        ];
    }
}

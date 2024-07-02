<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class AnggotaRegisterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $offerData;
    public $tries = 2;
    public $maxExceptions = 3;
    public $timeout = 120;

    public function __construct(array $msg)
    {
        $this->queue = 'default';
        $this->offerData= $msg;
        // $this->idTele= -4259907184;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ["mail", TelegramChannel::class];
        return [TelegramChannel::class];

        // return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $url = "www.iwpi.info/login";

        return TelegramMessage::create()
            ->options([
                'disable_web_page_preview' => true
            ])
            // ->to(env('TELEGRAM_ID_CHAT_ADMIN', '-4259907184'))
            ->content("\xF0\x9F\x94\x94*".$this->offerData['title']."*\n".$this->offerData['message'])
            ->button('Buka Halaman Admin', $url);
            // ->button('Download Invoice', $url);
            // (Optional) Inline Button with callback. You can handle callback in your bot instance
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Registrasi Anggota IWPI Baru')
                    ->greeting('Pemberitahuan!')
                    ->line(new HtmlString(\str_replace("\n","<br>", $this->offerData['message'])) )
                    ->line('Baca selengkapnya dengan klik tombol dibawah ini untuk menuju ke halaman admin.')
                    ->action('Buka Halaman Admin', url('/login'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

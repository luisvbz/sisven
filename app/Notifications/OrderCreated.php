<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $order;
    private $creator;
    public function __construct(Order $order, User $creator)
    {
        $this->order = $order;
        $this->creator = $creator;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject("Nueva compra registrada")
                    ->greeting("Hola, **{$notifiable->name}**.")
                    ->line("El usuario **{$this->creator->name}** ha registrado una nueva compra, por el monto de: **{$this->order->cost}**, al proveedor **{$this->order->supplier->name}**")
                    ->action('VER DETALLES DE LA COMPRA', route('co.details', [$this->order->id]))
                    ->line('Enviado automáticamente');
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
            'creator' => $this->creator->name,
            'link' => route('co.details', [$this->order->id]),
            'cost' => $this->order->cost,
            'supplier' => $this->order->supplier->name
        ];
    }
}

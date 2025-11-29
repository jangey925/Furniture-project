<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductAdded extends Notification implements ShouldQueue
{
    use Queueable;

    public $productName;
    public $categoryId;
    public $productId;

    public function __construct($productName, $categoryId, $productId)
    {
        $this->productName = $productName;
        $this->categoryId = $categoryId;
        $this->productId = $productId;
    }

  
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

  
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Product Added',
            'message' => "A new product '{$this->productName}' has been added.",
            'category_id' => $this->categoryId,
            'product_id' => $this->productId,
            //'product_url' => route('products.showdetails', ['id' => $this->productId]),
             //'product_url' => route('products.showdetails', ['id' => $notification->data['product_id']]),


        ];
    }

   
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Product Added')
            ->line("A new product '{$this->productName}' has been added to the category.")
            ->action('View Product', route('products.showdetails', ['id' => $notification->data['product_id']]))
            ->line('Thank you for using our application!');
    }
}

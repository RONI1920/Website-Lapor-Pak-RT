<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Laporan;

class LaporanStatusUpdate extends Notification
{
    use Queueable;

    public $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        // 1. Tentukan Pesan Berdasarkan Siapa Penerimanya
        $pesan = '';

        if ($notifiable->usertype == 'admin') {
            // Jika penerima adalah Admin
            $pesan = 'Laporan Baru Masuk dari Warga: ' . $this->laporan->judul;
        } else {
            // Jika penerima adalah Warga (User biasa)
            $pesan = 'Status laporan Anda diperbarui menjadi: ' . strtoupper($this->laporan->status);
        }

        // 2. Simpan ke Database
        return [
            'laporan_id' => $this->laporan->id,
            'judul' => $this->laporan->judul, // Judul Laporan
            'pesan' => $pesan,                // Pesan yang sudah disesuaikan di atas
            'status' => $this->laporan->status,
        ];
    }


    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }
}

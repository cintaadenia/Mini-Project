<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class DokterAssignedNotification extends Notification
{
    use Queueable;

    protected $kunjungan;

    /**
     * Create a new notification instance.
     */
    public function __construct($kunjungan)
    {
        $this->kunjungan = $kunjungan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Dokter telah ditugaskan untuk kunjungan ini.',
            'kunjungan_id' => $this->kunjungan->id,
            'dokter_id' => $this->kunjungan->dokter_id,
            'assigned_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Dokter telah ditugaskan untuk kunjungan ini.',
            'kunjungan_id' => $this->kunjungan->id,
            'dokter_id' => $this->kunjungan->dokter_id,
            'dokter_nama' => $this->kunjungan->dokter->nama,
            'kunjungan_nama' => $this->kunjungan->pasien->nama,
            'assigned_at' => now()->toDateTimeString(),
        ];
    }
}

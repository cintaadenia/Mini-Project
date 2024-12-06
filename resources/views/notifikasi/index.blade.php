<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifikasi</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Notifikasi</h1>
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item">
                    {{ $notification->data['message'] }} untuk kunjungan ID: {{ $notification->data['kunjungan_id'] }}
                    <br>Dokter: {{ $notification->data['dokter_id'] }}
                    <small class="text-muted">Diterima: {{ $notification->created_at->diffForHumans() }}</small>
                    @if(is_null($notification->read_at))
                        <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-primary btn-sm">Tandai sebagai dibaca</a>
                    @else
                        <span class="text-muted">Dibaca</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
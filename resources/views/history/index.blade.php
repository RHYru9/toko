@extends('v_layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Riwayat Pesanan</h2>
        <div>
            <a href="{{ route('beranda') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali Berbelanja
            </a>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> Anda belum memiliki riwayat pesanan.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>Rp {{ number_format($order->final_price, 0, ',', '.') }}</td>
                            <td>{!! $order->status_badge !!}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{
                                        in_array($order->status, ['processing', 'shipped'])
                                        ? route('history.edit', $order->id)
                                        : route('history.show', $order->id)
                                    }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>

                                    <a href="{{ route('history.invoice', $order->id) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                        <i class="fas fa-file-invoice me-1"></i> Invoice
                                    </a>
                                    @if($order->status === 'pending')
                                        <button class="btn btn-sm btn-success pay-button" data-order-id="{{ $order->id }}">
                                            <i class="fas fa-credit-card me-1"></i> Bayar
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>

@if(config('services.midtrans.client_key'))
    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');

                // Show loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Memproses...';
                this.disabled = true;

                // Get Snap token via AJAX
                fetch(`/history/${orderId}/snap-token`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.snap_token) {
                            // Open Snap popup
                            snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    window.location.reload();
                                },
                                onPending: function(result) {
                                    window.location.reload();
                                },
                                onError: function(result) {
                                    window.location.reload();
                                },
                                onClose: function() {
                                    button.innerHTML = '<i class="fas fa-credit-card me-1"></i> Bayar';
                                    button.disabled = false;
                                }
                            });
                        } else {
                            alert('Gagal memproses pembayaran: ' + (data.error || 'Unknown error'));
                            button.innerHTML = '<i class="fas fa-credit-card me-1"></i> Bayar';
                            button.disabled = false;
                        }
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan: ' + error.message);
                        button.innerHTML = '<i class="fas fa-credit-card me-1"></i> Bayar';
                        button.disabled = false;
                    });
            });
        });
    </script>
@endif
@endsection

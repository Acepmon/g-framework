@if ($payment_method)
    @if (request()->route()->getName() === 'admin.modules.payment.payment_methods.show')
        <div class="media">
            <img src="{{ $payment_method->image() }}" alt="{{ $payment_method->name }}" class="img-fluid mr-3" style="max-width: 20px; height: auto;">
            <div class="media-body">
                {{ $payment_method->name }}
            </div>
        </div>
    @else
        <a href="{{ route('admin.modules.payment.payment_methods.show', $payment_method->code) }}">
            <div class="media">
                <img src="{{ $payment_method->image() }}" alt="{{ $payment_method->name }}" class="img-fluid mr-3" style="max-width: 20px; height: auto;">
                <div class="media-body">
                    {{ $payment_method->name }}
                </div>
            </div>
        </a>
    @endif
@endif
@extends('themes.limitless.layouts.default')

@section('title', 'Payment Transactions')

@section('load-before')

@endsection

@section('load')

@endsection

@section('pageheader')
    @include('payment::admin.payment.transactions.includes.pageheader')
@endsection

@section('content')
<div class="card">
    @if (session('status'))
        <div id="timer" class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (isset($status))
        <div id="timer" class="alert alert-success">
            {{ $status }}
        </div>
    @endif
    <div class="table-responsive" id="accordion-control">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Payment Method</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Usage</th>
                    <th>Bonus</th>
                    <th>Current Amount</th>
                    <th>Accepted By</th>
                </tr>
            </thead>
            @foreach ($transactions as $group => $groupTransactions)
                <tr>
                    <th colspan="9" class="table-active">
                        <a data-toggle="collapse" class="text-default text-capitalize" href="#accordion-control-{{ $group }}">{{ $group }} ({{$groupTransactions->count()}})</a>
                    </th>
                </tr>
                <tbody id="accordion-control-{{ $group }}" class="collapse {{ $group == \Modules\Payment\Entities\Transaction::STATUS_PENDING ? 'show' : '' }}" data-parent="#accordion-control">
                    @foreach($groupTransactions as $transaction)
                        <tr>
                            <td>{{$transaction->id}}</td>
                            <td>
                                @include('themes.limitless.includes.user-media', ['user' => $transaction->user ])
                            </td>
                            <td>{{$transaction->get_payment_method->name}}</td>
                            <td>{{$transaction->transaction_type}}</td>
                            <td>{{$transaction->transaction_amount}}</td>
                            <td>{{$transaction->transaction_usage}}</td>
                            <td>{{$transaction->bonus}}</td>
                            <td>{{$transaction->current_amount}}</td>
                            <td class="text-center">
                                @if($transaction->status ==  \Modules\Payment\Entities\Transaction::STATUS_PENDING)
                                <a class="btn btn-success color-white" href="{{ route('admin.modules.payment.transactions.edit', ['id' => $transaction->id]) }}">Accept</a>
                                <!--<a class="btn btn-success color-white" href="#modal_accept" data-toggle="modal" onclick="accept_transaction({{ $transaction->id }})">Accept</a>-->
                                @else
                                @include('themes.limitless.includes.user-media', ['user' => $transaction->acceptedBy ])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endforeach
        </table>
    </div>
</div>
<!-- Danger modal -->
<div id="modal_accept" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Accept?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to accept this transaction?</p>
            </div>

            <div class="modal-footer">
                <form method="POST" id="accept_form">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <input type="hidden" name="status" value="{{ \Modules\Payment\Entities\Transaction::STATUS_ACCEPTED }}" />
                    <input type="hidden" name="accepted_by" value="{{ Auth::user()->id }}" />

                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Accept</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /default modal -->
@endsection

@section('script')
<script>
    window.accept_transaction = function(id) {
        $("#accept_form").attr('action', '/admin/modules/payment/transactions/'+id);
    }

    //setTimeout(function(){ document.getElementById("timer").remove() }, 10000);
</script>
@endsection


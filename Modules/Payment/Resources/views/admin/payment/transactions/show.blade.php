@extends('themes.limitless.layouts.default')

@section('title', 'Transaction Details')

@section('load-before')

@endsection

@section('load')

@endsection

@section('pageheader')
    @include('payment::admin.payment.transactions.includes.pageheader')
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-lg-8">

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">
                        Transaction <strong>#{{ $transaction->id }}</strong>
                    </h6>

                    <div class="header-elements">
                    @if($transaction->status == \Modules\Payment\Entities\Transaction::STATUS_PENDING)
                        <a type="button" class="btn btn-success btn-sm" href="{{ route('admin.modules.payment.transactions.edit', ['id' => $transaction->id]) }}">
                            <span class="icon-check mr-2"></span>
                            Accept or Reject
                        </a>
                        @elseif($transaction->status == \Modules\Payment\Entities\Transaction::STATUS_ACCEPTED)
                        <button type="button" class="btn btn-success btn-sm">
                            <span class="icon-check mr-2"></span>
                            Accepted
                        </button> 
                        @elseif($transaction->status == \Modules\Payment\Entities\Transaction::STATUS_REJECTED)
                        <button type="button" class="btn btn-danger btn-sm">
                            <span class="icon-x mr-2"></span>
                            Rejected
                        </button> 
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">User: </label>
                        <div class="col-lg-10">
                            @include('themes.limitless.includes.user-media', ['user' => $transaction->user ])
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction type: </label>
                        <div class="col-lg-10">
                            {{ $transaction->transaction_type }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Payment method: </label>
                        <div class="col-lg-10">
                            {{ $transaction->get_payment_method->code }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction amount: </label>
                        <div class="col-lg-10">
                            {{ $transaction->transaction_amount }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction usage: </label>
                        <div class="col-lg-10">
                            {{ $transaction->transaction_usage }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction usage: Content: </label>
                        <div class="col-lg-10">
                            {{ $transaction->content?$transaction->content->slug:'None' }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Bonus: </label>
                        <div class="col-lg-10">
                            {{ $transaction->bonus }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Phone: </label>
                        <div class="col-lg-10">
                            {{ $transaction->phone }}
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
</div>
@endsection

@section('script')

@endsection


@extends('themes.limitless.layouts.default')

@section('title', 'Transaction Details')

@section('load-before')

@endsection

@section('load')
    <script src="{{ asset('/limitless/bootstrap4/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('payment::admin.payment.transactions.includes.pageheader')
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-lg-8">

        <form action="{{ route('admin.modules.payment.transactions.update', $transaction->id) }}" method="POST" class="form-horizontal">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">
                        Transaction <strong>#{{ $transaction->id }}</strong>
                    </h6>

                    @if($transaction->status == \Modules\Payment\Entities\Transaction::STATUS_PENDING)
                    <div class="header-elements">
                        <button type="submit" name="status" value="{{ \Modules\Payment\Entities\Transaction::STATUS_REJECTED }}" class="btn btn-danger btn-sm">
                            <span class="icon-x mr-2"></span>
                            Reject
                        </button>&nbsp;
                        <button type="submit" name="status" value="{{ \Modules\Payment\Entities\Transaction::STATUS_ACCEPTED }}" class="btn btn-success btn-sm">
                            <span class="icon-check mr-2"></span>
                            Accept
                        </button> 
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="accepted_by" value="{{ \Auth::user()->id }}"/>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">User: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" placeholder="User..." value="{{ $transaction->user->name }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction type: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="transaction_type" placeholder="Transaction type..." value="{{ $transaction->transaction_type }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Payment method: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" placeholder="Payment method..." value="{{ $transaction->get_payment_method->code }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction amount: <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="transaction_amount" placeholder="Transaction amount..." value="{{ $transaction->transaction_amount }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction usage: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="transaction_usage" placeholder="Transaction usage..." value="{{ $transaction->transaction_usage }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction usage: Content: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" placeholder="Content..." value="{{ $transaction->content?$transaction->content->slug:'' }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Bonus: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="bonus" placeholder="Transaction Bonus..." value="{{ $transaction->bonus }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Phone: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="phone" placeholder="Phone..." value="{{ $transaction->phone }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
</div>
@endsection

@section('script')
@endsection


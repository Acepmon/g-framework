@extends('themes.limitless.layouts.default')

@section('title', 'New Payment Method')

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

        <form action="{{ route('admin.modules.payment.transactions.store') }}" method="POST" class="form-horizontal">
            @csrf

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">
                        New Transaction
                    </h6>

                    <div class="header-elements">
                        <button type="submit" name="status" value="{{ \Modules\Payment\Entities\Transaction::STATUS_ACCEPTED }}" class="btn btn-success btn-sm">
                            <span class="icon-check mr-2"></span>
                            Save
                        </button> 
                    </div>
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
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="text" class="form-control" placeholder="User..." value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction type: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="transaction_type" placeholder="Transaction type..." value="income" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Payment method: </label>
                        <div class="col-lg-10">
                            <select class="form-control" name="payment_method">
                                @foreach(Modules\Payment\Entities\PaymentMethod::where('enabled', true)->get() as $method)
                                    <option value="{{ $method->id }}">{{ $method->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction amount: <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="transaction_amount" placeholder="Transaction amount..." value="0" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Transaction usage: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="transaction_usage" placeholder="Transaction usage..." value="bonus" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Bonus: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="bonus" placeholder="Transaction Bonus...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Phone: </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="phone" placeholder="Phone..." value="{{ $user->metaValue('phone') }}" readonly>
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


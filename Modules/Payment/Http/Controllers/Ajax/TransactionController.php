<?php

namespace Modules\Payment\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Modules\Payment\Entities\PaymentMethod;
use Modules\Payment\Entities\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pending = Transaction::where('status', Transaction::STATUS_PENDING)->get();
        $accepted = Transaction::where('status', Transaction::STATUS_ACCEPTED)->get();
        $transactions = [
            Transaction::STATUS_PENDING => $pending,
            Transaction::STATUS_ACCEPTED => $accepted
        ];

        return view('payment::admin.payment.transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $transaction = Transaction::create($request->input());

        return response()->json(['message'=> 'success'])->setStatusCode(200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('payment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('payment::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $transaction = Transaction::findOrFail($id);

        try {
            DB::beginTransaction();
            $transaction->status = $request->input('status');
            $transaction->accepted_by = $request->input('accepted_by');
            $cash = $transaction->user->metaValue('cash');
            $cash = $cash + $transaction->transaction_amount;
            $transaction->user->setMetaValue('cash', $cash);
            $transaction->save();
            DB::commit();

            return redirect()->route('admin.modules.payment.transactions.index')->with('success', 'Accepted');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.modules.payment.transactions.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

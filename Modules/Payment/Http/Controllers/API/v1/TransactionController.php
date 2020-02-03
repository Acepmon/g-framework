<?php

namespace Modules\Content\Transformers\Author;
namespace Modules\Payment\Http\Controllers\API\v1;

use Modules\Payment\Entities\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $authUser = auth('api')->user();
        $transactions = Transaction::where('user_id', $authUser->id);
        
        $transactions->getCollection()->transform(function ($content) use ($authUser) {
            return [
                "id" => $this->id,
                "payment_method" => $this->payment_method,
                "transaction_type" => $this->transaction_type,
                "transaction_amount" => $this->transaction_amount,
                "transaction_usage" => $this->transaction_usage,
                "bonus" => $this->bonus,
                "current_amount" => $this->current_amount,
                "status" => $this->status,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
                "user" => new Author($this->user),
                "accepted_by" => new Author($this->accepted_by),
                "phone" => $this->phone,
                "content" => $this->content_id
            ];
        });

        return response()->json($transactions);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('payment::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $authUser = auth('api')->user();
        $transaction = new Transaction();
        $transaction->user_id = $authUser->id;
        $transaction->payment_method = $request->input('payment_method', 1);
        $transaction->transaction_type = $request->input('transaction_type', 'income');
        $transaction->transaction_amount = $request->input('transaction_amount', 0);
        $transaction->transaction_usage = $request->input('transaction_usage', 'basic');
        $transaction->bonus = $request->input('bonus', 0);
        $transaction->status = $request->input('status', Transaction::STATUS_PENDING);
        $transaction->transaction_usage = $request->input('transaction_usage', 'basic');
        $transaction->phone = $request->input('phone', Null);
        $transaction->content_id = $request->input('content_id', Null);
        $transaction->save();

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

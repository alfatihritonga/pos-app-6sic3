<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DetailTransactionController extends Controller
{
    public function showDetail($id)
    {
        $transaction = Transaction::with('details.product')
            ->where('id', $id)
            ->first();

        // return response()->json($transaction);

        return view('pages.transaction.detail', compact('transaction'));
    }

    public function print($id)
    {
        $transaction = Transaction::with('details.product')
            ->where('id', $id)
            ->first();

        $pdf = Pdf::loadView('pages.report.struct', ['transaction' => $transaction]);
        return $pdf->stream('struk_' . now() . '.pdf');
    }
}

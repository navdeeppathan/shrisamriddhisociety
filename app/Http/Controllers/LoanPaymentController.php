<?php

namespace App\Http\Controllers;

use App\Models\LoanPayment;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanPaymentController extends Controller
{
    public function index()
    {
        $payments = LoanPayment::with('loan.user')->latest()->get();
        $loans = Loan::with('user')->get();

        return view('admin.loan-payments.index', compact('payments','loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required',
            'installment' => 'required|numeric',
            'interest' => 'nullable|numeric',
            'date' => 'required|date'
        ]);

        $total = $request->installment + ($request->interest ?? 0);

        LoanPayment::create([
            'loan_id' => $request->loan_id,
            'installment' => $request->installment,
            'interest' => $request->interest,
            'total_paid' => $total,
            'date' => $request->date
        ]);

        return back()->with('success','Loan payment added successfully');
    }

    public function update(Request $request,$id)
    {
        $payment = LoanPayment::findOrFail($id);

        $request->validate([
            'loan_id' => 'required',
            'installment' => 'required|numeric',
            'interest' => 'nullable|numeric',
            'date' => 'required|date'
        ]);

        $total = $request->installment + ($request->interest ?? 0);

        $payment->update([
            'loan_id' => $request->loan_id,
            'installment' => $request->installment,
            'interest' => $request->interest,
            'total_paid' => $total,
            'date' => $request->date
        ]);

        return back()->with('success','Loan payment updated successfully');
    }

    public function destroy($id)
    {
        LoanPayment::findOrFail($id)->delete();

        return back()->with('success','Loan payment deleted');
    }

    public function userindex()
    {
        $payments = LoanPayment::with('loan')
            ->whereHas('loan', function($q){
                $q->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('user.loan_payments.index', compact('payments'));
    }
}
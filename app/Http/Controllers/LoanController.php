<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user')->latest()->get();
        $users = User::orderBy('name')->get();

        return view('admin.loans.index', compact('loans','users'));
    }

    public function userindex()
    {
        $loans = Loan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.loans.index', compact('loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'loan_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'loan_date' => 'required|date',
        ]);

        Loan::create([
            'user_id' => $request->user_id,
            'loan_amount' => $request->loan_amount,
            'interest_rate' => $request->interest_rate,
            'remaining_amount' => $request->loan_amount,
            'loan_date' => $request->loan_date
        ]);

        return back()->with('success','Loan added successfully');
    }

    public function update(Request $request,$id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'user_id' => 'required',
            'loan_amount' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'remaining_amount' => 'required|numeric',
            'loan_date' => 'required|date',
        ]);

        $loan->update($request->all());

        return back()->with('success','Loan updated successfully');
    }

    public function destroy($id)
    {
        Loan::findOrFail($id)->delete();

        return back()->with('success','Loan deleted successfully');
    }
}
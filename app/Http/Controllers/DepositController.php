<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->get();
        $users = User::orderBy('name')->get();

        return view('admin.deposits.index', compact('deposits','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'amount' => 'required|numeric',
            'deposit_date' => 'required|date',
            'month' => 'required',
            'year' => 'required'
        ]);

        Deposit::create($request->all());

        return back()->with('success','Deposit added successfully');
    }

    public function update(Request $request,$id)
    {
        $deposit = Deposit::findOrFail($id);

        $request->validate([
            'user_id' => 'required',
            'amount' => 'required|numeric',
            'deposit_date' => 'required|date',
            'month' => 'required',
            'year' => 'required'
        ]);

        $deposit->update($request->all());

        return back()->with('success','Deposit updated successfully');
    }

    public function destroy($id)
    {
        Deposit::findOrFail($id)->delete();

        return back()->with('success','Deposit deleted successfully');
    }

    public function userindex()
    {
        $deposits = Deposit::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.deposits.index', compact('deposits'));
    }
}
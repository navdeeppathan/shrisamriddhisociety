<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Loan;

use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {

        $totalMembers = User::where('role','user')->count();

        $totalDeposits = Deposit::sum('amount');

        $totalLoans = Loan::sum('loan_amount');

        $totalRemaining = Loan::sum('remaining_amount');

        return view('dashboard',compact(
        'totalMembers',
        'totalDeposits',
        'totalLoans',
        'totalRemaining'
        ));

    }


    public function userindex()
    {

        $totalMembers = User::where('role','user')->count();

        $totalDeposits = Deposit::sum('amount');

        $totalLoans = Loan::sum('loan_amount');

        $totalRemaining = Loan::sum('remaining_amount');

        return view('user.dashboard',compact(
        'totalMembers',
        'totalDeposits',
        'totalLoans',
        'totalRemaining'
        ));

    }


}

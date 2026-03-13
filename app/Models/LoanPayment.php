<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $table = 'loan_payments';

    protected $fillable = [
        'loan_id',
        'installment',
        'interest',
        'total_paid',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
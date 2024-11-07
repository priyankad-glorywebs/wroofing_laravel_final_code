<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('layouts.front.payments');
    }
    public function getPaymentsData(Request $request)
    {
        $transactions = Transaction::select([
            'transactions.id',
            'projects.id AS p_id',  // Alias for project title
            DB::raw('TO_BASE64(projects.id) AS project_id'),
            'projects.title AS project_title',  // Alias for project title
            'users.name AS customer_name',       // Alias for customer name
            DB::raw("DATE_FORMAT(transactions.created_at, '%m/%d/%Y') AS payment_date"), // Convert to MM/DD/YYYY
            'transactions.amount AS amount_paid',
            'transactions.payment_status'
        ])
            ->join('users', 'transactions.customer_id', '=', 'users.id')
            ->join('projects', 'transactions.project_id', '=', 'projects.id');

        // Custom search functionality
        if ($request->has('search') && $request->search['value']) {
            $searchValue = $request->search['value'];
            $transactions->where(function ($query) use ($searchValue) {
                // Only search in the users and projects tables
                $query->whereRaw('LOWER(projects.title) LIKE ?', ['%' . strtolower($searchValue) . '%'])
                    ->orWhereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($searchValue) . '%']);
            });
        }

        // Return data for DataTables
        return DataTables::of($transactions)
            ->addColumn('amount_paid', function ($transaction) {
                return number_format($transaction->amount_paid, 2);
            })
            ->make(true);
    }
}

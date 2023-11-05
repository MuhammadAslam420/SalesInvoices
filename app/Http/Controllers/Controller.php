<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function generatePDF($id)
    {
        $setting = Setting::find(1);
        $sale = Sale::find($id);
        $pdf = Pdf::loadView('myPDF', compact('sale','setting'));
        return $pdf->download('sale.pdf');
    }
    public function genrateSalesLedger()
    {
        $setting = Setting::find(1);
        $sales = Sale::get();
        $pdf = Pdf::loadView('salespdf',compact('sales','setting'));
        return $pdf->download('sales.pdf');
    }
    public function generateCustomerPdf($id)
    {
        $setting = Setting::find(1);
        $customer = Customer::find($id);
        $pdf = Pdf::loadView('customerPdf',compact('customer','setting'));
        return $pdf->download('customer.pdf');
    }
    public function generateTransactionPdf($id)
    {

        $transaction = Transaction::find($id);
        $setting = Setting::find(1);
        $pdf = Pdf::loadView('transactionPdf',compact('transaction','setting'));
        return $pdf->download('transaction.pdf');
    }
    public function generateByCustomer(Request $request)
    {
        $customer =Customer::find( $request->input('customer_id'));
        $sales = Sale::where('customer_id', $customer->id)->get();
        $setting = Setting::find(1);
        $pdf = PDF::loadView('customer_sale', compact('sales','setting','customer'));
        return $pdf->download('sales.pdf');
    }

    public function generateByDateRange(Request $request)
    {
        $startDate = $request->input('sdate');
        $endDate = $request->input('edate');

        if (!$startDate || !$endDate) {
            return response()->json(['error' => 'Please provide both start_date and end_date.']);
        }

        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->get();
        $setting = Setting::find(1);
        $pdf = PDF::loadView('date_wise', compact('sales','setting'));
        return $pdf->download('date_wise_sale.pdf');
    }

    public function generateByCustomerCompany(Request $request)
    {
        $company = $request->input('country_id');
        $date = $request->input('date');

        if ($company) {
            $customers = Customer::where('country_id', $company)->pluck('id');
            $query = Sale::whereIn('customer_id', $customers);

            if ($date) {
                $query->whereDate('sale_date', $date);
            }

            $sales = $query->get();
        } else {
            return response()->json(['error' => 'Please provide country_id.']);
        }
        $setting = Setting::find(1);
        $pdf = PDF::loadView('company_wise', compact('sales','setting'));
        return $pdf->download('company_wise_sale.pdf');
    }
    public function todayPdf()
    {
        $setting = Setting::find(1);
        $transactions = Transaction::where('created_at',Carbon::today())->get();
        $pdf = Pdf::loadView('today_transactions',compact('transactions','setting'));
        return $pdf->download('today_transactions.pdf');
    }
    public function lastWeekPdf()
    {
        $setting = Setting::find(1);
        $startDate = Carbon::today()->subWeek();
        $endDate = Carbon::today();

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();

        $pdf = PDF::loadView('last_week_transactions', compact('transactions', 'setting'));
        return $pdf->download('last_week_transactions.pdf');
    }
    public function last15DaysPdf()
    {
        $setting = Setting::find(1);
        $startDate = Carbon::today()->subDays(15);
        $endDate = Carbon::today();

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();

        $pdf = PDF::loadView('last_15_days_transactions', compact('transactions', 'setting'));
        return $pdf->download('last_15_days_transactions.pdf');
    }

    public function lastMonthPdf()
    {
        $setting = Setting::find(1);
        $startDate = Carbon::today()->subMonthNoOverflow();
        $endDate = Carbon::today();

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();

        $pdf = PDF::loadView('last_month_transactions', compact('transactions', 'setting'));
        return $pdf->download('last_month_transactions.pdf');
    }
    public function allReceiptsPdf()
    {
        $setting = Setting::find(1);

        $transactions = Transaction::get();

        $pdf = PDF::loadView('all_transactions', compact('transactions', 'setting'));
        return $pdf->download('all_transactions.pdf');
    }
}

<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\CompanyComponent;
use App\Http\Livewire\CustomerComponent;
use App\Http\Livewire\EditReceiptComponent;
use App\Http\Livewire\EditSaleComponent;
use App\Http\Livewire\LedgerComponent;
use App\Http\Livewire\ReceiptsComponent;
use App\Http\Livewire\SaleComponent;
use App\Http\Livewire\SaleForm;
use App\Http\Livewire\SettingComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/customers', CustomerComponent::class)->name('customers');
    Route::get('/add/sales', SaleForm::class)->name('add_sales');
    Route::get('/sales', SaleComponent::class)->name('sales');
    Route::get('/edit/{id}/sale', EditSaleComponent::class)->name('edit_sale');
    Route::get('/sales/pdf/{id}', [Controller::class, 'generatePDF'])->name('sales_pdf');
    Route::get('/sales/ledger', [Controller::class, 'genrateSalesLedger'])->name('sales_ledger');
    Route::get('/pdf/customer/{id}', [Controller::class, 'generateCustomerPdf'])->name('customer_pdf');
    Route::get('/pdf/trnsaction/{id}', [Controller::class, 'generateTransactionPdf'])->name('transaction_pdf');
    Route::get('/generate-by-customer', [Controller::class, 'generateByCustomer'])->name('pdf_customer');
    Route::get('/generate-by-date-range', [Controller::class, 'generateByDateRange'])->name('pdf_date');
    Route::get('/generate-by-customer-company', [Controller::class, 'generateByCustomerCompany'])->name('pdf_company');
    Route::get('/today-payment-receipts', [Controller::class, 'todayPdf'])->name('today_receipts');
    Route::get('/week-payment-receipts', [Controller::class, 'lastWeekPdf'])->name('week_receipts');
    Route::get('/last-15-payment-receipts', [Controller::class, 'last15DaysPdf'])->name('last_15_receipts');
    Route::get('/last-30-payment-receipts', [Controller::class, 'lastMonthPdf'])->name('last_month_receipts');
    Route::get('/all-receipts', [Controller::class, 'allReceiptsPdf'])->name('all_receipts');
    Route::get('/ledger-statements', LedgerComponent::class)->name('ledger_statements');
    Route::get('/receipts', ReceiptsComponent::class)->name('receipts');
    Route::get('/settings', SettingComponent::class)->name('setting');
    Route::get('/company', CompanyComponent::class)->name('company');
    Route::get('/receipts', ReceiptsComponent::class)->name('receipts');
    Route::get('/receipt/id', EditReceiptComponent::class)->name('edit_receipt');
});

require __DIR__ . '/auth.php';

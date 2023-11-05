<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="row p-2">
                   <div class="col-md-4 border-2 border-green-500 rounded-lg">
                    <h1 class="text-orange-600 font-extrabod">Generate Sale Invoice</h1>
                    <form wire:submit.prevent="addSales">
                        <div class="row">
                            <div class="form-group">
                                <label for="customer_id" class="label-control">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control"
                                    wire:model="customer_id">
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="saleId" class="label-control">SalesID</label>
                                <input wire:model="saleId" type="text"
                                    class="form-control @error('saleId') is-invalid @enderror" id="saleId">
                                @error('saleId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="type" class="label-control">Payment Mode</label>
                                <select name="type" id="type" class="form-control" wire:model="type">
                                    <option value="">Select Payment Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Credit">Credit</option>
                                    <option value="Balance">Balance</option>
                                </select>
                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sdate" class="label-control">Sale Date</label>
                                <input wire:model="sdate" type="date"
                                    class="form-control @error('sdate') is-invalid @enderror"
                                    placeholder="Add Payment Method like Easypaisa jazzcash etc" id="sdate">
                                @error('sdate')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 ">
                                <label for="amount" class="form-label">Amount</label>
                                <input wire:model="amount" type="number"
                                    class="form-control @error('amount') is-invalid @enderror" id="amount">
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 ">
                                <label for="advance" class="form-label">Advance Amount</label>
                                <input wire:model="advance" type="number"
                                    class="form-control @error('advance') is-invalid @enderror" id="advance">
                                @error('advance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 ">
                                <label for="discount" class="form-label">Discount</label>
                                <input wire:model="discount" type="number"
                                    class="form-control @error('discount') is-invalid @enderror" id="discount">
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="detail" class="form-label">Notes Detail</label>
                                <textarea wire:model="detail" placeholder="Extra Detail about amount or receipt"
                                    class="form-control @error('detail') is-invalid @enderror" id="detail"></textarea>

                                @error('detail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn bg-teal-700 float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                   </div>
                   <div class="col-md-8 border-2 border-green-300 rounded-lg">
                    <div class="table-responsive">
                        <table class="table bordered">
                            <thead>
                                <tr>
                                    <th>SaleID</th>
                                    <th>Customer</th>
                                    <th>InvoiceAmount</th>
                                    <th>Advance</th>
                                    <th>Discount</th>
                                    <th>Paid</th>
                                    <th>Remaining</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sales as $sale)
                                    <tr>
                                        <td class="font-extrabold text-[11px]">{{$sale->saleId}}</td>
                                        <td class="font-extrabold text-[11px]">{{$sale->customer->name}}</td>
                                        <td class="font-extrabold text-[11px]">{{$sale->total_amount}}</td>
                                        <td class="font-extrabold text-[11px]">{{$sale->advance}}</td>
                                        <td class="font-extrabold text-[11px]">{{$sale->discount}}</td>
                                        <td class="font-extrabold text-[11px]">{{$sale->paid}}</td>
                                        <td class="font-extrabold text-[11px]">{{$sale->remaining}}</td>
                                        <td class="font-extrabold text-[11px]">{{$sale->status}}</td>
                                        <td class="font-extrabold text-[11px]">{{\Carbon\Carbon::parse($sale->sale_date)->isoFormat('MMM Do YYYY')}}</td>
                                        <td class="font-extrabold text-[11px]">
                                            <div class="flex ">
                                                <a href="{{route('sales_pdf',['id'=>$sale->id])}}" class="btn bg-warning font-bold text-[13px]">PDF</a>
                                                <a href="{{route('edit_sale',['id'=>$sale->saleId])}}" class="btn bg-teal-300 font-bold text-[13px]"><i class="bi bi-pencil"></i></a>
                                                <a href="#" wire:click.prevent="deleteSale('{{$sale->id}}')" class="btn bg-red-300 font-bold text-[13px]"><i class="bi bi-trash"></i></a></div>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    No Record Found
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                        {{$sales->links()}}
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

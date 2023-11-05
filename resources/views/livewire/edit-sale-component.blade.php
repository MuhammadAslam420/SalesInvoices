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
                    <h1 class="text-orange-600 font-extrabod">Edit Sale Invoice</h1>
                    <form wire:submit.prevent="updateSale">
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
                                <label for="total_amount" class="form-label">Amount</label>
                                <input wire:model="total_amount" type="number"
                                    class="form-control @error('total_amount') is-invalid @enderror" id="total_amount">
                                @error('total_amount')
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
                            <div class="col-md-6 ">
                                <label for="paid" class="form-label">Paid</label>
                                <input wire:model="paid" type="number"
                                    class="form-control @error('paid') is-invalid @enderror" id="paid">
                                @error('paid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 ">
                                <label for="remaining" class="form-label">Remaining</label>
                                <input wire:model="remaining" type="number"
                                    class="form-control @error('remaining') is-invalid @enderror" id="remaining">
                                @error('remaining')
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
            </div>
        </div>
    </div>
</div>

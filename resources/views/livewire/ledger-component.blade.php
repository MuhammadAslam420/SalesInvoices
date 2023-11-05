<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ledger Statement') }}
    </h2>
</x-slot>
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <p class="flex">
                <a href="#" wire:click.prevent="downloadSales" class="btn bg-teal-400 float-left">Sales Ledger
                    Sheet</a>
                <a href="{{ route('sales_ledger') }}" class="btn bg-yellow-500">Sales Ledger PDF</a>
            </p>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-orange-500 font-bold text-[15px]">Individual Sales Ladger (Excel)</h1>
                        <form wire:submit.prevent="downloadCustomerSales">
                            <div class="mb-3">
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

                            <button type="submit" class="btn bg-teal-700">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-purple-500 font-bold text-[15px]">OverALL Sales Ladger (Excel)</h1>
                        <form wire:submit.prevent="downloadSaleBet">
                            <div class="mb-3">
                                <label for="country_id" class="label-control">Start Date</label>
                                <select name="country_id" id="country_id" class="form-control" wire:model="country_id">
                                    <option value="">Select Customer</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                    @error('country_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="start" class="label-control">Start Date</label>
                                    <input type="date" name="start" id="start" class="form-control"
                                        wire:model="start">
                                    @error('start')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="end" class="label-control">End Date</label>
                                    <input type="date" name="end" id="end" class="form-control"
                                        wire:model="end">
                                    @error('end')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn bg-teal-700">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

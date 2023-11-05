<div>
    <div class="row p-2">
        <div class="col-md-6 border-4 border-green-500/100 rounded">

            <button class="btn bg-green-300 py-2 my-1" wire:click.prevent="downloadSales"><i
                    class="bi bi-file-earmark-spreadsheet-fill"></i>Sales</button>
                    <button class="btn bg-green-300 py-2 my-1" wire:click.prevent="downloadCashes"><i
                        class="bi bi-file-earmark-spreadsheet-fill"></i>Transactions</button>
            <button class="btn bg-green-600 py-2 my-1" wire:click.prevent="downloadCustomers"><i
                    class="bi bi-file-earmark-spreadsheet-fill"></i>Customer</button>
            <button class="btn bg-green-300"><i class="bi bi-credit-card">{{$balance}}</i></button>

            <div class="row p-1" wire:ignore.self>
                <div class="mb-3">
                    <label for="customer_id" class="label-control">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-control" wire:model="selectedCustomerId">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CM ID</th>
                            <th>SaleAmount</th>
                            <th>Paid</th>
                            <th>Discount</th>
                            <th>Remaining</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salesInfo as $sale)
                            <tr>
                                <td>{{ $sale->saleId }}</td>
                                <td>{{ $sale->total_amount }}</td>
                                <td>{{ $sale->paid }}</td>
                                <td>{{ $sale->discount }}</td>
                                <td>{{ $sale->remaining }}</td>
                                <td>{{ $sale->created_at }}</td>
                            </tr>
                        @empty
                            <p>No Record Find</p>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-6 border-4 border-teal-500/100 rounded p-2">
            <h1 class="text-orange-600 font-extrabod">Generate Cash Receipts</h1>
            <form wire:submit.prevent="addReceipt">
                <div class="row">
                    <div class="form-group">
                        <label for="customer_id" class="label-control">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control" wire:model="customer_id">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sale_id" class="label-control">SalesID</label>
                        <input wire:model="sale_id" type="text"
                            class="form-control @error('sale_id') is-invalid @enderror" id="sale_id">
                        @error('sale_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="label-control">Payment Mode</label>
                        <select name="type" id="type" class="form-control" wire:model="type">
                            <option value="">Select Payment Mode</option>
                            <option value="Jazzcash">Jazzcash</option>
                            <option value="EasyPaisa">EasyPaisa</option>
                            <option value="Bank">Bank</option>
                            <option value="Cash">Cash</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="amount" class="form-label">Amount</label>
                            <input wire:model="amount" type="number"
                                class="form-control @error('amount') is-invalid @enderror" id="amount">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="date" class="form-label">Date</label>
                            <input wire:model="date" type="number"
                                class="form-control @error('date') is-invalid @enderror" id="date">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="form-label">Notes Detail</label>
                        <textarea wire:model="note" placeholder="Extra Detail about amount or receipt"
                            class="form-control @error('note') is-invalid @enderror" id="note"></textarea>

                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-teal-700 float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 border-5 border-dark rounded-lg p-3">
            <h1 class="p-2">Generate Sales Pdf For Single or All Customer</h1>
            <form action="{{route('pdf_customer')}}">
                <div class="form-group">
                    <label for="customer" class="label-control">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn bg-green-400 float-right mt-2">Submit</button>
                </div>

            </form>


        </div>
        <div class="col-md-4 border-5 border-dark rounded-lg p-3">
            <h1 class="p-2">Generate Sales Pdf Date Wise</h1>
            <form action="{{route('pdf_date')}}">
                <div class="form-group">
                    <label for="sdate" class="label-control">Start Date</label>
                    <input type="date" name="sdate" id="sdate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edate" class="label-control">End Date</label>
                    <input type="date" name="edate" id="edate" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn bg-green-400 float-right mt-2">Submit</button>
                </div>

            </form>


        </div>
        <div class="col-md-4 border-5 border-dark rounded-lg p-3">
            <h1 class="p-2">Generate PDF Company Wise</h1>
            <form action="{{route('pdf_company')}}">
                <div class="form-group">
                    <label for="company" class="label-control">Company</label>
                    <select name="country_id" id="country_id" class="form-control">
                        <option value="">Select Company</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date" class="label-control">Select Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn bg-green-400 float-right mt-2">Submit</button>
                </div>

            </form>


        </div>

    </div>
</div>

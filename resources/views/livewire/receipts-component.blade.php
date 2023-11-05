<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <p class="flex">
                <div class="flex">
                    <a href="#" wire:click.prevent="downloadCashes" class="btn bg-green-400 float-right">Payment Receipt Xlsx Sheet</a>
                    <a href="{{route('today_receipts')}}"  class="btn bg-green-400 float-right">Today Payment Receipt PDF</a>
                    <a href="{{route('week_receipts')}}" class="btn bg-green-400 float-right">Last 7 Days Payment Receipt PDF</a>
                    <a href="{{route('last_15_receipts')}}" class="btn bg-green-400 float-right">Last 15 Days Payment Receipt PDF</a>
                    <a href="{{route('last_month_receipts')}}" class="btn bg-green-400 float-right">Last 30 Days Receipt PDF</a>
                    <a href="{{route('all_receipts')}}" class="btn bg-green-400 float-right">All Payment Receipt PDF</a>
                </div>
            </p>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="search" class="label-control">Search Here</label>
                            <input type="search" placeholder="search by cm Id and  type..." name="search" id="search" class="form-control" wire:model="search">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date" class="label-control">Search By Date</label>
                            <input type="date" name="date" id="date" class="form-control" wire:model="date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sorting" class="label-control">Default Sorting</label>
                            <select name="sorting" id="sorting" class="form-control" wire:model="sorting">
                                <option value="">Default Sorting</option>
                                <option value="ptype_asc">PType Ascending</option>
                                <option value="ptype_desc">PType Descending</option>
                                <option value="created_at_asc">Date Ascending</option>
                                <option value="created_at_desc">Date Descending</option>
                                <option value="saleId_asc">Sale ID Ascending</option>
                                <option value="saleId_desc">Sale ID Descending</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="perpage" class="label-control">Default Page Size</label>
                            <select name="perpage" id="perpage" class="form-control" wire:model="perpage">
                                <option value="">Default Sorting</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <h1 class="text-dark font-bold text-[13px]">Receipts Table</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>CM ID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Detail</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->sale->customer->name }}</td>
                                    <td>{{ $transaction->sale->saleId }}</td>
                                    <td>{{ $transaction->ptype}}</td>
                                    <td>{{$transaction->amount}}</td>
                                    <td>{{ $transaction->detail}}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->sale_date)->isoFormat('MMM Do YYYY') }}</td>
                                    <td>
                                        <a href="{{route('transaction_pdf',['id'=>$transaction->id])}}" class="btn bg-green-400"><i class="bi-file-earmark-spreadsheet-fill"></i></a>
                                        <button wire:click="delete('{{$transaction->id}}')" class="btn bg-red-500"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$transactions->links()}}

                </div>
            </div>
        </div>
    </div>
</div>

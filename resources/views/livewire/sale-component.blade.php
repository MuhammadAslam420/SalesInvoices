<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="search" class="label-control">Search Here:</label>
                        <input type="search" name="search" id="search" wire:model="search" placeholder="Search here customer name and CM Id" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sdate" class="label-control">Search By Date</label>
                        <input type="date" name="sdate" id="sdate" wire:model="sdate" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="s_date" class="label-control">PerPage Size</label>
                            <select name="perpage" id="perpage" wire:model="perpage" class="form-control">
                                <option value="">Select Page Size</option>
                                <option value="10">10</option>
                                <option value="16">16</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="32">32</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sorting" class="label-control">Sort By New</label>
                            <select name="sorting" id="sorting" wire:model="sorting" class="form-control">
                                <option value="">Default Sorting</option>
                                <option value="desc">Today</option>
                                <option value="asc">Old</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="company" class="label-control">Search By Company</label>
                            <select name="scompany" id="scompany" wire:model="scompany" class="form-control">
                                <option value="">Search By Company</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row p-2">
                    <div class="table-responsive">
                        <table class="table bordered">
                            <thead>
                                <tr>
                                    <th>CMID</th>
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
                                        <td class="font-bold text-[13px]">{{$sale->saleId}}</td>
                                        <td class="font-bold text-[13px]">{{$sale->customer->name}}</td>
                                        <td class="font-bold text-[13px]">{{$sale->total_amount}}</td>
                                        <td class="font-bold text-[13px]">{{$sale->advance}}</td>
                                        <td class="font-bold text-[13px]">{{$sale->discount}}</td>
                                        <td class="font-bold text-[13px]">{{$sale->paid}}</td>
                                        <td class="font-bold text-[13px]">{{$sale->remaining}}</td>
                                        <td class="font-bold text-[13px]">{{$sale->status}}</td>
                                        <td class="font-bold text-[13px]">{{\Carbon\Carbon::parse($sale->created_at)->isoFormat('MMM Do YYYY')}}</td>
                                        <td class="font-bold text-[13px]">
                                            <div class="flex ">
                                                <a href="{{route('sales_pdf',['id'=>$sale->id])}}" class="btn bg-warning">PDF</a>
                                                <a href="{{route('edit_sale',['id'=>$sale->saleId])}}" class="btn bg-teal-300 font-bold text-[13px]"><i class="bi bi-pencil"></i></a>
                                                <a href="#" wire:click.prevent="deleteSale('{{$sale->id}}')" class="btn bg-red-300 font-bold text-[13px]"><i class="bi bi-trash"></i></a>
                                            </div>
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

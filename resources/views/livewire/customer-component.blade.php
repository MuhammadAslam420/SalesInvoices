<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <a href="#" wire:click.prevent="downloadCustomers" class="btn bg-green-500">Download Customers Excel Sheet</a>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form wire:submit.prevent="save">
                    <input type="hidden" wire:model="customerId">

                    <div>
                        <label class="label-control" for="name">Name:</label>
                        <input type="text" class="form-control" id="name" wire:model="name">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label-control" for="country_id">Company</label>
                        <select name="country_id" id="country_id" class="form-control" wire:model="country_id">
                            <option value="">Select Company</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}" >{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label-control" for="email">Email:</label>
                        <input type="email" class="form-control" id="email" wire:model="email">
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="label-control" for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" wire:model="phone">
                        @error('phone') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label-control" for="address">Address:</label>
                        <input type="text" class="form-control" id="address" wire:model="address">
                        @error('address') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="label-control" for="image">image:</label>
                        <input type="file" class="form-control" id="image" wire:model="image">
                         @if($image)
                         <img src="{{$image->temporaryUrl()}}" width="120" alt="">
                         @endif
                    </div>

                    <button type="submit" class="btn bg-primary">{{ $isEditing ? 'Update' : 'Add' }} Customer</button>
                    <button type="button" wire:click="create" class="btn bg-green-500">Add New</button>
                </form>
                <div class="mt-2 mb-2 flex ">
                    <div class="form-group mr-2">
                        <input type="search" name="search" id="search" placeholder="search by name, email, address, date, contact" class="input-control" wire:model="search">
                    </div>
                    <div class="form-group ml-2">
                        <select class="form-control" name="perPage" id="perPage" wire:model="perPage">
                            <option value="">Select PerPage Size</option>
                            <option value="12">12</option>
                            <option value="16">16</option>
                            <option value="24">24</option>
                        </select>
                    </div>

                </div>
                <div class="table-responsive my-1">
                    <h1 class="text-dark font-bold text-[13px]">Customers</h1>


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($customer->created_at)->isoFormat('MMM Do YYYY') }}</td>
                                    <td><a href="#" wire:click="edit({{ $customer->id }})" class="btn bg-teal-500">Edit</a>
                                        <a href="#" class="btn bg-red-500" wire:click="delete({{ $customer->id }})">Delete</a>
                                        <a href="{{route('customer_pdf',['id'=>$customer->id])}}" class="btn bg-yellow-400">PDF Statement</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$customers->links()}}

                </div>
            </div>
        </div>
    </div>
</div>

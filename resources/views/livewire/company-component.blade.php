<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg py-2 px-4">
            <div class="row p-4">
                <form wire:submit.prevent="save" class="border border-3 border-green-500 rounded-lg p-2">
                    <input type="hidden" wire:model="companyId">
                    <div class="mb-3">
                        <label for="company" class="label-control">Company</label>
                        <input type="text" name="company" id="company" class="form-control" wire:model="company">
                        @error('company')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-primary">{{ $isEditing ? 'Update' : 'Add' }}
                            Company</button>
                        <button type="button" wire:click="create" class="btn bg-green-500">Add New</button>
                    </div>
                </form>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->created_at }}</td>
                                <td><a href="#" wire:click="edit({{ $company->id }})"
                                        class="btn bg-teal-500">Edit</a>
                                    <a href="#" class="btn bg-red-500"
                                        wire:click="delete({{ $company->id }})">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <p>No Record Find</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

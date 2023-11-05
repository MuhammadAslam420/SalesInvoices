<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form wire:submit.prevent="updateSetting" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="label-control">Business Name</label>
                        <input type="text" name="name" id="name" class="form-control" wire:model="name">

                    </div>
                    <div class="mb-3">
                        <label for="address" class="label-control">Business Address</label>
                        <input type="text" name="address" id="address" class="form-control" wire:model="address">

                    </div>
                    <div class="mb-3">
                        <label for="email" class="label-control">Business Email</label>
                        <input type="text" name="email" id="email" class="form-control" wire:model="email">

                    </div>
                    <div class="mb-3">
                        <label for="phone" class="label-control">Business Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" wire:model="phone">

                    </div>
                    <div class="mb-3">
                        <label for="notes" class="label-control">Business Qoute</label>
                        <input type="text" name="notes" id="notes" class="form-control" wire:model="notes">

                    </div>
                    <div class="mb-3">
                        <label for="new_logo" class="label-control">Business Logo</label>
                        <input type="file" name="new_logo" id="new_logo" class="form-control" wire:model="new_logo">
                        @if($new_logo)
                        <img src="{{$new_logo->temporaryUrl()}}" width="120" alt="">
                        @else
                        <img src="{{asset('images')}}/{{$logo}}" width="120" alt="">
                        @endif

                    </div>

                    <button type="submit" class="btn bg-teal-700">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

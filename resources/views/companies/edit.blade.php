<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Company') }} {{ $company->name }}
        </h2>
    </x-slot>

    <div class="container">
        <h2>Edit Company: {{ $company->name }}</h2>
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Use PUT method for updates --}}
            <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $company->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>
    </div>
</x-app-layout>


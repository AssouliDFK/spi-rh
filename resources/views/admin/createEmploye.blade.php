<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.storeEmploye') }}" class="w-full max-w-md mx-auto">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input id="name" type="text" class="form-input w-full" name="name" required autofocus>
                        </div>
    
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input id="email" type="email" class="form-input w-full" name="email" required>
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror   
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                            <input id="password" type="password" class="form-input w-full" name="password" required>
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                            <input id="role" type="text" class="form-input w-full" name="role" value="employe" disabled>
                        </div>
    
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                            <select id="status" name="status" class="form-select w-full" required>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
    
                        <div class="flex items-center justify-end">
                            <button type="submit">
                                Send Invitation 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>

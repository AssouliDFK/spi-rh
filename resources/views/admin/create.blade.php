<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Administrator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.storeAdmin') }}" class="w-full max-w-md mx-auto">
                        @csrf
                        @method('post')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input id="name" type="text" class="form-input w-full" name="name" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input id="email" type="email" class="form-input w-full" name="email" required>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                            <input id="password" type="password" class="form-input w-full" name="password" required>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" >
                                Create Administrator
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.create') }}" class="btn btn-light text-dark me-2">Create Administrator</a>
            <a href="{{ route('admin.createEmploye') }}" class="btn btn-light text-dark me-2">Create Employee</a>
            <a href="{{ route('admin.createCompany') }}" class="btn btn-light text-dark me-2">Create Compony</a>
            <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mt-3">List of employees :</h3>
                    <h2 class="text-3xl font-bold text-gray-900"> Nbr Employee Search data : <span id="total_records"></span></h2>
                    <div>
                        <input type="text" name="search" id="search" class="form-control border-2 border-gray-300 bg-white h-10 px-5 pr-10 rounded-lg text-sm focus:outline-none" placeholder="Search Employe by name">
                    </div>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th id="nameHeader" class="clickable-header">Name <span id="sortArrow" bold>&#8597;</span></th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Details</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        // use the actionRoute variable to define the URL for your AJAX request
        var actionRoute = '{{ route('action') }}';
    </script>
    <script src="{{ asset('js/employe.js') }}"></script>
</x-app-layout>

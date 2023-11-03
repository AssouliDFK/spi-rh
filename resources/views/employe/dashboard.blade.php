
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


       <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as an employee!") }}

                    <h3 class="mt-3">List of Companies</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                    @if(!empty($companies && $companies->count()))
                            @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>

                            </tr>
                            @endforeach
                    @else
                    <tr><th> No data Selected</th></tr>
                    @endif
                        </tbody>
                    </table>
                </div>
            </div>  <div class="row">{{ $companies->links()}}</div>
        </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("List Of Employees In Same Company ") }}
    
                        <h3 class="mt-3">List of Employees</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if(!empty($employeesInSameCompany && $employeesInSameCompany->count()))
                                @foreach($employeesInSameCompany as $employe)
                                <tr>
                                    <td>{{ $employe->name }}</td>
    
                                </tr>
                                @endforeach
                        @else
                        <tr><th> Dont yet Affected  </th></tr>
                        @endif
                            </tbody>
                        </table>
                    </div>
            </div>
            </div>
      
</x-app-layout>

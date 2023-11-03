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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mt-3">List of employees :</h3>
                    <h2> Nbr Employee Search data : <span id="total_records"></span></h2>
                    <div>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search Employe by name">
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($employees as $employe)
                            <tr>
                                <td>{{ $employe->name }}</td>
                                <td>{{ $employe->email }}</td>
                                <td>@if ($employe->belongs_to_company)
                                    {{ $employe->belongs_to_company }}
                                @else
                                    No Company
                                @endif</td>

                                <td>
                                    <a href="{{ route('employee.show', ['id' => $employe->id]) }}" class="btn btn-sm btn-primary">
                                        View Employee Details
                                    </a>
                                </td>
                                
                            </tr>
                            
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            fetch_employees_data();
            function fetch_employees_data(query = ''){
                // alert("load data "+ query);
                console.log(query);
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#signup-token').val()
                        }
                    });
                $.ajax({
                    url : '{{route('action')}}',
                    method : 'GET',
                    data :      {
                                query:query},
                    dataType : 'json',
                    success : function(data){
                        $('tbody').html(data.table_data);
                        $('total_reocords').text(data.total_data);
                    },
                    error :  function(xhr){
                        console.log(xhr.responseText);
                    }
                });
            }
            $(document).on('keyup','#search', function(){
                var query =$(this).val();
                fetch_employees_data(query);
            });
        });

    </script>
</x-app-layout>

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
                    <h3>Employee Details</h3>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $employee->email }}</td>
                        </tr>
                        <tr>
                            <th>Company</th>
                            <td>
                                @if ($employee->company_id)
                                    {{ $companyName }}
                                @else
                                    No Company
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Action</th>
                            <td>
                                <a href="{{ route('employee.delete', ['id' => $employee->id]) }}" class="btn btn-sm btn-danger">
                                        Delete Account
                                </a>
                                @if ($employee->status == 'pending')
                                <a href="{{ route('employee.cancel', ['id' => $employee->id]) }}" class="btn btn-sm btn-warning">
                                    Cancel Invitation
                                </a>
                                @elseif ($employee->status == 'active')
                                <button class="btn btn-info btn-sm">
                                    Activated User
                                </button>
                                @endif
                            </td>
                        </tr>
                    </table>
                  <div class="p-6 text-gray-900">  
                                <form action="{{ route('employee.assignCompany', ['employee' => $employee]) }}" method="post">
  
                                @csrf
                            
                                <div class="form-group">
                                    <label class="my-1 mr-2" >Select Company:</label>
                                    <select name="company_id" id="company_id">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                <button type="submit" class="btn btn-info">Assign Company</button>

                                </div>
                            
                            </form>
                </div>
                </div>
            </div>
        </div>

        
    </div>
      
</x-app-layout>











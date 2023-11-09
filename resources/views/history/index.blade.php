<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        <thead>
                            <tr>
                                <th>Log Entry</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $entry)
                                <tr>
                                    <td>
                                        @if ($entry->status_invitation == 'pending')
                                        <b> {{ $entry->created_at }} </b>- Admin "{{ $entry->email_sender }}" a invité l'employé "{{ $entry->email_recipient }}" à joindre la société {{ $entry->company_id }}
                                        @elseif ($entry->status_invitation == 'inactive')
                                        <b> {{ $entry->created_at }} </b>- Admin "{{ $entry->email_sender }}" a annulé l'invitation de "{{ $entry->email_recipient }}"
                                        @elseif ($entry->status_invitation == 'active')
                                        <b> {{ $entry->created_at }} </b>- "{{ $entry->email_recipient }}" a validé l'invitation
                                           
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>

@extends('layouts.app')
@section('content')
   
<div class="overflow-x-auto">
    <table class="min-w-full border divide-y divide-gray-200">

        <thead class="">
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                ΑΑ
            </th>
            <th>Εισαγωγή</th>
            <th>Ημερομηνία</th>
            <th>Επέμβαση</th>
            <th>Operator</th>
            <th>Βοήθός</th>
            <th>Βοήθός Β</th>
            <th>Αναισθησιολόγος</th>
            <th>Προσβαση</th>
            <th>Αναισθησια</th>
            <th>Ιστολογική</th>
            <th>Σημειώσεις</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($last_surgeries as $surgery)

                <tr class="">
                    <td class="td-class">
                       <a href="{{ route('surgery.show', $surgery->ID) }}">{{ $surgery->ID }}</a>
                        {{-- {{ dd($surgery->Operation) }} --}}
                    </td>
                        <td>{{ $surgery->AdmissionID }}</td>
                        <td>{{ $surgery->DatePerformed }}</td>
                        <td>{{ $surgery->Operation->Value }}</td>
                        <td>{{ $surgery->doctorOperator->FirstName }} {{ $surgery->doctorOperator->LastName }}</td>
                        <td>
                            @if ($surgery->doctorAssistant)
                                {{ $surgery->doctorAssistant->FirstName }} {{ $surgery->doctorAssistant->LastName }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($surgery->doctorAssistantB)
                                {{ $surgery->doctorAssistantB->FirstName }} {{ $surgery->doctorAssistantB->LastName }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($surgery->DoctorAnest)
                                {{ $surgery->DoctorAnest->FirstName }} {{ $surgery->DoctorAnest->LastName }}
                            @else
                                -
                            @endif
                            {{ $surgery->AnestName }}
                        </td>
                        <td>
                            @if ($surgery->access)
                                {{ $surgery->access->Value }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($surgery->anesthesia)
                                {{ $surgery->anesthesia->Value }}
                            @else
                            @endif
                        </td>
                        <td>
                            @if ($surgery->istologika)
                                {{ $surgery->istologika->Value }}
                            @else
                            @endif
                        </td>
                        <td>{{ $surgery->Notes }}</td>
                     
                    </tr>
            @endforeach
        </tbody>
    </table>
</div>
    @endsection

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="content">
            <div class="px-4 py-6 mx-auto max-w-12xl sm:px-6 lg:px-8">
                <h2>Ασθενείς με στοιχεία τελευταίας νοσηλείας </h2>
                <form action="{{ route('admissions.index', request()->query()) }}" method="GET">
                    <div class="grid grid-cols-2 gap-4 my-2">
                        <!-- Dropdowns for DoctorA and DoctorB -->
                        <div class="grid items-center grid-cols-2 gap-1">
                            <label  for="doctor_a" >Θεράπων (A):</label>
                            <select  name="doctor_a" id="doctor_a" >
                                <option value="">--Επιλέξτε Θεράπων--</option>
                                @foreach ($doctorsA as $doctor)
                                    <option value="{{ $doctor->ID }}"
                                        {{ request('doctor_a') == $doctor->ID ? 'selected' : '' }}>
                                        {{-- <option value="{{ $doctor->ID }}" {{ old('doctor_a') == $doctor->ID ? 'selected' : '' }}> --}}
                                        {{ $doctor->Name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid items-center grid-cols-2 gap-1">
                            <label  for="doctor_b">Ειδικευόμενος (B):</label>
                            <select  name="doctor_b" id="doctor_b">
                                <option value="">--Επιλέξτε Ειδικευόμενο--</option>
                                @foreach ($doctorsB as $doctor)
                                    <option value="{{ $doctor->ID }}"
                                        {{ request('doctor_b') == $doctor->ID ? 'selected' : '' }}>
                                        {{-- <option value="{{ $doctor->ID }}" {{ old('doctor_b') == $doctor->ID ? 'selected' : '' }}> --}}
                                        {{ $doctor->Name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid items-center grid-cols-2 gap-1">
                            <!-- Dropdowns for Illness and Result -->
                            <label  for="illness">Νόσος:</label>
                            <select  name="illness">
                                <option value="">--Επιλέξτε νόσο--</option>
                                @foreach ($illnesses as $illness)
                                    <option value="{{ $illness->ID }}"
                                        {{ request('illness') == $illness->ID ? 'selected' : '' }}>
                                        {{ $illness->Value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid items-center grid-cols-2 gap-1">
                            <label  for="result">Έκβαση:</label>
                            <select  name="result">
                                <option value="">--Επιλέξτε έκβαση--</option>
                                @foreach ($results as $result)
                                    <option value="{{ $result->ID }}"
                                        {{ request('result') == $result->ID ? 'selected' : '' }}>
                                        {{ $result->Value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid items-center grid-cols-2 gap-1">
                            <!-- Search Boxes -->
                            <label  for="last_name">Επώνυμο:</label>
                            <input  type="text" name="last_name" value="{{ request('last_name') }}">
                        </div>
                        <div class="grid items-center grid-cols-2 gap-1">
                            <label  for="first_name">Όνομα:</label>
                            <input  type="text" name="first_name" value="{{ request('first_name') }}">
                        </div>
                        <div class="grid items-center grid-cols-2 gap-1">
                            <label  for="patient_code">Κωδικός Ασθενή:</label>
                            <input  type="text" name="patient_code" value="{{ request('patient_code') }}">
                        </div>
                        <div class="grid items-center grid-cols-2 gap-1">
                            <label  for="gender">Φύλλο:</label>
                            <select  name="gender">
                                <option value="">--Επιλέξτε φύλλο--</option>
                                <option value="1"{{ request('gender') == '1' ? 'selected' : '' }}>Male</option>
                                <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <!-- Start Date Field -->
                        <div class="grid items-center grid-cols-1 space-y-4">
                            <div class="flex space-x-4">
                                    <label  for="start_date" class="text-sm text-gray-700">Εισαγωγή από</label>
                                    <input  type="date" id="start_date" name="start_date"
                                        class="inline-block mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ $startDate }}" {{-- value="{{ old('start_date', $startDate) }}" --}}>
                                    <!-- End Date Field -->
                                    <label  for="end_date" class="text-sm text-gray-700">εώς</label>
                                    <input  type="date" id="end_date" name="end_date"
                                        class="inline-block mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        {{-- value="{{ old('start_date', $endDate) }}" --}} value="{{ $endDate }}">
                            </div>
                        </div>
                        <div class="grid items-center grid-cols-1 gap-1 space-y-4">
                            <div class="flex space-x-4">
                                    <label  for="age_from">Ηλικία απο:</label>
                                    <input  type="number" name="age_from" value="{{ request('age_from') }}">
                                <!-- Age To Field -->
                                    <label  for="age_to">εώς:</label>
                                    <input  type="number" name="age_to" value="{{ request('age_to') }}">
                            </div>
                        </div>

                            <div class="grid items-center grid-cols-2 gap-1">
                                <label  class="text-sm font-medium text-transparent">&nbsp;</label>
                                <!-- Empty label for alignment -->
                                <button type="submit"
                                    class="w-2/3 px-4 py-2 mt-1 font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600">
                                    Εφαρμογή Φίλτρων
                                </button>

                            </div>

                        </div>


                    </div>
                </form>




                <h2>Νοσηλείες από {{ $startDate }} εώς {{ $endDate }}</h2>

                <!-- In your Blade file (e.g. admissions/index.blade.php) -->

                <h3>Selected Filters:</h3>

                <ul>
                    <!-- Display individual filters -->
                    @if (request()->filled('doctor_a'))
                        <li>Doctor A: {{ request()->input('doctor_a') }}</li>
                    @endif

                    @if (request()->filled('doctor_b'))
                        <li>Doctor B: {{ request()->input('doctor_b') }}</li>
                    @endif

                    @if (request()->filled('illness'))
                        <li>Illness: {{ request()->input('illness') }}</li>
                    @endif

                    @if (request()->filled('result'))
                        <li>Result: {{ request()->input('result') }}</li>
                    @endif

                    @if (request()->filled('last_name'))
                        <li>Last Name: {{ request()->input('last_name') }}</li>
                    @endif

                    @if (request()->filled('first_name'))
                        <li>First Name: {{ request()->input('first_name') }}</li>
                    @endif

                    @if (request()->filled('patient_code'))
                        <li>Patient Code: {{ request()->input('patient_code') }}</li>
                    @endif

                    @if (request()->filled('gender'))
                        <li>Gender: {{ request()->input('gender') }}</li>
                    @endif

                    @if (request()->filled('age_from') && request()->filled('age_to'))
                        <li>Age: {{ request()->input('age_from') }} - {{ request()->input('age_to') }}</li>
                    @endif

                    <!-- If no filters are applied -->
                    @if (request()->all() == [])
                        <li>No filters applied.</li>
                    @endif
                </ul>

                {{-- <ul>
    @forelse(request()->all() as $key => $value)
        @if ($value) <!-- Check if the value is not null or empty -->
            <li>{{ ucfirst($key) }}: {{ $value }}</li>
        @endif
    @empty
        <li>No filters applied.</li>
    @endforelse
</ul> --}}


                @if ($patients->count())

                    <div class="overflow-x-auto">
                        <table class="min-w-full border divide-y divide-gray-200">

                            <thead class="">
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Εισαγωγή
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Κωδ. Aσθ.</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Επωνυμο
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Όνομα
                                </th>

                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Γεν
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Τηλ
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Διάγωνση
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Νόσος
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Εντόπιση
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Αποτέλεσμα
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Θερ</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ειδ.</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                    width="110px">Ενέργειες
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($patients as $patient)
                                
                                {{-- @dd($patient) --}}

                                    <tr class="">
                                        <td class="td-class">
                                            {{ $patient->FromDate ?? 'N/A' }} - {{ $patient->ToDate ?? 'N/A' }}
                                        </td>
                                        <td class="td-class">
                                            {{ $patient->Code }}</td>
                                        <td class="td-class">{{ $patient->LastName }}</td>
                                        <td class="td-class">{{ $patient->FirstName }}</td>
                                        <td class="td-class">{{ $patient->BirthYear }}</td>
                                        <td class="td-class">{{ $patient->FirstPhone }}
                                            <br />
                                            {{ $patient->SecondPhone }}
                                        </td>

                                        <td class="td-class">
                                            {{ ($patient->DiagnosisLookup_Value) ?? 'N/A' }}</td>
                                        <td class="td-class">{{ $patient->IllnessLookup_Value ?? 'N/A' }}
                                        </td>
                                        <td class="td-class">
                                            {{ ($patient->LocalizationLookup_Value) ?? 'N/A' }}
                                        </td>
                                        <td class="td-class"> {{ $patient->ResultLookup_Value ?? 'N/A' }}
                                        </td>
                                        <td class="td-class">
                                            {{ $patient->DoctorA_Abbreviation ?? 'N/A' }}</td>
                                        <td class="td-class">
                                            {{ $patient->DoctorB_Abbreviation ?? 'N/A' }}</td>
                                        <td class="td-class">
                                            <a href="{{ route('patients.show', ['id' => $patient->ID]) }}"
                                                class="inline-flex items-center px-4 py-2 mt-4 text-base font-medium text-white bg-blue-500 border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Προβολή
                                                Φακέλου</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            <style>

            </style>

            <div class="mt-4">
                {{-- {{ $patients->appends(request()->query())->links() }} --}}
            </div>


            <div class="flex items-center justify-between mt-4">
                <!-- Pagination Summary -->
                <div class="text-sm text-gray-700">
                    @if ($total > 0)
                        Προβαλή εγγραφών {{ ($page - 1) * $perPage + 1 }} εώς {{ min($page * $perPage, $total) }} απο
                        {{ $total }} αποτελέσματα
                    @else
                        No results found.
                    @endif
                </div>

                <div class="prevnext">
                    @if ($page > 1)
                        <a href="{{ url()->current() }}?page={{ $page - 1 }}&search={{ request('search') }}">&lt;
                            Προηγούμενη Σελίδα</a>
                    @endif

                    <a href="{{ url()->current() }}?page={{ $page + 1 }}&search={{ request('search') }}">Επόμενη
                        Σελίδα &gt;</a>
                </div>

                <!-- Pagination Links -->
                <div>
                    <div class="pagination">
                        @if ($totalPages > 1)
                            <!-- First Page Link -->
                            <a href="{{ url()->current() }}?page=1&search={{ request('search') }}"
                                class="{{ $page == 1 ? 'active' : '' }}">1</a>

                            <!-- Ellipsis before current range -->
                            @if ($page > 3)
                                <span>...</span>
                            @endif

                            <!-- Display a range of pages around the current page -->
                            @for ($i = max(2, $page - 2); $i <= min($totalPages - 1, $page + 2); $i++)
                                <a href="{{ url()->current() }}?page={{ $i }}&search={{ request('search') }}"
                                    class="{{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                            @endfor

                            <!-- Ellipsis after current range -->
                            @if ($page < $totalPages - 2)
                                <span>...</span>
                            @endif

                            <!-- Last Page Link -->
                            @if ($totalPages > 1)
                                <a href="{{ url()->current() }}?page={{ $totalPages }}&search={{ request('search') }}"
                                    class="{{ $page == $totalPages ? 'active' : '' }}">{{ $totalPages }}</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pagination Links -->
        @else
            <p class="text-gray-500">No records found.</p>
            @endif

            <style>
                .btn.btn-info {
                    padding: 8px 16px;
                    text-decoration: none;
                    color: black;
                    border: 1px solid #ddd;
                    margin: 0 4px;
                }

                .prevnext a {
                    padding: 8px 16px;
                    text-decoration: none;
                    color: black;
                    border: 1px solid #ddd;
                    margin: 0 4px;
                }

                .pagination a {
                    padding: 8px 16px;
                    text-decoration: none;
                    color: black;
                    border: 1px solid #ddd;
                    margin: 0 4px;
                }

                .pagination a.active {
                    background-color: #4CAF50;
                    color: white;
                    border: 1px solid #4CAF50;
                }
            </style>
        </div>
    @endsection

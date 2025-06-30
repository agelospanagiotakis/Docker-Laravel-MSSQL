@extends('layouts.app')

@section('content')
<div class="container">
    <x-slot name="header">
        <h1 class="text-2xl">Patients List</h1>
    </x-slot>

    <!-- Search Form -->

    <form action="{{ route('patients.index', request()->query()) }}" method="GET">
        <div class="flex my-2">
            <input type="text" name="search" placeholder="Αναζήτηση" value="{{ request()->input('search') }}" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="" />
            <button type="submit" class="w-10 flex items-center justify-center border-t border-r border-b border-gray-200 rounded-r text-gray-100 bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

    </form>

    <!-- Patient Table -->

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex space-x-4 items-center">
                                        <a href="#">
                                            <span>ID</span>
                                        </a>
                                    </div>
                                </th>
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Κωδικός</span>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Επίθετο</span>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Όνομα</span>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Φυλλο</span>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Ετος Γέννησης</span>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Τηλέφωνο</span>
                                    </a>
                                </div>
                            </th>   <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Διεύθυνση</span>
                                    </a>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex space-x-4 items-center">
                                    <a href="#">
                                        <span>Πράξεις</span>
                                    </a>
                                </div>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($patients as $patient)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $patient->ID }}</div>
                                </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $patient->Code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $patient->LastName }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $patient->FirstName }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $patient->Gender }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->BirthYear }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->FirstPhone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->Address }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                  <a href="{{ route('patients.show', ['id' => $patient->ID]) }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Προβολή</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">Δεν βρέθηκαν σσθενείς</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Pagination Links -->
    {{-- {{ $patients->links() }} --}}
       <!-- Pagination Links -->

    <div class="flex justify-between items-center mt-4">
        <!-- Pagination Summary -->
        <div class="text-sm text-gray-700">
            @if ($total > 0)
            Προβαλή εγγραφών {{ ($page - 1) * $perPage + 1 }} εώς {{ min($page * $perPage, $total) }} απο {{ $total }} αποτελέσματα
        @else
            No results found.
        @endif
        </div>

        <div class="prevnext">
            @if ($page > 1)
                <a href="{{ url()->current() }}?page={{ $page - 1 }}&search={{ request('search') }}">&lt; Προηγούμενη Σελίδα</a>
            @endif

            <a href="{{ url()->current() }}?page={{ $page + 1 }}&search={{ request('search') }}">Επόμενη Σελίδα &gt;</a>
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

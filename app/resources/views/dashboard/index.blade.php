@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="content">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Κεντρική') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Η Εισοδος ήταν επιτυχής!") }}
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Νοσηλευομένοι: {{ $inpatients }} <br/>
                   Αρ. Εισαγωγών: {{ $admissions }}<br/>
                   Αρ. Επεμβάσεων: {{ $surgeries }}<br/>
                   Αρ. Ασθενών: {{ $patients }}<br/>
                
                </div>
            </div>
        </div>
    </div>


@endsection

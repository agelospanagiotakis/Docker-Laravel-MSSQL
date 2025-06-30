ΠΑΡΟΥΣΑ ΝΟΣΟΣ: <br />
@if ($admission)
    @if ($admission)
    <form action="{{ route('admissions.texts.update', $admission->ID) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-2">
        <div class="">
    {{-- @dd($admission->textsAdmission) --}}
                        <textarea name="AdParousa" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       rows="15"
                            >{{ e($admission->textsAdmission->AdParousa ?? '') }}</textarea>
                        <BR />
                        ΑΤΟΜΙΚΟ ΑΝΑΜΝΗΣΤΙΚΟ: <BR />
                        <textarea name="AdAtomiko" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       rows="15"
                       >{{ e($admission->textsAdmission->AdAtomiko ?? '') }}</textarea>

                        ΝΕΥΡΟΛΟΓΙΚΉ ΕΞΕΤΑΣΗ <BR />
                        <textarea name="AdNeuron" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       rows="15"
                       >{{ e($admission->textsAdmission->AdNeuron ?? '') }}</textarea>
                        <BR />

                        ΑΠΕΙΚΟΝΙΣΤΙΚΆ <span class="text-orange">
                            <textarea name="AdProjections" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       rows="15"
                                >{{ e($admission->textsAdmission->AdProjections ?? '') }}</textarea>
                        </span><BR />
    </div>
    <div class="">
        ΠΟΡΕΊΑ <span class="text-orange">
            <textarea name="AdPoreia" rows="40"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >{{ e($admission->textsAdmission->AdPoreia ?? '') }}</textarea>
        </span><BR />
    </div>
</div>
<div class="flex justify-end mt-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Αποθήκευση Κλινικών Στοιχείων
    </button>
</div>
</form>
    @else 
      no  texts in admission
    @endif 

@else 
no admission
@endif


@if ($admission)
<form action="{{ route('admissions.update', $admission->ID) }}" method="POST">
    @csrf
    @method('PATCH')
    {{-- @dd($admission) --}}
    <div class="flex items-center mb-4">
        <strong class="mr-2 min-w-[150px]">ID:</strong>
        <input type="text" name="ID"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ e($admission->ID ?? '') }}"
        >
    </div>

<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">θεράπων Ιατρός:</strong>
    <input type="text" name="DoctorA"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ e(($admission->doctorA->FirstName ?? '') . ' ' . ($admission->doctorA->LastName ?? '')) }}"
    >
</div>


<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Ειδικευόμενος Ιατρός:</strong>
    <input type="text" name="DoctorB"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ e(($admission->doctorB->FirstName ?? '') . ' ' . ($admission->doctorB->LastName ?? '')) }}"
    >
</div>

<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Εφημερία:</strong>
    <input type="checkbox" name="IsEfimeria" value="1"
        {{ $admission->IsEfimeria ? 'checked' : '' }}
    >
</div>
<div class="flex flex-wrap mb-4 -mx-2">
    <div class="w-1/4 px-2 mb-4">
        <div class="flex flex-col">
            <strong class="mb-1">Δωμάτιο:</strong>
            <input type="text" name="Room"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ e($admission->room->Value ?? 'N/A') }}"
            >
        </div>
    </div>

    <div class="w-1/4 px-2 mb-4">
        <div class="flex flex-col">
            <strong class="mb-1">Κλίνη:</strong>
            <input type="text" name="Bed"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ e($admission->Bed ?? '') }}"
            >
        </div>
    </div>

    <div class="w-1/4 px-2 mb-4">
        <div class="flex flex-col">
            <strong class="mb-1">Ηλικία:</strong>
            <input type="text" name="PatientAge"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ e($admission->PatientAge ?? '') }}"
            >
        </div>
    </div>

    <div class="w-1/4 px-2 mb-4">
        <div class="flex flex-col">
            <strong class="mb-1">Αν. Εισαγωγής:</strong>
            <input type="text" name="Code"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ e($admission->Code ?? '') }}"
            >
        </div>
    </div>
</div>

<div class="flex flex-wrap mb-4 -mx-2">
    <div class="w-1/3 px-2 mb-4">
        <div class="flex flex-col">
            <strong class="mb-1">Ημ. Εισαγωγής:</strong>
            <input type="date" name="FromDate"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $admission->FromDate ? $admission->FromDate->format('Y-m-d') : '' }}"
            >
        </div>
    </div>

    <div class="w-1/3 px-2 mb-4">
        <div class="flex flex-col">
            <strong class="mb-1">Ημ. Εξόδου:</strong>
            <input type="date" name="ToDate"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $admission->ToDate ? $admission->ToDate->format('Y-m-d') : '' }}"
            >
        </div>
    </div>

    <div class="w-1/3 px-2 mb-4">
        <div class="flex flex-col">
            <strong class="mb-1">Ημ. νοσηλείας:</strong>
            <div class="flex items-center">
                <input type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ ($admission->FromDate && $admission->ToDate) ? $admission->FromDate->diffInDays($admission->ToDate) + 1 : '' }}"
                >
                <span class="ml-2">ημέρες</span>
            </div>
        </div>
    </div>
</div>


<div class="flex items-center mb-4">
<strong class="mr-2 min-w-[150px]">Αιτία Εισαγωγής:</strong>
<input type="text" name="Cause"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    value="{{ $admission->Cause ?? '' }}"
>
</div>



<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Κατηγορία νόσου:</strong>
    <input type="text" name="Illness"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ $admission->illness->Value ?? '' }}"
    >
</div>

    
<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Διάγνωση:</strong>
    <input type="text" name="Diagnosis"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder=""
        value="{{ $admission->Diagnosis->Value ?? '' }}"
    >
</div>
  
  
<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Εντοπισμός:</strong>
    <input type="text" name="Localization"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ $admission->localization->Value ?? '' }}"
    >
</div>
  

  

<div class="mb-4">
    <div class="flex items-center justify-between pt-2">
        <div class="flex items-center">
            <strong class="mr-2">Αριστερό:</strong>
            <input type="checkbox" name="ELeft" value="1"
                class="w-5 h-5 text-blue-600 form-checkbox"
                {{ $admission->ELeft == 1 ? 'checked' : '' }}
            >
        </div>
        <div class="flex items-center">
            <strong class="mr-2">Δεξί:</strong>
            <input type="checkbox" name="ERight" value="1"
                class="w-5 h-5 text-blue-600 form-checkbox"
                {{ $admission->ERight == 1 ? 'checked' : '' }}
            >
        </div>
    </div>
</div>


   
<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Έκβαση:</strong>
    <input type="text" name="Result"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ $admission->result->Value ?? '' }}"
    >
</div>
  

<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Xειρουργείο:</strong>
    <input type="text" name="SMark"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ $admission->sMark->Value ?? '' }}"
    >
</div>

    {{-- <div class="mb-4">
    <strong>Έξοδος:</strong> {{ $admission->Exited }}
</div>
<div class="mb-4">
    <strong>Κλειστό:</strong> {{ $admission->Closed }}
</div>
 --}}
 
    
<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Σημειώσεις:</strong>
    <textarea name="Notes"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    >{{ $admission->Notes ?? '' }}</textarea>
</div>

    
<div class="flex items-center mb-4">
    <strong class="mr-2 min-w-[150px]">Σημείωση:</strong>
    <textarea name="sNote1"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    >{{ $admission->sNote1 ?? '' }}</textarea>
</div>


    {{-- <div class="mb-4">
    <strong>Χρήστης Εισαγωγής:</strong> {{ $admission->UserInserted }}
</div>
<div class="mb-4">
    <strong>Ημερομηνία Εισαγωγής:</strong> {{ $admission->DateInserted }}
</div>
<div class="mb-4">
    <strong>Χρήστης Ενημέρωσης:</strong> {{ $admission->UserUpdated }}
</div>
<div class="mb-4">
    <strong>Ημερομηνία Ενημέρωσης:</strong> {{ $admission->DateUpdated }}
</div> --}}
    {{-- <div class="mb-4">
    <strong>Συμπλήρωμα 1:</strong> {{ $admission->FillerString1 }}
</div>
<div class="mb-4">
    <strong>Συμπλήρωμα 2:</strong> {{ $admission->FillerString2 }}
</div>
<div class="mb-4">
    <strong>Συμπλήρωμα Int 2:</strong> {{ $admission->FillerInt2 }}
</div>
<div class="mb-4">
    <strong>Συμπλήρωμα Ημερομηνίας:</strong> {{ $admission->FillerDate }}
</div> --}}
</div>
<div class="flex justify-end mt-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Αποθήκευση Νοσηλείας
    </button>
</div>
</form>
@else
<p  class="text-red-500">Λυπάμαι, δεν βρέθηκαν πληροφορίες για την επιλεγμένη εισαγωγή.</p>
@endif

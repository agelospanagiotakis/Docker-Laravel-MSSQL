{{-- SURGERY START <br/> --}}
@if ($surgery)
<form action="{{ route('surgeries.update', $surgery->ID) }}" method="POST" id="surgery-details-form">
    @csrf
    @method('PATCH')
    <input type="hidden" name="active_tab_a" id="surgery_active_tab_a">
    <input type="hidden" name="active_tab_b" id="surgery_active_tab_b">
<div class="flex flex-row justify-between">
    <div class="flex justify-start ">
    Surgery ID:{{$surgery->ID}}
    </div>
    <div class="flex justify-end">

        <button id="printModal"  onclick="openSurgeryModal('{{ $surgery->ID }}')" class="flex items-center justify-center flex-1 px-4 py-2 text-base font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Εκτύπωση πρακτικού επέμβασης
        </button>

        {{-- <a href="#" class="text-white bg-blue-500 prevNos btn hover:bg-blue-60">Εκτύπωση πρακτικού επέμβασης</a> --}}
          {{-- <a href="{{ url('surgeries/id/' . $surgery->ID) }}" class="text-white bg-blue-500 prevNos btn hover:bg-blue-60">Εκτύπωση πρακτικού επέμβασης</a> --}}
        {{-- <button id="print-pdf" class="ml-2 text-white bg-green-500 btn hover:bg-green-600">Print to PDF</button> --}}
    </div>
</div>

<!-- Modal -->
<div id="surgeryModal" class="fixed inset-0 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
    <div class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 ">
        <!-- w-11/12  md:w-3/4 lg:w-1/2-->
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Εκτύπωση Χειρουργικής Επέμβασης</h3>
            <div class="py-3 mt-2 px-7">
                <iframe id="surgeryFrame" class="w-full h-96" src=""></iframe>
            </div>
            <div class="items-center px-4 py-3">
               
                <div class="flex justify-between mt-4 space-x-4">
                    <button id="printModalΑctual"  onclick="window.open('{{ url('/surgeries/pdf') }}/{{ $surgery->ID }}', '_blank')" class="flex items-center justify-center flex-1 px-4 py-2 text-base font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Εκτύπωση σε pdf
                    </button>
                    <button id="printModalHtml"  onclick="printUsingHtml();" class="flex items-center justify-center flex-1 px-4 py-2 text-base font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Εκτύπωση με browser
                    </button>
                    <button id="closeModal" class="flex-1 px-4 py-2 text-base font-medium text-white bg-gray-500 rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Κλείσιμο
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<br />
{{-- @dd($surgery->IstologikaID) --}}
<div class="grid grid-cols-2">
    <strong>ΧΕΙΡΟΥΡΓΟΣ:</strong>
    <input type="text" name="DoctorOperator"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->doctorOperator->FirstName ?? '' }} {{ $surgery->doctorOperator->LastName ?? '' }}">
</div>
<br />
<div class="grid grid-cols-2">
    <strong>ΑΝΑΙΣΘΗΣΙΟΛΟΓΟΣ:</strong>
    <input type="text" name="DoctorAnest"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->doctorAnest->FirstName ?? '' }} {{ $surgery->doctorAnest->LastName ?? '' }}">
{{$surgery->AnestName}}

</div>
<br />

<div class="grid grid-cols-2">
    <strong>ΒΟΗΘΟΣ Α':</strong>
    <input type="text" name="DoctorAssistant"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->doctorAssistant->FirstName ?? '' }} {{ $surgery->doctorAssistant->LastName ?? '' }}">
</div>
<br />

<div class="grid grid-cols-2">
    <strong>ΒΟΗΘΟΣ Β':</strong>
    <input type="text" name="DoctorAssistantB"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="{{ $surgery->doctorAssistantB->FirstName ?? '' }} {{ $surgery->doctorAssistantB->LastName ?? '' }}">
</div>
<br />

<div class="grid grid-cols-2">
    <strong>ΗΜΕΡΟΜΗΝΙΑ:</strong>
    <input type="date" name="DatePerformed"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->DatePerformed ? $surgery->DatePerformed->format('Y-m-d') : '' }}">
</div>
<br />

<div class="grid grid-cols-2">
    <strong>ΑΝΑΙΣΘΗΣΊΑ:</strong>
    <input type="text" name="Anesthesia"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->anesthesia->Value ?? '' }}">
</div>
<br />

<div class="grid grid-cols-2">
    <strong>ΠΡΟΣΠΕΛΑΣΗ:</strong>
    <input type="text" name="Access"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->access->Value ?? '' }}">
</div>
<br />

<div class="grid grid-cols-2">
    <strong>ΕΠΕΜΒΑΣΗ:</strong>
    <input type="text" name="Operation"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->operation->Value ?? '' }}">
</div>
<br />

<div class="grid grid-cols-2">
    <strong>ΙΣΤΟΛΟΓΙΚΗ:</strong>
    <input type="text" name="Istologika"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
         value="{{ $surgery->istologika->Value ?? '' }}">
</div>
<br />

@if ($surgery->textsSurgery)
    {{-- @dd($surgery->textsSurgery) --}}
@else
    Δεν υπάρχουν λεπτομερειες κειμένων  για αυτή την χειρουργική επέμβαση <br />
@endif

ΤΟΜΗ ΜΑΛΑΚΩΝ ΙΣΤΩΝ
<span class="text-orange">
    <textarea name="SuBaccess" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
        @if ($surgery->textsSurgery)
            {{ e($surgery->textsSurgery->SuBaccess ?? '') }}
        @endif 
        </textarea>
</span>
<br />

ΟΣΤΙΚΗ ΠΡΟΣΠΕΛΑΣΗ <span class="text-orange">
    <textarea name="SuCut" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
        @if ($surgery->textsSurgery)
            {{ e($surgery->textsSurgery->SuCut ?? '') }}
        @endif 
          </textarea>
</span>
<br />


ΕΜΦΥΤΕΥΜΑΤΑ/ΑΝΑΛΩΣΗΜΑ <span class="text-orange">
    <textarea name="SuImplants" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
>
@if ($surgery->textsSurgery)
{{ e($surgery->textsSurgery->SuImplants ?? '') }}
@endif 
    </textarea>
</span>
<br />

ΚΥΡΙΩΣ ΕΠΕΜΒΑΣΗ <span class="text-orange">
    <textarea name="SuAbout" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
        @if ($surgery->textsSurgery)
{{ e($surgery->textsSurgery->SuAbout ?? '') }}
        @endif 
    
    </textarea>
</span>
<br />

{{-- SURGER END --}}

@else
    Δεν υπάρχουν λεπτομερειες Χειρουργικής Επέμβασης για αυτή την εξέταση
@endif
<hr />

<button id="printModalHtml" onclick="printUsingHtml()" class="flex items-center justify-center flex-1 px-4 py-2 text-base font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
    </svg>
    Εκτύπωση με HTML
</button>
<div class="flex justify-end mt-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Αποθήκευση Χειρουργείου
    </button>
</div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const surgeryForm = document.getElementById('surgery-details-form');
        if(surgeryForm) {
            surgeryForm.addEventListener('submit', function(e) {
                const activeTabA = document.querySelector('input[name="my_tabs_A"]:checked');
                const activeTabB = document.querySelector('input[name="my_tabs_B"]:checked');
                if (activeTabA) {
                    document.getElementById('surgery_active_tab_a').value = activeTabA.getAttribute('aria-label');
                }
                if (activeTabB) {
                    document.getElementById('surgery_active_tab_b').value = activeTabB.getAttribute('aria-label');
                }
            });
        }
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
function printUsingHtml() {

    document.getElementById('surgeryFrame').contentWindow.print();

    // Get the content to print
    // document.getElementById('surgeryFrame').parent.focus();
    // document.getElementById('surgeryFrame').parent.print();
    // window.focus();
    // window.print();
    // const content = document.getElementById('surgeryFrame').contentDocument.body;
    // console.log("content");
    // console.log(content.innerHTML);
    
    // Configure the PDF options
    // const opt = {
    //     margin: 10,
    //     filename: 'surgery_details.pdf',
    //     image: { type: 'jpeg', quality: 0.98 },
    //     html2canvas: { scale: 2 },
    //     jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    // };

    // Generate and save the PDF
    // html2pdf().from(content).set(opt).save();
    // html2pdf().from(content.innerHTML).save();
}
</script>
<script>

    function openSurgeryModal(surgeryId) {
        const modal = document.getElementById('surgeryModal');
        const frame = document.getElementById('surgeryFrame');
        frame.src = `{{ url('/surgeries/modal') }}/${surgeryId}`;
        modal.classList.remove('hidden');
    }
    
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('surgeryModal').classList.add('hidden');
    });
</script>

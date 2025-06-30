certificate start
<br />
<div>
<form action="{{ route('certificates.update', $certificate->ID) }}" method="POST" id="certificate-details-form">
    @csrf
    @method('PATCH')
    <input type="hidden" name="active_tab_a" id="certificate_active_tab_a">
    <input type="hidden" name="active_tab_b" id="certificate_active_tab_b">
@if ($certificate != null)
    certificateID: {{ $certificate->ID }}
    @if ($certificate->textsCertificate)
        {{-- textsCertificate: @dd($certificate->textsCertificate) --}}
    @else
        δεν υπάρχουν πληροφορίες textsCertificate για το πιστοποιητικό
    @endif
        {{--
         <p>Issued Date: {{ e($certificate->IssuedDate) }}</p>
        <p>Notes: {{ e($certificate->Notes) }}</p>
        <p>FromDate: {{ e($certificate->FromDate) }}</p>
        <p>ToDate: {{ e($certificate->ToDate) }}</p>
        <p>FillerString: {{ e($certificate->FillerString) }}</p>
        <p>FillerInt: {{ e($certificate->FillerInt) }}</p>
        
        <p>UserInserted: {{ e($certificate->UserInserted) }}</p>
        <p>DateInserted: {{ e($certificate->DateInserted) }}</p>
        <p>UserUpdated: {{ e($certificate->UserUpdated) }}</p>
        <p>DateUpdated: {{ e($certificate->DateUpdated) }}</p>
         --}}
        <div class="grid grid-cols-2">
            <div class="">

                <div class="grid grid-rows-2">
                    <div class="grid grid-cols-2">
                        <strong>ΘΕΡΑΠΩΝ ΙΑΤΡΟΣ:</strong>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=""
                            value="{{ e($certificate->doctorA->FirstName) }} {{ e($certificate->doctorA->LastName) }}">

                    </div>

                    <div class="grid grid-cols-2">
                        <strong>ΕΙΔΙΚΕΥΟΜΕΝΟΣ ΙΑΤΡΟΣ:</strong>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=""
                            value="{{ e($certificate->doctorB->FirstName ?? '') }} {{ e($certificate->doctorB->LastName ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="">
                <div class="grid grid-cols-2">
                    <strong>ΝΟΣΗΛΕΙΑ ΑΠΟ:</strong>
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" value="{{ e($certificate->FromDate) }}">
                </div>
                <div class="">
                    <div class="grid grid-cols-2">
                        <strong>ΝΟΣΗΛΕΙΑ ΕΩΣ:</strong>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="" value="{{ e($certificate->ToDate) }}">
                    </div>
                </div>
            </div>
        </div>
            <BR />
            {{-- @dd($textsCertificates) --}}
            
                 {{-- @dd($certificate->textsCertificate) --}}
                ΠΑΡΟΥΣΑ ΝΟΣΟΣ: <br />
                <textarea name="CeParousa" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    @if ($certificate->textsCertificate)
                    {{ e($certificate->textsCertificate->CeParousa) }}
                    @endif 
                </textarea>
                ΑΤΟΜΙΚΟ: <br />
                <textarea name="CeAtomiko" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    @if ($certificate->textsCertificate)
                    {{ e($certificate->textsCertificate->CeAtomiko ?? '') }}
                    @endif 
                    </textarea>
                ΝΕΥΡΟΛΟΓΙΚΗ ΕΞΕΤΑΣΗ: <br />
                <textarea name="CeNeuron" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    @if ($certificate->textsCertificate)
                    {{ e($certificate->textsCertificate->CeNeuron ?? '') }}
                    @endif 
                </textarea>
                ΑΠΕΙΚΟΝΙΣΤΙΚΆ: <br />
                <textarea name="ceProjections" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   >
                   @if ($certificate->textsCertificate)
                   {{ e($certificate->textsCertificate->ceProjections ?? '') }}
                   @endif 
                   </textarea>

                ΠΟΡΕΙΑ-ΕΠΕΜΒΑΣΕΙΣ: <br />
                <textarea name="cePoreia" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                >
                @if ($certificate->textsCertificate)
                {{ e($certificate->textsCertificate->cePoreia ?? '') }}
                @endif         
            </textarea>

                ΦΑΡΜΑΚΕΥΤΙΚΗ ΑΓΩΓΗ: <br />
                <textarea name="ceDrugs" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    @if ($certificate->textsCertificate)
                    {{ e($certificate->textsCertificate->ceDrugs ?? '') }}
                    @endif         
                </textarea>

                ΟΔΗΓΙΕΣ: <br />
                <textarea name="CeDirections" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    
                    >
                    @if ($certificate->textsCertificate)
                    {{ e($certificate->textsCertificate->CeDirections ?? '') }}
                    @endif         
                </textarea>

                ΑΝΑΡΩΤΙΚΗ ΑΔΕΙΑ: <br />
                <textarea name="CeSickLeave" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    
                    >
                    @if ($certificate->textsCertificate)
                    {{ e($certificate->textsCertificate->CeSickLeave ?? '') }}
                    @endif         
                </textarea>


       

            <BR />
        </div>
        @else
                δεν υπάρχουν πληροφορίες για το πιστοποιητικό
@endif

certificate end
<div class="flex justify-end mt-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Αποθήκευση Πιστοποιητικού
    </button>
</div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const certificateForm = document.getElementById('certificate-details-form');
        if(certificateForm) {
            certificateForm.addEventListener('submit', function(e) {
                const activeTabA = document.querySelector('input[name="my_tabs_A"]:checked');
                const activeTabB = document.querySelector('input[name="my_tabs_B"]:checked');
                if (activeTabA) {
                    document.getElementById('certificate_active_tab_a').value = activeTabA.getAttribute('aria-label');
                }
                if (activeTabB) {
                    document.getElementById('certificate_active_tab_b').value = activeTabB.getAttribute('aria-label');
                }
            });
        }
    });
</script>

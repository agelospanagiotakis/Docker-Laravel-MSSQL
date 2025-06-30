<!-- In resources/views/patients/show.blade.php -->

@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif
    <div class="container p-4 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Καρτέλα Ασθενή</h1>
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-2 text-xl font-semibold">Στοιχεία Ασθενούς</h2>

            <form action="{{ route('patients.update', $patient->ID) }}" method="POST" id="patient-details-form">
                @csrf
                <input type="hidden" name="active_tab_a" id="active_tab_a">
                <input type="hidden" name="active_tab_b" id="active_tab_b">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <strong>Επώνυμο:</strong> {{ e($patient->LastName) }}
                    </div>
                    <div>
                        <strong>Όνομα:</strong> {{ e($patient->FirstName) }}
                    </div>
                    <div>
                        <strong>Φύλο:</strong>
                        @if ($patient->Gender == 1)
                            Άνδρας
                        @elseif ($patient->Gender == 2)
                            Γυναίκα
                        @else
                            Άγνωστο
                        @endif
                    </div>
                    <div>
                        <strong>Έτος γέννησης:</strong> {{ e($patient->BirthYear) }}
                    </div>
                    <div>
                        <label for="address" class="block font-medium text-gray-700">Διεύθυνση:</label>
                        <input type="text" name="Address" id="address" value="{{ e($patient->Address) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="first-phone" class="block font-medium text-gray-700">Τηλέφωνο 1:</label>
                        <input type="text" name="FirstPhone" id="first-phone" value="{{ e($patient->FirstPhone) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="second-phone" class="block font-medium text-gray-700">Τηλέφωνο 2:</label>
                        <input type="text" name="SecondPhone" id="second-phone" value="{{ e($patient->SecondPhone) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="third-phone" class="block font-medium text-gray-700">Τηλέφωνο 3:</label>
                        <input type="text" name="ThirdPhone" id="third-phone" value="{{ e($patient->ThirdPhone) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <strong>ΑΜΚΑ:</strong> {{ e($patient->Code) }}
                    </div>
                </div>

                <div class="flex items-center justify-start mt-4 space-x-4">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-blue-500 border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        << Επιστροφή
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Αποθήκευση
                    </button>
                </div>
            </form>
        </div>





        <div class="flex flex-row gap-1">
            <div class="basis-2/4 ">
                <div>

                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center justify-center ">
                            <a class="text-white bg-blue-500 prevNos btn hover:bg-blue-60">&lt;</a>
                        </div>

                        <div class="flex items-center justify-center">
                            <select id="admission-select" name="admission-select" class="mt-1 sm:text-sm ">
                                @foreach ($admissions as $admission)
                                    <option value="{{ $admission->ID }}"
                                        {{ $selectedAdmissionId == $admission->ID ? 'selected' : '' }}>
                                        {{ $loop->iteration }}. {{$admission->ID}} / {{ e($admission->FromDate) }} -
                                        {{ e($admission->Cause) }}
                                    </option>
                                @endforeach
                            </select>

                            
                        </div>

                        <div class="flex items-center justify-center">
                            <a class="text-white bg-blue-500 nextNos btn hover:bg-blue-60">&gt;</a>
                        </div>

                    </div>

                    <div class="relative">
                        <div id="loading-spinner" class="absolute inset-0 flex items-center justify-center hidden bg-white bg-opacity-80">
                            <svg class="w-5 h-5 text-gray-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="ml-2">Παρακαλω περιμένετε φορτώνει...</span>
                        </div>
                    </div>
                    <br />
                    <div role="tablist" class="tabs tabs-lifted">
                        <input type="radio" name="my_tabs_A" role="tab"  class="h-20 min-h-15 tab " aria-label="Νοσηλείες"
                            checked="checked" />
                        <div role="tabpanel" class="p-2 tab-content bg-base-100 border-base-300 rounded-box">
                           
                            <div id="admission-details-container" class="p-4 mt-2 bg-gray-100 rounded-lg">
                                <div id="admission-details-content">
                                    @if ($selectedAdmission)
                                    showing last admission
                                        @include('patients.partials.admission-details', ['admission' => $selectedAdmission])
                                    @else
                                        <p class="text-red-500">No admission selected.</p>
                                    @endif
                                </div>
                            </div>

                        <input type="radio" name="my_tabs_A" role="tab"  class="h-20 min-h-15 tab " aria-label="Εξ. Ιατρείο" />
                        <div role="tabpanel" class="p-6 tab-content bg-base-100 border-base-300 rounded-box">
                            Εξ. Ιατρείο
                        </div>
                    </div>

                </div>
            </div>
            <div class="basis-3/4 ">

                <div role="tablist" class="h-20 min-h-15 tabs tabs-lifted ">
                    <input type="radio" name="my_tabs_B" role="tab" class="h-20 min-h-15 tab " aria-label="ΚΛΙΝΙΚΑ ΣΤΟΙΧΕΙΑ"
                         />
                    <div role="tabpanel" class="w-full p-2 tab-content bg-base-100 border-base-300 rounded-box">
                        <div id="clinical-details-container" class="p-4 mt-2 bg-gray-100 rounded-lg">
                            <div id="clinical-details-content">
                                @if ($selectedAdmission)
                                    @include('patients.partials.clinicals-details', ['admission' => $selectedAdmission])
                                @endif
                            </div>
                        </div>
                    </div>

                    <input type="radio" name="my_tabs_B" role="tab" class="h-20 tab min-h-15 "
                        aria-label="ΠΡΑΚΤΙΚΟ ΕΠΕΜΒΑΣΗΣ" />
                    <div role="tabpanel" class="p-2 tab-content bg-base-100 border-base-300 rounded-box">
                                <label for="surgery-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Επιλέξτε επεμβαση:</label>
                                <select id="surgery-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Επιλέξτε επεμβαση</option>
                                    @if($selectedAdmission)
                                        @foreach ($selectedAdmission->surgeries as $surgery)
                                            <option value="{{ $surgery->ID }}"
                                                {{ $selectedSurgeryID == $surgery->ID ? 'selected' : '' }}>
                                                {{ $loop->iteration }}. 
                                                {{$surgery->ID}}  /  {{ $surgery->DatePerformed->format('Y-m-d') }} - {{ $surgery->operation->Value ?? '' }}
                                                {{ e($surgery->ID) }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            <div id="surgery-details-container" class="p-4 mt-2 bg-gray-100 rounded-lg">
                                <div id="surgery-details-content">
                                    @if ($selectedSurgeryID)
                                        @include('patients.partials.surgery-details', ['surgeryid' => $selectedSurgery->ID])
                                    @else
                                        Δεν επιλέχθηκε επεμβαση
                                    @endif
                                </div>
                            </div>
                    </div>
                    <input type="radio" name="my_tabs_B" role="tab" class="h-20 min-h-15 tab " aria-label="ΠΙΣΤΟΠΟΙΗΤΙΚΌ"
                        checked="checked" />
                            <div role="tabpanel" class="w-full p-2 tab-content bg-base-100 border-base-300 rounded-box">
                                <label for="certificate-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Επιλέξτε πιστοποιητικό
                                    :</label>
                                <select id="certificate-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select a certificate</option>
                                    @if($selectedAdmission)
                                        @foreach ($selectedAdmission->certificates as $cert)
                                            <option value="{{ $cert->ID }}"
                                                {{ $selectedCertificateID == $cert->ID ? 'selected' : '' }}>
                                                {{ $loop->iteration }}. 
                                                {{ $cert->ID }} -   {{ $cert->IssuedDate }} - (από {{ $cert->FromDate }} - εώς {{ $cert->ToDate }}
                                                {{ e($cert->ID) }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>

                                
                                <div id="certificate-details-container" class="p-4 mt-2 bg-gray-100 rounded-lg">
                                    <div id="certificate-details-content">
                                       
                                        selectedCertificateID: {{$selectedCertificateID}}
                                        @if ($selectedCertificateID)
                                                @include('patients.partials.certificate-details', ['certificate' => $selectedCertificate])
                                        @else
                                                Δεν επιλέχθηκε πιστοποιητικό	
                                            @endif
                                        <hr />
                                    
                                    </div>
                                </div>
                              
                        </div>

                <input type="radio" name="my_tabs_B" role="tab" class="h-20 min-h-15 tab" aria-label="ΟΓΚΟΛΟΓΙΚΗ ΠΟΡΕΊΑ"
                />
                    <div role="tabpanel" class="w-full p-2 tab-content bg-base-100 border-base-300 rounded-box">
                todo: fill these
                ΑΚΤΙΝΟΘΕΡΑΠΕΊΑ: <br />
                        <textarea rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                        </textarea>
                        <br />
                        ΧΗΜΕΙΟΘΕΡΑΠΕΊΑ: <br />
                        <textarea rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="">
                    </textarea>
                    <br />
                        ΣΧΟΛΙΑ: <br />
                        <textarea rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="">
                    </textarea>

                </div>
            </div>
        </div>
    </div>




    </div>

    </div>
    </div>

    </div>
@section('scripts')
<script>
  const detailsContainers = {
            admission: document.getElementById('admission-details-content'),
            clinical: document.getElementById('clinical-details-content'),
            surgery: document.getElementById('surgery-details-content'),
            certificate: document.getElementById('certificate-details-content')
        };
        const admissionSelect = document.getElementById('admission-select');
        const prevButton = document.querySelector('.prevNos');
        const nextButton = document.querySelector('.nextNos');
 
function showLoading() {
        const loadingSpinner = document.getElementById('loading-spinner');
        loadingSpinner.classList.remove('hidden');
            Object.values(detailsContainers).forEach(container => {
                if (container) container.classList.add('opacity-50');
            });
        }

        function hideLoading() {
            const loadingSpinner = document.getElementById('loading-spinner');
            loadingSpinner.classList.add('hidden');
            Object.values(detailsContainers).forEach(container => {
                if (container) container.classList.remove('opacity-50');
            });
        }


    function updateButtonStates() {
        const options = Array.from(admissionSelect.options);
        const currentIndex = options.findIndex(option => option.selected);

        prevButton.classList.toggle('opacity-50', currentIndex === 0);
        prevButton.classList.toggle('cursor-not-allowed', currentIndex === 0);
        prevButton.disabled = currentIndex === 0;

        nextButton.classList.toggle('opacity-50', currentIndex === options.length - 1);
        nextButton.classList.toggle('cursor-not-allowed', currentIndex === options.length - 1);
        nextButton.disabled = currentIndex === options.length - 1;
    }

    function updateSelect(selectElement, options, valueKey, labelFunction) {
        selectElement.innerHTML = '<option value="">Select an option</option>';
        options.forEach((option, index) => {
        const optionElement = document.createElement('option');
        optionElement.value = option[valueKey];
        optionElement.textContent = `${index + 1}. ${labelFunction(option)}`;
        selectElement.appendChild(optionElement);
        });
    }

    // Function to change selected option
    function changeAdmission(direction) {
        const options = Array.from(admissionSelect.options);
        const currentIndex = options.findIndex(option => option.selected);
        let newIndex;

        if (direction === 'prev') {
            newIndex = Math.max(0, currentIndex - 1);
        } else if (direction === 'next') {
            newIndex = Math.min(options.length - 1, currentIndex + 1);
        }

        if (newIndex !== currentIndex) {
            admissionSelect.selectedIndex = newIndex;
            admissionSelect.dispatchEvent(new Event('change'));
        }

        updateButtonStates();
    }

    document.addEventListener('DOMContentLoaded', function() {
      
        // Event listener for previous button
    prevButton.addEventListener('click', function(e) {
            e.preventDefault();
            changeAdmission('prev');
        });

        // Event listener for next button
        nextButton.addEventListener('click', function(e) {
            e.preventDefault();
            changeAdmission('next');
        });
        admissionSelect.addEventListener('change', function() {
            updateButtonStates();
            const admissionSelectId = this.value;
            console.log("admissionSelectId : ", admissionSelectId);
            //load the surgeryid from the seclect input
            const surgerySelect = document.getElementById('surgery-select');
            const certificateSelect = document.getElementById('certificate-select');
            const surgeryId = surgerySelect.value;
            const certificateId = certificateSelect.value;
            console.log("surgeryId :  ", surgeryId);
            console.log("certificateId : ", certificateId);
            showLoading();
             // Fetch all details for surgery and certificates
                Promise.all([
                    fetch(`{{ url('/admissions/surgerieslist') }}/${admissionSelectId}`).then(response => response.json()),
                    fetch(`{{ url('/admissions/certificateslist') }}/${admissionSelectId}`).then(response => response.json())
                ]).then(([surgeries, certificates]) => {
                    console.log("surgeries fetched: ", surgeries);
                    console.log("certificates fetched: ", certificates);
                    // Update surgery select
                    const surgerySelect = document.getElementById('surgery-select');
                     updateSelect(surgerySelect, surgeries, 'ID', surgery => {
                        return `${surgery.DatePerformed} - ${surgery.operation}`;
                    });
                    if (surgeries.length > 0) {
                        surgerySelect.value = surgeries[0].ID;
                        surgerySelect.dispatchEvent(new Event('change'));
                    }
                    
                    // Update certificate select
                    const certificateSelect = document.getElementById('certificate-select');
                    updateSelect(certificateSelect, certificates, 'ID', cert => `${cert.ID} - ${cert.IssuedDate} - (από ${cert.FromDate} - εώς ${cert.ToDate})`);
                    if (certificates.length > 0) {
                        certificateSelect.value = certificates[0].ID;
                        certificateSelect.dispatchEvent(new Event('change'));
                    }
                }).catch(error => {
                    console.error('Error fetching details:', error);
                }).finally(() => {
                    hideLoading();
                }).then(() => {

                    Promise.all([
                fetch(`{{ url('/admissions/detailsview') }}/${admissionSelectId}`).then(response => response.text()),
                fetch(`{{ url('/admissions/clinicalsview') }}/${admissionSelectId}`).then(response => response.text()),
                fetch(`{{ url('/admissions/surgeriesview') }}/${surgeryId}`).then(response => response.text()),
                fetch(`{{ url('/admissions/certificatesview') }}/${certificateId}`).then(response => response.text())
            ]).then(([admissionHtml, clinicalHtml, surgeryHtml, certificateHtml]) => {
                if (detailsContainers.admission) detailsContainers.admission.innerHTML = admissionHtml;
                if (detailsContainers.clinical) detailsContainers.clinical.innerHTML = clinicalHtml;
                if (detailsContainers.surgery) detailsContainers.surgery.innerHTML = surgeryHtml;
                if (detailsContainers.certificate) detailsContainers.certificate.innerHTML = certificateHtml;
                Object.values(detailsContainers).forEach(container => {
                    if (container) container.classList.remove('opacity-50');
                });
            }).catch(error => {
                console.error('Error fetching details:', error);
            }).finally(() => {
                // Hide loading spinner
                hideLoading();
            });
            

                });
                   
            // Fetch all details
          
        });
    });
   

    
    document.getElementById('certificate-select').addEventListener('change', function() {
            const certificateId = this.value;
            const certDetails = document.getElementById('certificate-details-content');
            if (certificateId) {
                    console.log("certificateId ", certificateId);

                    // Use fetch to get the surgery details from the server
                    fetch(`{{ url('/admissions/certificatesview') }}/${certificateId}`)
                        .then(response => response.text())
                        .then(html => {
                            certDetails.innerHTML = html;
                            certDetails.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching surgery details:', error);
                            certDetails.innerHTML = '<p>Error loading surgery details.</p>';
                            certDetails.classList.remove('hidden');
                        });
                } else {
                    certDetails.innerHTML = '';
                    certDetails.classList.add('hidden');
                }
            
        });
   
        document.getElementById('surgery-select').addEventListener('change', function() {
            const surgeryId = this.value;
            const surgeryDetails = document.getElementById('surgery-details-content');
            if (surgeryId) {
                    console.log("surgeryId ", surgeryId);
                    // Remove the client-side data handling
                    // const selectedSurgery = @json($admission->surgeries);
                    // const surgery = selectedSurgery.find(s => s.ID == surgeryId);

                    // Use fetch to get the surgery details from the server
                    fetch(`{{ url('/admissions/surgeriesview') }}/${surgeryId}`)
                        .then(response => response.text())
                        .then(html => {
                            surgeryDetails.innerHTML = html;
                            surgeryDetails.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching surgery details:', error);
                            surgeryDetails.innerHTML = '<p>Error loading surgery details.</p>';
                            surgeryDetails.classList.remove('hidden');
                        });
                } else {
                    surgeryDetails.innerHTML = '';
                    surgeryDetails.classList.add('hidden');
                }
            
        });


    // Initial button state update
    updateButtonStates();

    document.addEventListener('DOMContentLoaded', function() {
        const patientForm = document.getElementById('patient-details-form');
        if(patientForm) {
            patientForm.addEventListener('submit', function(e) {
                const activeTabA = document.querySelector('input[name="my_tabs_A"]:checked');
                const activeTabB = document.querySelector('input[name="my_tabs_B"]:checked');
                if (activeTabA) {
                    document.getElementById('active_tab_a').value = activeTabA.getAttribute('aria-label');
                }
                if (activeTabB) {
                    document.getElementById('active_tab_b').value = activeTabB.getAttribute('aria-label');
                }
            });
        }

        const activeTabA = "{{ session('active_tab_a') }}";
        const activeTabB = "{{ session('active_tab_b') }}";

        if (activeTabA) {
            const tabA = document.querySelector(`input[name="my_tabs_A"][aria-label="${activeTabA}"]`);
            if (tabA) {
                tabA.checked = true;
            }
        }

        if (activeTabB) {
            const tabB = document.querySelector(`input[name="my_tabs_B"][aria-label="${activeTabB}"]`);
            if (tabB) {
                tabB.checked = true;
            }
        }
    });
    
        </script>
@endsection
@endsection

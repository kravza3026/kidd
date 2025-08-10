<x-app-layout>
    <div class="pageContent">
        <section class="py-section container">
            <div class="relative max-w-2xl mx-auto bg-white p-1 lg:p-8 rounded-lg lg:shadow-lg">
                <div class="flex items-center gap-x-4">
                    <div class="size-10 lg:absolute top-9 -left-14 rounded-full">
                        <a href="{{ route('vacancy.show', $vacancy) }}" class="">
                        <span class="size-full border border-[#eeeeee] rounded-full flex items-center justify-center">
                            <img src="{{ Vite::image('icons/back.svg') }}" alt="date" class="opacity-50">
                        </span>
                        </a>
                    </div>
                    <h2 class="font-bold text-xl lg:text-3xl leading-[-2%]">
                        {{ __('Apply to job') }}
                    </h2>
                </div>

                <form name="application" enctype="multipart/form-data" method="post" action="{{ route('vacancy.application.store', $vacancy) }}" class="mt-8 sm:space-y-4">
                    @csrf

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-select class="p-4"
                                :label="__('Job title')"
                                :disabled="false"
                                name="vacancy_id"
                                id="vacancy_{{ $vacancy->id }}"
                                :placeholder="__('general.placeholder.select.vacancy')"
                                :options="$vacancies"
                                :selected="old('vacancy_id', $vacancy->id)
                            ">
                            </x-select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-ui.input-label required id="first_name" :value="old('first_name', '')" name="first_name" :placeholder="__('First name')" :label="__('First name')" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
                        </div>

                        <div class="w-full">
                            <x-ui.input-label required id="last_name" :value="old('last_name', '')" name="last_name" :placeholder="__('Last name')" :label="__('Last name')" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full mt-6 sm:mt-0">
                            <x-ui.input-label required id="email" autocomplete="email" :value="old('email', '')" type="email" name="email" :placeholder="__('E-mail address')" :label="__('E-mail address')"
                                              :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                        <div class="w-full">
                            <x-ui.input-label required id="phone" autocomplete="phone" placeholder="+373 " :value="old('phone', '')" type="text" name="phone" :placeholder="__('+373 (__) ___ ___')" :label="__
                            ('Phone number')" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                        </div>
                    </div>

                    <div class="flex flex-col items-start gap-0 ">
                        <div class="w-full">

                            <div class="flex flex-col gap-3 mt-3 ">
                                <label for="cv" class="text-[14px] font-medium">
                                    {{ __('Resume') }}
                                </label>
                                <div id="upload-area" class="border border-dashed border-light-border rounded-xl px-5 py-24 text-center relative">
                                    <div id="upload-button" class="absolute inset-0 grid place-items-center justify-center items-center">
                                        <input type="file" id="cv" name="cv" class="hidden" />
                                        <label for="cv" class="cursor-pointer rounded-lg absolute inset-0 flex flex-col items-center justify-center">
                                            <img src="{{ Vite::image('icons/file.png') }}" class="size-10 mx-auto mb-4" alt="">
                                            <span>Select a file to upload</span>
                                            <span class="text-[12px] opacity-40 block">Only *.PDF and *.DOCX accepted</span>
                                        </label>
                                    </div>

                                    <!-- progress bar -->
                                    <div id="progress-container" class="hidden absolute rounded-lg inset-0 flex flex-col items-center justify-center bg-white bg-opacity-90">
                                        <div class="relative grid justify-items-center">
                                            <svg class="duration-150" width="80" height="80">
                                                <circle cx="40" cy="40" r="35" stroke="#e5e7eb" stroke-width="4" fill="none" />
                                                <circle id="progress-circle" cx="40" cy="40" r="35" stroke="#84a059" stroke-width="4" fill="none"
                                                        stroke-linecap="round" stroke-dasharray="219.91" stroke-dashoffset="219.91" />
                                            </svg>
                                            <p>Uploading file...</p>
                                            <div id="progress-text" class="absolute top-[20%] left-[43%] mt-2 text-sm font-bold opacity-65">0%</div>
                                        </div>
                                        <div class="mt-2 text-olive font-medium bg-light-orange px-3 py-1 rounded-lg cursor-pointer" id="cancel-upload">Cancel</div>
                                    </div>

                                    <!-- result -->
                                    <div id="upload-result" class="hidden my-4 flex gap-x-2 items-center justify-between">
                                        <div id="upload-result-file" class="flex items-center gap-x-4">
                                        </div>
                                        <div>
                                            <button id="clear-form" class="p-3 border border-light-border size-10 rounded-full cursor-pointer">
                                                <img src="{{  Vite::image('common/trash.svg') }}" alt="">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">

                            <x-ui.input-label id="cv_url" placeholder="{{ __('or upload from URL.') }}" :value="old('cv_url', '')" name="cv_url" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('cv')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('cv_url')"/>
                        </div>
                    </div>
                    <div class="flex gap-x-4 my-2 items-center">
                        <x-ui.checkbox required></x-ui.checkbox>
                        <p class="leading-[-2%]">By applying, I agree to the <a class="font-bold underline" href="/">Privacy Policy</a></p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-primary-button class="!w-full !py-4 mt-6 sm:mt-0">{{ __('Apply now') }}</x-primary-button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
    <script>
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('cv');
        const uploadButton = document.getElementById('upload-button');
        const progressContainer = document.getElementById('progress-container');
        const progressCircle = document.getElementById('progress-circle');
        const progressText = document.getElementById('progress-text');
        const cancelBtn = document.getElementById('cancel-upload');
        const uploadResult = document.getElementById('upload-result');
        const uploadResultFile = document.getElementById('upload-result-file');
        const clearBtn = document.getElementById('clear-form');
        let intervalId;

        fileInput.addEventListener('change', () => {


            if (!fileInput.files.length) return;
            const file = fileInput.files[0];
            const sizeInBytes = file.size;
            const sizeInMB = (sizeInBytes / (1024 * 1024)).toFixed(2);
            // check file type
            // const allowedTypes = [
            //     'application/pdf',
            //     'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            // ];
            // if (!allowedTypes.includes(file.type)) {
            //     alert('Only PDF and DOCX files are accepted');
            //     fileInput.value = '';
            //     return;
            // }
            progressContainer.classList.remove('hidden');
            uploadResult.classList.add('hidden');

            let percent = 0;
            const circumference = 2 * Math.PI * 35;

            intervalId = setInterval(() => {
                percent += 0.5;
                if (percent > 100) {
                    clearInterval(intervalId);
                    progressContainer.classList.add('hidden');
                    uploadResult.classList.remove('hidden');
                    uploadButton.classList.add('hidden');
                    uploadArea.classList.remove('py-24')
                    uploadResultFile.innerHTML += `
                <span class="p-3 size-10 min-w-10 min-h-10 border bg-light-orange border-light-border rounded-full flex items-center justify-center">
                                                <img src="{{ Vite::image('icons/gradients/g_file.png') }}" alt="file icon">
                                           </span>
                <div class="grid justify-items-start text-[14px] lg:text-base"><span class="file-name truncate max-w-full" title="${file.name}">${file.name}</span> <span class="opacity-40 text-[12px]">${sizeInMB} Mb</span></div>`;
                    return;
                }
                const offset = circumference - (percent / 100) * circumference;
                progressCircle.style.strokeDashoffset = offset;
                progressText.textContent = `${percent.toFixed(0)}%`;
            }, 5);
        });


        clearBtn.addEventListener('click', () => {
            fileInput.value = '';

            // hide progress bar and result
            progressContainer.classList.add('hidden');
            uploadResult.classList.add('hidden');
            uploadArea.classList.add('py-24')
            uploadButton.classList.remove('hidden');
            uploadResultFile.innerHTML = '';

            // stop the interval if it's running'
            if (xhr) {
                xhr.abort();
                xhr = null;
            }
        });

        cancelBtn.addEventListener('click', () => {
            clearInterval(intervalId);
            progressContainer.classList.add('hidden');
        });
    </script>

</x-app-layout>

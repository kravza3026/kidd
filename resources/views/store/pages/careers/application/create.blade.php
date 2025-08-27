<x-app-layout>
    <div class="pageContent">
        <section class="py-section container">
            <div class="relative mx-auto max-w-2xl rounded-lg bg-white p-1 lg:p-8 lg:shadow-lg">
                <div class="flex items-center gap-x-4">
                    <div class="top-9 -left-14 size-10 rounded-full lg:absolute">
                        <a href="{{ route('vacancy.show', $vacancy) }}" class="">
                            <span
                                class="flex size-full items-center justify-center rounded-full border border-[#eeeeee]"
                            >
                                <img src="{{ Vite::image('icons/back.svg') }}" alt="date" class="opacity-50" />
                            </span>
                        </a>
                    </div>
                    <h2 class="text-xl leading-[-2%] font-bold lg:text-3xl">
                        {{ __('careers.vacancy_job_title') }}
                    </h2>
                </div>

                <form
                    name="application"
                    enctype="multipart/form-data"
                    method="post"
                    action="{{ route('vacancy.application.store', $vacancy) }}"
                    class="mt-8 sm:space-y-4"
                >
                    @csrf

                    <div class="flex flex-col items-start justify-between gap-6 sm:flex-row">
                        <div class="w-full">
                            <x-select
                                class="p-4"
                                :label="__('careers.form.vacancy_select_label')"
                                :disabled="true"
                                name="vacancy_id"
                                id="vacancy_{{ $vacancy->id }}"
                                :placeholder="false"
                                :options="$vacancies->prepend(__('general.placeholder.select.vacancy'), 0)"
                                :selected="old('vacancy_id', $vacancy->id)"
                            ></x-select>
                        </div>
                    </div>

                    <div class="flex flex-col items-start justify-between gap-6 sm:flex-row">
                        <div class="w-full">
                            <x-ui.input-label
                                required
                                id="first_name"
                                :value="old('first_name', '')"
                                name="first_name"
                                :placeholder="__('careers.form.first_name_placeholder')"
                                :label="__('careers.form.first_name')"
                                :label-class="'font-medium'"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>

                        <div class="w-full">
                            <x-ui.input-label
                                required
                                id="last_name"
                                :value="old('last_name', '')"
                                name="last_name"
                                :placeholder="__('careers.form.last_name_placeholder')"
                                :label="__('careers.form.last_name')"
                                :label-class="'font-medium'"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>
                    </div>

                    <div class="flex flex-col items-start justify-between gap-6 sm:flex-row">
                        <div class="mt-6 w-full sm:mt-0">
                            <x-ui.input-label
                                required
                                id="email"
                                autocomplete="email"
                                :value="old('email', '')"
                                type="email"
                                name="email"
                                :placeholder="__('careers.form.email_placeholder')"
                                :label="__('careers.form.email')"
                                :label-class="'font-medium'"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div class="w-full">
                            <x-ui.input-label
                                required
                                id="phone"
                                autocomplete="phone"
                                placeholder="+373 "
                                :value="old('phone', '')"
                                type="text"
                                name="phone"
                                :placeholder="__('careers.form.phone_placeholder')"
                                :label="__('careers.form.phone')"
                                :label-class="'font-medium'"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                    </div>

                    <div class="flex flex-col items-start gap-0">
                        <div class="w-full">
                            <div class="mt-3 flex flex-col gap-3">
                                <label for="cv" class="text-sm font-medium">
                                    {{ __('careers.form.resume.label') }}
                                </label>
                                <div
                                    id="upload-area"
                                    class="border-light-border relative rounded-xl border border-dashed px-5 py-24 text-center"
                                >
                                    <div
                                        id="upload-button"
                                        class="absolute inset-0 grid place-items-center items-center justify-center"
                                    >
                                        <input type="file" id="cv" name="cv" value="{{ old('cv') }}" class="hidden" />
                                        <label
                                            for="cv"
                                            class="absolute inset-0 flex cursor-pointer flex-col items-center justify-center rounded-lg"
                                        >
                                            <img
                                                src="{{ Vite::image('icons/olive/file.png') }}"
                                                class="mx-auto mb-4 size-10"
                                                alt=""
                                            />
                                            <span>
                                                {{ __('careers.form.resume.file_label') }}
                                            </span>
                                            <span class="block text-[12px] opacity-40">
                                                {{ __('careers.form.resume.file_label_desc') }}
                                            </span>
                                        </label>
                                    </div>

                                    <!-- progress bar -->
                                    <div
                                        id="progress-container"
                                        class="bg-opacity-90 absolute inset-0 flex hidden flex-col items-center justify-center rounded-lg bg-white"
                                    >
                                        <div class="relative grid justify-items-center">
                                            <svg class="duration-150" width="80" height="80">
                                                <circle
                                                    cx="40"
                                                    cy="40"
                                                    r="35"
                                                    stroke="#e5e7eb"
                                                    stroke-width="4"
                                                    fill="none"
                                                />
                                                <circle
                                                    id="progress-circle"
                                                    cx="40"
                                                    cy="40"
                                                    r="35"
                                                    stroke="#84a059"
                                                    stroke-width="4"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-dasharray="219.91"
                                                    stroke-dashoffset="219.91"
                                                />
                                            </svg>
                                            <p>
                                                {{ __('careers.form.resume.uploading') }}
                                            </p>
                                            <div
                                                id="progress-text"
                                                class="absolute top-[23%] left-[39%] mt-2 text-sm font-bold opacity-65"
                                            >
                                                0%
                                            </div>
                                        </div>
                                        <div
                                            class="text-olive bg-light-orange mt-2 cursor-pointer rounded-lg px-3 py-1 font-medium"
                                            id="cancel-upload"
                                        >
                                            {{ __('careers.form.resume.cancel_button') }}
                                        </div>
                                    </div>

                                    <!-- result -->
                                    <div
                                        id="upload-result"
                                        class="my-4 flex hidden items-center justify-between gap-x-2"
                                    >
                                        <div id="upload-result-file" class="flex items-center gap-x-4"></div>
                                        <div>
                                            <button
                                                id="clear-form"
                                                class="border-light-border size-10 cursor-pointer rounded-full border p-3"
                                            >
                                                <img src="{{ Vite::image('common/trash.svg') }}" alt="" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <x-ui.input-label
                                id="cv_url"
                                placeholder="{{ __('careers.form.resume.url_placeholder') }}"
                                :value="old('cv_url', '')"
                                name="cv_url"
                                :label-class="'font-medium'"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('cv')" />
                            <x-input-error class="mt-2" :messages="$errors->get('cv_url')" />
                        </div>
                    </div>
                    <div class="my-8 flex items-center gap-x-4">
                        <x-ui.checkbox required name="terms"></x-ui.checkbox>
                        <label for="terms" class="leading-[-2%]">
                            {!! __('general.checkbox.terms', ['url' => route('terms')]) !!}
                        </label>
                        <x-input-error class="mt-2" :messages="$errors->get('terms')" />
                    </div>
                    <div class="flex flex-col items-start justify-between gap-6 sm:flex-row">
                        <div class="w-full">
                            <x-primary-button class="mt-6 !w-full !py-4 sm:mt-0">
                                {{ __('careers.form.submit') }}
                            </x-primary-button>
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
                    uploadArea.classList.remove('py-24');
                    uploadResultFile.innerHTML += `
                <span class="p-3 size-10 min-w-10 min-h-10 border bg-light-orange border-light-border rounded-full flex items-center justify-center">
                                                <img src="{{ Vite::image('icons/gradients/g_file.png') }}" alt="file icon">
                                           </span>
                <div class="grid justify-items-start text-sm lg:text-base"><span class="file-name truncate max-w-full" title="${file.name}">${file.name}</span> <span class="opacity-40 text-[12px]">${sizeInMB} Mb</span></div>`;
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
            uploadArea.classList.add('py-24');
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

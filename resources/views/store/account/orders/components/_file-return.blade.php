<div class="flex flex-col items-start gap-0">
    <div class="w-full">
        <div class="mt-3 flex flex-col gap-3">
            <label for="return" class="text-sm font-medium">
                Upload images <span class="opacity-40">(optional)</span>
            </label>
            <div
                id="upload-area"
                class="border-light-border relative rounded-xl border border-dashed px-5 py-24 text-center"
            >
                <div
                    id="upload-button"
                    class="absolute inset-0 grid place-items-center items-center justify-center"
                >
                    <input type="file" id="return" name="return" value="" class="hidden" />
                    <label
                        for="return"
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
                            <img src="{{ Vite::image('common/trash.svg') }}" alt="trash" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('return');
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

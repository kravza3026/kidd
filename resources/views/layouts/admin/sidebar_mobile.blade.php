{{-- Mobile navigation drawer. Opened by the header hamburger (command="show-modal"
     commandfor="sidebar"). Renders the same navigation as the desktop sidebar, always
     expanded (labels + group headings visible). --}}
<el-dialog>
    <dialog id="sidebar" class="backdrop:bg-transparent lg:hidden">
        <el-dialog-backdrop
            class="fixed inset-0 bg-gray-900/70 transition-opacity duration-300 ease-linear data-closed:opacity-0"
        ></el-dialog-backdrop>

        <div tabindex="0" class="fixed inset-0 flex focus:outline-none">
            <el-dialog-panel
                class="group/dialog-panel relative mr-16 flex w-full max-w-xs flex-1 transform transition duration-300 ease-in-out data-closed:-translate-x-full"
            >
                <div
                    class="absolute top-0 left-full flex w-16 justify-center pt-4 duration-300 ease-in-out group-data-closed/dialog-panel:opacity-0"
                >
                    <button type="button" command="close" commandfor="sidebar" class="-m-2.5 p-2.5">
                        <span class="sr-only">{{ __('Close sidebar') }}</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6 text-white">
                            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="relative flex grow flex-col overflow-y-auto bg-surface px-3 py-4">
                    <div class="mb-4 flex h-9 shrink-0 items-center px-1.5">
                        <a href="{{ route('admin.home') }}" wire:navigate class="flex items-center gap-2">
                            <span class="flex size-7 shrink-0 items-center justify-center rounded-lg bg-olive text-sm font-bold text-white" style="font-family: var(--font-display)">k</span>
                            <span class="text-sm font-bold tracking-tight text-ink" style="font-family: var(--font-display)">kidd<span class="text-olive">.</span>admin</span>
                        </a>
                    </div>

                    @include('layouts.admin._nav', ['collapsible' => false])
                </div>
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>

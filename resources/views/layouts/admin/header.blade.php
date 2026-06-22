<div class="sticky top-0 z-40 lg:mx-auto lg:max-w-7xl lg:px-8">
    <div
        class="flex h-14 items-center gap-x-3 border-b border-line bg-surface px-4 shadow-xs sm:gap-x-5 sm:px-6 lg:px-0 lg:shadow-none"
    >
        <button
            type="button"
            command="show-modal"
            commandfor="sidebar"
            class="-m-2.5 p-2.5 text-ink-muted hover:text-ink lg:hidden"
        >
            <span class="sr-only">Open sidebar</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>

        <div aria-hidden="true" class="h-6 w-px bg-line lg:hidden"></div>

        <div class="flex flex-1 items-center gap-x-3 self-stretch lg:gap-x-5">
            <button
                type="button"
                @click="$dispatch('admin-palette')"
                class="flex flex-1 items-center gap-2 rounded-lg border border-line bg-surface-2 px-3 py-1.5 text-sm text-ink-muted hover:text-ink"
            >
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-4">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <span class="hidden sm:inline">{{ __('Search & jump…') }}</span>
                <kbd class="ml-auto hidden rounded border border-line px-1.5 py-0.5 text-[10px] sm:inline">⌘K</kbd>
            </button>

            <div class="flex items-center gap-x-2 lg:gap-x-3">
                {{-- Theme switcher --}}
                <button
                    type="button"
                    x-data="{ dark: document.documentElement.classList.contains('dark') }"
                    @click="dark = !dark; document.documentElement.classList.toggle('dark', dark); localStorage.setItem('admin-theme', dark ? 'dark' : 'light')"
                    class="flex size-9 items-center justify-center rounded-lg text-ink-muted hover:bg-surface-2 hover:text-ink"
                    :aria-label="dark ? '{{ __('Switch to light mode') }}' : '{{ __('Switch to dark mode') }}'"
                >
                    <svg x-show="!dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-5">
                        <path d="M21.752 15.002A9.718 9.718 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg x-show="dark" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-5">
                        <path d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                {{-- Density toggle --}}
                <button
                    type="button"
                    x-data="{ comfortable: document.documentElement.dataset.density === 'comfortable' }"
                    @click="comfortable = !comfortable; document.documentElement.dataset.density = comfortable ? 'comfortable' : 'compact'; localStorage.setItem('admin-density', document.documentElement.dataset.density)"
                    class="hidden size-9 items-center justify-center rounded-lg text-ink-muted hover:bg-surface-2 hover:text-ink sm:flex"
                    :aria-label="comfortable ? '{{ __('Compact density') }}' : '{{ __('Comfortable density') }}'"
                >
                    <svg x-show="!comfortable" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-5">
                        <path d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg x-show="comfortable" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-5">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                {{-- Notifications (wired up in Phase 7) --}}
                <button type="button" class="flex size-9 items-center justify-center rounded-lg text-ink-muted hover:bg-surface-2 hover:text-ink">
                    <span class="sr-only">View notifications</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-5">
                        <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div aria-hidden="true" class="hidden lg:block lg:h-6 lg:w-px lg:bg-line"></div>

                <el-dropdown class="relative">
                    <button class="relative flex items-center gap-2">
                        <span class="flex size-8 items-center justify-center rounded-full bg-olive/15 text-sm font-semibold text-dark-olive dark:text-olive">
                            {{ \Illuminate\Support\Str::of(auth()->user()->name)->substr(0, 1)->upper() }}
                        </span>
                        <span class="hidden text-sm font-semibold text-ink lg:block">{{ auth()->user()->name }}</span>
                    </button>
                    <el-menu
                        anchor="bottom end"
                        popover
                        class="mt-2 w-44 origin-top-right rounded-lg border border-line bg-surface py-1.5 shadow-lg transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in"
                    >
                        <a href="{{ route('admin.home') }}" class="block px-3 py-1.5 text-sm text-ink hover:bg-surface-2">
                            {{ __('Dashboard') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-3 py-1.5 text-left text-sm text-ink hover:bg-surface-2">
                                {{ __('Sign out') }}
                            </button>
                        </form>
                    </el-menu>
                </el-dropdown>
            </div>
        </div>
    </div>
</div>

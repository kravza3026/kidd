@props([])

<div class="space-y-3">
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => (show = false), 5000)"
            class="rounded-lg border border-olive/30 bg-olive/10 px-4 py-2.5 text-sm text-dark-olive dark:text-olive"
        >
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-danger/30 bg-danger/10 px-4 py-2.5 text-sm text-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-lg border border-danger/30 bg-danger/10 px-4 py-2.5 text-sm text-danger">
            <p class="font-semibold">{{ __('Please fix the following:') }}</p>
            <ul class="mt-1 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

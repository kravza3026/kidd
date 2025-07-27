<x-app-layout>
    @push('head')
        <!-- // Here are the styles -->
{{--        <link rel="stylesheet" href="{{ asset('css/locations.css') }}">--}}
    @endpush

    <div class="pageContent">
        <section class="container pt-section">
            Locations {{ app()->getLocale() }}
        </section>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize any JavaScript functionality here if needed
                console.log('Locations page loaded');
            });
        </script>
    @endpush
</x-app-layout>

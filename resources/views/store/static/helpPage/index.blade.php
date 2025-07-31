<x-app-layout>
    <div class="pageContent">
        <section class="pt-section">
            <div data-vue-component="HelpMain"></div>

            {{-- Таби як шаблони --}}
            <script type="text/x-template" id="tab-DeliveryTab">
                @include('.store.static.helpPage.tabs.delivery')
            </script>


        </section>
    </div>
</x-app-layout>

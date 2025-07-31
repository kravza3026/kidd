<x-app-layout>
    <div class="pageContent">
        <section class="pt-section">
            <div data-vue-component="HelpMain"></div>

            {{-- Таби як шаблони --}}
            <script type="text/x-template" id="tab-DeliveryTab">
                @include('.store.static.helpPage.tabs.delivery')
            </script>
            <script type="text/x-template" id="tab-PaymentsTab">
                @include('.store.static.helpPage.tabs.payments')
            </script>
            <script type="text/x-template" id="tab-AccountTab">
                @include('.store.static.helpPage.tabs.account')
            </script>
            <script type="text/x-template" id="tab-TechnicalTab">
                @include('.store.static.helpPage.tabs.technical')
            </script>

        </section>
    </div>
</x-app-layout>

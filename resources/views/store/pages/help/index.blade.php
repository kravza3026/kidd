<x-app-layout>
    <div class="pageContent">
        <section class="pt-section">
            <div data-vue-component="HelpMain"></div>

            <script type="text/x-template" id="tab-DeliveryTab">
                @include('.store.pages.help.tabs.delivery')
            </script>
            <script type="text/x-template" id="tab-PaymentsTab">
                @include('.store.pages.help.tabs.payments')
            </script>
            <script type="text/x-template" id="tab-AccountTab">
                @include('.store.pages.help.tabs.account')
            </script>
            <script type="text/x-template" id="tab-TechnicalTab">
                @include('.store.pages.help.tabs.technical')
            </script>

        </section>
    </div>
</x-app-layout>

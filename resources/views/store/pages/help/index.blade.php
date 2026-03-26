<x-app-layout>
    <div class="pageContent">
        <section class="pt-section">
            @php
                $tabs = [
                    'DeliveryTab'  => view('.store.pages.help.tabs.delivery')->render(),
                    'PaymentsTab'  => view('.store.pages.help.tabs.payments')->render(),
                    'AccountTab'   => view('.store.pages.help.tabs.account')->render(),
                    'TechnicalTab' => view('.store.pages.help.tabs.technical')->render(),
                ];
            @endphp
            <help-main :tabs='@json($tabs)'></help-main>

        </section>
    </div>
</x-app-layout>

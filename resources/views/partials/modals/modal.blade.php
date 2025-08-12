<div>
    <p class="text-[32px]">
        {!! session('modal')['title'] ?? __('general.modal.placeholder_title') !!}
    </p>
    <p class="my-2 leading-[170%]">
        {!! session('modal')['message'] ?? __('general.modal.placeholder_message') !!}
    </p>
    <x-ui.button id="close-alert" size="large" left_icon="false" right_icon="false" class="my-5 py-3 !w-full sm:w-1/2 mx-auto font-bold">
        {{ __('general.modal.button_confirm') }}
    </x-ui.button>
</div>

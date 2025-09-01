<div class="radial-bg rounded-2xl shadow p-4"
>
    <p class="font-bold text-2xl leading-[-2%]">How was your experience?</p>
    <p class="opacity-60 text-base leading-[175%]">Please share with us some insights</p>
    <x-ui.button id="feedbackBtn" as="button" left_icon="false" right_icon="false"
                 class=" font-bold text-sm">
        <img class="size-5" src="{{Vite::image('/icons/white/lightning.svg')}}" alt="icon return">
        Share feedback
    </x-ui.button>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('feedbackBtn').addEventListener('click', function (e) {
            Swal.fire({
                html: @json(view('store.account.orders.components.feedback-form')->render()),
                showConfirmButton: false,
                showCloseButton: false,
                customClass: {
                    popup: 'my-swal-rounded',
                },
                didOpen: () => {
                    const closeButtons = document.querySelectorAll('.closeSignIn');
                    closeButtons.forEach((btn) => {
                        btn.addEventListener('click', () => {
                            Swal.close();
                        });
                    });
                },
            });
        });
    });
</script>

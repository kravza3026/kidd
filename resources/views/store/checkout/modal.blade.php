<div class="modal grid grid-cols-12">
    <div class="col-span-6">
        <div class="flex items-center justify-between">
            <p>Save account</p>
            <button class="closeSignIn opacity-65 hover:opacity-100 duration-300 cursor-pointer text-[46px] leading-none">
                <img src="{{Vite::image('icons/close_dark.svg')}}" alt="">
            </button>
        </div>
    </div>
    <div class="col-span-6">

    </div>

</div>

<style>
    .my-swal-rounded{
        border-radius: 10px;
        text-align: start;
        padding: 15px!important;

        .swal2-html-container{
            text-align: start;
        }

        .swal2-close:hover{
            color: var(--color-olive);
        }
    }
</style>

import Swal from 'sweetalert2'
import { useI18n } from 'vue-i18n'

export function useAlert(getIsFavorite) {
    const locale = document.documentElement.lang || 'ro';
    const { t } = useI18n()

    const showAlert = (productName, productId) => {
        const isFav = getIsFavorite(productId)
        const message = isFav
            ? t('alerts.savedToFavorites')
            : t('alerts.removedFromFavorites')

        Swal.fire({
            toast: true,
            animation: true,
            width: 'fit-content',
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
            html: `
                <div class="rounded-full flex items-center">
                    <div class="bg-light-orange/20 p-2 lg:p-3 rounded-full">
                         <swal-icon type="success">
                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.90104 9.08618C2.30891 8.44828 1.93211 7.67225 1.76578 6.8626L1.7655 6.86121C1.75759 6.82266 1.75016 6.78402 1.7432 6.74531C1.48912 5.33155 1.86689 3.79856 2.90104 2.68447C4.57322 0.883009 7.3064 0.88301 8.97858 2.68447L9 2.70755L9.02142 2.68447C10.6936 0.88301 13.4268 0.88301 15.099 2.68447C16.1612 3.8288 16.5311 5.41509 16.2345 6.86121C16.0684 7.6713 15.6914 8.44793 15.099 9.08618L10.5087 14.0313C9.72231 14.8785 8.27769 14.8785 7.49133 14.0313L2.90104 9.08618Z" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </swal-icon>
                    </div>
                    <div class="pl-1 lg:pl-4 pr-3 lg:pr-10 grid items-center text-center md:text-start" style="flex: 1;">
                        <p class=" text-[14px] block md:text-sm text-nowrap">${productName}</p>
                        <p class="text-[12px] lg:text-xs opacity-60">${message}</p>
                    </div>
                    <a class="flex items-center gap-x-2 bg-light-orange/20 text-olive text-[12px] lg:text-sm rounded-full font-bold h-full px-4 py-2.5" href="/${locale}/favorites">
                        ${t('user-dropdown.favorites')}
                        <svg
                        class="hidden md:block"
                    v-if="alert.button.withArrow"
                    width="14"
                    height="14"
                    viewBox="0 0 14 14"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M2.73335 1.66669H11.6667C12.0349 1.66669 12.3334 1.96516 12.3334 2.33335V11.2667M1.66669 12.3334L11.8 2.20002"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                    </a>
                </div>
            `,
            background: '#000',
            color: '#fff',
        })
    }

    return { showAlert }
}

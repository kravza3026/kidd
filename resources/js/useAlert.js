import Swal from 'sweetalert2'
import { useI18n } from 'vue-i18n'

export function useAlert(getIsFavorite) {
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
            timer: false,
            html: `
                <div class="rounded-full flex items-center">
                    <div class="bg-light-orange/20 p-2 lg:p-3 rounded-full">

                    </div>
                    <div class="pl-1 lg:pl-4 pr-3 lg:pr-10 grid items-center text-center md:text-start" style="flex: 1;">
                        <p class="hidden text-[0px] md:block md:text-sm text-nowrap">${productName}</p>
                        <p class="text-[12px] lg:text-xs opacity-60">${message}</p>
                    </div>
                    <a class="flex items-center gap-x-2 bg-light-orange/20 text-olive text-[12px] lg:text-sm rounded-full font-bold h-full px-4 py-2.5" href="/favorites">
                        ${t('user-dropdown.favorites')}

                    </a>
                </div>
            `,
            background: '#000',
            color: '#fff',
        })
    }

    return { showAlert }
}

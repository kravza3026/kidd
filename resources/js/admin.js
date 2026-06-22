import './bootstrap';

// Alpine ships bundled with Livewire 4 (see @livewireScripts in the admin layout),
// so it must NOT be imported/started separately here or it boots twice.
import '@tailwindplus/elements';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Live admin notifications: subscribe to the signed-in user's private channel and nudge
// the header bell (Livewire) to refresh whenever a broadcast notification arrives. Guarded
// so the admin still works when Reverb isn't running.
const userId = document.querySelector('meta[name="user-id"]')?.content;

if (userId && import.meta.env.VITE_REVERB_APP_KEY) {
    window.Pusher = Pusher;

    try {
        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: import.meta.env.VITE_REVERB_APP_KEY,
            wsHost: import.meta.env.VITE_REVERB_HOST,
            wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
            wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
            forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
            enabledTransports: ['ws', 'wss'],
        });

        window.Echo.private(`App.Models.User.${userId}`).notification(() => {
            window.Livewire?.dispatch('notification-received');
        });
    } catch (e) {
        console.warn('Admin realtime notifications unavailable:', e);
    }
}

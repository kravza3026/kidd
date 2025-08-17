// resources/js/eventBus.js
import mitt from 'mitt'
export const emitter = mitt()

emitter.once = (type, handler) => {
    const fn = (event) => {
        handler(event);
        emitter.off(type, fn);
    };
    emitter.on(type, fn);
};

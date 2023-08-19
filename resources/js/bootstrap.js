import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

/*Pusher.logToConsole = true;

var pusher = new Pusher('cdfbec3a2fa3767e65bd', {
    cluster: 'eu'
});*/

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'eu',
    wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('products')
.listen('ProductUpdated', (e) => {
    // Обновите ваш список продуктов здесь
    console.log('Product Update');
    console.log(e);
    updateProductInList(e.product)
});

function updateProductInList(product) {
    const productList = document.getElementById('product-list');
    const productItem = productList.querySelector(`[data-product-id="${product.id}"]`);

    if (productItem) {
        productItem.querySelector('.product-name').innerText = product.name;
        productItem.querySelector('.product-description').innerText = product.description;
        productItem.querySelector('.product-price').innerText = product.price;
    } else {
        // Если товара нет в списке (например, он был только что создан), добавьте его
        const newItem = document.createElement('tr');
        newItem.setAttribute('data-product-id', product.id);
        newItem.innerHTML = `
            <td>${product.id}</td>
            <td class="product-name">${product.name}</td>
            <td class="product-description">${product.description}</td>
            $<td class="product-price">${product.price}</td>
            <td>
                <a href="/products/${product.id}/edit" class="btn btn-sm btn-warning">Edit</a>

                <form action="/products/${product.id}" method="POST" style="display: inline;">
                    <input type="hidden" name="_token" value="rqkvxif7Pvz0pORUZZ9U7COlToedgjB3ML6Ttk0T">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        `;

        productList.appendChild(newItem);
    }
}

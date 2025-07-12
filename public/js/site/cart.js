
const Cart = {
    storageKey: 'cart',

    getCart() {
        return JSON.parse(localStorage.getItem(this.storageKey)) || {};
    },

    saveCart(cart) {
        localStorage.setItem(this.storageKey, JSON.stringify(cart));
    },

    add(product) {
        let cart = this.getCart();
        if (cart[product.id]) {
            cart[product.id].quantity += 1;
        } else {
            cart[product.id] = {
                name: product.name,
                price: product.price,
                quantity: 1,
            };
        }
        this.saveCart(cart);
        this.updateCountUI();
    },

    remove(productId) {
        let cart = this.getCart();
        delete cart[productId];
        this.saveCart(cart);
        this.updateCountUI();
    },

    updateQuantity(productId, quantity) {
        let cart = this.getCart();
        if (cart[productId]) {
            cart[productId].quantity = quantity;
            this.saveCart(cart);
            this.updateCountUI();
        }
    },

    clear() {
        localStorage.removeItem(this.storageKey);
        this.updateCountUI();
    },

    getTotalCount() {
        let cart = this.getCart();
        return Object.values(cart).reduce((sum, item) => sum + item.quantity, 0);
    },

    updateCountUI() {
        const countElement = document.getElementById('cart-count');
        if (countElement) {
            countElement.textContent = this.getTotalCount();
        }
    },

    sendToLivewire() {
        let cart = this.getCart();
        if (window.Livewire) {
            Livewire.dispatch('sendCartToServer', { cart });
        }
    }
};

// مقداردهی اولیه پس از بارگذاری صفحه
document.addEventListener('DOMContentLoaded', () => {
    Cart.updateCountUI();
});

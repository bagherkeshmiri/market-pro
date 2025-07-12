const Cart = {
    items: [],

    load() {
        const data = localStorage.getItem('cart_items');
        if (data) {
            this.items = JSON.parse(data);
        } else {
            this.items = [];
        }
        this.updateCount();
        this.updateTotalPrice();
    },

    save() {
        localStorage.setItem('cart_items', JSON.stringify(this.items));
    },

    add(product) {
        this.items.push(product);
        this.save();
        this.updateCount();
        this.updateTotalPrice();
    },

    getTotalCount() {
        return this.items.length;
    },

    getTotalPrice() {
        return this.items.reduce((sum, item) => sum + item.price, 0);
    },

    updateCount() {
        const countElement = document.getElementById('cart-count');
        const sumElement = document.getElementById('cart-sum');
        if (countElement) {
            countElement.textContent = this.getTotalCount();
        }
        if (sumElement) {
            sumElement.textContent = this.getTotalPrice().toLocaleString('fa-IR') + ' تومان';
        }
    },

    updateTotalPrice() {
        const priceElement = document.getElementById('cart-total');
        if (priceElement) {
            priceElement.textContent = this.getTotalPrice().toLocaleString() + ' تومان';
        }
    }
};

window.addEventListener('DOMContentLoaded', () => {
    Cart.load();
});

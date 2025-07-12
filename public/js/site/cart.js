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
        const exists = this.items.some(item => item.id === product.id);
        if (exists) {
            Swal.fire({
                toast: true,
                position: 'top',
                text: 'این محصول قبلاً به سبد خرید اضافه شده ',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: '#FDEAEA',
                color: '#E53E3E',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
            return;
        }
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

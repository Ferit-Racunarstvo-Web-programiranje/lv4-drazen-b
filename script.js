// Get elements
const cartButton = document.querySelector('.cart-button');
const cartBadge = document.querySelector('.cart-badge');
const modal = document.querySelector('.modal');
const modalClose = document.querySelector('.close');
const buyButton = document.querySelector('.buy-btn');
const cartItemsList = document.querySelector('.cart-items');
const cartTotal = document.querySelector('.cart-total');
const itemsGrid = document.querySelector('.items-grid');

// let items = [
//     {
//         id: 0,
//         name: 'Apple',
//         price: 1.50,
//         amount: 0,
//     },
//     {
//         id: 1,
//         name: 'Banana',
//         price: 1.20,
//         amount: 0,
//     },
//     {
//         id: 2,
//         name: 'Cherry',
//         price: 1.70,
//         amount: 0,
//     },
//     {
//         id: 3,
//         name: 'Strawberry',
//         price: 3.50,
//         amount: 0,
//     },
//     {
//         id: 4,
//         name: 'Watermelon',
//         price: 2.50,
//         amount: 0,
//     },
//     {
//         id: 5,
//         name: 'Grape',
//         price: 2.50,
//         amount: 0,
//     },
//     {
//         id: 6,
//         name: 'Lemon',
//         price: 2.00,
//         amount: 0,
//     },
//     {
//         id: 7,
//         name: 'Peach',
//         price: 2.50,
//         amount: 0,
//     },
//     {
//         id: 8,
//         name: 'Pineapple',
//         price: 1.80,
//         amount: 0,
//     },
// ];

let items = [];

let cart = [];

function fillItemsGrid() {
    for (const item of items) {
        let itemElement = document.createElement('div');
        itemElement.classList.add('item');

        let itemNameFormatted = item.name.toLowerCase().replace(' ', '');

        itemElement.innerHTML = `
            <img src="./images/${itemNameFormatted}.png" alt="${item.name}">
            <h2>${item.name}</h2>
            <p>$${item.price}</p>
            <button class="add-to-cart-btn" data-id="${item.id}">Add to cart</button>
        `;
        itemsGrid.appendChild(itemElement);
    }

    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });
}

function addToCart(event) {
    
    let itemId = parseInt(event.target.dataset.id);

    let item = items.find(item => item.id === itemId);

    item.amount++;

    let cartItem = cart.find(cartItem => cartItem.id === itemId);
    if (cartItem) {
        cartItem.amount = item.amount;
    } else {
        cart.push(item);
    }

    updateCartBadge();
}

function buyItems() {

    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    for(let item of cart) {
        item.amount = 0;
        let originalItem = items.find(i => i.id === item.id);
        if (originalItem) {
            originalItem.amount = 0;
        }
    }
    
    cart.length = 0;

    modal.classList.remove('show-modal');

    alert('Thank you for your purchase!');

    updateCartBadge();
}

function updateCartBadge() {
    let totalItems = cart.reduce((total, item) => total + item.amount, 0);
    cartBadge.textContent = totalItems;
}


function updateCartModal() {

    cartItemsList.innerHTML = '';

    for (const item of cart) {
        let listItem = document.createElement('li');
        let itemNameFormatted = item.name.toLowerCase().replace(' ', '');
        listItem.innerHTML = `
            <img src="./images/${itemNameFormatted}.png" alt="${item.name}" width="50" height="50">
            <span>${item.name} - $${item.price} x ${item.amount}</span>
        `;
        cartItemsList.appendChild(listItem);
    }

    let totalPrice = cart.reduce((total, item) => total + item.price * item.amount, 0);
    cartTotal.textContent = `$${totalPrice.toFixed(2)}`;
}

function toggleModal() {
    modal.classList.toggle('show-modal');

    if (modal.classList.contains('show-modal')) {
        updateCartModal();
    }
}


cartButton.addEventListener('click', toggleModal);
modalClose.addEventListener('click', toggleModal);

function removeFromCart(itemId) {
    const itemIndex = cart.findIndex(item => item.id === itemId);
    if (itemIndex !== -1) {

        cart[itemIndex].amount--;

        if (cart[itemIndex].amount === 0) {
            cart.splice(itemIndex, 1);
        }
    }

    updateCartModal();
    updateCartBadge();
}

function updateCartModal() {

    cartItemsList.innerHTML = '';

    if (cart.length === 0) {
        cartItemsList.innerHTML = '<li>Your cart is empty!</li>';
        cartTotal.textContent = `$0.00`;
        return;
    }

    for (const item of cart) {
        let listItem = document.createElement('li');
        let itemNameFormatted = item.name.toLowerCase().replace(' ', '');

        listItem.innerHTML = `
            <img src="./images/${itemNameFormatted}.png" alt="${item.name}" width="50" height="50">
            <span style="margin: auto">${item.name} - $${item.price} x ${item.amount}</span>
            <button class="remove-from-cart-btn" data-id="${item.id}">Remove</button>
        `;

        listItem.querySelector('.remove-from-cart-btn').addEventListener('click', (e) => {
            removeFromCart(parseInt(e.target.dataset.id));
        });

        cartItemsList.appendChild(listItem);
    }

    let totalPrice = cart.reduce((total, item) => total + item.price * item.amount, 0);
    cartTotal.textContent = `$${totalPrice.toFixed(2)}`;
}

buyButton.addEventListener('click', buyItems);

const searchInput = document.getElementById('search-bar');

function searchItems() {

    let searchTerm = searchInput.value.toLowerCase();

    let filteredItems = items.filter(item => item.name.toLowerCase().includes(searchTerm));

    itemsGrid.innerHTML = '';

    for (const item of filteredItems) {
        let itemElement = document.createElement('div');
        itemElement.classList.add('item');

        let itemNameFormatted = item.name.toLowerCase().replace(' ', '');

        itemElement.innerHTML = `
            <img src="./images/${itemNameFormatted}.png" alt="${item.name}">
            <h2>${item.name}</h2>
            <p>$${item.price}</p>
            <button class="add-to-cart-btn" data-id="${item.id}">Add to cart</button>
        `;
        itemsGrid.appendChild(itemElement);
    }

    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });
}

searchInput.addEventListener('input', searchItems);

fillItemsGrid();
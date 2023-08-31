function addToCart(productId, productName, productPrice) {    
    let cart = JSON.parse(localStorage.getItem('cart')) || [];    
    const product = cart.find(item => item.productId === productId);

    if (product) {        
        product.quantity++;        
        product.total = productPrice * product.quantity;
    } else {        
        cart.push({
            productId: productId,
            productName: productName,
            productPrice: productPrice,
            quantity: 1,
            total: productPrice
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));

    document.cookie = `cart=${JSON.stringify(cart)}`;

    const mainPage = document.getElementById('main-page');

    const successMessage = document.createElement('div');

    successMessage.innerHTML = `<?=$_SESSION['success_msg'] = '<b>${productName}</b>' was successfully added to cart.?>`;

    alert(productName + ' added to cart!');
}

function removeFromCart(productId) {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];


    const index = cart.findIndex(item => item.productId === productId);

    if (index !== -1) {
        const product = cart[index];

        if (product.quantity > 1) {

            product.quantity--;
            product.total = product.productPrice * product.quantity;
        } else {

            cart.splice(index, 1);
        }


        localStorage.setItem('cart', JSON.stringify(cart));


        displayCartItems();
    }
}



function displayCartItems() {

    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    const table = document.querySelector('.shopping-cart-table');
    table.innerHTML = "<tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total</th><th>Action</th></tr>";

    let totalPrice = 0;

    for (const item of cart) {
        const productId = item.productId;
        const productName = item.productName;
        const quantity = item.quantity;
        const productPrice = item.productPrice;
        const total = productPrice * quantity;
        totalPrice += total;

        table.innerHTML += `
            <tr>
                <td>${productId}</td>
                <td>${productName}</td>
                <td>${quantity}</td>
                <td>${productPrice}</td>
                <td>${total}</td>
                <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(${productId})">Remove</button></td>
            </tr>
        `;
    }

    table.innerHTML += `
        <tr>
            <td colspan="4">Total Price:</td>
            <td>${totalPrice}</td>
            <td></td>
        </tr>
    `;
}

displayCartItems();


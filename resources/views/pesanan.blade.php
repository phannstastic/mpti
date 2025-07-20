<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Restaurant Order</title>
{{-- Tailwind CSS from CDN --}}
<script src="https://cdn.tailwindcss.com/3.4.1"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#FF6B35',
          secondary: '#2EC4B6'
        },
        borderRadius: {
          'none': '0px', 'sm': '4px', DEFAULT: '8px', 'md': '12px', 'lg': '16px',
          'xl': '20px', '2xl': '24px', '3xl': '32px', 'full': '9999px', 'button': '8px'
        }
      }
    }
  }
</script>
{{-- Google Fonts & Remixicon --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
<style>
  body { font-family: 'Poppins', sans-serif; background-color: #f9f9f9; }
  input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
  @media print {
    .print\:hidden { display: none !important; }
    body { background-color: #fff; }
    #invoice-page, #invoice-content { display: block !important; min-height: auto; margin: 0; padding: 0; box-shadow: none; }
  }
</style>
</head>
<body>
<div id="welcome-page" class="min-h-screen flex flex-col items-center justify-center p-6">
  <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center">
    <img src="{{ asset('images/logo.png') }}" alt="Logo Kang Naryo" class="w-24 h-auto mx-auto mb-4">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Welcome to Our Restaurant</h2>
    <p class="text-gray-600 mb-8">Please enter your name to start your order</p>
    <form id="welcome-form" class="space-y-6">
      <div>
        <input type="text" id="customer-name" placeholder="Enter your name" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary">
        <p id="name-error" class="text-red-500 text-sm mt-1 hidden">Please enter your name</p>
      </div>
      <div>
        <button type="submit" class="w-full bg-primary text-white py-3 px-6 rounded-button font-medium hover:bg-opacity-90 transition-all whitespace-nowrap">Start Order</button>
      </div>
    </form>
  </div>
</div>

<div id="menu-page" class="hidden min-h-screen flex flex-col">
  <header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Kang Naryo" style="height: 50px;" class="mr-4">
      </div>
      <div class="flex items-center">
        <p class="mr-4 hidden md:block">Welcome, <span id="header-customer-name" class="font-medium">Guest</span>!</p>
        <button id="cart-button" class="relative p-2">
          <i class="ri-shopping-cart-line text-2xl"></i>
          <span id="cart-count" class="absolute top-0 right-0 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
        </button>
      </div>
    </div>
  </header>
  <main class="flex-grow container mx-auto px-4 py-6 flex flex-col md:flex-row gap-6">
    <div class="w-full md:w-2/3">
      <div class="bg-white rounded-lg shadow-sm p-2 mb-6 inline-flex">
        <button class="category-btn active px-4 py-2 rounded-full bg-primary text-white font-medium whitespace-nowrap" data-category="makanan">Makanan</button>
        <button class="category-btn px-4 py-2 rounded-full text-gray-700 font-medium whitespace-nowrap" data-category="minuman">Minuman</button>
      </div>
      <div id="menu-items" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>
    <div class="w-full md:w-1/3 md:sticky md:top-24 h-fit">
      <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
          <i class="ri-shopping-cart-line mr-2"></i> Pesanan Anda
        </h2>
        <div id="empty-cart" class="py-8 text-center text-gray-500">
          <i class="ri-shopping-cart-line text-4xl mb-3"></i>
          <p>Keranjang masih kosong</p>
          <p class="text-sm mt-1">Silakan pilih menu</p>
        </div>
        <div id="cart-items" class="hidden">
          <div class="divide-y"></div>
          <div class="mt-4 pt-4 border-t">
            <div class="flex justify-between mb-4">
              <span class="font-medium">Total</span>
              <span id="total" class="font-semibold">Rp0</span>
            </div>
          </div>
          <button id="checkout-btn" class="w-full mt-6 bg-primary text-white py-3 px-6 rounded-button font-medium hover:bg-opacity-90 transition-all whitespace-nowrap">
            Buat Struk
          </button>
        </div>
      </div>
    </div>
  </main>
</div>

<div id="invoice-page" class="hidden min-h-screen flex flex-col bg-gray-100">
  <div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="bg-white rounded-lg shadow-lg p-8" id="invoice-content">
      <div class="flex justify-between items-start mb-8">
        <div>
          <img src="{{ asset('images/logo.png') }}" alt="Logo Kang Naryo" class="w-16 h-auto mb-2">
          <p class="text-gray-600">Jl. Dongkelan No.1287, Krapyak Kulon</p>
          <p class="text-gray-600">Tel: (+62)813-2738-3242</p>
        </div>
        <div class="text-right">
          <h2 class="text-2xl font-bold text-gray-800">STRUK PEMBAYARAN</h2>
          <p class="text-gray-600" id="invoice-date">May 20, 2025</p>
          <p class="text-gray-600" id="invoice-time">12:30 PM</p>
        </div>
      </div>
      <div class="mb-8 pb-4 border-b">
        <h3 class="font-medium text-gray-700 mb-2">Informasi Pelanggan</h3>
        <p><span class="font-medium">Nama:</span> <span id="invoice-customer-name">Tamu</span></p>
      </div>
      <div class="mb-8">
        <h3 class="font-medium text-gray-700 mb-4">Detail Pesanan</h3>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b">
                <th class="text-left py-2 px-2">Menu</th>
                <th class="text-center py-2 px-2">Jumlah</th>
                <th class="text-right py-2 px-2">Harga</th>
                <th class="text-right py-2 px-2">Total</th>
              </tr>
            </thead>
            <tbody id="invoice-items"></tbody>
          </table>
        </div>
      </div>
      <div class="mb-8 pb-4 border-b">
        <div class="flex justify-end text-lg font-semibold">
          <span>Total:</span>
          <span id="invoice-total" class="ml-4">Rp0</span>
        </div>
      </div>
      <div class="text-center text-gray-600 mb-8">
        <p>Silakan tunjukkan struk ini ke kasir untuk pembayaran.</p>
        <p>Terima kasih telah makan di restoran kami!</p>
      </div>
      <div class="flex justify-between print:hidden">
        <button id="back-to-menu" class="bg-gray-200 text-gray-800 py-2 px-6 rounded-button font-medium hover:bg-gray-300 transition-all whitespace-nowrap">
          Kembali ke Menu
        </button>
        <button id="print-invoice" class="bg-primary text-white py-2 px-6 rounded-button font-medium hover:bg-opacity-90 transition-all whitespace-nowrap">
          Cetak Struk
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Data menu dinamis dari Laravel
const menuData = {!! json_encode($menuItems) !!};

let cart = [];

const welcomePage = document.getElementById('welcome-page');
const menuPage = document.getElementById('menu-page');
const invoicePage = document.getElementById('invoice-page');
const welcomeForm = document.getElementById('welcome-form');
const customerNameInput = document.getElementById('customer-name');
const nameError = document.getElementById('name-error');
const headerCustomerName = document.getElementById('header-customer-name');
const menuItemsContainer = document.getElementById('menu-items');
const categoryButtons = document.querySelectorAll('.category-btn');
const cartItemsContainer = document.getElementById('cart-items');
const emptyCart = document.getElementById('empty-cart');
const totalElement = document.getElementById('total');
const cartCountElement = document.getElementById('cart-count');
const checkoutBtn = document.getElementById('checkout-btn');
const invoiceCustomerName = document.getElementById('invoice-customer-name');
const invoiceItemsContainer = document.getElementById('invoice-items');
const invoiceTotalElement = document.getElementById('invoice-total');
const invoiceDate = document.getElementById('invoice-date');
const invoiceTime = document.getElementById('invoice-time');
const backToMenuBtn = document.getElementById('back-to-menu');
const printInvoiceBtn = document.getElementById('print-invoice');

document.addEventListener('DOMContentLoaded', function() {
    const savedName = localStorage.getItem('customerName');
    if (savedName) {
        customerNameInput.value = savedName;
    }

    welcomeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const name = customerNameInput.value.trim();
        if (name === '') {
            nameError.classList.remove('hidden');
            return;
        }
        localStorage.setItem('customerName', name);
        headerCustomerName.textContent = name;
        invoiceCustomerName.textContent = name;
        welcomePage.classList.add('hidden');
        menuPage.classList.remove('hidden');
        displayMenuItems('makanan');
    });

    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            categoryButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-primary', 'text-white');
                btn.classList.add('text-gray-700');
            });

            this.classList.add('active', 'bg-primary', 'text-white');
            this.classList.remove('text-gray-700');
            const category = this.dataset.category;
            displayMenuItems(category);
        });
    });

    checkoutBtn.addEventListener('click', function() {
        if (cart.length === 0) {
            alert("Keranjang Anda kosong. Silakan pilih menu terlebih dahulu.");
            return;
        }

        const orderData = {
            customer_name: localStorage.getItem('customerName') || 'Guest',
            cart: cart,
            total: cart.reduce((total, item) => total + (item.price * item.quantity), 0)
        };

        checkoutBtn.disabled = true;
        checkoutBtn.textContent = 'Memproses...';

        fetch('/api/orders', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(orderData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                menuPage.classList.add('hidden');
                invoicePage.classList.remove('hidden');
                const now = new Date();
                invoiceDate.textContent = now.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                invoiceTime.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                renderInvoiceItems();
            } else {
                alert('Gagal menyimpan pesanan: ' + (data.message || 'Terjadi kesalahan server'));
            }
        })
        .catch(error => {
            let errorMessage = 'Terjadi kesalahan jaringan. Silakan coba lagi.';
            if (error.message) {
                errorMessage = 'Gagal menyimpan pesanan: ' + error.message;
            } else if (typeof error === 'object') {
                const firstErrorKey = Object.keys(error)[0];
                if (error[firstErrorKey]) {
                    errorMessage = error[firstErrorKey][0];
                }
            }
            alert(errorMessage);
            console.error('Fetch Error:', error);
        })
        .finally(() => {
            checkoutBtn.disabled = false;
            checkoutBtn.textContent = 'Buat Struk';
        });
    });

    backToMenuBtn.addEventListener('click', function() {
        invoicePage.classList.add('hidden');
        menuPage.classList.remove('hidden');
        cart = [];
        updateCart();
        displayMenuItems(document.querySelector('.category-btn.active').dataset.category);
    });

    printInvoiceBtn.addEventListener('click', function() {
        window.print();
    });
});

function displayMenuItems(category) {
    menuItemsContainer.innerHTML = '';
    if (!menuData || !menuData[category]) {
        menuItemsContainer.innerHTML = '<p class="col-span-full text-center text-gray-500">Tidak ada item untuk kategori ini.</p>';
        return;
    }

    menuData[category].forEach(item => {
        const itemInCart = cart.find(cartItem => cartItem.id === item.id);
        const quantity = itemInCart ? itemInCart.quantity : 0;
        const menuItemElement = document.createElement('div');
        menuItemElement.className = 'bg-white rounded-lg shadow-sm overflow-hidden flex flex-col';
        
        // Correct way to build image URL and price string
        const imageUrl = `{{ Storage::url('/') }}${item.image}`;
        const priceString = `Rp${parseFloat(item.price).toLocaleString('id-ID')}`;

        menuItemElement.innerHTML = `
            <img src="${imageUrl}" alt="${item.name}" class="w-full h-40 object-cover object-center">
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="font-medium text-gray-800">${item.name}</h3>
                <p class="text-primary font-semibold mt-1">${priceString}</p>
                <div class="flex items-center justify-end mt-auto pt-4">
                    <button class="remove-item-btn ${quantity > 0 ? '' : 'invisible'} w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full" data-id="${item.id}">
                        <i class="ri-subtract-line"></i>
                    </button>
                    <span class="quantity ${quantity > 0 ? '' : 'invisible'} w-10 text-center font-medium">${quantity}</span>
                    <button class="add-item-btn w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full" data-id="${item.id}">
                        <i class="ri-add-line"></i>
                    </button>
                </div>
            </div>
        `;
        menuItemsContainer.appendChild(menuItemElement);
    });

    document.querySelectorAll('.add-item-btn').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = parseInt(this.dataset.id);
            addToCart(itemId);
        });
    });
    document.querySelectorAll('.remove-item-btn').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = parseInt(this.dataset.id);
            removeFromCart(itemId);
        });
    });
}

function addToCart(itemId) {
    let item;
    for (const category in menuData) {
        if (menuData[category]) {
            const foundItem = menuData[category].find(i => i.id === itemId);
            if (foundItem) {
                item = foundItem;
                break;
            }
        }
    }
    if (!item) return;

    const existingItem = cart.find(cartItem => cartItem.id === itemId);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id: item.id, name: item.name, price: parseFloat(item.price), quantity: 1 });
    }
    updateCart();
    updateMenuItemQuantity(itemId);
}

function removeFromCart(itemId) {
    const itemIndex = cart.findIndex(item => item.id === itemId);
    if (itemIndex !== -1) {
        if (cart[itemIndex].quantity > 1) {
            cart[itemIndex].quantity -= 1;
        } else {
            cart.splice(itemIndex, 1);
        }
        updateCart();
        updateMenuItemQuantity(itemId);
    }
}

function updateCart() {
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    cartCountElement.textContent = totalItems;

    if (cart.length === 0) {
        emptyCart.classList.remove('hidden');
        cartItemsContainer.classList.add('hidden');
    } else {
        emptyCart.classList.add('hidden');
        cartItemsContainer.classList.remove('hidden');

        const cartItemsDiv = cartItemsContainer.querySelector('.divide-y');
        cartItemsDiv.innerHTML = '';
        
        cart.forEach(item => {
            const cartItemElement = document.createElement('div');
            cartItemElement.className = 'py-3 flex justify-between items-center';

            // PERBAIKAN UTAMA: Pastikan seluruh string HTML diapit oleh backtick (`)
            cartItemElement.innerHTML = `
                <div>
                    <p class="font-medium">${item.name}</p>
                    <p class="text-sm text-gray-600">Rp${parseFloat(item.price).toLocaleString('id-ID')} x ${item.quantity}</p>
                </div>
                <span class="font-semibold">Rp${(parseFloat(item.price) * item.quantity).toLocaleString('id-ID')}</span>
            `;
            cartItemsDiv.appendChild(cartItemElement);
        });

        const total = cart.reduce((total, item) => total + (parseFloat(item.price) * item.quantity), 0);
        totalElement.textContent = `Rp${total.toLocaleString('id-ID')}`;
    }
}

function updateMenuItemQuantity(itemId) {
    const itemInCart = cart.find(item => item.id === itemId);
    const quantity = itemInCart ? itemInCart.quantity : 0;

    const allItemCards = document.querySelectorAll(`.add-item-btn[data-id="${itemId}"]`);
    allItemCards.forEach(cardButton => {
        const menuItemEl = cardButton.closest('.flex-col').parentElement;
        const quantityElement = menuItemEl.querySelector('.quantity');
        const removeButton = menuItemEl.querySelector('.remove-item-btn');

        if (quantity > 0) {
            quantityElement.textContent = quantity;
            quantityElement.classList.remove('invisible');
            removeButton.classList.remove('invisible');
        } else {
            quantityElement.classList.add('invisible');
            removeButton.classList.add('invisible');
        }
    });
}

function renderInvoiceItems() {
    invoiceItemsContainer.innerHTML = '';
    cart.forEach(item => {
        const row = document.createElement('tr');
        row.className = 'border-b';

        // PERBAIKAN DI SINI: Pastikan seluruh innerHTML diapit oleh backtick (`)
        row.innerHTML = `
            <td class="py-2 px-2">${item.name}</td>
            <td class="text-center py-2 px-2">${item.quantity}</td>
            <td class="text-right py-2 px-2">Rp${parseFloat(item.price).toLocaleString('id-ID')}</td>
            <td class="text-right py-2 px-2">Rp${(parseFloat(item.price) * item.quantity).toLocaleString('id-ID')}</td>
        `;
        invoiceItemsContainer.appendChild(row);
    });

    const total = cart.reduce((total, item) => total + (parseFloat(item.price) * item.quantity), 0);
    invoiceTotalElement.textContent = `Rp${total.toLocaleString('id-ID')}`;
}
</script>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div x-data="{ open: false }">
        <div x-data="{width: '300px', src: 'https://down-vn.img.susercontent.com/file/d1f19dd0cc4a701e0f28735607b48bc3'}">
            <img x-bind:width="width" alt="" x-bind:src="src"/>
            <div class="flex flex-row gap-4">
                <button class="btn" x-on:click="width='300px'">300px</button>
                <button class="btn" x-on:click="width='400px'">400px</button>
                <button class="btn" x-on:click="width='500px'">500px</button>
            </div>
            <button class="btn btn-primary" x-on:click="src='https://down-vn.img.susercontent.com/file/ed87f604e5467b841383c8ad26dc62ff'">Đổi ảnh</button>
        </div>
    </div>

    <div class="my-4"></div>
    <div x-data="{message: 'button'}">
        <div x-text="message"></div>
        <button class="btn btn-primary" type="button"
            @click="message = 'selected'"
            @click.shift="message = 'added to selection'"
            @mousemove.shift="message = 'add to selection'"
            @mouseout="message = 'select'"
            x-text="message">
        </button>
    </div>

    @php $description="<div><b>Mô tả</b>: Sản phẩm a, giá <i>100$</i></div>" @endphp
    {{ $description }}
    {!! $description !!}


    <h1>Product List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody x-data="{ products: [] }" x-init="fetch('/api/products')
            .then(response => response.json())
            .then(data => products = data)">
            <template x-for="product in products" :key="product.productCode">
                <tr>
                    <td x-text="product.productCode"></td>
                    <td x-text="product.productName"></td>
                    <td x-text="product.buyPrice"></td>
                </tr>
            </template>
        </tbody>
    </table>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                products: [],
                async fetchProducts() {
                    try {
                        const response = await fetch('/api/products');
                        this.products = await response.json();
                    } catch (error) {
                        console.error('Error fetching products:', error);
                    }
                }
            }));
        });

        document.addEventListener('alpine:init', () => {
            Alpine.start();
        });
    </script>
</body>
</html>

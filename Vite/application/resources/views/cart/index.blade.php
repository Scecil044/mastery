<x-app-layout>

    <div class="container lg:w-2/3 xl:w-2/3 mx-auto">
        <h1 class="text-3xl font-bold mb-6">Your Cart Items</h1>
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <!-- Product Items -->
                <div>
                    <!-- Product Item -->

                    @foreach ($cartItems as $cart)
                        <div>

                            <div class="w-full flex flex-col sm:flex-row items-center gap-4">

                                <a href="/src/product.html"
                                    class="w-36 h-32 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $cart->product->image }}" class="object-cover" alt="" />
                                </a>
                                <div class="flex-1 flex flex-col justify-between">
                                    <div class="flex justify-between mb-3">
                                        <input type="text" name="title" value="{{ $cart->product->title }}"
                                            class="w-full border-none focus:border-none active:outline-none border-0 outline-none"
                                            disabled />
                                        <span class="text-lg font-semibold">
                                            <span x-text="product.price">{{ $cart->product->price }}</span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            Qty:
                                            <input type="number" value="{{ $cart->quantity }}" name="quantity"
                                                class="ml-3 py-1 border-gray-200 focus:border-purple-600 focus:ring-purple-600 w-16" />
                                        </div>
                                        <a href="{{ route('delete.cart', $cart->id) }}"
                                            class="text-purple-600 hover:text-purple-500">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <!--/ Product Item -->
                            <hr class="my-5" />
                        </div>
                    @endforeach

                    <!-- Product Item -->
                </div>
                <!--/ Product Items -->

                <div class="border-t border-gray-300 pt-4">
                    <div class="flex justify-between">
                        <span class="font-semibold">Subtotal</span>
                        @php
                            $sum = 0;
                            foreach ($cartItems as $cart) {
                                $sum += $cart->product->price * $cart->quantity;
                            }
                        @endphp
                        <span class="text-xl" name="sum">{{ $sum }}</span>
                    </div>
                    <p class="text-gray-500 mb-6">
                        Shipping and taxes calculated at checkout.
                    </p>


                    <button type="submit" class="btn-primary w-full py-3 text-lg">
                        Proceed to Checkout
                    </button>

                </div>
            </div>
        </form>
    </div>
    <x-flashMessage />
</x-app-layout>

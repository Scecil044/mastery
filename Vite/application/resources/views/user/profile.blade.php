<x-app-layout>
    <div class="container lg:w-2/3 xl:w-2/3 mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-5 items-start gap-6">
            <div class="col-span-3 bg-white p-4 rounded-lg shadow">
                <!-- Profile Details -->
                <div class="mb-6">
                    <h2 class="text-xl mb-5">Your Profile</h2>
                    <div class="mb-4">
                        <input placeholder="Your Name" type="text" name="name" value="{{ $user->name }}"
                            class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                    </div>
                    <div class="mb-4">
                        <input placeholder="Your Email" type="email" name="email" value="{{ $user->email }}"
                            class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                    </div>
                    <div class="mb-4">
                        <input placeholder="Your Phone" type="text" name="phone" value="{{ $user->phone }}"
                            class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                    </div>
                </div>
                <!--/ Profile Details -->

                <!-- Billing Address -->
                <div class="mb-6">
                    <h2 class="text-xl mb-5">Billing Address</h2>
                    <div class="flex gap-3">
                        <div class="mb-4 flex-1">
                            <input placeholder="Address 1" type="text" name="billing_address_1"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                        <div class="mb-4 flex-1">
                            <input placeholder="Address 2" type="text" name="billing_address_2"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mb-4 flex-1">
                            <input placeholder="City" type="text" name="billing_city"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                        <div class="mb-4 flex-1">
                            <input placeholder="State" type="text" name="billing_state"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mb-4 flex-1">
                            <select placeholder="Country" type="text" name="billing_country"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full">
                                <option value="">Country</option>
                                <option value="ge">Georgia</option>
                                <option value="de">Germany</option>
                                <option value="in">India</option>
                                <option value="us">United Kingdom</option>
                                <option value="uk">United States</option>
                            </select>
                        </div>
                        <div class="mb-4 flex-1">
                            <input placeholder="Zipcode" type="text" name="billing_zipcode"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                    </div>
                </div>
                <!--/ Billing Address -->

                <!-- Shipping Address -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl">Shipping Address</h2>
                        <div class="flex items-center">
                            <input id="sameAsBillingAddress" type="checkbox"
                                class="mr-3 rounded border-gray-300 text-purple-500 focus:ring-purple-500" />
                            <label for="sameAsBillingAddress">Same as Billing</label>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mb-4 flex-1">
                            <input placeholder="Address 1" type="text" name="shipping_address_1"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                        <div class="mb-4 flex-1">
                            <input placeholder="Address 2" type="text" name="shipping_address_2"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mb-4 flex-1">
                            <input placeholder="City" type="text" name="shipping_city"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                        <div class="mb-4 flex-1">
                            <input placeholder="State" type="text" name="shipping_state"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="mb-4 flex-1">
                            <select placeholder="Country" type="text" name="shipping_country"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full">
                                <option value="">Country</option>
                                <option value="ge">Georgia</option>
                                <option value="de">Germany</option>
                                <option value="in">India</option>
                                <option value="us">United Kingdom</option>
                                <option value="uk">United States</option>
                            </select>
                        </div>
                        <div class="mb-4 flex-1">
                            <input placeholder="Zipcode" type="text" name="shipping_zipcode"
                                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        </div>
                    </div>
                </div>
                <!--/ Shipping Address -->

                <button
                    class="btn-primary bg-orange-400 hover:bg-orange-500 active:bg-orange-600 w-full">Update</button>
            </div>

            <div class="col-span-2 bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl mb-5">Your Account</h2>
                <form method="post" action="{{ route('pwd.update') }}">
                    @csrf
                    <div class="mb-4">
                        <input type="password" name="old_password" placeholder="Your Current password" required
                            class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        @error('old_password')
                            <p class="text-red-500 mt-2 p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="New password" required
                            class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        @error('password')
                            <p class="text-red-500 mt-2 p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password_confirmation" placeholder="Repeat new password"
                            required
                            class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
                        @error('password_confirmation')
                            <p class="text-red-500 mt-2 p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button
                            class="btn-primary w-full bg-orange-400 hover:bg-orange-500 active:bg-orange-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-flashMessage />
</x-app-layout>

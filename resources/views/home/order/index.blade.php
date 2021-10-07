

<x-home-layout>
    <div class="max-w-7xl mx-auto mt-16 ">

        @include('home.user._tab')


            <div class="bg-white">
                <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:pb-24 lg:px-8">
                    <div class="max-w-xl">
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Order history</h1>
                        <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, manage returns, and download invoices.</p>
                    </div>

                    <div class="mt-16">
                        <h2 class="sr-only">Recent orders</h2>

                        <div class="space-y-20">

                            @if($orders->isNotEmpty())

                                @foreach($orders as $order)
                                <div>
                                    <h3 class="sr-only">Order placed on <time datetime="2021-01-22">{{$order->created_at->format('d-m-Y H:M')}}</time></h3>

                                    <div class="bg-gray-50 rounded-lg py-6 px-4 sm:px-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 lg:space-x-8">
                                        <dl class="divide-y divide-gray-200 space-y-6 text-sm text-gray-600 flex-auto sm:divide-y-0 sm:space-y-0 sm:grid sm:grid-cols-3 sm:gap-x-6 lg:w-1/2 lg:flex-none lg:gap-x-8">
                                            <div class="flex justify-between sm:block">
                                                <dt class="font-medium text-gray-900">Date placed</dt>
                                                <dd class="sm:mt-1">
                                                    <time datetime="2021-01-22">{{$order->created_at->format('F d,Y H:i')}}</time>
                                                </dd>
                                            </div>
                                            <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                                <dt class="font-medium text-gray-900">Order number</dt>
                                                <dd class="sm:mt-1">
                                                    {{ $order->short_order_number}}
                                                </dd>
                                            </div>
                                            <div class="flex justify-between pt-6 font-medium text-gray-900 sm:block sm:pt-0">
                                                <dt>Total amount</dt>
                                                <dd class="sm:mt-1">
                                                    $ {{$order->total_price}}
                                                </dd>
                                            </div>
                                        </dl>
                                        <a href="#" class="w-full flex items-center justify-center bg-white mt-6 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:mt-0">
                                            View Invoice
                                            <span class="sr-only">for order WU88191111</span>
                                        </a>
                                    </div>

                                    <table class="mt-4 w-full text-gray-500 sm:mt-6">
                                        <caption class="sr-only">
                                            Products
                                        </caption>
                                        <thead class="sr-only text-sm text-gray-500 text-left sm:not-sr-only">
                                        <tr>
                                            <th scope="col" class="sm:w-2/5 lg:w-1/3 pr-8 py-3 font-normal">Product</th>
                                            <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Price</th>
                                            <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Quantity</th>
                                            <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Total</th>
                                            <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Status</th>
                                            <th scope="col" class="w-0 py-3 font-normal text-right">Info</th>
                                        </tr>
                                        </thead>
                                        <tbody class="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">

                                        @foreach($order->orderProducts as $product)
                                        <tr>
                                            <td class="py-6 pr-8">
                                                <div class="flex items-center">
                                                    <img src="{{$product->cover}}" alt="{{$product->product_name}}" class="w-16 h-16 object-center object-cover rounded mr-6">
                                                    <div>
                                                        <div class="font-medium text-gray-900">{{$product->product_name}}</div>
                                                        <div class="mt-1 sm:hidden">${{$product->product_price}}</div>
                                                        <div class="mt-1 sm:hidden">quantity: #{{$product->quantity}}</div>
                                                        <div class="mt-1 sm:hidden">Total: ${{$product->total_price}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="hidden py-6 pr-8 sm:table-cell">
                                                ${{$product->product_price}}
                                            </td>
                                            <td class="hidden py-6 pr-8 sm:table-cell">
                                                #{{$product->quantity}}
                                            </td>
                                            <td class="hidden py-6 pr-8 sm:table-cell">
                                                Total: ${{$product->total_price}}
                                            </td>
                                            <td class="hidden py-6 pr-8 sm:table-cell">
                                                Delivered Jan 25, 2021
                                            </td>
                                            <td class="py-6 font-medium text-right whitespace-nowrap">
                                                <a href="#" class="text-blue-600">View<span class="hidden lg:inline"> Product</span><span class="sr-only">, Machined Pen and Pencil Set</span></a>
                                            </td>
                                        </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @endforeach

                            @else
                                <p>No orders at the moment</p>
                            @endif


                            <div class="mt-10">
                                {{ $orders->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>






    </div>
</x-home-layout>




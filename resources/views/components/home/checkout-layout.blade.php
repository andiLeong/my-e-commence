

<div class="bg-white">
    <!-- Background color split screen for large screens -->
    <div class="hidden lg:block fixed top-0 left-0 w-1/2 h-full bg-white" aria-hidden="true"></div>
    <div class="hidden lg:block fixed top-0 right-0 w-1/2 h-full bg-gray-100" aria-hidden="true"></div>

    @include('home._checkout-header')

    <main class="relative grid grid-cols-1 gap-x-16 max-w-7xl mx-auto lg:px-8 lg:grid-cols-2 xl:gap-x-48">
        <section aria-labelledby="summary-heading" class="bg-gray-50 pt-16 pb-10 px-4 sm:px-6 lg:px-0 lg:pb-16 lg:bg-transparent lg:row-start-1 lg:col-start-2">
            <div class="max-w-lg mx-auto lg:max-w-none">

                {{$orderSummary}}

            </div>
        </section>

        <div class="my-10 px-5">

            {{$slot}}

        </div>

    </main>
</div>

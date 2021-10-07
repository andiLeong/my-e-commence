
    <div class="py-6">

        @section('head')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @endsection

        @include('admin._welcome')

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mt-10">

            <div wire:init="load">

                <x-stats-layout title="Last 30 days" >
                    @if($userCounter)
                    <x-stats-counter title="Total Users"
                                     count="{{$userCounter->total_count}}"
                                     from-count="{{$userCounter->before_thirty_day_count}}">
                        <x-slot name="rate">
                            <!-- Heroicon name: solid/arrow-sm-up -->
                            <svg class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Increased by</span>
                            12%
                        </x-slot>
                    </x-stats-counter>
                    @else
                        @include('admin._stats-counter-skeleton')
                    @endif

                    @if($orderCounter)
                    <x-stats-counter title="Total Orders"
                                     count="{{$orderCounter->total_count}}"
                                     from-count="{{$orderCounter->before_thirty_day_count}}">

                        <x-slot name="rate">
                            <!-- Heroicon name: solid/arrow-sm-up -->
                            <svg class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Increased by</span>
                            12%
                        </x-slot>

                    </x-stats-counter>
                    @else
                        @include('admin._stats-counter-skeleton')
                    @endif

                    @if($orderProductCounter)
                        <x-stats-counter title="Total Product Sold"
                                         count="{{$orderProductCounter->total_count}}"
                                         from-count="{{$orderProductCounter->before_thirty_day_count}}">

                            <x-slot name="rate">
                                <!-- Heroicon name: solid/arrow-sm-up -->
                                <svg class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Increased by</span>
                                12%
                            </x-slot>

                        </x-stats-counter>
                    @else
                        @include('admin._stats-counter-skeleton')
                    @endif

                </x-stats-layout>

            </div>

            <div class="mt-10"  >

                @if($displayChart)
                    <div >
                        <x-chartjs title="Sales Amount for the last 6 months" :data="$sumUp" :labels="$labels" />
                    </div>
                @else
                    <div wire:init="loadChart" class="animate-pulse  rounded text-transparent  bg-gradient-to-b from-gray-400 via-gray-300 to-gray-200 h-screen">
                    </div>
                @endif
            </div>

        </div>
    </div>



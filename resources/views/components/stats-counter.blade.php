

<div class="px-4 py-5 sm:p-6">
        <dt class="text-base font-normal text-gray-900">
            {{$title}}
        </dt>
        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
            <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                {{$count}}
                <span class="ml-2 text-sm font-medium text-gray-500">from  {{$fromCount}}</span>
            </div>
            <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">
                {{$rate}}
            </div>
        </dd>
</div>

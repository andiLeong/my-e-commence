
@props([
    'profileImgSize',
])

<a  {{ $attributes->merge(['class' => 'flex-shrink-0 group block']) }}>
    <div class="flex items-center">
        <div>
            <img class="inline-block rounded-full {{$profileImgSize}}" src="{{ auth()->user()->profile_img}}">
        </div>
        <div class="ml-3">
            <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">
                @user_name
            </p>
            <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">
                View profile
            </p>
        </div>
    </div>
</a>

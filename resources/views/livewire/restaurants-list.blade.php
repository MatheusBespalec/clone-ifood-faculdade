<section>
        <div class="flex flex-row flex-wrap justify-start mx-auto">
        @foreach($restaurants as $restaurant)
            <article class="md:w-1/2 xl:w-1/3 p-3">
                <a href="{{ route("restaurants.show", ["restaurant" => $restaurant->id]) }}">
                    <div class="flex flex-row max-w max-w-md p-5 ease-in-out rounded-md hover:scale-105 transition duration-300 gap-4 hover:shadow-lg">
                        <div class="w-28">
                            <img class="w-28 h-28 bg-gray-500 rounded-full" src="{{ $restaurant->thumbnail }}" />
                        </div>
                        <div class="flex flex-col items-start gap-2.5 justify-center">
                            <h3 class="text-base font-medium">{{ $restaurant->name }}</h3>
                            <p class="text-sm text-gray-500 font-light truncate">{{ substr($restaurant->description, 0, 30) }}</p>
                        </div>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
    <div class="py-4">
        {{ $restaurants->links() }}
    </div>
</section>

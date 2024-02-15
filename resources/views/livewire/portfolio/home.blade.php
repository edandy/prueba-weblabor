<div class="mt-6">
    <div class="flex justify-center text-black border-y-2 border-rose-600 max-w-64 mx-auto">
        <h1 class="text-4xl font-bold py-2">
            Portafolio
        </h1>
    </div>

    <div class="mt-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @forelse($portfolios as $row)
                <a href="#"
                   class="scale-100 bg-white from-gray-700/100 via-transparent shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 group">
                    <div class="relative w-full">
                        <img src="{{ asset('storage/'.$row->thumbnail) }}" alt="" class="object-cover h-full w-full">

                        <div
                            class="hidden group-hover:block group-hover:bg-rose-500/50 p-4 absolute top-0 bottom-0 left-0 right-0 z-10">
                            <div class="h-full border border-white p-4 text-ellipsis overflow-hidden">
                                <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">{{ $row->title }}</h2>

                                <div class="mt-4 text-white leading-relaxed">
                                    {!! $row->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
            @endforelse
        </div>
        {{ $portfolios->links() }}
    </div>
</div>

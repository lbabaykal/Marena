@if ($paginator->hasPages())
    <div class="pagination">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{--<a class="pagination-previous" href="javascript:void(0);"><li>Previous</li></a>--}}
            @else
                <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}"><li>Сюда</li></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="javascript:void(0);"><li>{{ $element }}</li></a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="pagination-is-active" href="javascript:void(0);"><li>{{ $page }}</li></a>
                        @else
                            <a href="{{ $url }}"><li>{{ $page }}</li></a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}"><li>Туда</li></a>
            @else
                {{--<a class="pagination-next" href="javascript:void(0);"><li>Previous</li></a>--}}
            @endif
        </ul>
    </div>
@endif

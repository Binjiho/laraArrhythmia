@if ($paginator->hasPages())
        <ul class="paging">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="first" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="{{ $paginator->url(1) }}">
                        <span class="page-link" aria-hidden="true"><img src="/assets/image/board/ic_first.png" alt="first"></span>
                    </a>
                </li>

                <li class="page-item prev">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <img src="/assets/image/board/ic_prev.png" alt="prev">
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled num" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active num" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item num"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item next">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <img src="/assets/image/board/ic_next.png" alt="next">
                    </a>
                </li>

                <li class="page-item disabled last" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="{{ $paginator->url($paginator->lastPage()) }}">
                        <span class="page-link" aria-hidden="true"><img src="/assets/image/board/ic_last.png" alt="last"></span>
                    </a>
                </li>
            @endif
        </ul>
@endif

@if ($paginator->hasPages())

    <link rel="stylesheet" href="{{ asset('user/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/custom.css') }}">

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">

            @if ($paginator->onFirstPage())
                <li class="page-item "aria-label="@lang('pagination.previous')">
                    <a class="page-link d-none"  aria-disabled="true"  href="#"><i class="fi-rs-angle-double-small-left"></i></a>
                </li>
            @else
                <li class="page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i
                            class="fi-rs-angle-double-small-left"></i></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li lass="disabled" aria-disabled="true"><a class="page-link">{{ $element }}</a></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><a
                                    class="page-link">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" rel="next" href="{{ $paginator->nextPageUrl() }}"
                        aria-label="@lang('pagination.next')"><i class="fi-rs-angle-double-small-right"></i></a></li>
            @else
                <li class="page-item d-none" aria-disabled="true" aria-label="@lang('pagination.next')"><a aria-hidden="true"
                        class="page-link" href="#">
                        <i class="fi-rs-angle-double-small-right"></i></a></li>
            @endif

        </ul>
    </nav>
@endif

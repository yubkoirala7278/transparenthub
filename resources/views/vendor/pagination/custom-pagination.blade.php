@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&laquo; Prev</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="Previous">&laquo; Prev</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span
                            class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">Next
                        &raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&raquo; Next</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        /* Custom Pagination Styling */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .page-item {
            margin: 0 5px;
        }

        .page-link {
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            color: #DC3545;
            background-color: white;
            border: 1px solid #ddd;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Active Page Style */
        .page-item.active .page-link {
            color: white;
            background-color: #DC3545;
            border-color: #DC3545;  
        }

        /* Hover Effects */
        .page-link:hover {
            background-color: #f1f1f1;
            color: #DC3545;
            border-color: #DC3545;
        }

        /* Disabled Links */
        .page-item.disabled .page-link {
            color: #ccc;
            background-color: #f8f9fa;
            border-color: #ddd;
            pointer-events: none;
        }

        /* Previous/Next Buttons */
        .page-item a.page-link {
            font-weight: 600;
        }

        .page-item a.page-link:hover {
            background-color: #f1f1f1;
            color: #DC3545;
        }
    </style>
@endif

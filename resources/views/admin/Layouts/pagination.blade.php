@php
$page = $pagination['current_page'] ?? 1;
$perPage = $pagination['per_page'] ?? config('pagination.limit');
$lastPage = $pagination['last_page'] ?? 1;
$total = $pagination['total'] ?? 0;
$paginationRange = config('pagination.pagination_range');
$startPagination = $page - $paginationRange > 0 ? $page - $paginationRange : 1;
$endPagination = $page + $paginationRange >= $lastPage ? $lastPage : $page + $paginationRange;
$limitOptions = [5, 10, 100];
@endphp
<div class="d-flex justify-content-between align-items-center mt-2">
    <form class="w-50"><select id="limit-option" class="custom-select w-25">
            @foreach ($limitOptions as $limit)
                <option @if ($limit == $perPage) selected @endif value="{{ $limit }}">{{ $limit }}</option>
            @endforeach
        </select> <span>Hiển thị <strong> {{ $page * $perPage - $perPage + 1 }} -
                {{ $page * $perPage >= $total ? $total : $page * $perPage }} </strong>
            trên
            <strong> {{ $total }} </strong></span></form>
    @if ($lastPage > 1)
        <ul class="pagination pagination-split">
            <li class="@if ($page == 1) disabled @endif" page="1"><a><i class="fa fa-angle-left"></i></a>
            </li>
            @if ($startPagination > 1)
                <li page="1"><a>
                        1
                    </a></li>
                <li><a>
                        ...
                    </a></li>
            @endif

            @for ($i = $startPagination; $i <= $endPagination; $i++)
                <li class="@if ($i == $page) active @endif" page="{{ $i }}"><a>
                        {{ $i }}
                    </a></li>
            @endfor
            @if ($endPagination < $lastPage)
                <li><a>
                        ...
                    </a></li>
                <li page={{ $lastPage }}><a>
                        {{ $lastPage }}
                    </a></li>
            @endif
            <li class="@if ($page == $lastPage) disabled @endif" page="{{ $lastPage }}"><a><i
                        class="fa fa-angle-right"></i></a></li>
        </ul>
    @endif
</div>

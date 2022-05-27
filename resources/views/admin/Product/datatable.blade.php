@php
    $sortKeyAction = ($sort_value == config('pagination.sort.desc')) ? config('pagination.sort.asc') : config('pagination.sort.desc');
@endphp
<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <th>STT</th>
            <th class="sort-list" data-sort-key="name" data-sort-value="{{ $sortKeyAction }}">
                Tên <i class="fas fa-sort float-right {{ showClassSort('name',$sort_key, $sort_value) }}"></i>
            </th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th class="sort-list" data-sort-key="price" data-sort-value="{{ $sortKeyAction }}">
                Giá <i class="fas fa-sort float-right {{ showClassSort('price',$sort_key, $sort_value) }}"></i>
            </th> 
            <th class="sort-list" data-sort-key="sale_off_price" data-sort-value="{{ $sortKeyAction }}">
                Giá khuyến mãi <i class="fas fa-sort float-right {{ showClassSort('sale_off_price',$sort_key, $sort_value) }}"></i>
            </th> 
            <th class="sort-list" data-sort-key="created_at" data-sort-value="{{ $sortKeyAction }}">
                Ngày tạo <i class="fas fa-sort float-right {{ showClassSort('created_at',$sort_key, $sort_value) }}"></i>
            </th>
            <th>Trạng thái</th>
            <th style="width: 5%">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @if ($list)
            @foreach ($list as $index => $item)
                <tr>
                    <td> {{ $index + 1 + $pagination['per_page'] * ($pagination['current_page'] - 1) }}</td>
                    <td> {{ $item['name'] }}</td>
                    <td>
                        <img src="{{ !empty($item['images'][0]['path']) ? asset($item['images'][0]['path']) : asset(config('image.default_image')) }}">
                    </td>
                    <td>{{ $item['category']['name'] ?? '' }}</td>
                    <td> {{ $item['price'] }}</td>
                    <td> {{ $item['sale_off_price'] }}</td>
                    <td> {{ $item['formatted_created_at'] }}</td>

                    <td>
                        <label class="badge text-white {{ showClassStatus($item['status']) }}">
                            {{ $item['status_label'] }}
                        </label>
                    </td>
                    <td class="text-center text-nowrap">
                        <button data-id={{ $item['id'] }} title="Chỉnh sửa" v-tooltip
                            class="btn-edit btn btn-sm btn-outline-warning">
                            <i class="fas fa-pen"></i>
                        </button>
                        @if ($item['status'] == config('common.status.active'))
                            <button data-id="{{ $item['id'] }}" data-original-title="Khóa" v-tooltip class="btn-inactive btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                        <button data-id="{{ $item['id'] }}" data-original-title="Khôi phục" v-tooltip class="btn-active btn btn-sm btn-outline-success">
                            <i class="fas fa-undo"></i>
                        </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">
                    <p class="text-center mt-4 mb-4">Không tìm thấy dữ liệu</p>
                </td>
            </tr>
        @endif
    </tbody>
</table>
@include('Admin.Layouts.pagination', ['pagination' => $pagination])

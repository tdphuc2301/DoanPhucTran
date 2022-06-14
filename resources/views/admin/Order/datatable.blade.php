@php
    $sortKeyAction = ($sort_value == config('pagination.sort.desc')) ? config('pagination.sort.asc') : config('pagination.sort.desc');
@endphp
<table class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th>STT</th>
        <th @click="sort('code')"> Code <i class="fas fa-sort float-right"
                                           :class="showClassSort('name')"></i></th>
        <th>Khách hàng</th>
        <th>Email</th>
        <th>Vị trí</th>
        <th @click="sort('discount')">Khuyến mãi <i class="fas fa-sort float-right"
                                                    :class="showClassSort('discount')"></i></th>
        <th @click="sort('sub_total')">Tổng tiền(VNĐ)<i class="fas fa-sort float-right"
                                                      :class="showClassSort('sub_total')"></i></th>
        <th @click="sort('total_price')">Trạng thái thanh toán <i class="fas fa-sort float-right"
            ></i>
        </th>
        <th @click="sort('total_price')">Trạng thái shipment <i class="fas fa-sort float-right"></i>
        </th>
        <th @click="sort('create_at')"> Ngày tạo<i class="fas fa-sort float-right"
                                                   :class="showClassSort('create_at')"></i>
        </th>
        <th> Trạng thái</th>
        <th style="width: 5%">Hành động</th>
    </tr>
    </thead>
    <tbody>
        @if ($list)
            @foreach ($list as $index => $item)
                <tr>
                    <td> {{ $index + 1 + $pagination['per_page'] * ($pagination['current_page'] - 1) }}</td>
                    <td> {{ $item['code'] }}</td>
                    <td> {{ $item['name_customer'] }}</td>
                    <td> {{ $item['email_customer'] }}</td>
                    <td> {{ $item['address'] }}</td>
                    <td> {{ $item['promotion'] }}</td>
                    <td> {{ $item['total_price'] }}</td>
                    <td> <label class="badge text-white {{ showClassStatusPaid($item['paid_key']) }}">
                            {{ $item['paid'] }}
                        </label></td>
                    <td> <label class="badge text-white {{ showShipmentStatusPaid($item['status_delivered']) }}">
                            {{ $item['status_delivered_key'] }}
                        </label></td>
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
                <td colspan="8">
                    <p class="text-center mt-4 mb-4">Không tìm thấy dữ liệu</p>
                </td>
            </tr>
        @endif
    </tbody>
</table>
@include('Admin.Layouts.pagination', ['pagination' => $pagination])

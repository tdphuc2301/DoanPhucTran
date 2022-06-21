@php
$categories = $categories ?? [];
@endphp
@extends('Admin.Layouts.app')
@section('head')
    <style>
        p,
        label {
            font: 1rem 'Fira Sans', sans-serif;
        }

        input {
            margin: .4rem;
        }
    </style>
@endsection
@section('content')
    @php
    @endphp
    <div class="row branch_id_filter">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <a href="{{ URL::to(route('admin.product.addInfo')) }}"
                    class="btn-open-create-modal btn btn-gradient-success btn-sm">Thêm mới
                    <i class="mdi mdi-plus btn-icon-append"></i>
                    </a>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th class="sort-list" data-sort-kapey="name">
                                    Tên <i class="fas fa-sort float-right"></i>
                                </th>
                                <th class="sort-list" data-sort-key="price">
                                    Giá <i class="fas fa-sort float-right"></i>
                                </th>
                                <th class="sort-list" data-sort-key="sale_off_price">
                                    Giá khuyến mãi <i class="fas fa-sort float-right"></i>
                                </th>
                                <th class="sort-list" data-sort-key="sale_off_price">
                                    Tồn kho <i class="fas fa-sort float-right"></i>
                                </th>
                                <th style="width: 5%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($list)
                                @foreach ($list as $index => $item)
                                    <tr>
                                        <td> {{ (int) $index + 1 }}</td>
                                        <td> {{ $item->name }}</td>

                                        <td> {{ $item->price }}</td>

                                        <td>
                                            <label class="badge text-white {{ showClassStatus($item->status) }}">
                                                {{ $item->sale_off_price }}
                                            </label>
                                        </td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ URL::to(route('admin.product.editInfo', ['id' => $item->id])) }}"
                                                class="btn-edit btn btn-sm btn-outline-warning">
                                                <i class="fas fa-pen"></i>
                                            </a>
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
                </div>
            </div>
        </div>
    </div>
@endsection

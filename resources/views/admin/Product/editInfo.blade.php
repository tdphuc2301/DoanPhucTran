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
                    <form action="{{ URL::to(route('admin.product.updateInfo', ['id' => $list->id])) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <p class="m-0 font-0-9">Sản phẩm<span class="text-danger">*</span>
                            </p>
                            <select disabled="disabled" class="form-control form-control-sm" name="product_id"
                                    data-live-search="true">
                                <option value="" selected>Vui lòng chọn</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @if ($list->id == $product->id) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="m-0 font-0-9">Số lượng<span class="text-danger">*</span>
                            </p>
                            <input name="stock_quantity" value = "{{$list->stock_quantity}}" type="number" min="0" required
                                class="form-control form-control-sm">
                        </div>
                        <button type="submit" class="btn btn-success theme-color">
                            Lưu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

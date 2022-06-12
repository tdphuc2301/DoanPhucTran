<div tabindex="-1" class="modal fade modal-add" id="modal-create">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 id="create-modal-title" class="modal-title">Tạo mới</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="group-tabs ">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li role="presentation" class="nav-item"><a href="#home" class="nav-link  active"
                                                                    aria-controls="home" role="tab" data-toggle="tab">Thông
                                tin chung</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row" id="create-data-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">ID</span>
                                        </p>
                                        <input name="id" placeholder="ID" readonly type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Mã Order<span class="text-danger">*</span>
                                        </p>
                                        <input name="code" id="code_order" readonly placeholder="Mã khuyến mãi" required
                                               type="text"
                                               class="form-control form-control-sm">
                                        <button type="button" class="btn btn-success theme-color"
                                                onclick="randomCodeOrder(10)">Random mã khuyến mãi
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Nhập note<span class="text-danger">*</span>
                                        </p>
                                        <input name="note" placeholder="note của khách hàng" required type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Chọn khách hàng<span class="text-danger">*</span>
                                            <select class="search customer show-tick" name="customer_id"
                                                    data-live-search="true">
                                                <option value="">Vui lòng chọn</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer['id'] }}">{{ $customer['name'] }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Chọn sản phẩm<span class="text-danger">*</span>
                                        </p>
                                        <select class="search product show-tick" name="product_id"
                                                data-live-search="true">
                                            <option value="">Vui lòng chọn</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Chọn khuyến mãi<span class="text-danger">*</span>
                                            <select class="search promotion show-tick" name="promotion_id"
                                                    data-live-search="true">
                                                <option value="">Vui lòng chọn</option>
                                                @foreach ($promotions as $promotion)
                                                    <option value="{{ $promotion['id'] }}">{{ $promotion['name'] }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Gía cả(price)<span class="text-danger">*</span>
                                        </p>
                                        <input id="price" name="price" placeholder="Nhập số lượng" required
                                               type="number"
                                               class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Số lương(quantity)<span class="text-danger">*</span>
                                        </p>
                                        <input id="quantity" name="quantity" placeholder="Nhập số lượng" required
                                               type="number"
                                               class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Trạng thái thanh toán<span class="text-danger">*</span>
                                        </p>
                                        <select class="search promotion show-tick" name="paid"
                                                data-live-search="true">
                                            <option value="1">Chưa thanh toán</option>
                                            <option value="2">Thanh toán thất bại</option>
                                            <option value="3">Thanh toán thành công</option>
                                            <option value="4">Hủy đơn hàng</option>
                                        </select>
                                    </div>
                                    
                                    @if (Auth::user()->branch_id === null)
                                        <div class="col-sm">
                                            <p class="m-0 font-0-9">Chi nhánh<span class="text-danger">*</span></p>
                                            <select class="search  show-tick" name="branch_id"
                                                    data-live-search="true">
                                                <option value="" selected>Vui lòng chọn</option>
                                                @foreach ($branchs as $branch)
                                                    <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Total(tổng tiền)<span class="text-danger">*</span>
                                        </p>
                                        <input id="total_price" name="total_price" readonly required type="number"
                                               class="form-control form-control-sm">
                                    </div>

                                    <input id="branch_id" name="branch_id" type="hidden"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy</button>
                <button id="btn-create" type="button" class="btn btn-success theme-color">
                    Thêm mới
                </button>
            </div>
        </div>
    </div>
</div>
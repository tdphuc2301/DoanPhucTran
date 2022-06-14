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
                                                                    aria-controls="home" role="tab" data-toggle="tab">Thông tin chung</a></li>
                        
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
                                        <p class="m-0 font-0-9">Tên người dùng<span class="text-danger">*</span>
                                        </p>
                                        <input name="name" placeholder="Tên danh mục" required type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Đường dẫn<span class="text-danger">*</span>
                                        </p>
                                        <input name="alias" placeholder="Đường dẫn" required type="text"
                                               class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Email<span class="text-danger">*</span>
                                        </p>
                                        <input name="email" placeholder="Email" required type="text"
                                               class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Phone<span class="text-danger">*</span>
                                        </p>
                                        <input name="phone" placeholder="Nhap so luong" required type="number"
                                               class="form-control form-control-sm">
                                    </div>
                                    
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Username<span class="text-danger">*</span>
                                        </p>
                                        <input name="username" placeholder="Username" required type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Vị trí</p>
                                        <input name="index" type="number" value="1" min="0"
                                               class="form-control form-control-sm">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Search địa chỉ<span class="text-danger">*</span>
                                        </p>
                                        <input name="search_address" placeholder="tìm kiếm" required type="text"
                                               id="search_address" class="form-control form-control-sm" >
                                        <form autocomplete="off">
                                            <div id="result"></div>
                                        </form>
                                    </div>

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Kinh độ(Longitude)<span class="text-danger">*</span>
                                        </p>
                                        <input id="longitude" readonly type="text" name="longitude" placeholder="Kinh độ"
                                               class="form-control form-control-sm">

                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Vĩ Độ(Latitude)<span class="text-danger">*</span>
                                        </p>
                                        <input id="latitude" readonly type="text" name="latitude" placeholder="Vĩ độ"
                                               class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Thứ hạng người dùng<span class="text-danger">*</span></p>
                                        <select id="type_id" class="search " name="type_id"
                                                data-live-search="true">
                                            @foreach ($type_customers as $type_customer)
                                                <option value="{{ $type_customer['id'] }}">{{ $type_customer['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Điểm<span class="text-danger">*</span>
                                        </p>
                                        <input id="point" type="text" name="point" placeholder="Nhập điểm"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Password<span class="text-danger">*</span>
                                        </p>
                                        <input name="password" placeholder="password" required type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Description
                                        </p>
                                        <textarea class="description" name="description"></textarea>
                                    </div>
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

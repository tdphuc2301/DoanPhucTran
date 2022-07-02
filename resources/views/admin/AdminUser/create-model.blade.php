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
                                        <p class="m-0 font-0-9">Tên User<span class="text-danger">*</span>
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
                                        <input name="email" placeholder="nhập email" required type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Username<span class="text-danger">*</span>
                                        </p>
                                        <input name="username" placeholder="username" required type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Password<span class="text-danger">*</span>
                                        </p>
                                        <input name="password" placeholder="password" required type="password" id="password" 
                                               class="form-control form-control-sm">
                                    </div>
                                        <p class="m-0 font-0-9">Chi nhánh<span class="text-danger">*</span>
                                        </p>
                                        <select class="search  show-tick" name="branch_id"
                                                data-live-search="true">
                                            <option value="" selected>Vui lòng chọn</option>
                                            @foreach ($branchs as $branch)
                                                <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                            @endforeach
                                        </select>
                                    <input name="branch_id" id="branch_id" type="hidden"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="text-center ">Ảnh đại diện <span><a class="remove-image" style="display:none" href="#">(Xóa)</a></span></p>
                                        <div class="avatar-wrapper">
                                            <img class="profile-pic"
                                                image-type="image"
                                                src="{{ asset('resources/admin/assets/images/default-thumbnail.png') }}" />
                                            <div class="upload-button" image-type="image">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                            <input ref="file" class="file-upload" index="0" image-type="image" type="file"
                                                accept="image/*" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <select class="search  show-tick" data-search="role_id"
                                                id="role_id" name="role_id"
                                                data-live-search="true">
                                            <option value="">Chọn quyền</option>
                                            @foreach ($roles as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
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

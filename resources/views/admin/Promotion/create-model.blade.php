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
                        <li role="presentation" class="nav-item "><a href="#settings" class="nav-link"
                                aria-controls="settings" role="tab" data-toggle="tab">SEO</a></li>
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
                                        <p class="m-0 font-0-9">Tên danh mục<span class="text-danger">*</span>
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
                                        <p class="m-0 font-0-9">Vị trí</p>
                                        <input name="index" type="number" value="1" min="0"
                                            class="form-control form-control-sm">
                                    </div>
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
                        <div role="tabpanel" class="tab-pane" id="settings">
                            <div class="row" id="metaseo-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Title</p>
                                        <input name="title" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Keyword</p>
                                        <input name="keyword" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Mô tả</p>
                                        <textarea name="description" type="text" rows="6" class="form-control form-control-sm"></textarea>
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

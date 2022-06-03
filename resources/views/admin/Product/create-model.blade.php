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
                        <li role="presentation" class="nav-item "><a href="#settings" class="nav-link"
                                                                     aria-controls="settings" role="tab"
                                                                     data-toggle="tab">SEO</a></li>
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
                                        <p class="m-0 font-0-9">Tên sản phẩm<span class="text-danger">*</span>
                                        </p>
                                        <input name="name" placeholder="Tên danh mục" required type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Đường dẫn<span class="text-danger">*</span>
                                        </p>
                                        <input name="alias" required placeholder="Đường dẫn" type="text"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm">
                                                <p class="m-0 font-0-9">Loại điện thoại<span
                                                            class="text-danger">*</span></p>
                                                <select name="category_id" class="search show-tick"
                                                        data-live-search="true">
                                                    <option value="" selected>Vui lòng chọn</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <p class="m-0 font-0-9">Bộ nhớ trong<span class="text-danger">*</span>
                                                </p>
                                                <select class="search show-tick" name="rom_id"
                                                        data-live-search="true">
                                                    <option value="" selected>Vui lòng chọn</option>
                                                    @foreach ($roms as $rom)
                                                        <option value="{{ $rom['id'] }}">{{ $rom['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm">
                                                <p class="m-0 font-0-9">Bộ nhớ ngoài<span class="text-danger">*</span>
                                                </p>
                                                <select class="search  show-tick" name="ram_id"
                                                        data-live-search="true">
                                                    <option value="" selected>Vui lòng chọn</option>
                                                    @foreach ($rams as $ram)
                                                        <option value="{{ $ram['id'] }}">{{ $ram['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <p class="m-0 font-0-9">Thương hiệu<span class="text-danger">*</span>
                                                </p>
                                                <select class="search  show-tick" name="brand_id"
                                                        data-live-search="true">
                                                    <option value="" selected>Vui lòng chọn</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm">
                                                @if (Auth::user()->branch_id === null)
                                                    <p class="m-0 font-0-9">Chi nhánh<span class="text-danger">*</span>
                                                    </p>
                                                    <select class="search  show-tick" name="branch_id"
                                                            data-live-search="true">
                                                        <option value="" selected>Vui lòng chọn</option>
                                                        @foreach ($branchs as $branch)
                                                            <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
{{--                                            <div class="col-sm">--}}
{{--                                                <p class="m-0 font-0-9">Màu<span class="text-danger">*</span></p>--}}

{{--                                                <fieldset>--}}
{{--                                                    <legend>Chọn màu <span class="text-danger">*</span></legend>--}}
{{--                                                    <div>--}}
{{--                                                        @foreach ($colors as $color)--}}
{{--                                                        <input type="checkbox" name="color" value="haha" id="{{ $color['id'] }}">--}}
{{--                                                        <label for="{{ $color['id'] }}">{{ $color['name'] }}</label>--}}
{{--                                                        @endforeach--}}
{{--                                                    </div>--}}
{{--                                                </fieldset>--}}
{{--                                                --}}
{{--                                            </div>--}}
                                            <input id="branch_id" name="branch_id" type="hidden"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Giá <span class="text-danger">*</span>
                                        </p>
                                        <input name="price" type="number" min="0" required
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Giá khuyến mãi<span class="text-danger">*</span>
                                        </p>
                                        <input name="sale_off_price" type="number" min="0" required
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Số lương tồn kho<span class="text-danger">*</span>
                                        </p>
                                        <input name="stock_quantity" type="number" min="0" required
                                               class="form-control form-control-sm stock_quantity">
                                    </div>
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Vị trí</p>
                                        <input name="index" type="number" value="1" min="0"
                                               class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="text-center ">Ảnh đại diện <span><a class="remove-image" href="#">(Xóa)</a></span>
                                        </p>
                                        <div class="avatar-wrapper">
                                            <img class="profile-pic"
                                                 image-type="image"
                                                 src="{{ asset('resources/admin/assets/images/default-thumbnail.png') }}"/>
                                            <div class="upload-button" image-type="image">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                            <input ref="file" class="file-upload" index="0" image-type="image"
                                                   type="file"
                                                   accept="image/*"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="text-center ">Ảnh phụ 1 <span><a class="remove-image"
                                                                                           href="#">(Xóa)</a></span></p>
                                                <div class="avatar-wrapper sub-avatar-wrapper">
                                                    <img class="profile-pic" image-type="image1"
                                                         src="{{ asset('resources/admin/assets/images/default-thumbnail.png') }}"/>
                                                    <div class="upload-button" image-type="image1">
                                                        <i class="fas fa-camera"></i>
                                                    </div>
                                                    <input ref="sub_file1" class="file-upload" image-type="image1"
                                                           index="1" type="file" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="text-center ">Ảnh phụ 2 <span><a class="remove-image"
                                                                                           href="#">(Xóa)</a></span></p>
                                                <div class="avatar-wrapper sub-avatar-wrapper">
                                                    <img class="profile-pic" image-type="image2"
                                                         src="{{ asset('resources/admin/assets/images/default-thumbnail.png') }}"/>
                                                    <div class="upload-button" image-type="image2">
                                                        <i class="fas fa-camera"></i>
                                                    </div>
                                                    <input ref="sub_file2" class="file-upload" image-type="image2"
                                                           index="2" type="file" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="text-center ">Ảnh phụ 3 <span><a class="remove-image"
                                                                                           href="#">(Xóa)</a></span></p>
                                                <div class="avatar-wrapper sub-avatar-wrapper">
                                                    <img class="profile-pic" image-type="image3"
                                                         src="{{ asset('resources/admin/assets/images/default-thumbnail.png') }}"/>
                                                    <div class="upload-button" image-type="image3">
                                                        <i class="fas fa-camera"></i>
                                                    </div>
                                                    <input ref="sub_file3" class="file-upload" image-type="image3"
                                                           index="3" type="file" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="m-0 font-0-9">Mô tả
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
                                        <p class="m-0 font-0-9">Description</p>
                                        <textarea name="description" type="text" rows="6"
                                                  class="form-control form-control-sm"></textarea>
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

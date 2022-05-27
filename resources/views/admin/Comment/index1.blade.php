@extends('Admin.Layouts.app')
@section('content')
    <div class="row" id="object-comment" api-list="{{route('admin.comment.get_list')}}"
         api-create="{{route('admin.comment.create')}}" api-get-item="{{ route('admin.comment.get_comment') }}"
         api-update="{{ route('admin.comment.update') }}" api-get-categories="{{ route('admin.comment.get_list') }}">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between mb-2">
                        <div class="filter-action-checked w-100 w-sm-auto">
                            <div class="filter-block d-flex flex-wrap flex-sm-nowrap  active">
                                <button type="button" class="btn btn-gradient-success btn-sm">Thêm mới
                                    <i class="mdi mdi-plus btn-icon-append"></i>
                                </button>
                                <div class="searchbox advance-searchs d-inline-block w-100 w-sm-auto ml-1 mr-sm-1">
                                    <div class="tags_input">
                                        <div class="input_search w-100">
                                            <input class="form-control form-control-sm"
                                                   placeholder="Tìm kiếm theo tên, category, code..">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-sm-nowrap flex-wrap w-100 float-right w-sm-auto">
                            <div class="d-flex w-100 w-sm-auto">
                                <div class="dropdown d-inline-block text-nowrap">
                                    <button class="btn border btn-outline-success btn-xs">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn border btn-outline-danger ml-1 btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" id="table-data">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Nội dung</th>
                            <th>Số sao</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="clone d-none">
                                <td class="id"></td>
                                <td class="product-id"></td>
                                <td class="name"></td>
                                <td class="email"></td>
                                <td class="content"></td>
                                <td class="stars"></td>
                                <td class="created-at"></td>
                                <td class="status"></td>
                                <td>abc</td>
                            </tr>
                           
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-2">

                    </div>
                </div>
            </div>

            @endsection
           
            @section('script')
                <script>

                    function showStatus(value) {
                        switch(value) {
                            case 'publish':
                                return 'Kích hoạt'
                                break
                            case 'trash':
                                return 'Khoá'
                                break
                        }
                    }
                    function showClass(value) {
                        switch (value) {
                            case 'publish': 
                                return 'bg-success'
                                break
                            case 'trash':
                                return 'bg-danger'
                                break
                        }
                    }
                    var api_get_list = $('#object-comment').attr('api-list');
                    var clone = $('.clone')
                    $(document).ready(function() {
                        $.ajax({
                            type: 'GET',
                            url: api_get_list,
                            success: function (data) {
                                var data = data.data.comments.data;
                                $.each(data, function (key, item) {
                                    
                                    var copy_clone = clone.clone()
                                    copy_clone.removeClass('d-none').removeClass('clone')
                                    copy_clone.find('.id').html(key+1)
                                    copy_clone.find('.product-id').html(item.product_id)
                                    copy_clone.find('.name').html(item.name)
                                    copy_clone.find('.email').html(item.email)
                                    copy_clone.find('.content').html(item.content)
                                    copy_clone.find('.stars').html(item.stars)
                                    copy_clone.find('.created-at').html(item.created_at.slice(0,10))
                                    copy_clone.find('.status').html(showStatus(item.status)).addClass(showClass(item.status))
                                    copy_clone.appendTo("tbody");
                                });
                            }
                        })
                        .done ((res) => {
                            if(res.error) {
                                console.log(res.message);
                                return;
                            }
                        })
                });
                
                </script>

@endsection

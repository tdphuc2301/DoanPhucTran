@extends('Admin.Layouts.app')
@section('content')
{{-- <div class="page-header">--}}
{{-- <h3 class="page-title">Danh sách quản trị viên</h3>--}}
{{-- <nav aria-label="breadcrumb">--}}
{{-- <ol class="breadcrumb">--}}
{{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>--}}
{{-- <li class="breadcrumb-item active" aria-current="page">Quản trị viên</li>--}}
{{-- </ol>--}}
{{-- </nav>--}}
{{-- </div>--}}
<div class="row" id="object-contact" api-list="{{route('admin.contact.get_list')}}" api-create="{{route('admin.contact.create')}}" api-get-item="{{ route('admin.contact.get_contact') }}" api-update="{{ route('admin.contact.update') }}">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Lời nhắn</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th style="width: 5%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tb-contact">
                        <tr class="tr-contact d-none">
                            <td class="stt"></td>
                            <td class="name"></td>
                            <td class="email"></td>
                            <td class="msg"></td>
                            <td class="date"></td>
                            <td class="status"></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
                {{-- <div class="d-flex justify-content-between align-items-center mt-2">--}}
                {{-- <form class="w-50">--}}
                {{-- <select class="custom-select w-25" v-model="pagination.limit">--}}
                {{-- <option value="5">5</option>--}}
                {{-- <option value="10">10</option>--}}
                {{-- <option value="100">100</option>--}}
                {{-- </select>--}}
                {{-- <span >Hiển thị <strong> @{{ ((pagination.page - 1 ) * pagination.limit) + 1}} - @{{ ((pagination.page * pagination.limit) > pagination.totalrecords) ? pagination.totalrecords : (pagination.page * pagination.limit)}} </strong> trên <strong> @{{pagination.totalrecords}} </strong></span>--}}
                {{-- </form>--}}
                {{-- <pagination :current="pagination.page" v-model="pagination.page" :total="pagination.last_page"></pagination>--}}
                {{-- </div>--}}
            </div>
        </div>
    </div>


</div>





@endsection
@section('script')
<script>
    let api_get_list = $("#object-contact").attr('api-list');
    $.ajax({
        type: "GET",
        async: false,
        url: api_get_list,
        success: function(result, status, xhr) {
            let data = result.data.contacts.data;
            console.log(data);
            var content = "";
            var tbody = document.getElementById("tb-contact");
            var tr = tbody.querySelector(".tr-contact");

            for (let i in data) {
                // content += `
                //     <tr>
                //         <td>${i + 1}</td>
                //         <td>${val.name}</td>
                //         <td>${val.email}</td>
                //         <td>${val.message}</td>
                //         <td>${val.created_at}</td>
                //         <td>${val.status}</td>
                //     </tr>                
                //                 `
                var name = tr.querySelector(".name");
                name.innerHTML = data[i].name;
                var clone = tr.cloneNode(true);
                clone.classList.remove("d-none");
                tbody.appendChild(clone);


            }

        }

    })
</script>
@endsection
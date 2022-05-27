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
<div class="row" id="object-customer" api-list="{{ route('admin.customer.get_list') }}">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">


                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="tbcontact">
                        <tr class="mylist d-none">
                            <td class="no"></td>
                            <td class="name"></td>
                            <td class="email"></td>
                            <td class="phone"></td>
                            <td class="create-day"></td>
                            <td class="status"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>





@endsection
@section('script')
<script>

    let api_get_list = $('#object-customer').attr('api-list');

    $(document).ready(function() {
        $.ajax({
        url: api_get_list,
        type: "GET",
        async: false,
        success: function(result, status, xhr){
            if (status) {
                let listDataUser = result.data.customers.data
                console.log(listDataUser);

                // ----------------------------JavaScipt----------------------------
                // const tbContact = document.getElementById("tbcontact");
                // const tr = tbContact.querySelector(".mylist");

                // for (let [index, val] of listDataUser.entries()) {
                //     var name = tr.querySelector(".name")
                //     var stt = tr.querySelector(".no")
                //     var email = tr.querySelector(".email")
                //     var phone = tr.querySelector(".phone")
                //     var ngayTao = tr.querySelector(".create-day")
                //     var status = tr.querySelector(".status")

                //     name.innerHTML = val.name;
                //     stt.innerHTML = index;
                //     email.innerHTML = val.email
                //     phone.innerHTML = val.phone
                //     ngayTao.innerHTML = val.created_at
                //     status.innerHTML = val.status


                //     clone(tr, tbContact)
                // }


                // ----------------------------JQuery----------------------------
                const tbContact = $("#tbcontact");
                const tr = $(".mylist");                
                for (let [index, val] of listDataUser.entries()) {
                    var clone = tr.clone();

                    clone.removeClass("d-none")
                    clone.find(".no").html(index)
                    clone.find(".name").html(val.name)
                    clone.find(".email").html(val.email)
                    clone.find(".phone").html(val.phone)
                    clone.find(".create-day").html(val.created_at)
                    clone.find(".status").html(val.status)

                    clone.appendTo(tbContact);
                }
            }
            return;
        }
    });
    })

    const clone = function (children, father){
        var clone = children.cloneNode(true);
        clone.classList.remove("d-none")
        father.appendChild(clone);
    }

</script>
@endsection

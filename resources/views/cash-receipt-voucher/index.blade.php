@extends('layouts.master')
@section('head')
    <link rel="stylesheet" href="{{url('css/datatables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('optimization/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker.min.css">
    <style type="text/css">
        .bank_account_box{
            display: none;
        }
        .recipient_hidden{
            display: none;
        }
        th{
            text-align: center;
        }

        .modal-title{
            color: orange;
            font-weight: bold !important;
        }

        table.dataTable thead .sorting_asc:after{
            display: none;
        }

        #historyFinance #list-collect-tuition-table_length, #historyFinance #list-collect-tuition-table_filter, #historyFinance #list-collect-tuition-table_info, #historyFinance #list-collect-tuition-table_paginate, #student-finance-table_filter, #list-collect-tuition-table-2_filter{
            display: none;
        }

        .nav-tabs>li.active>a {
            border:none !important;
            border-bottom: 3px solid orange !important;
        }

        .sweet-alert{
            z-index: 12000;
        }

        .sweet-overlay{
            z-index: 11000;
        }

        .tbl_stt, .tbl_status, .tbl_action{
            text-align: center;
        }

        .tbl_tuition, .tbl_tuition_reduce, .tbl_tuition_repaid, .tbl_tuition_owed{
            text-align: right;
        }

        #amount-receipt{
            float: right;
        }
    </style>
@endsection

@section('contents')

    <div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                {{-- call ajax here --}}
            </div>
        </div>
    </div>

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption" style="font-size: 14px">
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="">  Trang chủ </a>
                &nbsp;/&nbsp; Phiếu thu
            </div>
        </div>
        <div class="portlet-body">
            <br>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#new-students">Danh sách phiếu thu</a></li>
            </ul>
            <div class="tab-content">
                <div id="new-students" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-xs-12">
                            <br>
                            <button type="button" class="btn btn-sm green btn-create-obj" data-create-path="{{ route('cash-receipt-voucher.create') }}">
                                <i class="fa fa-plus"></i> Tạo phiếu thu
                            </button>
                        </div>
                    </div>
                    <br>
                    <table class="table table-striped table-bordered table-hover" id="receipt_voucher_table">
                        <thead>
                        <tr>
                            <th class="stl-column color-column">STT</th>
                            <th class="stl-column color-column">Mã phiếu</th>
                            <th class="stl-column color-column">Người thu</th>
                            <th class="stl-column color-column">Người nộp</th>
                            <th class="stl-column color-column">Số tiền</th>
                            <th class="stl-column color-column">Lí do</th>
                            <th class="stl-column color-column">Ngày chứng từ</th>
                            <th class="stl-column color-column">Ngày ghi sổ</th>
                            <th class="stl-column color-column">Chức năng</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{url('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{ asset('optimization/jQuery.print-master/jQuery.print.js') }}"></script>
    <script src="{{ asset('optimization/js/moment.min.js') }}"></script>
    <script src="{{ asset('optimization/js/moment-with-locales.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('assets/global/plugins/jquery-number-master/jquery.number.min.js') }}" charset="UTF-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $("body").tooltip({ selector: '[data-tooltip=tooltip]' });
    </script>
    <script type="text/javascript" src="{{mix('build/js/global.js')}}"></script>
    <script>
        $('#receipt_voucher_table').DataTable({
            processing: true,
            serverSide: true,
            ordering:   false,
            pageLength: 25,
            ajax: '{!! route('cash-receipt-voucher.index') !!}',
            pageLength: 30,
            lengthMenu: [[30, 50, 100, 200, 500], [30, 50, 100, 200, 500]],
            columns: [
                {data: 'DT_Row_Index', className:'tbl_stt'},
                {data: 'code', name: 'code'},
                {data: 'object_name', name: 'object_name'},
                {data: 'name_payer', name: 'name_payer'},
                {data: 'amouth_money', name: 'amouth_money'},
                {data: 'reason', name: 'reason'},
                {data: 'created_at', name: 'created_at'},
                {data: 'accouting_date', name: 'accouting_date'},
                {data: 'action', name: 'action', className: 'text-center'},
                
            ]
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.btn-edit-obj',function () {
                var path = $(this).data('edit-path');
                $('.modal-content').load(path,function(){
                    $('#myModal').modal({show:true});
                });
            });
            $(document).on('click','.btn-create-obj',function () {
                var path = $(this).data('create-path');
                $('.modal-content').load(path,function(){
                    $('#myModal').modal({show:true});
                });
            });
            $(document).on('click','.btn-show-obj',function () {
                var path = $(this).data('show-path');
                $('.modal-content').load(path,function(){
                    $('#myModal').modal({show:true});
                });
            });
            $(document).on('click','.btn-accept-3',function () {
                var path = $(this).data('accept-path');
                $('.modal-content').load(path,function(){
                    $('#myModal').modal({show:true});
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit','#form_create',function (event) {
                var path = $(this).attr('action');
                var formData = new FormData(this);
                formData.append('money', $('#money').val());
                $.ajax({
                    url: path,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                })
                    .done(function(res) {
                        if (!res.error) {
                            toastr.success('Tạo mới thành công');
                            $('#myModal').modal('hide');
                            $("#lar_table").DataTable().ajax.reload();
                        } else {
                            toastr.error('Có gì đó sai sai');
                        }
                        return false;
                    })
                    .fail(function(xhr, ajaxOptions, thrownError) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            error = value[0];
                        });
                        toastr.error(error);
                        return false;
                    })
                    .always(function() {
                        console.log("complete");
                        return false;
                    });
                event.preventDefault();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click','.btn-delete-obj',function () {
            var id = $(this).attr('data-delete-id');
            swal({
            title: "Bạn có chắc chắn xóa phiếu tạm ứng?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                        $.ajax({
                        url: '',
                        type: 'POST',
                        dataType: 'json',
                        cache: false,
                        destroy: true,
                        data: {
                            id: id,
                        },
                        success: function(res){
                            if (res.error == false) {
                                $("#lar_table").DataTable().ajax.reload();
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            toastr.error(thrownError);
                        }


                    })
                }
            });
            
        });
    </script>
@endsection

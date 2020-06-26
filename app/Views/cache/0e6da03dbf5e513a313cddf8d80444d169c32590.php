<?php $__env->startSection('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fa fa-chess-rook"></i> Role Management</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 id="form-title">Create New Role</h4>
                        </div>
                        <div class="card-body">
                            <form id="form-role" method="POST" novalidate="">
                                <div class="form-group">
                                    <label>Role Name</label>
                                    <input type="hidden" id="role_id" name="role_id"/>
                                    <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Enter Role Name" required="">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label class="custom-switch" style="padding-left:0px;">
                                        <input type="checkbox" id="status" name="status" class="custom-switch-input" checked>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Status Active</span>
                                    </label>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                    <button type="button" id="btn-cancel" class="btn btn-warning"><i class="fas fa-window-close"></i> Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table-role">
                                    <thead class="gradient">
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Role Name</th>
                                            <th>Status</th>
                                            <th width="20%" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js_content'); ?>
<script>
    $(document).ready(function(){
        var table = $("#table-role").DataTable({ 
            "processing" : true, 
            "serverSide" : false, 
            "destroy" : true,
            "autoWidth" : false,
            "order": [],
            "ajax": {
                "url": "api/role",
                "type": "GET",
            },
            "columns" : [
                {data: 'no', name: 'no', orderable: false, searchable: false, width:'7%'},
                {data: 'role_name', name: 'role_name'},
                {data: 'status', name: 'status', searchable: false, render: function(e, t, f){
                    if(f.status == 'Y'){
                        return '<div class="badge badge-info">Active</div>';
                    } else {
                        return '<div class="badge badge-danger">Inactive</div>';
                    }
                }},
                {data: 'role_id', name: 'role_id', orderable: false, searchable: false, render: function(e, t, f){
                    return '<center>'+
                        '<button id="btn-mapping-menu" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Role Mapping Menu"><i class="fas fa-sitemap"></i></button>&nbsp;'+
                        '<button id="btn-edit" data-no="'+f.no+'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Role"><i class="fas fa-edit"></i></button>&nbsp;'+
                        '<button id="btn-delete" data-no="'+f.no+'" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Role"><i class="fas fa-trash"></i></button></center>';
                }},
            ],
            "columnDefs": [{ 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],
        }); 
    })

    $(document).on("submit", "#form-role", function(e){
        e.preventDefault();
        var role_id = $("#role_id").val();

        $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Please Wait");
        $("#btn-submit").prop("disabled", true);
        
        var url_action = role_id == "" ? "add" : "update/"+role_id;
        var http_method = role_id == "" ? "POST" : "POST";
        $.ajax({
            "async": true,
            "crossDomain": true,
            "url": "api/role/"+url_action,
            "method": http_method,
            "headers": {
                "content-type": "application/x-www-form-urlencoded",
            },
            "data": $(this).serialize(),
        }).done(function(data){
            iziToast.success({title: "Success", message: data.message, position: 'topRight'});
            setTimeout(function(){
                $("#btn-submit").html("<i class='fas fa-save'></i> Save Role");
                $("#btn-submit").prop("disabled", false);

                $('form').removeClass("needs-validation was-validated");
                $("#form-role")[0].reset();
                $("#role_id").val("");

                $("#table-role").DataTable().ajax.reload();
            }, 1000);
        }).fail(function(error){
            $("#btn-submit").html("<i class='fas fa-save'></i> Save Role");
            $("#btn-submit").prop("disabled", false);
            var responseError = error.responseJSON;
            if(responseError.code == 400){
                $('form').addClass("needs-validation was-validated");
                $(".invalid-feedback").html(responseError.message.role_name);
            } else {
                iziToast.error({title: responseError.title, message: responseError.message, position: 'topRight'});
            }
        });
    });

    $(document).on("click", "#btn-edit", function(e){
        var no = $(this).data("no");
        var data = $("#table-role").DataTable().rows({selected: true}).data()[no - 1];

        $("#form-title").html("Update Role");
        $("#btn-submit").html("<i class='fas fa-edit'></i> Update Role");
        
        $("#role_id").val(data.role_id);
        $("#role_name").val(data.role_name);
        $("#status").prop("checked", data.status == "Y" ? "checked" : "");
    });

    $(document).on("click", "#btn-cancel", function(e){
        var id = $("#role_id").val();

        if(id != ""){
            $("#form-title").html("Create New Role");
            $("#btn-submit").html("<i class='fas fa-save'></i> Save Role");
        }
        $('form').removeClass("needs-validation was-validated");

        $("#form-role")[0].reset();
        $("#role_id").val("");
    });

    $(document).on("click", "#btn-delete", function(e){
        var no = $(this).data("no");
        var data = $("#table-role").DataTable().rows({selected: true}).data()[no - 1];
        
        swal({
            title: 'Delete role data !!!',
            text: 'Are you sure to delete this data ?',
            icon: 'warning',
            buttons: ["Cancel", "Delete"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    "async": true,
                    "crossDomain": true,
                    "url": "api/role/delete/"+data.role_id,
                    "method": "DELETE",
                    "headers": {
                        "content-type": "application/x-www-form-urlencoded",
                    },
                    beforeSend:function(xhr){
                        swal("", {  icon: '/assets/img/loading.gif', buttons:false });
                    },
                }).done(function(data){
                    swal(data.message, {
                        icon: 'success',
                    }).then((isConfirm) => {
                        $("#table-role").DataTable().ajax.reload();
                    });
                }).fail(function(error){
                    var responseError = error.responseJSON;
                    swal(responseError.message, {
                        icon: 'error',
                    });
                });
            }
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\user-access-control\app\Views/role/index.blade.php ENDPATH**/ ?>
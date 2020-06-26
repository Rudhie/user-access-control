<?= $this->extend("template") ?>
<?= $this->section("content") ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fa fa-users"></i> User Management</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" id="btn-add" class="btn btn-sm btn-primary"><i class="fas fa-users"></i> Add New User</button>
                            <hr/>
                            <div class="table-responsive">
                                <table class="table" id="table-user">
                                    <thead class="gradient">
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Role</th>
                                            <th style="text-align:center">Picture</th>
                                            <th width="15%" style="text-align:center">Action</th>
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

<div class="modal fade" role="dialog" id="modal-form-user" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-user" method="POST" novalidate="">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <img src="assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture img-thumbnail" />
                            &nbsp;<br/>
                            <div class="button-wrapper">
                                <span class="label">Upload Picture</span>
                                <input type="file" name="upload" id="upload" class="upload-box" placeholder="Upload Picture">
                            </div>
                        </div>
                        <div class="col-12 col-lg-1"></div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="hidden" id="user_id" name="user_id"/>
                                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter Full Name" required="">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label>Username *</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter Username">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Enter Phone Number">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label>Role *</label>
                                <select class="form-control select2" id="select-role" style="width:100%">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("js_content") ?>
<script>
    $(document).ready(function(){
        selectRole();
        var table = $("#table-user").DataTable({ 
            "processing" : true, 
            "serverSide" : false, 
            "destroy" : true,
            "autoWidth" : false,
            "order": [],
            "ajax": {
                "url": "api/user",
                "type": "GET",
            },
            "columns" : [
                {data: 'no', name: 'no', orderable: false, searchable: false, width:'7%'},
                {data: 'fullname', name: 'fullname'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'role_id', name: 'role_id'},
                {data: 'picture', name: 'picture', orderable: false, searchable: false, render: function(e, t, f){
                    if(f.status == 'Y'){
                        return '<div class="badge badge-info">Active</div>';
                    } else {
                        return '<center><figure class="avatar mr-2 avatar-sm bg-success text-white" data-initial="AT"></figure></center>';
                    }
                }},
                {data: 'user_id', name: 'user_id', orderable: false, searchable: false, render: function(e, t, f){
                    return '<center>'+
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
    });

    $(document).on("click", "#btn-add", function(){
        $("#select-role").select2();
        $("#modal-form-user").modal("show");
    });

    function selectRole(){
        $.ajax({
            "async": true,
            "crossDomain": true,
            "url": "<?= base_url('api/filter/role') ?>",
            "method": "POST"
        }).done(function(data){
            var data = JSON.parse(data);
            var dataIndikator = data.data;
            var select = "";
            dataIndikator.forEach(function(item, index){
                select += "<label><input type='radio' id='id_indikator_anomali' name='id_indikator_anomali' class='i-checks' value="+item.id_indikator_anomali+"> "+item.nm_indikator_anomali+"</label><br/>";
            });
            $(element).html(select);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }).fail(function(error){
            alert("error");
        });
    }
</script>
<?= $this->endSection() ?>
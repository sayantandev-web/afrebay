<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">
                    <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                      <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Banner Name</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--  Add mmodal -->
<div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Heading</label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter Heading">
                            </div>
                            <div class="form-group">
                                <label>Image <span style="color:red;">*</span>(size : 1900 X 800) <span id="image_err"></span></label>
                                <input class="form-control" type="file" name="image" id="image">
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return create_banner();">Submit</button>
                                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  end add modal -->

<!--  edit mmodal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Heading </label>
                                <input class="form-control" type="text" name="name" id="edit_name" placeholder="Enter Heading">
                            </div>
                            <div class="form-group">
                                <label>Image <span style="color:red;">*</span> (size : 1900 X 800)<span id="edit_image_err"></span></label>
                                <input class="form-control" type="file" name="image" id="edit_image">
                            </div>
                            <div id="show_img"> </div>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="old_image" id="old_image">
                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" onclick="return update_banner();">Save Changes</button>
                                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  end edit modal -->



<script>
var url = '<?= admin_url('manage_home/Banner/ajax_manage_page')?>';
var actioncolumn=2;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/banner.js')?>"></script>

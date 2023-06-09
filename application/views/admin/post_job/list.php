<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right">

                    <!--  <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i>
                </a> -->
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
                                    <th>Post Title</th>
                                    <th>Job Category</th>
                                    <th>Duration</th>
                                    <th>Approximate Remuneration</th>
                                    <th>Status</th>
                                    <th>Action</th>
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

<script>
var url = '<?= admin_url('Post_job/ajax_manage_page')?>';
var actioncolumn=5;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/rating_type.js')?>"></script>

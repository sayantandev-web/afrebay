<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title"><?= $heading;?></h3>
                </div>
                <div class="col-auto text-right"></div>
            </div>
        </div>

        <div class="card filter-card" id="filter_inputs">
            <div class="card-body pb-0">
                <form action="#" method="post">
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control select filter_search_data6" name="">
                                    <option value="">Select category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>From Date</label>
                                <div class="cal-icon">
                                    <input class="form-control  filter_search_data5" type="date" name="from_date" value="">
                                </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>To Date</label>
                                <div class="cal-icon">
                                    <input class="form-control  filter_search_data7" type="date" name="to_date" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <a class="btn btn-primary btn-block" href="<?= admin_url('Category')?>">Refresh</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vendor</th>
                                        <th>Freelancer</th>
                                        <th>Initiated Date</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($chat_list)) {
                                    $i = 1;
                                    foreach ($chat_list as $value) { ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $value['full_name'];?></td>
                                        <td><?php echo $value['to_fullname'];?></td>
                                        <td><?php echo $value['created_date'];?></td>
                                        <td>
                                            <span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#viewModal" onclick="view_data(3)" data-placement="right"><i class="far fa-eye mr-1"></i><a href="<?=admin_url(); ?>chat_details/<?php echo $value['userfrom_id']?>/<?php echo $value['userto_id']?>">View Chat</a></span>
                                        </td>
                                    </tr>
                                <?php $i++; } } ?>
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

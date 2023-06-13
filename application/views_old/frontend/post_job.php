<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?php $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Post Jobs</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block no-padding">
        <div class="container">
            <div class="row no-gape">
                <div class="col-lg-12 column">
                    <div class="padding-left">
                        <div class="profile-title" style="text-align: center;">
                            <?php if(empty(@$id)) { ?>
                            <h3>Post a New Job</h3>
                            <?php } else { ?>
                            <h3>Update Posted Job</h3>
                            <?php } ?>
                            <span class="text-success-msg f-20" style="text-align: center;">
                                <?php if($this->session->flashdata('message')) {
                                    echo $this->session->flashdata('message');
                                    unset($_SESSION['message']);
                                } ?>
                            </span>
                        </div>
                        <div class="profile-form-edit">
                            <?php $seg1=$this->uri->segment(1);
                            if($seg1 == 'update-postjob') { ?>
                            <form method="post" action="<?php echo base_url('Welcome/edit_post_job')?>" enctype="multipart/form-data" >
                            <?php } else { ?>
                                <form method="post" action="<?php echo base_url('Welcome/save_postjob')?>" enctype="multipart/form-data" >
                            <?php } ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="pf-title">Job Title<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <input type="text" placeholder="Enter Job Title" name="post_title" id="post_title" class="form-control " value="<?= @$post_title; ?>" data-role="tagsinput" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Description</span>
                                        <div class="pf-field">
                                            <textarea name="description" id="description" placeholder="Enter Description"><?= @$description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Required Key Skills<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select class="form-control key_skills" multiple="multiple" name="key_skills[]" id="key_skills" style="width: 100%;">
                                            <!-- <?php foreach($getkey_skills as $val) {?>
                                                <option value="<?php echo $val->specialist_name; ?>"><?php echo $val->specialist_name;?></option>
                                            <?php } ?> -->
                                            <?php
                                            $skills = $this->Crud_model->GetData('specialist',"","status = 'Active'");
                                            foreach($skills as $val) {?>
                                                <option value="<?php echo $val->specialist_name; ?>"
                                                <?php if(!empty($key_skills)) {
                                                if(!empty($skills)){
                                                        $vskills = explode(", ", $key_skills);
                                                        for($i=0; $i<count($vskills); $i++) {
                                                            if($vskills[$i] == $val->specialist_name){
                                                                echo "selected";
                                                            }
                                                        }
                                                    }
                                                } ?>><?php echo $val->specialist_name;?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Approximate Duration</span>
                                        <div class="pf-field">
                                            <input type="text" placeholder="Enter Duration" name="duration" class="form-control " value="<?= @$duration; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Approximate Remuneration ($)</span>
                                        <div class="pf-field">
                                            <input type="text" placeholder="Enter Charges" name="charges" class="form-control " value="<?= @$charges; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Categories<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select data-placeholder="Please Select Category" class="form-control" name="category_id" onchange="get_subcategory(this.value)" required>
                                                <option value="">Select Category</option>
                                                <?php
                                                $getcategory = $this->Crud_model->GetData('category', 'id, category_name', "");
                                                foreach($getcategory as $key) {?>
                                                    <option value="<?= $key->id; ?>" <?php if($key->id == $category) {echo "selected"; }?>><?php echo $key->category_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Sub Categories<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select data-placeholder="Please Select " class="form-control" name="subcategory_id" value="" id="subcategory_id" required>
                                                <?php if(empty($id)) { ?>
                                                <option>Select Subcategory</option>
                                                <?php } else { ?>
                                                    <option>Select Subcategory</option>
                                                    <?php
                                                    $getsubcategory = $this->Crud_model->GetData('sub_category', 'id, sub_category_name', "");
                                                    foreach($getsubcategory as $key) {?>
                                                        <option value="<?= $key->id; ?>" <?php if($key->id == $subcategory) {echo "selected"; }?>><?php echo $key->sub_category_name;?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Application Deadline Date<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <input type="date" placeholder="Enter Complete Address" name="appli_deadeline" class="form-control datepicker" value="<?= @$appli_deadeline; ?>" required/>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <span class="pf-title">Complete Address</span>
                                        <div class="pf-field">
                                            <textarea id="complete_address"  name="complete_address" placeholder="Enter Address"></textarea>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <span class="pf-title">Country<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select class="form-control" name="country-dropdown" id="country-dropdown" style="width: 100%;">
                                                <option value="">Select Country</option>
                                            <?php
                                            $get_country = $this->Crud_model->GetData('countries', 'id, name', "");
                                            foreach($get_country as $val) {?>
                                                <option value="<?php echo $val->name; ?>" <?php if($val->name == $countries) {echo "selected"; }?>><?php echo $val->name;?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="pf-title">State<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select class="form-control" name="state-dropdown" id="state-dropdown">
                                            <?php if(empty($id)) { ?>
                                                <option value="">Select State</option>
                                                <?php } else { ?>
                                                <option>Select State</option>
                                                <?php
                                                $get_state = $this->Crud_model->GetData('states', 'id, name', "");
                                                foreach($get_state as $key) {?>
                                                    <option value="<?= $key->name; ?>" <?php if($key->name == $state) {echo "selected"; }?>><?php echo $key->name;?></option>
                                                <?php } ?>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="pf-title">City<span style="color:red;">*</span></span>
                                        <div class="pf-field">
                                            <select class="form-control" name="city-dropdown" id="city-dropdown">
                                                <?php if(empty($id)) { ?>
                                                    <option value="">Select City</option>
                                                    <?php } else { ?>
                                                    <option>Select City</option>
                                                    <?php
                                                    $get_cities = $this->Crud_model->GetData('cities', 'id, name', "");
                                                    foreach($get_cities as $key) {?>
                                                        <option value="<?= $key->name; ?>" <?php if($key->name == $cities) {echo "selected"; }?>><?php echo $key->name;?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    <div class="contact-edit">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span class="pf-title">Find On Map<span style="color:red;">*</span></span>
                                                <div class="pf-field">
                                                    <input type="text" placeholder="Collins Street West, Victoria 8007, Australia." name="location" value="<?= @$location; ?>" id="location"  required autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <span class="pf-title">Latitude</span>
                                                <div class="pf-field">
                                                    <input type="text" id="search_lat" name="latitude"  placeholder="41.1589654" value="<?= @$latitude; ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <span class="pf-title">Longitude</span>
                                                <div class="pf-field">
                                                    <input type="text" id="search_lon"   placeholder="21.1589654" name="longitude" value="<?= @$longitude; ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="button" class="srch-lctn" onclick="return show_location();">Search Location</button>
                                            </div>
                                            <div class="col-lg-12">
                                                <span class="pf-title">Maps</span>
                                                <div class="pf-map" id="map">

                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit">Submit</button>
                                                <input type="hidden" name="id" value="<?php echo @$id?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/taginput.css')?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
CKEDITOR.replace('description');
</script>
<script>
$('.key_skills').select2({
    tags: true,
    //maximumSelectionLength: 10,
    tokenSeparators: [','],
    placeholder: "Select or Type Skills"
});
function show_location() {
    var location=$('#location').val();
    $('#map').html('<iframe src="https://maps.google.it/maps?q='+location+'&output=embed"></iframe>');
    $('#complete_address').val(location);
}
$(document).ready(function() {
    $('#country-dropdown').on('change', function() {
        var country_name = this.value;
        $.ajax({
            url: "<?php echo base_url()?>Welcome/states_by_country",
            type: "POST",
            data: {
                country_name: country_name
            },
            cache: false,
            success: function(result){
                //console.log(result);
                $("#state-dropdown").html(result);
                $('#city-dropdown').html('<option value="">Select State First</option>');
            }
        });
    });

    $('#state-dropdown').on('change', function() {
        var state_name = this.value;
        $.ajax({
            url: "<?php echo base_url()?>Welcome/cities_by_state",
            type: "POST",
            data: {
                state_name: state_name
            },
            cache: false,
            success: function(result){
                $("#city-dropdown").html(result);
            }
        });
    });
});
</script>

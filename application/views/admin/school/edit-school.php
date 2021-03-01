<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Edit School</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-home"></i></a></li>

                            <li class="breadcrumb-item active" aria-current="page">Add School</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <?php if ($this->session->flashdata('flash_message')) {
                echo $this->session->flashdata('flash_message');
            }
            ?>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header"><?=$school["name"]?></h5>
                <form action="/admin/school/update/<?=$school["university_id"]?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="schoolName">University Name</label>
                            <input type="text" value="<?=$school["name"]?>" class="form-control" name="name" id="schoolName" placeholder="Purdue University" />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="schoolWebsite">University  Website</label>
                                <input type="text" value="<?=$school["website"]?>" class="form-control" id="schoolWebsite" name="website" placeholder="https://example.edu" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lms">LMS</label>
                                <select name="lms" class="form-control" id="lms">
                                    <?php
                                    if($school_lms){
                                        ?>
                                        <option value="<?=$school_lms["id"]?>" selected="selected"><?=$school_lms["name"]?></option>
                                    <?php
                                    }
                                    if (count($lmses)){
                                        foreach ($lmses as $lms){
                                            ?>
                                            <option value="<?=$lms['id']?>"><?=$lms["name"]?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="canvasURL">Lms Base URL</label>
                                <input value="<?=$school["canvas_url"]?>" type="text" class="form-control" id="canvasURL" name="canvas_url" />
                            </div>
                        </div>
                        <div class="form-row">
                            <!--<div class="form-group col-md-4">
                                <label for="emailDomain">Email Domain</label>
                                <input type="text" class="form-control" id="emailDomain" name="emailDomain" />
                            </div>-->
                            <div class="form-group col-md-6">
                                <label for="alpha_two_code">Country Alpha-2 Code</label>
                                <input value="<?=$school["alpha_two_code"]?>" type="text" class="form-control" id="alpha_two_code" name="alpha_two_code" placeholder="KE" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Country</label>
                                <input value="<?=$school["country"]?>"  type="text" class="form-control" id="country" name="country" placeholder="Kenya" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm btn-outline">
                            Update School
                        </button>
                        <a href="/admin/viewSchool"  class="btn btn-secondary clear-form">
                            Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

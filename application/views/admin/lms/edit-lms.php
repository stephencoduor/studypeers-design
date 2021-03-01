<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Edit <?=$lms_["name"]?> Lms</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-home"></i></a></li>

                            <li class="breadcrumb-item active" aria-current="page">Edit Lms</li>
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
                <h5 class="card-header">Edit <?=$lms_["name"]?> Lms</h5>
                <?php echo form_open_multipart('admin/lms/update/'.$lms_["id"]);?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="schoolName">Lms Name</label>
                        <input type="text" class="form-control" value="<?=$lms_['name']?>" name="name" id="lmsName" placeholder="Canvas Lms" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lms_endPoints">Lms Endpoints</label>
                            <input type="text" class="form-control" value="<?=$lms_["lms_end_points"]?>" id="lms_endPoints" name="lms_end_points" placeholder="/api/v1/" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="canvasURL">Lms Logo</label>
                            <input type="file" class="form-control" id="lmsLogo" name="lms_logo" />
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm btn-outline">
                        Update Lms
                    </button>
                    <a href="/admin/viewLms" class="btn btn-secondary">
                        Back To List
                    </a>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Lms List</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-home"></i></a></li>

                            <li class="breadcrumb-item active" aria-current="page">Lms List</li>
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
                <h5 class="card-header">
                    <a href="/admin/addLms" class="btn btn-sm btn-success fa fa-plus" >Add Lms</a>
                </h5>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Logo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Lms Endpoints</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($result) ) :
                        foreach ($result as $lms) :
                            ?>
                            <tr>
                                <td><img src="/<?php echo $lms->lms_logo ?>" alt="" style="max-height: 30px;width: 100px"></td>
                                <td><?php echo $lms->name ?></td>
                                <td><?php echo $lms->lms_end_points ?></td>
                                <td>
                                    <a href="/admin/lms/update/<?=$lms->id?>" class="btn btn-sm btn-success fa fa-edit"></a>
                                    <button onclick="deleteLms('<?=$lms->id?>','<?=$lms->name?>')" class="btn btn-sm btn-danger fa fa-trash" data-toggle="modal" data-target="#delete-school"></button>
                                </td>
                            </tr>
                        <?php endforeach;
                    endif;
                    ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5"><?php if (isset($page_links)) echo $page_links  ?></td>
                    </tr>



                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>
<div class="modal fade"  id="delete-school" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Canvas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body delete-canvas">
                <h3 id="lms_name__"></h3>
                <form method="post" id="form-delete-lms" action="<?php echo base_url()?>" class="form form-row">
                    <h3 class="text-danger">Please Note That  This Action is irreversible</h3>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" >Cancel</button>
                <button type="submit" id="btn-edit-token" class="btn btn-danger"><i  class="fa fa-trash"></i>Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function deleteLms(id,lms_name){
        var elem=document.getElementById("form-delete-lms");
        elem.setAttribute("action","/admin/lms/delete/"+id);
        var elem2=document.getElementById("lms_name__");
        elem2.innerHTML="Delete " +lms_name+" Lms";


    }
</script>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">School List</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-home"></i></a></li>

                            <li class="breadcrumb-item active" aria-current="page">School List</li>
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
                <h5 class="card-header">Schools</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Website</th>
                            <th scope="col">Canvas URL</th>
                            <th scope="col">Email Domain</th>
                            <th scope="col">Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($result) ) :
                            foreach ($result as $school) :
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $school->name ?></th>
                                    <td><?php echo $school->website ?></td>
                                    <td><?php echo $school->canvas_url ?></td>
                                    <td><?php echo $school->emailDomain ?></td>
                                    <td><?php echo $school->country ?></td>
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
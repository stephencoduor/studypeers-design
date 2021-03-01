
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
                <h5 class="card-header">
                    <a href="/admin/addSchool" class="btn btn-sm btn-success fa fa-plus" >Add School</a>
                </h5>

                <table class="table table-striped" id="schools" data-toggle="table"
                       data-pagination="true"
                       data-search="true"
                       data-side-pagination="server"
                       data-page-list="[10, 25, 50, 100, 200, All]"
                       data-url="/admin/school/filtered"
                       data-total-field="count"
                       data-data-field="items"
                       data-show-footer="true"
                >
                    <thead>
                        <tr>
                            <th scope="col" data-sortable="true" data-field="name">Name</th>
                            <th scope="col" data-sortable="true" data-field="canvas_url" >Canvas URL</th>
                            <th scope="col" data-sortable="true" data-field="emailDomain">Email Domain</th>
                            <th scope="col" data-sortable="true" data-field="country">Country</th>
                            <th scope="col" data-field="actions" >Actions</th>
                        </tr>
                    </thead>
<!--                    <tbody>-->
                     <!--   <?php
/*                        if (isset($result) ) :
                            foreach ($result as $school) :
                        */?>
                                <tr>
                                    <td><?php /*echo $school->name */?></td>
                                    <td><?php /*echo $school->canvas_url */?></td>
                                    <td><?php /*echo $school->emailDomain */?></td>
                                    <td><?php /*echo $school->country */?></td>
                                    <td>
                                        <a href="/admin/school/update/<?/*=$school->university_id*/?>" class="btn btn-sm btn-success fa fa-edit"></a>
                                        <button onclick="deleteSchool('<?/*=$school->university_id*/?>','<?/*=$school->name*/?>')" class="btn btn-sm btn-danger fa fa-trash" data-toggle="modal" data-target="#delete-school"></button>
                                    </td>
                                </tr>
                        --><?php /*endforeach;
                        endif;
                        */?>

<!--                    </tbody>-->
<!--                    <tfoot>-->
<!--                        <tr>-->
<!--                            <td colspan="5">--><?php //if (isset($page_links)) echo $page_links  ?><!--</td>-->
<!--                        </tr>-->
<!--                    </tfoot>-->
                </table>
            </div>
        </div>

    </div>
</div>
<div class="modal fade"  id="delete-school" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete School</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body delete-canvas">
                <h3 id="school_name__"></h3>
                <form method="post" id="form-delete-school" action="<?php echo base_url()?>account/token/update" class="form form-row">
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
function deleteSchool(id,school_name){
var elem=document.getElementById("form-delete-school");
elem.setAttribute("action","/admin/school/delete/"+id);
var elem2=document.getElementById("school_name__");
elem2.innerHTML="Delete School "+school_name;


}
</script>
<!--<style src="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"></style>-->
<!---->
<!--<script src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>-->
<!--<script>-->
<!--    $(document).ready( function () {-->
<!--        $('#schools').DataTable({-->
<!--                "processing": true,-->
<!--                "serverSide": true,-->
<!--                "paginate": true,-->
<!--                "ajax": "/admin/school/filtered",-->
<!--                // "columns": [-->
<!--                //     { "data": "name" },-->
<!--                //     { "data": "canvas_url" },-->
<!--                //     { "data": "emailDomain" },-->
<!--                //     { "data": "country" }-->
<!--                //     ]-->
<!---->
<!--        }-->
<!--        );-->
<!--    } );-->
<!--</script>-->
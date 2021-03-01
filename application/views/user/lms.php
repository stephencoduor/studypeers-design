<section class="mainContent profile msgActive" xmlns="http://www.w3.org/1999/html">
    <div class="studySetWrapper">

        <div class="left">
            <figure>
                <img src="<?php echo base_url() ?>assets_a/images/detail.jpg" alt="Detail Image">
            </figure>
        </div>
        <div class="right" style="margin-left: 20px;">
            <div class="header">
                <h4><?= $user_detail["username"]; ?></h4>
            </div>
            <div class="badgeList">
                <ul>
                    <li class="badge badge1">
                        <?= $user_detail["first_name"]; ?>
                    </li>
                    <li class="badge badge2">
                        <?= $user_detail["last_name"]; ?>
                    </li>
                    <li class="badge badge3">
                        <?= $user_detail["email"]; ?>
                    </li>
                </ul>
            </div>
            <div class="userWrap">
                <div class="user-name">
                    <figure>
                        <img src="<?php echo base_url() ?>assets_a/images/user.jpg" alt="user">
                    </figure>
                    <figcaption><?= $user_detail["first_name"]; ?>  <?= $user_detail["last_name"]; ?> </figcaption>
                </div>

            </div>

        </div>
    </div>


    <div class="tabularLiist">

        <ul class="nav nav-tabs">
            <li class="active" ><a data-toggle="tab" href="#lms"> Your Registered  Schools for <?=$lms_["name"]?> Lms </a></li>

        </ul>

        <div class="tab-content">
            <div id="lms" class="tab-pane fade in active">
                <div class="testWrapper">
                    <div class="header">
                        <a class=" btn btn-success btn-sm  pull-right" href="#add-canvas" style="margin: 10px 10px" data-toggle="modal">Add School</a>
                    </div>
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>School Name</th>
                            <th>Token</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $count__ = 1;
                        foreach ($canvases as $canvas) { ?>
                            <tr>
                                <td><?= $count__ ?></td>
                                <td>
                                    <?= $canvas["university_name"] ?>
                                </td>
                                <td><?= $canvas["token"] ?></td>

                                <td data-th="Date">


                                    <button type="button"
                                            onclick="set_token_id('<?= $canvas['id'] ?>','<?= $canvas["university_name"] ?>')"
                                            class="btn btn-success fa fa-pencil" data-toggle="modal"
                                            data-target="#edit-canvas">
                                    </button>
                                    <button onclick="deleteLms('<?= $canvas['id'] ?>','<?= $canvas["university_name"] ?>')" type="button" class="btn btn-danger fa fa-trash" data-toggle="modal"
                                            data-target="#delete-canvas">
                                    </button>


                                </td>
                            </tr>
                            <?php
                            $count__++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</section>


<div class="modal fade" id="add-canvas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Canvas</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body canvas">

                <form method="post" id="form-add-token" action="<?php echo base_url() ?>account/token/add"
                      class="form form-row">
                    <input id="user__id" type="hidden" name="user_id"
                           value="<?= $this->session->get_userdata()['user_data']['user_id'] ?>">
                    <select required="required" name="university_id" id="school" class="form-control select2__">
                        <?php
                        foreach ($schools as $school) {
                            ?>
                            <option value="<?= $school["university_id"]; ?>"><?= $school["name"]; ?></option>

                            <?php
                        }
                        ?>

                    </select>
                    <input id="lms__name" type="hidden" name="lms_name" value="canvas-lms">
                    <input id="canvas_url" type="hidden" name="canvas_url" value="https://canvas-lms.ga">
                    <label for="add-canvas-id">Canvas Token</label>
                    <input minlength="10" required="required" id="add-canvas-id" type="text" class="form-control"
                           name="token" placeholder="Enter Token">

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="submit" id="btn-add-token" class="btn btn-primary">
                    <i id="sync-bt" class="fa fa-refresh"></i> Connect
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-canvas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Lms token</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body edit-canvas">
                <h3 id="school__name"></h3>
                <form method="post" id="form-edit-token" action="<?php echo base_url() ?>account/token/update"
                      class="form form-row">

                    <label for="edit-canvas-id">Canvas Token</label>
                    <input minlength="10" required="required" id="edit-canvas-id" type="text" class="form-control"
                           name="token" placeholder="Enter Token">

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="submit" id="btn-edit-token" class="btn btn-primary"><i id="sync-bt1" class="fa fa-refresh"></i>Update
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-canvas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Lms token</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="form-delete-token" action="<?php echo base_url() ?>account/token/update"
                  class="form form-row">
                <div class="modal-body delete-canvas">
                    <h3 id="school_name__"></h3>

                    <h3 class="bg text-danger">Please Note That This Action is irreversible</h3>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn-edit-token" class="btn btn-danger"><i class="fa fa-trash"></i>Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function set_token_id(token_id, school_name) {
        var elem = document.getElementById("form-edit-token");
        elem.setAttribute("action", "/account/token/update/" + token_id);
        var elem2 = document.getElementById("school__name");
        elem2.innerHTML = school_name;
    }

    function deleteLms(id, school_name) {
        var elem = document.getElementById("form-delete-token");
        elem.setAttribute("action", "/account/token/delete/" + id);
        var elem2 = document.getElementById("school_name__");
        elem2.innerHTML = "Delete Token for " + school_name;


    }
    $(document).ready(function(){
        console.log($(this).find('select'))
    })
</script>

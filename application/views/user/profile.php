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
            <li class="active" ><a data-toggle="tab" href="#lms1">Learning ManagementSystems</a></li>
            <li ><a data-toggle="tab" href="#settings">Profile Settings</a></li>
        </ul>

        <div class="tab-content">
            <div id="settings" class="tab-pane fade in">
                <div class="content-box" style="margin-top: 40px">
                    <div class="row">
                        <div class="col-md-12" style="padding-right: 0px">
                            <div class="col-md-4">
                                <labe class="imageBoxUpload event">
												<span class="imageBoxUpload--icon">
													<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
														<path d="M490.684082,0H21.315918C9.5085716,0,0,9.5085716,0,21.315918V490.684082C0,502.4914246,9.5085716,512,21.315918,512
															H490.684082C502.4914246,512,512,502.4914246,512,490.684082V21.315918C512,9.5085716,502.4914246,0,490.684082,0z
															 M50.6775513,469.3681641l108.9828644-165.3028564l92.0554962,165.3028564H50.6775513z M469.3681641,469.3681641H299.7812195
															c-0.2089844-0.6269226-19.5396118-35.631012-42.6318359-77.217926L384,204.5910339l85.2636719,72.8293762v191.9477539H469.3681641z
															 M469.3681641,221.204895l-75.6506042-64.6791992c-4.5975342-4.4930573-20.1665039-10.7624512-31.5559082,4.2840881
															l-128.1045074,189.440033c-27.8987732-50.3641052-54.2301941-97.6979675-54.2301941-97.6979675
															c-4.2840881-8.3591766-22.7787781-19.3306122-36.4669342-1.3583679L42.6318359,403.95755V42.6318359h426.6318054V221.204895
															H469.3681641z"></path>
														<path d="M238.1322327,205.6359253c35.1085815,0,63.6342773-28.5257263,63.6342773-63.6342926
															s-28.5256958-63.6342926-63.6342773-63.6342926s-63.6342773,28.5257111-63.6342773,63.6342926
															c0.1045074,35.1085663,28.6302032,63.6342773,63.6342773,63.6342773V205.6359253z M238.1322327,120.9991837
															c11.5983734,0,20.8979797,9.4040909,20.8979797,20.8979568c0,11.5983734-9.4040985,20.8979645-20.8979797,20.8979645
															c-11.5983734,0-20.8979492-9.4040833-20.8979492-20.8979645
															C217.2342834,130.4032745,226.6383667,120.9991837,238.1322327,120.9991837z"></path>
													</svg>
													Add Image
												</span>
                                    <input type="file" name="featured_image" id="featured_image-id">
                                </labe>
                            </div>
                            <div class="col-md-8" style="padding-right: 0px">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="f_name">First Name</label>
                                        <input class="form-control" id="f_name" type="text" name="first_name"
                                               value="<?= $user_detail['first_name'] ?>" placeholder="first name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input class="form-control" id="lname" type="text" name="last_name"
                                               value="<?= $user_detail['last_name'] ?>" placeholder="Enter Last Name">

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" type="email" name="email"
                                               value="<?= $user_detail['email'] ?>" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-2 col-md-offset-10" >
                                    <button type="submit" class="form-control btn btn-success" >Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <div id="lms" class="tab-pane fade in">
                <div class="testWrapper">
                    <div class="header">
                        <a class=" btn btn-success btn-sm  pull-right" href="#add-canvas" style="margin: 10px 10px" data-toggle="modal">Add Canvas</a>
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
            <div id="lms1" class="tab-pane fade in active">
                <div class="toolBox">
                    <ul>
                        <?php if(count($lmses)){
                            foreach ($lmses as $lms){
                                ?>
                                <li>
                                     <a  href="/account/profile/settings/lms/<?=$lms["id"]?>">
                                        <div class="flash flashcards_detail">
                                            <img src="/<?=$lms["lms_logo"]?>" alt="" style="max-height: 50px;max-width: 100px;">
                                        </div>
                                        <span><?=$lms["name"]?></span>
                                        <small></small>
                                    </a>
                                </li>
                                    <?php
                            } ?>

                        <?php
                        }
                        ?>


                        <li>
                            <a href="study-set-detail_match.html">
                                <div class="match flashcards_detail">
                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="m463,195l-71.7-96.1c-36.3-48.6-91.7-76.5-152.2-76.5-33.1,0-65,8.5-93.5,24.8-18.2-21.4-45.1-34.9-73.4-35.9-6-0.2-31.1,1.2-36.7,0.1-11.1-2.2-21.8,5-24,16-2.2,11.1 5,21.8 16,24 10.7,2.1 39.1,0.5 43.2,0.6 15.6,0.6 30.8,7.8 41.6,19.2-72.7,65.3-84.8,177.3-25.2,257.1l71.7,96.1c36.2,48.7 91.7,76.6 152.2,76.6 41.4,0 80.8-13.3 114.2-38.5 83.7-63.2 100.7-183.2 37.8-267.5zm-104.4-71.7l7.6,10.2-103.2,77.9-96.4-129.2c22.1-12.5 46.8-19 72.5-19 47.5,0 91,21.9 119.5,60.1zm-224.5-16.4l96.4,129.2-103.2,77.9-7.5-10c-45.3-60.7-37.9-145 14.3-197.1zm266.3,323.2c-26,19.7-56.9,30.1-89.4,30.1-47.5,0-91-21.9-119.5-60.1l-39.8-53.4 238.9-180.5 39.7,53.2c49.4,66.3 36.1,160.8-29.9,210.7z"></path>
                                    </svg>
                                </div>
                                <span>Match</span>
                                <small>some description </small>
                            </a>
                        </li>
                        <li>
                            <a href="study-set-detail_write.html">
                                <div class="write flashcards_detail">
                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="m495,211.9l-194.9-194.9c-8-8-20.9-8-28.9,0l-115.4,115.4c-10.8,11.3-4.4,25.3 0,28.9l19.3,19.3-147.7,118c-6.1,4.9-8.9,12.9-7.1,20.5 0.1,0.5 12.2,55.4-8.8,156.5-1.5,7.1 0.9,14.2 6,19 3.8,4 10.8,7.6 18.9,5.9 100.1-20.6 156.1-8.9 156.5-8.8 7.6,1.7 15.6-1 20.5-7.2l118.1-147.7 19.3,19.3c11.3,10.7 24.8,4.7 28.9,0l115.3-115.4c3.8-3.8 11.2-16.2 0-28.8zm-306.1,237.9c-17.2-2.2-51-4.5-99.5,0.9l74.4-74.4c8-8 8-20.9 0-28.9-8-8-20.9-8-28.9,0l-73.5,73.5c5.2-47.7 2.9-80.8 0.7-97.8l142-113.5 98.2,98.2-113.4,142zm176.2-136.9l-166-166 86.6-86.6 166,166-86.6,86.6z"></path>
                                    </svg>
                                </div>
                                <span>Write</span>
                                <small>some description </small>
                            </a>
                        </li>
                        <li>
                            <a href="study-set-detail_test.html">
                                <div class="test flashcards_detail">
                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                                        <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
													M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
													S365.867,459.733,250.667,459.733z"></path>
                                        <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
													c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
                                    </svg>
                                </div>
                                <span>Test</span>
                                <small>some description </small>
                            </a>
                        </li>
                    </ul>
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
                    <select name="university_id" id="school" class="form-control select2__">
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

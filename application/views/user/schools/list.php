<section class="mainContent">
    <div class="alert alert-default">
        <?php
        if ($this->session->flashdata('flash_message')) {
            echo $this->session->flashdata('flash_message');
        }
        ?>
    </div>
    <div id="testResult" class="tab-pane fade active in">
        <div class="testWrapper">
            <h3 class="mb-2">Enrolled Schools</h3>
            <table class="table table-borderless sp-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>County</th>
<!--                    <th>Sync</th>-->
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($universities)) ?>
                <?php foreach ($universities as $university) { ?>
                    <tr>
                        <td data-th="Rank"><span class="bt-content"><?=$university['university_id'] ?></span></td>
                        <td data-th="User"><span class="bt-content"> <?=$university['name'] ?></span></td>
                        <td data-th="Score"><span class="bt-content"><?=$university['country'] ?></span></td>
<!--                        <td data-th="Time Spent"><span class="bt-content">-->
<!--                                <a href="/courses/sync" id="sync" ><i id="sync-icon" class="fa fa-refresh"></i> <span id="c-name">Sync Courses</span></a>-->
<!--                            </span></td>-->

                        <td data-th="Date"><span class=" bt-content ">
                            <a href="<?php echo base_url()?>account/schools/<?= $university['university_id']; ?>">
                                <i class="fa fa-eye"></i>
                                View
                            </a>
                                </span>
                        </td>
                    </tr>
                <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
    <section class="rightsidemsgbar">
        <section class="view message">
            Close <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </section>
        <section class="listBar">
            <section class="listHeader">
                <h6>Peers</h6>
                <a data-toggle="modal" data-target="#peersMessageModal">See More</a>
            </section>
            <section class="listChatBox">
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                        </figure>
                        <figcaption>Scholasticus Ipsum</figcaption>
                    </section>
                    <section class="action">
                        <i class="fa fa-ellipsis-v"></i>
                    </section>
                </section>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="messagecount">12</span>
                        </figure>
                        <figcaption>Scholasticus Ipsum</figcaption>
                    </section>
                    <section class="action">
                        <i class="fa fa-ellipsis-v"></i>
                    </section>
                </section>
            </section>
        </section>
        <section class="listBar">
            <section class="listHeader">
                <h6>Groups</h6>
                <a><i class="fa fa-plus"></i></a>
            </section>
            <section class="listChatBox">
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                        </figure>
                        <figcaption>The in group</figcaption>
                    </section>
                    <section class="action">
                        <i class="fa fa-ellipsis-v"></i>
                    </section>
                </section>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="messagecount">12</span>
                        </figure>
                        <figcaption>The in group</figcaption>
                    </section>
                    <section class="action">
                        <i class="fa fa-ellipsis-v"></i>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <script>
        $(function(){
            // alert('clicked')
            $('#sync').click(function(e){
                console.log([e,this]);
                e.preventDefault();
                $(this).attr('disabled',true);
                let href = new URL(this.href);
                $(this).find('#sync-icon').addClass('fa-spin')
                $(this).find('#c-name').html('syncing')

                $.ajax({
                    url: href.pathname,
                    dataType: 'json',
                    type: 'GET',
                    success: function(data){

                    }
                })


                // $.ajax({
                //     url:href.pathname
                // }).done((data) => {
                //
                //     // console.log(data);
                //     $(e).removeAttr('disabled');
                //     $('#syncpreloader').remove();
                //     window.location.reload();
                // });
            });
        });
    </script>
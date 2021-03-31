<div class="modal-body">
                <div class="createHeader">
                    <h4><img src="<?php echo base_url(); ?>assets_d/images/return.svg" id="returnPrivacy"  data-dismiss="modal" data-toggle="modal" href="#createPost"> Post Privacy</h4>
                    <div class="closePost" data-dismiss="modal">
                        <img src="<?php echo base_url(); ?>assets_d/images/close-grey.svg" alt="close">
                    </div>
                </div>
                <input type="hidden" id="editPostPrivacyId" value="<?= $post_details['id']; ?>">
                <div class="privacyContent privacyContentEdit">
                    <ul>
                        <li class="<?php if($post_details['privacy_id'] == 1) { echo 'active'; } ?>" id="privacy_li_public">
                            <a>
                                <label class="dashRadioWrap">
                                    <div class="privacyTxtWrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.997" height="20" viewBox="0 0 19.997 20">
                                            <g id="public" transform="translate(-0.004)">
                                                <g id="Group_3031" data-name="Group 3031" transform="translate(0.004)">
                                                    <path id="Path_6635" data-name="Path 6635" d="M23.439,5.587l-.3.095-1.593.142-.45.719-.327-.1L19.5,5.3,19.318,4.7l-.246-.634-.8-.715-.94-.184-.022.43.921.9.451.531-.507.265-.413-.122-.618-.258.021-.5-.811-.334-.269,1.172-.817.185.081.654,1.065.2L16.6,5.253l.879.13.409.239h.656l.449.9,1.19,1.207L20.1,8.2l-.959-.122-1.658.837-1.194,1.432-.155.634H15.7l-.8-.368-.775.368.193.818.337-.389.593-.018-.041.735.491.144.491.551.8-.225.915.145,1.063.286.531.062.9,1.022,1.737,1.022-1.124,2.147-1.186.551-.45,1.227L17.664,20.2l-.183.661A9.987,9.987,0,0,0,23.439,5.587Z" transform="translate(-5.136 -1.151)"/>
                                                    <path id="Path_6636" data-name="Path 6636" d="M11.152,17.963l-.728-1.35.668-1.393-.668-.2-.751-.754L8.01,13.893l-.552-1.155v.686H7.215L5.782,11.481v-1.6L4.732,8.177l-1.668.3H1.94L1.375,8.1,2.1,7.532,1.377,7.7A9.986,9.986,0,0,0,10,22.737a10.469,10.469,0,0,0,1.255-.087l-.1-1.211s.459-1.8.459-1.86S11.152,17.963,11.152,17.963Z" transform="translate(-0.004 -2.737)"/>
                                                    <path id="Path_6637" data-name="Path 6637" d="M5.025,3.224,6.8,2.977l.819-.449.921.265,1.472-.081.5-.793.735.121,1.786-.167.492-.542.694-.463.982.148.358-.054A9.967,9.967,0,0,0,3.6,3.636H3.6Zm6.7-2.23L12.751.432l.656.379-.949.723-.907.091-.408-.265ZM8.7,1.077l.451.188.59-.188.321.557L8.7,1.991,8.05,1.608S8.69,1.2,8.7,1.077Z" transform="translate(-1.309)"/>
                                                </g>
                                            </g>
                                        </svg> <h4>Public</h4>
                                    </div>
                                    <input type="radio" class="privacy_val_edit" id="privacy_val_public" <?php if($post_details['privacy_id'] == 1) { ?> checked="checked" <?php } ?> value="1" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                            </a>
                        </li>
                        <li class="<?php if($post_details['privacy_id'] == 2) { echo 'active'; } ?>">
                            <a>
                                <label class="dashRadioWrap">
                                    <div class="privacyTxtWrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20.87" height="20" viewBox="0 0 20.87 20">
                                            <g id="anonymous" transform="translate(0 -10.667)">
                                                <g id="Group_3101" data-name="Group 3101" transform="translate(0 23.453)">
                                                    <g id="Group_3100" data-name="Group 3100" transform="translate(0 0)">
                                                        <path id="Path_6667" data-name="Path 6667" d="M17.074,325.142l-2.237-.778a.437.437,0,0,0-.463.117,5.36,5.36,0,0,1-3.939,1.857A5.363,5.363,0,0,1,6.5,324.481a.435.435,0,0,0-.463-.117l-2.237.778A5.655,5.655,0,0,0,0,330.481v.638a.435.435,0,0,0,.435.435h20a.435.435,0,0,0,.435-.435v-.638A5.657,5.657,0,0,0,17.074,325.142Z" transform="translate(0 -324.34)"/>
                                                    </g>
                                                </g>
                                                <g id="Group_3103" data-name="Group 3103" transform="translate(4.348 10.667)">
                                                    <g id="Group_3102" data-name="Group 3102" transform="translate(0 0)">
                                                        <path id="Path_6668" data-name="Path 6668" d="M117.967,16.023c0-.046,0-.092,0-.138a5.217,5.217,0,1,0-10.435,0c0,.037,0,.076,0,.113a2.321,2.321,0,0,0-.872,2.061c0,1.21.534,2.129,1.25,2.172.79,2.619,2.694,4.35,4.837,4.35s4.046-1.73,4.837-4.35c.717-.043,1.25-.963,1.25-2.172A2.271,2.271,0,0,0,117.967,16.023Zm-.457,3.321a.434.434,0,0,0-.65.264c-.609,2.454-2.258,4.1-4.105,4.1s-3.5-1.649-4.105-4.1a.44.44,0,0,0-.271-.288.4.4,0,0,0-.153-.029.486.486,0,0,0-.253.071c-.109,0-.435-.463-.435-1.3a1.636,1.636,0,0,1,.416-1.3l.013,0a.447.447,0,0,0,.351-.125.436.436,0,0,0,.124-.352l-.012-.109a2.621,2.621,0,0,1-.023-.289,4.348,4.348,0,0,1,8.7,0,2.587,2.587,0,0,1-.023.288l-.012.109a.433.433,0,0,0,.124.352.444.444,0,0,0,.351.126l.013,0a1.636,1.636,0,0,1,.416,1.3C117.971,18.9,117.652,19.363,117.51,19.344Z" transform="translate(-106.667 -10.667)"/>
                                                    </g>
                                                </g>
                                                <g id="Group_3105" data-name="Group 3105" transform="translate(8.696 14.145)">
                                                    <g id="Group_3104" data-name="Group 3104">
                                                        <path id="Path_6669" data-name="Path 6669" d="M215.072,96a1.664,1.664,0,0,0-1.739,1.739.435.435,0,0,0,.87,0,.87.87,0,1,1,1.739,0,1.323,1.323,0,0,1-.662,1.368,1.878,1.878,0,0,0-1.072,1.742.426.426,0,0,0,.426.361c.017,0,.036,0,.054,0a.441.441,0,0,0,.381-.476c0-.018-.029-.457.665-.881a2.168,2.168,0,0,0,1.077-2.11A1.663,1.663,0,0,0,215.072,96Z" transform="translate(-213.333 -96)"/>
                                                    </g>
                                                </g>
                                                <g id="Group_3107" data-name="Group 3107" transform="translate(9.565 20.232)">
                                                    <g id="Group_3106" data-name="Group 3106">
                                                        <circle id="Ellipse_217" data-name="Ellipse 217" cx="0.435" cy="0.435" r="0.435"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg> <h4>Anonymous</h4>
                                    </div>
                                    <input type="radio" class="privacy_val_edit"  name="radio" value="2" <?php if($post_details['privacy_id'] == 2) { ?> checked="checked" <?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </a>
                        </li>
                        <li class="<?php if($post_details['privacy_id'] == 3) { echo 'active'; } ?>">
                            <a>
                                <label class="dashRadioWrap">
                                    <div class="privacyTxtWrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 15 20">
                                            <path id="private" d="M16.125,7.5H15.5V5a5,5,0,0,0-10,0V7.5H4.875A1.877,1.877,0,0,0,3,9.375v8.75A1.877,1.877,0,0,0,4.875,20h11.25A1.877,1.877,0,0,0,18,18.125V9.375A1.877,1.877,0,0,0,16.125,7.5ZM7.167,5a3.333,3.333,0,1,1,6.667,0V7.5H7.167Zm4.167,8.935v1.9a.833.833,0,0,1-1.667,0v-1.9a1.667,1.667,0,1,1,1.667,0Z" transform="translate(-3)" />
                                        </svg> <h4>Private</h4>
                                    </div>
                                    <input type="radio" class="privacy_val_edit"  name="radio" value="3" <?php if($post_details['privacy_id'] == 3) { ?> checked="checked" <?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </a>
                        </li>
                        <li class="<?php if($post_details['privacy_id'] == 4) { echo 'active'; } ?>">
                            <a>
                                <label class="dashRadioWrap">
                                    <div class="privacyTxtWrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17.49" viewBox="0 0 20 17.49">
                                            <g id="peers-only" transform="translate(0)">
                                                <path id="Path_6641" data-name="Path 6641" d="M242.172.586a.586.586,0,0,0-1.172,0V3.1a.586.586,0,0,0,1.172,0Zm0,0" transform="translate(-231.586)" />
                                                <path id="Path_6642" data-name="Path 6642" d="M146.025,50.454a.586.586,0,0,0,.829-.829L145.6,48.371a.586.586,0,0,0-.829.829Zm0,0" transform="translate(-138.95 -46.316)" />
                                                <path id="Path_6643" data-name="Path 6643" d="M305.852,50.626a.584.584,0,0,0,.414-.172l1.255-1.255a.586.586,0,0,0-.829-.829l-1.255,1.255a.586.586,0,0,0,.414,1Zm0,0" transform="translate(-293.342 -46.316)" />
                                                <path id="Path_6644" data-name="Path 6644" d="M8.3,141.194l-.017.014L5.754,143.38a1.3,1.3,0,0,1-.844.312H3.1a3.094,3.094,0,0,0-3.1,3.1v5.649a.586.586,0,0,0,.586.586H5.606a.586.586,0,0,0,.586-.586v-5.379L9.174,144.5a.687.687,0,0,0,.24-.522v-2.25a.684.684,0,0,0-1.109-.537Zm0,0" transform="translate(0 -135.533)" />
                                                <path id="Path_6645" data-name="Path 6645" d="M277.318,143.692H275.5a1.3,1.3,0,0,1-.844-.312l-2.533-2.171-.017-.014a.684.684,0,0,0-1.109.537v2.25a.687.687,0,0,0,.24.522l2.982,2.556v5.379a.586.586,0,0,0,.586.586h5.021a.586.586,0,0,0,.586-.586v-5.649a3.094,3.094,0,0,0-3.1-3.1Zm0,0" transform="translate(-260.415 -135.533)" />
                                                <path id="Path_6646" data-name="Path 6646" d="M21,84.934A2.469,2.469,0,1,0,18.535,87.4,2.472,2.472,0,0,0,21,84.934Zm0,0" transform="translate(-15.439 -79.244)" />
                                                <path id="Path_6647" data-name="Path 6647" d="M374.473,84.934A2.469,2.469,0,1,0,372,87.4,2.472,2.472,0,0,0,374.473,84.934Zm0,0" transform="translate(-355.101 -79.244)" />
                                            </g>
                                        </svg> <h4>Peers only</h4>
                                    </div>
                                    <input type="radio" class="privacy_val_edit"  name="radio" value="4" <?php if($post_details['privacy_id'] == 4) { ?> checked="checked" <?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </a>
                        </li>
                        <li class="<?php if($post_details['privacy_id'] == 5) { echo 'active'; } ?>">
                            <a id="shareWithPeerEdit" data-toggle="modal" data-target="#postGroupModalEdit" data-id="<?= $post_details['id']; ?>">
                                <label class="dashRadioWrap">
                                    <div class="privacyTxtWrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17.49" viewBox="0 0 20 17.49">
                                            <g id="peers-only" transform="translate(0)">
                                                <path id="Path_6641" data-name="Path 6641" d="M242.172.586a.586.586,0,0,0-1.172,0V3.1a.586.586,0,0,0,1.172,0Zm0,0" transform="translate(-231.586)" />
                                                <path id="Path_6642" data-name="Path 6642" d="M146.025,50.454a.586.586,0,0,0,.829-.829L145.6,48.371a.586.586,0,0,0-.829.829Zm0,0" transform="translate(-138.95 -46.316)" />
                                                <path id="Path_6643" data-name="Path 6643" d="M305.852,50.626a.584.584,0,0,0,.414-.172l1.255-1.255a.586.586,0,0,0-.829-.829l-1.255,1.255a.586.586,0,0,0,.414,1Zm0,0" transform="translate(-293.342 -46.316)" />
                                                <path id="Path_6644" data-name="Path 6644" d="M8.3,141.194l-.017.014L5.754,143.38a1.3,1.3,0,0,1-.844.312H3.1a3.094,3.094,0,0,0-3.1,3.1v5.649a.586.586,0,0,0,.586.586H5.606a.586.586,0,0,0,.586-.586v-5.379L9.174,144.5a.687.687,0,0,0,.24-.522v-2.25a.684.684,0,0,0-1.109-.537Zm0,0" transform="translate(0 -135.533)" />
                                                <path id="Path_6645" data-name="Path 6645" d="M277.318,143.692H275.5a1.3,1.3,0,0,1-.844-.312l-2.533-2.171-.017-.014a.684.684,0,0,0-1.109.537v2.25a.687.687,0,0,0,.24.522l2.982,2.556v5.379a.586.586,0,0,0,.586.586h5.021a.586.586,0,0,0,.586-.586v-5.649a3.094,3.094,0,0,0-3.1-3.1Zm0,0" transform="translate(-260.415 -135.533)" />
                                                <path id="Path_6646" data-name="Path 6646" d="M21,84.934A2.469,2.469,0,1,0,18.535,87.4,2.472,2.472,0,0,0,21,84.934Zm0,0" transform="translate(-15.439 -79.244)" />
                                                <path id="Path_6647" data-name="Path 6647" d="M374.473,84.934A2.469,2.469,0,1,0,372,87.4,2.472,2.472,0,0,0,374.473,84.934Zm0,0" transform="translate(-355.101 -79.244)" />
                                            </g>
                                        </svg> <h4>Share With Peers</h4>
                                    </div>
                                    <input type="radio" class="privacy_val_edit" name="radio" value="5" <?php if($post_details['privacy_id'] == 5) { ?> checked="checked" <?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="allowComment">
                    <h4>Allow comments on this post</h4>
                    <div class="right">
                        <label class="switch">
                            <input type="checkbox" id="allow_comment_edit" <?php if($post_details['is_comment_on'] == 1) { ?> checked <?php } ?> value="1" name="allow_comment_edit">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="settingWrapper">
                    <button type="button" class="event_action" onclick="updatePrivacyOfPost()"> Update</button>
                </div>
            </div>


            <script type="text/javascript">
                $('.privacyContentEdit li').on('click', function() { 
                        // debugger;
                        $('.privacyContentEdit li').removeClass('active');
                        if ($(this).children('a').find('input[type="radio"]').attr('checked', true)) {
                            $(this).addClass('active');
                        }
                    })

                
            </script>
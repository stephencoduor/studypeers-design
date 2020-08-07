<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        
    <link rel="shortcut icon" href="<?=base_url('assets/images/home/favicon.jpg')?>" type="image/x-icon">
    <link rel="icon" href="<?=base_url('assets/images/home/favicon.jpg')?>" type="image/x-icon">

    <title>Study Peers</title>

    <!-- Bootstrap -->
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
        
    <link href="<?=base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/owl.carousel.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/nice-select.css')?>" rel="stylesheet">

    <!-- Main css -->
    <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/intlTelInput.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css"> -->

<style type="text/css">

    .header-area {
    background-image: linear-gradient(to right, #ffffff , #fff,#ffffff);
}
/*@media (max-width: 991px)*/
.navbar-collapse {

    background: #ffffff;
}
#password_details {
    display: none;
    left: calc(100% + 20px);
    border-radius: 5px;
    top: 50px;
    min-width: 250px;
    background-color: #fff;
    padding: 10px;
    font-size: 12px;
}
#password_details > h1 {
    margin: 0;
    padding: 5px;
    font-size: 14px;
    color: #555;
}
#password_details > ul > li {
    padding: 5px 0;
}

.invalid {
    color: #fc2e2e;
}
#password_details > ul > li {
    padding: 5px 0;
}

.valid {
    color: #12d600;
}

.header-area .main-menu ul li a {
    color: grey;
    font-weight: 700;
    font-family: "Sen", sans-serif;
}
.btn-emt{
    background-color: #ea2e7e
}.btn-emt1{
    
    border:1px solid blue;
}
.header-area.sticky-header {
    background: #ffffff;
    padding: 10px 0;
}
.hero-section::before {
    background: #ffffff;   
}
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 2px white; 
  border-radius: 1px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #ea2e7e; 
  border-radius: 1px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #ea2e7e; 
}
.navbar-brand img {
    height: 50px;}
    .navbar-toggler {
    padding: .25rem .75rem;
    font-size: 1.25rem;
    line-height: 1;
    background-color: #ea2e7e;
    border: 1px solid #ea2e7e;
    border-radius: .25rem;
}
</style>
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<style type="text/css">* {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

/
#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset .form-card h2{
    padding-bottom: 20px;
}
#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    /*box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);*/
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    /*width: %;*/
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E
}

#msform .action-button {
    width: 100px;
    background: #c8c8c8;
    font-weight: bold;
    color: black;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 5px 5px;
}

/*#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}*/

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}




.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: center;
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}
.card {
    border: 0 none;
    background: #ffffff;
}
input[name="class"]::-webkit-calendar-picker-indicator {
  display: none;
}
input[name="institute"]::-webkit-calendar-picker-indicator {
  display: none;
}
input[name="course"]::-webkit-calendar-picker-indicator {
  display: none;
}
option {
    font-weight: normal;
    display: block;
    white-space: pre;
    min-height: .5em;
    padding: 0px 2px 1px;
}

.ap-field-errors {
    border: solid 1px #ffe4e2;
    display: table;
    font-size: 12px;
    margin-bottom: 5px;
    padding: 1px 5px;
    border-radius: 2px;
    background: #fff0ef;
    color: #F44336;
}

.autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    top: 60%;
    left: 0;
    right: 0;
    max-height: 250px;
    overflow-y: auto;
    margin: 0 15px 0 15px;
}
.autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
}
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 22px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

/*image loader css*/
#loaderShow{display: none;}
p.deleteFile {
    margin: 0px;
    color: #e0aeae;
}
.myProgress {
    width: 100%;
    background-color: #ddd;
}

.myBar {
    width: 1%;
    height: 6px;
    background-color: #61bd65;
    margin-top: 7px;
}
.loader {
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid #3498db;
    width: 50px;
    height: 50px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
}
.file-upload{display:block;text-align:center;font-family: Helvetica, Arial, sans-serif;font-size: 12px;}
    .file-upload .file-select{display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
    .file-upload .file-select .file-select-button{background:#dce4ec;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
    .file-upload .file-select .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}
    .file-upload .file-select:hover{border-color:#34495e;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
    .file-upload .file-select:hover .file-select-button{background:#34495e;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
    .file-upload.active .file-select{border-color:#3fa46a;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
    .file-upload.active .file-select .file-select-button{background:#3fa46a;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
    .file-upload .file-select input[type=file]{z-index:100;cursor:pointer;position:absolute;height:100%;width:100%;top:0;left:0;opacity:0;filter:alpha(opacity=0);}
    .file-upload .file-select.file-select-disabled{opacity:0.65;}
    .file-upload .file-select.file-select-disabled:hover{cursor:default;display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;margin-top:5px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
    .file-upload .file-select.file-select-disabled:hover .file-select-button{background:#dce4ec;color:#666666;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
    .file-upload .file-select.file-select-disabled:hover .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}
    .show_img_data{display: none;}
    .set_div_img00{
            border: 2px solid #dedadad9;
            padding: 5px;
            width: 228px;
            right: 15px;
            top: 0;
    }
    .set_div_img00 img{    
        height: 150px;
        width: 212px;
    }

    .input_w{width: 115px !important;}
    .set_img{
        margin: 0;
        width: 212px;
        text-align: center;
        position: absolute;
        top: 53px;
        background: rgba(0, 0, 0, 0.6);
        font-size: 16px;
        color: #fff !important;
        display: none;
        height: 150px;
        padding-top: 60px;
    }
    .set_div_img00:hover .set_img{display: block;}
    .set_img a{color: red !important;}

    .del_img{
        margin: 0;
        width: 44px;
        text-align: center;
        top: 6px;
        background: transparent;
        font-size: 16px;
        color: red !important;
        right: 6px;
        border: 1px solid #ddd;
        margin-top: 5px;
    }
    .showFile img{height: 150px;}

    .show_img_data .showFile{width:228px;}

    .iti {
        width: 100%!important;
        margin-bottom: 20px!important;
    }

    .help-tip{
        position: absolute;
        top: 0px;
        right: -40px;
        text-align: center;
        background-color: #546de5;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 14px;
        line-height: 26px;
        cursor: default;
    }

    .help-tip:before{
        content:'?';
        font-weight: bold;
        color:#fff;
    }

    .help-tip:hover p{
        display:block;
        transform-origin: 100% 0%;

        -webkit-animation: fadeIn 0.3s ease-in-out;
        animation: fadeIn 0.3s ease-in-out;

    }

    .help-tip p{    /* The tooltip */
        display: none;
        text-align: left;
        background-color: #1E2021;
        padding: 20px;
        width: 300px;
        position: absolute;
        border-radius: 3px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
        right: -4px;
        color: #FFF;
        font-size: 13px;
        line-height: 1.4;
    }

    .help-tip p:before{ /* The pointer of the tooltip */
        position: absolute;
        content: '';
        width:0;
        height: 0;
        border:6px solid transparent;
        border-bottom-color:#1E2021;
        right:10px;
        top:-12px;
    }

    .help-tip p:after{ /* Prevents the tooltip from being hidden */
        width:100%;
        height:40px;
        content:'';
        position: absolute;
        top:-40px;
        left:0;
    }

    /* CSS animation */

    @-webkit-keyframes fadeIn {
        0% { 
            opacity:0; 
            transform: scale(0.6);
        }

        100% {
            opacity:100%;
            transform: scale(1);
        }
    }

    @keyframes fadeIn {
        0% { opacity:0; }
        100% { opacity:100%; }
    }

</style>
<script src="<?php echo base_url(); ?>assets/js/intlTelInput.js"></script>
</head>
<body>
    <header class="header-area">
        <nav class="navbar navbar-expand-lg main-menu">
            <div class="container-fluid">

                <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url('assets/images/home/logo.jpg')?>" class="d-inline-block align-top" alt=""></a>
            </div>
        </nav>
    </header>
<!-- MultiStep Form -->
    <section class="hero-section" style="padding-top: 100px">
<div class="container" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-6 col-sm-9 col-md-6 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" method="post" action="<?php echo base_url(); ?>home/submit_user_registration" enctype="multipart/form-data" autocomplete="off">
                            <fieldset id="step_one" style="display: none;">
                                <div class="form-card">
                                    <h2 class="fs-title">Welcome to Studypeers!<img src="<?=base_url('assets/images/home/wave.png')?>" style="height: 32px;margin-left: 5px;"></h2>

                                    <input class="form-control col-md-6" style="height: 48px;margin-bottom: 20px; float: left; max-width: 49%;" type="text" name="first_name" placeholder="First Name" id="first_name" value="<?= $user_detail['first_name']; ?>">
                                    
                                    <input class="form-control col-md-6" style="height: 48px;margin-bottom: 20px;max-width: 49%; float: right;" type="text" name="last_name" placeholder="Last Name" id="last_name" value="<?= $user_detail['last_name']; ?>">
                                    <!-- <select class="form-control" style="height: 48px;margin-bottom: 20px;width:20%;float: left" name="country_code" id="country_code">
                                        <?php foreach ($countries as $key => $value) { ?>
                                            <option value="<?= $value['phonecode'] ?>">+<?= $value['phonecode'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <input class="form-control m_b_n" style="height: 48px;margin-bottom: 20px;width:80%;" type="text" name="mobile_no" placeholder="Enter mobile No" minlength="10" maxlength="10" size="10" id="mobile_no" value="<?= $user_detail['phone']; ?>"> -->
                                    <input id="phone"  class="form-control m_b_n" name="phone" type="tel" style="height: 48px;margin-bottom: 20px;">
                                    <input class="form-control date" style="height: 48px;margin-bottom: 20px;" type="text" placeholder="Date Of Birth" onfocus="(this.type='date')" onblur="(this.type='text')" title="Date of Birth" name="dob"  id="dob" value="<?= $user_detail['dob']; ?>">
                                    <select class="form-control" name="gender" style="height: 48px;margin-bottom: 20px;" id="gender">
                                        <option value="">Gender</option>
                                        <option value="male" <?php if($user_detail['gender'] == 'male') { echo "selected"; } ?>>Male </option>
                                        <option value="female" <?php if($user_detail['gender'] == 'female') { echo "selected"; } ?>>Female</option>
                                        <option value="other" <?php if($user_detail['gender'] == 'other') { echo "selected"; } ?>>Other</option>
                                    </select>
                                </div>
                                <center><span class="ap-field-errors" id="error_1" style="display: none;"></span></center>
                                 <button type="button" data-id="1" name="next" class="next action-button" value="Continue" />
                                 <i class="fa fa-circle-o-notch fa-spin" id="load" style="display: none;"></i>
                                 Continue<i class="fa fa-hand-o-right" id="hand" aria-hidden="true" style="padding-left: 4px"></i></button>
                            </fieldset>
                            <fieldset id="step_two">
                                <div class="form-card">
                                    <h2 class="fs-title">Where Are You studying ? <i class="fa fa-university" aria-hidden="true" style="color: #546de5; margin-left: 5px;"></i></h2>
                                    <div class="col-xl-12" id="university_div">
                                        <?php  if($user_detail['intitutionID'] != 0) {
                                            $get_university = $this->db->get_where('university', array('university_id' => $user_detail['intitutionID']))->row_array(); 
                                            $university = $get_university['SchoolName'];
                                        } else {
                                            $university = '';
                                        } 
                                        if($user_detail['institute_type'] == 0){
                                            $institute_type = 1;
                                        } else {
                                            $institute_type = $user_detail['institute_type'];
                                        }
                                        ?>
                                        <input list="institutes" name="institute" id="institute" class="form-control mb-1" style="height: 48px;" placeholder="University Name" value="<?= $university; ?>" onkeyup="searchUniversity(this.value)">
                                        <input type="hidden" name="step" value="2">
                                        <input type="hidden" name="institute_id" id="institute_id">
                                        <div id="myInputautocomplete-list" class="autocomplete-items"></div>
                                        <p style="color: blue; cursor: pointer;" onclick="showAddInstitute()">
                                             MY INSTITUTION IS NOT LISTED
                                        </p>
                                        <input type="hidden" name="institute_type" id="institute_type" value="<?= $institute_type; ?>">
                                    </div>

                                    <div id="add_institute_div" class="col-xl-12" style="display: none">
                                        <p>Tell us your university name se we can manually verify it</p>
                                        <input name="add_institute" id="add_institute" class="form-control mb-1" style="height: 48px;" placeholder="University Name" value="<?= $user_detail['add_institute'] ?>">
                                        <span class="ap-field-errors" id="add_institute_err" style="display: none;"></span>
                                        <label style="color: blue; cursor: pointer;" onclick="hideAddInstitute()">
                                             Cancel
                                        </label>
                                        
                                    </div>
                                    
                                    <div id="valid_div" style="display: none">
                                        <div class="col-xl-12 id_email">
                                            <input class="form-control" style="height: 48px;" type="email" name="intitution_email" id="email" placeholder="Enter Institute Email" onblur="verifyEmail(this.value)">
                                            <span class="ap-field-errors" id="err_email" style="display: none;"></span>
                                            <p class="mb-1">
                                             Your institution email address is required to verify that you attend. If you do not have an email address you may <span style="color: blue; cursor: pointer;" id="manual_verification">REQUEST MANUAL VERIFICATION</span>
                                            </p>
                                            <label style="color: blue;padding-left: 20px;display: none;" id="toggle_tst">
                                                <input type="checkbox" name="manual_verification_check" id="manual_verification_check" >  Manually verify my email.
                                            </label>
                                        </div>
                                        <div class="col-xl-12 id_file" style="display: none" >
                                            <input class="form-control" style="height: 48px;" type="file" name="intitution_idcard" id="file_email" title="Upload The Collage ID Card" onchange="uploadVideo(this, 'file_email')">
                                            <div class="col-sm-12 col-xs-12 p-0 mt-1 show_img_data" id="showData_file_email">   
                                                <span id="loaderShow_file_email">
                                                <div class="loader" id="loader_file_email"></div>
                                                <span>Please Wait...</span></span>
                                            </div>
                                        </div>
                                         <label style="color: blue;padding-left: 20px; position: relative;">
                                            <input type="checkbox" name="remember" id="have_email" > I do not have institute email id
                                            <div class="help-tip">
                                                <p>Please upload an id which clearly shows your University Name and Id so that the admin can verify it.</p>
                                            </div>
                                        </label>
                                    </div>
                                    
                                </div>
                                <center><span class="ap-field-errors" id="error_2" style="display: none;"></span></center>
                                <button type="button" data-id="2" id="button_2" name="next" class="next action-button" value="Continue" />
                                <i class="fa fa-circle-o-notch fa-spin" id="load_2" style="display: none;"></i>Continue<i class="fa fa-hand-o-right" id="hand_2" aria-hidden="true" style="padding-left: 4px"></i></button>
                            </fieldset>
                            <fieldset id="step_three">
                                <div class="form-card">
                                    <h2 class="fs-title">What Are You studying ? <i class="fa fa-book" aria-hidden="true" style="color: #546de5; margin-left: 5px;"></i></h2>
                                     
                                    <div class="col-xl-12" id="course_div" style="">
                                        <!-- <input list="courses" name="course" id="course" class="form-control mb-1" style="height: 48px;" placeholder="Field Of Study" onkeyup="searchField(this.value)"> -->
                                        <select class="form-control" id="course" name="field_id" style="height: 48px;margin-bottom: 20px;"  onchange="getMajor(this.value)">
                                            <option value="">Select Field Of Study</option>
                                            <?php foreach ($field_data as $key => $value) { ?>
                                               <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <div id="course-list" class="autocomplete-items"></div>  -->
                                        <!-- <input type="hidden" name="field_id" id="field_id"> -->
                                        <p style="color: blue; cursor: pointer;" onclick="showAddField()">
                                             MY FIELD OF STUDY IS NOT LISTED
                                        </p>
                                        <input type="hidden" name="field_type" id="field_type" value="1">
                                    </div>
                                    <div id="add_course_div" class="col-xl-12" style="display: none">
                                        <p>Tell us your Field Of Study se we can manually verify it</p>
                                        <input name="add_course" id="add_course" class="form-control mb-1" style="height: 48px;" placeholder="Field Of Study">
                                        <span class="ap-field-errors" id="add_course_err" style="display: none;"></span>
                                        <label style="color: blue; cursor: pointer;" onclick="hideAddField()">
                                             Cancel
                                        </label>
                                        
                                    </div>
                                    <div class="col-xl-12" id="class_div" style="display: none">
                                        <!-- <input list="classs" name="class" id="Major" class="form-control mb-1" style="height: 48px;" placeholder="Major" onkeyup="searchMajor(this.value)"> -->
                                        <select class="form-control" id="Major" name="major_id" style="height: 48px;margin-bottom: 20px;" onchange="showNext(this.value, 'degree_div')">
                                            <option value="">Select Major</option>
                                        </select>
                                        <!-- <div id="major-list" class="autocomplete-items"></div>  -->
                                        <!-- <input type="hidden" name="major_id" id="major_id"> -->
                                        <p style="color: blue; cursor: pointer;" onclick="showAddMajor()">
                                             MY MAJOR IS NOT LISTED
                                        </p>
                                        <input type="hidden" name="major_type" id="major_type" value="1">
                                          
                                    </div>
                                    <div id="add_class_div" class="col-xl-12" style="display: none">
                                        <p>Tell us your Major se we can manually verify it</p>
                                        <input name="add_major" id="add_major" class="form-control mb-1" style="height: 48px;" placeholder="Major">
                                        <span class="ap-field-errors" id="add_major_err" style="display: none;"></span>
                                        <label style="color: blue; cursor: pointer;" onclick="hideAddMajor()">
                                             Cancel
                                        </label>
                                        
                                    </div>
                                    <div class="col-xl-12" id="degree_div" style="display: none">
                                        <select class="form-control" id="degree" name="degree" style="height: 48px;margin-bottom: 20px;"  onchange="showNext(this.value, 'session_div')">
                                            <option value="">Type Of Degree</option>
                                            <option value="1">Associate</option>
                                            <option value="2">Bachelor's</option>
                                            <option value="3">Master's</option>
                                            <option value="4">Doctoral</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-12" id="session_div" style="display: none">
                                        <select class="form-control" id="session" name="session" style="height: 48px;margin-bottom: 20px;"  onchange="showNext(this.value, 'foi_div')">
                                            <option value="">Session</option>
                                            <option value="2017-2018">Summer 2020</option>
                                            <option value="2018-2019">Winter 2019/20</option>
                                            <option value="2019-2020">Summer 2019</option>
                                            <option value="2020-2021">Winter 2018/19</option>
                                            <option value="2019-2020">Summer 2018</option>
                                            <option value="2020-2021">Winter 2017/18</option>
                                            <option value="2019-2020">Summer 2017</option>
                                            <option value="2020-2021">Winter 2016/17</option>
                                            <option value="2019-2020">Summer 2016</option>
                                            <option value="2020-2021">Winter 2015/16</option>
                                            <option value="2019-2020">Summer 2015</option>
                                            <option value="2020-2021">Winter 2014/15</option>
                                            <option value="2019-2020">Summer 2014</option>
                                            <option value="2020-2021">Winter 2013/14</option>
                                            <option value="2019-2020">Summer 2013</option>
                                            <option value="2020-2021">Winter 2012/13</option>
                                            <option value="2019-2020">Summer 2012</option>
                                            <option value="2020-2021">Winter 2011/12</option>
                                            <option value="2019-2020">Summer 2011</option>
                                            <option value="2020-2021">Winter 2010/11</option>
                                            <option value="2019-2020">Summer 2010</option>

                                        </select>
                                    </div>
                                    <div class="col-xl-12" id="foi_div" style="display: none">
                                        <input class="form-control" style="height: 48px; margin-bottom: 20px;" type="text" name="field_interest" id="field_interest" placeholder="Field Of Interest ex. reading,writing.." >
                                    </div>
                                </div>
                                <center><span class="ap-field-errors" id="error_3" style="display: none;"></span></center>
                                <button type="button" data-id="3" name="next" class="next action-button" value="Continue" />
                                <i class="fa fa-circle-o-notch fa-spin" id="load_3" style="display: none;"></i>Continue<i class="fa fa-hand-o-right" aria-hidden="true" id="hand_3" style="padding-left: 4px"></i></button>
                            </fieldset>
                            <fieldset id="step_four">
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Privacy <i class="fa fa-lock" aria-hidden="true" style="color: #546de5; margin-left: 5px;font-size: 28px;vertical-align: middle;"></i></h2>
                                    <div class="col-xl-12 p-0">
                                        <label class="switch">
                                          <input type="checkbox" checked name="profile_setting" value="1">
                                          <span class="slider round"></span>
                                        </label>
                                        <span style="color: #000; font-size: 20px;"> Make profile public </span>
                                    </div>
                                    <p style="font-size: 12px;">Private profiles can still be seen by other users on your course. If you are a Professor for an institution your profile will always be public</p>
                                    <h6>Name</h6>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" class="custom-control-input" id="full_name" value="full_name" name="privacy" checked>
                                      <label class="custom-control-label" for="full_name">Full Name</label>
                                    </div>  
                                    <div class="custom-control custom-radio">
                                      <input type="radio" class="custom-control-input" id="initial" value="initial" name="privacy">
                                      <label class="custom-control-label" for="initial">First Name and Initial</label>
                                    </div>  
                                    <div class="custom-control custom-radio">
                                      <input type="radio" class="custom-control-input" id="nickname" value="nickname" name="privacy">
                                      <label class="custom-control-label" for="nickname">Nickname</label>
                                    </div> 
                                    <input class="form-control" style="height: 48px; margin-bottom: 20px;" type="text" id="nickname_text" name="nickname_text" placeholder="Nickname" readonly=""> 
                                    
                                </div>
                                <button type="submit" class="bttn-small btn-fill">Submit</button>
                            </fieldset>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</option>
<script type="text/javascript">
    $(document).ready(function(e){

var current_step = '<?php echo $user_detail['form_step']; ?>';
if(current_step == 1){
    $('#step_one').hide();
    $('#step_two').show();
} else if(current_step == 2){
    $('#step_one').hide();
    $('#step_two').hide();
    $('#step_three').show();
} else if(current_step == 3){
    $('#step_one').hide();
    $('#step_two').hide();
    $('#step_three').hide();
    $('#step_four').show();
} else if(current_step == 0){
    $('#step_one').show();
}

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
$("#add_institute").on('blur', function(){
    if($(this).val()!=''){
        $('#valid_div').css('display','block');
    }
});
$("#valid_div").focusout(function(){
    if($('#email').val()!='' ||$('#file').val()!=''){
        $('#course_div').css('display','block');
    }
});
$("#course").focusout(function(){
    if($(this).val()!=''){
        $('#class_div').css('display','block');
        $('#add_class_div').css('display','none');
    }
});
$("#add_course").focusout(function(){
    if($(this).val()!=''){
        $('#class_div').css('display','none');
        $('#add_class_div').css('display','block');
        $('#add_class_div p').css('display','none');
        $('#add_class_div label').css('display','none');
    }
});
$("#Major").focusout(function(){
    if($(this).val()!=''){
        var institute_type = $('#institute_type').val();
        if(institute_type == 1){
            var institute = $('#institute').val();
        } else {
            var institute = $('#add_institute').val();
        }
        var str1 = institute; 
        var str2 = "University"; 
        if(str1.indexOf(str2) != -1){
            $("#degree option[value=1]").hide();
        } else {
            $("#degree option[value=3]").hide();
            $("#degree option[value=4]").hide();
        }
        $('#degree_div').css('display','block');
    }
});
$("#add_major").focusout(function(){
    if($(this).val()!=''){
        var institute_type = $('#institute_type').val();
        if(institute_type == 1){
            var institute = $('#institute').val();
        } else {
            var institute = $('#add_institute').val();
        }
        var str1 = institute; 
        var str2 = "University"; 
        if(str1.indexOf(str2) != -1){
            $("#degree option[value=1]").hide();
        } else {
            $("#degree option[value=3]").hide();
            $("#degree option[value=4]").hide();
        }
        $('#degree_div').css('display','block');
    }
});
$("#degree").focusout(function(){ 
    if($(this).val()!=''){
        $('#session_div').css('display','block');
    }
});
$("#session").focusout(function(){
    if($(this).val()!=''){
        $('#foi_div').css('display','block');
    }
});
$(".next").click(function(){
var num = $(this).data("id"); 
current_fs = $(this).parent();

next_fs = $(this).parent().next();
var url = '<?php echo base_url('home/saveRegistrationStepWise') ?>';
if(num == 1){   
    var first_name = $('#first_name').val();
    if(first_name == ''){
        $('#error_1').html('First Name is required').show();
        $('#first_name').focus();
        return false;
    } else {
        $('#error_1').html('').hide();
    }

    var last_name = $('#last_name').val();
    if(last_name == ''){
        $('#error_1').html('Last Name is required').show();
        $('#last_name').focus();
        return false;
    } else {
        $('#error_1').html('').hide();
    }
    var placeholder = $('#phone').attr('placeholder'); 
    var mobile_no = $('#phone').val();
    if(mobile_no == ''){
        $('#error_1').html('Mobile No. is required').show();
        $('#phone').focus();
        return false;
    } if(mobile_no.length < 9 || mobile_no.length > 15){
        $('#error_1').html('Invalid Mobile No.').show();
        $('#phone').focus();
        return false;
    } else {
        $('#error_1').html('').hide();
    }

    var dob = $('#dob').val(); 
    if(dob == ''){
        $('#error_1').html('Date Of Birth is required').show();
        $('#dob').focus();
        return false;
    } else {
        var age = getAge();
        if(age<13) {
            $('#error_1').html('Age must be greater than 13 yrs.').show();
            $('#dob').focus();
            return false;
        } else {
            $('#error_1').html('').hide();
        }
        
    }

    var gender = $('#gender').val();
    if(gender == ''){
        $('#error_1').html('Gender is required').show();
        $('#gender').focus();
        return false;
    } else {
        $('#error_1').html('').hide();
    }
   
    var country_code = "+"+$(".iti__selected-flag").attr("title").match(/\d+/);
    
    var url = '<?php echo base_url('home/saveRegistrationStepWise') ?>';
    $('#hand').hide();
    $('#load').show();
    $(this).attr("disabled", true);
    $.ajax({
        url: url,
        type: 'post',
        data: {'first_name': first_name, 'last_name': last_name, 'mobile_no': mobile_no, 'dob': dob, 'gender': gender , 'country_code': country_code, 'step': 1},
        success: function(res) { console.log(res);
            if (res != 0) {
                $('#error_1').html('Something went wrong! Please try again.').show();
                return false;
            } else {
                $('#error_1').html('').hide();
                
                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
            }
        }
    });

} else if(num == 2){

    if($('#university_div').is(":visible")){
        var institute = $('#institute').val();
        if(institute == ''){
            $('#error_2').html('University Name is required').show();
            $('#institute').focus();
            return false;
        } else {
            $('#error_2').html('').hide();
        }
    }
    
    if($('#add_institute_div').is(":visible")){
        var add_institute = $('#add_institute').val();
        if(add_institute == ''){
            $('#error_2').html('University Name is required').show();
            $('#add_institute').focus();
            return false;
        } else {
            $('#error_2').html('').hide();
        }
    }
    
    if(!$("#have_email").is(":checked")){
        var email = $('#email').val();
        if(email == ''){
            $('#error_2').html('Institute Email is required').show();
            $('#email').focus();
            return false;
        } else {
            if(($('#manual_verification_check').prop('checked')==false)){
                $.when(verifyEmail(email)).done(function() {
                    chk_length = $('#err_email').text().length; 
                    if(chk_length > 5) {
                        $('#email').focus();
                        return false;
                    } else { 
                        $('#error_2').html('').hide();
                        var url = '<?php echo base_url('home/saveRegistrationStepWise') ?>';
                        $('#hand_2').hide();
                        $('#load_2').show();
                        $(this).attr("disabled", true);
                        
                        data = $("#msform").serialize();
                        
                        $.ajax({
                            url: url,
                            data: data,
                            dataType: "json",
                            type: 'POST',
                            
                            success: function ( res ) {
                                if (res != 0) {
                                    $('#error_2').html('Something went wrong! Please try again.').show();
                                    return false;
                                } else {
                                   $('#error_2').html('').hide();
                                   
                                    //Add Class Active
                                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                                    //show the next fieldset
                                    next_fs.show();
                                    //hide the current fieldset with style
                                    current_fs.animate({opacity: 0}, {
                                        step: function(now) {
                                        // for making fielset appear animation
                                        opacity = 1 - now;

                                        current_fs.css({
                                            'display': 'none',
                                            'position': 'relative'
                                        });
                                        next_fs.css({'opacity': opacity});
                                        },
                                        duration: 600
                                    });
                                }
                            }
                        });
                    }
                });
            } else {
                $('#hand_2').hide();
                $('#load_2').show();
                $(this).attr("disabled", true);
                
                data = $("#msform").serialize();
                
                $.ajax({
                    url: url,
                    data: data,
                    dataType: "json",
                    type: 'POST',
                    success: function ( res ) {
                        if (res != 0) {
                            $('#error_2').html('Something went wrong! Please try again.').show();
                            $('#hand_2').show();
                            $('#load_2').hide();
                            $(this).attr("disabled", false);
                            return false;
                        } else {
                           $('#error_2').html('').hide();
                           
                            //Add Class Active
                            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                            //show the next fieldset
                            next_fs.show();
                            //hide the current fieldset with style
                            current_fs.animate({opacity: 0}, {
                                step: function(now) {
                                // for making fielset appear animation
                                opacity = 1 - now;

                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_fs.css({'opacity': opacity});
                                },
                                duration: 600
                            });
                        }
                    }
                });
            }
        }
    } else {
        var file_email = $('#file_email').val();
        if(file_email == ''){
            $('#error_2').html('Identification document is required').show();
            $('#file_email').focus();
            return false;
        } else {
            $('#error_2').html('').hide();
            $('#hand_2').hide();
            $('#load_2').show();
            $(this).attr("disabled", true);
            var photo = document.getElementById("file_email");
            var file = photo.files[0];
            data = new FormData(document.getElementById('msform'))
            data.append('intitution_idcard', file);
            $.ajax({
                url: url,
                data: data,
                enctype: 'multipart/form-data',
                processData: false,  // do not process the data as url encoded params
                contentType: false,   // by default jQuery sets this to urlencoded string
                type: 'POST',
                success: function ( res ) {
                    if (res != 0) {
                        $('#error_2').html('Something went wrong! Please try again.').show();
                        return false;
                    } else {
                       $('#error_2').html('').hide();
                       
                        //Add Class Active
                        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                        //show the next fieldset
                        next_fs.show();
                        //hide the current fieldset with style
                        current_fs.animate({opacity: 0}, {
                            step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({'opacity': opacity});
                            },
                            duration: 600
                        });
                    }
                }
            });
        }
    }
    
} else if(num == 3){
    var field_type = $('#field_type').val();
    if($('#course_div').is(":visible")){
        var course = $('#course').val();
        if(course == ''){
            $('#error_3').html('Field Of Study is required').show();
            $('#course').focus();
            return false;
        } else {
            $('#error_3').html('').hide();
        }
        var field = $('#course').val();
    }

    if($('#add_course_div').is(":visible")){
        var course = $('#add_course').val();
        if(course == ''){
            $('#error_3').html('Field Of Study is required').show();
            $('#add_course').focus();
            return false;
        } else {
            $('#error_3').html('').hide();
        }
        var field = course;
    }
    var major_type = $('#major_type').val();
    if($('#class_div').is(":visible")){
        var Major = $('#Major').val();
        if(Major == ''){
            $('#error_3').html('Major is required').show();
            $('#Major').focus();
            return false;
        } else {
            $('#error_3').html('').hide();
        }
        var major = $('#Major').val();
    }

    if($('#add_class_div').is(":visible")){
        var Major = $('#add_major').val();
        if(Major == ''){
            $('#error_3').html('Major is required').show();
            $('#add_major').focus();
            return false;
        } else {
            $('#error_3').html('').hide();
        }
        var major = Major;
    }

    var degree = $('#degree').val();
    if(degree == ''){
        $('#error_3').html('Type Of Degree is required').show();
        $('#degree').focus();
        return false;
    } else {
        $('#error_3').html('').hide();
    }

    var session = $('#session').val();
    if(session == ''){
        $('#error_3').html('Session is required').show();
        $('#session').focus();
        return false;
    } else {
        $('#error_3').html('').hide();
    }

    var field_interest = $('#field_interest').val();
    if(field_interest == ''){
        $('#error_3').html('Field Of Intreset is required').show();
        $('#field_interest').focus();
        return false;
    } else {
        $('#error_3').html('').hide();
    }

    
    $('#hand_3').hide();
    $('#load_3').show();
    $(this).attr("disabled", true);
    $.ajax({
        url: url,
        type: 'post',
        data: {'field_type': field_type, 'field': field, 'major_type': major_type, 'major': major, 'degree': degree, 'session': session , 'field_interest': field_interest , 'step': 3},
        success: function(res) { console.log(res);
            if (res != 0) {
                $('#error_3').html('Something went wrong! Please try again.').show();
                return false;
            } else {
               $('#error_3').html('').hide();
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var full_name = first_name+' '+last_name;
                $('#nickname_text').val(full_name);
                
                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
            }
        }
    });

}

});

$("#manual_verification").click(function () {
$("#toggle_tst").toggle();
if($('#toggle_tst').is(":visible")){
    $('#manual_verification_check').prop('checked', true);
    $('#err_email').html('').hide();
} else {
    $('#manual_verification_check').prop('checked', false);
    var email = $('#email').val();
    verifyEmail(email);
}
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});

// $(".submit").click(function(){
// return false;
// })
$("#have_email").click(function(){
        var tt = $("#have_email").val();
        if(this.checked == false){
            $(".id_email").css('display', 'block');
            // $(".id_file").attr('required', 'false');
            $(".id_file").css('display', 'none');
        }else {
            // $(".id_email").attr('required', 'false');
            $(".id_email").css('display', 'none');
            $(".id_file").css('display', 'block');
            // $(".id_file").attr('required', 'true');
            deletefile(file_email);
        }
});

$(".m_b_n").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {     
        return false;
    }
});


$('input[name="privacy"]').change(function () {
    var val = (this.value);
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    if(val == 'full_name'){
        var full_name = first_name+' '+last_name;
        $('#nickname_text').val(full_name);
        $("#nickname_text").prop("readonly", true);
    } else if(val == 'initial') {
        var full_name = first_name+' '+last_name.charAt(0);
        $('#nickname_text').val(full_name);
        $("#nickname_text").prop("readonly", true);
    } else if(val == 'nickname') {
        var full_name = first_name+' '+last_name;
        $('#nickname_text').val(full_name);
        $("#nickname_text").prop("readonly", false);
    }
    
});

});

function getAge() {
        
        
    var birthDate = new Date($('#dob').val());
   // alert(birthDate);
    
    //console.log(today);
    today = new Date();

    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if (age < 0) {
        age = 0;
    } else {
        age = age;
    }
   return age;
}


function searchUniversity(keyword){
    var url = '<?php echo base_url('home/searchUniversity') ?>';
    if((keyword != '') && (keyword.length > 2)) {

      $.ajax({
          url: url,
          type: 'POST',
          data: {'keyword': keyword},
          success: function(result) {
              $('#myInputautocomplete-list').html(result);
          }
      });
    } else {
      $('#myInputautocomplete-list').html('');
      $('#valid_div').css('display','none');
    }
}


function getMajor(field){
    if(field != ""){
        var url = '<?php echo base_url('home/getMajor') ?>';
        $.ajax({
          url: url,
          type: 'POST',
          data: {'field': field},
          success: function(result) {
              $('#Major').html(result);
              $('#class_div').css('display','block');
              $('#add_class_div').css('display','none');
          }
      });
    }
}

function showNext(val, div_id){
    if(val != ""){
        $('#'+div_id).css('display','block');
    }
}

function searchField(keyword){
    var url = '<?php echo base_url('home/searchField') ?>';
    if((keyword != '') && (keyword.length > 2)) {

      $.ajax({
          url: url,
          type: 'POST',
          data: {'keyword': keyword},
          success: function(result) {
              $('#course-list').html(result);
          }
      });
    } else {
      $('#course-list').html('');
      
    }
}

function searchMajor(keyword){
    var url = '<?php echo base_url('home/searchMajor') ?>';
    var course = $('#field_id').val();
    if((keyword != '') && (keyword.length > 2)) {
      $.ajax({
          url: url,
          type: 'POST',
          data: {'keyword': keyword, 'course': course},
          success: function(result) {
              $('#major-list').html(result);
          }
      });
    } else {
      $('#major-list').html('');
    }
}

function selectUniversity(university){
    $('#institute_id').val(university);
      var text = $('#suggestion_'+university).text();
      $('#institute').val(text);
      $('#myInputautocomplete-list').html('');
      $('#valid_div').css('display','block');
}

function selectField(course){
    $('#field_id').val(course);
    var text = $('#course_suggestion_'+course).text();
    $('#course').val(text);
    $('#course-list').html('');

}

function selectMajor(major){
    $('#major_id').val(major);
    var text = $('#major_suggestion_'+major).text();
    $('#Major').val(text);
    $('#major-list').html('');
}

function showAddInstitute(){
    $('#university_div').css('display','none');
    $('#add_institute_div').css('display','block');
    $('#institute_type').val(2);
    var email = $('#email').val();
    verifyEmail(email);
}

function hideAddInstitute(){
    $('#university_div').css('display','block');
    $('#add_institute_div').css('display','none');
    $('#institute_type').val(1);
    var email = $('#email').val();
    verifyEmail(email);
}

function showAddField(){
    $('#course_div').css('display','none');
    $('#add_course_div').css('display','block');
    $('#field_type').val(2);
    $('#class_div').css('display','none');
    $('#course').val('');
}

function showAddMajor(){
    $('#class_div').css('display','none');
    $('#add_class_div').css('display','block');
    $('#add_class_div p').css('display','block');
    $('#add_class_div label').css('display','block');
    $('#major_type').val(2);
}

function hideAddField(){
    $('#course_div').css('display','block');
    $('#add_course_div').css('display','none');
    $('#field_type').val(1);
    $('#add_class_div').css('display','none');
    $('#add_course').val('');
}

function hideAddMajor(){
    $('#class_div').css('display','block');
    $('#add_class_div').css('display','none');
    $('#major_type').val(1);
}

function isValidEmailAddress(email01) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email01);
}

function verifyEmail(email){
    var url = '<?php echo base_url('home/verifyEmail') ?>';
        if (email != '') {
            var email2 = isValidEmailAddress(email);
            if(!email2) {
                $('#err_email').css('color', 'red').text('Email Id is not valid').show();
                $('#email').focus();
                return false;
            } else {
                var institute_type = $('#institute_type').val();
                if((institute_type == 1) && ($('#manual_verification_check').prop('checked')==false)){
                    var institute_id = $('#institute_id').val();
                    $('#hand_2').hide();
                    $('#load_2').show();
                    $('#button_2').attr("disabled", true);
                    return $.ajax({
                        url: url,
                        type: 'post',
                        data: {'email': email, 'institute_id': institute_id},
                        success: function(res) { 
                            $('#hand_2').show();
                            $('#load_2').hide();
                            $('#button_2').attr("disabled", false);
                            if (res != 0) {
                                $('#err_email').html(res).show();
                                return false;
                            } else {
                               $('#err_email').html('').hide();
                            }
                            
                        }
                    });
                } else {
                    $('#err_email').html('').hide();
                }
            }
        }
}


function move(elem, id2) {
        
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
                $('#'+id2).text('Success');
            } else {
                width++; 
                //elem.style.width = width + '%'; 

                var ww = width + '%';
                $('#'+elem).css('width', ww);
            }
        }
    }


     function uploadVideo(input, id){ 
    //$('.get_img').on('change', function(input) {

        //var id = $(this).attr('id');

        //alert(id);
       
        if (input.files && input.files[0]) {
            var file = input.files[0].name;
            //alert(file);
            var ext = file.split(".");  
            ext = ext[ext.length-1].toLowerCase();      
            var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "pdf"];
            var arrayVideoExtensions = ["m4v", "avi","mpg","mp4", "webm","3gp"];
            if($.inArray(ext, arrayExtensions) == -1) {
                alert('Sorry, invalid extension.');
                $('#'+id).val(null);
                return false;
            } else { 
                 $('#showData_'+id).show();
                $('#loaderShow_'+id).show();
                $('#loaderShow').css('display','block');
                var reader = new FileReader();
                var image = '';
                // var ids1 = 'showFile_'+id;
                var ids2 = 'blah_'+id;
                var ids3 = 'myProgress_'+id;
                var ids4 = 'myBar_'+id;
                var ids5 = id;
                var ids6 = 'message_'+id;
                var ids7 = 'videoSize_'+id;

                if (ext == 'pdf') {
                    var img_url = '<?php echo base_url()?>'+'assets/images/pdf.jpg';
                    //alert(img_url);
                    reader.onload = function (e) {
                        $(ids2)
                            .attr('src', img_url)
                            .width(150)
                            .height(200);


                        var exactSize = input.files[0].size;
                        //alert(exactSize);
                        $('#showData_'+id).html('<div id="showFile_'+id+'" class="showFile" style="border: 2px solid #dedadad9;padding: 5px;width: 228px;"><img id="'+ids2+'" src="'+img_url+'" alt="your image" width="100%" height="200" /><div id="'+ids3+'" class="myProgress"><div id="'+ids4+'" class="myBar"></div></div><p id="'+ids5+'" class="deleteFile"><a href="javascript:deletefile('+"'"+ids5+"'"+')"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;<span id="'+ids6+'" style="color:green;"></span><span id="'+ids7+'" style="float: right;">'+exactSize+' KB'+'</span></p></p></div>');
                          move(ids4, ids6);
                           $('.set_div_img00').hide();
                        $('input[name="FileSize"]').val(exactSize);
                            // console.log(e.target.result)
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    //console.log(id)

                    //alert(ids5);
                    reader.onload = function (e) {
                       $(ids2)
                            .attr('src', e.target.result)
                            .width(150)
                            .height(200);


                        var exactSize = input.files[0].size;
                        //alert(exactSize);
                        $('#showData_'+id).html('<div id="showFile_'+id+'" class="showFile" style="border: 2px solid #dedadad9;padding: 5px;width: 228px;"><img id="'+ids2+'" src="'+e.target.result+'" alt="your image" width="100%" height="200" /><div id="'+ids3+'" class="myProgress"><div id="'+ids4+'" class="myBar"></div></div><p id="'+ids5+'" class="deleteFile"><a href="javascript:deletefile('+"'"+ids5+"'"+')"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;<span id="'+ids6+'" style="color:green;"></span><span id="'+ids7+'" style="float: right;">'+exactSize+' KB'+'</span></p></p></div>');
                          move(ids4, ids6);
                          $('.set_div_img00').hide();
                        $('input[name="FileSize"]').val(exactSize);
                            //console.log(e.target.result)
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }

        $('#old_'+id).hide();
    }

    function deletefile(id){

        $("#"+id).val(null);
        $('#showFile_'+id).remove();
        $("#showData_"+id).html('<span id="loaderShow"><div class="loader"></div><span>Please Wait...</span></span>');
        $('.set_div_img00').show();
    }

    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "<?php echo base_url(); ?>assets/js/utils.js",
    });

</script>
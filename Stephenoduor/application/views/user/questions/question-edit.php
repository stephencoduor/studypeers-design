<section class="mainContent">
					<div class="studySetWrapper list">
						<div class="header">
							<h4>
								<a class="backBtn" href="<?php echo base_url(); ?>account/questions">
									<svg class="sp-icon" version="1.1" id="Layer_1" 
									    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
									Back
								</a>
								Ask question
							</h4>
						</div>	
						<form method="post" action="<?php echo base_url(); ?>account/editQuestion/<?php echo base64_encode($result['id']); ?>" enctype="multipart/form-data" onsubmit="return validateQuestion()">	
							<div class="content-box">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<!-- <label>Name</label> -->
											<input type="text" name="question_title" id="question_title" class="form-control form-control--lg" placeholder="Title..." value="<?php echo $result['question_title']; ?>">
											<span class="custom_err" id="err_question_title"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="form-group select select_label">
											<label>Institution</label>
											<select class="form-control" name="university" id="university">
											  <option value="<?= $university['university_id']; ?>"><?= $university['SchoolName']; ?></option>
											</select>
											<span class="custom_err" id="err_university"></span>
										</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="form-group select select_label">
											<label>Course</label>
											<select class="form-control" name="course" id="course" onchange="getProfessor(this.value, '<?php echo base_url('account/getProfessor') ?>')">
												<option value="">Select Course</option>
												<?php foreach ($course as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?php if($result['course'] == $value['id']) { echo 'selected'; } ?>><?= $value['name'] ?></option>
												<?php } ?>
											</select>
											<span class="custom_err" id="err_course"></span>
										</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="form-group select select_label">
											<label>Professor</label>
											<select class="form-control" name="professor" id="professor">
											  	<?php foreach ($professor as $key => $value) { ?>
													<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
												<?php } ?>
											</select>
											<span class="custom_err" id="err_professor"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="content-area">
								<div class="row">
									<div class="col-md-12">
										
										<textarea name="textarea" id="jqte-test" class="jqte-test"><?php echo $result['textarea']; ?></textarea>
										<span class="custom_err" id="err_jqte-test"></span>
									</div>
								</div>
							</div>
							<div class="studybuttonGroup">
								<button type="button" class="transparentBtn" onclick="location.href='<?php echo base_url(); ?>account/questions';">Cancel</button>
								<button type="submit" class="filterBtn">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 484 484">
										<path d="M477.9,100.8L383.1,6c-4-4-9.1-6-14.1-6H20.2C9.1,0,0,9.1,0,20.2v443.6C0,474.9,9.1,484,20.2,484h443.6
											c11.1,0,20.2-9.1,20.2-20.2V115C484,109.9,482,104.9,477.9,100.8z M110.9,40.4h142.2V119H110.9V40.4z M443.6,443.6H40.4V40.4
											h30.2v98.8c0,11.1,9.1,20.2,20.2,20.2h182.5c11.1,0,20.2-9.1,20.2-20.2V40.4H361l82.7,82.7v320.5H443.6z"></path>
										<path d="M130.1,255.1c-11.1,0-20.2,9.1-20.2,20.2c0,11.1,9.1,20.2,20.2,20.2h223.8c11.1,0,19.2-9.1,19.2-20.2
											c0-11.1-9.1-20.2-20.2-20.2L130.1,255.1L130.1,255.1z"></path>
										<path d="M355.9,350.9H128.1c-11.1,0-20.2,9.1-20.2,20.2c0,11.1,9.1,20.2,20.2,20.2H356c11.1,0,20.2-9.1,20.2-20.2
											C376.1,360,367,350.9,355.9,350.9z"></path>
									</svg>
									Save
								</button>
							</div>
						</form>
					</div>
				</section>


<script type="text/javascript">
	function getProfessor(course, url){
        
        if(course != '') {

          $.ajax({
              url: url,
              type: 'POST',
              data: {'course': course},
              success: function(result) {
                  $('#professor').html(result);
              }
          });
        } else {
          $('#professor').html('');
        }
    }

    function validateQuestion(){ 
      var question_title = $('#question_title').val();
      if(question_title == ''){
        $('#err_question_title').html("This field is required").show();
        return false;
      } else {
        $('#err_question_title').html("").hide();
      }


      var university = $('#university').val();
      if(university == ''){
        $('#err_university').html("This field is required").show();
        return false;
      } else {
        $('#err_university').html("").hide();
      }

      var course = $('#course').val();
      if(course == ''){
        $('#err_course').html("This field is required").show();
        return false;
      } else {
        $('#err_course').html("").hide();
      }

      var professor = $('#professor').val();
      if(professor == ''){
        $('#err_professor').html("This field is required").show();
        return false;
      } else {
        $('#err_professor').html("").hide();
      }

      var description = $('#jqte-test').val();
      if(description == ''){
        $('#err_jqte-test').html("This field is required").show();
        return false;
      } else {
        $('#err_jqte-test').html("").hide();
      }
    }
</script>
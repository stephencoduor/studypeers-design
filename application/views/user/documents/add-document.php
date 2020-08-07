<section class="mainContent">
					<div class="studySetWrapper list">
						<div class="header">
							<h4>
								<a class="backBtn" href="<?php echo base_url(); ?>account/documents">
									<svg class="sp-icon" version="1.1" id="Layer_1" 
									    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
									Back
								</a>
								Add Document
							</h4>
						</div>	
						<form method="post" action="<?php echo base_url(); ?>account/addDocument" enctype="multipart/form-data" onsubmit="return validateDocument()">	
							<div class="content-box">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<!-- <label>Name</label> -->
											<input type="text" name="document_name" id="document_name" class="form-control form-control--lg" placeholder="Name">
											<span class="custom_err" id="err_document_name"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea name="description" placeholder="Description" id="description" class="textarea-gray"></textarea>
											<span class="custom_err" id="err_description"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-row">
											<div class="col-sm-6">		
												<div class="form-group select select_label">
													<label>Institution</label>
													<select class="form-control" name="university" id="university">
													  <option value="<?= $university['university_id']; ?>"><?= $university['SchoolName']; ?></option>
													</select>
													<span class="custom_err" id="err_university"></span>
												</div>
												<div class="form-group select select_label">
													<label>Course</label>
													<select class="form-control" name="course" id="course" onchange="getProfessor(this.value, '<?php echo base_url('account/getProfessor') ?>')">
														<option value="">Select Course</option>
														<?php foreach ($course as $key => $value) { ?>
															<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
														<?php } ?>
													</select>

													<span class="custom_err" id="err_course"></span>
												</div>											
												<div class="form-group select select_label">
													<label>Professor</label>
													<select class="form-control" name="professor" id="professor">
															  
													</select>
													<span class="custom_err" id="err_professor"></span>
												</div>
											</div>
											<div class="col-sm-6">
												<labe class="imageBoxUpload">
													<div id="imageBoxUpload">
														<span class="imageBoxUpload--icon">
															<svg class="sp-icon" version="1.1" id="Layer_1" 
																xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
																<path d="M31.4,147.5c11.3,0,20.4-9.1,20.4-20.4V51.9h408.4V127c0,11.3,9.1,20.4,20.4,20.4S501,138.3,501,127V31.4
																	c0-11.3-9.1-20.4-20.4-20.4H31.4C20.1,11,11,20.1,11,31.4V127C11,138.3,20.1,147.5,31.4,147.5L31.4,147.5z"></path>
																<path d="M314.8,277v183H205.1V277.8h-67.6l118.9-118.9L374.5,277H314.8z M268.4,112.9c-6.7-6.7-17.4-6.7-24.1,0L67.5,289.7
																	c-10.7,10.7-3.1,29.1,12.1,29.1H164V484c0,9.4,7.6,17,17,17h157.8c9.4,0,17-7.6,17-17V318h76.6c15.2,0,22.8-18.4,12.1-29.1
																	L268.4,112.9z"></path>
															</svg>
															upload document
														</span>	
													</div>
													<input type="file" name="featured_image" id="featured_image-document">
												</labe>
												<span class="custom_err" id="err_featured_image-document"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="studybuttonGroup">
								<a class="transparentBtn" href="<?php echo base_url(); ?>account/documents">Cancel</a>
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
									Create
								</button>
							</div>
						</form>
					</div>
				</section>


<script type="text/javascript">
	function validateDocument(){ 
      var document_name = $('#document_name').val();
      if(document_name == ''){
        $('#err_document_name').html("This field is required").show();
        return false;
      } else {
        $('#err_document_name').html("").hide();
      }

      var description = $('#description').val();
      if(description == ''){
        $('#err_description').html("This field is required").show();
        return false;
      } else {
        $('#err_description').html("").hide();
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

      var featured_image = $('#featured_image-document').val();
      if(featured_image == ''){
        $('#err_featured_image-document').html("This field is required").show();
        return false;
      } else {
        $('#err_featured_image-document').html("").hide();
      }
    }

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

  var i = '<span class="imageBoxUpload--icon"<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path d="M31.4,147.5c11.3,0,20.4-9.1,20.4-20.4V51.9h408.4V127c0,11.3,9.1,20.4,20.4,20.4S501,138.3,501,127V31.4 c0-11.3-9.1-20.4-20.4-20.4H31.4C20.1,11,11,20.1,11,31.4V127C11,138.3,20.1,147.5,31.4,147.5L31.4,147.5z"></path><path d="M314.8,277v183H205.1V277.8h-67.6l118.9-118.9L374.5,277H314.8z M268.4,112.9c-6.7-6.7-17.4-6.7-24.1,0L67.5,289.7	c-10.7,10.7-3.1,29.1,12.1,29.1H164V484c0,9.4,7.6,17,17,17h157.8c9.4,0,17-7.6,17-17V318h76.6c15.2,0,22.8-18.4,12.1-29.1	L268.4,112.9z"></path></svg>upload documen</span>';

  function readURLDocument(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      const name = input.files[0].name;
  	  const ext = name.substr( (name.lastIndexOf('.') +1) );
  	  var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "pdf", "docx", "doc", "xlsx", "xls", "ppt", "pptx"];
  	  	if($.inArray(ext, arrayExtensions) == -1) {
            alert('Sorry, invalid extension.');
            $('#featured_image-document').val(null);
            $('#imageBoxUpload').html(i);
            return false;
        } else {
        	if (ext == 'pdf') {
        		var img_url = '<?php echo base_url()?>'+'assets/images/pdf.jpg';
        		reader.onload = function(e) {
			        $('#imageBoxUpload').html('<img src="'+img_url+'">');
			    }
        	} else if (ext == 'docx' || ext == 'doc') {
        		var img_url = '<?php echo base_url()?>'+'assets/images/doc.png';
        		reader.onload = function(e) {
			        $('#imageBoxUpload').html('<img src="'+img_url+'">');
			    }
        	} else if (ext == 'xlsx' || ext == 'xls') {
        		var img_url = '<?php echo base_url()?>'+'assets/images/xsl.jpg';
        		reader.onload = function(e) {
			        $('#imageBoxUpload').html('<img src="'+img_url+'">');
			    }
        	} else if (ext == 'ppt' || ext == 'pptx') {
        		var img_url = '<?php echo base_url()?>'+'assets/images/ppt.png';
        		reader.onload = function(e) {
			        $('#imageBoxUpload').html('<img src="'+img_url+'">');
			    }
        	} else {
	        	reader.onload = function(e) {
			        $('#imageBoxUpload').html('<img src="'+e.target.result+'">');
			    }
        	}
        }
      
	      
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  






</script>
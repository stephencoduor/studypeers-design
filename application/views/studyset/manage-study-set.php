<style>.error { color: red; } .hide { display: none; }</style>
<?php
$submit_name = (isset($study_set_id) && $study_set_id > 0) ? 'Update' : 'Create';
?>
				<section class="mainContent">
					<div class="studySetWrapper list">
						<div class="header">
							<h4>
								<a class="backBtn" href="<?php echo base_url();?>studyset">
									<svg class="sp-icon" version="1.1" id="Layer_1" 
									    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
									Back
								</a>
								<?php echo $submit_name;?> Study Set
							</h4>
						</div>	
						<form method="post" action="<?php echo base_url();?>/studyset/manageStudySet" name="study-sets" enctype="multipart/form-data" onsubmit="return validateForm();">
							<div class="content-box">
								<div class="row">
									<div class="col-sm-12" style="margin-bottom: 20px;">
										<label>Cover Photo</label>
												<labe class="imageBoxUpload">
													<div id="studyset_preview">
														
															<?php if(!empty($studyset_data['image'])) { ?>
																<img src="<?php echo (isset($studyset_data) && isset($studyset_data['image'])) ? base_url().'uploads/studyset/'.$studyset_data['image'] : '';?>">
															<?php } else { ?>
																<img src="<?php echo base_url().'assets/images/map.jpg';?>">
															<?php } ?>
													</div>
															<div class="overlay-bg"> 
												                <a href="#" class="icon"> 
												                   <i class="fa fa-cloud-upload"></i> 
												                </a> 
												            </div> 
														
														
													
													<input type="file" name="featured_image" id="featured_image-id">
													<span class="error" id="featured_image-id_err"></span>
												</labe>
											</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="hidden" name="study_set_id" value="<?php echo (isset($study_set_id)) ? $study_set_id : 0;?>">
											<input type="text" name="name" id="name" class="form-control form-control--lg" placeholder="Name" value="<?php echo (isset($studyset_data) && isset($studyset_data['name'])) ? $studyset_data['name'] : '';?>">
											<span class="error" id="name_err"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Institution</label>
											<select class="form-control" id="institution" name="institution" >
												<option value="">Select Institution</option>
												<option value="<?php echo $userdata['intitutionID'];?>" <?php echo (isset($studyset_data) && isset($studyset_data['institution']) && $studyset_data['institution'] == $userdata['intitutionID']) ? 'selected' : '';?>><?php echo $userdata['SchoolName'];?></option>
											</select>
											<span class="error" id="institution_err"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Course</label>
											<select class="form-control" id="course" name="course" onchange="getProfessor();">
												<option value="">Select Course</option>
											  	<?php
												foreach ($courses as $key => $course) {
												?>
													<option value="<?php echo $course['id'];?>" <?php echo (isset($studyset_data) && isset($studyset_data['course']) && $studyset_data['course'] == $course['id']) ? 'selected' : '';?>><?php echo $course['name'];?></option>
												<?php
												}
												?>
											</select>
											<span class="error" id="course_err"></span>
											<a data-toggle="modal" data-target="#courseModal" style="cursor: pointer;">Add Course</a>
										</div>

									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Professor</label>
											<select class="form-control" readonly="readonly" id="professor" name="professor">
											  
											</select>
											<span class="error" id="professor_err"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Privacy & Permission  <span style="font-size: 14px;font-weight: 400;color: gray;display: none;" id="privcy_span"></span></label>
											<select class="form-control" id="privacy" name="privacy" onchange="showPermissionText(this.value)">
											  <option value="">Select Privacy</option>
											  <option value="1" <?php echo (isset($studyset_data) && isset($studyset_data['privacy']) && $studyset_data['privacy'] == 1) ? 'selected' : '';?>>Public</option>
											  <option value="2" <?php echo (isset($studyset_data) && isset($studyset_data['privacy']) && $studyset_data['privacy'] == 2) ? 'selected' : '';?>>Private</option>
											  <option value="3" <?php echo (isset($studyset_data) && isset($studyset_data['privacy']) && $studyset_data['privacy'] == 3) ? 'selected' : '';?>>Secret</option>
											</select>
											<span class="error" id="privacy_err"></span>

										</div>
									</div>
									<div class="col-md-12">
										<div class="form-row">
											<div class="col-sm-6">
												
												<div class="form-group">
													<label>Chapter</label>
													<input type="text" class="form-control" id="chapter" name="chapter" placeholder="Chapter" value="<?php echo (isset($studyset_data) && isset($studyset_data['chapter'])) ? $studyset_data['chapter'] : '';?>">
													<span class="error" id="chapter_err"></span>
												</div>	
											</div>	
											<div class="col-sm-6">									
												<div class="form-group">
													<label>Unit</label>
													<input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" value="<?php echo (isset($studyset_data) && isset($studyset_data['unit'])) ? $studyset_data['unit'] : '';?>" >
													<span class="error" id="unit_err"></span>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<div class="termsWrapper">
								<h4>Term</h4>
								

							</div>
							<?php
								$term_data = (isset($studyset_data) && isset($studyset_data['term_data'])) ? $studyset_data['term_data'] : array();
								if(isset($studyset_data['term_data'])){
									$term_count = count($studyset_data['term_data']);
								} else {
									$term_count = 1;
								}
							?>
							<input type="hidden" id="term_count" value="<?= $term_count; ?>">
							<div class="content-box">
								<div class="row">
									<div class="col-md-12">
										<div class="flex-form-row">
											<div class="form-group">
												
												<input type="hidden" name="study_set_term_id[]" value="<?php echo (!empty($term_data) && isset($term_data[0]) && isset($term_data[0]['study_set_term_id'])) ? $term_data[0]['study_set_term_id'] : 0;?>">
												<input type="text" name="term_name[]" placeholder="Term" class="form-control form-control--lg term_name" value="<?php echo (!empty($term_data) && isset($term_data[0]) && isset($term_data[0]['term_name'])) ? $term_data[0]['term_name'] : '';?>">
												<span class="error"></span>
											</div>
											<!-- <button type="button" class="transparentBtn">Delete</button> -->
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-row">
											<div class="col-sm-6">
												<div class="form-group">
													<label>Description</label>
													<textarea class="term_description" name="term_description[]" id="definition0" cols="30" rows="10"><?php echo (!empty($term_data) && isset($term_data[0]) && isset($term_data[0]['term_description'])) ? $term_data[0]['term_description'] : '';?></textarea>
													<span class="error"></span>
												</div>
											</div>
											
											<div class="col-sm-6">
												<labe class="imageBoxUpload">
													<div id="imageBoxUpload_0">
														<?php if(!empty($term_data[0]['term_image'])) { ?>
															<img src="<?php echo (!empty($term_data) && isset($term_data[0]) && isset($term_data[0]['term_image'])) ? base_url().'uploads/studyset/'.$term_data[0]['term_image'] : '';?>" >
														<?php } else { ?>
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
														<?php } ?>
													</div>
													<input type="file" class="term_image" name="term_image[]" id="featured_image-id" data-id="0">
													<span class="error"></span>
												</labe>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							foreach ($term_data as $key => $value) {
								if($key == 0) { continue; }
							?>
							<div class="content-box">
								<div class="row">
									<div class="col-md-12">
										<div class="flex-form-row">
											<div class="form-group">
												
												<input type="hidden" name="study_set_term_id[]" value="<?php echo $value['study_set_term_id'];?>">
												<input type="text" name="term_name[]" placeholder="Term" class="form-control form-control--lg term_name" value="<?php echo $value['term_name'];?>">
												<span class="error"></span>
											</div>
											<!-- <button type="button" class="transparentBtn">Delete</button> -->
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-row">
											<div class="col-sm-6">
												<div class="form-group">
													<label>Description</label>
													<textarea class="term_description" name="term_description[]" id="definition0" cols="30" rows="10"><?php echo $value['term_description'];?></textarea>
													<span class="error"></span>
												</div>
											</div>
											
											<div class="col-sm-6">
												<labe class="imageBoxUpload">
													<div id="imageBoxUpload_<?php echo $key; ?>">
														<?php if(!empty($value['term_image'])) { ?>
															<img src="<?php echo base_url().'uploads/studyset/'.$value['term_image'];?>" >
														<?php } else { ?>
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
													<?php } ?>
													</div>
													<input type="file" class="term_image" name="term_image[]" id="term_image" data-id="<?php echo $key; ?>">
													<span class="error"></span>
												</labe>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							}
							?>

							<span id="addTerm"></span>
							<div class="termsWrapper" style="justify-content: flex-end;">
								
								<button type="button" class="transparentBtn" onclick="addTerm();">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
										<path d="M465.5,220.5h-196v-196C269.5,11,258.5,0,245,0s-24.5,11-24.5,24.5v196h-196C11,220.5,0,231.5,0,245s11,24.5,24.5,24.5h196
											v196c0,13.5,11,24.5,24.5,24.5s24.5-11,24.5-24.5v-196h196c13.5,0,24.5-11,24.5-24.5S479,220.5,465.5,220.5z"></path>
									</svg> Add a Term
								</button>

							</div>
							<div class="studybuttonGroup" style="justify-content: flex-start;">
								<button type="button" class="transparentBtn" onclick="location.href='<?php echo base_url();?>studyset';">Cancel</button>
								<button type="submit" name="submit" class="filterBtn">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 484 484">
										<path d="M477.9,100.8L383.1,6c-4-4-9.1-6-14.1-6H20.2C9.1,0,0,9.1,0,20.2v443.6C0,474.9,9.1,484,20.2,484h443.6
											c11.1,0,20.2-9.1,20.2-20.2V115C484,109.9,482,104.9,477.9,100.8z M110.9,40.4h142.2V119H110.9V40.4z M443.6,443.6H40.4V40.4
											h30.2v98.8c0,11.1,9.1,20.2,20.2,20.2h182.5c11.1,0,20.2-9.1,20.2-20.2V40.4H361l82.7,82.7v320.5H443.6z"></path>
										<path d="M130.1,255.1c-11.1,0-20.2,9.1-20.2,20.2c0,11.1,9.1,20.2,20.2,20.2h223.8c11.1,0,19.2-9.1,19.2-20.2
											c0-11.1-9.1-20.2-20.2-20.2L130.1,255.1L130.1,255.1z"></path>
										<path d="M355.9,350.9H128.1c-11.1,0-20.2,9.1-20.2,20.2c0,11.1,9.1,20.2,20.2,20.2H356c11.1,0,20.2-9.1,20.2-20.2
											C376.1,360,367,350.9,355.9,350.9z"></path>
									</svg>
									<?php
									echo $submit_name;
									?>
								</button>
								<button type="button" class="btnDelete hide">Delete</button>
							</div>
						</form>
					</div>
				</section>
				
			</section>
		</section>
	</section>
<div class="modal fade" id="peersMessageModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body peers">
          <h4>Peers List</h4>
          <div class="searchPeer">
          	<div class="filterSearch">
				<input type="text" placeholder="Search Peers" name="">
				<button type="submit" class="searchBtn">
					<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
						<path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
						s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
						c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
					</svg>
				</button>
			</div>
          </div>
          <div class="peersList">
          	<div class="listHeader">
          		<h6>Peers</h6>
          	</div>
          	<div class="listUserWrap">
          		<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
          	</div>
          </div>
        </div>
      </div>
    </div>
</div>

<?php
$professor = (isset($studyset_data) && isset($studyset_data['professor'])) ? $studyset_data['professor'] : '';
?>
<script type="text/javascript">
var professor_id = '<?php echo $professor;?>';
$(document).ready(function(){
	$(document).on('click','.deleteTerm',function(){
		$(this).parent().parent().parent().parent().remove();

	});

    $("#featured_image-id").change(function(){
        readURL(this);
        $('.next').show();
        $('.previous').hide();
    });

    $(document).on('change','.term_image',function(){
    	var data_id = $(this).attr("data-id");
        readImageURL(this, data_id);
        
    });

    var course_id = $("#course").val();
    if(course_id != '') {
    	getProfessor();
    }
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#studyset_preview')
                .html('<img src="'+e.target.result+'">');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function readImageURL(input, data_id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
	    	$('#imageBoxUpload_'+data_id).html('<img src="'+e.target.result+'">');
	      
	    }

        reader.readAsDataURL(input.files[0]);
    }
}


function validateForm() 
{
	$('.error').html('');
	var flag = 0;
	var name = $("#name").val().trim();
	var institution = $("#institution").val().trim();
	// var professor = $("#professor").val().trim();
	var course = $("#course").val().trim();
	var privacy = $("#privacy").val().trim();
	// var unit = $("#unit").val().trim();
	// var chapter = $("#chapter").val().trim();


	if(name == '') {
		$('#name_err').html('This field is required');
		flag = 1;
	}
	if(institution == '') {
		$('#institution_err').html('This field is required');
		flag = 1;
	}
	// if(professor == '') {
	// 	$('#professor_err').html('This field is required');
	// 	flag = 1;
	// }
	if(course == '') {
		$('#course_err').html('This field is required');
		flag = 1;
	}
	if(privacy == '') {
		$('#privacy_err').html('This field is required');
		flag = 1;
	}
	// if(subject == '') {
	// 	$('#subject_err').html('This field is required');
	// 	flag = 1;
	// }
	// if(unit == '') {
	// 	$('#unit_err').html('This field is required');
	// 	flag = 1;
	// }
	// if(chapter == '') {
	// 	$('#chapter_err').html('This field is required');
	// 	flag = 1;
	// }
	
	$(".term_name").each(function(){
		if($(this).val().trim() == '') {
			$(this).next().html('This field is required');
			flag = 1;
		}
	})

	$(".term_description").each(function(){
		if($(this).val().trim() == '') {
			$(this).next().html('This field is required');
			flag = 1;
		}
	})

	return (flag == 0) ? true : false; 
}

function getProfessor() 
{
	var course_id = $("#course").val();
	$.ajax({
		url : '<?php echo base_url();?>studyset/getProfessors',
		type : 'post',
		data : {"course_id" : course_id},
		success:function(result) {
			console.log(result);
			var data = JSON.parse(result);
			var professors = '';
			for(i = 0; i < data.length; i++) {
				professors+= '<option value="'+data[i].id+'">'+data[i].name+'</option>';
			}
			$("#professor").html(professors);
			if(professor_id) {
				$("#professor").val(professor_id);
			}
		}
	})
}	

function addTerm() 
{   
	var term_count = $('#term_count').val();
	
	var term_html = '<div class="content-box"><div class="row"><div class="col-md-12"><div class="flex-form-row"><div class="form-group"><input type="hidden" name="study_set_term_id[]" value="0"/><input type="text" name="term_name[]" placeholder="Term" class="form-control form-control--lg term_name"><span class="error"></span></div><button type="button" class="transparentBtn deleteTerm">Delete</button></div></div><div class="col-md-12"><div class="form-row"><div class="col-sm-6"><div class="form-group"><label>Description</label><textarea class="term_description" name="term_description[]" id="definition0" cols="30" rows="10"></textarea><span class="error"></span></div></div><div class="col-sm-6"><labe class="imageBoxUpload"><div id="imageBoxUpload_'+term_count+'"><span class="imageBoxUpload--icon"><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M490.684082,0H21.315918C9.5085716,0,0,9.5085716,0,21.315918V490.684082C0,502.4914246,9.5085716,512,21.315918,512H490.684082C502.4914246,512,512,502.4914246,512,490.684082V21.315918C512,9.5085716,502.4914246,0,490.684082,0z M50.6775513,469.3681641l108.9828644-165.3028564l92.0554962,165.3028564H50.6775513z M469.3681641,469.3681641H299.7812195c-0.2089844-0.6269226-19.5396118-35.631012-42.6318359-77.217926L384,204.5910339l85.2636719,72.8293762v191.9477539H469.3681641z M469.3681641,221.204895l-75.6506042-64.6791992c-4.5975342-4.4930573-20.1665039-10.7624512-31.5559082,4.2840881l-128.1045074,189.440033c-27.8987732-50.3641052-54.2301941-97.6979675-54.2301941-97.6979675c-4.2840881-8.3591766-22.7787781-19.3306122-36.4669342-1.3583679L42.6318359,403.95755V42.6318359h426.6318054V221.204895H469.3681641z"></path><path d="M238.1322327,205.6359253c35.1085815,0,63.6342773-28.5257263,63.6342773-63.6342926s-28.5256958-63.6342926-63.6342773-63.6342926s-63.6342773,28.5257111-63.6342773,63.6342926c0.1045074,35.1085663,28.6302032,63.6342773,63.6342773,63.6342773V205.6359253z M238.1322327,120.9991837c11.5983734,0,20.8979797,9.4040909,20.8979797,20.8979568c0,11.5983734-9.4040985,20.8979645-20.8979797,20.8979645c-11.5983734,0-20.8979492-9.4040833-20.8979492-20.8979645C217.2342834,130.4032745,226.6383667,120.9991837,238.1322327,120.9991837z"></path></svg>Add Image</span></div><input type="file" class="term_image" name="term_image[]" id="featured_image-id" data-id="'+term_count+'"><span class="error"></span></labe></div></div></div></div></div>';
	$("#addTerm").append(term_html);
	$('#term_count').val(term_count+1);

}

function showPermissionText(val){
	if(val == 1) {
		$('#privcy_span').html('(Keep this studyset public)').show();
	} else if(val == 2) {
		$('#privcy_span').html('(Keep this studyset private)').show();
	} else if(val == 3) {
		$('#privcy_span').html('(Keep this studyset secret)').show();
	} else {
		$('#privcy_span').html('').hide();
	}  
}
</script>

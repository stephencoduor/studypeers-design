

<section class="mainContent msgActive">
    <div class="main_subheader">
        <div class="main_subheaderLeft " style="padding-top: 20px;padding-bottom: 15px">
            <a href="<?/*= $_SERVER['HTTP_REFERER']; */?>">
                <svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490"
                     style="enable-background:new 0 0 490 490;" xml:space="preserve">
									<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
										l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
										c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
				</svg>
                Back
            </a>
        </div>
    </div>

    <div class="commoncard" id="writeboxes" style="margin-top: 40px">

        <div class="answer-result wrong">
            <h3>
                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                    <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                </svg>
                Title : <?= $discussion['title'];?>
            </h3>
            <h6>Description</h6>
            <div class="answer-result__card-desc">
                <?= $discussion['message'];?>
            </div>
            <!--<h6>
                <svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
										C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
										h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
                    <path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
										c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
                </svg>
                Correct answer
            </h6>
            <p class="correct-dark-color">
                You are training a new dynamics 365 Finance developer. You need to explain the relationships between
                models, packages, and projects to the new hire. Which three design concepts should you explain? Each
                correct answer presents a complete solution.
            </p>-->
            <h6>Due at</h6>
            <div class="you-said">
<!--                Due At: --><?//= $quiz['due_at'];?>
            </div>
        </div>
    </div>

</section>
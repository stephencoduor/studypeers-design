<section class="mainContent msgActive">
    <div class="studySetWrapper list qa-detail">
        <div class="subheader_top">
            <div class="main_subheaderLeft">
                <a href="<?=$_SERVER['HTTP_REFERER'];?>">
                    <svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
                    Back
                </a>
                <br>
            </div>
        </div>

        <div class="voteHeaderWrapper">

            <div class="rightHdrWrapper">
                <h4>
                    Title : <?= $notification['subject'];?>
                </h4>

            </div>
        </div>
        <div class="header">
            <div class="timeperiod">
                <ul>
                    <li>
                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path></svg> 1 Answers
                    </li>
                    <li>
                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                            <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                        </svg> 4 Views
                    </li>
                    <li>
<!--                        Due At: --><?//= $quiz['due_at'];?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="detailDescription">
          Notification subject  <?= $notification['subject'];?>
          Notification date  <?= $notification['start_at'];?>
        </div>
    </div>
</section>
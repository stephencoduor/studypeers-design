<!DOCTYPE html>
<html>

<head>
	<title><?= $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/nice-select.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/search-page.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/jquery.mCustomScrollbar.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<?php if ($index_menu == 'dashboard') { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/slick.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/slick-theme.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/dashboard-new.css">
	<?php } ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/star-rating-svg.css">
	<!-- <link href='<?php echo base_url(); ?>assets_d/css/fullCalendar.css' rel='stylesheet' /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" integrity="sha512-KXkS7cFeWpYwcoXxyfOumLyRGXMp7BTMTjwrgjMg0+hls4thG2JGzRgQtRfnAuKTn2KWTDZX4UdPg+xTs8k80Q==" crossorigin="anonymous" />
	<?php if ($index_menu != 'questions' && $index_menu != 'dashboard' && $index_menu != 'timeline') { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/study-set.css">
	<?php } ?>
	<?php if ($index_menu != 'documents' && $index_menu != 'questions' && $index_menu != 'study-sets' && $index_menu != 'dashboard' && $index_menu != 'timeline') { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/schedule.css">
	<?php } ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/jquery.emojipicker.css">
	<?php if ($index_menu == 'dashboard') { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/jquery.emojipicker.tw.css">

	<?php } ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/university.css">
	<?php if ($index_menu != 'questions' && $index_menu != 'study-sets' && $index_menu != 'events' && $index_menu != 'dashboard' && $index_menu != 'timeline') { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/document.css">
	<?php } ?>

	<?php if ($index_menu == 'timeline') { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/profile.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/loader.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/croppie.css">

	<?php } ?>

	<!-- Emoji Data -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/jquery.emojipicker.tw.css">

	<script src="<?php echo base_url(); ?>assets_d/js/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets_d/css/bootstrap-select.css'); ?>">

	<?php if ($index_menu == 'questions') { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_d/css/qa.css">
		<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
		<!-- <script src="https://cdn.ckeditor.com/4.14.1/standard-all/ckeditor.js"></script> -->
		<!-- <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/jquery-te-1.4.0.css"> -->

	<?php } ?>

	<link rel="stylesheet" href="<?php echo base_url('assets_d/css/fm.selectator.jquery.css'); ?>">

	<link rel="stylesheet" href="<?php echo base_url('assets_d/js/emojionearea-master/dist/emojionearea.min.css'); ?>">

	<link rel="stylesheet" href="<?php echo base_url('assets_d/css/chat.css'); ?>">

	<script src="<?php echo base_url('assets_d/js/socket-config.js'); ?>"></script>

	<script src="<?php echo base_url('assets_d/js/moment.js'); ?>"></script>

	<script src="<?php echo base_url('assets_d/js/socket.io.js'); ?>"></script>







</head>

<?php
$user_id = $this->session->get_userdata()['user_data']['user_id'];
$get_course = $this->db->get_where('course_master', array('user_id' => $user_id, 'status' => 1))->result_array();

$notification = $this->db->get_where('notification_master', array('user_id' => $user_id, 'status' => 1))->result_array();

$this->db->order_by('id', 'DESC');
$this->db->limit('10');
$last_notification = $this->db->get_where('notification_master', array('user_id' => $user_id, 'status!=' => 3))->result_array();
?>

<body class="fancy-scrollbar">
	<div class="ajax-loading">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
			<g>
				<path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ea2e7e" stroke-width="12"></path>
				<path d="M49 3L49 27L61 15L49 3" fill="#ea2e7e"></path>
				<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
			</g>
		</svg>
	</div>
	<input type="hidden" id="hidden_user_info" value='<?php echo json_encode($this->session->get_userdata()['user_data']); ?>'>
	<header>
		<section class="container-fluid">
			<section class="row">
				<section class="col-md-2 col-sm-12 no-padding">
					<section class="logo">
						<a href="javasscript:void(0)">
							<svg class="logoDesktop" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 137 32">
								<defs>
									<linearGradient id="a" x1=".1162068" x2="5.5746055" y1="26.7855835" y2="21.3271847" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#1ae2bc"></stop>
										<stop offset=".2500862" stop-color="#1adec0"></stop>
										<stop offset=".5003659" stop-color="#19d2cc"></stop>
										<stop offset=".7502075" stop-color="#19bfe0"></stop>
										<stop offset="1" stop-color="#18a3fc"></stop>
									</linearGradient>
									<linearGradient id="b" x1="38.0227661" x2="43.4706383" y1="12.0002193" y2="17.4480934" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#f24c78"></stop>
										<stop offset=".0502992" stop-color="#f35378"></stop>
										<stop offset=".3300291" stop-color="#f87877"></stop>
										<stop offset=".5903254" stop-color="#fb9376"></stop>
										<stop offset=".8215525" stop-color="#fda375"></stop>
										<stop offset="1" stop-color="#fea975"></stop>
									</linearGradient>
									<linearGradient id="c" x1="0" x2="37.7988319" y1="17.1994781" y2="17.1994781" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#42f1cc"></stop>
										<stop offset=".0832457" stop-color="#30d0e1"></stop>
										<stop offset=".1926671" stop-color="#159eff"></stop>
										<stop offset=".3235199" stop-color="#425ffe"></stop>
										<stop offset=".4293851" stop-color="#4440db"></stop>
										<stop offset=".5305977" stop-color="#3632b3"></stop>
										<stop offset=".5843888" stop-color="#2d2b95"></stop>
										<stop offset=".65" stop-color="#242375"></stop>
										<stop offset=".7805882" stop-color="#2e175c"></stop>
										<stop offset=".9" stop-color="#37145c"></stop>
										<stop offset=".9351292" stop-color="#41175b"></stop>
										<stop offset="1" stop-color="#4f1c59"></stop>
									</linearGradient>
									<linearGradient id="d" x1="16.2746601" x2="43.6916924" y1="7.8086429" y2="7.8086429" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#7333a3"></stop>
										<stop offset=".25" stop-color="#b4208b"></stop>
										<stop offset=".5" stop-color="#ee2e7d"></stop>
										<stop offset=".579803" stop-color="#f14579"></stop>
										<stop offset=".75" stop-color="#f87372"></stop>
										<stop offset=".8891253" stop-color="#fc9674"></stop>
										<stop offset="1" stop-color="#ffae75"></stop>
									</linearGradient>
									<linearGradient id="e" x1="5.8033156" x2="22.4205818" y1="27.3743019" y2="27.3743019" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#1993bf"></stop>
										<stop offset=".0594379" stop-color="#1c76aa"></stop>
										<stop offset=".1374016" stop-color="#205895"></stop>
										<stop offset=".2194426" stop-color="#234084"></stop>
										<stop offset=".3063478" stop-color="#242f77"></stop>
										<stop offset=".4013133" stop-color="#262570"></stop>
										<stop offset=".5195531" stop-color="#26226e"></stop>
										<stop offset="1" stop-color="#2a234f"></stop>
									</linearGradient>
								</defs>
								<path fill="url(#a)" d="M1.5562831 18.405426v9.8202343l2.5899323 1.4699974.0043235-9.7925396z"></path>
								<path fill="url(#b)" d="M39.453968 10.5690184v9.8038892l2.5856057-1.4937496V9.0755424z"></path>
								<path fill="url(#c)" d="M32.1692467 17.0857029c-1.3517799.7733688-3.0124893.7710476-4.3621044-.0060978l-12.723919-7.3224335c-.846221-.4869881-1.8877211-.4865875-2.7335663.0010519L.2739652 16.719986c-.365234.2107372-.3653002.7378521-.0001191.9486809l12.0749931 6.9712276c.8462439.4885616 1.8887024.489172 2.7355194.0016041l8.2535849-4.7521305 2.0155659 1.1652489.9853535.5700626c2.2555218 1.3049011 5.0354786 1.3090191 7.294857.0108032l1.0375748-.59618 3.1275368-1.810297-.009243-5.3507776-5.6203418 3.2074747z"></path>
								<path fill="url(#d)" d="M28.6170769.3666457L16.5485764 7.3317189c-.3651581.2107439-.3652382.7377572-.0001431.9486117l12.0684032 6.9698944c.8474731.4894428 1.8917255.4894123 2.7391701-.0000811l12.0619431-6.9671135c.364994-.210824.364994-.7376714 0-.9484959L31.3555279.3671418c-.8471871-.4893451-1.8910866-.4895342-2.738451-.0004961z"></path>
								<path fill="url(#e)" d="M22.4205818 22.7486038l-6.4205513 3.7115173c-1.4128876.8197079-3.156126.8218288-4.5710058.0055637l-5.6257091-3.2455616.0103588 5.3410664 3.2668357 1.8886375.9892797.5713425c2.2436085 1.2957592 5.0058241 1.3056583 7.2586632.0260162l1.027153-.5834351 4.0513592-2.3494816.0136166-5.3656653z"></path>
								<g>
									<path fill="#2a234f" d="M51.6496582 21.8836918c.5789299 0 1.0008926-.0692368 1.2663612-.2078991.2651863-.1386623.3979683-.3769112.3979683-.7147465 0-.3133659-.1418877-.57267-.4250908-.777914-.2835846-.2048645-.7507896-.4279366-1.4020844-.6694107-.3980637-.1447334-.762928-.2983799-1.0945053-.4613228-.3318596-.1627522-.6182899-.3526306-.8593826-.5698242-.2413788-.2170048-.4313507-.4793434-.5698242-.7870197-.138855-.3074837-.2080879-.684206-.2080879-1.1305428 0-.8683949.3194351-1.5529814.9588737-2.0535698.639061-.5002089 1.5074577-.7507877 2.6050911-.7507877.5546494 0 1.0854912.0515957 1.5920563.1538382.5065613.1026211.8865089.2020178 1.1397438.2985697l-.3979683 1.7730198c-.2414742-.1086922-.5489578-.2080889-.9226456-.2985706-.3740654-.0904808-.8081665-.1358166-1.3025894-.1358166-.4463387 0-.8081703.0754957-1.085495.2262983-.2776108.1509924-.4160805.3829813-.4160805.6965361 0 .1568737.0271225.295536.0813751.415987.0542526.1208324.1475792.2323704.2804527.3348007.1324997.102623.3074875.2052441.5245857.3074856.2170982.1026211.4822845.2080879.7960281.3165913.5184174.1931019.9588776.3829803 1.3207054.5698242.3618317.1872215.6603088.3981552.8955231.6331806.2352142.2352142.4070702.5038128.5155716.8052273.1085968.3016052.1628494.6633415.1628494 1.0853996 0 .9046249-.3347054 1.5892105-1.0041161 2.0533791-.6693192.4641685-1.6253471.696537-2.8674278.696537-.8322601 0-1.5015755-.0696163-2.0081406-.2080898-.5065651-.1384716-.8625145-.2501984-1.067379-.33461l.3798523-1.8272705c.325695.132782.714653.2594948 1.1669655.3799458.4522173.1206415.9678843.1807745 1.5468142.1807745zm4.884388-10.637064l2.1891022-1.2232981v3.9725389h3.3649826v1.8272705h-3.3649826v3.8535252c0 .7598915.1203575 1.3025913.3618317 1.6280975.2410927.325695.6512947.4886379 1.2301292.4886379.3980637 0 .7507896-.0421124 1.0583687-.1267128.307579-.0842209.5518036-.1627522.7326736-.2352142l.3618279 1.7367897c-.253231.1085014-.5850945.2202282-.9950104.33461-.4101067.1145725-.8926735.1718578-1.4473228.1718578-.6755753 0-1.2392349-.090292-1.6914558-.2712536-.4523125-.1809635-.8112984-.4433022-1.0764809-.7870178-.2654686-.3437176-.4523125-.7598934-.5608139-1.2483425-.1085968-.4884472-.1628494-1.0461311-.1628494-1.6734314v-8.4480571zm14.8892326 11.9216347c-.4222488.1085014-.9712067.2202282-1.6464996.33461-.675293.1145725-1.4173508.1718578-2.2250443.1718578-.7598953 0-1.3962097-.1085014-1.9086533-.3255043-.5128174-.2171936-.9227371-.5184193-1.2302246-.9046249-.307579-.385828-.5278053-.8471508-.6604004-1.3839684-.132782-.5364399-.1989822-1.1244755-.1989822-1.763916v-5.300848h2.1891022v4.9571323c0 1.0131283.1474838 1.7367897.4432068 2.1709862.2954407.4341984.8109207.6512012 1.5469131.6512012.2651825 0 .5455399-.0117607.8410797-.0362301.2955322-.023901.5155716-.0542507.6604919-.090292v-7.6527977h2.1890106v9.1723939zm9.7871704 0c-.4341965.132782-.9799271.2532349-1.6371994.3617363-.6574631.1086922-1.3479309.1629429-2.0715942.1629429-.7479401 0-1.4173508-.1147633-2.0080414-.3437157-.5910721-.2289543-1.0945053-.5576859-1.5106812-.986002-.4159851-.4279385-.7358017-.9467354-.9588776-1.5558262-.223259-.6089001-.33461-1.2936764-.33461-2.0533791 0-.7477531.0933304-1.4260788.280365-2.0353603.1868439-.6089001.461319-1.1305437.8232422-1.56493.3617401-.4341974.8020096-.7688084 1.3206177-1.0040226.5184174-.2352133 1.1153641-.3528204 1.7910385-.3528204.4582901 0 .8621368.0542507 1.2121124.1627531.3497849.1086912.6513901.2293329.9046249.3619251v-3.6296692l2.189003-1.2730227v13.7493908zm-6.2777405-4.4684944c0 .9649448.2289505 1.7218037.6876144 2.2703819.4580994.5489597 1.0912857.8232498 1.8995438.8232498.3495941 0 .6481705-.014986.8955231-.0453358.2469711-.0299721.4491806-.0633564.6060562-.0993977v-5.4275608c-.1931076-.1325912-.4495621-.2560797-.7689972-.370841-.3196259-.1143818-.6603088-.1718578-1.022049-.1718578-.7961197 0-1.3780823.2714443-1.7458878.8141432-.3679961.5426998-.5518035 1.2785015-.5518035 2.2072182zm16.4268418-4.7038994c-.9751892 3.5944099-2.1070633 6.8507938-3.3948593 9.7693443-.2414703.5428886-.4890137 1.0070553-.74263 1.3930721-.2536163.385828-.537384.7056427-.8511353.9588757-.3141174.2532349-.6642838.4370441-1.0504913.5518055-.3863983.1143818-.8329239.1718578-1.3401489.1718578-.338028 0-.6732101-.0362301-1.0051651-.1085014-.3321381-.0724621-.5825272-.1509933-.7515411-.2352142l.3979645-1.7548103c.4360962.1686344.8663101.2532349 1.290451.2532349.5692596 0 1.0144577-.1358166 1.3356018-.4070721.3211365-.2714443.6026382-.6906567.8452454-1.2574463-.6906509-1.3264923-1.3538055-2.7738171-1.98983-4.3417816-.6360245-1.5677776-1.2022476-3.232295-1.6986618-4.9933643h2.333931c.1208267.5066586.2689743 1.0556173.4448166 1.6464977.1756516.5908794.366478 1.1910553.5721054 1.7999554.2058105.6092796.4235687 1.2153339.6536636 1.8181648.2300949.6032104.4601822 1.1641197.6902771 1.682539.3841171-1.0732594.744339-2.2161331 1.080658-3.4282436.3361282-1.2121105.6422806-2.3851442.9184723-3.5189133h2.2612761zm10.2940216 4.7038994c0 .7358017-.090477 1.4052124-.2714462 2.0080433-.1807709.6032104-.4463348 1.1216278-.795929 1.5558262-.3499756.4341965-.7841721.7720318-1.302597 1.0131264-.5186081.2410946-1.1157455.361927-1.7910385.361927-.3740616 0-.7236633-.036232-1.0493546-.1086922-.3255081-.0722713-.6394424-.1745148-.9406662-.3074856v3.5820808h-2.6956635V14.267313c.2410889-.0724611.5184174-.1416969.8321609-.2080879.3135529-.0662022.6422882-.1234875.9860001-.1718578.3437195-.0479918.6935043-.0874472 1.0493622-.1176071.3556671-.0299711.6965332-.045146 1.0222321-.045146.7837906 0 1.4833603.1174173 2.098526.3526306.6151581.2352142 1.1335754.5671692 1.5558243.9951067.4220581.4283171.7445297.9497719.9679794 1.5649319.2228851.6151599.33461 1.3025912.33461 2.0624847zm-2.7499161.0722713c0-.8321648-.1870346-1.4985409-.5607224-1.9991283-.3740616-.5002098-.9289017-.7507877-1.6645126-.7507877-.2412872 0-.4643555.0091038-.6694107.0271244-.205246.0182114-.3738785.0392666-.5064697.0633564v4.8666515c.1688232.1085014.3888626.1989822.6603088.2712536.2714386.0724621.5455399.1086922.8232422.1086922 1.278122-1e-7 1.9175644-.8623238 1.9175644-2.5871621zm3.7448349 0c0-.8441143.129364-1.5829525.3888626-2.2161331.2593002-.6331806.5999832-1.1607046 1.0222321-1.5831413.4220581-.4220572.9074707-.7416821 1.4564285-.9586859.5485764-.2171936 1.1125259-.325696 1.691452-.325696 1.3505859 0 2.4179611.4131422 3.2021332 1.2392359.7839813.8262835 1.1760712 2.0416193 1.1760712 3.6454363 0 .1568718-.0062637.3287296-.0182114.5155735-.0121384.1872234-.0242767.3528214-.036232.4975529h-6.1147995c.0601273.5548401.3194351.9951077.7779083 1.320612.4582901.3256969 1.0732651.4884491 1.8452911.4884491.4945221 0 .979744-.045145 1.4564285-.1356277.4763107-.0904808.8651733-.201828 1.1669693-.33461l.3617325 2.1890068c-.1447296.0722713-.3378296.1447315-.5789261.2170029-.241478.0724621-.509697.1358166-.8050385.1900692-.295723.0542507-.6123123.0993958-.9497757.1356258-.3378296.036232-.6756668.0542526-1.0131226.0542526-.856636 0-1.6011658-.126524-2.2343445-.3799477-.6331787-.253233-1.1578598-.5997944-1.5738449-1.0402527-.4161758-.4400768-.7236633-.9615307-.9226456-1.5647411-.1991727-.6030198-.2985685-1.2544099-.2985685-1.9539815zm6.3319931-1.0311489c-.0121384-.2289543-.0514069-.4524059-.1176071-.6694107-.066391-.2171936-.169014-.4099159-.3076706-.5789299-.1386642-.1688232-.3137512-.3074856-.5244904-.4161758-.2113113-.1085024-.4736557-.1627531-.7870178-.1627531-.3016052 0-.5609131.051405-.777916.1538382-.2171936.1026211-.3979645.2382488-.5426941.4070702-.1447372.169014-.2564621.3649616-.3348007.5878448-.078537.2234535-.1356277.4495621-.1718597.6785164h3.5640564zm3.4191361 1.0311489c0-.8441143.1293716-1.5829525.3888626-2.2161331.2593079-.6331806.5999908-1.1607046 1.0222321-1.5831413.4220581-.4220572.9074707-.7416821 1.4564285-.9586859.548584-.2171936 1.1125259-.325696 1.6914597-.325696 1.3505783 0 2.4179611.4131422 3.2021332 1.2392359.7839813.8262835 1.1760635 2.0416193 1.1760635 3.6454363 0 .1568718-.0062561.3287296-.0182037.5155735-.012146.1872234-.0242844.3528214-.036232.4975529h-6.1148071c.0601349.5548401.3194351.9951077.777916 1.320612.4582901.3256969 1.0732574.4884491 1.8452911.4884491.4945145 0 .979744-.045145 1.4564285-.1356277.4763107-.0904808.8651733-.201828 1.1669617-.33461l.3617401 2.1890068c-.1447296.0722713-.3378372.1447315-.5789337.2170029-.2414703.0724621-.5096893.1358166-.8050385.1900692-.295723.0542507-.6123123.0993958-.9497681.1356258-.3378372.036232-.6756668.0542526-1.0131302.0542526-.8566284 0-1.6011581-.126524-2.2343369-.3799477-.6331787-.253233-1.1578598-.5997944-1.5738449-1.0402527-.4161835-.4400768-.7236633-.9615307-.9226456-1.5647411-.199173-.6030198-.2985763-1.2544099-.2985763-1.9539815zm6.3320007-1.0311489c-.0121384-.2289543-.0514069-.4524059-.1176071-.6694107-.066391-.2171936-.169014-.4099159-.3076782-.5789299-.1386642-.1688232-.3137436-.3074856-.5244904-.4161758-.2113113-.1085024-.4736481-.1627531-.7870178-.1627531-.3016052 0-.5609055.051405-.7779083.1538382-.2171936.1026211-.3979721.2382488-.5427017.4070702-.1447296.169014-.2564621.3649616-.3348007.5878448-.0785294.2234535-.1356277.4495621-.1718597.6785164h3.5640639zm9.6968765-1.4110928c-.2414703-.0603218-.5246735-.1236763-.8503723-.1900673-.3256912-.0660133-.6754761-.0993977-1.0493546-.0993977-.169014 0-.370842.0151749-.6060562.045145-.2350235.0303516-.4131393.0633564-.5335922.0995865v7.2726631h-2.6956635v-9.0096407c.4821854-.1686335 1.0522003-.328351 1.7096634-.4793434.6572723-.1506128 1.3898468-.2261086 2.1981125-.2261086.1447296 0 .3194351.0091047.5246735.0271254.2048645.0180206.4099197.04249.6151657.0722713.2048569.0303497.409729.0665808.6149597.1086912.2050629.0423002.3799591.0935163.5246887.1536484l-.4522247 2.2254268zm4.0887451 5.1921578c.4943237 0 .8439178-.0479927 1.0491638-.1447334.2050476-.0963612.3076782-.283205.3076782-.5609093 0-.2170029-.1329803-.4070721-.3981628-.5698242-.2653656-.1627522-.66922-.3465614-1.2121124-.5518036-.4222412-.1564941-.8050385-.319437-1.1487427-.4884491-.3437195-.1688232-.6362152-.370842-.8773193-.6060543-.2414703-.2352142-.4283142-.5155754-.5608978-.8412704-.132782-.325695-.1989899-.7174015-.1989899-1.1758785 0-.8924856.3315735-1.5981274.9949188-2.1167364.663147-.5184183 1.5740356-.7779131 2.7318878-.7779131.5789337 0 1.1335907.0514059 1.6643372.1536484.5305481.1026211.9526062.2143478 1.2663574.3347998l-.4702454 2.0987158c-.313736-.1086922-.6544189-.2050533-1.0222321-.289465-.367981-.0844116-.7809448-.1267118-1.2392273-.1267118-.8442993 0-1.2663574.2352133-1.2663574.7056417 0 .1085014.0180206.2050533.054245.2892742.0362244.0846024.1085052.1659775.2170105.2443199.1086884.0785313.2562714.1633205.4432983.2543716.1868439.0914307.4250946.1917763.7145538.3008461.5908813.2190914 1.0793304.4349556 1.4655304.6475964.3858337.2128315.6902771.4427338.9135437.6891403.2230835.2467842.3799438.5206947.4704285.8215408.0904846.3006573.1356354.6498737.1356354 1.0467014 0 .9387703-.352829 1.6487732-1.0582733 2.1302032-.7056427.4812412-1.7037964.7219563-2.9942474.7219563-.8442993 0-1.5467072-.0722713-2.1076202-.2170048-.56073-.1447315-.9497681-.2651844-1.1667786-.3619251l.4522247-2.1890068c.4582825.1809616.9285126.3228493 1.411087.4250908.4821931.102623.9588777.1538391 1.4293061.1538391z"></path>
								</g>
							</svg>
							<svg class="logoMobile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43.69 32">
								<defs>
									<linearGradient id="Gradient-1" x1=".1162068" x2="5.5746055" y1="26.7855835" y2="21.3271847" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#1ae2bc"></stop>
										<stop offset=".2500862" stop-color="#1adec0"></stop>
										<stop offset=".5003659" stop-color="#19d2cc"></stop>
										<stop offset=".7502075" stop-color="#19bfe0"></stop>
										<stop offset="1" stop-color="#18a3fc"></stop>
									</linearGradient>
									<linearGradient id="Gradient-2" x1="38.0227661" x2="43.4706383" y1="12.0002193" y2="17.4480934" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#f24c78"></stop>
										<stop offset=".0502992" stop-color="#f35378"></stop>
										<stop offset=".3300291" stop-color="#f87877"></stop>
										<stop offset=".5903254" stop-color="#fb9376"></stop>
										<stop offset=".8215525" stop-color="#fda375"></stop>
										<stop offset="1" stop-color="#fea975"></stop>
									</linearGradient>
									<linearGradient id="Gradient-3" x1="0" x2="37.7988319" y1="17.1994781" y2="17.1994781" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#42f1cc"></stop>
										<stop offset=".0832457" stop-color="#30d0e1"></stop>
										<stop offset=".1926671" stop-color="#159eff"></stop>
										<stop offset=".3235199" stop-color="#425ffe"></stop>
										<stop offset=".4293851" stop-color="#4440db"></stop>
										<stop offset=".5305977" stop-color="#3632b3"></stop>
										<stop offset=".5843888" stop-color="#2d2b95"></stop>
										<stop offset=".65" stop-color="#242375"></stop>
										<stop offset=".7805882" stop-color="#2e175c"></stop>
										<stop offset=".9" stop-color="#37145c"></stop>
										<stop offset=".9351292" stop-color="#41175b"></stop>
										<stop offset="1" stop-color="#4f1c59"></stop>
									</linearGradient>
									<linearGradient id="Gradient-4" x1="16.2746601" x2="43.6916924" y1="7.8086429" y2="7.8086429" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#7333a3"></stop>
										<stop offset=".25" stop-color="#b4208b"></stop>
										<stop offset=".5" stop-color="#ee2e7d"></stop>
										<stop offset=".579803" stop-color="#f14579"></stop>
										<stop offset=".75" stop-color="#f87372"></stop>
										<stop offset=".8891253" stop-color="#fc9674"></stop>
										<stop offset="1" stop-color="#ffae75"></stop>
									</linearGradient>
									<linearGradient id="Gradient-5" x1="5.8033156" x2="22.4205818" y1="27.3743019" y2="27.3743019" gradientUnits="userSpaceOnUse">
										<stop offset="0" stop-color="#1993bf"></stop>
										<stop offset=".0594379" stop-color="#1c76aa"></stop>
										<stop offset=".1374016" stop-color="#205895"></stop>
										<stop offset=".2194426" stop-color="#234084"></stop>
										<stop offset=".3063478" stop-color="#242f77"></stop>
										<stop offset=".4013133" stop-color="#262570"></stop>
										<stop offset=".5195531" stop-color="#26226e"></stop>
										<stop offset="1" stop-color="#2a234f"></stop>
									</linearGradient>
								</defs>
								<title>studypeers</title>
								<g id="Mark">
									<path fill="url(#Gradient-1)" d="M1.5562831 18.405426v9.8202343l2.5899323 1.4699974.0043235-9.7925396z"></path>
									<path fill="url(#Gradient-2)" d="M39.453968 10.5690184v9.8038892l2.5856057-1.4937496V9.0755424z"></path>
									<path fill="url(#Gradient-3)" d="M32.1692467 17.0857029c-1.3517799.7733688-3.0124893.7710476-4.3621044-.0060978l-12.723919-7.3224335c-.846221-.4869881-1.8877211-.4865875-2.7335663.0010519L.2739652 16.719986c-.365234.2107372-.3653002.7378521-.0001191.9486809l12.0749931 6.9712276c.8462439.4885616 1.8887024.489172 2.7355194.0016041l8.2535849-4.7521305 2.0155659 1.1652489.9853535.5700626c2.2555218 1.3049011 5.0354786 1.3090191 7.294857.0108032l1.0375748-.59618 3.1275368-1.810297-.009243-5.3507776-5.6203418 3.2074747z"></path>
									<path fill="url(#Gradient-4)" d="M28.6170769.3666457L16.5485764 7.3317189c-.3651581.2107439-.3652382.7377572-.0001431.9486117l12.0684032 6.9698944c.8474731.4894428 1.8917255.4894123 2.7391701-.0000811l12.0619431-6.9671135c.364994-.210824.364994-.7376714 0-.9484959L31.3555279.3671418c-.8471871-.4893451-1.8910866-.4895342-2.738451-.0004961z"></path>
									<path fill="url(#Gradient-5)" d="M22.4205818 22.7486038l-6.4205513 3.7115173c-1.4128876.8197079-3.156126.8218288-4.5710058.0055637l-5.6257091-3.2455616.0103588 5.3410664 3.2668357 1.8886375.9892797.5713425c2.2436085 1.2957592 5.0058241 1.3056583 7.2586632.0260162l1.027153-.5834351 4.0513592-2.3494816.0136166-5.3656653z"></path>
								</g>
							</svg>
						</a>
						<button type="button" class="desktopToggleButton">
							<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
								<path d="M465.5,343h-441C11,343,0,354,0,367.5S11,392,24.5,392h441c13.5,0,24.5-11,24.5-24.5S479,343,465.5,343z"></path>
								<path d="M465.5,220.5h-441C11,220.5,0,231.5,0,245s11,24.5,24.5,24.5h441c13.5,0,24.5-11,24.5-24.5S479,220.5,465.5,220.5z"></path>
								<path d="M24.5,147h441c13.5,0,24.5-11,24.5-24.5S479,98,465.5,98h-441C11,98,0,109,0,122.5S11,147,24.5,147z"></path>
							</svg>
						</button>
					</section>
				</section>
				<section class="col-md-10 col-sm-12 no-padding">
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

						</div>
						<div class="collapse navbar-collapse" id="example-navbar-collapse">
							<ul class="nav navbar-nav pull-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa  fa-bell-o"></i>
										<span class="label label-success" id="notification_count"><?php echo count($notification); ?></span>
									</a>
									<div class="dropdown-menu notification">
										<div class="notification-header">
											<h6>Notifications</h6>
											<a onclick="readAllNotofication()">Mark as all read</a>
										</div>
										<ul class="notification-ul" id="notification-ul">
											<?php if (!empty($last_notification)) {
												foreach ($last_notification as $key => $value) {
													$time_ago = time_ago_in_php($value['created_at']);
													$cls = "";
													if ($value['status'] == '2') {
														$cls = "read";
													}
													if ($value['action_type'] == 1) {
											?>

														<li id="notification_<?= $value['id']; ?>" class="<?= $cls; ?>">
															<a>
																<figure>
																	<img src="<?php echo userImage($value['img_user_id']); ?>" alt="user">
																</figure>
																<div class="right">
																	<h6><?php echo $value['notification']; ?></h6>
																	<div class="sortNotifyMessage">
																		<div class="info">
																			<div>Follower •</div>
																			<div class="time"><?php echo $time_ago; ?></div>
																		</div>
																		<div class="optPreview">
																			<?php if ($value['status'] == 1) { ?>
																				<div class="viewacceptance" id="accept_<?= $value['id']; ?>" onclick="acceptRequest('<?= $value['id']; ?>', '<?= $value['action_id']; ?>')">Accept</div>
																				<div class="viewprofile" id="reject_<?= $value['id']; ?>" onclick="rejectRequest('<?= $value['id']; ?>', '<?= $value['action_id']; ?>')">Reject</div>
																				<!-- <div class="viewprofile">View Profile</div> -->
																			<?php } ?>
																		</div>
																	</div>
																</div>
															</a>
														</li>
													<?php } else if ($value['action_type'] == 2) { ?>
														<li id="notification_<?= $value['id']; ?>" class="<?= $cls; ?>">
															<a>
																<figure>
																	<img src="<?php echo userImage($value['img_user_id']); ?>" alt="user">
																</figure>
																<div class="right">
																	<h6><?php echo $value['notification']; ?></h6>
																	<div class="sortNotifyMessage">
																		<div class="info">
																			<div>Follower • </div>
																			<div class="time"><?php echo $time_ago; ?></div>
																		</div>
																		<div class="optPreview">

																			<div class="viewprofile">View Profile</div>
																		</div>
																	</div>
																</div>
															</a>
														</li>

													<?php } else if ($value['action_type'] == 3) { ?>
														<li id="notification_<?= $value['id']; ?>" class="<?= $cls; ?>">
															<a>
																<figure>
																	<img src="<?php echo userImage($value['img_user_id']); ?>" alt="user">
																</figure>
																<div class="right">
																	<h6><?php echo $value['notification']; ?></h6>
																	<div class="sortNotifyMessage">
																		<div class="info">
																			<div>Studyset • </div>
																			<div class="time"><?php echo $time_ago; ?></div>
																		</div>
																		<div class="viewprofile" onclick="redirectAction('<?= $value['id']; ?>')">View Studyset</div>
																	</div>
																</div>
															</a>
														</li>
													<?php } else if ($value['action_type'] == 4) { ?>
														<li id="notification_<?= $value['id']; ?>" class="<?= $cls; ?>">
															<a>
																<figure>
																	<img src="<?php echo userImage($value['img_user_id']); ?>" alt="user">
																</figure>
																<div class="right">
																	<h6><?php echo $value['notification']; ?></h6>
																	<div class="sortNotifyMessage">
																		<div class="info">
																			<div>Event •</div>
																			<div class="time"><?php echo $time_ago; ?></div>
																		</div>
																		<div class="viewprofile" onclick="redirectAction('<?= $value['id']; ?>')">View Event</div>
																	</div>
																</div>
															</a>
														</li>
													<?php } ?>

												<?php }
											} else { ?>
												<li>
													<p style="text-align: center;">No notification.</p>
												</li>
											<?php } ?>
										</ul>
									</div>
								</li>


								<li class="message dropdown">
									<a href="javascript:void(0)" class="show-chat-dropdown">
										<div class="messageBox">
											<img src="<?php echo base_url(); ?>assets_d/images/message.svg" alt="chat" id="message_icon_id">
										</div>
										<span class="label label-success" id="chat_message_count"></span>
									</a>

									<div class="chat-dropdown" id="show_top_header">
										<div class="chat-dropdown-header">
											<div class="left-area">
												Messages <span class="total-message">(00)</span>
											</div>
											<div class="right-area">
												<a href="javascript:void(0)" class="open-chat"><img src="<?php echo base_url(); ?>assets_d/images/maximize.svg" alt="Maximize Icon" /></a>
												<!-- <a href="javascript:void(0)" class="open-start-conversation"><img src="<?php echo base_url(); ?>assets_d/images/new_message.svg" alt="New Message" /></a> -->
											</div>
										</div>
										<div class="chat-body-wrap">
											<div class="search-list">
												<button type="submit" class="searchBtn">
													<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
														<path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
													s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
													c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
													</svg>
												</button>
												<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Find conversations" class="form-control">
											</div>
											<div class="chat-user-list">
												<ul id="myUL">

												</ul>
												<div class="loader-wrap" id="message_top_loader">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
														<g>
															<path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ea2e7e" stroke-width="12"></path>
															<path d="M49 3L49 27L61 15L49 3" fill="#ea2e7e"></path>
															<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
														</g>
													</svg>
												</div>
											</div>
										</div>
										<div class="see-all">
											<a href="javascript:void(0);">See All</a>
										</div>
									</div>

								</li>


								<li class="user" title="<?php
														$userdata = $this->session->userdata('user_data');
														$user_detail    = $this->db->get_where('user', array('id' => $userdata['user_id']))->row_array();
														$full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
														echo $full_name;
														?>">
									<?php
									$userdata = $this->session->userdata('user_data');
									$user_detail    = $this->db->get_where('user', array('id' => $userdata['user_id']))->row_array();
									$full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
									echo $full_name;
									?>
								</li>
								<li class="dropdown show-dropdown">
									<a href="#" class="header-user-img">
										<figure>
											<img src="<?php echo userImage($userdata['user_id']); ?>" alt="User">
										</figure>
										<div class="dropIcon" style="float: right;margin-top: 10px;">
											<i class="fa fa-angle-down" aria-hidden="true"></i>
										</div>
									</a>
									<ul class="dropdown-area">
										<li><a href="<?php echo base_url(); ?>Profile/timeline"><i class="fa fa-user"></i>My profile</a></li>
										<!-- <li><a href="javascript:void(0);"><i class="fa fa-globe"></i>Connections <span class="totalBadge pull-right">29</span></a></li>
										<li><a href="javascript:void(0);"><i class="fa fa-male"></i>Peers</a></li> -->
										<li><a href="<?php echo base_url(); ?>Account/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
									</ul>
								</li>
							</ul>
							<div class="search">
								<div class="searchIcon">
									<img src="<?php echo base_url(); ?>assets_d/images/search.png" alt="search">
								</div>
								<input type="text" id="search-info">
								<div class="removeSearch">
									<img src="<?php echo base_url(); ?>assets_d/images/close.svg" alt="close">
								</div>
								
							</div>
						</div>
					</nav>
					<button type="button" class="navbar-brand-icon">
						<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
							<path d="M465.5,343h-441C11,343,0,354,0,367.5S11,392,24.5,392h441c13.5,0,24.5-11,24.5-24.5S479,343,465.5,343z"></path>
							<path d="M465.5,220.5h-441C11,220.5,0,231.5,0,245s11,24.5,24.5,24.5h441c13.5,0,24.5-11,24.5-24.5S479,220.5,465.5,220.5z"></path>
							<path d="M24.5,147h441c13.5,0,24.5-11,24.5-24.5S479,98,465.5,98h-441C11,98,0,109,0,122.5S11,147,24.5,147z"></path>
						</svg>
					</button>
				</section>
			</section>
		</section>
	</header>
	<section class="dashbody">
		<section class="container-fluid">
			<section class="row">
				<aside>
					<section class="sidebar-content">
						<section class="sidebar-menu">
							<ul>
								<li class="<?php if ($index_menu == 'dashboard') {
												echo 'active';
											} ?>"><a href="<?php echo base_url(); ?>account/dashboard">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488.875 488.875">
												<path d="M481.65,206.175l-94.6-84.9v-100.2c0-11.4-9.4-20.8-20.8-20.8s-20.8,9.4-20.8,20.8v62.8l-87.3-78.4c-7.3-7.3-19.8-7.3-27,0
												l-223.6,199.6c-9.4,8.3-9.4,20.8-2.1,29.1c8.3,9.4,20.8,9.4,29.1,2.1l18.8-16.8v248.6c0,11.4,9.4,20.8,20.8,20.8h341.1
												c11.4,0,20.8-9.4,21.8-20.8v-247.6l17.7,15.8c12.7,10.3,25,3.1,29.1-1C491.05,226.975,490.05,213.375,481.65,206.175z
												M395.35,447.375H94.85v-263.1c0-0.7,0-1.3-0.1-2l149.9-134.2l150.8,135.1v264.2H395.35z"></path>
											</svg>
										</div>
										Home
									</a></li>
								<li class="<?php if ($index_menu == 'schedule') {
												echo 'active';
											} ?>"><a href="<?php echo base_url(); ?>account/schedule">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
												<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
												M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
												S365.867,459.733,250.667,459.733z"></path>
												<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
												c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
											</svg>
										</div>
										Schedule
									</a></li>
								<li class="<?php if ($index_menu == 'events') {
												echo 'active';
											} ?>"><a href="<?php echo base_url(); ?>account/events">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
												<path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
												c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
												<path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
												c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
												<path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
												c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
												<path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
												c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
												<path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
												c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
												<path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
												c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
												<path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
												c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
												c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
												h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
												V87.2h61.3v68.6V155.9z"></path>
											</svg>
										</div>
										Events
									</a></li>
								<li class="<?php if ($index_menu == 'study-sets') {
												echo 'active';
											} ?>"><a href="<?php echo base_url() . 'studyset' ?>">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490.124 490.124">
												<path d="M156.9,490.06H20.4c-11.2,0-20.4-9.2-20.4-20.4v-428c0-11.2,9.2-20.4,20.4-20.4h136.5c11.2,0,20.4,9.2,20.4,20.4v427
												C177.3,480.86,168.2,490.06,156.9,490.06z M40.8,449.26h95.8V61.96H40.8V449.26z"></path>
												<ellipse cx="84.6" cy="116.06" rx="26.5" ry="26.5"></ellipse>
												<path d="M318,475.76L196.7,65.06c-1-5.1-1-11.2,2-15.3c3.1-4.1,7.1-8.2,12.2-10.2l131.5-38.7c11.2-3.1,22.4,3.1,25.5,14.3
												l121.3,409.7c4.6,15.1-9.2,23.4-14.3,25.5l-131.4,38.7C341.4,490.06,325.1,493.66,318,475.76z M241.5,73.16l110.1,371l92.7-27.5
												l-110.1-370L241.5,73.16z"></path>
												<ellipse cx="310.9" cy="126.16" rx="26.5" ry="26.5"></ellipse>
											</svg>
										</div>
										Study Sets
									</a></li>
								<li class="<?php if ($index_menu == 'documents') {
												echo 'active';
											} ?>"><a href="<?php echo base_url(); ?>account/documents">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
												<path d="m460.2,387.1h-327v-335.3h327v335.3zm-81.4,73.1h-327v-358.3h40.5v305.5c0,11.3 9.1,20.4 20.4,20.4h266.1v32.4h-5.68434e-14zm101.8-449.2h-367.9c-11.3,0-20.4,9.1-20.4,20.4v29.7h-60.9c-11.3,7.10543e-15-20.4,9.1-20.4,20.4v399.1c0,11.3 9.1,20.4 20.4,20.4h367.8c11.3,0 20.4-9.1 20.4-20.4v-52.7h60.9c11.3,0 20.4-9.1 20.4-20.4v-376.1c0.1-11.3-9-20.4-20.3-20.4z"></path>
												<path d="m209.2,153.7h174.9c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-174.9c-11.3,0-20.4,9.1-20.4,20.4 2.84217e-14,11.2 9.1,20.4 20.4,20.4z"></path>
												<path d="m209.2,239.9h174.9c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-174.9c-11.3,0-20.4,9.1-20.4,20.4 2.84217e-14,11.2 9.1,20.4 20.4,20.4z"></path>
												<path d="m209.2,326.1h174.9c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-174.9c-11.3,0-20.4,9.1-20.4,20.4 2.84217e-14,11.2 9.1,20.4 20.4,20.4z"></path>
											</svg>
										</div>
										Documents
									</a></li>
								<li class="<?php if ($index_menu == 'questions') {
												echo 'active';
											} ?>"><a href="<?php echo base_url(); ?>account/questions">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
												<path d="m415.9,339.3c-3.5,3.9-5.4,9.1-5.2,14.4l2.3,63.6-65.8-26.1c-5.9-2.4-11.3-1.2-13.1-0.6-23.4,6.7-47.5,9-70.9,5.6-140.5-20.2-155.8-151.6-152.5-185.6 8.6-87.7 83.9-158.8 174.4-158.8 96.5,0 175,77.5 175,172.8 0.1,42.2-15.7,83-44.2,114.7zm-281.1,88.6c-4.9-1.4-10-0.9-14.6,1.3l-36.5,17.8 2.4-37.9c0.3-5.5-1.5-10.9-5.2-15-18.8-20.9-29.1-47.6-29.1-75.3 0-23 7-45 19.7-63.5 11.3,77.3 64.6,142.2 137.4,169.4-23,8.9-49,10.4-74.1,3.2zm317-67.7c31.8-38.2 49.2-86 49.2-135.5 0-117.8-96.8-213.7-215.8-213.7-108.2,0-200.2,80.9-214.1,185.9-37.8,29.2-60.1,74.2-60.1,121.9 0,34.9 12,68.6 33.9,95.9l-4.1,64.8c-0.5,7.3 3,14.2 9,18.3 3.4,2.3 11.4,5.2 20.3,1.4l61.3-30c48.2,11.3 98.2-1 135.4-31.6 23.7,2 47.9,0.1 71.6-5.9l88.6,35.1c8.5,3.2 15.8,0.2 19.3-2.3 5.6-4 8.9-10.5 8.6-17.4l-3.1-86.9z"></path>
												<path d="m359.8,154.7h-141c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h141c11.3,0 20.4-9.1 20.4-20.4 0-11.2-9.1-20.4-20.4-20.4z"></path>
												<path d="m359.8,261.8h-141c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h141c11.3,0 20.4-9.1 20.4-20.4 0-11.2-9.1-20.4-20.4-20.4z"></path>
											</svg>
										</div>
										Q&A
									</a></li>
								<li><a href="javascript:void(0);">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
												<path d="m463.6,144.9l-142.9-128.7c-3.7-3.3-8.6-5.2-13.7-5.2h-245c-11.3,0-20.4,9.1-20.4,20.4v449.2c0,11.3 9.1,20.4 20.4,20.4h388c11.3,0 20.4-9.1 20.4-20.4v-320.5c0-5.8-2.5-11.3-6.8-15.2zm-140.1-71.2l97.6,87.9h-97.6v-87.9zm106,386.5h-347v-408.4h200.2v130.2c0,11.3 9.1,20.4 20.4,20.4h126.5v257.8z"></path>
												<path d="m119.2,276.4c0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-232.8c-11.3,2.84217e-14-20.4,9.1-20.4,20.4z"></path>
												<path d="m372.4,355.6h-232.8c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 5.68434e-14-11.3-9.1-20.4-20.4-20.4z"></path>
											</svg>
										</div>
										Textbooks
										<span class="comming-soon-icon">
											<div class="ml10">
												<span class="text-wrapper">
													<img src="<?php echo base_url('assets_d/images/coming-soon-gif.gif'); ?>" alt="Image" />
												</span>
											</div>
										</span>
									</a></li>
								<li><a href="javascript:void(0);">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
												<path d="m495,211.9l-194.9-194.9c-8-8-20.9-8-28.9,0l-115.4,115.4c-10.8,11.3-4.4,25.3 0,28.9l19.3,19.3-147.7,118c-6.1,4.9-8.9,12.9-7.1,20.5 0.1,0.5 12.2,55.4-8.8,156.5-1.5,7.1 0.9,14.2 6,19 3.8,4 10.8,7.6 18.9,5.9 100.1-20.6 156.1-8.9 156.5-8.8 7.6,1.7 15.6-1 20.5-7.2l118.1-147.7 19.3,19.3c11.3,10.7 24.8,4.7 28.9,0l115.3-115.4c3.8-3.8 11.2-16.2 0-28.8zm-306.1,237.9c-17.2-2.2-51-4.5-99.5,0.9l74.4-74.4c8-8 8-20.9 0-28.9-8-8-20.9-8-28.9,0l-73.5,73.5c5.2-47.7 2.9-80.8 0.7-97.8l142-113.5 98.2,98.2-113.4,142zm176.2-136.9l-166-166 86.6-86.6 166,166-86.6,86.6z"></path>
											</svg>
										</div>
										Articles
										<span class="comming-soon-icon">
											<div class="ml10">
												<span class="text-wrapper">
													<img src="<?php echo base_url('assets_d/images/coming-soon-gif.gif'); ?>" alt="Image" />
												</span>
											</div>
										</span>
									</a></li>

								<li><a href="javascript:void(0);">
										<div class="activeBg">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
												<path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path>
											</svg>
										</div>
										Study Notes
										<span class="comming-soon-icon">
											<div class="ml10">
												<span class="text-wrapper">
													<img src="<?php echo base_url('assets_d/images/coming-soon-gif.gif'); ?>" alt="Image" />
												</span>
											</div>
										</span>
									</a></li>
							</ul>
						</section>
						<section class="coursepanel">
							<section class="courseheader header">
								<h6>Courses (<span id="course_count_dashboard"><?php echo count($get_course); ?></span>)</h6>
								<a class="userIcoList" data-toggle="modal" data-target="#courseModal"><i class="fa fa-plus"></i></a>
							</section>
							<?php foreach ($get_course as $key => $value) {
								if ($key < 5) { ?>
									<section class="courseheader">
										<h6><?= $value['name']; ?></h6>
										<!-- <a class="bullet">1</a> -->
									</section>

							<?php }
							} ?>



							<section class="view" onclick="showAllCourses('<?php echo base_url(); ?>account/showAllCourses')">
								View All <i class="fa fa-arrow-right" aria-hidden="true"></i>
							</section>
						</section>
						<!-- <section class="coursepanel">
							<section class="courseheader header">
								<h6>Study Sessions (3)</h6>
								<a><i class="fa fa-plus"></i></a>
							</section>
							<section class="courseheader">
								<p>Weekly Cram Group</p>
							</section>
							<section class="courseheader">
								<h6>The Spanish Study Group </h6>
								<a class="bullet">3</a>
							</section>
							<section class="courseheader">
								<p>The Cool Kids Club</p>
							</section>
							<section class="courseheader">
								<h6>Urban Law and Policy</h6>
								<a class="bullet">5</a>
							</section>
							<section class="view">
								View All <i class="fa fa-arrow-right" aria-hidden="true"></i>
							</section>
						</section> -->
					</section>
				</aside>
				<div class="overlay"></div>
				<div id="sidenav">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>

				<!-- chat module html  -->


				<!-- end of chat module html  -->


				<script type="text/javascript">
					function acceptRequest(id, action_id) {
						console.log("here");
						$.ajax({
							url: '<?php echo base_url(); ?>account/acceptRequest',
							type: 'post',
							data: {
								"id": id,
								"action_id": action_id
							},
							success: function(result) {
								$('#notification_' + id).addClass('read');
								$('#accept_' + id).hide();
								$('#reject_' + id).hide();
							}
						})
					}

					function readAllNotofication() {
						$.ajax({
							url: '<?php echo base_url(); ?>account/readAllNotofication',
							type: 'post',
							data: {
								"id": 1
							},
							success: function(result) {
								$('.notification-ul li').addClass('read');
								$('#notification_count').html(0);
							}
						})
					}

					function redirectAction(id) {
						$.ajax({
							url: '<?php echo base_url(); ?>account/redirectAction',
							type: 'post',
							data: {
								"id": id
							},
							success: function(result) {
								window.location.href = result;
							}
						})
					}

					function rejectRequest(id, action_id) {
						$.ajax({
							url: '<?php echo base_url(); ?>account/rejectRequest',
							type: 'post',
							data: {
								"id": id,
								"action_id": action_id
							},
							success: function(result) {
								$('#notification_' + id).addClass('read');
								$('#accept_' + id).hide();
								$('#reject_' + id).hide();
							}
						})
					}
				</script>
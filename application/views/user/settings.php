<section class="mainContent">
<div class="main-home-wrapper">
	<div class="tab-content-wrap">
		<div class="tabs-list-wrap">
			<h3>Settings</h3>
			<button class="tablinks" onclick="openTab(event, 'site-preference')" id="defaultOpen"><span class="side-ic site-icon"></span>Site Preference</button>
			<button class="tablinks" onclick="openTab(event, 'subscription-payment')"><span class="side-ic subscription-icon"></span> Subscription & Payment</button>
			<button class="tablinks" onclick="openTab(event, 'partner-services')"><span class="side-ic partner-icon"></span> Partner & Services</button>
			<button class="tablinks" onclick="openTab(event, 'account-management')"><span class="side-ic account-icon"></span> Account Management</button>
			<button class="tablinks" onclick="openTab(event, 'sign-security')"><span class="side-ic sign-icon"></span> Sign in & Security</button>
			<button class="tablinks" onclick="openTab(event, 'visibility')"><span class="side-ic visibility-icon"></span> Visibility</button>
			<button class="tablinks" onclick="openTab(event, 'notification')"><span class="side-ic notification-icon"></span> Notification</button>
			<button class="tablinks" onclick="openTab(event, 'communication')"><span class="side-ic communication-icon"></span> Communication</button>
			<button class="tablinks" onclick="openTab(event, 'data-privacy')"><span class="side-ic data-privacy"></span>Data Privacy</button>
		</div>
		<div class="tabcontent-area-wrp">
			<div id="site-preference" class="tabcontent-area">
				<h3>Site Preference</h3>
				<div class="site-preference">
					<h4>Language</h4>
					<p>Select the language you want to use on Studypeers. You can change it back anytime you want.</p>
					<select class="form-control selectpicker">
						<option>English</option>
						<option>French</option>
						<option>Hindi</option>
					</select>
				</div>
			</div>
			<div id="subscription-payment" class="tabcontent-area">
				<h3>Subscription & Payment</h3>
				<div class="custom-accordion">
					<h3>Buy a plan</h3>
					<p>Unlock the power of Studypeers</p>
				</div>
				<div class="custom-panel">
					<h4>Name, are you interested in Premium for personal use?</h4>
					<p>We'll recommend the right plan for you</p>
					<div class="checkbox">
						<label><input type="checkbox" value="">I'd use Premium for my personal goals</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">I'd use Premium as part of my job</label>
					</div>
				</div>
				<div class="custom-accordion">
					<h3>Purchase History</h3>
					<p>See your previous purchases and transactions</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
			</div>
			<div id="partner-services" class="tabcontent-area">
				<h3>Partner & Services</h3>
				<div class="data-privacy-row no-brd">
					<div class="data-privacy-left">
						<h4>Add more Apps</h4>
						<p>Unlock the power of Studypeers</p>
					</div>
					<div class="data-privacy-right">
						<a>+Add</a>
					</div>
				</div>
			</div>
			<div id="account-management" class="tabcontent-area">
				<h3>Account Management</h3>
				<div class="custom-accordion">
					<h3>Deactivate Account</h3>
					<p>Temporarily deactivate your account</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Close Account</h3>
					<p>Learn your options and close your account if you wish</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
			</div>
			<div id="sign-security" class="tabcontent-area">
				<h3>Sign in & Security</h3>
				<div class="custom-accordion">
					<h3>Email addresses</h3>
					<p>Add/remove email address on your account</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Phone numbers</h3>
					<p>Add a phone number in case you have trouble signing in</p>
				</div>
				<div class="custom-panel">
					<form role="form" id="changePhoneNumber" action="<?php echo base_url('settings/changePhoneNumber'); ?>" method="post" enctype="multipart/form-data">
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-3">
									<input type="tel" class="country_select" id="country_code" name="country_code" placeholder="" autocomplete="off" value="">
								</div>
								<div class="col-md-9">
									<input class="form-control" type="text" maxlength="15" name="phone" onkeypress='validate(event)' required>
								</div>
							</div>
						</div>
						
						<div class="form-footer">
							<button type="submit" id="changePhoneNumber" class="btn btn-success">Save</button>
						</div>
					</form>
				</div>
				<div class="custom-accordion">
					<h3>Change password</h3>
					<p>Choose a unique password to protect your account</p>
				</div>
				<div class="custom-panel">
					<form role="form" id="changePasswordForm" action="<?php echo base_url('settings/changePassword'); ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="row">
								<div class="col-md-9">
									<label>Create a new password that is at least 8 characters long</label>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-9">
									<label for="current_password">Type your current password</label>
									<input type="password" class="form-control" name="current_password" id="current_password" autocomplete="off" required>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-9">
									<label for="new_password">Type your new password</label>
									<input type="password" class="form-control" name="new_password" id="new_password" autocomplete="off" required>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-9">
									<label for="confirm_password">Retype your new password</label>
									<input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" required>
								</div>
							</div>
						</div>
						
						<div class="form-footer">
							<button type="submit" id="changePasswordBtn" class="btn btn-success">Save</button>
						</div>
					</form>
				</div>
				<div class="custom-accordion">
					<h3>Where you're signed in</h3>
					<p>See your active sessions and sign out if you'd like</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Devices that remember your password</h3>
					<p>Review and control the devices that remember your password</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Two-step verification</h3>
					<p>Active this feature of enhanced account security</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
			</div>
			<div id="visibility" class="tabcontent-area">
				<h3>Visibility of your activity</h3>
				<div class="custom-accordion">
					<h3>Story viewing options</h3>
					<p>Choose whether you're visible or viewing in private mode</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Edit your public profile</h3>
					<p>Choose how your profile appers to non-logged in members via search</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Who can see your connections</h3>
					<p>Choose who can see your list of connections</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Who can see your last name</h3>
					<p>Choose how you want your name to appear</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Profile visibility off Studypeers</h3>
					<p>Choose who can discover your profile it they haven't connected with you, but have your email address</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Profile discovery using email address</h3>
					<p>Choose who can discover your profile it they haven't connected with you, but have your email address</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
				<div class="custom-accordion">
					<h3>Profile discovery using email address</h3>
					<p>Choose who can discover your profile it they haven't connected with you, but have your email address</p>
				</div>
				<div class="custom-panel">
					<p>Lorem ipsum...</p>
				</div>
			</div>
			<div id="notification" class="tabcontent-area">
				<h3>Notification</h3>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Conversations</h4>
						<p>Messages, posts, comments</p>
					</div>
					<div class="data-privacy-right">
						<div class="flex-data-wrap">
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
							<span>On</span>
						</div>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Email</h4>
						<p>Received via your primary email</p>
					</div>
					<div class="data-privacy-right">
						<div class="flex-data-wrap">
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
							<span>On</span>
						</div>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Push</h4>
						<p>Pops up on your device</p>
					</div>
					<div class="data-privacy-right">
						<div class="flex-data-wrap">
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
							<span>On</span>
						</div>
					</div>
				</div>
			</div>
			<div id="communication" class="tabcontent-area">
				<h3>Communication</h3>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Who can reach you</h4>
						<p>Manage who you'd like to get communications from</p>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Invitations to connect</h4>
						<p>Choose who can connect with you</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>Everyone</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<div class="radio">
							<label><input type="radio" name="optradio">Everyone on Studypeers (recommended)</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="optradio">Only people who know your email address or appear in your "imported Contacts" list</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="optradio">Only people who appear in your "Imported Contacts" list</label>
						</div>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Invitations from your network</h4>
						<p>Choose what invitations you'd like to receive from your network</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>On</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<div class="toggle-flex-wrap">
							<p>Allow your network to send you event invitations?</p>
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
						</div>
						<div class="toggle-flex-wrap">
							<p>Allow your network to send you page invitations to follow companies and organizations?</p>
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
						</div>
						<div class="toggle-flex-wrap">
							<p>Allow your network to send you invitations to subscribe to newsletters?</p>
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Messages</h4>
						<p>Allow select people to message you</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>InMail</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<div class="toggle-flex-wrap">
							<p>Enable message request notifications</p>
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
						</div>
						<div class="toggle-flex-wrap">
							<p>Allow others to send you InMail?</p>
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
						</div>
						<div class="toggle-flex-wrap">
							<p>Allow Studypeers partners to show you Sponsored Messages?</p>
							<div class="toggle-wrap">
								<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Reply Suggestions</h4>
						<p>Turn on recommended replies when messaging</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>On</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<p>Can we show you reply suggestions, some of which are personalized using automated systems to recognize patterns in messages?</p>
						<div class="toggle-wrap">
							<label class="switch">
							<input type="checkbox">
							<span class="slider round"></span>
							</label>
						</div>
						<p>Reply suggestions appear at the bottom of the message. Once you've clicked or tapped on a suggestion, it'll be sent out automatically. <a href="">Learn more</a></p>
					</div>
				</div>
			</div>
			<div id="data-privacy" class="tabcontent-area">
				<h3>Data Privacy</h3>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Manage your data and activity</h4>
						<p>Review the data that you've provided, and make changes if you you'd like</p>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Get a copy of your data</h4>
						<p>See your options for accessing a copy of your accound data, connections, and more</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>Everyone</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<p>Your data belongs to you, & you can download an archive any time or view the rich media you have uploaded.</p>
						<div class="radio">
							<label><input type="radio" name="optradio">Download larger data achive, including connections, contacts, account history, & information we infer about you based on your profile and activity. <a href="">Learn more</a></label>
						</div>
						<div class="radio">
							<label><input type="radio" name="optradio">What something in particular? Select the data file you're most interested in.</label>
						</div>
						<div class="checkborx-wrap-area">
							<label class="checkbox-inline"><input type="checkbox" value="">Articles</label>
							<label class="checkbox-inline"><input type="checkbox" value="">Connections</label>
							<label class="checkbox-inline"><input type="checkbox" value="">Imported Contacts</label>
							<label class="checkbox-inline"><input type="checkbox" value="">Messages</label>
						</div>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Search History</h4>
						<p>Clear all previous searches performed on Linkedin</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>on</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<p>You search history is only visible to you, and it helps us to show you better results.</p>
						<button type="button" class="clear-search">Clear search history</button>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Stored applicant accounts</h4>
						<p>Match with third-party job applicant accounts are stored on Studypeers</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>0 account</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<p>The job applicant accounts below were stored after being created or added by you while applying to jobs on Linkedin. Removing an account will only remove your credentials from Linkedin's records. It will no erase the actual account from the applicant tracking system that owns it.</p>
						<p>You have no job applicant accounts.</p>
					</div>
				</div>
				<div class="data-privacy-row">
					<div class="data-privacy-left">
						<h4>Permitted services</h4>
						<p>View services you've authorized and manage data sharing</p>
					</div>
					<div class="data-privacy-right">
						<a>Change</a>
						<p>1 app connected</p>
					</div>
				</div>
				<div class="panel-info">
					<div class="panel-info-inner">
						<p>These are the services to which you have granted access to your Linkedin profile and network data. If you remove that access here, they will no longer be able to access your Linkedin data.</p>
						<p>You can manage Microsoft accounts you have connected to from our new Microsoft setting.</p>
						<p><strong>Services you've added</strong></p>
						<div class="logo-wrap">
							<div class="logo-area-content">
								<div class="logo-area">
									<span>Logo</span>
								</div>
								<div class="logo-content">
									<p>Brand Logo</p>
									<p>Connected August 28, 2020, 8:51 AM(GMT)
								</div>
							</div>
							<a>Remove</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	function openTab(evt, TabName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent-area");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(TabName).style.display = "block";
	  evt.currentTarget.className += " active";
	}
	
	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
</script>
<script>
	/* Toggle between adding and removing the "active" and "show" classes when the user clicks on one of the "Section" buttons. The "active" class is used to add a background color to the current button when its belonging panel is open. The "show" class is used to open the specific accordion panel */
	
	// Event delegation
	document.addEventListener("click", delegate(accFilter, accHandler));
	
	// Common helper for event delegation.
	function delegate(criteria, listener) {
	return function(e) {
	  var el = e.target;
	  do {
	    if (!criteria(el)) {
	      continue;
	    }
	    e.delegateTarget = el;
	    listener.call(this, e);
	    return;
	  } while ((el = el.parentNode));
	};
	}
	
	// Custom filter to check for required DOM elements
	function accFilter(elem) {
	return (elem instanceof HTMLElement) && elem.matches(".custom-accordion");
	// OR
	// For < IE9
	// return elem.classList && elem.classList.contains('btn');
	};
	
	// Custom event handler function
	function accHandler(e) {
	var acc = e.delegateTarget;
	acc.classList.toggle("active");
	acc.nextElementSibling.classList.toggle("show");
	
	var otherAccordions = getSiblings(acc.nextElementSibling, '.custom-panel');
	otherAccordions.forEach(function(otherAcc) {
	  otherAcc.classList.remove('show');
	  otherAcc.previousElementSibling.classList.remove("active");
	})
	};
	
	// Get siblings that matches selection criteria.
	// Reference: http://gomakethings.com/ditching-jquery/#get-sibling-elements
	function getSiblings(elem, matchesSelector) {
	var siblings = [];
	var sibling = elem.parentNode.firstChild;
	for (; sibling; sibling = sibling.nextSibling) {
	  if (sibling instanceof HTMLElement && sibling !== elem && sibling.matches(matchesSelector)) {
	    siblings.push(sibling);
	  }
	}
	return siblings;
	};
	
	var acc = document.getElementsByClassName("data-privacy-row");
	var i;
	for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
	  this.classList.toggle("active");
	  var panel = this.nextElementSibling;
	  if (panel.style.maxHeight) {
	    panel.style.maxHeight = null;
	  } else {
	    panel.style.maxHeight = panel.scrollHeight + "px";
	  } 
	});
	}
</script>
<section class="mainContent">
    <div class="main-home-wrapper">
      <div class="tab-content-wrap">
        <div class="tabs-list-wrap">
          <h3>Settings</h3>
          <button class="tablinks" onclick="openTab(event, 'site-preference')" id="defaultOpen">Site Preference</button>
          <button class="tablinks" onclick="openTab(event, 'subscription-payment')">Subscription & Payment</button>
          <button class="tablinks" onclick="openTab(event, 'partner-services')">Partner & Services</button>
          <button class="tablinks" onclick="openTab(event, 'account-management')">Account Management</button>
          <button class="tablinks" onclick="openTab(event, 'sign-security')">Sign in & Security</button>
          <button class="tablinks" onclick="openTab(event, 'visibility')">Visibility</button>
          <button class="tablinks" onclick="openTab(event, 'notification')">Notification</button>
          <button class="tablinks" onclick="openTab(event, 'communication')">Communication</button>
          <button class="tablinks" onclick="openTab(event, 'data-privacy')">Data Privacy</button>
        </div>
        <div class="tabcontent-area-wrp">
          <div id="site-preference" class="tabcontent-area">
            <h3>Site Preference</h3>
          </div>
          <div id="subscription-payment" class="tabcontent-area">
            <h3>Subscription & Payment</h3>
            <p>Paris is the capital of France.</p> 
          </div>
          <div id="partner-services" class="tabcontent-area">
            <h3>Partner & Services</h3>
            <p>Tokyo is the capital of Japan.</p>
          </div>
          <div id="account-management" class="tabcontent-area">
            <h3>Account Management</h3>
            <p>Tokyo is the capital of Japan.</p>
          </div>
          <div id="sign-security" class="tabcontent-area">
            <h3>Sign in & Security</h3>
            <p>Tokyo is the capital of Japan.</p>
          </div>
          <div id="visibility" class="tabcontent-area">
            <h3>Visibility</h3>
            <p>Tokyo is the capital of Japan.</p>
          </div>
          <div id="notification" class="tabcontent-area">
            <h3>Notification</h3>
            <p>Tokyo is the capital of Japan.</p>
          </div>
          <div id="communication" class="tabcontent-area">
            <h3>Communication</h3>
            <p>Tokyo is the capital of Japan.</p>
          </div>
          <div id="data-privacy" class="tabcontent-area">
            <h3>Data Privacy</h3>
            <div class="data-privacy-row">
              <div class="data-privacy-left">
                <h4>Manage your data and activity</h4>
                <p>Review the data that you've provided, and make changes if you you'd like</p>
              </div>
              <div class="data-privacy-right">
                <a>Change</a>
                <p>Everyone</p>
              </div>
            </div>
            <div class="data-privacy-row">
              <div class="data-privacy-left">
                <h4>Manage your data and activity</h4>
                <p>Review the data that you've provided, and make changes if you you'd like</p>
              </div>
              <div class="data-privacy-right">
                <a>Change</a>
                <p>Everyone</p>
              </div>
            </div>
            <div class="data-privacy-row">
              <div class="data-privacy-left">
                <h4>Manage your data and activity</h4>
                <p>Review the data that you've provided, and make changes if you you'd like</p>
              </div>
              <div class="data-privacy-right">
                <a>Change</a>
                <p>Everyone</p>
              </div>
            </div>
            <div class="data-privacy-row">
              <div class="data-privacy-left">
                <h4>Manage your data and activity</h4>
                <p>Review the data that you've provided, and make changes if you you'd like</p>
              </div>
              <div class="data-privacy-right">
                <a>Change</a>
                <p>Everyone</p>
              </div>
            </div>
            <div class="data-privacy-row">
              <div class="data-privacy-left">
                <h4>Manage your data and activity</h4>
                <p>Review the data that you've provided, and make changes if you you'd like</p>
              </div>
              <div class="data-privacy-right">
                <a>Change</a>
                <p>Everyone</p>
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
<?php
  require('../src/config.php');
  require(SRC_PATH . 'dbconnect.php');
  $pageTitle = 'My Profile';
  $pageId = 'myprofile';

  checkLoginSession();

  $user = fetchUserById($_GET['id']);
  // consoleLog($user, false);
?>
<?php include('layout/header.php'); ?>
  <!-- Sidans/Dokumentets huvudsakliga innehåll -->
  <div id="content">
    <article class="border">
      <fieldset>
        <h1>My Profile</h1>

        <figure class="right top">
          <img src="img/dummy-profile.png" width=130>
          <figcaption>
            <!-- <p>Exempel på bild med text</p> -->
          </figcaption>
        </figure>
        
        <div class="profile-container">

          <div>
            <h3 class="profile-header">First Name: </h3>
            <h3 class="profile-text" name="first_name"><?=htmlentities($user['first_name'])?></h3>
          </div>

          <div>            
            <h3 class="profile-header">Last Name: </h3>
            <h3 class="profile-text" name="last_name"><?=htmlentities($user['last_name'])?></h3>
          </div>

          <div>
            <h3 class="profile-header">Email: </h3>
            <h3 class="profile-text" name="email"><?=htmlentities($user['email'])?></h3>
          </div>

          <div>
            <h3 class="profile-header">Phone Number: </h3>
            <h3 class="profile-text" name="phone"><?=htmlentities($user['phone'])?></h3>
          </div>

          <div>
            <h3 class="profile-header">Street: </h3>
            <h3 class="profile-text" name="street"><?=htmlentities($user['street'])?></h3>
          </div>

          <div>
            <h3 class="profile-header">Postal Code: </h3>
            <h3 class="profile-text" name="postal_code"><?=htmlentities($user['postal_code'])?></h3>
          </div>

          <div>
            <h3 class="profile-header">City: </h3>
            <h3 class="profile-text" name="city"><?=htmlentities($user['city'])?></h3>
          </div>

          <div>
            <h3 class="profile-header">Country: </h3>
            <h3 class="profile-text" name="country"><?=htmlentities($user['country'])?></h3>
          </div>

          <div>
            <h3 class="profile-header">Register Date: </h3>
            <h3 class="profile-text" name="register_date"><?=htmlentities($user['register_date'])?></h3>
          </div>

          <br>
          <form action="edit_profile.php" method="get" style="padding-bottom: 10px;">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <input type="submit" class="btn btn-dark" value="Edit Profile">
          </form>
        </div>
      </fieldset>
    </article>
  </div>

<?php include('layout/footer.php'); ?>
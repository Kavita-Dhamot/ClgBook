<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");

 if(isset($_SESSION['username'])){               //checks if the user is loggen in, as in register.php we set the username variable once the user logs in
   $userLoggedIn = $_SESSION['username'];       // variable stores the username of the user that is currently logged in
   $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'"); //gets info about users
   $user = mysqli_fetch_array($user_details_query); // makes array of all info about the user

 }
 else{                                          //user is not logged in
   header("Location: register.php");            //as the user is not logged in it sends the user back to the registeration page
 }
?>

<html>
<head>
    <title>
        Welcome to ClgFeed!!!
    </title>
    <!-- Javascript  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- <script src= "assets/js/bootstrap.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src= "assets/js/bootbox.min.js"></script>
    <script src= "assets/js/clgbook.js"></script>
    <script src="assets/js/jquery.Jcrop.js"></script>
	  <script src="assets/js/jcrop_bits.js"></script>




    <!-- CSS -->
    <script src="https://kit.fontawesome.com/782555080c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<body>

    <div class="top_bar">
      <div class="logo">
        <img src="assets/images/logo.png">
        <a href="index.php">ClgFeed</a>
      </div>

      <nav>

        <?php
				  //Unread messages 
          $messages = new Message($con, $userLoggedIn);
          $num_messages = $messages->getUnreadNumber();
			  ?>

        <a href="<?php echo $userLoggedIn ?>">
          <?php echo $user['first_name']; ?>
        </a>
        <a href="#">
          <i class="fa-solid fa-house"></i>
        </a>
        <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
            <i class="fa-solid fa-envelope"></i>
          <?php
          if($num_messages > 0)
          echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>';
          ?>
        </a>
        
        <a href="#">
          <i class="fa-solid fa-bell"></i>
        </a>
        <a href="requests.php">
          <i class="fa-solid fa-users"></i>
        </a>
        <a href="upload.php">
          <i class="fa-solid fa-gear"></i>
        </a>
        <a href="includes/handlers/logout.php">
          <i class="fa-solid fa-right-from-bracket"></i>
        </a>
      </nav>

      <div class="dropdown_data_window" style="height:0px; border: none;"></div>
      <input type="hidden" id="dropdown_data_type" value="">

    </div>


    <script>
		$(function(){

		var userLoggedIn = '<?php echo $userLoggedIn; ?>';
		var inProgress = false;

		loadPosts(); //Load first posts

			$('.dropdown_data_window').scroll(function() {
				var bottomElement = $(".dropdown_data_window").last();
				var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

					// isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
					if (isElementInView(bottomElement[0]) && noMoreData == 'false') {
							loadPosts();
					}
			});

			function loadPosts() {
					if(inProgress) { //If it is already in the process of loading some posts, just return
				return;
			}

			inProgress = true;

			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

      var pageName;
      var type= $('#dropdown_data_type').val();


      if(type=='notification'){
        pageName="ajax_load_notifications.php";
      }

      else if(type= 'message'){
        pageName= "ajax_load_messages.php";
      }

			$.ajax({
				url: "includes/handlers/" + pageName,
				type: "POST",
				data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
				cache:false,

				success: function(response) {
					$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage
					$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage
					$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage

					$(".dropdown_data_window").append(response);

					inProgress = false;
				}
			});
			}

			//Check if the element is in view
			function isElementInView (el) {
				var rect = el.getBoundingClientRect();

				return (
					rect.top >= 0 &&
					rect.left >= 0 &&
					rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
					rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
				);
			}
		});

	</script>

    <div class="wrapper">

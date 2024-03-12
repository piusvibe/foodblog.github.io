<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vibe Blogs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a  class="d-inline-flex link-body-emphasis text-decoration-none">
          <b>Vibe Kitchen Blogs</b>
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="https://mi-linux.wlv.ac.uk/~1928477/vibe/public/index.php" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2">About</a></li>
      </ul>

      <div class="col-md-3 text-end"> 
      <?php 
      $session = session();
      if($session->get('name')){   
        echo "Hello : ".$session->get('name'); 
        ?>
        <button type="button" onclick="location.href='<?= base_url('/signin/logout') ?>';" class="btn btn-primary">Logout</button>
        <?php //This code uses a session variable to determine whether the user is currently logged in. It shows a welcome message and a logout button if the user is signed in. 
      }else{
      
      ?>
      
        <button type="button" onclick="location.href='<?= base_url('/signin') ?>';" class="btn btn-outline-primary me-2">Login</button>
        <button type="button" onclick="location.href='<?= base_url('/signup') ?>';" class="btn btn-primary">Sign-up</button> 
      <?php } ?>        
      </div> 
    </header>     
  </div> 

  <!-- add new post modal beginning -->
  <div class="modal fade" id="add_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add New Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
          <div class="modal-body p-5">
            <div class="mb-3">
              <label>Post Title</label>
              <input type="text" name="title" class="form-control" placeholder="Title" required>
              <div class="invalid-feedback">Post title is required!</div>
            </div>

            <div class="mb-3">
              <label>Post Category</label>
              <input type="text" name="category" class="form-control" placeholder="Category" required>
              <div class="invalid-feedback">Post category is required!</div>
            </div>

            <div class="mb-3">
              <label>Post Body</label>
              <textarea name="body" class="form-control" rows="4" placeholder="Body" required></textarea>
              <div class="invalid-feedback">Post body is required!</div>
            </div>

            <div class="mb-3">
              <label>Post Image</label>
              <input type="file" name="file" id="image" class="form-control" required>
              <div class="invalid-feedback">Post image is required!</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add_post_btn">Add Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- add new post modal ending -->

  <!-- edit post modal beginning -->
  <div class="modal fade" id="edit_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
          <input type="hidden" name="id" id="pid">
          <input type="hidden" name="old_image" id="old_image">
          <div class="modal-body p-5">
            <div class="mb-3">
              <label>Recipe Title</label>
              <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
              <div class="invalid-feedback">Post title is required!</div>
            </div>

            <div class="mb-3">
              <label>Recipe Category</label>
              <input type="text" name="category" id="category" class="form-control" placeholder="Category" required>
              <div class="invalid-feedback">Post category is required!</div>
            </div>

            <div class="mb-3">
              <label>Recipe</label>
              <textarea name="body" class="form-control" rows="4" id="body" placeholder="Body" required></textarea>
              <div class="invalid-feedback">Post body is required!</div>
            </div>

            <div class="mb-3">
              <label>Recipe Image</label>
              <input type="file" name="file" class="form-control">
              <div class="invalid-feedback">Post image is required!</div>
              <div id="post_image"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="edit_post_btn">Update Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- edit post modal ending -->

  <!-- detail post modal beginning -->
  <div class="modal fade" id="detail_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Details of Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="" id="detail_post_image" class="img-fluid">
          <h3 id="detail_post_title" class="mt-3"></h3>
          <h5 id="detail_post_category"></h5>
          <p id="detail_post_body"></p>
          <p id="detail_post_created" class="fst-italic"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- detail post modal ending -->

  <div class="container">
    <div class="row my-4">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div class="text-secondary fw-bold fs-3">All Posts</div>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_post_modal">Add New Post</button>
          </div>
          <div class="card-body">
            <div class="row" id="show_posts">
              <h1 class="text-center text-secondary my-5">Posts Loading..</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>            
  <script>
    $(function() {
      //  AJAX code adds a new post to the database, sends a POST request to the server with form data, and displays a success message using SweetAlert.
      $("#add_post_form").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
          e.preventDefault();
          $(this).addClass('was-validated');
        } else {
          $("#add_post_btn").text("Adding...");
          $.ajax({
            url: '<?= base_url('post/add') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
              if (response.error) {
                $("#image").addClass('is-invalid');
                $("#image").next().text(response.message.image);
              } else {
                $("#add_post_modal").modal('hide');
                $("#add_post_form")[0].reset();
                $("#image").removeClass('is-invalid');
                $("#image").next().text('');
                $("#add_post_form").removeClass('was-validated');
				// sweet alert function 
                Swal.fire(
                  'Added',
                  response.message,
                  'success'
                );
                fetchAllPosts();
              }
              $("#add_post_btn").text("Add Post");
            }
          });
        }
      });

      // AJAX to retrieve the post information from the server and changing the form fields and image display on the website, this code enables users to modify posts.
      $(document).delegate('.post_edit_btn', 'click', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');
        $.ajax({
          url: '<?= base_url('post/edit/') ?>/' + id,
          method: 'get',
          success: function(response) {
            $("#pid").val(response.message.id);
            $("#old_image").val(response.message.image);
            $("#title").val(response.message.title);
            $("#category").val(response.message.category);
            $("#body").val(response.message.body);
            $("#post_image").html('<img src="<?= base_url('uploads/avatar/') ?>/' + response.message.image + '" class="img-fluid mt-2 img-thumbnail" width="150">');
          }
        });
      });

      // It sends an AJAX request to the server to update the post. The request is sent to the URL '<?= base_url('post/update') ?>'. 
      $("#edit_post_form").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
          e.preventDefault();
          $(this).addClass('was-validated');
        } else {
          $("#edit_post_btn").text("Updating...");
          $.ajax({
            url: '<?= base_url('post/update') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
              $("#edit_post_modal").modal('hide');
              Swal.fire(
                'Updated',
                response.message,
                'success'
              );
              fetchAllPosts();
              $("#edit_post_btn").text("Update Post");
            }
          });
        }
      });

      // after deletion of a particular post, this AJAX procedure is designed to update the list of posts displayed on the webpage by using the fetchAllPosts() function.
      $(document).delegate('.post_delete_btn', 'click', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '<?= base_url('post/delete/') ?>/' + id,
              method: 'get',
              success: function(response) {
                Swal.fire(
                  'Deleted!',
                  response.message,
                  'success'
                )
                fetchAllPosts();
              }
            });
          }
        })
      });
      // when a user clicks on a button or link with the class "post_detail_btn," this AJAX method is meant to display the details of a particular post. 
      $(document).delegate('.post_detail_btn', 'click', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');
        $.ajax({
          url: '<?= base_url('post/detail/') ?>/' + id,
          method: 'get',
          dataType: 'json',
          success: function(response) {
            $("#detail_post_image").attr('src', '<?= base_url('uploads/avatar/') ?>/' + response.message.image);
            $("#detail_post_title").text(response.message.title);
            $("#detail_post_category").text(response.message.category);
            $("#detail_post_body").text(response.message.body);
            $("#detail_post_created").text(response.message.created_at);
          }
        });
      });

      // this AJAX method aims to display the posts on the webpage.  fetchAllPosts(); }) will be executed when the page finishes loading showing all posts
      fetchAllPosts();

      function fetchAllPosts() {
        $.ajax({
          url: '<?= base_url('post/fetch') ?>',
          method: 'get',
          success: function(response) {
            $("#show_posts").html(response.message);
          }
        });
      }
    });
  </script>

</body>

</html>
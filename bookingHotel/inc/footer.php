   <?php
    require_once(__DIR__ . '/../admin/inc/db_config.php');
    $settings_q = "SELECT * FROM settings WHERE 1";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con, $settings_q));
    ?>
   <!-- Footer -->
   <div class="container-fluid bg-dark">

       <div class="row mt-3 pt-3">
           <div class="col-md-4 pr-md-5">
               <a class="navbar-brand me-5 fs-1 fw-bold h-font text-white" href="index.php">
                   <?php echo $settings_r['site_title']; ?></a>
               <p class="text-white"> <?php echo $settings_r['site_about']; ?></p>
           </div>
           <div class="col-md-2">
               <ul class="list-unstyled nav-links">
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Home</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">About Us</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Portfolio</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Services</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Contact</a></li>
               </ul>
           </div>
           <div class="col-md-2">
               <ul class="list-unstyled nav-links">
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Clients</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Team</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Career</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Testimonials</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Journal</a></li>
               </ul>
           </div>
           <div class="col-md-2">
               <ul class="list-unstyled nav-links">
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Privacy Policy</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Terms &amp;
                           Conditions</a></li>
                   <li><a href="#" class="d-inline-block mb-2 text-decoration-none text-white">Partners</a></li>
               </ul>
           </div>
           <div class="col-md-2 text-md-center">
               <ul class="social list-unstyled">
                   <li><a href="#" class="text-white"> <i class="bi bi-facebook"></i></span></a></li>
                   <li><a href="#" class="text-white"> <i class="bi bi-github"></i></span></a></li>
                   <li><a href="#" class="text-white"> <i class="bi bi-envelope-at-fill"></i></span></a></li>
                   <!-- <li><a href="#" class="text-white"> <i class="bi bi-facebook"></i></span></a></li>
                    <li><a href="#" class="text-white"> <i class="bi bi-facebook"></i></span></a></li> -->
               </ul>
               <p class=""><a href="#" class="btn btn-tertiary">Contact Us</a></p>
           </div>
       </div>

       <div class="row ">
           <div class="col-12 text-center">
               <div class="copyright mt-5 pt-5">
                   <p class="text-white"><small>© 2019-2020 All Rights Reserved.</small></p>
               </div>
           </div>
       </div>

   </div>

   <script>
       function showToast(type, message) {
           const toast = document.createElement("div");
           toast.className = `toast align-items-center text-white bg-${type} border-0  show position-fixed end-0 m-3`;
           toast.style.top = "20%"; // ⬅ giảm xuống 30%
           toast.style.zIndex = "9999";
           toast.innerHTML = `
      <div class="d-flex">
          <div class="toast-body">${message}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    `;

           document.body.appendChild(toast);
           setTimeout(() => toast.remove(), 3000);
       }
   </script>
async function register() {
  const form = document.getElementById("registerForm");
  const formData = new FormData(form);
  formData.append("register", "true");

  try {
    const res = await fetch("ajax/register.php", {
      method: "POST",
      body: formData,
    });

    const text = await res.text();
    console.log("Server trả:", text);

    // Nếu chứa chữ "thành công"
    if (text.includes("thành công")) {
      showToast("success", text);
      form.reset();
      const modal = bootstrap.Modal.getInstance(
        document.getElementById("registerModal")
      );
      if (modal) modal.hide();

      // Reload lại trang để hiển thị session mới
      setTimeout(() => window.location.reload(), 500);
    } else {
      // Báo lỗi
      showToast("danger", text);
    }
  } catch (err) {
    showToast("danger", "Lỗi server!");
    console.error(err);
  }
}

async function login() {
  const form = document.getElementById("loginForm");
  const formData = new FormData(form);
  formData.append("login", "true");

  try {
    const res = await fetch("ajax/login.php", {
      method: "POST",
      body: formData,
    });

    const text = await res.text();
    console.log("Server trả:", text);

    if (text.toLowerCase().includes("thành công")) {
      showToast("success", text);

      form.reset();

      const modalEl = document.getElementById("loginModal");
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      setTimeout(() => {
        window.location.reload();
      }, 500);
    } else {
      showToast("danger", text);
    }
  } catch (err) {
    console.error("Fetch error:", err);
    showToast("danger", "Lỗi server!");
  }
}

async function logout() {
  try {
    const res = await fetch("ajax/logout.php");
    const data = await res.json();

    if (data.success) {
      showToast("success", data.message);

      // Cập nhật lại header login/register
      const headerDiv = document.querySelector(".d-flex"); // phần login/register
      if (headerDiv) {
        headerDiv.innerHTML = `
                    <button type="button" class="btn btn-outline-dark me-3 shadow-none" data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        Đăng nhập
                    </button>
                    <button type="button" class="btn btn-outline-dark me-3 shadow-none" data-bs-toggle="modal"
                        data-bs-target="#registerModal">
                        Đăng ký
                    </button>
                `;
      }
      setTimeout(() => {
        window.location.href = "/bookingHotel/index.php";
      }, 500);
    }
  } catch (err) {
    showToast("danger", "Lỗi server khi đăng xuất!");
    console.error(err);
  }
}

// async function forgotPassword() {
//   const email = prompt("Vui lòng nhập email để nhận link đặt lại mật khẩu:");
//   if (!email) {
//     showToast("warning", "Bạn chưa nhập email!");
//     return;
//   }

//   const formData = new FormData();
//   formData.append("email", email);
//   formData.append("forgotPassword", "true");

//   try {
//     const res = await fetch("ajax/forgot-password.php", {
//       method: "POST",
//       body: formData,
//     });

//     const text = await res.text();
//     console.log("Server trả:", text);

//     if (text.toLowerCase().includes("gửi thành công")) {
//       showToast("success", text);
//     } else {
//       showToast("danger", text);
//     }
//   } catch (err) {
//     console.error("Fetch error:", err);
//     showToast("danger", "Lỗi server!");
//   }
// }

async function get_banner() {
  try {
    const res = await fetch("ajax/carousel_crud.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "get_banner=true",
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.json();
    console.log("Danh sách banner nhận được:", data);
    const container = document.getElementById("banner-data");
    container.innerHTML = "";

    if (data.length === 0) {
      container.innerHTML = "<p class='text-muted'>Chưa có ảnh bìa nào.</p>";
      return;
    }

    data.forEach((banner) => {
      const card = `
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="${banner.img_banner}" class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteBanner"
                                    // data-id="${banner.cr_no}" 
                                    onclick="confirmIdDelete(${banner.cr_no})"
                                    >
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            `;
      container.insertAdjacentHTML("beforeend", card);
    });

    // document
    //   .querySelectorAll('[data-bs-target="#confirmDeleteBanner"]')
    //   .forEach((btn) => {
    //     btn.addEventListener("click", function () {
    //       const id = this.getAttribute("data-id");
    //       document
    //         .getElementById("confirmDeleteBannerBtn")
    //         .setAttribute("data-id", id);
    //     });
    //   });
  } catch (error) {
    console.error("Lỗi khi lấy danh sách banner:", error);
  }
}

document.addEventListener("DOMContentLoaded", get_banner);

function confirmIdDelete(id) {
  const btn = document.getElementById("confirmDeleteBannerBtn");
  btn.setAttribute("data-id", id);
  const modal = new bootstrap.Modal(
    document.getElementById("confirmDeleteBanner")
  );
  modal.show();
}

async function addBanner() {
  const img_banner = document.getElementById("img_banner_ipt").files[0];
  if (!img_banner) {
    alert("Vui lòng chọn ảnh!");
    return;
  }

  const formData = new FormData();
  formData.append("add_banner", "true");
  formData.append("img_banner", img_banner);

  try {
    const res = await fetch("ajax/carousel_crud.php", {
      method: "POST",
      body: formData,
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.json();
    console.log("Phản hồi update:", data);

    const modal = bootstrap.Modal.getInstance(
      document.getElementById("banner-s")
    );
    modal.hide();
    get_banner();
    document.getElementById("img_banner_ipt").value = "";
  } catch (error) {
    console.error(error);
    alert("Có lỗi xảy ra khi thêm banner!");
  }
}

function resetFormManager() {
  document.getElementById("img_banner_ipt").value = "";
}
document
  .getElementById("confirmDeleteBannerBtn")
  .addEventListener("click", async function () {
    const formData = new FormData();
    formData.append("delete_banner", "true");
    formData.append("id", this.getAttribute("data-id"));
    try {
      const res = await fetch("ajax/carousel_crud.php", {
        method: "POST",
        body: formData,
      });
      if (!res.ok) throw new Error("HTTP status " + res.status);
      const data = await res.text();
      console.log("✅ Phản hồi delete:", data);

      const modal = bootstrap.Modal.getInstance(
        document.getElementById("confirmDeleteBanner")
      );
      modal.hide();
      //gỡ lỗi overlay
      document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
      document.body.classList.remove("modal-open");
      document.body.style.overflow = "";
      get_banner();
    } catch (error) {
      console.log(error);
    }
  });

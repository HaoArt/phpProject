let generalData = {};
let contactData = {};
let managerData = {};
async function get_general() {
  try {
    const res = await fetch("ajax/settings_crud.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "get_general=true",
    });
    if (!res.ok) throw new Error("HTTP status " + res.status);
    const data = await res.json();
    console.log(" JSON nhận được:", data);
    generalData = data;
    //    general
    document.getElementById("site_title").innerText =
      data.site_title || "Chưa có dữ liệu";
    document.getElementById("site_about").innerText =
      data.site_about || "Chưa có dữ liệu";
    // modal general
    document.getElementById("site_title_ipt").value =
      data.site_title || "Chưa có dữ liệu";
    document.getElementById("site_about_ipt").value =
      data.site_about || "Chưa có dữ liệu";
  } catch (error) {
    console.log(error);
  }
}
document.addEventListener("DOMContentLoaded", get_general);

function resetFormGeneral() {
  document.getElementById("site_title_ipt").value =
    generalData.site_title || "";
  document.getElementById("site_about_ipt").value =
    generalData.site_about || "";
}

async function updateGeneral() {
  const title = document.getElementById("site_title_ipt").value.trim();
  const about = document.getElementById("site_about_ipt").value.trim();
  if (!title || !about) {
    alert("Vui lòng nhập đầy đủ và không được bỏ trống");
    return;
  }
  try {
    const res = await fetch("ajax/settings_crud.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `update_general=true&site_title=${encodeURIComponent(
        title
      )}&site_about=${encodeURIComponent(about)}`,
    });
    if (!res.ok) throw new Error("HTTP status " + res.status);
    const data = await res.text();
    console.log("✅ Phản hồi update:", data);
    get_general();
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("general-s")
    );
    modal.hide();
  } catch (error) {
    console.log(error);
  }
}
async function get_contact() {
  try {
    const res = await fetch("ajax/settings_crud.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "get_contact=true",
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.json();
    console.log("JSON nhận được1:", data);

    if (data.error) {
      console.error(data.error);
      return;
    }

    contactData = data;

    //    contact
    document.getElementById("address").innerText =
      data.address || "Chưa có dữ liệu";
    document.getElementById("phone1").innerText =
      data.phone1 || "Chưa có dữ liệu";
    document.getElementById("phone2").innerText =
      data.phone2 || "Chưa có dữ liệu";
    document.getElementById("ggmap").innerText =
      data.ggmap || "Chưa có dữ liệu";
    document.getElementById("email").innerText =
      data.email || "Chưa có dữ liệu";
    document.getElementById("fb").innerText = data.fb || "Chưa có dữ liệu";
    document.getElementById("github").innerText =
      data.github || "Chưa có dữ liệu";
    if (data.iframe) {
      const cleanSrc = data.iframe.replace(/^src="|"$|'/g, ""); // bỏ src=" và dấu "
      document.getElementById("iframe").src = cleanSrc;
    }
    //modal contact
    document.getElementById("address_ipt").value =
      contactData.address || "Chưa có dữ liệu";
    document.getElementById("phone1_ipt").value =
      contactData.phone1 || "Chưa có dữ liệu";
    document.getElementById("phone2_ipt").value =
      contactData.phone2 || "Chưa có dữ liệu";
    document.getElementById("ggmap_ipt").value =
      contactData.ggmap || "Chưa có dữ liệu";
    document.getElementById("email_ipt").value =
      contactData.email || "Chưa có dữ liệu";
    document.getElementById("fb_ipt").value =
      contactData.fb || "Chưa có dữ liệu";
    document.getElementById("github_ipt").value =
      contactData.github || "Chưa có dữ liệu";
    document.getElementById("iframe_ipt").value =
      contactData.iframe || "Chưa có dữ liệu";
  } catch (error) {
    console.log(" Lỗi khi fetch dữ liệu:", error);
  }
}
document.addEventListener("DOMContentLoaded", get_contact);

function resetFormContact() {
  document.getElementById("address_ipt").value =
    contactData.address || "Chưa có dữ liệu";
  document.getElementById("phone1_ipt").value =
    contactData.phone1 || "Chưa có dữ liệu";
  document.getElementById("phone2_ipt").value =
    contactData.phone2 || "Chưa có dữ liệu";
  document.getElementById("ggmap_ipt").value =
    contactData.ggmap || "Chưa có dữ liệu";
  document.getElementById("email_ipt").value =
    contactData.email || "Chưa có dữ liệu";
  document.getElementById("fb_ipt").value = contactData.fb || "Chưa có dữ liệu";
  document.getElementById("github_ipt").value =
    contactData.github || "Chưa có dữ liệu";
  document.getElementById("iframe_ipt").value =
    contactData.iframe || "Chưa có dữ liệu";
}

async function updateContact() {
  const address = document.getElementById("address_ipt").value.trim();
  const phone1 = document.getElementById("phone1_ipt").value.trim();
  const phone2 = document.getElementById("phone2_ipt").value.trim();
  const ggmap = document.getElementById("ggmap_ipt").value.trim();
  const email = document.getElementById("email_ipt").value.trim();
  const fb = document.getElementById("fb_ipt").value.trim();
  const github = document.getElementById("github_ipt").value.trim();
  const iframe = document.getElementById("iframe_ipt").value.trim();
  if (
    !address ||
    !phone1 ||
    !phone2 ||
    !ggmap ||
    !email ||
    !fb ||
    !github ||
    !iframe
  ) {
    alert("Vui lòng nhập đầy đủ tất cả các trường thông tin!");
    return;
  }
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert("Email không hợp lệ!");
    return;
  }
  const phoneRegex = /^0\d{9}$/;
  if (!phoneRegex.test(phone1)) {
    alert("Số điện thoại 1 không hợp lệ!");
    return;
  }
  if (!phoneRegex.test(phone2)) {
    alert("Số điện thoại 2 không hợp lệ!");
    return;
  }
  const urlRegex = /^(https?:\/\/)[^\s]+$/;
  if (!urlRegex.test(ggmap)) {
    alert("Liên kết Google Map không hợp lệ!");
    return;
  }
  if (!urlRegex.test(fb)) {
    alert("Liên kết Facebook không hợp lệ!");
    return;
  }
  if (!urlRegex.test(github)) {
    alert("Liên kết GitHub không hợp lệ!");
    return;
  }
  try {
    const res = await fetch("ajax/settings_crud.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `update_contact=true&address=${encodeURIComponent(
        address
      )}&phone1=${encodeURIComponent(phone1)}
                 &phone2=${encodeURIComponent(
                   phone2
                 )}&ggmap=${encodeURIComponent(
        ggmap
      )}&email=${encodeURIComponent(email)} 
                 &fb=${encodeURIComponent(fb)} &github=${encodeURIComponent(
        github
      )} &iframe=${encodeURIComponent(iframe)}`,
    });
    if (!res.ok) throw new Error("HTTP status " + res.status);
    const data = await res.text();
    console.log("✅ Phản hồi update:", data);
    get_contact();
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("contact-s")
    );
    modal.hide();
  } catch (error) {
    console.log(error);
  }
}

async function get_manager() {
  try {
    const res = await fetch("ajax/settings_crud.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "get_manager=true",
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.json();
    console.log("Danh sách manager nhận được:", data);
    const container = document.getElementById("manager-data");
    container.innerHTML = "";

    if (data.length === 0) {
      container.innerHTML = "<p class='text-muted'>Chưa có quản lý nào.</p>";
      return;
    }

    data.forEach((manager) => {
      const card = `
                <div class="col-md-2 mb-3">
                    <div class="card shadow-sm">
                        <img src="${manager.img_manager}" class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <p class="card-text fw-bold mb-2">${manager.name_manager}</p>
                            <button type="button" class="btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                    data-id="${manager.cr_no}" 
                                    data-name="${manager.name_manager}">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            `;
      container.insertAdjacentHTML("beforeend", card);
    });

    document
      .querySelectorAll('[data-bs-target="#confirmDeleteModal"]')
      .forEach((btn) => {
        btn.addEventListener("click", function () {
          const id = this.getAttribute("data-id");
          const name = this.getAttribute("data-name");

          document.getElementById("name-manager-modal").innerText = name;
          document
            .getElementById("confirmDeleteManagerBtn")
            .setAttribute("data-id", id);
        });
      });
  } catch (error) {
    console.error("Lỗi khi lấy danh sách manager:", error);
  }
}

document.addEventListener("DOMContentLoaded", get_manager);

async function addManager() {
  const name_manager = document.getElementById("name_manager_ipt").value.trim();
  const img_manager = document.getElementById("img_manager_ipt").files[0];
  if (!name_manager || !img_manager) {
    alert("Vui lòng nhập đầy đủ họ tên và chọn ảnh!");
    return;
  }
  const formData = new FormData();
  formData.append("add_manager", "true");
  formData.append("name_manager", name_manager);
  formData.append("img_manager", img_manager);
  try {
    const res = await fetch("ajax/settings_crud.php", {
      method: "POST",
      body: formData,
    });
    if (!res.ok) throw new Error("HTTP status " + res.status);
    const data = await res.text();
    console.log("✅ Phản hồi update:", data);
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("manager-s")
    );
    modal.hide();
    document.getElementById("name_manager_ipt").value = "";
    document.getElementById("img_manager_ipt").value = "";
    get_manager();
  } catch (error) {
    console.log(error);
  }
}

function resetFormManager() {
  document.getElementById("name_manager_ipt").value = "";
  document.getElementById("img_manager_ipt").value = "";
}
document
  .getElementById("confirmDeleteManagerBtn")
  .addEventListener("click", async function () {
    const formData = new FormData();
    formData.append("delete_manager", "true");
    formData.append("id", this.getAttribute("data-id"));
    try {
      const res = await fetch("ajax/settings_crud.php", {
        method: "POST",
        body: formData,
      });
      if (!res.ok) throw new Error("HTTP status " + res.status);
      const data = await res.text();
      console.log("✅ Phản hồi delete:", data);
      get_manager();
      const modal = bootstrap.Modal.getInstance(
        document.getElementById("confirmDeleteModal")
      );
      modal.hide();
    } catch (error) {
      console.log(error);
    }
  });

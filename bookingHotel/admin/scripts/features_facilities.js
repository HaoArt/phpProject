// feature
async function getFeatures() {
  try {
    const res = await fetch("ajax/feature_facilities_crud.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "get_features=true",
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.json();
    console.log("Danh sách features nhận được:", data);

    const container = document.getElementById("features-data");
    container.innerHTML = "";

    if (data.length === 0) {
      container.innerHTML = `
        <tr>
          <td colspan="3" class="text-center text-muted">Chưa có đặc trưng nào.</td>
        </tr>
      `;
      return;
    }

    data.forEach((feature, index) => {
      const row = `
        <tr>
          <td class="text-center">${index + 1}</td>
          <td>${feature.name}</td>
          <td class="text-center">
            <button onclick="
            confirmIdEditFe(${feature.cr_no}, '${feature.name}')" 
            class="btn btn-sm btn-primary me-1">Sửa</button>
            <button onclick="
            confirmIdDeleteFe(${feature.cr_no})"
             class="btn btn-sm btn-danger">Xóa</button>
          </td>
        </tr>
      `;
      container.insertAdjacentHTML("beforeend", row);
    });
  } catch (error) {
    console.error("Lỗi khi lấy danh sách features:", error);
  }
}

document.addEventListener("DOMContentLoaded", getFeatures);

async function addFeature() {
  const name_feature = document.getElementById("name_feature_ipt").value.trim();
  if (!name_feature) {
    alert("Vui lòng nhập đầy đủ!");
    return;
  }
  const formData = new FormData();
  formData.append("add_feature", "true");
  formData.append("name_feature", name_feature);
  try {
    const res = await fetch("ajax/feature_facilities_crud.php", {
      method: "POST",
      body: formData,
    });
    if (!res.ok) throw new Error("HTTP status " + res.status);
    const data = await res.text();
    console.log("✅ Phản hồi thêm đặc trưng:", data);
    getFeatures();
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("features-s")
    );
    modal.hide();
    document.getElementById("name_feature_ipt").value = "";
  } catch (error) {
    console.log(error);
  }
}

function resetFormFeature() {
  document.getElementById("name_feature_ipt").value = "";
}

function confirmIdEditFe(id, name) {
  const btn = document.getElementById("confirmUpdateFeatureBtn");
  btn.setAttribute("data-id", id);
  console.log(name);

  const value = document.getElementById("name_feature_update_ipt");
  value.value = name; // gán tên hiện tại vào ô input

  const modal = new bootstrap.Modal(
    document.getElementById("confirmUpdateFeature")
  );
  modal.show();
}

document
  .getElementById("confirmUpdateFeatureBtn")
  .addEventListener("click", async function () {
    const id = this.getAttribute("data-id");
    const name_feature = document
      .getElementById("name_feature_update_ipt")
      .value.trim();
    const formData = new FormData();
    formData.append("update_feature", "true");
    formData.append("id", id);
    formData.append("name", name_feature);
    try {
      const res = await fetch("ajax/feature_facilities_crud.php", {
        method: "POST",
        body: formData,
      });
      if (!res.ok) throw new Error("HTTP status " + res.status);
      const data = await res.json();

      if (data.success) {
        getFeatures();
        bootstrap.Modal.getInstance(
          document.getElementById("confirmUpdateFeature")
        )?.hide();
      } else {
        alert(data.message || "Cập nhật thất bại");
      }
    } catch (error) {
      console.error(error);
      alert("Có lỗi khi cập nhật ");
    }
  });

function confirmIdDeleteFe(id) {
  const btn = document.getElementById("confirmDeleteFeatureBtn");
  btn.setAttribute("data-id", id);
  const modal = new bootstrap.Modal(
    document.getElementById("confirmDeleteFeature")
  );
  modal.show();
}

document
  .getElementById("confirmDeleteFeatureBtn")
  .addEventListener("click", async function () {
    const id = this.getAttribute("data-id");
    const formData = new FormData();
    formData.append("delete_feature", "true");
    formData.append("id", id);

    try {
      const res = await fetch("ajax/feature_facilities_crud.php", {
        method: "POST",
        body: formData,
      });
      if (!res.ok) throw new Error("HTTP status " + res.status);
      const data = await res.json();

      if (data.success) {
        getFeatures();
        bootstrap.Modal.getInstance(
          document.getElementById("confirmDeleteFeature")
        )?.hide();
      } else {
        alert(data.message || "Xóa thất bại");
      }
    } catch (error) {
      console.error(error);
      alert("Có lỗi khi xóa đặc trưng");
    }
  });

//   facilities

async function getFacilities() {
  try {
    const res = await fetch("ajax/feature_facilities_crud.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "get_facilities=true",
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.json();
    console.log("Danh sách facilities nhận được:", data);

    const container = document.getElementById("facilities-data");
    container.innerHTML = "";

    if (data.length === 0) {
      container.innerHTML = `
        <tr>
          <td colspan="5" class="text-center text-muted">Chưa có đặc trưng nào.</td>
        </tr>
      `;
      return;
    }

    data.forEach((facility, index) => {
      const row = `
        <tr>
          <td class="text-center">${index + 1}</td>
          <td>${facility.name}</td>
          <td class="text-center">
            <img src="../admin/${facility.icon}" alt="${
        facility.name
      }" style="width:40px; height:40px; object-fit:contain;">
          </td>
          <td>${facility.description}</td>
          <td class="text-center">
            <div class="d-flex justify-content-center gap-1">
                <button onclick="confirmIdEditFa(${facility.cr_no}, 
                '${facility.name}', '${facility.icon}', 
                '${facility.description}')" class="btn btn-sm btn-primary">
                Sửa</button>
                <button onclick="confirmIdDeleteFa(${facility.cr_no})" 
            class="btn btn-sm btn-danger">Xóa</button>
  </div>
</td>
        </tr>
      `;
      container.insertAdjacentHTML("beforeend", row);
    });
  } catch (error) {
    console.error("Lỗi khi lấy danh sách features:", error);
  }
}

document.addEventListener("DOMContentLoaded", getFacilities);

async function addFacilities() {
  const name_facilities = document
    .getElementById("name_facilities")
    .value.trim();
  const icon_facilities = document.getElementById("icon_facilities").files[0];
  const description_facilities = document
    .getElementById("description_facilities")
    .value.trim();
  if (!name_facilities || !icon_facilities || !description_facilities) {
    alert("Vui lòng nhập đầy đủ!");
    return;
  }
  const formData = new FormData();
  formData.append("add_facilities", "true");
  formData.append("name_facilities", name_facilities);
  formData.append("icon_facilities", icon_facilities);
  formData.append("description_facilities", description_facilities);
  try {
    const res = await fetch("ajax/feature_facilities_crud.php", {
      method: "POST",
      body: formData,
    });
    if (!res.ok) throw new Error("HTTP status " + res.status);
    const data = await res.text();
    console.log("✅ Phản hồi them tiện nghi:", data);
    getFacilities();
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("facilities-s")
    );
    modal.hide();
    document.getElementById("name_facilities").value = "";
    document.getElementById("icon_facilities").value = "";
    document.getElementById("description_facilities").value = "";
  } catch (error) {
    console.log(error);
  }
}

function resetFormFacilities() {
  document.getElementById("name_facilities").value = "";
  document.getElementById("icon_facilities").value = "";
  document.getElementById("description_facilities").value = "";
}

// Mở modal edit cho Facilities
function confirmIdEditFa(id, name, icon, description) {
  const btn = document.getElementById("confirmUpdateFacilitiesBtn");
  btn.setAttribute("data-id", id);

  document.getElementById("name_facilities_update").value = name;
  document.getElementById("description_facilities_update").value = description;

  // Hiển thị icon hiện tại qua <img>, không gán cho input[type=file]
  document.getElementById("current_icon_facilities").src = icon;

  const modal = new bootstrap.Modal(
    document.getElementById("confirmUpdateFacilities")
  );
  modal.show();
}

document
  .getElementById("confirmUpdateFacilitiesBtn")
  .addEventListener("click", async function () {
    const id = this.getAttribute("data-id");
    const name = document.getElementById("name_facilities_update").value.trim();
    const description = document
      .getElementById("description_facilities_update")
      .value.trim();
    const iconFile = document.getElementById("icon_facilities_update").files[0];

    if (!name || !description) {
      alert("Vui lòng nhập đầy đủ thông tin!");
      return;
    }

    const formData = new FormData();
    formData.append("update_facility", "true");
    formData.append("id", id);
    formData.append("name_facilities_input", name);
    formData.append("description_facilities_input", description);

    // Chỉ gửi file mới nếu người dùng chọn
    if (iconFile) formData.append("icon_facilities_input", iconFile);

    try {
      const res = await fetch("ajax/feature_facilities_crud.php", {
        method: "POST",
        body: formData,
      });
      const data = await res.json();

      if (data.success) {
        getFacilities();
        bootstrap.Modal.getInstance(
          document.getElementById("confirmUpdateFacilities")
        )?.hide();
      } else {
        alert(data.message || "Cập nhật thất bại");
      }
    } catch (error) {
      console.error(error);
      alert("Có lỗi khi cập nhật facility");
    }
  });

function confirmIdDeleteFa(id) {
  const btn = document.getElementById("confirmDeleteFacilitiesBtn");
  btn.setAttribute("data-id", id);
  const modal = new bootstrap.Modal(
    document.getElementById("confirmDeleteFacilities")
  );
  modal.show();
}

document
  .getElementById("confirmDeleteFacilitiesBtn")
  .addEventListener("click", async function () {
    const id = this.getAttribute("data-id");
    const formData = new FormData();
    formData.append("delete_facilities", "true");
    formData.append("id", id);

    try {
      const res = await fetch("ajax/feature_facilities_crud.php", {
        method: "POST",
        body: formData,
      });
      if (!res.ok) throw new Error("HTTP status " + res.status);
      const data = await res.json();

      if (data.success) {
        getFacilities();
        bootstrap.Modal.getInstance(
          document.getElementById("confirmDeleteFacilities")
        )?.hide();
      } else {
        alert(data.message || "Xóa thất bại");
      }
    } catch (error) {
      console.error(error);
      alert("Có lỗi khi xóa đặc trưng");
    }
  });

async function getRooms() {
  try {
    const res = await fetch("ajax/rooms_crud.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "get_rooms=true",
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.json();
    console.log("Danh sách rooms nhận được:", data);

    const container = document.getElementById("rooms-data");
    container.innerHTML = "";

    if (data.length === 0) {
      container.innerHTML = `
        <tr>
          <td colspan="8" class="text-center text-muted">Chưa có phòng nào.</td>
        </tr>
      `;
      return;
    }

    data.forEach((room, index) => {
      const row = `
        <tr>
          <td class="text-center">${index + 1}</td>
          <td>${room.name}</td>
          <td>${room.area} m²</td>
          <td>
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center mb-1">
                <i class="bi bi-person me-2 text-primary"></i>
                <span>${room.adult} người lớn</span>
                </div>
                <div class="d-flex align-items-center">
                <i class="bi bi-emoji-smile me-2 text-success"></i>
                <span>${room.children} trẻ em</span>
                </div>
            </div>
          </td>
          <td>${room.price} VNĐ</td>
          <td>${room.quantity}</td>
          <td class="text-center">
            <button 
                onclick="toggleStatus(${room.cr_no}, ${room.status})"
                    class="btn btn-sm ${
                      room.status == 0 ? "btn-warning" : "btn-success"
                    }">
                ${room.status == 0 ? "Tạm ngưng" : "Hoạt động"}
            </button>
          </td>
          <td class="text-center">
            <button class="btn btn-sm btn-primary" 
                    onclick="openEditRoom(${room.cr_no})">
                Sửa
            </button>
            <button class="btn btn-sm btn-warning"
                    onclick="openAddImagesModal(${room.cr_no})">
                Thêm ảnh
            </button>
            <button class="btn btn-sm btn-danger"
                    onclick="confirmIdDeleteRoom(${room.cr_no})">
                Xóa
            </button>
          </td>

        </tr>
      `;
      container.insertAdjacentHTML("beforeend", row);
    });
  } catch (error) {
    console.error("Lỗi khi lấy danh sách rooms:", error);
  }
}

document.addEventListener("DOMContentLoaded", getRooms);

async function addRoom() {
  const add_room_form = document.querySelector("#rooms-s form");
  const formData = new FormData(add_room_form);
  formData.append("add_room", "true");

  try {
    const res = await fetch("ajax/rooms_crud.php", {
      method: "POST",
      body: formData,
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.text();
    console.log(" Phản hồi thêm phòng:", data);
    add_room_form.reset();
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("rooms-s")
    );
    modal.hide();
    getRooms();
  } catch (error) {
    console.log(error);
  }
}
function resetFormRoom() {
  document.getElementById("room_id_ipt").value = "";
  document.getElementById("room_name_ipt").value = "";
  document.getElementById("room_area_ipt").value = "";
  document.getElementById("room_price_ipt").value = "";
  document.getElementById("room_quantity_ipt").value = "";
  document.getElementById("room_adult_ipt").value = "";
  document.getElementById("room_children_ipt").value = "";
  document.getElementById("room_description_ipt").value = "";
  document.getElementById("room_status_ipt").value = "1";

  // Xóa toàn bộ features và facilities render động
  document.getElementById("features_box_ipt").innerHTML = "";
  document.getElementById("facilities_box_ipt").innerHTML = "";

  document.getElementById("room_name").value = "";
  document.getElementById("room_area").value = "";
  document.getElementById("room_price").value = "";
  document.getElementById("room_quantity").value = "";
  document.getElementById("room_adult").value = "";
  document.getElementById("room_children").value = "";
  document.getElementById("room_description").value = "";

  document.querySelectorAll("input[name='features[]']").forEach((cb) => {
    cb.checked = false;
  });

  document.querySelectorAll("input[name='facilities[]']").forEach((cb) => {
    cb.checked = false;
  });

  // Nếu modal đang mở thì đóng lại
  const modal = bootstrap.Modal.getInstance(
    document.getElementById("editRoomModal")
  );
  if (modal) modal.hide();
}

async function toggleStatus(id, currentStatus) {
  const newStatus = currentStatus == 0 ? 1 : 0;

  const formData = new FormData();
  formData.append("toggle_status", "true");
  formData.append("id", id);
  formData.append("status", newStatus);

  try {
    const res = await fetch("ajax/rooms_crud.php", {
      method: "POST",
      body: formData,
    });

    const data = await res.text();
    console.log("Cập nhật status:", data);

    getRooms();
  } catch (err) {
    console.error("Lỗi cập nhật trạng thái:", err);
  }
}

async function openEditRoom(id) {
  const formData = new FormData();
  formData.append("get_room_by_id", "true");
  formData.append("room_id", id);

  try {
    const res = await fetch("ajax/rooms_crud.php", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();
    console.log("data:", data);
    let r = data.room;

    document.getElementById("room_id_ipt").value = r.cr_no;
    document.getElementById("room_name_ipt").value = r.name;
    document.getElementById("room_area_ipt").value = r.area;
    document.getElementById("room_price_ipt").value = r.price;
    document.getElementById("room_quantity_ipt").value = r.quantity;
    document.getElementById("room_adult_ipt").value = r.adult;
    document.getElementById("room_children_ipt").value = r.children;
    document.getElementById("room_description_ipt").value = r.description;
    document.getElementById("room_status_ipt").value = r.status;

    let ft = "";
    data.features.forEach((f) => {
      let checked = data.room_features.includes(String(f.id)) ? "checked" : "";
      ft += `
    <div class="col-md-3 mb-2">
      <div class="form-check">
        <input type="checkbox" class="form-check-input"
               name="features[]" id="feature__ipt${f.id}" value="${f.id}" ${checked}>
        <label class="form-check-label" for="feature__ipt${f.id}">${f.name}</label>
      </div>
    </div>`;
    });
    document.getElementById("features_box_ipt").innerHTML = ft;

    let fc = "";
    data.facilities.forEach((f) => {
      let checked = data.room_facilities.includes(String(f.id))
        ? "checked"
        : "";
      fc += `
    <div class="col-md-3 mb-2">
      <div class="form-check">
        <input type="checkbox" class="form-check-input"
               name="facilities[]" id="facility__ipt${f.id}" value="${f.id}" ${checked}>
        <label class="form-check-label" for="facility__ipt${f.id}">${f.name}</label>
      </div>
    </div>`;
    });
    document.getElementById("facilities_box_ipt").innerHTML = fc;

    let modal = new bootstrap.Modal(document.getElementById("editRoomModal"));
    modal.show();
  } catch (err) {
    console.log(" Lỗi openEditRoom:", err);
  }
}

async function saveRoomChanges() {
  const roomId = document.getElementById("room_id_ipt").value;
  if (!roomId) return alert("ID phòng không tồn tại!");

  const formData = new FormData();
  formData.append("update_room", "true");
  formData.append("room_id", roomId);

  // Lấy tất cả giá trị input
  formData.append("name", document.getElementById("room_name_ipt").value);
  formData.append("area", document.getElementById("room_area_ipt").value);
  formData.append("price", document.getElementById("room_price_ipt").value);
  formData.append(
    "quantity",
    document.getElementById("room_quantity_ipt").value
  );
  formData.append("adults", document.getElementById("room_adult_ipt").value);
  formData.append(
    "children",
    document.getElementById("room_children_ipt").value
  );
  formData.append(
    "description",
    document.getElementById("room_description_ipt").value
  );
  formData.append("status", document.getElementById("room_status_ipt").value);

  document
    .querySelectorAll("input[name='features[]']:checked")
    .forEach((cb) => {
      formData.append("features[]", cb.value);
    });
  document
    .querySelectorAll("input[name='facilities[]']:checked")
    .forEach((cb) => {
      formData.append("facilities[]", cb.value);
    });

  try {
    const res = await fetch("ajax/rooms_crud.php", {
      method: "POST",
      body: formData,
    });
    if (!res.ok) throw new Error("HTTP status " + res.status);
    const data = await res.text();
    console.log(" Phản hồi update phòng:", data);

    const modal = bootstrap.Modal.getInstance(
      document.getElementById("editRoomModal")
    );
    if (modal) modal.hide();

    getRooms();
    resetFormRoom();
  } catch (err) {
    console.error("Lỗi khi update phòng:", err);
  }
}

function openAddImagesModal(roomId) {
  document.getElementById("img_room_id").value = roomId;
  const modal = new bootstrap.Modal(document.getElementById("addImagesModal"));
  modal.show();
}

function resetAddImagesForm() {
  document.getElementById("addImagesForm").reset();
  document.getElementById("preview_images").innerHTML = "";
}

// Preview ảnh khi chọn file
document.getElementById("room_images").addEventListener("change", function () {
  const preview = document.getElementById("preview_images");
  preview.innerHTML = "";
  Array.from(this.files).forEach((file) => {
    const reader = new FileReader();
    reader.onload = (e) => {
      const img = document.createElement("img");
      img.src = e.target.result;
      img.style.width = "100px";
      img.style.height = "100px";
      img.style.objectFit = "cover";
      img.classList.add("border", "p-1");
      preview.appendChild(img);
    };
    reader.readAsDataURL(file);
  });
});

async function addRoomImage() {
  const roomId = document.getElementById("img_room_id").value;
  const fileInput = document.getElementById("room_images");
  if (!roomId) return alert("ID phòng không tồn tại!");
  if (fileInput.files.length === 0) return alert("Chưa chọn ảnh!");

  const formData = new FormData();
  formData.append("room_id", roomId);
  formData.append("add_image", "true");
  formData.append("img_file", fileInput.files[0]); // chỉ upload 1 ảnh

  try {
    const res = await fetch("ajax/rooms_crud.php", {
      method: "POST",
      body: formData,
    });
    const data = await res.text();
    // console.log("Server trả:", data);
    resetAddImagesForm();
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("addImagesModal")
    );
    if (modal) modal.hide();
  } catch (err) {
    console.error("Lỗi upload ảnh:", err);
  }
}

async function confirmIdDeleteRoom(roomId) {
  if (!confirm("Bạn có chắc chắn muốn xóa phòng này không?")) return;

  const formData = new FormData();
  formData.append("delete_room", "true");
  formData.append("room_id", roomId);

  try {
    const res = await fetch("ajax/rooms_crud.php", {
      method: "POST",
      body: formData,
    });

    if (!res.ok) throw new Error("HTTP status " + res.status);

    const data = await res.text();
    console.log("Phản hồi xóa phòng:", data);
    getRooms();
  } catch (error) {
    console.error(error);
  }
}

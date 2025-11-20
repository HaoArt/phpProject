async function updateStatus(id, status) {
  try {
    const res = await fetch("ajax/booking.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `id=${encodeURIComponent(id)}&status=${encodeURIComponent(
        status
      )}&change_status=true`,
    });

    // Dùng res.text() rồi parse JSON
    const textData = await res.text();
    let data;
    try {
      data = JSON.parse(textData);
    } catch (err) {
      console.error("JSON parse error:", err, textData);
      alert("Lỗi server! Dữ liệu không hợp lệ.");
      return;
    }

    if (data.success) {
      // Cập nhật trực tiếp ô trạng thái
      document.getElementById("status-" + id).innerHTML = data.badge;
    } else {
      alert("Cập nhật thất bại: " + data.message);
    }
  } catch (err) {
    console.error(err);
    alert("Lỗi server!");
  }
}

// Lấy danh sách booking và render ra bảng
async function getBookingRoom() {
  try {
    const res = await fetch("ajax/booking.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "action=get_bookings",
    });

    // dùng res.text() thay vì res.json()
    const textData = await res.text();

    // parse chuỗi JSON sang object
    let data;
    try {
      data = JSON.parse(textData);
    } catch (err) {
      console.error("JSON parse error:", err, textData);
      document.getElementById("bookingContainer").innerHTML =
        "<p>Lỗi server! Dữ liệu không hợp lệ.</p>";
      return;
    }

    if (!data.success && !Array.isArray(data)) {
      document.getElementById("bookingContainer").innerHTML = `<p>${
        data.message || "Lỗi dữ liệu"
      }</p>`;
      return;
    }

    // Nếu trả về mảng bookings trực tiếp
    const bookings = Array.isArray(data) ? data : data.bookings;

    if (!bookings.length) {
      document.getElementById("bookingContainer").innerHTML =
        "<p>Chưa có booking nào.</p>";
      return;
    }

    let html = `<table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Người đặt</th>
                    <th>Email</th>
                    <th>Phòng</th>
                    <th>Ngày nhận</th>
                    <th>Ngày trả</th>
                    <th>Tổng giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>`;

    bookings.forEach((b, index) => {
      let statusBadge = "";
      switch (b.status) {
        case "0":
          statusBadge = "<span class='badge bg-warning'>Đang chờ</span>";
          break;
        case "1":
          statusBadge = "<span class='badge bg-success'>Xác nhận</span>";
          break;
        case "2":
          statusBadge = "<span class='badge bg-danger'>Đã hủy</span>";
          break;
      }

      html += `<tr>
                <td>${index + 1}</td>
                <td>${b.user_name}</td>
                <td>${b.user_email}</td>
                <td>${b.room_name}</td>
                <td>${b.check_in}</td>
                <td>${b.check_out}</td>
                <td>${Number(b.total_price).toLocaleString()} VND</td>
                <td id="status-${b.cr_no}">${statusBadge}</td>
                <td>
                    <select class="form-select form-select-sm" onchange="updateStatus(${
                      b.cr_no
                    }, this.value)">
                        <option value="0" ${
                          b.status == "0" ? "selected" : ""
                        }>Đang chờ</option>
                        <option value="1" ${
                          b.status == "1" ? "selected" : ""
                        }>Xác nhận</option>
                        <option value="2" ${
                          b.status == "2" ? "selected" : ""
                        }>Đã hủy</option>
                    </select>
                </td>
            </tr>`;
    });

    html += "</tbody></table>";
    document.getElementById("bookingContainer").innerHTML = html;
  } catch (err) {
    console.error(err);
    document.getElementById("bookingContainer").innerHTML =
      "<p>Lỗi server!</p>";
  }
}

document.addEventListener("DOMContentLoaded", getBookingRoom);

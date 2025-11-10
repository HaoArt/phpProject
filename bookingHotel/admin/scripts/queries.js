async function deleteQuery(id) {
  if (id === "all") {
    if (!confirm("Bạn có chắc muốn xóa tất cả không?")) return;
  } else {
    if (!confirm("Xóa liên hệ này?")) return;
  }

  let formData = new FormData();
  formData.append("delete_query", "true");
  formData.append("id", id);

  const res = await fetch("ajax/settings_crud.php", {
    method: "POST",
    body: formData,
  });

  const data = await res.text();
  if (data.trim() === "success") {
    alert("Xóa thành công");
    location.reload();
  } else {
    alert("Lỗi khi xóa");
  }
}

async function updateSeen(id) {
  if (id === "all") {
    if (!confirm("Đánh dấu tất cả đã đọc?")) return;
  }

  let formData = new FormData();
  formData.append("update_seen", "true");
  formData.append("id", id);

  const res = await fetch("ajax/settings_crud.php", {
    method: "POST",
    body: formData,
  });

  const data = await res.text();
  if (data.trim() === "success") {
    alert("Cập nhật thành công");
    location.reload();
  } else {
    alert("Lỗi khi cập nhật");
  }
}

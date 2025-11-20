function booking() {
  const form = document.getElementById("bookingForm");
  const formData = new FormData(form);

  fetch("ajax/booking.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        alert(data.message);
        window.location.href = "booking_history.php";
      } else {
        alert("Lỗi: " + data.message);
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Lỗi server!");
    });
}

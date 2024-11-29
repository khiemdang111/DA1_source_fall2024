// Hàm xử lý việc xác nhận giao hàng thành công
function handleShippingConfirmation(url) {
  Swal.fire({
    title: "Bạn có chắc chắn muốn xác nhận giao hàng thành công?",
    text: "Thao tác này không thể hoàn tác!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Xác nhận",
    cancelButtonText: "Hủy",
  }).then((result) => {
    // Nếu người dùng xác nhận
    if (result.isConfirmed) {
      Swal.fire({
        title: "Xác nhận thành công!",
        icon: "success",
      }).then(() => {
        // Điều hướng tới URL được chỉ định
        window.location.href = url;
      });
    } else {
      // Nếu người dùng hủy, ghi log hoặc không làm gì
      console.log("Người dùng đã hủy thao tác.");
    }
  });
}

// Gắn sự kiện click cho tất cả các nút xác nhận
document.querySelectorAll(".delete-shippingUpdates").forEach((button) => {
  button.addEventListener("click", (event) => {
    event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>
    const url = button.getAttribute("data-url"); // Lấy URL từ data-url
    handleShippingConfirmation(url); // Gọi hàm xác nhận
  });
});

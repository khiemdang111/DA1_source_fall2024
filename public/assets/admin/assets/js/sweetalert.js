// Hàm xử lý việc xác nhận và gửi form
function handleDeleteFormSubmission(form) {
  // Hiển thị SweetAlert yêu cầu xác nhận
  Swal.fire({
    title: "Bạn có chắc chắn muốn xóa?",
    text: "Thêm vào thùng rác",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ok"
  }).then((result) => {
    // Kiểm tra kết quả của SweetAlert
    if (result.isConfirmed) {
      // Nếu người dùng chọn "Ok", hiển thị thông báo xóa thành công
      Swal.fire({
        title: "Xóa thành công!",
        icon: "success"
      }).then(() => {
        // Gửi form khi người dùng xác nhận xóa
        form.submit();
      });
    } else {
      // Nếu người dùng chọn "Cancel", không làm gì cả
      console.log('Hủy bỏ xóa');
    }
  });
}

// Lắng nghe sự kiện click trên tất cả các nút có class "delete-button"
document.querySelectorAll('.delete-button').forEach((button) => {
  button.addEventListener('click', (event) => {
    // Ngăn hành động mặc định của nút
    event.preventDefault();

    // Lấy form cha của nút hiện tại
    const form = button.closest('form');

    // Gọi hàm xử lý gửi form
    handleDeleteFormSubmission(form);
  });
});

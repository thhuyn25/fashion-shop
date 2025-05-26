// js/script.js
document.querySelectorAll(".btn").forEach((button) => {
  button.addEventListener("click", function (e) {
    e.preventDefault();
    alert("Sản phẩm đã được thêm vào giỏ hàng!");
  });
});

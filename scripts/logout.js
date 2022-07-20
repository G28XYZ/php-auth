document.addEventListener("DOMContentLoaded", () => {
  const logoutButton = document.querySelector(".auth__logout");
  logoutButton.addEventListener("click", () => {
    document.location.href = "?logout=1";
  });
});

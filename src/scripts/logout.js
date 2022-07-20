document.addEventListener("DOMContentLoaded", () => {
  const logoutButton = document.querySelector(".header__button_logout");
  logoutButton.addEventListener("click", () => {
    document.location.href = "?logout=1";
  });
});

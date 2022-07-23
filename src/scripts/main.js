const editButtons = document.querySelectorAll(".chat__edit-button");
const deleteButtons = document.querySelectorAll(".chat__delete-button");

deleteButtons.forEach((editButton) =>
  editButton.addEventListener("click", (e) => {
    const userId = e.target.dataset.userId;
    const postId = e.target.dataset.postId;
    document.location.href = `/?userId=${userId}&postId=${postId}&delete=1`;
  })
);

editButtons.forEach((editButton) =>
  editButton.addEventListener("click", (e) => {
    const userId = e.target.dataset.userId;
    const postId = e.target.dataset.postId;
    document.location.href = `/?userId=${userId}&postId=${postId}`;
  })
);

const timer = document.querySelector(".timer") || "";
function getRemains() {
  const timeFromCookie = document.cookie
    .split(";")
    .find((str) => str.includes("timer="))
    .replace("timer=", "");
  const date = new Date();
  const remains = parseInt(300 - (date.getTime() / 1000 - timeFromCookie));
  timer.textContent = "Сессия закончится через " + remains + " сек.";
  if (remains <= 0) {
    document.location.href = "/?login=1";
    clearInterval(getRemains);
  }
  return remains;
}
if (timer) {
  getRemains();
  setInterval(getRemains, 1000);
}

document.addEventListener("DOMContentLoaded", () => {
  const logoutButton = document.querySelector(".header__button_logout");
  logoutButton.addEventListener("click", () => {
    document.location.href = "?logout=1";
  });
});

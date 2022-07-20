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
    document.location.href = "/";
    clearInterval(getRemains);
  }
  return remains;
}
if (timer) {
  getRemains();
  setInterval(getRemains, 1000);
}

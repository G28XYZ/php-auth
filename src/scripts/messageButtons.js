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

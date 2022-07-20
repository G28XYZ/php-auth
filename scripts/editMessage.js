const editButtons = document.querySelectorAll(".chat__edit-button");

editButtons.forEach((editButton) =>
  editButton.addEventListener("click", (e) => {
    const userId = e.target.dataset.userId;
    const postId = e.target.dataset.postId;
    console.log({ userId, postId });
    document.location.href = `/?userId=${userId}&postId=${postId}`;
  })
);

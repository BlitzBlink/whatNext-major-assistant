<?php
$page = 'profile';
include_once('../templates/header.php');
include_once('../src/config/db.php');
$account_id = $_SESSION['account_id'] ?? null;
if ($account_id) {
    $stmt1 = $conn->prepare("SELECT fName, lName FROM User WHERE account_id = ?");
    $stmt1->bind_param("i", $account_id);
    $stmt1->execute();
    $stmt1->bind_result($fName, $lName);
    $stmt1->fetch();
    $stmt1->close();

    $stmt2 = $conn->prepare("SELECT email, username FROM Account WHERE account_id = ?");
    $stmt2->bind_param("i", $account_id);
    $stmt2->execute();
    $stmt2->bind_result($email, $username);
    $stmt2->fetch();
    $stmt2->close();
} else {
    header("Location: /whatnext/public/login.php");
}
?>

<main class="profile">
    <section>
        <div class="container">
            <div>
                <h1>Profile Overview</h1>
            </div>
            <div class="profile-card">
                <div class="edit-button">
                    <img src="/whatnext/public/assets/images/icon-edit.svg" class="edit-icon" />
                    <span>Edit Profile</span>
                </div>
                <div>
                    <img src="/whatnext/public/assets/images/icon-profile.svg" class="profile-icon" />
                </div>
                <div class="info-container">
                    <div class="info-row">
                        <span class="label">Name:</span>
                        <span class="value"><?= htmlspecialchars($fName . " " . $lName)?></span>
                    </div>
                    <div class="info-row">
                        <span class="label">Username:</span>
                        <span class="value"><?= htmlspecialchars($username)?></span>
                    </div>
                    <div class="info-row">
                        <span class="label">Email:</span>
                        <span class="value"><?= htmlspecialchars($email)?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<div class="modal-overlay hidden" id="edit-modal">
    <div class="modal">
        <button type="button" id="cancel-edit" class="cancel-button">
            <img src="/whatnext/public/assets/images/icon-close.svg" class="close-icon"/>
        </button>
        <h2>Update Profile</h2>
        <form class="form" method="POST" action="/whatnext/src/actions/update_profile.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder=<?= htmlspecialchars($username)?> required />

            <input type="submit" class="button button-primary" value="Save"></input>
        </form>
    </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const editBtn = document.querySelector(".edit-button");
    const modal = document.getElementById("edit-modal");
    const cancelBtn = document.getElementById("cancel-edit");

    editBtn.addEventListener("click", () => {
      modal.classList.remove("hidden");
    });

    cancelBtn.addEventListener("click", () => {
      modal.classList.add("hidden");
    });
  });
</script>
<?php include_once('../templates/footer.php'); ?>
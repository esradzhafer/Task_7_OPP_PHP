<?php

require_once 'User.php';
require_once 'Database.php';
require_once 'UserManagement.php';

$userManagement = new UserManagement();
$database = new Database();

// Handle adding a new user
if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $userManagement->createUser($username, $email, $role);
    // Display success message or redirect
}

// Handle retrieving user information
if (isset($_GET['retrieve'])) {
    $userId = $_GET['userId'];
    $user = $database->getUserById($userId);
}

// Handle updating user information
if (isset($_POST['update'])) {
    $userId = $_POST['updateUserId'];
    $newUsername = $_POST['updateUsername'];
    $newEmail = $_POST['updateEmail'];
    $newRole = $_POST['updateRole'];

    $updated = $database->updateUser($userId, $newUsername, $newEmail, $newRole);
}

// Handle deleting a user
if (isset($_POST['delete'])) {
    $userId = $_POST['deleteUserId'];
    $deleted = $database->deleteUser($userId);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <div class="container">
       <div class="heading"> <h1>User Management System</h1></div>

        <!-- Adding a new user -->
        <div class="form-section">
            <h2 class="section-heading">Add a New User</h2>
            <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select><br>

                <button type="submit" name="create">Create User</button>
            </form>
        </div>

        <!-- Retrieving user information -->
        <div class="form-section">
            <h2 class="section-heading">Retrieve User Information</h2>
            <form action="" method="get">
                <label for="userId">User ID:</label>
                <input type="text" id="userId" name="userId" required>
                <button type="submit" name="retrieve">Retrieve User</button>
            </form>
            <?php if (isset($user)): ?>
                <div class="user-info">
                    <h3 class="user-heading">User Information:</h3>
                    <p class="user-property">Username: <?php echo $user['username']; ?></p>
                    <p class="user-property">Email: <?php echo $user['email']; ?></p>
                    <p class="user-property">Role: <?php echo $user['role']; ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Updating user information -->
        
            <div class="form-section">
                <h2 class="section-heading">Update User Information</h2>
                <form action="" method="post">
                    <label for="updateUserId">User ID:</label>
                    <input type="text" id="updateUserId" name="updateUserId" required><br>

                    <label for="updateUsername">New Username:</label>
                    <input type="text" id="updateUsername" name="updateUsername"><br>

                    <label for="updateEmail">New Email:</label>
                    <input type="email" id="updateEmail" name="updateEmail"><br>

                    <label for="updateRole">New Role:</label>
                    <select id="updateRole" name="updateRole">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select><br>

                    <button type="submit" name="update">Update User</button>
                </form>
                <?php if (isset($updated)): ?>
                    <p class="success-message">User information updated successfully.</p>
                <?php elseif (isset($updated)): ?>
                    <p class="error-message">Update failed.</p>
                <?php endif; ?>
            </div>

            <!-- Deleting a user -->
            <div class="form-section">
                <h2 class="section-heading">Delete User</h2>
                <form action="" method="post">
                    <label for="deleteUserId">User ID:</label>
                    <input type="text" id="deleteUserId" name="deleteUserId" required>
                    <button type="submit" name="delete">Delete User</button>
                </form>
                <?php if (isset($deleted)): ?>
                    <p class="success-message">User deleted successfully.</p>
                <?php elseif (isset($deleted)): ?>
                    <p class="error-message">Deletion failed.</p>
                <?php endif; ?>
            </div>
            

    </div>
</body>
</html>


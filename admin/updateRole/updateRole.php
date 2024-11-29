<?php
include '../../../website/connection/connection.php';


$userId = isset($_GET['id']) ? $_GET['id'] : null;
$username = isset($_GET['username']) ? $_GET['username'] : null;
$newRole = isset($_GET['newRole']) ? $_GET['newRole'] : null;


$currentRole = null;
if ($userId) {
    $currentRoleQuery = "SELECT role FROM (
                            SELECT id, 'Admin' AS role FROM admin
                            UNION ALL
                            SELECT id, 'User' AS role FROM customer
                            UNION ALL
                            SELECT id, 'Supplier' AS role FROM supplier
                        ) AS all_users WHERE id = ?";
    $stmt = $connection->prepare($currentRoleQuery);
    $stmt->bind_param('s', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentRoleData = $result->fetch_assoc();
    $currentRole = $currentRoleData['role'] ?? null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Role</title>
    <link rel="stylesheet" href="../updateRole/updateRole.css">
</head>
<body>
    <div class="edit">
        <h2>Edit User Role</h2>
        <div class="edit-items">
            <label for="user-id">User ID:</label>
            <input type="text" id="user-id" placeholder="<?php echo htmlspecialchars($userId ?? ''); ?>" disabled>

            <label for="username">Username:</label>
            <input type="text" id="username" placeholder="<?php echo htmlspecialchars($username ?? ''); ?>" disabled>

            <label for="current-role">Current Role:</label>
            <input type="text" id="current-role" placeholder="<?php echo htmlspecialchars($currentRole ?? ''); ?>" disabled>

            <label for="new-role">New Role:</label>
            <select id="new-role">
                <option value="user" <?php echo $currentRole === 'User' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $currentRole === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="supplier" <?php echo $currentRole === 'Supplier' ? 'selected' : ''; ?>>Supplier</option>
            </select>
        </div>
        <button id="submit-role-change">Submit</button>
    </div>
    <script src="../ViewUserData/ViewUserData.js"></script>
</body>
</html>
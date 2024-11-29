<?php
include '../header/header.php'; // Include DB connection

// Connect to the database


// Initialize variables for filters
$role = isset($_GET['role']) ? $_GET['role'] : 'all';
$status = isset($_GET['status']) ? $_GET['status'] : 'all';
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Build query conditions
$conditions = [];

if ($role !== 'all') {
    $conditions[] = "u.role = '$role'";
}
if ($status !== 'all') {
    $conditions[] = "status = '$status'";
}
if (!empty($username)) {
    $conditions[] = "(name LIKE '%$username%' OR email LIKE '%$username%')";
}



// Base query using UNION for all three tables
$query = "
    SELECT u.userid, u.role, u.status, data.name, data.email 
    FROM userstates u
    JOIN (
        SELECT id AS userid, 'Admin' AS role, name, email FROM admin
        UNION ALL
        SELECT id AS userid, 'Customer' AS role, CONCAT(f_name, ' ', l_name) AS name, email FROM customer
        UNION ALL
        SELECT id AS userid, 'Supplier' AS role, name, email FROM supplier
    ) as data ON u.userid = data.userid AND u.role = data.role";

// Add filters to the query
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
    
}

// Execute query
$result = mysqli_query($connection, $query);

$users = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

mysqli_close($connection);
?>


<link rel="stylesheet" href="../ViewUserData/ViewUserData.css">

<div class="content">
    <nav class="filter-nav">
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="filter-option">
                <label for="user-role">Filter by Role:</label>
                <select id="user-role" name="role">
                    <option value="all" <?= $role === 'all' ? 'selected' : '' ?>>All</option>
                    <option value="Admin" <?= $role === 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="Customer" <?= $role === 'Customer' ? 'selected' : '' ?>>User</option>
                    <option value="Supplier" <?= $role === 'Supplier' ? 'selected' : '' ?>>Supplier</option>
                </select>
            </div>
            <div class="filter-option">
                <label for="user-status">Filter by Status:</label>
                <select id="user-status" name="status">
                    <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All</option>
                    <option value="active" <?= $status === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="disabled" <?= $status === 'disabled' ? 'selected' : '' ?>>Disabled</option>
                </select>
            </div>
            <div class="filter-option">
                <label for="username">Search by Username:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" placeholder="Enter username">
            </div>
            <button type="submit" class="apply-filters-btn">Apply Filters</button>
        </form>
    </nav>

    <div class="view-users">
        <h1>View Users</h1>
        <table class="usersTable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user['userid']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td><?= htmlspecialchars($user['status']) ?></td>
                           
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="ViewUserData.js"></script>

<?php include '../footer/footer.php'; ?>
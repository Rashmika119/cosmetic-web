document.getElementById('submit-role-change').addEventListener('click', function() { 
    const newRole = document.getElementById('new-role').value;
    const userId = document.getElementById('user-id').value; // Get the user ID
    const currentRole = document.getElementById('current-role').value; // Get the current role

    if (currentRole !== newRole) {
        // Prepare a message to simulate the database changes
        let message = `User ID: ${userId}\n`;
        message += `Current Role: ${currentRole}\n`;
        message += `New Role: ${newRole}\n`;

        if (currentRole === 'Admin' && newRole === 'supplier') {
            message += "This user would be removed from the Admin table and added to the Supplier table.\n";
        } else if (currentRole === 'Supplier' && newRole === 'user') {
            message += "This user would be removed from the Supplier table and added to the User table.\n";
        } else {
            message += "No operations defined for the current role change.\n";
        }

        // Display the alert message
        alert(message);
    } else {
        alert('No change in role.');
    }
});

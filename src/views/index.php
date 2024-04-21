<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Book</title>
</head>
<body>
    <h1>Address Book</h1>
    <form action="index.php?action=add" method="post">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required><br>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" required><br>
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phoneNumber" id="phoneNumber" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required><br>
        <button type="submit">Add Contact</button>
    </form>
    <h2>Contacts:</h2>
    <ul>
        <?php foreach ($contacts as $contact): ?>
            <li>
                <?php echo $contact['first_name'] . ' ' . $contact['last_name']; ?>
                <form action="index.php?action=delete" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- Filtrowanie listy kontaktów -->
    <form method="get">
        <label for="filter">Filter by Name:</label>
        <input type="text" id="filter" name="filter" value="<?php echo $filter; ?>">
        <button type="submit">Filter</button>
    </form>
</body>
</html>
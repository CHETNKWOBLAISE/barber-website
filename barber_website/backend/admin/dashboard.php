<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

$sql = "SELECT * FROM bookings ORDER BY booking_date DESC, booking_time DESC";
$result = $conn->query($sql);
$total_bookings = 0;
$pending_bookings = 0;
$confirmed_bookings = 0;
$cancelled_bookings = 0;

$count_sql = "SELECT status, COUNT(*) AS total FROM bookings GROUP BY status";
$count_result = $conn->query($count_sql);

if ($count_result) {

    while ($row = $count_result->fetch_assoc()) {

        $status = $row["status"];
        $total = $row["total"];

        if ($status == "Pending") {
            $pending_bookings = $total;
        }

        if ($status == "Confirmed") {
            $confirmed_bookings = $total;
        }

        if ($status == "Cancelled") {
            $cancelled_bookings = $total;
        }
    }
}

$total_sql = "SELECT COUNT(*) AS total FROM bookings";
$total_result = $conn->query($total_sql);

if ($total_result) {
    $total_row = $total_result->fetch_assoc();
    $total_bookings = $total_row["total"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Blade & Style</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #111111;
            color: white;
        }

        .header {
            background: #1a1a1a;
            padding: 20px 5%;
            border-bottom: 1px solid #333;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logout-button {
    padding: 10px 18px;
    background: #d4a017;
    color: #111;
    text-decoration: none;
    font-weight: bold;
    border-radius: 4px;
    transition: 0.3s;
}

.logout-button:hover {
    background: white;
}

        .logo span {
            color: #d4a017;
        }

        .dashboard {
            width: 90%;
            max-width: 1300px;
            margin: 40px auto;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }
        .stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 8px;
    padding: 25px;
}

.stat-card h3 {
    color: #aaa;
    font-size: 14px;
    margin-bottom: 10px;
}

.stat-card p {
    color: #d4a017;
    font-size: 30px;
    font-weight: bold;
}

@media (max-width: 900px) {

    .stats {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 500px) {

    .stats {
        grid-template-columns: 1fr;
    }

}

        .dashboard-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            color: #aaa;
        }

        .booking-card {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            overflow-x: auto;
        }
        .booking-tools {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.booking-tools input,
.booking-tools select {
    padding: 12px 15px;
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 6px;
    color: white;
    font-size: 14px;
    outline: none;
}

.booking-tools input {
    flex: 1;
}

.booking-tools input:focus,
.booking-tools select:focus {
    border-color: #d4a017;
}

@media (max-width: 600px) {

    .booking-tools {
        flex-direction: column;
    }

}
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            background: #d4a017;
            color: #111;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #333;
        }

        tr:hover {
            background: #222;
        }

        .status {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.status-pending {
    background: #3a3215;
    color: #d4a017;
}

.status-confirmed {
    background: #163a24;
    color: #5fd88a;
}

.status-cancelled {
    background: #3a1717;
    color: #ff6b6b;
}

        .empty {
            padding: 30px;
            text-align: center;
            color: #aaa;
        }

        .back-button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 20px;
            background: #d4a017;
            color: #111;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
        }

        .back-button:hover {
            background: white;
        }

    </style>

</head>

<body>

<header class="header">

<div class="header-content">

    <div class="logo">
        BLADE <span>&</span> STYLE
    </div>

    <a href="logout.php" class="logout-button">
        Logout
    </a>

</div>

</header>


    <main class="dashboard">

        <div class="dashboard-header">

            <h1>Booking Dashboard</h1>

            <p>
                View and manage customer appointment requests.
            </p>

        </div>
        <div class="stats">

    <div class="stat-card">
        <h3>Total Bookings</h3>
        <p><?php echo $total_bookings; ?></p>
    </div>

    <div class="stat-card">
        <h3>Pending</h3>
        <p><?php echo $pending_bookings; ?></p>
    </div>

    <div class="stat-card">
        <h3>Confirmed</h3>
        <p><?php echo $confirmed_bookings; ?></p>
    </div>

    <div class="stat-card">
        <h3>Cancelled</h3>
        <p><?php echo $cancelled_bookings; ?></p>
    </div>

</div>

<div class="booking-tools">

<input
    type="text"
    id="searchBookings"
    placeholder="Search by customer or phone..."
>

<select id="statusFilter">
    <option value="all">All Bookings</option>
    <option value="Pending">Pending</option>
    <option value="Confirmed">Confirmed</option>
    <option value="Cancelled">Cancelled</option>
</select>

</div>
        <div class="booking-card">

            <?php if ($result && $result->num_rows > 0): ?>

                <table>

                    <thead>

                        <tr>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Message</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($booking = $result->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($booking["customer_name"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($booking["phone"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($booking["service"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($booking["booking_date"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($booking["booking_time"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($booking["message"]); ?>
                                </td>

                                <td>

                                <span class="status status-<?php echo strtolower($booking["status"]); ?>">
    <?php echo htmlspecialchars($booking["status"]); ?>
</span>

    <form action="../bookings/update_status.php" method="POST" style="display:inline;">

        <input type="hidden" name="id" value="<?php echo $booking["id"]; ?>">

        <button type="submit" name="status" value="Confirmed">
            Confirm
        </button>

        <button type="submit" name="status" value="Cancelled">
            Cancel
        </button>

    </form>

</td>

                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="empty">
                    No bookings found.
                </div>

            <?php endif; ?>

        </div>


        <a href="../../index.html" class="back-button">
            Back to Website
        </a>

    </main>

</body>

</html>

<?php

$conn->close();

?>
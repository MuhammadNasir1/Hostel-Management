<?php
include_once('../includes/dbconn.php');

$room_id = isset($_GET['room_id']) ? intval($_GET['room_id']) : 0;
if ($room_id > 0) {
    // Fetch the number of beds in the room
    $sql_room = "SELECT no_of_beds FROM rooms WHERE id = $room_id";
    $result_room = $conn->query($sql_room);

    if ($result_room->num_rows > 0) {
        $row_room = $result_room->fetch_assoc();
        $no_of_beds = $row_room['no_of_beds'];

        // Fetch the number of booked beds in the room
        $sql_booking = "SELECT COUNT(*) as booked_beds FROM room_registration WHERE room_id = $room_id";
        $result_booking = $conn->query($sql_booking);
        $row_booking = $result_booking->fetch_assoc();
        $booked_beds = $row_booking['booked_beds'];

        // Calculate available beds
        $available_beds = $no_of_beds - $booked_beds;

        if ($available_beds > 0) {
            echo "Room is available with $available_beds beds.";
        } else {
            echo "Room is fully booked.";
        }
    } else {
        echo "Room not found.";
    }
} else {
    echo "Invalid room ID.";
}

// Close the connection
$conn->close();

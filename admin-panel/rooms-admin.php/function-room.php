<?php 
require "../../koneksi.php";

// Fungsi untuk menambahkan ruangan atau create room
function showRoom($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
    return $rooms;
}
function deleteRoom($id) {
    global $conn;
    
    // Mulai transaksi
    mysqli_begin_transaction($conn);
    
    try {
        // Hapus gambar dan data dari tabel room_foto terlebih dahulu
        hapus($id);
        
        // Commit transaksi
        mysqli_commit($conn);
        
        return true; // Atau bisa mengembalikan informasi lain yang diperlukan
    } catch (mysqli_sql_exception $exception) {
        // Rollback transaksi jika ada error
        mysqli_rollback($conn);
        
        // Tampilkan error
        echo "Error: " . $exception->getMessage();
        
        return false;
    } 
}

function hapus($id_room){
    global $conn;
    // Hapus entri dari tabel room_fasilitas terlebih dahulu
    $query_delete_fasilitas = "DELETE FROM room_fasilitas WHERE id_room = ?";
    $stmt_fasilitas = mysqli_prepare($conn, $query_delete_fasilitas);
    mysqli_stmt_bind_param($stmt_fasilitas, 'i', $id_room);
    mysqli_stmt_execute($stmt_fasilitas);
    mysqli_stmt_close($stmt_fasilitas);

    // Ambil data terkait dari room_foto
    $file = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM room_foto WHERE id_room='$id_room'"));

    // Hapus file gambar jika ada
    if ($file && !empty($file["foto"])) {
        unlink('images/' . $file["foto"]);
    }

    // Hapus entri dari tabel room_foto
    $hapusFoto = "DELETE FROM room_foto WHERE id_room=?";
    $stmt_foto = mysqli_prepare($conn, $hapusFoto);
    mysqli_stmt_bind_param($stmt_foto, 'i', $id_room);
    mysqli_stmt_execute($stmt_foto);
    mysqli_stmt_close($stmt_foto);

    // Hapus entri dari tabel room
    $query_delete_room = "DELETE FROM room WHERE id_room=?";
    $stmt_room = mysqli_prepare($conn, $query_delete_room);
    mysqli_stmt_bind_param($stmt_room, 'i', $id_room);
    mysqli_stmt_execute($stmt_room);
    $affectedRows = mysqli_stmt_affected_rows($stmt_room);
    mysqli_stmt_close($stmt_room);

    return $affectedRows;
}
function createRoom($data){
    global $conn;
    $roomname = htmlspecialchars($data["room-name"]);
    $price = htmlspecialchars($data["room-price"]);
    $view = htmlspecialchars($data["room-view"]);
    $numbed = htmlspecialchars($data["num-beds"]);
    $status = htmlspecialchars($data["status"]);
    $fasilitas = isset($_POST['fasilitas']) ? $_POST['fasilitas'] : [];
    $images = uploadImage();

    $price = str_replace('IDR. ', '', $price);
    $price = str_replace('.', '', $price);
    $price = str_replace(',', '.', $price);

    if(!$images) {
        return false;
    }

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert into room table
        $query1 = "INSERT INTO room (nama, harga, num_beds, deskripsi, status, created_at, updated_at)
                   VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt1 = mysqli_prepare($conn, $query1);

        if (!$stmt1) {
            throw new Exception("Prepare statement failed for query1: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt1, 'sdiss', $roomname, $price, $numbed, $view, $status);

        if (!mysqli_stmt_execute($stmt1)) {
            throw new Exception("Error executing query1: " . mysqli_error($conn));
        }

        $id_room = mysqli_insert_id($conn);

        // Insert into room_foto table
        $query2 = "INSERT INTO room_foto (id_room, foto, created_at, updated_at)
                   VALUES (?, ?, NOW(), NOW())";
        $stmt2 = mysqli_prepare($conn, $query2);

        if (!$stmt2) {
            throw new Exception("Prepare statement failed for query2: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt2, 'is', $id_room, $images);

        if (!mysqli_stmt_execute($stmt2)) {
            throw new Exception("Error executing query2: " . mysqli_error($conn));
        }

        // Insert into room_fasilitas table for each selected facility
        foreach ($fasilitas as $fasilitas_id) {
            $query3 = "INSERT INTO room_fasilitas (id_room, id_fasilitas)
                       VALUES (?, ?)";
            $stmt3 = mysqli_prepare($conn, $query3);

            if (!$stmt3) {
                throw new Exception("Prepare statement failed for room_fasilitas: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt3, 'ii', $id_room, $fasilitas_id);

            if (!mysqli_stmt_execute($stmt3)) {
                throw new Exception("Error executing room_fasilitas query: " . mysqli_error($conn));
            }
        }

        // Commit transaction
        mysqli_commit($conn);

        // echo "Data berhasil dimasukkan ke tabel room, room_foto, dan room_fasilitas";
        return true;

    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function uploadImage() {
    $namaGambar = $_FILES['room-img']['name'];
    $ukuranGambar = $_FILES['room-img']['size'];
    $tmpGambar = $_FILES['room-img']['tmp_name'];
    $errorGambar = $_FILES['room-img']['error'];
    
    if ($errorGambar === 4) {
        echo "<script>alert('Data can't be empty!')</script>";
        return false;
    }
    
    $imageExtValid = ['jpeg', 'jpg', 'png'];
    $imageExt = explode('.', $namaGambar);
    $imageExt = strtolower(end($imageExt));
    
    if (!in_array($imageExt, $imageExtValid)) {
        echo "<script>alert('Data must be jpeg, jpg, png!')</script>";
        return false;
    }
    
    $mimeType = mime_content_type($tmpGambar);
    if (!in_array($mimeType, ['image/jpeg', 'image/jpg', 'image/png'])) {
        echo "<script>alert('File type is not valid!')</script>";
        return false;
    }
    
    $namaGambarBaru = uniqid() . '.' . $imageExt;
    $targetDir = 'images/';
    
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    
    if (move_uploaded_file($tmpGambar, $targetDir . $namaGambarBaru)) {
        return $namaGambarBaru;
    } else {
        echo "<script>alert('Failed to upload image!')</script>";
        return false;
    }
}

function getRooms() {
    global $conn;
    $query = "
        SELECT 
            r.id_room, r.nama, r.harga, r.num_beds, r.deskripsi, r.status, rf.foto,
            GROUP_CONCAT(f.nama_fasilitas) AS fasilitas_names
        FROM 
            room r
        LEFT JOIN 
            (SELECT rf.id_room, MIN(rf.foto) AS foto FROM room_foto rf GROUP BY rf.id_room) rf 
            ON r.id_room = rf.id_room
        LEFT JOIN 
            room_fasilitas rf2 ON r.id_room = rf2.id_room
        LEFT JOIN 
            fasilitas f ON rf2.id_fasilitas = f.id_fasilitas
        GROUP BY 
            r.id_room";
    
    $result = mysqli_query($conn, $query);
    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Mengubah fasilitas_names menjadi array nama fasilitas
        $row['fasilitas_names'] = explode(',', $row['fasilitas_names']);
        
        // Menghindari htmlspecialchars() pada array fasilitas_names
        foreach ($row['fasilitas_names'] as &$fasilitas_name) {
            $fasilitas_name = htmlspecialchars($fasilitas_name);
        }
        
        $rooms[] = $row;
    }
    return $rooms;
}


// Fungsi untuk membersihkan input (optional, untuk keamanan)
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function editRoom($data) {
    global $conn;

    $id_room = $data["id_room"];
    $roomname = htmlspecialchars($data["room-name"]);
    $price = htmlspecialchars($data["room-price"]);
    $view = htmlspecialchars($data["room-view"]);
    $numbed = htmlspecialchars($data["num-beds"]);
    $status = htmlspecialchars($data["status"]);
    $fasilitas = isset($_POST['fasilitas']) ? $_POST['fasilitas'] : [];
    $images = uploadImage();

    if (empty($price)) {
        $query_get_price = "SELECT harga FROM room WHERE id_room = ?";
        $stmt_get_price = mysqli_prepare($conn, $query_get_price);
        mysqli_stmt_bind_param($stmt_get_price, 'i', $id_room);
        mysqli_stmt_execute($stmt_get_price);
        mysqli_stmt_bind_result($stmt_get_price, $current_price);
        mysqli_stmt_fetch($stmt_get_price);
        mysqli_stmt_close($stmt_get_price);
    
        // Assign the retrieved price to $price
        $price = $current_price;
    } else {
        // Ensure price is treated as a float
        $price = $price;
    }
    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Check if there's an image to delete
        $query_get_image = "SELECT foto FROM room_foto WHERE id_room = ?";
        $stmt_get_image = mysqli_prepare($conn, $query_get_image);
        mysqli_stmt_bind_param($stmt_get_image, 'i', $id_room);
        mysqli_stmt_execute($stmt_get_image);
        mysqli_stmt_bind_result($stmt_get_image, $current_image);
        mysqli_stmt_fetch($stmt_get_image);
        mysqli_stmt_close($stmt_get_image);

        // Delete old image if exists
        if ($current_image && $images) {
            unlink('images/' . $current_image);
        }

        // Update room details
        $query_update_room = "UPDATE room SET nama = ?, harga = ?, num_beds = ?, deskripsi = ?, status = ?, updated_at = NOW() WHERE id_room = ?";
        $stmt_update_room = mysqli_prepare($conn, $query_update_room);
        mysqli_stmt_bind_param($stmt_update_room, 'sdissi', $roomname, $price, $numbed, $view, $status, $id_room);

        if (!mysqli_stmt_execute($stmt_update_room)) {
            throw new Exception("Error updating room: " . mysqli_error($conn));
        }

        // Update room photo if a new image is uploaded
        if ($images) {
            $query_update_photo = "UPDATE room_foto SET foto = ?, updated_at = NOW() WHERE id_room = ?";
            $stmt_update_photo = mysqli_prepare($conn, $query_update_photo);
            mysqli_stmt_bind_param($stmt_update_photo, 'si', $images, $id_room);

            if (!mysqli_stmt_execute($stmt_update_photo)) {
                throw new Exception("Error updating photo: " . mysqli_error($conn));
            }
        }

        // Update room facilities
        $query_delete_fasilitas = "DELETE FROM room_fasilitas WHERE id_room = ?";
        $stmt_delete_fasilitas = mysqli_prepare($conn, $query_delete_fasilitas);
        mysqli_stmt_bind_param($stmt_delete_fasilitas, 'i', $id_room);
        if (!mysqli_stmt_execute($stmt_delete_fasilitas)) {
            throw new Exception("Error deleting room facilities: " . mysqli_error($conn));
        }

        foreach ($fasilitas as $fasilitas_id) {
            $query_insert_fasilitas = "INSERT INTO room_fasilitas (id_room, id_fasilitas) VALUES (?, ?)";
            $stmt_insert_fasilitas = mysqli_prepare($conn, $query_insert_fasilitas);
            mysqli_stmt_bind_param($stmt_insert_fasilitas, 'ii', $id_room, $fasilitas_id);
            if (!mysqli_stmt_execute($stmt_insert_fasilitas)) {
                throw new Exception("Error inserting room facilities: " . mysqli_error($conn));
            }
        }

        // Commit transaction
        mysqli_commit($conn);

        echo "Data berhasil diubah!";
        return true;
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>

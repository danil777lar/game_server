<?php
    include("config.php");

    if (!$connections) 
    {
        die("Database connection error: " . mysqli_connect_error());
    }

    $id = $_POST['user_id'] ?? null;
    $max_score = $_POST['max_score'] ?? null;

    if ($id !== null && $max_score !== null) 
    {
        $stmt = mysqli_prepare($connections, "UPDATE `users` SET `max_score` = ? WHERE `id` = ?");
        
        if ($stmt) 
        {
            mysqli_stmt_bind_param($stmt, "is", $max_score, $id);
            
            if (mysqli_stmt_execute($stmt)) 
            {
                echo "true";
            } else 
            {
                echo "Request error: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } 
        else 
        {
            echo "Make request error.";
        }
    } 
    else 
    {
        echo "false";
    }
    
    mysqli_close($connections);
?>

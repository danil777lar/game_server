<?php
    include("config.php");

    if (!$connections) 
    {
        die("Database connection error: " . mysqli_connect_error());
    }

    $id = $_POST['user_id'] ?? null;

    if ($id !== null) 
    {
        $stmt = mysqli_prepare($connections, "SELECT max_score FROM `users` WHERE `id` = ?");
        
        if ($stmt) 
        {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $max_score);
            mysqli_stmt_fetch($stmt);
            
            if ($max_score !== null) 
            {
                echo $max_score;
            } 
            else 
            {
                echo "Reord was not found.";
            }
            
            mysqli_stmt_close($stmt);
        } 
        else 
        {
            echo "Request make error.";
        }
    }
    else 
    {
        echo "Invalid ID.";
    }

    mysqli_close($connections);
?>

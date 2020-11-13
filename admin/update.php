<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$ten = $gia = $ma_sp = $thuong_hieu = $gioi_tinh = $phong_cach = $kieu_may = $chat_lieu_day = $chat_lieu_vo = $chat_lieu_kinh = $do_day = $size_mat = $mau_mat = $anh_sp = "";
$ten_err = $gia_err = $ma_sp_err = $thuong_hieu_err = $gioi_tinh_err = $phong_cach_err = $kieu_may_err = $chat_lieu_day_err = $chat_lieu_vo_err = $chat_lieu_kinh_err = $do_day_err = $size_mat_err = $mau_mat_err = $anh_sp_err = "";
// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    $input_ten = trim($_POST["ten"]);
    if (empty($input_ten)) {
        $ten_err = "Please enter an ten.";
    } else {
        $ten = $input_ten;
    }
    $input_gia = trim($_POST["gia"]);
    if (empty($input_gia)) {
        $gia_err = "Please enter an gia.";
    } else {
        $gia = $input_gia;
    }
    $input_ma_sp = trim($_POST["ma_sp"]);
    if (empty($input_ma_sp)) {
        $ma_sp_err = "Please enter an ma_sp.";
    } else {
        $ma_sp = $input_ma_sp;
    }
    $input_thuong_hieu = trim($_POST["thuong_hieu"]);
    if (empty($input_thuong_hieu)) {
        $thuong_hieu_err = "Please enter an thuong_hieu.";
    } else {
        $thuong_hieu = $input_thuong_hieu;
    }
    $input_gioi_tinh = trim($_POST["gioi_tinh"]);
    if (empty($input_gioi_tinh)) {
        $gioi_tinh_err = "Please enter an gioi_tinh.";
    } else {
        $gioi_tinh = $input_gioi_tinh;
    }
    $input_phong_cach = trim($_POST["phong_cach"]);
    if (empty($input_phong_cach)) {
        $phong_cach_err = "Please enter an phong_cach.";
    } else {
        $phong_cach = $input_phong_cach;
    }
    $input_chat_lieu_day = trim($_POST["chat_lieu_day"]);
    if (empty($input_chat_lieu_day)) {
        $chat_lieu_day_err = "Please enter an chat_lieu_day.";
    } else {
        $chat_lieu_day = $input_chat_lieu_day;
    }
    $input_chat_lieu_vo = trim($_POST["chat_lieu_vo"]);
    if (empty($input_chat_lieu_vo)) {
        $chat_lieu_vo_err = "Please enter an chat_lieu_vo.";
    } else {
        $chat_lieu_vo = $input_chat_lieu_vo;
    }
    $input_chat_lieu_kinh = trim($_POST["chat_lieu_kinh"]);
    if (empty($input_chat_lieu_kinh)) {
        $chat_lieu_kinh_err = "Please enter an chat_lieu_kinh.";
    } else {
        $chat_lieu_kinh = $input_chat_lieu_kinh;
    }
    $input_do_day = trim($_POST["do_day"]);
    if(empty($input_do_day)){
        $do_day_err = "Please enter an do_day.";     
    } else{
        $do_day = $input_do_day;
    }
    $input_size_mat = trim($_POST["size_mat"]);
    if(empty($input_size_mat)){
        $size_mat_err = "Please enter an size_mat.";     
    } else{
        $size_mat = $input_size_mat;
    }
    $input_mau_mat = trim($_POST["mau_mat"]);
    if(empty($input_mau_mat)){
        $mau_mat_err = "Please enter an mau_mat.";     
    } else{
        $mau_mat = $input_mau_mat;
    }
    // $input_anh_sp = trim($_POST["anh_sp"]);
    // if(empty($input_anh_sp)){
    //     $anh_sp_err = "Please enter an anh_sp.";     
    // } else{
    //     $anh_sp = $input_anh_sp;
    // }
    // Check input errors before inserting in database
    if (empty($name_err) && empty($address_err) && empty($salary_err)) {
        // Prepare an update statement
        $sql = "UPDATE product SET ten=?, gia=?, ma_sp=?, thuong_hieu=?, gioi_tinh=?, phong_cach=?, kieu_may=?, chat_lieu_day=?, chat_lieu_vo=?, chat_lieu_kinh=?, do_day=?, size_mat=?, mau_mat=?, anh_sp=? WHERE id=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sdssssssssddssi", $param_ten, $param_gia, $param_ma_sp,  $param_thuong_hieu,  $param_gioi_tinh,  $param_phong_cach,  $param_kieu_may,  $param_chat_lieu_day,  $param_chat_lieu_vo,  $param_chat_lieu_kinh,  $param_do_day,  $param_size_mat,  $param_mau_mat,  $param_anh_sp,  $param_id);

            // Set parameters
            $param_ten = $ten;
            $param_gia = $gia;
            $param_ma_sp= $ma_sp;
            $param_thuong_hieu= $thuong_hieu;
            $param_gioi_tinh= $gioi_tinh;
            $param_phong_cach= $phong_cach;
            $param_kieu_may= $kieu_may;
            $param_chat_lieu_day= $chat_lieu_day;
            $param_chat_lieu_vo= $chat_lieu_vo;
            $param_chat_lieu_kinh= $chat_lieu_kinh;
            $param_do_day= $do_day;
            $param_size_mat = $size_mat;
            $param_mau_mat= $mau_mat;
            $param_anh_sp= $anh_sp;
            $param_id = $id;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM product WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    // $name = $row["name"];
                    // $address = $row["address"];
                    // $salary = $row["salary"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($ten_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="ten" class="form-control" value="<?php echo $row['ten']; ?>">
                            <span class="help-block"><?php echo $ten_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gia_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="gia" class="form-control" value="<?php echo $row['gia']; ?>">
                            <span class="help-block"><?php echo $gia_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ma_sp_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="ma_sp" class="form-control" value="<?php echo $row['ma_sp']; ?>">
                            <span class="help-block"><?php echo $ma_sp_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($thuong_hieu_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="thuong_hieu" class="form-control" value="<?php echo $row['thuong_hieu']; ?>">
                            <span class="help-block"><?php echo $thuong_hieu_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gioi_tinh_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="gioi_tinh" class="form-control" value="<?php echo $row['gioi_tinh']; ?>">
                            <span class="help-block"><?php echo $gioi_tinh_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($phong_cach_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="phong_cach" class="form-control" value="<?php echo $row['phong_cach']; ?>">
                            <span class="help-block"><?php echo $phong_cach_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($chat_lieu_day_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="chat_lieu_day" class="form-control" value="<?php echo $row['chat_lieu_day']; ?>">
                            <span class="help-block"><?php echo $chat_lieu_day_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($chat_lieu_vo_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="chat_lieu_vo" class="form-control" value="<?php echo $row['chat_lieu_vo']; ?>">
                            <span class="help-block"><?php echo $chat_lieu_vo_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($chat_lieu_kinh_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="chat_lieu_kinh" class="form-control" value="<?php echo $row['chat_lieu_kinh']; ?>">
                            <span class="help-block"><?php echo $chat_lieu_kinh_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($do_day_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="do_day" class="form-control" value="<?php echo $row['do_day']; ?>">
                            <span class="help-block"><?php echo $do_day_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($size_mat_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="size_mat" class="form-control" value="<?php echo $row['size_mat']; ?>">
                            <span class="help-block"><?php echo $size_mat_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($mau_mat_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="mau_mat" class="form-control" value="<?php echo $row['mau_mat']; ?>">
                            <span class="help-block"><?php echo $mau_mat_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($anh_sp_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="anh_sp" class="form-control" value="<?php echo $row['anh_sp']; ?>">
                            <span class="help-block"><?php echo $anh_sp_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
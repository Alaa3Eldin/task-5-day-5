<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title           =   $_POST['title'];
    $description     =  $_POST['description'];
    $error     = [];



    if (empty($title)) {
        $error['title'] =  "مطلوب";
    }

    if (empty($description)) {
        $error['description'] = 'مطلوب';
    }



    $file_tmp = $_FILES['image']['tmp_name'];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];

    $src = 'uploads/' . $file_name;
    if (move_uploaded_file($file_tmp, $src)) {
        echo 'تم الرفع';
    } else {

        echo 'خطاء فى التحمل';
    }

    if (count($error)  > 0) {
        foreach ($error as $key => $value) {
            echo $key . " :" . $value . "</br>";
        }
    } else {


        $file = fopen("info.txt", "a")  or die('file Text');
        $text =   $title  . "||" .   $description  . "||" . $src . "\n";
        fwrite($file, $text);
        fclose($file);
        echo "Done";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Form control: input</h2>
        <p>The form below contains two input elements; one of type text and one of type password:</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="usr">Title:</label>
                <input type="text" class="form-control" id="usr" name="title">
            </div>
            <div class="form-group">
                <label for="comment">description:</label>
                <textarea class="form-control" rows="5" id="comment" name="description"></textarea>
            </div>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="customFile" name="image">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
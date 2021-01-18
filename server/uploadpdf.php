<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ReLang</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Google-Style-Text-Input.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/Toolbar-1.css">
    <link rel="stylesheet" href="../assets/css/Toolbar.css">
</head>

<body>
    <div class="container-fluid card mb-3 px-3 py-2">
        <div class="row">
            <div class="col">
                <p class="title-2">ReLang</p>
            </div>
            <div class="col">
                <form action="./uploadpdf.php" method="POST" enctype="multipart/form-data">
                    <button class="btn btn-primary float-right" name="submit"type="submit">Load PDF</button>
                    <input name='uploaded-file' type='file' class="file-input-display" accept=".pdf"></input><button id='book-name' class="btn btn-secondary float-right mr-2" type="button">
                        <?php 
                            $file = $_FILES['uploaded-file']['name'];
                            $path = pathinfo($file);
                            $filename = $path['filename'];
                            $ext = $path['extension'];
                            echo "Reading ".$filename.'.'.$ext;
                        ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="row" style="height: 100%;min-width: 100%;">
        <div class="col" style="max-width: 70%;">
            <?php
                if (($_FILES['uploaded-file']['name']!="")){
                    $target_dir = "../assets/pdf/";
                    $file = $_FILES['uploaded-file']['name'];
                    $path = pathinfo($file);
                    $filename = $path['filename'];
                    $ext = $path['extension'];
                    $temp_name = $_FILES['uploaded-file']['tmp_name'];
                    $path_filename_ext = $target_dir.$filename.".".$ext;
                
                    if (file_exists($path_filename_ext)) {
                        echo "<object data='$path_filename_ext' type='application/pdf' width='100%' height='100%'>
                        <a href='../assets/pdf/test.pdf'>test.pdf</a></object>";
                    } else {
                        move_uploaded_file($temp_name,$path_filename_ext);
                        echo "<object data='$path_filename_ext' type='application/pdf' width='100%' height='100%'>
                        <a href='../assets/pdf/test.pdf'>test.pdf</a></object>";
                    }
                }
            ?>
        </div>
        <div class="col" style="max-width: 30%;">
            <div class="group">      
                <input id="phrase-input" type="text" onchange="loadDef()" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Enter phrase here</label>
            </div>
            <div>
                <p id="phrase" class="phrase-display"></p>
                <p id="definitions" class="definition-display"></p>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/processing.js"></script>
</body>

</html>
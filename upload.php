<?php 

// 检查点击上传按钮
if(isset($_POST['submit'])){
    // $file=$filePOST['file'];
    $file=$_FILES['file'];

    // 如果一个文件有哪些信息可以下面的代码来看看
    // print_r($file);
    // 文件名，大小，类型，错误信息，tmp名

    // 下面对各个信息进行相应的操作



    // 获取文件信息
    $fileName=$_FILES['file']['name'];  //文件名
    $fileSize=$_FILES['file']['size'];  //文件大小
    $fileType=$_FILES['file']['type'];  //文件类型
    $fileTmpName=$_FILES['file']['tmp_name'];  //文件tmp名
    $fileError=$_FILES['file']['error'];  //文件错误信息


    // 获取文件类型及转小写
    $fileExt=explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));

    // 允许类型
    $Allowed=array('jpg','jpeg','png','pdf');


    // 如果在允许中
    if(in_array($fileActualExt,$Allowed)){
        // 如果没有错误信息
        if($fileError === 0){
            // 对文件大小限制
            if($fileSize < 10000000){
                // 对文件重新取名，是唯一的名字
                $fileNameNew=uniqid('',true).".".$fileActualExt;
                // 下载目录
                $fileDestination="uploads/".$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                // 上传成功之后跳转到首页
                header('location:index.php?uploadsuccess');

            }else{
                // 文件超过限制大小
                echo "your file is too big..";
            }
        }else{
            // 文件上传有错误
            echo "there was an error uploading youe file..";
        }

    }else{
        // 不允许的类型
        echo "you can not upload files of this type";
    }

}



?>
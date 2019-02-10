<?php
    require_once "../../config/connection.php";
    require_once "../../helper/alert.php";
    require_once "../../helper/isOperator.php";

    if(isset($_POST['submit'])){
        $bill_number = $conn->real_escape_string($_POST['bill_number']);
        @$status = $conn->real_escape_string($_POST['status']);
        $invoice = $_FILES['invoice'];

        if(empty($status)){
            $status = "Belum Dikonfirmasi";
        }

        if(!empty($bill_number) && !empty($invoice['name'])){
            $queryCheck = $conn->query("SELECT * FROM tbtagihan WHERE NoTagihan='$bill_number'");
            if($queryCheck->num_rows == 1){
                $data = $queryCheck->fetch_assoc();

                $billCode = $data['KodeTagihan'];
                $paymentDate = date("Y-m-d");
                $billAmount = $data['TotalBayar'];

                $allowed_type = ['image/png', 'image/jpeg', 'image/jpg']; //MIME 
                if(in_array($invoice['type'], $allowed_type)){
                    $max_size = 2048 * 1024; // KB * Byte
                    if($invoice['size'] <= $max_size){
                        $image_name = uniqid() . "-" . $invoice['name'];
                        $upload_path = "../../uploads/invoices/" . $image_name;

                        if(move_uploaded_file($invoice['tmp_name'], $upload_path)){
                            $queryInsert = $conn->query("INSERT INTO tbpembayaran VALUES (NULL, $billCode, '$paymentDate', $billAmount, '$image_name', '$status')");

                            if($status == "Lunas"){
                                $queryUpdate = $conn->query("UPDATE tbtagihan SET Status='Lunas' WHERE KodeTagihan=$billCode");
                            }
                            else{
                                $queryUpdate = $conn->query("UPDATE tbtagihan SET Status='Belum Dikonfirmasi' WHERE KodeTagihan=$billCode");
                            }

                            alert("Payment is successfully added!", "../index.php");
                        }
                        else{
                            alert("Error while uploading invoice!", "../add.php?bill_number=$bill_number");
                        }
                    }
                    else{
                        alert("Invoice Image Size Too Big ! Please upload under or equals 2MB !", "../add.php?bill_number=$bill_number");
                    }
                }
                else{
                    alert("Invoice Extension Not Allowed!", "../add.php?bill_number=$bill_number");
                }

            }
            else{
                alert("Bill not found!", "../add.php");
            }
        }
        else{
            alert("Please fill all form!", "../add.php");
        }
    }
    else{
        header('location: ../add.php');
    }
?>
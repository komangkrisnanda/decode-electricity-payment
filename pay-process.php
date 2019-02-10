<?php
    require_once "./config/connection.php";
    require_once "./helper/alert.php";
    require_once "./helper/isCustomer.php";

    if(isset($_POST['submit'])){
        $code = $conn->real_escape_string($_POST['code']);
        $invoice = $_FILES['invoice'];

        if(!empty($code) && !empty($invoice['name'])){
            $queryCheck = $conn->query("SELECT * FROM tbtagihan WHERE NoTagihan='$code'");
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
                        $upload_path = "./uploads/invoices/" . $image_name;

                        if(move_uploaded_file($invoice['tmp_name'], $upload_path)){
                            $queryInsert = $conn->query("INSERT INTO tbpembayaran VALUES (NULL, $billCode, '$paymentDate', $billAmount, '$image_name', 'Belum Dikonfirmasi')");
                           
                            $queryUpdate = $conn->query("UPDATE tbtagihan SET Status='Belum Dikonfirmasi' WHERE KodeTagihan=$billCode");

                            alert("Payment is successfully added!", "./index.php");
                        }
                        else{
                            alert("Error while uploading invoice!", "./pay.php?code=$code");
                        }
                    }
                    else{
                        alert("Invoice Image Size Too Big ! Please upload under or equals 2MB !", "./pay.php?code=$code");
                    }
                }
                else{
                    alert("Invoice Extension Not Allowed!", "./pay.php?code=$code");
                }

            }
            else{
                alert("Bill not found!", "./pay.php");
            }
        }
        else{
            alert("Please fill all form!", "./pay.php");
        }
    }
    else{
        header('location: ./pay.php');
    }
?>
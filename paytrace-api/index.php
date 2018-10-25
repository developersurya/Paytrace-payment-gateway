<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <head>
    <!-- This is the PayTrace End-to-End Encryption library: -->
    <script src="https://api.paytrace.com/assets/e2ee/paytrace-e2ee.js"></script>
    <script>
        // set the key from an AJAX call 
        $(document).ready(function() {
            paytrace.setKeyAjax('public_key.pem') ;// set the key from an AJAX call (in this case via a relative URL)
        });   
        $('#myform').submit(function(e) {
             e.preventDefault(); //To prevent the default action of the submit
             if ($(this).valid()) {
                //submit the valid form
                paytrace.submitEncrypted(this);
            } else {
                console.log("INVALID FORM. your code for further action here");
             }
             return false;
         });   
</script>
</head>
    </head>
    <body>
        <input type="text" class="form-control pt-encrypt" id="ccNumber" name="ccNumber" placeholder="Credit card number">
<input type="text" class="form-control pt-encrypt" id="ccCSC" name="ccCSC" placeholder="Card security code">
<input type="submit" id="enterPayment" value="Submit" name="commit" /> 
        <?php
        // put your code here
        ?>
    </body>
</html>

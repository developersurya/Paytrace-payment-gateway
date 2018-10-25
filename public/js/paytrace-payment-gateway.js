// set the key from an AJAX call
$(document).ready(function () {
    console.log('here');
    //debugger;
    //change the link dynamically
    paytrace.setKeyAjax('http://localhost/projects/test/wp-content/plugins/paytrace-payment-gateway/paytrace-api/public_key.pem');
    // set the key from an AJAX call (in this case via a relative URL)
});

$(document).ready(function () {

    $('.loading-notice').hide();
    $("#DemoForm").submit(function (e) {
        //To prevent the default action of the submit
        e.preventDefault();

        // Do your validation and if all validations are met,
        // Next is to submit the form with paytrace.submitEncrypted.
        if ($("#ccNumber").val() && $("#ccCSC").val()) {
            //if all validations are met, submit the form to Paytrace library for encyption.
            paytrace.submitEncrypted("#DemoForm");
            $('.loading-notice').show();
            var cn = $("#ccNumber").val();
            var csc = $("#ccCSC").val();
            var p = $("#price").val();

            //Only support testing values from below
            //https://developers.paytrace.com/support/home#14000041397

            $.ajax({
                //change the link dynamically
                url: 'http://localhost/projects/test/wp-content/plugins/paytrace-payment-gateway/paytrace-api/KeyedSaleJson.php',
                method: 'POST',
                data: ({
                    //action  : 'function1',
                    'p': p,
                    'cn': cn,
                    'ey': '2020',
                    'em': '11',
                    'csc': csc,
                    'ban': 'Princess Leia',
                    'bac': 'Spokane',
                    'basa': '8320 E. West St.',
                    'bas': 'WA',
                    'baz': '84524',
                }),
                success: function (data) {
                    $('.loading-notice').hide();

                    console.log(data);
                    $('#result').html(data);
                    $('.error-notice').html(data);
                }
            });

        }
        else {
            alert("CCNumber and CSC number are required ! ");
        }
    });
});
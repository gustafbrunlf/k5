<?php
    function submitAndEmailForm() {
        $results['success'] = false;

        $customer_email = $_POST['email'];
        $order_total = $_POST['total'];
        $product_data = $_POST['data'];

        $order = rand(100000, 1000000);

        $to = 'gustafbrunlof+123@gmail.com';
        $subject = 'k5 : Order ' . $order;
        $body = 'The email body content';
        $headers = "From: order@k5.com\r\n";
        $headers .= "Reply-To: no-reply@k5.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        wp_mail( $to, $subject, $body, $headers );

        $body_customer = 'The email body customer content';
        wp_mail( $customer_email, $subject, $body_customer, $headers );

        $results['success'] = true;

        wp_send_json($results);
        die();
    }
?>

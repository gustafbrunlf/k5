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
        $headers = "From: info@gustafbrunlof.se\r\n";
        $headers .= "Reply-To: no-reply@gustafbrunlof.se\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        wp_mail( $to, $subject, $body, $headers );

        $body_customer = '<html><body>';
        $body_customer .= '<h1>Thank you for your order</h1>';
        $body_customer .= '<table><thead>';
        $body_customer .= '<tr>';
        $body_customer .= '<th>Product name</th>';
        $body_customer .= '<th>Size</th>';
        $body_customer .= '<th>Qty</th>';
        $body_customer .= '<th>Price</th>';
        $body_customer .= '</tr></thead>';
        $body_customer .= '<tbody>';

        $i = 0;
        $body_customer .= '<tr>';
        foreach ($product_data as $data) {
            if($data['name'] != 'email2') {

                $body_customer .= '<td>' . $data['value'] . '</td>';
                $i++;

                if($i % 4 == 0) {
                    $body_customer .= '</tr>';
                    $body_customer .= '<tr>';
                }
            }
        }
        $body_customer .= '</tr>';

        $body_customer .= '</tbody></table>';
        $body_customer .= '<p>The total of your order is: <b>' . $order_total . ' SEK</b></p>';
        $body_customer .= '</body></html>';

        wp_mail( $customer_email, $subject, $body_customer, $headers );

        $results['success'] = true;

        wp_send_json($results);
        die();
    }
?>

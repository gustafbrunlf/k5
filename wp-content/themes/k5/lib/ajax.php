<?php
    function submitAndEmailForm() {
        $results['success'] = false;

        $customer_email = $_POST['email'];
        $order_total = $_POST['total'];
        $product_data = $_POST['data'];
        $order_shipping = $_POST['shipping'];
        $shipping_total = $_POST['shipping_total'];
        $currency = $_POST['currency'];

        $count_products = count($product_data);
        unset($product_data[$count_products-1]);
        unset($product_data[$count_products-2]);

        $order = rand(100000, 1000000);

        $product_body = '<table>';
        $product_body .= '<tbody>';
        foreach ($product_data as $data) {
            if($data['name'] != 'email2' || $data['name'] != 'shipping' || $data['value'] != 'standard') {
                if (strpos($data['name'], 'product') !== false) {
                    $name = 'Product name';
                }
                if($data['name'] == 'size') {
                    $name = 'Size';
                }
                if($data['name'] == 'qty') {
                    $name = 'Quantity';
                }
                if($data['name'] == 'price') {
                    $name = 'Price';
                    $data['value'] = $data['value'] . ' ' . $currency;
                }
                if($data['name'] == 'img') {
                    $product_body .= '<tr><td style="width:200px;padding-right:20px;padding-bottom:10px;">';
                    $product_body .= '<img src="' . $data['value'] . '" width="200px;" style="width:200px;"/></td></tr>';
                } else {
                    $product_body .= '<tr><td style="width:200px;padding-right:20px;padding-bottom:10px;"><p style="margin:0;"><b>' . $name . '</b></p></td>';
                    $product_body .= '<td style="width:200px;padding-right:20px;padding-bottom:10px;"><p style="margin:0;"><b>' . $data['value'] . '</b></p></td></tr>';
                }
            }
        }
        $product_body .= '</tbody></table>';

        $admin_email = 'order@kultur5.com';
        $customer_subject = 'Kultur5 - Order confirmation: Order ' . $order;
        $admin_subject = 'Kultur5 : New order ' . $order;
        $headers = "From: order@kultur5.com\r\n";
        $headers .= "Reply-To: no-reply@gustafbrunlof.se\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body_admin = '<html><body>';
        $body_admin .= '<h1>New order: ' . $order . '</h1><br />';
        $body_admin .= '<p style="margin:0;"><b>Customer e-mail:</b> ' . $customer_email . '</p><br />';
        $body_admin .= $product_body;
        $body_admin .= '<p style="margin:0;"><b>Shipping:</b> ' . $order_shipping . ' ' . $shipping_total . ' ' . $currency . '</ br>';
        $body_admin .= '<p style="margin:0;"><b>The total of the order</b> ' . $order_total . ' ' . $currency . '</p>';
        $body_admin .= '</body></html>';

        wp_mail( $admin_email, $admin_subject, $body_admin, $headers );

        $body_customer = '<html><body>';
        $body_customer .= '<img src="https://www.kultur5.com/wp-content/uploads/2020/03/logo-scaled.jpg" width="200" style="width:200px;"></ br>';
        $body_customer .= '<h1>Thank you for your order</h1>';
        $body_customer .= $product_body;
        $body_customer .= '<table><tbody>';
        $body_customer .= '<tr><td style="width:200px;padding-right:20px;padding-bottom:10px;"><p style="margin:0;"><b>Shipping</b></td><td style="width:200px;padding-right:20px;padding-bottom:10px;"><p style="margin:0;"><b>' . $order_shipping . ' ' . $shipping_total . ' ' . $currency . '</b></p></td></tr>';
        $body_customer .= '<tr><td style="width:200px;padding-right:20px;padding-bottom:10px;"><p style="margin:0;"><b>The total of your order</b></p></td><td style="width:200px;padding-right:20px;padding-bottom:10px;"><p style="margin:0;"><b>' . $order_total . ' ' . $currency . '</b></p></td></tr>';
        $body_customer .= '<tr><td style="width:200px;padding-right:20px;padding-bottom:10px;"><p style="margin:0;"><b><p style="margin:0;"><a style="color:#000;" href="mailto:contact@kultur5.com">contact@kultur5.com</a></p></b></p></td></tr>';
        $body_customer .= '</table></tbody>';
        $body_customer .= '</body></html>';

        $mail = wp_mail( $customer_email, $customer_subject, $body_customer, $headers );

        $results['success'] = $mail ? true : false;

        wp_send_json($results);
        die();
    }
?>

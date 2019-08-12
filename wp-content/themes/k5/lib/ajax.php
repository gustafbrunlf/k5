<?php
    function submitAndEmailForm() {
        $results['success'] = true;
        $results['html'] = 'HAJ';
        
        $to = 'gustafbrunlof@gmail.com';
        $subject = 'The subject';
        $body = 'The email body content';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail( $to, $subject, $body, $headers );

        wp_send_json($results);
        die();
    }
?>

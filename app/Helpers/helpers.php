<?php

if (!function_exists('generateWhatsAppLink')) {
    function generateWhatsAppLink($phoneNumber, $message) {
        // Remove non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // IMPORTANT: URL encode the message
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }
}









?>
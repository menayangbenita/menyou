<?php

class Flasher
{
    public static function setFlash($message, $type = 'success', $delay = 4000)
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type,
            'delay' => $delay,
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '
            <div class="alert alert-' . $_SESSION['flash']['type'] . ' alert-dismissible fade show position-fixed p-3 d-flex align-items-center"
                style="bottom: 1rem; right: 2rem; z-index: 999999999999;" role="alert">
                ' . $_SESSION['flash']['message'] . '
            </div>
            <script>$(".alert.alert-dismissible").delay('.$_SESSION['flash']['delay'].').fadeOut("slow", function() {$(this).alert("close")})</script>
            ';
            unset($_SESSION['flash']);
        }
    }
}

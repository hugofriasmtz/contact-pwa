<?php

namespace App\Helpers;

class Alerts
{

    
    public static function showAlert($alerta)
    {      
        if (!empty($alerta['title'])) {
            $alert = <<<HTML
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
            setTimeout(function () {
                Swal.fire({
                    title: "{$alerta['title']}",
                    text: "{$alerta['body']}",
                    icon: "{$alerta['type']}"
                });
            }, 100);
            </script>
            HTML;
            echo $alert;
        }
    }

   
}

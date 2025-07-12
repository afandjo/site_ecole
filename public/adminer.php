<?php

function adminer_object() {
    class AdminerSoftware extends Adminer {
        function name() {
            return 'Adminer pour site_ecole';
        }
    }
    return new AdminerSoftware;
}

require_once('https://www.adminer.org/latest-en.php');

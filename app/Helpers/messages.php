<?php

if (! function_exists('addedMessage')) {
    function addedMessage($data) {
        return __("messages." . $data . " added successfully");
    }
}

if (! function_exists('removedMessage')) {
    function removedMessage($data) {
        return __("messages." . $data . " removed successfully");
    }
}

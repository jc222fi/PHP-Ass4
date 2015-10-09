<?php
/**
 * Solution for assignment 2
 * @author Daniel Toll
 */
namespace view;
class DateTimeView {
    //Retrieve server time and display in correct format
    public function show() {

        date_default_timezone_set("Europe/Stockholm");

        $timeString = date('l, \t\h\e jS \o\f F Y, \T\h\e \t\i\m\e \i\s G:i:s');

        return '<p>' . $timeString . '</p>';
    }
}
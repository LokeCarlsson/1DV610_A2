<?php

class DateTimeView {


	public function show() {

		$timeString = date("l") . ", the " . date("d") . "th of " . date("F") . ", The time is " . date("H:i");

		return '<p>' . $timeString . '</p>';
	}
}

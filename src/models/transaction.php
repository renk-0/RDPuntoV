<?php

interface Transaction 
{
	private string $description;
	function do();
}

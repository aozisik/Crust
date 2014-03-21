<?php
/**
* @package Crust Framework
* @version 0.9.4
* @author Ahmet Özışık
*
* Router handles REQUEST URLs and directs them to corresponding controllers and actions 
*/


$crust_router = new CrustRouter();
#$crust_router->map(':controller', 'home/index'); // wherever you go, its home/index
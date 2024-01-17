<?php
function generateIdentifier($initials)
{
    // Get the current year and month
    $year = date('Y');
    $month = date('m');

    // Generat e a unique identifier using a random number (you can customize the length)
    $uniqueIdentifier = mt_rand(1000, 9999); // Generates a 4-digit random number

    // Combine the components to create the purchase order number
    return "$initials-$year-$month-$uniqueIdentifier";


}
function generateInvoiceIdentifier(){
    return generateIdentifier("INV");
}
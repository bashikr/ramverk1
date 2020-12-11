<?php

namespace Bashar\WeatherView;

/**
 * Render content.
 */

?>

<div style="text-align:left; background:#d5d5d5; padding:20px; margin-bottom:20px;border-radius:5px;">
    <h3>How to use the weather API:</h3>
    <p>- When you enter the website you will basically have (/redovisa/htdocs/) at the end of the website's url.</p>
    <p>- Once you enter this page by hovering on (WEATHER IP), a (/ip-weather) will be added to the URL.</p>
    <p>- After submitting the input form with a proper IP-Address a query string (?ip=) will be added to the URL
    in addition to your entered input.</p>
    <p>- Then 2 buttons will pop up to let you choose. the "Previous" button shows historical weather information,
    where the "Next" button gives you information about the current weather in addition to a forecast of
    the upcoming 7 days.</p>
    <strong>OBS! This api does not support giving information about Ipv6. However, it will validate IP:es
        of the version 6.
    </strong>
</div>
<div 
style="text-align: left; background:#333;
    padding: 20px 50px;
    border-radius:5px;
    color: white;margin-bottom:20px;
">
    <p>/redovisa/htdocs/ip-weather?ip=100.47.150.9</p>
</div>

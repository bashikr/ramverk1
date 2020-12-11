<?php

namespace Bashar\ipValidate;

/**
 * Render content.
 */

?>
<article style="min-height:300px; text-align:center;">

<h3>Geo Location Api (JSON info format)</h3>

<h5>Write an IP-address to ensure if it's valid or not and to get Geo Location information</h5>
<form method="get">
    <input type="text" name="ip" id="geo-ip-json" value="<?php echo $getIpAddress; ?>" required>
    <input  type="submit" value="Validate">
</form>
<div style= "grid-column-start: 1; grid-column-end: 3; grid-row-start: -1; grid-row-end: 2;">


<div style="text-align:left; background:#d5d5d5; padding:20px; margin-bottom:20px;border-radius:5px;">
<h3>How to use the API:</h3>
<p>- When you enter the website you will basically have (/redovisa/htdocs/) at the end of the website's url.</p>
<p>- Once you enter this page by hovering on (GEO IP) and then choosing 
(GEO LOCATION WITH JSON RESPONSE) a (/geo-ip-json) will be added to the URL.</p>
<p>- After submitting the input form with a proper IP-Address a query string (?ip=) will be added to the URL
in addition to your entered input.</p>

<strong>OBS! This api does not support giving information about Ipv6. However, 
it will validate IP:es of the version 6.</strong>

<h4>Test case 1</h4>
<form action="geo-ip-json" method="GET">
    <input name="ip" type="hidden" value="5.0.255.255">
    <input type="submit" value="5.0.255.255">
</form><br>
<h4>Test case 2</h4>
<form action="geo-ip-json" method="GET">
    <input name="ip" type="hidden" value="194.47.150.9">
    <input type="submit" value="194.47.150.9">
</form>

</div>
<div style="text-align: left; background:#333; padding: 20px 50px;border-radius:5px; color: white;margin-bottom:20px;">
    <p>/redovisa/htdocs/geo-ip-json?ip=100.47.150.9<p>
</div>


<?php if (isset($_GET["ip"])) : ?>
    <h5>Validation result</h5>
    <div><?= $ipValidationResult ?></div>
    <?php if ($ipValidationResult != 'The IP-address ' .
        '<p style="color:red; font-weight: 900;">' .
        $enteredIp .'</p>' . ' is not valid.' &&
        $ipValidationResult == 'The IP-address ' .
        '<p style="color:#69a542; font-weight: 900;">' . $enteredIp . '</p>' .
        ' is a valid IPv4 IP-address.') :
    ?>
    <div style="text-align: left; background:#333; padding: 20px 50px;border-radius:5px; color: white;">
        <?= $geoLocModRes ?>
    </div>
    <?php endif; ?>
    <?php if ($ipValidationResult =='The IP-address ' .
        '<p style="color:#69a542; font-weight: 900;">' . $enteredIp . '</p>' .
        ' is a valid  IPv6 IP-address.') :
    ?>
    <br>
    <p>IP Stack API does not support giving Ipv6 information</p>
    <?php endif; ?>
<?php endif; ?>
</div>
</article>

<?php

namespace Bashar\ipValidate;

/**
 * Render content.
 */

?>
<article style="min-height:300px; text-align:center;">

<h3>Geo Location Api (Normal info format)</h3>

<h5>Write an IP-address to ensure if it's valid or not and to get Geo Location information</h5>
<form method="get">
    <input type="text" name="ip" id="ip" value="<?php echo $getIpAddress; ?>" required>
    <input  type="submit" value="Validate">
</form>

<div style="text-align:left; background:#d5d5d5; padding:20px; margin-bottom:20px;border-radius:5px;">
<h3>How to use the API:</h3>
<p>- When you enter the website you will basically have (/redovisa/htdocs/) at the end of the website's url.</p>
<p>- Once you enter this page by hovering on (GEO IP) and then choosing 
(GEO LOCATION WITH TEXT RESPONSE), a (/geo-ip-normal) will be added to the URL.</p>
<p>- After submitting the input form with a proper IP-Address a query string (?ip=) will be added to the URL
in addition to your entered input.</p>
<strong>
    OBS! This api does not support giving information about Ipv6. However, it will validate IP:es of the version 6.
</strong>

</div>
<div style="text-align: left; background:#333; padding: 20px 50px;border-radius:5px; color: white;margin-bottom:20px;">
    <p>/redovisa/htdocs/geo-ip-normal?ip=100.47.150.9</p>
</div>

<?php if (isset($_GET["ip"])) : ?>
    <div hidden><?= include 'map.php'; ?></div>
    <div><?= $ipValidationResult ?></div>
    <?php if ($ipValidationResult == ('The IP-address ' .
        '<p style="color:#69a542; font-weight: 900;">' . $enteredIp . '</p>' .
        ' is a valid IPv4 IP-address.')) : ?>
    <table style="width:100%; margin:20px auto; border:2px solid #333;">
        <thead style="background:#333; color:white;">
            <tr>
            <th scope="col">Info</th>
            <th scope="col" style="text-align:center;">Detalis</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Host</th>
                <td><?=$apiResNml["hostname"]?></td>
            </tr>
            <tr>
                <th scope="row">Continent</th>
                <td><?=$apiResNml["continent_name"]?></td>
            </tr>
            <tr>
                <th scope="row">Country</th>
                <td><?=$apiResNml["country_name"]; ?> <?=$apiResNml["location"]["country_flag_emoji"]?></td>
            </tr>
            <tr>
                <th scope="row">Capital</th>
                <td><?=$apiResNml["location"]["capital"]?></td>
            </tr>
            <tr>
                <th scope="row">Language</th>
                <td ><?=$apiResNml["location"]["languages"]["0"]["name"]?></td>
            </tr>
            <tr>
                <th scope="row">City</th>
                <td><?=$apiResNml["city"]?></td>
            </tr>
        </tbody>
    </table>
            <h3 scope="row" style="vertical-align:middle;">Position On Map</h3>
            <div id="map" style="width: 800px; height: 450px;margin-bottom:10px;"></div>
    <?php endif; ?>

    <?php if ($ipValidationResult =='The IP-address ' .
        '<p style="color:#69a542; font-weight: 900;">' . $enteredIp . '</p>' .
        ' is a valid  IPv6 IP-address.') :
    ?>
    <br>
    <p>IP Stack API does not support giving Ipv6 information</p>
    <?php endif; ?>

<?php endif; ?>
</article>

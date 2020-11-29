<?php

namespace Bashar\WeatherView;

/**
 * Render content.
 */

?>
<article style="min-height:300px; text-align:center;">
    <h2>Weather API</h2>
    <strong>Write an IP-address to ensure if it's valid or not and to get weather information</strong>
    <form method="get">
        <input type="text" name="ip" id="ip" value="<?php echo $getIpAddress; ?>" required>
        <input  type="submit" value="Validate">
    </form>

    <?php if (isset($_GET["ip"]) && $ipValidationResult == true) : ?>
        <div style="margin: 20px; text-align:center; border:4px solid #333; padding:20px;">
            <p>Click on "Previous" button to get weather history of the last 5 days.</p>
            <form method="get" action="ip-weather/previous">
                <input type="text" name="ip" id="ip" value="<?php echo $_GET["ip"]; ?>" required hidden>
                <input  type="submit" value="Previous">
            </form>
            <p>Click on "Next" button to get the current weather & the weather forecast of the upcoming 7 days.</p>
            <form method="get" action="ip-weather/next">
                <input type="text" name="ip" id="ip" value="<?php echo $_GET["ip"]; ?>" required hidden>
                <input  type="submit" value="Next">
            </form>
        </div>
    <?php elseif (isset($_GET["ip"]) && $ipValidationResult == false) : ?>
        <strong style="color:red;">The IP-address must be of type IPv4</strong>
        <br>
    <?php elseif (!isset($_GET["ip"]) || $ipValidationResult == false) : ?>
        <strong>Enter a valid IP-Address</strong>
        <br><br>
    <?php endif; ?>

    <div><?php include 'documentation.php'; ?></div>

</article>

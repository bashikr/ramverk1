<?php
namespace Bashar\WeatherView;

/**
 * Render content.
 */

?>
<input type="text" name="ip" id="ip" value="<?php echo $enteredIp; ?>" hidden>

<?php if (isset($_GET["ip"])) : ?>
    <div hidden><?= include 'map.php'; ?></div>

    <h1 style="text-align:center;">Forecast</h1>
    <div class="weather-next columns col3-wrapper-next">
        <div class="weather-day-next column col8">
            <p class="weather-header-next">Temperature/<?= $timezoneNext ?></p>
            <div class="weather-date-next">
                <div><?= implode(" ", $dateArrayNext) ?></div>
            </div>
            <div class="weather-icon-next">
                <?php foreach ($arrIconNext as $key1 => $value1) : ?>
                    <img style="width:75px;" src="https://openweathermap.org/img/wn/<?= $value1 ?>@2x.png"</img>
                <?php endforeach; ?>
            </div>
            <br>
            <div class="weather-temperature-next">
                <div><?= implode(" ", $tempArrayNext) ?></div>
            </div>
            <div class="weather-status-next">
                <div><?= implode(" ", $weatherStatusArrayNext) ?></div>
            </div>
        </div>
    </div>

    <h3 scope="row" style="text-align:center;">Position On Map</h3>
    <div id="map" style="width: 800px; height: 450px;margin-bottom:10px;"></div>

    <h3 style="text-align:center;">Json Format</h3>
    <div style="text-align:
    left; background:#333;
    padding: 20px 50px;
    border-radius:5px;
    color: white;margin-bottom:20px;"
    >
        <p><?php echo $weatherInJson; ?></p>
    </div>

<?php endif; ?>

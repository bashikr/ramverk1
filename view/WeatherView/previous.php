<?php

namespace Bashar\WeatherView;

/**
 * Render content.
 */

?>
<input type="text" name="ip" id="ip" value="<?php echo $enteredIp; ?>" hidden>

<?php if (isset($_GET["ip"])) : ?>
    <div hidden><?= include 'map.php'; ?></div>

    <h1 style="text-align:center;">Historical</h1>
    <div class="weather-previous columns col3-wrapper-previous">
        <div class="weather-day-previous column col8">
            <p class="weather-header-previous">Temperature/<?= $timezonePrevious ?></p>
            <div class="weather-date-previous">
                <div><?= implode(" ", $dateArrayPrevious) ?></div>
            </div>
            <div class="weather-icon-previous">
                <?php foreach ($arrIconPrevious as $key1 => $value1) : ?>
                    <img style="width:75px;" src="https://openweathermap.org/img/wn/<?= $value1 ?>@2x.png"</img>
                <?php endforeach; ?>
            </div>
            <br>
            <div class="weather-temperature-previous">
                <div><?= implode(" ", $tempArrayPrevious) ?></div>
            </div>
            <div class="weather-status-previous">
                <div><?= implode(" ", $weatherStatusArrayPrevious) ?></div>
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
<br>

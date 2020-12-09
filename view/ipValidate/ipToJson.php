<?php

namespace Bashar\ipValidate;

/**
 * Render content.
 */

?>
<meta charset="utf-8"/>
<article style="min-height:300px;" >
    <div style="min-height:300px; text-align:center;">
        <h1>IP-address validator with JSON response</h1>
        <h5>Write an IP-address to ensure if it's valid or not.</h5>
        <form method="post">
            <input type="text" name="ip" placeholder="  194.47.150.9" required>
            <input  type="submit" value="Validate">
        </form>
        <h4>JSON response</h4>
    </div>
    </form>
    <div style="  display: grid; grid-template-columns: repeat(2, 1fr); grid-auto-rows: 300px;column-gap: 10px;">
        <div style="grid-column-start: 3;">
            <form action="ip-to-json" method="POST">
                <input name="ip" type="hidden" value="127.0.0.1">
                <input type="submit" value="Test IP 1">
            </form><br>
            <form action="ip-to-json" method="POST">
                <input name="ip" type="hidden" value="194.47.150.9">
                <input type="submit" value="Test IP 2">
            </form>
        </div>
        <div style= "grid-column-start: 1; grid-column-end: 3; grid-row-start: -1; grid-row-end: 2;">
            <?php
            if (isset($_POST["ip"])) {
                $encoded = strip_tags(json_encode($json, JSON_PRETTY_PRINT));
                // echo $encoded;
                $pattern1 = "/^[\[]/i";
                $first = preg_replace($pattern1, "[<br>", $encoded);
                $pattern2 = "/[\]]$/i";
                $second = preg_replace($pattern2, "<br>]", $first);
                $pattern3 = "/,/i";
                $third = preg_replace($pattern3, ",<br>********", $second);
                $pattern4 = "/{/i";
                $fourth = preg_replace($pattern4, "****{<br>********", $third);
                $pattern5 = "/}/i";
                $fifth = preg_replace($pattern5, "<br>****}", $fourth);
                // echo $fifth;
                $string = str_replace("*", "&nbsp", $fifth);
                echo '<div style="text-align: left; background:#333; padding: 20px 50px;border-radius:5px; color: white;">' .
                $string . '</div>';
            }
            ?>
        </div>
    </div>
    <br><br>
</article>

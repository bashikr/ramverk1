<?php

namespace Bashar\ipValidate;

/**
 * Render content.
 */

?>
<article style="min-height:300px; text-align:center;">

<h3>Validate IP address</h3>

<h5>Write an IP-address to ensure if it's valid or not.</h5>
<form method="post">
    <input type="text" name="ip" placeholder="  194.47.150.9" required>
    <input  type="submit" value="Validate">
</form>

<?php if (isset($_POST["ip"])) : ?>
    <h5>Validation result</h5>
    <p><?= $ipValidationResult ?></p>
    <h5>Host name</h5>
    <p><?= $hostName ?></p>
<?php endif; ?>

</article>

<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<div class="flexslider">
  <ul class="slides">
  <?php foreach ($rows as $id => $row): ?>
    <li><?php print $row; ?></li>
  <?php endforeach; ?>
  </ul>
</div>

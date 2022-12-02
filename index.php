<?php
require "header.php";

$categories = "assets/pdf";

echo "<div class='container p-2'>";
echo "<h3 class=text-center>أقسام الكتب</h3>";
echo "<div class='categories '>";
foreach (scandir($categories) as $cat) {
    if (in_array($cat, [".", ".."])) continue;
    echo '<div class="card category-card">';
        echo '<div class="card-body">';
            echo "<a class='card-title category btn btn-outline-secondary' href='books.php?cat=" . trim(str_replace(' ', '-', $cat)) . "'>$cat</a>";
        echo '</div>';
    echo '</div>';
}
echo "</div>";
echo "</div>";
require "footer.php";

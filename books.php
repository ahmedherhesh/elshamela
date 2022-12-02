<?php
require "header.php";

$category = !empty($_GET['cat']) ? str_replace('-', ' ', $_GET['cat']) : '';
if (!$category) header("location:javascript:history.go(-1)");

$books = "assets/pdf/$category";
echo "<div class='container p-2'>";
echo "<h3 class=text-center>$category</h3>";
echo "<div class='books p-2 d-flex flex-wrap gap-2 justify-content-center'>";
foreach (scandir($books) as $book) {
    if (in_array($book, [".", ".."])) continue;
    $image = file_exists("$books/$book/cover.jpg") ? "$books/$book/cover.jpg" : '';
    $pdf = '';

    foreach (scandir("$books/$book") as $file) {
        if (explode('.', $file)[1] == 'pdf') {
            $pdf = $file;
            break;
        }
    }

    echo "<a href='$books/$book/$pdf' class='card' style='width: 15rem;'>";
    if ($image) {
        echo "<img src='$image' class='card-img-top'>";
    } else {
        echo "<div class='card-body'>
                <p class='card-title text-center'>" . str_replace('-', ' ', $book) . "</p>
              </div>";
    }
    echo '</a>';
}
echo "</div>";
echo "</div>";
?>
<div class="overlay" id="overlay">
    <span class="close-btn" id="closeBtn">X</span>
    <div class="book" id="book">
        <embed id="embed" src="" type="application/pdf" height="100%" width="100%">
    </div>
</div>
<script>
    document.querySelectorAll('a').forEach(a => {
        a.onclick = (e) => {
            e.preventDefault();
            overlay.style.display = 'block';
            embed.src = a.href;
        }
    })
    closeBtn.onclick = () => {
        overlay.style.display = 'none';
    }
</script>
<?php require "footer.php" ?>
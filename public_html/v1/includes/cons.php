<?php
if($connectMe == "yes") {
    $link = mysqli_connect('thomvaladez.com', 'electuz4_script', 'eleventy7', 'electuz4_scripture') or die ("Error " . mysqli_error($link));

    // Change character set to utf8
    mysqli_set_charset($link, "utf8");
} else {
    header("location: http://www.gospelblocks.com");
    exit;
}
?>

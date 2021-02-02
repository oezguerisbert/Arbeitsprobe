<?php
if (isset($_GET['new'])) {
    CartItemRepository::create();
}

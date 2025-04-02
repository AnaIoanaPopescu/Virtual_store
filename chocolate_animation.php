<?php
// Include the functions file to use the header and footer templates
include 'functions.php';
?>

<?=template_header('Chocolate Animation')?>
<style>
    /* Styling for the sparkling text */
    .sparkling-text {
        position: absolute;
        top: 140px; /* Adjusted to align with the header */
        left: 10px;
        font-size: 18px;
        font-weight: bold;
        color: #d2691e; /* Chocolate color */
        text-shadow: 0 0 5px #fff, 0 0 10px #ffb3b3, 0 0 15px #ff6666, 0 0 20px #ff0000;
        animation: sparkle 2s infinite;
    }

    /* Sparkle animation */
    @keyframes sparkle {
        0% {
            text-shadow: 0 0 5px #fff, 0 0 10px #ffb3b3, 0 0 15px #ff6666, 0 0 20px #ff0000;
        }
        50% {
            text-shadow: 0 0 10px #fff, 0 0 15px #ffcccc, 0 0 20px #ff9999, 0 0 25px #ff4d4d;
        }
        100% {
            text-shadow: 0 0 5px #fff, 0 0 10px #ffb3b3, 0 0 15px #ff6666, 0 0 20px #ff0000;
        }
    }
</style>

<div class="products content-wrapper">
    
    <div class="sparkling-text">
        Le café qui va bien avec le chocolat!
    </div>
    
    <div class="options">
			<div>Black</div>
			<div>Flat White</div>
			<div>Latte</div>
			<div>Cappuccino</div>
			<div>Americano</div>
			<div>Espresso</div>
			<div>Doppio</div>
			<div>Cortado</div>
			<div>Macchiato</div>
			<div>Mocha</div>
			<div>Affogato</div>
			<div>Con Panna</div>
			<div>Irish</div>
			<div>Cafe Au Lait</div>

			<!-- vv repeats vv -->
			<div>Black</div>
			<div>Flat White</div>
			<div>Latte</div>
			<div>Cappuccino</div>
			<div>Americano</div>
			<div>Espresso</div>
			<div>Doppio</div>
			<div>Cortado</div>
			<div>Macchiato</div>
			<div>Mocha</div>
			<div>Affogato</div>
			<div>Con Panna</div>
			<div>Irish</div>
			<div>Cafe Au Lait</div>
			<div>Black</div>
			<div>Flat White</div>
			<div>Latte</div>
			<div>Cappuccino</div>
			<div>Americano</div>
			<div>Espresso</div>
			<div>Doppio</div>
			<div>Cortado</div>
		</div>

    <div class="wrapper">
        <div class="shadow"></div>
        <div class="title">Latte</div>
        <div class="cup latte">
            <div class="contents">
                <div class="gelato">gelato</div>
                <div class="foam">milk foam</div>
                <div class="cream">cream</div>
                <div class="steamed-milk">steamed milk</div>
                <div class="milk">milk</div>
                <div class="chocolate">chocolate</div>
                <div class="sugar">sugar</div>
                <div class="whiskey">whiskey</div>
                <div class="water">water</div>
                <div class="coffee">coffee</div>
                <div class="espresso"><span>(2)&nbsp;</span> espresso</div>
            </div>
        </div>
    </div>
</div>

<script src="./script.js"></script>

<?=template_footer()?>